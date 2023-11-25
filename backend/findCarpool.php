<?php
require_once 'connection.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}

// GET Requests
if (isset($_GET['action']) && $_GET['action'] != '') {
  $action = $_GET['action'];

  switch ($action) {
    case 'getDistricts':
      echo getDistricts($pdo);
      break;
    case 'getNeighborhoods':
      $selectedDistrict = $_GET['district'];
      echo getNeighborhoods($selectedDistrict, $pdo);
      break;
    default:
      echo "Invalid action";
      break;
  }
}

// POST Requests
$formJSON = $_POST['formData'];
$data = json_decode($formJSON, true);

$action = $data['action'];

if ($action == 'newCarpool') {
  echo newCarpool($data, $pdo);
};


function getDistricts($pdo)
{
  $stmt = $pdo->prepare("SELECT * FROM selangor_districts");
  $stmt->execute();
  $districts = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $html = "<option value='' disabled selected>Select District</option>";
  foreach ($districts as $district) {
    $html .= "<option value='{$district['district_id']}'>{$district['district_name']}</option>";
  }
  return $html;
}

function getNeighborhoods($selectedDistrict, $pdo)
{

  $stmt = $pdo->prepare("SELECT * FROM selangor_neighborhoods WHERE district_id = :district");
  $stmt->bindParam(':district', $selectedDistrict);
  $stmt->execute();
  $districts = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $html = "<option value='' disabled selected>Select Neighborhood</option>";
  foreach ($districts as $district) {
    $html .= "<option value='{$district['neighborhood_id']}'>{$district['neighborhood_name']}</option>";
  }
  return $html;
}

function newCarpool($data, $pdo)
{
  $stmt = $pdo->prepare('SELECT COUNT(*) FROM carpool');
  $stmt->execute();
  $count = $stmt->fetchColumn();
  $carpoolID = "C" . str_pad($count + 1, 4, "0", STR_PAD_LEFT);

  $accountID = $_SESSION['user']['accountID'];
  $carpoolDate = $data['date'];
  $carpoolTime = $data['time'];
  $passengerAmt = $data['passengerAmt'];
  $direction = $data['direction'];
  $district = $data['district'];
  $neighborhood = $data['neighborhood'];
  $location = $data['location'];
  $details = $data['details'];
  $womenOnly = $data['womenOnly'];

  $stmt = $pdo->prepare("INSERT INTO carpool (carpoolID, accountID, carpoolDate, carpoolTime, passengerAmt, toSunway, district, neighborhood, location, details, isWomenOnly, status) VALUES (:carpoolID, :accountID, :carpoolDate, :carpoolTime, :passengerAmt, :toSunway, :district, :neighborhood, :location, :details, :womenOnly, 'Active')");

  $data = array(
    ':carpoolID' => $carpoolID,
    ':accountID' => $accountID,
    ':carpoolDate' => $carpoolDate,
    ':carpoolTime' => $carpoolTime,
    ':passengerAmt' => $passengerAmt,
    ':toSunway' => $direction,
    ':district' => $district,
    ':neighborhood' => $neighborhood,
    ':location' => $location,
    ':details' => $details,
    ':womenOnly' => $womenOnly
  );

  if ($stmt->execute($data)) {
    $success = true;
    $message = "Carpool created successfully!";
  } else {
    $success = false;
    $message = "Carpool created failed. Please try again.";
  }

  $response = [
    'success' => $success,
    'action' => 'newCarpool',
    'message' => $message
  ];

  echo json_encode($response);

}
