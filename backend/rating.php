<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $ratingData = json_decode($_POST['ratingData'], true);
  require_once 'connection.php';
 
  session_start();

  $formJSON = $_POST['ratingData'];
  $data = json_decode($formJSON, true);

  $action = $data['action'];

  if ($action == 'getRating') {
    getRating($pdo);
  } else if ($action == 'submitRating') {
    submitRating($data, $pdo);
  }
}

function getRating($pdo)
{
  $sql = "SELECT * FROM carpool_passenger WHERE accountID = :accountID AND status = 'Completed' AND rating IS NULL LIMIT 1";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':accountID', $_SESSION['user']['accountID'], PDO::PARAM_STR);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $modal = "";
  if (count($result) > 0) {
    $status = 'newRating';
    $carpoolID = $result[0]['carpoolID'];
    // Get carpool details
    $sql = "SELECT * FROM carpool WHERE carpoolID = :carpoolID";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':carpoolID', $carpoolID, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $carpoolDate = $result[0]['carpoolDate'];
    $carpoolTime = date("g:i A", strtotime($result[0]['carpoolTime']));
    $driverID = $result[0]['accountID'];

    // Get driver details
    $sql = "SELECT * FROM user WHERE accountID = :accountID";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':accountID', $driverID, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $driverName = $result[0]['name'];

    $rating = [
      'carpoolID' => $carpoolID,
      'carpoolDate' => $carpoolDate,
      'carpoolTime' => $carpoolTime,
      'driverID' => $driverID,
      'driverName' => $driverName
    ];

    include '../includes/modals/ratingModal.inc.php';
  } else {
    $status = 'noRating';
    $rating = null;
  }
  $response = [
    'action' => 'getRating',
    'status' => $status,
    'rating' => $rating,
    'modal' => $modal
  ];
  echo json_encode($response);
}

function submitRating($data, $pdo)
{
  // Record user rating
  $sql = "UPDATE carpool_passenger SET rating = :rating WHERE carpoolID = :carpoolID AND accountID = :accountID";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':rating', $data['rating'], PDO::PARAM_STR);
  $stmt->bindParam(':carpoolID', $data['ratingData']['carpoolID'], PDO::PARAM_STR);
  $stmt->bindParam(':accountID', $_SESSION['user']['accountID'], PDO::PARAM_STR);
  $stmt->execute();

  // Get new driver rating
  $sql = "SELECT AVG(carpool_passenger.rating) FROM carpool_passenger JOIN carpool 
  ON carpool_passenger.carpoolID = carpool.carpoolID WHERE carpool.accountID= :driverID";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':driverID', $data['ratingData']['driverID'], PDO::PARAM_STR);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $rating = $result[0]['AVG(carpool_passenger.rating)'];

  // Update driver rating
  $sql = "UPDATE user SET rating = :rating WHERE accountID = :driverID";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':rating', $rating, PDO::PARAM_STR);
  $stmt->bindParam(':driverID', $data['ratingData']['driverID'], PDO::PARAM_STR);
  $stmt->execute();

  // Get total rating amount
  $sql = "SELECT COUNT(*) FROM carpool_passenger JOIN carpool ON 
  carpool_passenger.carpoolID = carpool.carpoolID WHERE carpool.accountID = :driverID 
  AND carpool_passenger.rating IS NOT NULL";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':driverID', $data['ratingData']['driverID'], PDO::PARAM_STR);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $ratingAmt = $result[0]['COUNT(*)'];

  // Update driver rating amount
  $sql = "UPDATE user SET ratingsAmt = :ratingsAmt WHERE accountID = :driverID";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':ratingsAmt', $ratingAmt, PDO::PARAM_STR);
  $stmt->bindParam(':driverID', $data['ratingData']['driverID'], PDO::PARAM_STR);
  $stmt->execute();

  $notification = [
    'action' => 'createNotification',
    'type' => 'submitRating',
    'senderID' => $_SESSION['user']['accountID'],
    'senderName' => $_SESSION['user']['name'],
    'recipientID' => $data['ratingData']['driverID'],
    'rating' => $data['rating'],
  ];

  $response = [
    'action' => 'submitRating',
    'message' => "Thanks for rating!",
    'notification' => $notification
  ];

  echo json_encode($response);
}
