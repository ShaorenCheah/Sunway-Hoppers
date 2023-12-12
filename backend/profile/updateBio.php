<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  require './connection.php';

  session_start();

  $accountID = $_SESSION['user']['accountID'];

  $bio = $_POST['descText'];

  // Update the database
  $stmt = $pdo->prepare('UPDATE user SET bio = :bio WHERE accountID = :accountID');
  $stmt->bindParam(':bio', $bio);
  $stmt->bindParam(':accountID', $accountID);
  $stmt->execute();

  $msg = 'Bio updated successfully';
  alert($msg);
} else {
  $msg = 'Bio was not updated. Please try again.';
  alert($msg);
}

function alert($msg)
{
  echo "<script>alert('" . $msg . "');</script>";
  echo "<script>window.location = '../profile.php';</script>";
}
