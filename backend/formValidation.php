<?php
require 'connection.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}

$formJSON = $_POST['formData'];
$data = json_decode($formJSON, true);

$action = $data['action'];
$input = $data['input'];

if ($action == 'checkEmail') {
  $stmt = $pdo->prepare('SELECT email FROM account WHERE email = :email');
  $stmt->bindParam(':email', $input, PDO::PARAM_STR);
  $stmt->execute();

  $rowCount = $stmt->rowCount();

  if ($rowCount > 0) {
    $available = false;
    $message = "Email is already registered";
  } else {
    $available = true;
    $message = "";
  }
} else if ($action == 'checkUsername') {
  $stmt = $pdo->prepare('SELECT name FROM user WHERE name = :username');
  $stmt->bindParam(':username', $input, PDO::PARAM_STR);
  $stmt->execute();

  $rowCount = $stmt->rowCount();

  if ($rowCount > 0) {
    $available = false;
    $message = "Username is already taken";
  } else {
    $available = true;
    $message = "";
  }
} else if ($action == 'checkPhoneNo') {
  $stmt = $pdo->prepare('SELECT phoneNo FROM user WHERE phoneNo = :phoneNo');
  $stmt->bindParam(':phoneNo', $input, PDO::PARAM_STR);
  $stmt->execute();

  $rowCount = $stmt->rowCount();

  if ($rowCount > 0) {
    $available = false;
    $message = "Phone number is already registered";
  } else {
    $available = true;
    $message = "";
  }
} else if ($action == 'checkCarNo') {
  $stmt = $pdo->prepare('SELECT vehicleNo, status FROM application WHERE vehicleNo = :carNo');
  $stmt->bindParam(':carNo', $input, PDO::PARAM_STR);
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
