<?php
session_start();
if (!isset($_SESSION['user'])) {
?>
  <script>
    alert("Please login to see your profile!");
    window.location.href = "./index.php";
  </script>
<?php
  session_destroy();
} else if (($_SESSION['user']['type']) == "Admin") {
?>
  <script>
    alert("You are not allowed to access this page!");
    window.location.href = "./dashboard.php?navPage=dashboard";
  </script>
<?php }
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
  <script src="https://kit.fontawesome.com/1870e97f2b.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <?php
  if ($_SESSION['user']['type'] == 'Driver') {
    echo '<script src="scripts/editCar.js"></script>';
  }
  ?>
  <script src="scripts/profile.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
  <link rel="stylesheet" type="text/css" href="./styles/profile.css">
  <title>SunwayHoppers</title>
  <link rel="icon" type="image/x-icon" href="images/logo/tab.ico">
  <style>
    @import url('https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css');
    @import url("https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css");
  </style>
</head>

<body>
  <?php
  if (isset($_SESSION['user'])) {
    include './includes/sessionTimeOut.inc.php';
    include './includes/notification.inc.php';
    include './includes/rating.inc.php';
  }
  include './includes/header.inc.php';
  include './includes/modals/addPicModal.inc.php';
  if ($_SESSION['user']['type'] == 'Driver') {
    include './includes/modals/editCarDetails.inc.php';
  } else {
    include './includes/modals/registerDriverModal.inc.php';
  }
  ?>
  <div class="m-5">
    <h2 class="text-center pt-5 pb-3"><b>My<span style="color:var(--secondary)"> Profile</span></b></h2>

    <!-- Ticket Section -->
    <div class="d-flex" style="border-radius:0.714rem">
      <!-- First Column (Driver Profile)-->
      <div class="driver-border d-flex flex-column align-items-center justify-content-center text-center p-3 " style="width:26%">
        <img id="profilePic" src="<?php echo $_SESSION['user']['profilePic']; ?>" alt="Avatar" class="shadow" style="border-radius: 50%; height: 5rem; width: 5rem; cursor: pointer; object-fit: cover;" data-bs-toggle="modal" data-bs-target="#profilePicModal">
        <h5 class="mt-3"><?php echo $_SESSION['user']['name'] ?></h5>
        <!--Display rating if user is a driver-->
        <?php if ($_SESSION['user']['type'] == 'Driver') { ?>
          <div class="flex-row">
            <span id="userRating"></span>
            <span class="text-muted px-1" id="ratingsAmt"></span>
          </div>
        <?php } ?>
        <span class="badge bg-primary shadow mt-2"><?php echo $_SESSION['user']['gender'] ?></span>
      </div>

      <!-- Second Column (Ticket Line)-->
      <div class="d-flex flex-column">
        <div class="half-circle flipped"></div>
        <div class="h-100 d-flex justify-content-center align-items-center">
          <div class="dashed-line"></div>
        </div>
        <div class="half-circle"></div>
      </div>

      <!-- Third Column (User Info)-->
      <div class="userInfo-border w-100 p-2 d-flex justify-content-center">
        <div class="col-6 row p-2 mt-4 mx-2 justify-content-center">
          <div class="col-12 d-flex flex-column">
            <h5>Email <i class="ms-2 bi bi-envelope-fill"></i></h5>
            <p><?php echo $_SESSION['user']['email'] ?></p>
          </div>
          <div class="col-6 d-flex flex-column">
            <h5>Contact No <i class="ms-2 bi bi-telephone-fill"></i></h5>
            <p id="userPhoneNo"></p>
          </div>
          <div class="col-6 d-flex flex-column">
            <h5>Date of Birth <i class="ms-2 bi bi-calendar-week-fill"></i></h5>
            <p id="userDOB"></p>
          </div>
        </div>

        <!-- Line -->
        <div class="d-flex align-items-center">
          <div class="solid-line"></div>
        </div>

        <!-- Fifth Column (About Me)-->
        <form id="bioForm" class="aboutMe-border col-6  p-3 d-flex flex-column justify-content-center">
          <div class="d-flex justify-content-between align-items-center mb-2">
            <h5>About Me <i class="bi bi-person-square"></i></h5>
            <button type="button" class="btn btn-primary editBtn py-1 shadow" value="true" id="editBtn">
              Edit<i class="bi bi-pencil-square" style="padding-left: 0.2rem;"></i>
            </button>

            <button type="button" name="updateBioBtn" id="updateBioBtn" class="btn btn-secondary saveBtn shadow py-1" style="display: none;">
              Save <i class=" bi bi-save" style="padding-left: 0.2rem;"></i>
            </button>
          </div>

          <div class="desc p-2">
            <textarea name="descText" id="descText" placeholder="Write something interesting about yourself..." rows="4" disabled></textarea>
            </textarea>
          </div>
        </form>
      </div>

      <!-- Account Status -->
      <div class="accStatus w-50 px-4 py-3">
        <div class="row">
          <div class="col">
            <h5>Account Status <i class="bi bi-person-badge" style="font-size:1rem"></i></h5>
          </div>
          <!-- Fetch profile status from profile.js-->
          <div class="col d-flex justify-content-end" id="accStatus">
            <!-- $html['accStatus'] -->
          </div>
          <div class="d-flex justify-content-center" id="statusImg">
            <!-- $html['statusImg'] -->
          </div>
          <div class="pt-3 d-flex justify-content-center" id="statusMsg">
            <!-- $html['statusMsg'] -->
          </div>
        </div>
      </div>
    </div>

    <hr class="my-4">
    <nav>
      <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <?php if ($_SESSION['user']['type'] == 'Driver') { ?>
          <button class="nav-link active" id="nav-request-tab" data-bs-toggle="tab" data-bs-target="#nav-request" role="tab">Carpool Requests</button>
        <?php } ?>
        <button class="nav-link <?php if ($_SESSION['user']['type'] != 'Driver') echo "active" ?>" id="nav-history-tab" data-bs-toggle="tab" data-bs-target="#nav-history" role="tab">Carpool History</button>
        <button class="nav-link" id="nav-reward-tab" data-bs-toggle="tab" data-bs-target="#nav-reward" role="tab">Rewards Claimed</button>
      </div>
    </nav>
    <div class="tab-content mb-5 shadow p-3" id="nav-tabContent">
      <?php if ($_SESSION['user']['type'] == 'Driver') { ?>
        <div class="tab-pane fade show active overflow-auto" id="nav-request" role="tabpanel" style="height:23rem;">
          <!-- Fetch from profile.js -->
        </div>
      <?php } ?>

      <div class="tab-pane fade table-responsive overflow-auto <?php if ($_SESSION['user']['type'] != 'Driver') echo "active show" ?>" id="nav-history" role="tabpanel" style="height:23rem;">
        <!-- Fetch from profile.js -->
      </div>

      <div class="tab-pane fade table-responsive overflow-auto" id="nav-reward" role="tabpanel" style="height:23rem;">
        <!-- Fetch from profile.js -->
      </div>
    </div>
    <div class="modal fade" tabindex="-1" id="modal">
      <!-- Generated upon user request-->
    </div>
  </div>
  <?php include './includes/footer.inc.php'; ?>
</body>



</html>