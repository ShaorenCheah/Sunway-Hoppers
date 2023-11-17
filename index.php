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

    <!-- Include icon link here -->
    <title>SunwayHoppers</title>
    <link rel="icon" type="image/x-icon" href="/images/logo/tab.ico">
</head>

<body class="hero">
    <?php include './includes/header.inc.php'; ?>
    <?php include './connection.php'; ?>
    <!-- Hero -->
    <div class="min-vh-100 max-vh-100 d-flex hero">
        <div class="col-1"></div>

        <div class="col-5 d-flex justify-content-start align-items-center">
            <div>
                <div class="row">
                    <p style="font-weight: bold; font-size: 2.5rem;">Sharing <span class="highlight">Rides</span>,<br>
                        Shaping the <span class="highlight">Future</span>,<br>
                        Strengthening Our <span class="highlight">Community</span>.
                    </p>
                </div>
                <div class="row my-2">
                    <p style="font-weight: 300">
                        Introducing a new way to travel around Bandar Sunway. Make the sustainable choice by
                        hopping on a carpool with other students while earning rewards along the way.</p>
                </div>
                <div class="row">
                    <div class="col-3">
                        <button type="button" class="btn btn-primary shadow px-4" style="border-radius:25px; width: 9rem">Hop On</button>
                    </div>
                    <div class="col-3 mt-2">
                        <p style="font-weight:500">See How It Works <i class="bi bi-chevron-right" style="color: #263238"></i></p>
                    </div>
                    <div class="col-6"></div>
                </div>
            </div>
        </div>
        <div class="col-1"></div>
        <div class="col-6" style="background-image: url('./images/road.jpg'); background-size: cover; background-position: center;">
        </div>
    </div>
    <div>
        <?php include './includes/footer.inc.php'; ?>
    </div>
</body>

</html>
