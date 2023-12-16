<?php
require_once 'connection.php';

// Check if the 'formData' key exists in the POST request
if (!isset($_POST['formData'])) {
  $response = [
    'success' => false,
    'message' => 'Invalid request. formData is missing.',
  ];

  echo json_encode($response);
  exit; // Stop further execution
}

$formJSON = $_POST['formData'];
$data = json_decode($formJSON, true);

// Check if required keys exist in the decoded JSON
if (!isset($data['userPoints'], $data['requiredPoints'])) {
  $response = [
    'success' => false,
    'message' => 'Invalid request. Missing userPoints or requiredPoints.',
  ];

  echo json_encode($response);
  exit; // Stop further execution
}

$userPoints = $data['userPoints'];
$requiredPoints = $data['requiredPoints'];
$accountID = $data['accountID'];
$rewardID = $data['rewardID'];

try {
  $pdo->beginTransaction();

  // Check whether quantity is enough
  $stmt = $pdo->prepare("SELECT quantity FROM reward WHERE rewardID = :rewardID");
  $stmt->bindParam(':rewardID', $rewardID, PDO::PARAM_INT);
  $stmt->execute();
  $quantity = $stmt->fetchColumn();

  if ($quantity <= 0) {
    throw new Exception('This reward is out of stock.');
  }

  // Perform the redemption logic
  $newPoints = $userPoints - $requiredPoints;

  // Update the user's points in the database
  $updatePointQuery = "UPDATE user SET rewardPoints = :newPoints WHERE accountID = :accountID";
  $updatePointStmt = $pdo->prepare($updatePointQuery);
  $updatePointStmt->bindParam(':newPoints', $newPoints, PDO::PARAM_INT);
  $updatePointStmt->bindParam(':accountID', $accountID, PDO::PARAM_STR);

  // Update the reward quantity
  $updateQtyQuery = "UPDATE reward SET quantity = quantity - 1 WHERE rewardID = :rewardID";
  $updateQtyStmt = $pdo->prepare($updateQtyQuery);
  $updateQtyStmt->bindParam(':rewardID', $rewardID, PDO::PARAM_INT);

  // Create new redemption ID
  $redemptionID = generateRedemptionID($pdo);

  // Generate code and expiry date
  $code = generateCode($pdo);
  $expDate = date('Y-m-d', strtotime("+1 year"));
  $today = date('Y-m-d');

  // Add record to redemption table
  $addRedemptionQuery = "INSERT INTO redemption (redemptionID, accountID, rewardID, code, 
  redemptionDate, expiryDate, status) VALUES (:redemptionID, :accountID, :rewardID, :code, 
  :today, :expDate, 'Active')";
  $addRedemptionStmt = $pdo->prepare($addRedemptionQuery);
  $addRedemptionStmt->bindParam(':redemptionID', $redemptionID, PDO::PARAM_STR);
  $addRedemptionStmt->bindParam(':accountID', $accountID, PDO::PARAM_STR);
  $addRedemptionStmt->bindParam(':rewardID', $rewardID, PDO::PARAM_INT);
  $addRedemptionStmt->bindParam(':code', $code, PDO::PARAM_STR);
  $addRedemptionStmt->bindParam(':today', $today, PDO::PARAM_STR);
  $addRedemptionStmt->bindParam(':expDate', $expDate, PDO::PARAM_STR);

  // Check if the update queries were successful
  if ($updatePointStmt->execute() && $updateQtyStmt->execute() && $addRedemptionStmt->execute()) {
    $pdo->commit();
    $success = true;
    $message = "You have successfully redeemed this reward! Your new points balance is $newPoints.";
  } else {
    throw new Exception("Error updating user points or reward quantity in the database.");
  }
} catch (Exception $e) {
  $pdo->rollBack();
  $success = false;
  $message = $e->getMessage();
}

$response = [
  'success' => $success,
  'message' => $message,
];

// Send a JSON response indicating success or failure
echo json_encode($response);

function generateRedemptionID($pdo) {
  $query = "SELECT COUNT(*) FROM redemption";
  $stmt = $pdo->prepare($query);
  $stmt->execute();
  $count = $stmt->fetchColumn();
  return "RD" . str_pad($count + 1, 4, "0", STR_PAD_LEFT);
}

function generateCode($pdo) {
  $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $code = '';
  for ($i = 0; $i < 8; $i++) {
    $code .= $characters[rand(0, $charactersLength - 1)];
  }
  // Check if code already exists in the database
  $query = "SELECT COUNT(*) FROM redemption WHERE code = :code";
  $stmt = $pdo->prepare($query);
  $stmt->bindParam(':code', $code, PDO::PARAM_STR);
  $stmt->execute();
  $count = $stmt->fetchColumn();
  if ($count > 0) {
    generateCode($pdo);
  }
  return $code;
}
?>
