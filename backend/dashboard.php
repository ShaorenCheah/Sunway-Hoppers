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
function totalUser(){
  global $pdo;
  $stmt = $pdo->prepare('SELECT COUNT(*) FROM user');
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  return $result['COUNT(*)'];
}

// Get total number of drivers
function totalDriver(){
  global $pdo;
  $stmt = $pdo->prepare('SELECT COUNT(*) FROM account WHERE type = "Driver"');
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  return $result['COUNT(*)'];
}

// Get total number of new applications
function totalApplication(){
  global $pdo;
  $stmt = $pdo->prepare('SELECT COUNT(*) FROM application WHERE status = "New"');
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  return $result['COUNT(*)'];
}

// Get total quantity of rewards
function totalReward(){
  global $pdo;
  $stmt = $pdo->prepare('SELECT SUM(quantity) FROM reward');
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  return $result['SUM(quantity)'];
}

// Get total number of carpools
function totalCarpool(){
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
?>