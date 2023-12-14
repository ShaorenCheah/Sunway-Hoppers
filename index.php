<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href='https://fonts.googleapis.com/css?family=League Spartan' rel='stylesheet'>
  <link rel="stylesheet" type="text/css" href="./styles/style.css">

  <!-- Include icon link here -->
  <title>SunwayHoppers</title>
  <link rel="icon" type="image/x-icon" href="images/logo/tab.ico">
  <script>
    function scrollToHowItWorks() {
      // Scroll to the "How It Works" section
      document.getElementById('howItWorksSection').scrollIntoView({
        behavior: 'smooth'
      });
    }
  </script>
</head>
<style>
  #sponsorCarousel img {
    height: 200px;
    width: auto;
    object-fit: contain;
  }
</style>

<body class="hero">
  <?php
  if(isset($_SESSION)){
    session_start();
  }
  include './includes/header.inc.php';
  include './backend/indexCards.php';
  include './includes/notification.inc.php';
  include './includes/rating.inc.php';
  ?>

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
          <p style="font-weight: 300; font-size: 1.2rem; text-align: justify;">
            Introducing a new way to travel around Bandar Sunway. Make the sustainable choice by
            hopping on a carpool with other students while earning rewards along the way.</p>
        </div>
        <div class="row">
          <div class="col-3">
            <?php
            if (!isset($_SESSION['user'])) {
              echo '<button type="button" class="btn btn-primary shadow px-4" style="border-radius:25px; width: 9rem" data-bs-toggle="modal" data-bs-target="#loginModal">Hop On</button>';
            } else {
              echo '<button type="button" class="btn btn-primary shadow px-4" style="border-radius:25px; width: 9rem" onclick="window.location.href=\'findCarpool.php\'">Hop On</button>';
            }
            ?>
          </div>
          <div class="col-3 mt-2">
            <p style="font-weight:500; cursor: pointer" onclick="scrollToHowItWorks()">See How It Works <i class="bi bi-chevron-right" style="color: #263238"></i></p>
          </div>
          <div class="col-6"></div>
        </div>
      </div>
    </div>
    <div class="col-1"></div>
    <div class="col-5" style="background-image: url('./images/road.jpg'); background-size: cover; background-position: center;">
    </div>
  </div>
  <div class="row m-5 p-5" style="border: 2px solid var(--primary); border-radius: 0.5rem">
    <div class="col">
      <img src="./images/sdg.png" class="img-fluid">
    </div>
    <div class="col m-4">
      <p style="font-weight: bold; font-size: 2.5rem;">Bring An Impact And
        <span class="highlight">Contribute</span> To Society.
      </p>
      <p style="font-weight: 300; font-size: 1.2rem; text-align: justify;">
        On our platform, we're driving change for a sustainable future, aligning with Sustainable Development Goal 11, Target 11.2. Reduce your carbon footprint and hop on a carpool.
        <br><br>Join our community to make a difference.
      </p>
    </div>
  </div>
  <div id="howItWorksSection" class="pt-4 mx-5 text-center min-vh-100 max-vh-100">
    <p class="p-0 m-0" style="font-weight: bold; font-size: 2.5rem;">
      <span class="highlight">How</span> It Works?
    </p>
    <p class="m-0" style="color: var(--grey)">
      Understand how SunwayHoppers works and its benefits
    </p>
    <!--tabs -->
    <div class="mx-5">
      <div class="row">
        <nav class="img-fluid">
          <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-passenger-tab" data-bs-toggle="tab" data-bs-target="#nav-passenger" role="tab">Passenger</button>
            <button class="nav-link" id="nav-driver-tab" data-bs-toggle="tab" data-bs-target="#nav-driver" role="tab">Driver</button>
          </div>
        </nav>
      </div>
      <!-- display steps based on tab -->
      <div class="tab-content mb-5 shadow" id="nav-tabContent" style="border-radius: 0px 0px 10px 10px">
        <div class="tab-pane fade show active" id="nav-passenger" role="tabpanel">
          <div id='carouselExampleIndicators' class='carousel carousel-dark slide'>
            <div class='carousel-inner'>
              <div class='carousel-item active'>
                <div class="m-4">
                  <h3 style=" font-weight: 700">Just <span style="color: var(--sub)">4</span> Simple Steps</h3>
                </div>
                <div class='container mb-5 d-flex justify-content-around'>
                  <div class='row'>
                    <?php getSteps("passenger") ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="nav-driver" role="tabpanel">
          <div id='carouselExampleIndicators' class='carousel carousel-dark slide'>
            <div class='carousel-inner'>
              <div class='carousel-item active'>
                <div class="m-4">
                  <h3 style=" font-weight: 700">Just <span style="color: var(--sub)">4</span> Simple Steps</h3>
                </div>
                <div class='container mb-5 d-flex justify-content-around'>
                  <div class='row'>
                    <?php getSteps("driver") ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="m-5 text-center">
    <p class="p-0 m-0" style="font-weight: bold; font-size: 2.5rem;">Our
      <span class="highlight">Sponsors</span>
    </p>
    <p class="m-0" style="color: var(--grey)">
      Enjoy the rewards earned from carpooling with the community
    </p>
    <!-- Carousel for sponsors -->
    <div id="sponsorCarousel" class="carousel carousel-dark slide mt-4" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="row g-5 mx-5 p-5 align-items-center">
            <div class="col d-flex justify-content-center">
              <img src="./images/sponsors/boost.png" class="img-fluid">
            </div>
            <div class="col d-flex justify-content-center">
              <img src="./images/sponsors/caltex.png" class="img-fluid">
            </div>
            <div class="col d-flex justify-content-center">
              <img src="./images/sponsors/foodpanda.png" class="img-fluid">
            </div>
            <div class="col d-flex justify-content-center">
              <img src="./images/sponsors/setel.png" class="img-fluid">
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <div class="row g-5 mx-5 p-5 align-items-center">
            <div class="col d-flex justify-content-center">
              <img src="./images/sponsors/llaollao.png" class="img-fluid">
            </div>
            <div class="col d-flex justify-content-center">
              <img src="./images/sponsors/originals.png" class="img-fluid">
            </div>
            <div class="col d-flex justify-content-center">
              <img src="./images/sponsors/petron.png" class="img-fluid">
            </div>
            <div class="col d-flex justify-content-center">
              <img src="./images/sponsors/petronas.png" class="img-fluid">
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <div class="row g-5 mx-5 p-5 align-items-center">
            <div class="col d-flex justify-content-center">
              <img src="./images/sponsors/grab.svg" class="img-fluid">
            </div>
            <div class="col d-flex justify-content-center">
              <img src="./images/sponsors/kfc.png" class="img-fluid">
            </div>
            <div class="col d-flex justify-content-center">
              <img src="./images/sponsors/tealive.jpg" class="img-fluid">
            </div>
          </div>
        </div>
      </div>
      <button class='carousel-control-prev mx-5' type='button' data-bs-target='#sponsorCarousel' data-bs-slide='prev'>
        <span class='carousel-control-prev-icon' aria-hidden='true'></span>
        <span class='visually-hidden'>Previous</span>
      </button>
      <button class='carousel-control-next mx-5' type='button' data-bs-target='#sponsorCarousel' data-bs-slide='next'>
        <span class='carousel-control-next-icon' aria-hidden='true'></span>
        <span class='visually-hidden'>Next</span>
      </button>
    </div>
  </div>
  </div>
  </div>
  <?php include './includes/footer.inc.php'; ?>
  </div>
</body>

</html>