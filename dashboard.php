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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var navLinks = document.querySelectorAll('.nav-links li');

            navLinks.forEach(function(link) {
                link.addEventListener('click', function() {
                    // Remove the 'active' class from all links
                    navLinks.forEach(function(navLink) {
                        navLink.classList.remove('active');
                    });

                    // Add the 'active' class to the clicked link
                    link.classList.add('active');
                });
            });
        });
    </script>
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
                        <li class="active">
                            <i class="bi bi-geo-alt-fill"></i><a href="#">Dashboard</a>
                        </li>
                        <h6 class="nav-group mt-5">Management</h6>
                        <li>
                            <i class="bi bi-geo-alt-fill"></i><a href="#">User</a>
                        </li>
                        <li>
                            <i class="bi bi-geo-alt-fill"></i><a href="#">Driver Applications</a>
                        </li>
                        <li>
                            <i class="bi bi-geo-alt-fill"></i><a href="#">Carpool Requests</a>
                        </li>
                        <li>
                            <i class="bi bi-geo-alt-fill"></i><a href="#">Ratings</a>
                        </li>
                        <li>
                            <i class="bi bi-geo-alt-fill"></i><a href="#">Rewards</a>
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
            <h2>Dashboard</h2>
            <div class="row">
                <div class="col">
                    <div class="summary shadow">
                        <h5 class="text-muted mb-0">Total Users</h5>
                        <div class="row">
                            <span class="w-50">
                                <p class="summary-text">50</p>
                            </span>
                            <span class="w-50 summary-icon-orange">
                                <i class="bi bi-person-fill"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="summary shadow ">
                        <h5 class="text-muted mb-0">Total Drivers</h5>
                        <div class="row">
                            <span class="w-50">
                                <p class="summary-text">20</p>
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
                                <p class="summary-text">20</p>
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
                                <p class="summary-text">20</p>
                            </span>
                            <span class="w-50 summary-icon-green">
                                <i class="bi bi-gift-fill"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <hr style="margin-top: 2.5rem;">
            <div class="row">
                <h2 class="w-50">Carpools Today</h2>
                <span class="w-50 d-flex justify-content-end align-items-start">
                    <button class="btn btn-primary shadow px-4 date "><?php  echo date('d/m/Y') ?></button>
                </span>
                
            </div>
        </div>
    </div>

    </div>
</body>

</html>