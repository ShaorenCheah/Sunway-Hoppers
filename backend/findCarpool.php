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
    case 'getCarpoolList':
      $data = json_decode($_GET['filterData'], true);
      echo getCarpoolList($data, $pdo);
      break;
    default:
      echo "Invalid action";
      break;
  }
} else {
  // POST Requests
  $formJSON = $_POST['formData'];
  $data = json_decode($formJSON, true);

  $action = $data['action'];
  switch ($action) {
    case 'newCarpool':
      echo newCarpool($data, $pdo);
      break;
    case 'joinCarpool':
      echo joinCarpool($data, $pdo);
      break;
    default:
      echo "Invalid action";
      break;
  }
}

// Functions
function getDistricts($pdo)
{
  $stmt = $pdo->prepare("SELECT DISTINCT district_name FROM district_neighborhood");
  $stmt->execute();
  $districts = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $html = "<option value='' disabled selected>Select District</option>";
  foreach ($districts as $district) {
    $html .= "<option value='{$district['district_name']}'>{$district['district_name']}</option>";
  }
  return $html;
}

function getNeighborhoods($selectedDistrict, $pdo)
{

  $stmt = $pdo->prepare("SELECT * FROM district_neighborhood WHERE district_name = :district");
  $stmt->bindParam(':district', $selectedDistrict);
  $stmt->execute();
  $districts = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $html = "<option value='' disabled selected>Select Neighborhood</option>";
  foreach ($districts as $district) {
    $html .= "<option value='{$district['neighborhood_name']}'>{$district['neighborhood_name']}</option>";
  }
  return $html;
}

