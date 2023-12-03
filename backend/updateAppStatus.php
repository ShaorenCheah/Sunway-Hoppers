<?php
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the application ID and status from the AJAX request
    $applicationID = $_POST['applicationID'];
    $status = $_POST['status'];
    $vehicleRules = $_POST['vehicleRules'] ? $_POST['vehicleRules'] : null;

    // Update the database
    $stmt = $pdo->prepare('UPDATE application SET status = :status WHERE applicationID = :applicationID');
    $stmt->bindParam(':status', $status, PDO::PARAM_STR);
    $stmt->bindParam(':applicationID', $applicationID, PDO::PARAM_INT);
    $stmt->execute();
    
    $stmt = $pdo->prepare('SELECT accountID, vehicleRules FROM application WHERE applicationID = :applicationID');
    $stmt->bindParam(':applicationID', $applicationID, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $accountID = $result['accountID'];
    $vehicleRules = $result['vehicleRules'];

    try {
        $pdo->beginTransaction();
    
        if ($status == "Approved") {
            $stmt1 = $pdo->prepare('UPDATE user SET carRules = :vehicleRules WHERE accountID = :accountID');
            $stmt1->bindParam(':vehicleRules', $vehicleRules, PDO::PARAM_STR);
            $stmt1->bindParam(':accountID', $accountID, PDO::PARAM_INT);
            $stmt1->execute();
    
            $stmt2 = $pdo->prepare('UPDATE account SET type = "Driver" WHERE accountID = :accountID');
            $stmt2->bindParam(':accountID', $accountID, PDO::PARAM_INT);
            $stmt2->execute();
        } elseif ($status == "Rejected") {
            $stmt1 = $pdo->prepare('UPDATE user SET carRules = null, rating = 0 WHERE accountID = :accountID');
            $stmt1->bindParam(':accountID', $accountID, PDO::PARAM_INT);
            $stmt1->execute();
    
            $stmt2 = $pdo->prepare('UPDATE account SET type = "Passenger" WHERE accountID = :accountID');
            $stmt2->bindParam(':accountID', $accountID, PDO::PARAM_INT);
            $stmt2->execute();
        }
    
        $pdo->commit();
    } catch (Exception $e) {
        // An error occurred, rollback changes
        $pdo->rollBack();
        echo "Failed: " . $e->getMessage();
    }
} else {
    // Handle invalid requests
    http_response_code(400);
    echo "Invalid request";
}
?>
