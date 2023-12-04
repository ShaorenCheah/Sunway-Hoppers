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
      $data = json_decode($_GET['requestData'], true);
      echo createRequestModal($data, $pdo);
      break;
    default:
      echo 'Invalid action';
      break;
  }
} else {
  // POST Requests
  $formJSON = $_POST['formData'];
  $data = json_decode($formJSON, true);
  $action = $data['action'];

  switch ($action) {
    case 'acceptRequest':
      echo acceptRequest($data, $pdo);
      break;
    default:
      echo 'Invalid action';
      break;
  }
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
    'type' => $_SESSION['user']['type'],
    'user'  => $user,
    'html' => $html
  ];

  echo json_encode($response);
}

function getRequestTable($pdo)
{
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

function createRequestModal($data, $pdo)
{

  // Get pending requests data
  $sql = "SELECT * FROM carpool_passenger WHERE carpoolID = :carpoolID AND status = 'Pending'";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':carpoolID', $data['carpoolID']);
  $stmt->execute();
  $requests = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $pendingHTML = "<div class='w-100 d-flex flex-column align-items-start justify-content-start'>";

  if (count($requests) > 0) {
    $count = 1;
    foreach ($requests as $request) {
      $sql = "SELECT * FROM user WHERE accountID = :accountID";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(':accountID', $request['accountID']);
      $stmt->execute();
      $user = $stmt->fetch(PDO::FETCH_ASSOC);

      $pendingHTML .= <<<HTML
      <div class="row w-100 p-0 d-flex align-items-center justify-content-center">
        <div class="p-0 col-1 d-flex justify-content-center align-items-center">
          <p class="fw-b mb-0 pt-2" style="color: var(--black); font-size: 1.143rem;">{$count}.</p>
        </div>
        <div class="p-0 col-8 d-flex ustify-content-center align-items-center">
          <p class="mb-0 pt-2" style="color: var(--black);font-size: 1.143rem;">{$user['name']}</p>
          <p class="ms-3 mb-0 pt-2" style="color: var(--black);font-size: 1.143rem;">{$user['phoneNo']}</p>
        </div>
        <div class="p-0 col-3 d-flex justify-content-end align-items-center">
          <button class="btn btn-success shadow accept-request" data-accountID="{$request['accountID']}" data-carpoolID="{$data['carpoolID']}" style="padding:0px;width:30px;height:30px"><i class="bi bi-check" style="font-size:1.5rem; color:white;"></i></button>
          <button class="ms-2 btn btn-danger shadow reject-request" data-accountID="{$request['accountID']}" data-carpoolID="{$data['carpoolID']}" style="padding:0px;width:30px;height:30px"><i class="bi bi-x" style="font-size:1.5rem; color:white;"></i></button>
        </div>
      </div>
      HTML;
      $count++;
    }
    $pendingHTML .= "<p class='text-muted mt-4' style='font-size: 0.75rem;'>**Make sure to discuss on the exact pick up location before accepting the request</p>";
  } else {
    $pendingHTML .= "<p class='my-2 fw-b text-muted w-100 text-center'>No Pending Requests </p>";
  }


  // Get accepted passenger data
  $sql = "SELECT * FROM carpool_passenger WHERE carpoolID = :carpoolID AND isApproved = true";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':carpoolID', $data['carpoolID']);
  $stmt->execute();
  $passengers = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $passengerHTML = "<div class='w-100 d-flex flex-column align-items-start justify-content-start'>";

  if (count($passengers) > 0) {
    $count = 1;
    foreach ($passengers as $passenger) {
      $sql = "SELECT * FROM user WHERE accountID = :accountID";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(':accountID', $passenger['accountID']);
      $stmt->execute();
      $user = $stmt->fetch(PDO::FETCH_ASSOC);

      $passengerHTML .= <<<HTML
      <div class="row w-100 p-0 d-flex align-items-center justify-content-center">
        <div class="p-0 col-1 d-flex justify-content-center align-items-center">
          <p class="fw-b mb-0 pt-2" style="color: var(--black); font-size: 1.143rem;">{$count}.</p>
        </div>
        <div class="p-0 col-8 d-flex ustify-content-center align-items-center">
          <p class="mb-0 pt-2" style="color: var(--black);font-size: 1.143rem;">{$user['name']}</p>
          <p class="ms-3 mb-0 pt-2" style="color: var(--black);font-size: 1.143rem;">{$user['phoneNo']}</p>
        </div>
        <div class="p-0 col-3 d-flex justify-content-end align-items-center">
          <button class="btn btn-primary shadow" style="padding:0px;width:30px;height:30px"><i class="bi bi-check" style="font-size:1.5rem"></i></button>
          <button class="ms-2 btn btn-primary shadow" style="padding:0px;width:30px;height:30px"><i class="bi bi-x" style="font-size:1.5rem"></i></button>
        </div>
      </div>
      HTML;
      $count++;
    }
    $passengerHTML .= "<p class='text-muted mt-4' style='font-size: 0.75rem;'>**Ask for arrival code from passenger after reaching the destination</p>";
  } else {
    $passengerHTML .= "<p class='my-2 fw-b text-muted w-100 text-center'>No Passenger Accepted </p>";
  }

  $pendingHTML .= "</div>";
  $passengerHTML .= "</div>";

  $modal = "";

  include '../includes/modals/viewRequestModal.inc.php';


  $response = [
    'action' => 'createRequestModal',
    'modal' => $modal
  ];

  echo json_encode($response);
}

function acceptRequest($data, $pdo)
{

  $code = '';
  for ($i = 0; $i < 5; $i++) {
    $numOrLetter = rand(0, 1); // Randomly choose between 0 (number) and 1 (letter)
    if ($numOrLetter == 0) {
      $code .= rand(0, 9); // Append a random number between 0 and 9
    } else {
      $code .= chr(rand(65, 90)); // Append a random uppercase letter
    }
  }

  $sql = "UPDATE carpool_passenger SET status = 'Accepted', isApproved = true, code = :code WHERE accountID = :accountID AND carpoolID = :carpoolID";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':code', $data['code']);
  $stmt->bindParam(':accountID', $data['accountID']);
  $stmt->bindParam(':carpoolID', $data['carpoolID']);
  if($stmt->execute()){
    $status = 'success';
    $message = 'Request accepted successfully';
  }else{
    $status = 'error';
    $message = 'Error accepting request';
  }

  $response = [
    'action' => 'acceptRequest',
    'status' => $status,
    'message' => $message,
    'code' => $code
  ];

  echo json_encode($response);
}
