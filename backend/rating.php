<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $ratingData = json_decode($_POST['ratingData'], true);
  require_once 'connection.php';

  if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
  }

  $formJSON = $_POST['ratingData'];
  $data = json_decode($formJSON, true);

  $action = $data['action'];

  if($action == 'getRating'){
    getRating($pdo);
  }
}

function getRating($pdo){
  $sql = "SELECT * FROM carpool_passenger WHERE accountID = :accountID AND status = 'Completed' AND rating IS NULL LIMIT 1";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':accountID', $_SESSION['user']['accountID'], PDO::PARAM_STR);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $modal = "";
  if(count($result) > 0 ){
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
      'driverName' => $driverName
    ];

    include '../includes/modals/ratingModal.inc.php';

  }else{
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
?>
