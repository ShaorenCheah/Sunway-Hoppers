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
    <script src="https://kit.fontawesome.com/1870e97f2b.js" crossorigin="anonymous"></script>

    <style>
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
                    <h6 class="nav-group">Home</h6>
                    <ul class="list-unstyled nav-links">
                        <?php 
                        $navPage = isset($_GET['navPage']) ? $_GET['navPage'] : 'dashboard';
                        ?>
                        <li class="<?= $navPage === 'dashboard' ? 'active' : '' ?>">
                            <i class="bi bi-geo-alt-fill"></i><a href="./dashboard.php?navPage=dashboard">Dashboard</a>
                        </li>
                        <h6 class="nav-group mt-5">Management</h6>
                        <li class="<?= $navPage === 'user' ? 'active' : '' ?>">
                            <i class="bi bi-geo-alt-fill"></i><a href="./dashboard.php?navPage=user">User</a>
                        </li>
                        <li class="<?= $navPage === 'driver' ? 'active' : '' ?>">
                            <i class="bi bi-geo-alt-fill"></i><a href="./dashboard.php?navPage=driver">Driver Applications</a>
                        </li>
                        <li class="<?= $navPage === 'carpool' ? 'active' : '' ?>">
                            <i class="bi bi-geo-alt-fill"></i><a href="./dashboard.php?navPage=carpool">Carpool Requests</a>
                        </li>
                        <li class="<?= $navPage === 'rating' ? 'active' : '' ?>">
                            <i class="bi bi-geo-alt-fill"></i><a href="./dashboard.php?navPage=rating">Ratings</a>
                        </li>
                        <li class="<?= $navPage === 'reward' ? 'active' : '' ?>">
                            <i class="bi bi-geo-alt-fill"></i><a href="./dashboard.php?navPage=reward">Rewards</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="d-flex justify-content-center">
                <button class="btn btn-primary shadow px-4 mt-4 logout " onclick="window.location.href= './includes/logout.inc.php';">Sign Out</button>
            </div>
        </div>
    </div>
    <div class="col-10">
        <div class="dashboard-container shadow p-4" style="background-color: #fff;">
            <?php
            getView($navPage);
            ?>

        </div>
    </div>

    </div>
</body>

</html>
<?php
function getView($navPage)
{
    switch ($navPage) {
        case 'user':
            include_once './includes/admin/user.inc.php';
            break;
        case 'driver':
            include_once './includes/admin/driver.inc.php';
            break;
        case 'carpool':
            include_once './includes/admin/carpool.inc.php';
            break;
        case 'rating':
            include_once './includes/admin/rating.inc.php';
            break;
        case 'reward':
            include_once './includes/admin/reward.inc.php';
            break;
        default:
            include_once './includes/admin/dashboard.inc.php';
            break;
    }
}
?>