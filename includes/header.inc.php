<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<link rel="stylesheet" type="text/css" href="./styles/navbar.css">
<link rel="icon" type="image/x-icon" href="/images/logo/tab.ico">

<style>
  @import url('https://fonts.googleapis.com/css2?family=League+Spartan:wght@300;400;500;600;700&family=Open+Sans:wght@300;400;600&family=Spectral:wght@300&display=swap');
</style>
<script src="scripts/login.js"></script>
<script src="scripts/register.js"></script>
<?php
include './includes/modals/loginModal.inc.php';
include './includes/modals/registerModal.inc.php';
?>

<nav class="navbar shadow container w-100 my-3 mb-lg-0 py-2 px-5 header">
  <div class="col d-flex justify-content-start">
    <a class="navbar-brand" href="/index.php">
      <img src="images/logo/nav.png" width="100">
    </a>
  </div>

  <ul class="col navbar-nav w-100 d-flex flex-row justify-content-around">
    <li class="nav-item <?php echo ($_SERVER['PHP_SELF'] == '/index.php') ? 'active' : ''; ?>">
      <a class="nav-link" href="index.php">Home</a>
    </li>
    <li class="nav-item <?php echo ($_SERVER['PHP_SELF'] == '/findCarpool.php') ? 'active' : ''; ?>">
      <a class="nav-link" <?php
                          if (isset($_SESSION['user'])) {
                            echo 'href="findCarpool.php"';
                          } else {
                            echo 'href="" onclick="alert(\'Please log in first to view available carpool.\');"';
                            echo 'href="" data-bs-toggle="modal" data-bs-target="#loginModal"';
                          }
                          ?>>
        <i class="bi bi-geo-alt-fill"></i> Find Carpool</a>

    </li>
    <li class="nav-item <?php echo ($_SERVER['PHP_SELF'] == '/reward.php') ? 'active' : ''; ?>">
      <a class="nav-link" href="reward.php">Rewards</a>
    </li>
    <?php
    if (isset($_SESSION['user'])) {
    ?>
      <li class="nav-item <?php echo ($_SERVER['PHP_SELF'] == '/profile.php') ? 'active' : ''; ?>">
        <a class="nav-link" href="profile.php">Profile</a>
      </li>
    <?php } ?>
  </ul>

  <div class="col d-flex justify-content-end">
    <?php
    if (!isset($_SESSION['user'])) {
      $html = <<<HTML
      <button type="button" class="btn btn-green-outline shadow login px-4" onclick="showLoginModal()">Login</button>
      <button type="button" class="btn btn-primary shadow login px-4 ms-2" onclick="showRegisterModal()">Sign Up</button>
      HTML;
      echo $html;
    } else if (($_SESSION['user']['type'] == 'Admin')) {
    ?>
      <script>
        window.location.href = "./dashboard.php?navPage=dashboard";
      </script>
    <?php
    } else { ?>
      <button type="button" class="btn btn-primary btn-circle shadow profile d-flex justify-content-center align-items-center" 
      onclick="window.location.href = './includes/logout.inc.php'"><i class="bi bi-box-arrow-in-right" style="height:60%"></i></button>
    <?php
    }
    ?>
  </div>
</nav>