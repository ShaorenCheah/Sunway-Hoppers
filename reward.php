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
    <link rel="icon" type="image/x-icon" href="/images/logo/tab.ico">


    <!-- Include icon link here -->
    <title>SunwayHoppers</title>
</head>

<body>
    <header class="w-100 d-flex justify-content-center">
        <?php include './includes/header.inc.php'; ?>
    </header>
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
                <h3 class="position-absolute fixed-bottom d-flex justify-content-end">1000
                    <i class="fa-solid fa-carrot"></i>
                </h3>
            </div>
        </div>
        <div class="tab-content mb-5" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-fnb" role="tabpanel">
                <div id="carouselExampleIndicators" class="carousel carousel-dark slide">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="container my-5 d-flex justify-content-around">
                                <div class="row">
                                    <div class="col">
                                        <div class="card" style="width: 16rem;">
                                            <img class="card-img-top" src="/images/rewards/fnb1.png" alt="Card image cap">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col">
                                                        <h5 class="card-title">Tealive</h5>
                                                    </div>
                                                    <div class="col d-flex justify-content-end align-items-center">
                                                        <p>1000<i class="fa-solid fa-carrot"></i></p>
                                                    </div>
                                                </div>
                                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card" style="width: 16rem;">
                                            <img class="card-img-top" src="/images/rewards/fnb1.png" alt="Card image cap">
                                            <div class="card-body">
                                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card" style="width: 16rem;">
                                            <img class="card-img-top" src="/images/rewards/fnb1.png" alt="Card image cap">
                                            <div class="card-body">
                                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card" style="width: 16rem;">
                                            <img class="card-img-top" src="/images/rewards/fnb1.png" alt="Card image cap">
                                            <div class="card-body">
                                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="carousel-item">
                            <div class="container my-5 d-flex justify-content-around">
                                <div class="row">
                                    <div class="col">
                                        <div class="card" style="width: 16rem;">
                                            <img class="card-img-top" src="/images/rewards/fnb1.png" alt="Card image cap">
                                            <div class="card-body">
                                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card" style="width: 16rem;">
                                            <img class="card-img-top" src="/images/rewards/fnb1.png" alt="Card image cap">
                                            <div class="card-body">
                                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card" style="width: 16rem;">
                                            <img class="card-img-top" src="/images/rewards/fnb1.png" alt="Card image cap">
                                            <div class="card-body">
                                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev d-flex justify-content-start mx-5" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next d-flex justify-content-end  mx-5" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>

            </div>
            <div class="tab-pane fade" id="nav-petrol" role="tabpanel">...</div>
            <div class="tab-pane fade" id="nav-originals" role="tabpanel">...</div>
            <div class="mb-4">
                <p class="text-muted text-center">The digital voucher code can be viewed under "Profile" section upon redemption </p>
            </div>
        </div>

</body>

</html>