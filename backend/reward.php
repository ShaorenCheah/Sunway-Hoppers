<?php
require './backend/connection.php';

//check if user is logged in and not an admin
function checkUser()
{

  if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
  }

  // if user is admin, redirect to dashboard
  if (!isset($_SESSION['user'])) {
    session_destroy();
    return false;
  } else if (($_SESSION['user']['type']) == "Admin") {
    echo <<<HTML
  <script>
    alert("You are not allowed to access this page!");
    window.location.href = "./dashboard.php?navPage=dashboard";
    </script>
HTML;
  }
  return true;
}

//fetch user points
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

//fetch rewards from database according to type
function getRewardsByType($type)
{
  global $pdo;
  $stmt = $pdo->prepare("SELECT * FROM reward WHERE type = :type AND quantity > 0 ORDER BY points ASC");
  $stmt->bindParam(':type', $type, PDO::PARAM_STR);
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// display available rewards in cards
function getCards($type)
{
  echo <<<HTML
  <div id='carouselExampleIndicators' class='carousel carousel-dark slide'>
  <div class='carousel-inner'>
HTML;

  //get rewards from database
  $rewards = getRewardsByType($type);
  $count = count($rewards);

  // if no rewards available, display message
  if ($count == 0) {
    echo "<div class='container my-5'><h3 class='text-center'>No rewards available at the moment.</h3></div>";
  }

  $rewardObjects = [];

  // convert rewards array to objects
  foreach ($rewards as $reward) {
    $rewardObjects[] = (object)$reward;
  }

  $isActive = true; // track if the tab is active
  $cardCount = 0; // track number of cards displayed

  // display rewards in cards
  for ($i = 0; $i < $count; $i += 4) {
    echo "<div class='carousel-item" . ($isActive ? " active" : "") . "'>";
    echo "<div class='container my-5 d-flex justify-content-around'>
                <div class='row'>";
    for ($j = $i; $j < $i + 4 && $j < $count; $j++) {
      $cardCount = $j + 1;
      echo <<<HTML
            <div class='col'>
            <div class='card shadow' style='width: 16rem;'>
                <img class='card-img-top' src='{$rewardObjects[$j]->img}' alt='Card image cap'>
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
      $rewardID = $rewardObjects[$j]->rewardID;
      global $loggedIn;

      // if user is not logged in, points = 0
      $userPoints = !$loggedIn ? 0 : getUserPoints();

      // display redeem button if user has enough points
      if ($loggedIn && $userPoints >= $requiredPoints) {
        $redeemBtnHtml = "<button type='submit' class='btn btn-primary shadow px-4 my-2 redeemBtn' 
        data-points='{$requiredPoints}' data-reward='{$rewardID}' data-user-points='{$userPoints}' data-account-id='{$_SESSION['user']['accountID']}'>
        Redeem</button>";
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

    $isActive = false; // set to false after the first iteration
  }

  // display carousel controls if there are more than 4 cards
  if ($cardCount > 4) {
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
  } else {
    echo "</div></div>";
  }
}
