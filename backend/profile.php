<?php
require_once 'connection.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}

if (isset($_GET['action'])) {
  $action = $_GET['action'];

  switch ($action) {
    case 'getProfile':
      echo getProfile($pdo);
      break;
    default:
      echo 'Invalid action';
      break;
  }
} else {
  // POST Requests
}

//Functions
function getProfile($pdo)
{
  // Get user data
  $sql = "SELECT * FROM user WHERE accountID = :accountID";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':accountID', $_SESSION['user']['accountID']);
  $stmt->execute();
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  // Get user driver application data
  $sql = "SELECT * FROM application WHERE accountID = :accountID";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':accountID', $_SESSION['user']['accountID']);
  $stmt->execute();
  $application = $stmt->fetch(PDO::FETCH_ASSOC);

  $html = [];

  $html['statusImg'] = <<<HTML
    <img src="images/passengerAcc.png" style="height: 7rem; width: auto;">
  HTML;
  $html['statusMsg'] = <<<HTML
    <h5>You're currently a <span class="badge bg-primary shadow">Passenger</span></h5>
  HTML;

  if ($application == null) {
    $html['accStatus'] = <<<HTML
      <button class="btn btn-green-outline beDriverBtn py-1 shadow" data-bs-toggle="modal" data-bs-target="#registerDriverModal">Become a Driver <i class="bi bi-car-front-fill" style="padding-left: 0.2rem;"></i></button>
    HTML;
  } else if ($application['status'] == 'New') {
    $html['accStatus'] = <<<HTML
      <span class="badge bg-secondary shadow">Pending Application</span>
    HTML;
  } else if ($application['status'] == 'Rejected') {
    $html['accStatus'] = <<<HTML
      <span class="badge bg-secondary shadow">Application Rejected</span>
    HTML;
  } else if ($application['status'] == 'Accepted') {
    $html['accStatus'] = <<<HTML
      <button class="btn btn-primary editBtn py-1 shadow" data-bs-toggle="modal" data-bs-target="#editCarModal">Edit Car Details <i class="bi bi-pencil-square" style="padding-left: 0.2rem;"></i></button>
    HTML;
    $html['statusImg'] = <<<HTML
      <img src="images/driverAcc.png" style="height: 7rem; width: auto;">
    HTML;
    $html['statusMsg'] = <<<HTML
      <h5>You're currently a <span class="badge bg-secondary shadow">Driver</span></h5>
    HTML;
  }

  $response = [
    'action' => 'getProfile',
    'user'  => $user,
    'html' => $html
  ];

  echo json_encode($response);
}
