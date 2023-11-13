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
    <!-- Hero -->
    <div class="min-vh-100 max-vh-100 d-flex hero">
        <?php include './includes/header.inc.php'; ?>
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
    <!-- Login Modal -->
    <div class="modal" tabindex="-1" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body w-100 text-center">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col"></div>
                            <div class="col-9">
                                <img src="./images/logo/modal.png" width="100" style="margin: 2rem;">
                                <h2 style="font-weight:700;">LOGIN</h2>
                                <p style="font-size: 1rem;">Please enter your student email and password</p>
                                <div class="form-floating mb-3 pb-2">
                                    <input type="email" class="form-control" id="userEmail" placeholder="">
                                    <label for="userEmail">Email Address</label>
                                </div>
                                <div class="form-floating mb-3 pb-2">
                                    <input type="password" class="form-control" id="userPwd" placeholder="">
                                    <label for="userPwd">Password</label>
                                </div>
                                <a href="#" style="text-decoration: none; color: #F6931A;">Forgot Password?</a>
                                <div>
                                    <button type="submit" class="btn btn-primary shadow px-4 m-4">Login</button>
                                </div>
                                <p>Don't have an account? <a href="#" style="text-decoration: none; color: #F6931A;" data-bs-toggle="modal" data-bs-target="#registerModal">Sign Up</a></p>
                            </div>
                            <div class="col"> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sign Up Modal -->
    <div class="modal" tabindex="-1" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-body w-100 text-center">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col d-flex align-items-center mx-2">
                                <div>
                                    <div class="row">
                                        <p style="font-weight: bold; font-size: 2.2rem; text-align:left;">
                                            Carpooling With <span class="highlight2">Purpose</span>,<br>
                                            Connecting Through <span class="highlight2">Hops</span>.<br>
                                        </p>
                                    </div>
                                    <div class="row my-2">
                                        <p style="font-weight: 300; text-align:left;">
                                            Start reducing your carbin footprint today and make a difference. Sign up now and be a part of our carpool community!</p>
                                    </div>
                                    <div class="row">
                                        <img src="./images/route.png">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card text-center shadow m-4">
                                    <div class="card-body my-3 mx-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="username" placeholder="">
                                            <label for="username">Name</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control" id="email" placeholder="">
                                            <label for="email">Email Address</label>
                                            <div class="d-flex justify-content-start mx-1">
                                                <small id="email" class="form-text text-muted">*Please register with your Sunway student imail.</small>
                                            </div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="tel" class="form-control" id="phoneNum" placeholder="">
                                            <label for="phoneNum">Phone Number</label>
                                        </div>
                                        <div class="row">
                                            <div class="col mb-3">
                                                <div class="form-floating">
                                                    <input type="date" class="form-control" id="dob" placeholder="">
                                                    <label for="dob">Date of Birth</label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-floating">
                                                    <select class="form-select" id="gender">
                                                        <option value="m">Male</option>
                                                        <option value="f">Female</option>
                                                    </select>
                                                    <label for="gender">Gender</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" id="userPwd" placeholder="">
                                            <label for="userPwd">Password</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" id="repeatPwd" placeholder="">
                                            <label for="repeatPwd">Repeat Password</label>
                                        </div>
                                        <button type="submit" class="btn btn-primary shadow px-4">Register</button>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end mx-4">
                                    <p>Already have an account? <a href="#" style="text-decoration: none; color: #F6931A;" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>