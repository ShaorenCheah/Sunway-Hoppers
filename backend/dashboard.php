<?php
require './backend/connection.php';

function getDashboardView($navPage)
{
  switch ($navPage) {
    case 'account':
      include_once './includes/admin/account.inc.php';
      break;
    case 'driver':
      include_once './includes/admin/driver.inc.php';
      break;
    case 'carpool':
      include_once './includes/admin/carpool.inc.php';
      break;
    case 'reward':
      include_once './includes/admin/reward.inc.php';
      break;
    default:
      include_once './includes/admin/dashboard.inc.php';
      break;
  }
}

// dashboard.inc.php
// Get total number of users
function totalUser()
{
  global $pdo;
  $stmt = $pdo->prepare('SELECT COUNT(*) FROM user');
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  return $result['COUNT(*)'];
}

// Get total number of drivers
function totalDriver()
{
  global $pdo;
  $stmt = $pdo->prepare('SELECT COUNT(*) FROM account WHERE type = "Driver"');
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  return $result['COUNT(*)'];
}

// Get total number of new applications
function totalApplication()
{
  global $pdo;
  $stmt = $pdo->prepare('SELECT COUNT(*) FROM application WHERE status = "New"');
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  return $result['COUNT(*)'];
}

// Get total quantity of rewards
function totalReward()
{
  global $pdo;
  $stmt = $pdo->prepare('SELECT SUM(quantity) FROM reward');
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  return $result['SUM(quantity)'];
}

// Get total number of carpools
function totalCarpool()
{
  global $pdo;
  $stmt = $pdo->prepare('SELECT COUNT(*) FROM carpool');
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  return $result['COUNT(*)'];
}

// driver.inc.php
// Generate application tables based on status
function generateAppTable($tableID)
{
  global $pdo;
  $tableHTML = <<<HTML
    <div class="table-container">
      <table id="$tableID" class="dashboardTable" style="width:100%">
          <thead>
              <tr>
                  <th>Driver Details</th>
                  <th>Driver Name</th>
                  <th>Vehicle Type</th>
                  <th>Vehicle Colour</th>
                  <th>Vehicle Rules</th>
                  <th>Credentials</th>
                  <th>Action</th>
              </tr>
          </thead>
          <tbody>
HTML;
  echo $tableHTML;

  switch ($tableID) {
    case "newAppTable":
      $status = "New";
      break;
    case "approvedAppTable":
      $status = "Approved";
      break;
    case "rejectedAppTable":
      $status = "Rejected";
      break;
    default:
      $status = "New";
      break;
  }

  $stmt = $pdo->prepare(
    'SELECT application.*, account.email, user.name, user.phoneNo
        FROM application
        JOIN user ON application.accountID = user.accountID
        JOIN account ON user.accountID = account.accountID
        WHERE application.status = :status;'
  );
  $stmt->bindParam(':status', $status, PDO::PARAM_STR);
  $stmt->execute();

  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

  foreach ($result as $application) {
    $applicationID = $application['applicationID'];
    $vehicleNo = $application['vehicleNo'];
    $vehicleType = $application['vehicleType'];
    $vehicleColour = $application['vehicleColour'];
    $driverCredentials = $application['driverCredentials'];
    $vehicleRules = $application['vehicleRules'];
    $email = $application['email'];
    $name = $application['name'];
    $phoneNo = $application['phoneNo'];
    $actionHTML = getActions($status, $applicationID);

    echo <<<HTML
        <tr data-child-name='{$name}' data-child-phone='{$phoneNo}' data-child-email='{$email}' 
        data-child-vehicle='{$vehicleNo}'>
        <td class='dt-control'></td>
        <td>{$name}</td>
        <td>{$vehicleType}</td>
        <td>{$vehicleColour}</td>
        <td>{$vehicleRules}</td>
        <td><a href ='{$driverCredentials}'>Download</a></td>
        <td>{$actionHTML}</td>
    </tr>
    HTML;
  }

  echo <<<HTML
        </tbody>
    </table>
  </div>
HTML;
}

