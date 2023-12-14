<?php
require 'connection.php';

$formJSON = $_POST['formData'];
$data = json_decode($formJSON, true);

$action = $data['action'];
$accountID = $data['accountID'];

if ($action == "deleteUser") {
  try {
    $pdo->beginTransaction();
    // first delete all carpool sessions created by the user
    $stmt = $pdo->prepare("DELETE FROM carpool_passenger
          WHERE carpoolID IN (
              SELECT carpoolID
              FROM carpool
              WHERE accountID = :accountID);");
    $stmt->bindParam(':accountID', $accountID, PDO::PARAM_STR);
    $stmt->execute();

    // delete all other records of this userID
    $tablesToDeleteFrom = [
      'application',
      'carpool',
      'carpool_passenger',
      'redemption',
      'notification', // two occurrences, for senderID and recipientID
      'user',
      'account'
    ];

    foreach ($tablesToDeleteFrom as $table) {
      if ($table == 'notification') {
        $stmt = $pdo->prepare("DELETE FROM notification WHERE senderID = :accountID1 OR recipientID = :accountID2");
        $stmt->bindParam(':accountID1', $accountID, PDO::PARAM_STR);
        $stmt->bindParam(':accountID2', $accountID, PDO::PARAM_STR);
      } else {
        $stmt = $pdo->prepare("DELETE FROM $table WHERE accountID = :accountID");
        $stmt->bindParam(':accountID', $accountID, PDO::PARAM_STR);
      }
      $stmt->execute();
    }
    $response = [
      'success' => true,
      'message' => "All records of this user are deleted."
    ];
    // Commit the transaction
    $pdo->commit();
  } catch (PDOException $e) {
    // An error occurred, rollback the transaction
    $pdo->rollBack();
    $response = [
      'success' => false,
      'message' => "Error Deleting User: " . $e->getMessage()
    ];
  }
} else if ($action == "showModal") {
  //fetch user details from database
  $stmt = $pdo->prepare("SELECT user.name, account.email, user.phoneNo
  FROM user
  JOIN account ON user.accountID = account.accountID
  WHERE account.accountID = :accountID;");
  $stmt->bindParam(':accountID', $accountID, PDO::PARAM_STR);
  $stmt->execute();
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  $modal = "";

  include '../includes/modals/editUserModal.inc.php';

  $response = [
    'success' => true,
    'modal' => $modal
  ];
} else {
  $response = [
    'success' => false,
    'message' => "Error: Invalid action."
  ];
}


// Output success or failure
echo json_encode($response);
