<?php
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the application ID and status from the AJAX request
    $applicationID = $_POST['applicationID'];
    $status = $_POST['status'];

    // Update the database
    $stmt = $pdo->prepare('UPDATE application SET status = :status WHERE applicationID = :applicationID');
    $stmt->bindParam(':status', $status, PDO::PARAM_STR);
    $stmt->bindParam(':applicationID', $applicationID, PDO::PARAM_INT);
    $stmt->execute();

} else {
    // Handle invalid requests
    http_response_code(400);
    echo "Invalid request";
}
?>
