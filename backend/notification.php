<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $notificationData = json_decode($_POST['notificationData'], true);
  require_once 'connection.php';

  if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
  }

  $formJSON = $_POST['notificationData'];
  $data = json_decode($formJSON, true);

  $action = $data['action'];

  if ($action == 'createNotification') {
    createNotification($data, $pdo);
  } else if ($action == 'getNotifications') {
    getNotifications($pdo);
  }
}

function createNotification($data, $pdo)
{
  $type = $data['type'];

  switch ($type) {
    case 'joinCarpool':
      $title = "New Carpool Request";
      $message = "You have a new carpool request from " . $data['senderName'];

      $sql = "SELECT accountID FROM carpool WHERE carpoolID = :carpoolID";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(':carpoolID', $data['carpoolID'], PDO::PARAM_STR);
      $stmt->execute();
      $recipientID = $stmt->fetch(PDO::FETCH_ASSOC);
      $recipientID = $recipientID['accountID'];
      break;
    case 'manageRequest':
      $status = $data['status'];
      if($status == 'Accepted'){
        $title = "Carpool Request Accepted";
        $condition = 'accepted';
      }else{
        $title = "Carpool Request Rejected";
        $condition = 'rejected';
      }
      $message = $data['senderName'] . " has " . $condition . " your carpool request";
      $recipientID = $data['recipientID'];
      break;
    case 'redeemCode':
      $title = "Code Redeemed";
      $message = $data['senderName'] . " has redeemed your carpool code. You've received 20 points.";
      $recipientID = $data['recipientID'];
      break;
  }
  $sql = "INSERT INTO notification (notificationID, senderID, recipientID, type, title, message, dateTime, seen) VALUES (NULL, :senderID, :recipientID, :type, :title, :message, NOW(), '0')";

  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':senderID', $data['senderID'], PDO::PARAM_STR);
  $stmt->bindParam(':recipientID', $recipientID, PDO::PARAM_STR);
  $stmt->bindParam(':type', $type, PDO::PARAM_STR);
  $stmt->bindParam(':title', $title, PDO::PARAM_STR);
  $stmt->bindParam(':message', $message, PDO::PARAM_STR);
  $stmt->execute();

  $response = [
    'action' => 'createNotification',
    'type' => $type
  ];

  echo json_encode($response);
}

function getNotifications($pdo)
{
  $sql = "SELECT * FROM notification WHERE recipientID = :recipientID AND seen = '0' ORDER BY dateTime DESC";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':recipientID', $_SESSION['user']['accountID'], PDO::PARAM_STR);
  $stmt->execute();
  $notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);

  foreach($notifications as $notification){
    $sql = "UPDATE notification SET seen = '1' WHERE notificationID = :notificationID";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':notificationID', $notification['notificationID'], PDO::PARAM_STR);
    $stmt->execute();
  }

  $response = [
    'action' => 'getNotifications',
    'notifications' => $notifications
  ];

  echo json_encode($response);
}
