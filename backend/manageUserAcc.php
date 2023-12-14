<?php
require 'connection.php';

$formJSON = $_POST['formData'];
$data = json_decode($formJSON, true);

$action = $data['action'];
$accountID = $data['accountID'];

try {
  $pdo->beginTransaction();

  if ($action == "deleteUser") {
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

      $success = true;
      $message = "All records of this user are deleted.";
  } 
  // Commit the transaction
  $pdo->commit();
} catch (PDOException $e) {
  // An error occurred, rollback the transaction
  $pdo->rollBack();
  $success = false;
  $message = "Error Deleting User: " . $e->getMessage();
}

// Output success or failure
echo json_encode(['success' => $success, 'message' => $message]);

