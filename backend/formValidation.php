<?php
require 'connection.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}

$formJSON = $_POST['formData'];
$data = json_decode($formJSON, true);

$action = $data['action'];
$input = $data['input'];

if ($action != 'checkCarNo') {
  switch ($action) {
    case 'checkEmail':
    case 'checkAdminEmail':
      $table = 'account';
      $column = 'email';
      break;
    case 'checkUsername':
      $table = 'user';
      $column = 'name';
      break;
    case 'checkAdminName':
      $table = 'admin';
      $column = 'name';
      break;
    case 'checkPhoneNo':
      $table = 'user';
      $column = 'phoneNo';
      break;
    case 'checkAdminPhoneNo':
      $table = 'admin';
      $column = 'phoneNo';
      break;
    default:
      break;
  }

  $stmt = $pdo->prepare("SELECT $column FROM $table WHERE $column = :input");
  $stmt->bindParam(':input', $input, PDO::PARAM_STR);
  $stmt->execute();

  $rowCount = $stmt->rowCount();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($rowCount > 0) {
    $available = false;
    if ($column == 'phoneNo'){
      $column = 'Phone number';
    } else {
      //capitalise first letter of column name
      $column = ucfirst($column);
    }
    $message = "$column is already registered";
  } else {
    $available = true;
    $message = "";
  }
} else {
  $stmt = $pdo->prepare("SELECT vehicleNo, status FROM application WHERE vehicleNo = :input");
  $stmt->bindParam(':input', $input, PDO::PARAM_STR);
  $stmt->execute();

  $rowCount = $stmt->rowCount();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($rowCount > 0 && $result['status'] == 'Approved') {
    $available = false;
    $message = "Car is registered";
  } else if ($rowCount > 0 && $result['status'] == 'New') {
    $available = false;
    $message = "Car is unavailable";
  } else {
    $available = true;
    $message = "";
  }
}

$response = [
  'available' => $available,
  'message' => $message,
  'action' => $action,
];
echo json_encode($response);
