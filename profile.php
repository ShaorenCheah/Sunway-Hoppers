<?php
require './backend/connection.php';

//check if user is logged in and not an admin
if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}

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


$edit = true;

//fetch user profile picture and other details
$stmt = $pdo->prepare('SELECT profilePic, phoneNo, dob, bio, rating FROM user WHERE accountID = :accountID');
$stmt->bindParam(':accountID', $_SESSION['user']['accountID']);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

$profPic = $result['profilePic'];
$phoneNo = $result['phoneNo'];
$dob = $result['dob'];
$bio = $result['bio'];
$rating = $result['rating'];

//check if user has a profile picture
if ($profPic == null) {
  $profPic = 'images/person.png';
}

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
  <script src="scripts/dataTable.js"></script>
  <script src="scripts/dateFormatter.js"></script>
  <script src="scripts/editCar.js"></script>
  <script src="scripts/profile.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
  <link rel="stylesheet" type="text/css" href="./styles/profile.css">
  <title>SunwayHoppers</title>
  <style>
    @import url('https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css');
    @import url("https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css");
  </style>
</head>

<body>
  <?php
  include './includes/header.inc.php';
  ?>
  <div class="m-5">
    <h2 class="text-center pt-5 pb-3"><b>My<span style="color:var(--secondary)"> Profile</span></b></h2>

    <!-- Ticket Section -->
    <div class="d-flex" style="border-radius:0.714rem">
      <!-- First Column (Driver Profile)-->
      <div class="driver-border d-flex flex-column align-items-center justify-content-center text-center p-3 " style="width:26%">
        <img src="<?php echo $profPic ?>" alt="Avatar" class="shadow" style="border-radius: 50%; height: 5rem; width: 5rem; cursor: pointer; object-fit: cover;" data-bs-toggle="modal" data-bs-target="#profilePicModal">
        <h5 class="mt-3"><?php echo $_SESSION['user']['name'] ?></h5>
        <!--Display rating if user is a driver-->
        <?php if ($_SESSION['user']['type'] == 'Driver') { ?>
          <div class="flex-row">
            <span><?php echo $rating ?> <i class="bi bi-star-fill"></i></span>
            <span class="text-muted px-1">(12 Ratings)</span>
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
            <p><?php echo $phoneNo ?></p>
          </div>
          <div class="col-6 d-flex flex-column">
            <h5>Date of Birth <i class="ms-2 bi bi-calendar-week-fill"></i></h5>
            <p><?php echo date('F j, Y', strtotime($dob)); ?></p>
          </div>
        </div>

        <!-- Line -->
        <div class="d-flex align-items-center">
          <div class="solid-line"></div>
        </div>

        <!-- Fifth Column (About Me)-->
        <form id="bioForm" method="post" action="./backend/updateBio.php" class="aboutMe-border col-6  p-3 d-flex flex-column justify-content-center">
          <div class="d-flex justify-content-between align-items-center mb-2">
            <h5>About Me <i class="bi bi-person-square"></i></h5>
            <button class="btn btn-primary editBtn py-1 shadow" id="editBtn">
              Edit<i class="bi bi-pencil-square" style="padding-left: 0.2rem;"></i>
            </button>
          </div>

          <button type="submit" name="updateBioBtn" id="updateBioBtn" class="btn btn-secondary saveBtn shadow py-1" style="display: none;">
            Save <i class=" bi bi-save" style="padding-left: 0.2rem;"></i>
          </button>

          <div class="desc">
            <textarea name="descText" id="descText" placeholder="Write something interesting about yourself..." <?php echo $edit ? 'disabled' : ''; ?> rows="4"><?php echo $bio ?></textarea>
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

    <hr class="mx-5">
    <nav class="mx-5 mt-4">
      <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <?php if ($_SESSION['user']['type'] == 'Driver') { ?>
          <button class="nav-link active" id="nav-request-tab" data-bs-toggle="tab" data-bs-target="#nav-request" role="tab">Carpool Requests</button>
        <?php } ?>
        <button class="nav-link <?php if ($_SESSION['user']['type'] != 'Driver') echo "active" ?>" id="nav-history-tab" data-bs-toggle="tab" data-bs-target="#nav-history" role="tab">Carpool History</button>
        <button class="nav-link" id="nav-reward-tab" data-bs-toggle="tab" data-bs-target="#nav-reward" role="tab">Rewards Claimed</button>
      </div>
    </nav>
    <?php
    if ($_SESSION['user']['type'] == 'Driver') {
      $html = "";
      $html . <<<HTML
      <div class="tab-content shadow mx-5 px-4 pb-4" id="nav-tabContent">
          <div class="tab-pane fade show active" id="nav-request" role="tabpanel">
              <table id="rewardTable" class="" style="width:100%">
                  <thead>
                      <tr>
                          <th>Name</th>
                          <th>Description</th>
                          <th>Points</th>
                          <th>Image</th>
                          <th>Type</th>
                          <th>Quantity</th>
                      </tr>
                  </thead>
              <tbody> 
      HTML;
      $stmt = $pdo->prepare('SELECT * FROM reward');
      $stmt->execute();

      // Fetch the result
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

      foreach ($result as $reward) {
        $rewardName = $reward['rewardName'];
        $desc = $reward['description'];
        $points = $reward['points'];
        $img = $reward['img'];
        $type = $reward['type'];
        $quantity = $reward['quantity'];

        $html . <<<HTML
                    <tr>
                      <td>$rewardName</td>
                      <td>$desc</td>
                      <td>$points</td>
                      <td>$img</td>
                      <td>$type</td>
                      <td>$quantity</td>
                    </tr>
            </tbody>
        </table>
        </div>
        HTML;
      }
    }
    ?>

    <div class="tab-pane fade" id="nav-history" role="tabpanel">
      Hi
    </div>

    <div class="tab-pane fade" id="nav-reward" role="tabpanel">
      Hello
    </div>

    <?php
    include './includes/modals/addPicModal.inc.php';
    include './includes/modals/registerDriverModal.inc.php';
    if ($_SESSION['user']['type'] == 'Driver') {
      include './includes/modals/editCarDetails.inc.php';
    }
    ?>
</body>
<script>
  var edit = <?php echo json_encode($edit); ?>;

  document.getElementById('editBtn').addEventListener('click', function() {
    edit = !edit;
    // add disabled to textarea if edit is false
    document.getElementById('descText').disabled = edit;
    document.getElementById('updateBioBtn').style.display = edit ? 'none' : '';
    document.getElementById('editBtn').style.display = edit ? '' : 'none';
  });

  initializeDataTable('#rewardTable', '#txtSearchRewards');
</script>


</html>