<?php
require './backend/connection.php';

$loggedIn = true;

//check if user is logged in and not an admin
if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}

if (!isset($_SESSION['user'])) {
  $loggedIn = false;
  session_destroy();
} else if (($_SESSION['user']['type']) == "Admin") {
?>
  <script>
    alert("You are not allowed to access this page!");
    window.location.href = "./dashboard.php?navPage=dashboard";
  </script>
<?php }

function getUserPoints()
{
  global $pdo;
  $query = "SELECT rewardPoints FROM user WHERE accountID = :accountID";
  $stmt = $pdo->prepare($query);
  $stmt->bindParam(':accountID', $_SESSION['user']['accountID'], PDO::PARAM_STR);
  $stmt->execute();
  $result = $stmt->fetch();
  $points = $result['rewardPoints'];
  return $points;
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
  <link rel="stylesheet" type="text/css" href="./styles/style.css">
  <link rel="stylesheet" type="text/css" href="./styles/reward.css">
  <script src="https://kit.fontawesome.com/1870e97f2b.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <link rel="icon" type="image/x-icon" href="/images/logo/tab.ico">


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
      <div class="row position-relative">
        <nav class="rewardTabs w-100">
          <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-fnb-tab" data-bs-toggle="tab" data-bs-target="#nav-fnb" role="tab">Food & Beverages</button>
            <button class="nav-link" id="nav-petrol-tab" data-bs-toggle="tab" data-bs-target="#nav-petrol" role="tab">Petrol</button>
            <button class="nav-link" id="nav-originals-tab" data-bs-toggle="tab" data-bs-target="#nav-originals" role="tab">Sunway Originals</button>
          </div>
        </nav>
        <div class="carrots">
          <h3 class="position-absolute fixed-bottom d-flex justify-content-end">
            <span id="userPoints"><?php
                                  if (!$loggedIn) {
                                    echo "0";
                                  } else {
                                    echo getUserPoints();
                                  }
                                  ?></span>
            <i class="fa-solid fa-carrot"></i>
          </h3>
        </div>
      </div>
      <div class="tab-content mb-5 shadow" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-fnb" role="tabpanel">
          <?php
          $type = "fnb";
          getCards($type, $pdo) ?>
        </div>
        <div class="tab-pane fade" id="nav-petrol" role="tabpanel">
          <?php
          $type = "petrol";
          getCards($type, $pdo) ?>
        </div>
        <div class="tab-pane fade" id="nav-originals" role="tabpanel">
          <?php
          $type = "originals";
          getCards($type, $pdo) ?>
        </div>
        <div class="mb-4">
          <p class="text-muted text-center">The digital voucher code can be viewed under "Profile" section upon redemption </p>
        </div>
      </div>
    </div>
    <script>
      var userPoints; // Declare userPoints in a wider scope
      var acountID;

      $(document).ready(function() {
        // Use a class selector for the click event
        $('.redeemBtn').click(function() {
          var requiredPoints = $(this).data('points');
          userPoints = <?php echo json_encode(getUserPoints()); ?>;
          accountID = <?php echo json_encode($_SESSION['user']['accountID']); ?>;
          var pointData = {
            requiredPoints: requiredPoints,
            userPoints: userPoints,
            accountID: accountID,
          }
          redeemReward(pointData);
        });
      });

      function redeemReward(pointData) {
        var confirmation = confirm("Are you sure you want to redeem this reward?");
        if (confirmation) {
          var formData = new FormData();
          formData.append("formData", JSON.stringify(pointData));
          fetch("./backend/redeemReward.php", {
              method: "POST",
              body: formData,
            })
            .then((response) => {
              console.log(response);
              if (!response.ok) {
                throw new Error("Network response was not ok");
              }
              return response.json();
            })
            .then((data) => {
              if (data.success) {
                alert(data.message);
                window.location.reload();
              } else {
                alert(data.message);
              }
            })
            .catch((error) => {
              console.error("Error during redemption:", error);
              alert("Error occurred during redemption");
            });
        }
      }
    </script>

</body>

</html>

<?php
function getRewardsByType($type, $pdo)
{
  $stmt = $pdo->prepare("SELECT * FROM reward WHERE type = :type");
  $stmt->bindParam(':type', $type, PDO::PARAM_STR);
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getCards($type, $pdo)
{
  $rewards = getRewardsByType($type, $pdo);
  $count = count($rewards);
  global $loggedIn;

  echo "
    <div id='carouselExampleIndicators' class='carousel carousel-dark slide'>
        <div class='carousel-inner'>";

  $isActive = true; // Variable to track if the item is active

  $rewardObjects = [];

  foreach ($rewards as $reward) {
    $rewardObjects[] = (object)$reward;
  }


  for ($i = 0; $i < $count; $i += 4) {
    echo "<div class='carousel-item" . ($isActive ? " active" : "") . "'>";
    echo "<div class='container my-5 d-flex justify-content-around'>
                <div class='row'>";
    for ($j = $i; $j < $i + 4 && $j < $count; $j++) {
      echo <<<HTML
            <div class='col'>
            <div class='card shadow' style='width: 16rem;'>
                <img class='card-img-top' src='/{$rewardObjects[$j]->img}' alt='Card image cap'>
                <div class='card-body'>
                    <div class='row'>
                        <div style="width: 70%; padding-right: 0rem;">
                            <h5 class='card-title'>{$rewardObjects[$j]->rewardName}</h5>
                        </div>
                        <div class='d-flex justify-content-end align-items-start p-0' style="width: 30%">
                            <p>{$rewardObjects[$j]->points}<i class='fa-solid fa-carrot'></i></p>
                        </div>
                    </div>
                    <div class='description-container' style='height: 7.5rem; overflow: hidden;'>
                    <p class='card-text' style='text-align: justify;'>{$rewardObjects[$j]->description}</p>
                    </div>
                    <div class='d-flex justify-content-center'>
HTML;
      $requiredPoints = $rewardObjects[$j]->points;
      $userPoints = getUserPoints();

      if ($loggedIn && $userPoints >= $requiredPoints) {
        $redeemBtnHtml = "<button type='submit' class='btn btn-primary shadow px-4 my-2 redeemBtn' data-points='{$requiredPoints}'>Redeem</button>";
      } else {
        $redeemBtnHtml = "<button type='submit' class='btn btn-primary shadow px-4 my-2' disabled style='background-color: var(--sub); border: none;'>Redeem</button>";
      }

      echo <<<HTML
                        {$redeemBtnHtml}
                    </div>
                </div>
            </div>
        </div> 
        HTML;
    }
    echo "    
        </div>
    </div>
</div>";

    $isActive = false; // Set to false after the first iteration
  }

  echo <<<HTML
</div>
<button class='carousel-control-prev d-flex justify-content-start mx-5' type='button' data-bs-target='#carouselExampleIndicators' data-bs-slide='prev'>
    <span class='carousel-control-prev-icon' aria-hidden='true'></span>
    <span class='visually-hidden'>Previous</span>
</button>
<button class='carousel-control-next d-flex justify-content-end  mx-5' type='button' data-bs-target='#carouselExampleIndicators' data-bs-slide='next'>
    <span class='carousel-control-next-icon' aria-hidden='true'></span>
    <span class='visually-hidden'>Next</span>
</button>
</div>
HTML;
}
?>