function getCarpoolList($data, $pdo)
{
  $page = $data['page'];

  $resultsPerPage = 4;
  $offset = ($page - 1) * $resultsPerPage;
  $sql = "SELECT * FROM `account`
  JOIN `user` ON `account`.`accountID` = `user`.`accountID`
  JOIN `carpool` ON `account`.`accountID` = `carpool`.`accountID`
  ";

  $countSql = "SELECT COUNT(*) as total FROM `account`
  JOIN `user` ON `account`.`accountID` = `user`.`accountID`
  JOIN `carpool` ON `account`.`accountID` = `carpool`.`accountID`
  ";

  $params = [];
  $whereClauses[] = "(`carpool`.`carpoolDate` > CURDATE() OR (`carpool`.`carpoolDate` = CURDATE() AND `carpool`.`carpoolTime` > CURTIME())) AND `carpool`.`status` = 'Active' AND `carpool`.`accountID` != :accountID";
  $params[':accountID'] = $_SESSION['user']['accountID'];

  if ($data['type'] == 'filteredList') {

    if (!empty($data['filterName'])) {
      $whereClauses[] = "`user`.`name` LIKE :filterName";
      $params[':filterName'] = '%' . $data['filterName'] . '%';
    }

    if (!empty($data['filterDirection'])) {
      if ($data['filterDirection'] == "to") {
        $whereClauses[] = "`carpool`.`toSunway` = 1";
      } else if ($data['filterDirection'] == "from") {
        $whereClauses[] = "`carpool`.`toSunway` = 0";
      }
    }

    if ($data['filterWomenOnly'] !== null) {
      $whereClauses[] = "`carpool`.`isWomenOnly` = :filterWomenOnly";
      $params[':filterWomenOnly'] = $data['filterWomenOnly'];
    }

    if (!empty($data['filterDate'])) {
      $whereClauses[] = "`carpool`.`carpoolDate` = :filterDate";
      $params[':filterDate'] = $data['filterDate'];
    }

    if (!empty($data['filterStartTime'])) {
      $whereClauses[] = "`carpool`.`carpoolTime` >= :filterStartTime";
      $params[':filterStartTime'] = $data['filterStartTime'];
    }

    if (!empty($data['filterEndTime'])) {
      $whereClauses[] = "`carpool`.`carpoolTime` <= :filterEndTime";
      $params[':filterEndTime'] = $data['filterEndTime'];
    }

    if (!empty($data['filterDistrict'])) {
      $whereClauses[] = "`carpool`.`district` = :filterDistrict";
      $params[':filterDistrict'] = $data['filterDistrict'];
    }

    if (!empty($data['filterNeighborhood'])) {
      $whereClauses[] = "`carpool`.`neighborhood` = :filterNeighborhood";
      $params[':filterNeighborhood'] = $data['filterNeighborhood'];
    }

    if (!empty($data['filterLocation'])) {
      $whereClauses[] = "`carpool`.`location` = :filterLocation";
      $params[':filterLocation'] = $data['filterLocation'];
    }
  }

  if (!empty($whereClauses)) {
    $sql .= ' WHERE ' . implode(' AND ', $whereClauses);
    $countSql .= ' WHERE ' . implode(' AND ', $whereClauses);
  }

  $sql .= ' ORDER BY `carpool`.`carpoolDate` ASC, `carpool`.`carpoolTime` ASC';
  $sql .= " LIMIT $offset, $resultsPerPage";

  $stmt = $pdo->prepare($sql);
  $stmt->execute($params);
  $carpools = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // Get total number of results
  $stmtCount = $pdo->prepare($countSql);
  $stmtCount->execute($params);
  $totalItems = $stmtCount->fetchColumn();

  // $html =  "<h6>" . $sql . "</h6>";
  $html = "";
  $modal = "";

  // Fetch user carpool requests
  $request = 0;

  $stmt = $pdo->prepare("SELECT carpoolID FROM carpool_passenger WHERE accountID = :accountID");
  $stmt->bindParam(':accountID', $_SESSION['user']['accountID']);
  $stmt->execute();
  $userCarpools = $stmt->fetchAll(PDO::FETCH_COLUMN, 0); // Fetch only the 'carpoolID' column

  if (count($carpools) > 0) {
    foreach ($carpools as $carpool) {
      $carpoolID = $carpool['carpoolID'];
      $accountID = $carpool['accountID'];

      // Check if user has requested to join carpool
      if (in_array($carpoolID, $userCarpools)) {
        $stmt = $pdo->prepare("SELECT * FROM carpool_passenger WHERE carpoolID = :carpoolID AND accountID = :accountID");
        $stmt->bindParam(':carpoolID', $carpoolID);
        $stmt->bindParam(':accountID', $_SESSION['user']['accountID']);
        $stmt->execute();
        $userCarpool = $stmt->fetch(PDO::FETCH_ASSOC);
      }

      $rating = number_format($carpool['rating'], 1);

      // Get Vehicle Details
      $stmt = $pdo->prepare("SELECT * FROM application WHERE accountID = :accountID");
      $stmt->bindParam(':accountID', $accountID);
      $stmt->execute();
      $vehicle = $stmt->fetch(PDO::FETCH_ASSOC);

      // Get Passenger Amount
      $stmt = $pdo->prepare("SELECT COUNT(*) FROM carpool_passenger WHERE carpoolID = :carpoolID AND isApproved = 1");
      $stmt->bindParam(':carpoolID', $carpoolID);
      $stmt->execute();
      $passengerAmt = $stmt->fetchColumn();

      // Get Ratings Amount
      $stmt = $pdo->prepare("SELECT COUNT(*) FROM carpool_passenger WHERE carpoolID = :carpoolID AND rating != NULL");
      $stmt->bindParam(':carpoolID', $carpoolID);
      $stmt->execute();
      $ratingsAmt = $stmt->fetchColumn();

      $carpoolDay = date('l', strtotime($carpool['carpoolDate']));
      $carpoolTime = date('g:i A', strtotime($carpool['carpoolTime']));

      if ($carpool['toSunway'] == 1) {
        $pickup = '<span class="badge rounded-pill shadow px-3 mx-2">' . $carpool['district'] . '</span>';
        $pickup .= '<span class="badge rounded-pill shadow px-3 mx-2">' . $carpool['neighborhood'] . '</span>';
        $destination = '<span class="badge rounded-pill shadow px-3 mx-2">' . $carpool['location'] . '</span>';
      } else {
        $pickup = '<span class="badge rounded-pill shadow px-3 mx-2">' . $carpool['location'] . '</span>';
        $destination = '<span class="badge rounded-pill shadow px-3 mx-2">' . $carpool['district'] . '</span>';
        $destination .= '<span class="badge rounded-pill shadow px-3 mx-2">' . $carpool['neighborhood'] . '</span>';
      }

      if ($carpool['isWomenOnly'] == 1) {
        $womenOnly = '<span class="badge rounded-pill shadow px-3 mb-3" style="background-color:#FF9BBC">Women-Only</span>';
      } else {
        $womenOnly = '';
      }

      $remainingSeats = $carpool['passengerAmt'] - $passengerAmt;

      // Create carpool card
      include '../includes/carpoolList.inc.php';

      // Create Modal
      include '../includes/modals/carpoolSessionModal.inc.php';
    }
  } else {
    if ($data['type'] == 'filteredList') {
      $message = 'Try changing your filters';
    } else if ($data['type'] == 'allList') {
      $message = 'Currently no carpool exists';
    }

    $html .= <<<HTML
    <div class="d-flex flex-column align-items-center justify-content-center" style="height: 50vh;">
      <h1 class="text-center" style="font-size: 3rem; color: var(--primary);">No Carpool Available</h1>
      <p class="text-center text-muted" style="font-size: 1.5rem;">{$message}</p>
    </div>
    HTML;
  };

  if ($request == count($carpools) && $request != 0) {
    $html .= <<<HTML
    <div class="d-flex flex-column align-items-center justify-content-center" style="height: 50vh;">
      <h1 class="text-center" style="font-size: 3rem; color: var(--primary);">No Carpool Available</h1>
      <p class="text-center text-muted" style="font-size: 1.5rem;">Please check your profile page for carpool request status</p>
    </div>
    HTML;
  }

  $response = [
    'action' => 'getCarpoolList',
    'message' => 'Carpool list fetched successfully!',
    'html' => $html,
    'modal' => $modal,
    'page' => $page,
    'totalItems' => $totalItems

  ];

  echo json_encode($response);
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

function joinCarpool($data, $pdo)
{
  $carpoolID = $data['carpoolID'];
  $accountID = $_SESSION['user']['accountID'];

  $stmt = $pdo->prepare("INSERT INTO carpool_passenger (carpoolID, accountID, isApproved, code, status, rating) VALUES (:carpoolID, :accountID, 0, NULL, 'Pending', NULL)");

  $data = array(
    ':carpoolID' => $carpoolID,
    ':accountID' => $accountID
  );

  if ($stmt->execute($data)) {
    $success = true;
    $message = "Joined carpool successfully!";
  } else {
    $success = false;
    $message = "Joined carpool failed. Please try again.";
  }

  $response = [
    'success' => $success,
    'action' => 'joinCarpool',
    'message' => $message
  ];

  echo json_encode($response);
}
