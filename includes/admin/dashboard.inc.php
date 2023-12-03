<?php
require './backend/connection.php';
$stmt = $pdo->prepare('SELECT COUNT(*) FROM user');
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$userCount = $result['COUNT(*)'];

$stmt = $pdo->prepare('SELECT COUNT(*) FROM account WHERE type = "Driver"');
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$driverCount = $result['COUNT(*)'];

$stmt = $pdo->prepare('SELECT COUNT(*) FROM application WHERE status = "New"');
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$newApplicationCount = $result['COUNT(*)'];

// Get total quantity of rewards
$stmt = $pdo->prepare('SELECT SUM(quantity) FROM reward');
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$rewardCount = $result['SUM(quantity)'];

// Get total number of carpools
$stmt = $pdo->prepare('SELECT COUNT(*) FROM carpool');
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$carpoolCount = $result['COUNT(*)'];

?>
<h2>Dashboard</h2>
<div class="row">
  <div class="col">
    <div class="summary shadow">
      <h5 class="text-muted mb-0">Total Users</h5>
      <div class="row">
        <span class="w-50">
          <p class="summary-text"><?php echo $userCount ?></p>
        </span>
        <span class="w-50 summary-icon-orange">
          <i class="bi bi-person-fill"></i>
        </span>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="summary shadow">
      <h5 class="text-muted mb-0">Total Drivers</h5>
      <div class="row">
        <span class="w-50">
          <p class="summary-text"><?php echo $driverCount ?></p>
        </span>
        <span class="w-50 summary-icon-green">
          <i class="bi bi-person-badge-fill"></i></span>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="summary shadow">
      <h5 class="text-muted mb-0">Total Carpools</h5>
      <div class="row">
        <span class="w-50">
          <p class="summary-text"><?php echo $carpoolCount?></p>
        </span>
        <span class="w-50 summary-icon-orange">
          <i class="fa-solid fa-car"></i>
        </span>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="summary shadow">
      <h5 class="text-muted mb-0">Rewards Left</h5>
      <div class="row ">
        <span class="w-50">
          <p class="summary-text"><?php echo $rewardCount?></p>
        </span>
        <span class="w-50 summary-icon-green">
          <i class="bi bi-gift-fill"></i>
        </span>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="summary shadow">
      <h5 class="text-muted mb-0">New Applicants</h5>
      <div class="row ">
        <span class="w-50">
          <p class="summary-text"><?php echo $newApplicationCount ?></p>
        </span>
        <span class="w-50 summary-icon-orange">
          <i class="bi bi-file-earmark-text-fill"></i>
        </span>
      </div>
    </div>
  </div>
</div>
<hr style="margin-top: 2.5rem;">
<div class="row">
  <h2 class="w-50">Carpools Today</h2>
  <span class="w-50 d-flex justify-content-end align-items-start">
    <button class="btn btn-primary shadow px-4 date ">
      <?php date_default_timezone_set("Asia/Kuala_Lumpur");
      echo date('d/m/Y');
      ?></button>
  </span>
</div>