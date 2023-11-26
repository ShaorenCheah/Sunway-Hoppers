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

    if($status == "A"){
        $stmt = $pdo->prepare('UPDATE user SET carRules = :vehicleRules, isDriver = 1 WHERE accountID = :accountID');
        $stmt->bindParam(':vehicleRules', $vehicleRules, PDO::PARAM_STR);
        $stmt->bindParam(':accountID', $accountID, PDO::PARAM_INT);
        $stmt->execute();
    } else if($status == "R"){
        $stmt = $pdo->prepare('UPDATE user SET carRules = null, isDriver = 0, rating = 0 WHERE accountID = :accountID');
        $stmt->bindParam(':accountID', $accountID, PDO::PARAM_INT);
        $stmt->execute();
    }

} else {
    // Handle invalid requests
    http_response_code(400);
    echo "Invalid request";
}
?>
