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
} else {
  // POST Requests
  $formJSON = $_POST['formData'];
  $data = json_decode($formJSON, true);

  $action = $data['action'];
  switch ($action) {
    case 'newCarpool':
      echo newCarpool($data, $pdo);
      break;
    case 'getCarpoolList':
      echo getCarpoolList($data, $pdo);
      break;
    default:
      echo "Invalid action";
      break;
  }
}


// Functions
function getCarpoolList($data, $pdo)
{

  $sql = "SELECT * FROM `account`
  JOIN `user` ON `account`.`accountID` = `user`.`accountID`
  JOIN `carpool` ON `account`.`accountID` = `carpool`.`accountID`
  ";

  $params = [];
  $whereClauses[] = "(`carpool`.`carpoolDate` > CURDATE() OR (`carpool`.`carpoolDate` = CURDATE() AND `carpool`.`carpoolTime` > CURTIME()))";

  if ($data['type'] == 'filteredList') {
    
    $filterDirection = $data['filterDirection'] === 'to' ? true : false;

    if (!empty($data['filterName'])) {
      $whereClauses[] = "`user`.`name` LIKE :filterName";
      $params[':filterName'] = '%' . $data['filterName'] . '%';
    }

    if (!empty($data['filterDirection'])) {
      $whereClauses[] = "`carpool`.`toSunway` = :filterDirection";
      $params[':filterDirection'] = $filterDirection;
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
  }

  $sql .= ' ORDER BY `carpool`.`carpoolDate` ASC, `carpool`.`carpoolTime` ASC';

  $stmt = $pdo->prepare($sql);
  $stmt->execute($params);

  $carpools = $stmt->fetchAll(PDO::FETCH_ASSOC);

  //$html =  "<h6>" . $sql . "</h6>";
  $html = "";

  if (count($carpools) > 0) {
    foreach ($carpools as $carpool) {
      $carpoolID = $carpool['carpoolID'];
      $accountID = $carpool['accountID'];

      // Get Driver Details
      $stmt = $pdo->prepare("SELECT * FROM user WHERE accountID = :accountID");
      $stmt->bindParam(':accountID', $accountID);
      $stmt->execute();
      $driver = $stmt->fetch(PDO::FETCH_ASSOC);
      $rating = number_format($driver['rating'], 1);

      // Get Vehicle Details
      $stmt = $pdo->prepare("SELECT * FROM application WHERE accountID = :accountID");
      $stmt->bindParam(':accountID', $accountID);
      $stmt->execute();
      $vehicle = $stmt->fetch(PDO::FETCH_ASSOC);

      // Get Passenger Amount
      $stmt = $pdo->prepare("SELECT COUNT(*) FROM carpool_passenger WHERE carpoolID = :carpoolID");
      $stmt->bindParam(':carpoolID', $carpoolID);
      $stmt->execute();
      $passengerAmt = $stmt->fetchColumn();

      // Get Ratings Amount
      $stmt = $pdo->prepare("SELECT COUNT(*) FROM carpool_passenger WHERE carpoolID = :carpoolID AND rating != NULL");
      $stmt->bindParam(':carpoolID', $carpoolID);
      $stmt->execute();
      $ratingsAmt = $stmt->fetchColumn();

      $html .= <<<HTML
    <div class="m-3 d-flex flex-row" style="border-radius:0.714rem">
      <!-- First Column (Driver Profile)-->
      <div class="d-flex flex-column p-3 driver-border col-2 align-items-center justify-content-center">
          <img src="images/person.png" alt="Avatar" class="shadow mb-3" style="border-radius: 50%;height: 5rem; width: 5rem;">
          <h5 style="font-weight:600; color:var(--primary)">{$driver['name']}</h5>
          <div class="d-flex justify-content-center mb-2">
            <p class="m-0" style="font-weight:600">{$rating}</p>
            <i class="bi bi-star-fill mx-1" style="color:#F6931A"></i>
            <p class="text-muted m-0" style="font-size:0.857rem; font-weight:500">({$ratingsAmt} Ratings)</p>
          </div>
        <span class="badge rounded-pill shadow px-3">{$vehicle['vehicleNo']}</span>
      </div>

      <!-- Second Column (Ticket Line)-->
      <div class="d-flex flex-column">
        <div class="half-circle flipped"></div>
        <div class="h-100 d-flex justify-content-center align-items-center">
          <div class="dashed-line"></div>
        </div>
        <div class="half-circle"></div>
      </div>

      <!-- Third Column (Carpool Details) -->
      <div class="d-flex w-100 carpool-border p-2 justify-content-center ">
        <!-- First Section -->
        <div class="col-5 row p-2 mt-4 mx-2 justify-content-center">
  HTML;

      $carpoolDay = date('l', strtotime($carpool['carpoolDate']));
      $carpoolTime = date('g:i A', strtotime($carpool['carpoolTime']));

      $html .= <<<HTML
          <!-- Date & Contact No -->
          <div class="col-6 d-flex flex-column">
            <h6>Date <i class="ms-2 bi bi-calendar-week"></i></h6>
            <p>{$carpool['carpoolDate']} ({$carpoolDay})</p>
          </div>
          <div class="col-6 d-flex flex-column">
            <h6>Contact No <i class="ms-2 bi bi-telephone-fill"></i></h6>
            <p>{$driver['phoneNo']}</p>
          </div>

          <!-- Pickup Time  & Vehicle Details -->
          <div class="col-6 d-flex flex-column ">
            <h6>Departure Time <i class="ms-2 bi bi-clock"></i></h6>
            <p>{$carpoolTime}</p>
          </div>
          <div class="col-6 d-flex flex-column">
            <h6>Vehicle Details <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="ms-2 bi bi-car-front-fill" viewBox="0 0 16 16">
                <path d="M2.52 3.515A2.5 2.5 0 0 1 4.82 2h6.362c1 0 1.904.596 2.298 1.515l.792 1.848c.075.175.21.319.38.404.5.25.855.715.965 1.262l.335 1.679c.033.161.049.325.049.49v.413c0 .814-.39 1.543-1 1.997V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.338c-1.292.048-2.745.088-4 .088s-2.708-.04-4-.088V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.892c-.61-.454-1-1.183-1-1.997v-.413a2.5 2.5 0 0 1 .049-.49l.335-1.68c.11-.546.465-1.012.964-1.261a.807.807 0 0 0 .381-.404l.792-1.848ZM3 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2m10 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2M6 8a1 1 0 0 0 0 2h4a1 1 0 1 0 0-2zM2.906 5.189a.51.51 0 0 0 .497.731c.91-.073 3.35-.17 4.597-.17 1.247 0 3.688.097 4.597.17a.51.51 0 0 0 .497-.731l-.956-1.913A.5.5 0 0 0 11.691 3H4.309a.5.5 0 0 0-.447.276L2.906 5.19Z" />
              </svg></h6>
            <p>{$vehicle['vehicleType']}, {$vehicle['vehicleColour']}</p>
          </div>
        </div>
        <!-- Line -->
        <div class="d-flex align-items-center">
          <div class="solid-line"></div>
        </div>
    HTML;
      if ($carpool['toSunway'] == 1) {
        $pickup = '<span class="badge rounded-pill shadow px-3 mx-2">' . $carpool['district'] . '</span>';
        $pickup .= '<span class="badge rounded-pill shadow px-3 mx-2">' . $carpool['neighborhood'] . '</span>';
        $destination = '<span class="badge rounded-pill shadow px-3 mx-2">' . $carpool['location'] . '</span>';
      } else {
        $pickup = '<span class="badge rounded-pill shadow px-3 mx-2">' . $carpool['location'] . '</span>';
        $destination = '<span class="badge rounded-pill shadow px-3 mx-2">' . $carpool['district'] . '</span>';
        $destination .= '<span class="badge rounded-pill shadow px-3 mx-2">' . $carpool['neighborhood'] . '</span>';
      }

      $html .= <<<HTML
        <!-- Second Section -->
        <div class="col-5 px-4 py-3">
          <div class="h-100 rounded d-flex flex-column d-flex  align-items-center p-3" style="border: 1px solid var(--secondary)">
            <h6>Pickup Area <i class="ms-2 bi bi-geo"></i></h6>
            <div class="d-flex gx-2">
              {$pickup}
            </div>
            <h3 class="my-2"><i class="bi bi-arrow-down-circle-fill"></i></h3>
            <h6>Destination <i class="ms-2 bi bi-flag"></i></i></h6>
            <div class="d-flex gx-2">
              {$destination}
            </div>
          </div>
        </div>
    HTML;

      if ($carpool['isWomenOnly'] == 1) {
        $womenOnly = '<span class="badge rounded-pill shadow px-3 mb-3" style="background-color:#FF9BBC">Women-Only</span>';
      } else {
        $womenOnly = '';
      }

      $remainingSeats = $carpool['passengerAmt'] - $passengerAmt;

      $html .= <<<HTML
        <div class="col-2 pe-3 py-3 d-flex flex-column justify-content-center align-items-center">
          {$womenOnly}
          <h1 style="font-size:3.571rem">{$remainingSeats}/{$carpool['passengerAmt']}</h1>
          <p class="text-center text-muted" style="font-size:0.929rem">SEATS REMAINING</p>
          <button type="button" class="btn btn-primary shadow px-4 mt-2" id="{$carpool['carpoolID']}">Hop On</button>
        </div>
      </div>
    </div>
    HTML;
    }
  }else{
    if($data['type'] == 'filteredList'){
      $message = 'Try changing your filters';
    }else if($data['type'] == 'allList'){
      $message = 'Currently no carpool exists';
    }

    $html .= <<<HTML
    <div class="d-flex flex-column align-items-center justify-content-center" style="height: 50vh;">
      <h1 class="text-center" style="font-size: 3rem; color: var(--primary);">No Carpool Available</h1>
      <p class="text-center text-muted" style="font-size: 1.5rem;">{$message}</p>
    </div>
    HTML;
  };


  $response = [
    'action' => 'getCarpoolList',
    'message' => 'Carpool list fetched successfully!',
    'html' => $html
  ];

  echo json_encode($response);
}

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
