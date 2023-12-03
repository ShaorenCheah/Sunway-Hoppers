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
    case 'getRequestTable':
      echo getRequestTable($pdo);
      break;
    case 'createRequestModal':
      $data = $_GET['data'];
      echo createRequestModal($data,$pdo);
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
  } else if ($application['status'] == 'Approved') {
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

  $user['rating'] = number_format($user['rating'], 1);
  $user['dob'] = date('F j, Y', strtotime($user['dob']));

  $response = [
    'action' => 'getProfile',
    'type'=> $_SESSION['user']['type'],
    'user'  => $user,
    'html' => $html
  ];

  echo json_encode($response);
}

function getRequestTable($pdo){
  $sql = "SELECT * FROM carpool WHERE accountID = :accountID ORDER BY carpoolDate DESC";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':accountID', $_SESSION['user']['accountID']);
  $stmt->execute();
  $carpools = $stmt->fetchAll(PDO::FETCH_ASSOC);


  $count = 1;
  $html = '';

  $html .= <<<HTML
  <table class="table align-middle">
    <thead>
      <tr>
        <th scope="col" class="text-center" >No.</th>
        <th scope="col" class="text-center">Date</th>
        <th scope="col" class="text-center">Time</th>
        <th scope="col" class="text-center">Passengers No.</th>
        <th scope="col" class="text-center">Pickup Area</th>
        <th scope="col" class="text-center">Destination</th>
        <th scope="col" class="text-center">Status</th>
        <th scope="col" class="text-center">Points Earned</th>
        <th scope="col" class="text-center">Action</th>
      </tr>
    </thead>
    <tbody>
  HTML;

  foreach ($carpools as $carpool) {

    if ($carpool['toSunway'] == 1) {
      $pickup = '<span class="badge rounded-pill shadow px-3 mx-2">' . $carpool['district'] . '</span>';
      $pickup .= '<span class="badge rounded-pill shadow px-3 mx-2">' . $carpool['neighborhood'] . '</span>';
      $destination = '<span class="badge rounded-pill shadow px-3 mx-2">' . $carpool['location'] . '</span>';
    } else {
      $pickup = '<span class="badge rounded-pill shadow px-3 mx-2">' . $carpool['location'] . '</span>';
      $destination = '<span class="badge rounded-pill shadow px-3 mx-2">' . $carpool['district'] . '</span>';
      $destination .= '<span class="badge rounded-pill shadow px-3 mx-2">' . $carpool['neighborhood'] . '</span>';
    }

    include '../includes/requestTable.inc.php';
    $count++;
  }

  $html .= <<<HTML
    </tbody>
  </table>
  HTML;

  $response = [
    'action' => 'getRequestTable',
    'html' => $html
  ];

  echo json_encode($response);

}

function createRequestModal($data,$pdo){

}
