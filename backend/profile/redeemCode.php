<?php
require_once '../connection.php';
session_start();

$formJSON = $_POST['codeData'];
$data = json_decode($formJSON, true);

$code = $data['code'];
$carpoolID = $data['carpoolID'];
$passengerID = $data['passengerID'];

// Check if code exists
$sql = "SELECT * FROM carpool_passenger WHERE code = :code AND carpoolID = :carpoolID AND accountID = :passengerID";
$stmt = $pdo -> prepare($sql);
$stmt -> bindParam(":code", $code, PDO::PARAM_STR);
$stmt -> bindParam(":carpoolID", $carpoolID, PDO::PARAM_STR);
$stmt -> bindParam(":passengerID", $passengerID, PDO::PARAM_STR);
$stmt -> execute();
$rowCount = $stmt->rowCount();
$row = $stmt -> fetch(PDO::FETCH_ASSOC);

if($rowCount > 0){
  // Update status to completed
  $sql = "UPDATE carpool_passenger SET status = 'Completed' WHERE code = :code AND carpoolID = :carpoolID AND accountID = :passengerID";
  $stmt = $pdo -> prepare($sql);
  $stmt -> bindParam(":code", $code, PDO::PARAM_STR);
  $stmt -> bindParam(":carpoolID", $carpoolID, PDO::PARAM_STR);
  $stmt -> bindParam(":passengerID", $passengerID, PDO::PARAM_STR);
  $stmt -> execute();

  // Award points to passenger
  $sql = "UPDATE user SET rewardPoints = rewardPoints + 20 WHERE accountID = :passengerID";
  $stmt = $pdo -> prepare($sql);
  $stmt -> bindParam(":passengerID", $passengerID, PDO::PARAM_STR);
  $stmt -> execute();

  // Award points to driver
  $sql = "UPDATE user SET rewardPoints = rewardPoints + 50 WHERE accountID = :driverID";
  $stmt = $pdo -> prepare($sql);
  $stmt -> bindParam(":driverID", $_SESSION['user']['accountID'], PDO::PARAM_STR);
  $stmt -> execute();

  // Update carpool points earned
  $sql = "UPDATE carpool SET pointsEarned = pointsEarned + 50 WHERE carpoolID = :carpoolID";
  $stmt = $pdo -> prepare($sql);
  $stmt -> bindParam(":carpoolID", $carpoolID, PDO::PARAM_STR);
  $stmt -> execute();

  $message = "Code Redeemed Successfully";

}else{
  $message = "Invalid Code";
}

$response = [
  'action' => 'newRequestModal',
  'carpoolID' => $carpoolID,
  'message' => $message
];

echo json_encode($response);

?>