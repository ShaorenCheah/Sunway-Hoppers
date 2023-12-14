<?php
require './backend/dashboard.php';
if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}

// redirect user if not admin
if ((($_SESSION['user']['type'] != 'Admin'))) {
?>
  <script>
    alert("You are not allowed to access this page!");
    window.location.href = "./index.php";
  </script>
<?php } ?>

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
  <link rel="stylesheet" type="text/css" href="./styles/dashboard.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://kit.fontawesome.com/1870e97f2b.js" crossorigin="anonymous"></script>
  <script src="scripts/dataTable.js"></script>

  <style>
    @import url('https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css');
    @import url("https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css");
    @import url('https://fonts.googleapis.com/css2?family=League+Spartan:wght@300;400;500;600;700&family=Open+Sans:wght@300;400;600&family=Spectral:wght@300&display=swap');
  </style>

  <!-- Include icon link here -->
  <title>SunwayHoppers</title>
  <link rel="icon" type="image/x-icon" href="/images/logo/tab.ico">


</head>

<body class="dashboard min-vh-100 max-vh-100 d-flex" style="background-color: #E8E8E8;">
  <div class="col-2">
    <div class="wrapper">
      <!-- Sidebar  -->
      <nav id="sidebar" class="">
        <div class="sidebar-header m-5 mt-4">
          <img src="./images/logo/dashboard.png" class="logo w-100">
        </div>
        <div class="mx-4">
          <h6 class="sideNav-group">Home</h6>
          <ul class="list-unstyled nav-links">
            <?php
            $navPage = isset($_GET['navPage']) ? $_GET['navPage'] : 'dashboard';
            ?>
            <li class="<?= $navPage === 'dashboard' ? 'active' : '' ?>" id="dashboard">
              <i class="bi bi-geo-alt-fill"></i><span class="navs">Dashboard</span>
            </li>
            <h6 class="sideNav-group mt-5">Management</h6>
            <li class="<?= $navPage === 'account' ? 'active' : '' ?>" id="account">
              <i class="bi bi-geo-alt-fill"></i><span class="navs">Accounts</span>
            </li>
            <li class="<?= $navPage === 'driver' ? 'active' : '' ?>" id="driver">
              <i class="bi bi-geo-alt-fill"></i><span class="navs">Driver Applications</span>
            </li>
            <li class="<?= $navPage === 'carpool' ? 'active' : '' ?>" id="carpool">
              <i class="bi bi-geo-alt-fill"></i><span class="navs">Carpool Sessions</span>
            </li>
            <li class="<?= $navPage === 'reward' ? 'active' : '' ?>" id="reward">
              <i class="bi bi-geo-alt-fill"></i><span class="navs">Rewards</span>
            </li>
          </ul>
        </div>
      </nav>
      <div class="d-flex justify-content-center">
        <button class="btn btn-primary shadow px-4 mt-5 logout " onclick="window.location.href= './includes/logout.inc.php';">Sign Out</button>
      </div>
    </div>
  </div>
  <div class="col-10">
    <div class="dashboard-container shadow p-4" style="background-color: #fff;">
      <!-- fetch dashboard view based on navPage -->
    <?php getDashboardView($navPage); ?>
    </div>
  </div>
  </div>
</body>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    redirectLi();
  });

  // redirect to page based on li id
  function redirectLi() {
    const li = [
      ["dashboard", "./dashboard.php?navPage=dashboard"],
      ["account", "./dashboard.php?navPage=account"],
      ["driver", "./dashboard.php?navPage=driver"],
      ["carpool", "./dashboard.php?navPage=carpool"],
      ["reward", "./dashboard.php?navPage=reward"]
    ]

    // loop through li elements for redirect()
    for (let i = 0; i < li.length; i++) {
      redirect(li[i][0], li[i][1]);
    }
  }

  function redirect(id, url) {
    document.getElementById(id).addEventListener("click", function() {
      window.location.href = url;
    });
  }
</script>

</html>