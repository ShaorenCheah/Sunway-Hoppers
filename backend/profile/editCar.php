<?php
require_once '../connection.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}

$formJSON = $_POST['formData'];
$data = json_decode($formJSON, true);
$carNo = $data['carNo'];
$carType = $data['carType'];
$carColour = $data['carColour'];
$carRules = $data['carRules'];

$accountID = $_SESSION['user']['accountID'];

$query = "UPDATE application SET vehicleNo = :vehicleNo, vehicleType = :vehicleType, vehicleColour = :vehicleColour, vehicleRules = :vehicleRules WHERE accountID = :accountID";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':vehicleNo', $carNo, PDO::PARAM_STR);
$stmt->bindParam(':vehicleType', $carType, PDO::PARAM_STR);
$stmt->bindParam(':vehicleColour', $carColour, PDO::PARAM_STR);
$stmt->bindParam(':vehicleRules', $carRules, PDO::PARAM_STR);
$stmt->bindParam(':accountID', $accountID, PDO::PARAM_STR);
$stmt->execute();

$message = "Car details updated successfully!";
$success = true;

$response = [
  'success' => $success,
  'message' => $message,
];
// Send a JSON response indicating success or failure

echo json_encode($response);
