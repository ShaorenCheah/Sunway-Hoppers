<?php
session_start();
require '../connection.php';
$bio = $_POST['bio'];
$accountID = $_SESSION['user']['accountID'];


// Update the database
$stmt = $pdo->prepare('UPDATE user SET bio = :bio WHERE accountID = :accountID');
$stmt->bindParam(':bio', $bio);
$stmt->bindParam(':accountID', $accountID);
if ($stmt->execute()) {
  $response['status'] = 'success';
  $response['message'] = 'Bio updated successfully';
} else {
  $response['status'] = 'error';
  $response['message'] = 'Error updating bio';
}

echo json_encode($response);
?>