// Get action buttons based on table 
function getActions($status, $applicationID)
{
  if ($status === "New") {
    return <<<HTML
        <div class="row m-0">
            <div class="col">
                <i class="bi bi-check-square-fill m-0 p-0" style="color: var(--sub); cursor: pointer;" onclick="approveApplication('$applicationID')"></i>
            </div>
            <div class="col">
                <i class="bi bi-x-square-fill" style="color: red; cursor: pointer;" onclick="rejectApplication('$applicationID')"></i>
            </div>
        </div>
        HTML;
  } else if ($status === "Approved") {
    return <<<HTML
        <i class="bi bi-x-square-fill" style="color: red; cursor: pointer;" onclick="rejectApplication('$applicationID')"></i>
        HTML;
  } else if ($status === "Rejected") {
    return <<<HTML
        <i class="bi bi-check-square-fill m-0 p-0" style="color: var(--sub); cursor: pointer;" onclick="approveApplication('$applicationID')"></i>
        HTML;
  }
}

// carpool.inc.php
// Generate carpool tables based on status
function generateCarpoolTable($tableID)
{
  global $pdo;
  $tableHTML = <<<HTML
    <div class="table-container">
      <table id="$tableID" class="dashboardTable" style="width:100%">
          <thead>
            <tr>
              <th>Driver Details</th>
              <th>Car Number</th>
              <th>Carpool Date</th>
              <th>Carpool Time</th>
              <th>Destination</th>
              <th>Pick-Up Location</th>
              <th>No. of Passengers</th>
          </thead>
          <tbody>
HTML;
  echo $tableHTML;

  $statusQuery = 'SELECT 
  application.*, 
  account.email, 
  user.name, user.phoneNo, 
  carpool.*,
    (
      SELECT COUNT(*)
      FROM carpool_passenger
      WHERE carpool_passenger.carpoolID = carpool.carpoolID
      AND carpool_passenger.isApproved = 1
    ) as "numOfPassengers"
      FROM carpool
      JOIN user ON carpool.accountID = user.accountID
      JOIN account ON carpool.accountID = account.accountID
      JOIN application ON user.accountID = application.accountID
      WHERE carpool.status = :status;';

  $isWomenQuery = 'SELECT 
   application.*, 
   account.email, 
   user.name, user.phoneNo, 
   carpool.*,
     (
       SELECT COUNT(*)
       FROM carpool_passenger
       WHERE carpool_passenger.carpoolID = carpool.carpoolID
       AND carpool_passenger.isApproved = 1
     ) as "numOfPassengers"
       FROM carpool
       JOIN user ON carpool.accountID = user.accountID
       JOIN account ON carpool.accountID = account.accountID
       JOIN application ON user.accountID = application.accountID
       WHERE carpool.status = "Active"
       AND carpool.isWomenOnly = "1";';

  switch ($tableID) {
    case "activeCarpoolTable":
      $status = "Active";
      $stmt = $pdo->prepare($statusQuery);
      $stmt->bindParam(':status', $status, PDO::PARAM_STR);
      break;
    case "completedCarpoolTable":
      $status = "Completed";
      $stmt = $pdo->prepare($statusQuery);
      $stmt->bindParam(':status', $status, PDO::PARAM_STR);
      break;
    case "womenCarpoolTable":
      $stmt = $pdo->prepare($isWomenQuery);
      break;
    default:
      break;
  }

  $stmt->execute();

  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

  foreach ($result as $carpool) {
    $vehicleNo = $carpool['vehicleNo'];
    $vehicleColour = $carpool['vehicleColour'];
    $vehicleType = $carpool['vehicleType'];
    $email = $carpool['email'];
    $name = $carpool['name'];
    $phoneNo = $carpool['phoneNo'];
    $date = $carpool['carpoolDate'];
    $time = $carpool['carpoolTime'];
    $passenger = $carpool['numOfPassengers'];
    $destination = $carpool['location'];
    $district = $carpool['district'];
    $neighborhood = $carpool['neighborhood'];

    echo <<<HTML
        <tr data-child-name='{$name}' data-child-phone='{$phoneNo}' data-child-email='{$email}' 
        data-child-vehicle='{$vehicleColour} {$vehicleType}'>
        <td class='dt-control'></td>
        <td>{$vehicleNo}</td>
        <td>{$date}</td>
        <td>{$time}</td>
        <td>{$destination}</td>
        <td>{$district}, {$neighborhood}</td>
        <td>{$passenger}</td>
    </tr>
    HTML;
  }

  echo <<<HTML
        </tbody>
    </table>
  </div>
HTML;
}
