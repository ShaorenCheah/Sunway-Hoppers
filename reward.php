<?php
require './backend/connection.php';
require './backend/reward.php';

//check if user is logged in and redirect if an admin
$loggedIn = checkUser();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href='https://fonts.googleapis.com/css?family=League Spartan' rel='stylesheet'>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="./styles/style.css">
  <link rel="stylesheet" type="text/css" href="./styles/reward.css">
  <script src="https://kit.fontawesome.com/1870e97f2b.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <link rel="icon" type="image/x-icon" href="images/logo/tab.ico">

  <!-- Include icon link here -->
  <title>SunwayHoppers</title>
</head>

<body>
  <header class="w-100 d-flex justify-content-center">
    <?php include './includes/header.inc.php'; ?>
    <div class="container">
      <div>
        <h2 class="text-center my-5"><b>List of <span style="color:var(--secondary)">Reward</span> Vouchers</b></h2>
      </div>
      <!-- reward tabs -->
      <div class="row position-relative">
        <nav class="rewardTabs w-100">
          <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-fnb-tab" data-bs-toggle="tab" data-bs-target="#nav-fnb" role="tab">Food & Beverages</button>
            <button class="nav-link" id="nav-petrol-tab" data-bs-toggle="tab" data-bs-target="#nav-petrol" role="tab">Petrol</button>
            <button class="nav-link" id="nav-originals-tab" data-bs-toggle="tab" data-bs-target="#nav-originals" role="tab">Sunway Originals</button>
          </div>
        </nav>
        <!-- display user points -->
        <div class="carrots">
          <h3 class="position-absolute fixed-bottom d-flex justify-content-end">
            <span id="userPoints">
              <?php
              if (!$loggedIn) {
                echo "0";
              } else {
                echo getUserPoints();
              }
              ?>
            </span>
            <i class="fa-solid fa-carrot"></i>
          </h3>
        </div>
      </div>
      <!-- display rewards based on tab -->
      <div class="tab-content mb-5 shadow" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-fnb" role="tabpanel">
          <?php getCards("fnb") ?>
        </div>
        <div class="tab-pane fade" id="nav-petrol" role="tabpanel">
          <?php getCards("petrol") ?>
        </div>
        <div class="tab-pane fade" id="nav-originals" role="tabpanel">
          <?php getCards("originals") ?>
        </div>
        <div class="mb-4">
          <p class="text-muted text-center">The digital voucher code can be viewed under "Profile" section upon redemption </p>
        </div>
      </div>
    </div>
    <script src="./scripts/redeemReward.js"></script>
  </header>
</body>

</html>