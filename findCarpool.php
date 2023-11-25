<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href='https://fonts.googleapis.com/css?family=League Spartan' rel='stylesheet'>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="./styles/findCarpool.css">
  <!-- Include icon link here -->
  <title>SunwayHoppers</title>
</head>


<body>
  <?php include './includes/header.inc.php'; ?>
  <div class="m-5">
    <h2 class="text-center pt-5 pb-3"><b>List of Available <span style="color:var(--secondary)">Carpool</span> Requests</b></h2>

    <div class="row gx-5 m-0">
      <!-- Filter Section -->
      <div class="col-3 h-auto d-flex flex-column ps-0">
        <div class="card shadow text-center p-2 py-3">
          <h4 class="m-0"><b>Filter Carpool</b><i class="bi bi-search ms-3"></i></h3>
        </div>
        <!-- First Section -->
        <p class="text-center my-3  fw-semibold" style="font-size:1rem;">Step <span style="color:var(--secondary)">1</span> : Select Travel Direction</p>
        <div class="card shadow p-3">
          <h5 style="color:var(--primary)"><b>Direction</b> <i class="bi bi-arrow-left-right ms-1"></i></h5>
          <div class="card bg-body-tertiary d-flex p-2 py-3">
            <h6 class="d-flex justify-content-center align-items-center">Going
              <select class="form-select mx-3 w-25" aria-label="Default select example">
                <option selected value="to">to</option>
                <option value="from">from</option>
              </select>
              Bandar Sunway
            </h6>
            <div class="d-flex justify-content-center mt-3">
              <i class="d-flex align-items-center bi bi-house-fill" style="font-size: 1.5rem; color:var(--primary);"></i>
              <i class="d-flex align-items-center bi bi-arrow-right mx-3" style="font-size: 1.5rem;"></i>
              <svg xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem" fill="var(--primary)" class="bi bi-car-front-fill" style="font-size: 2rem;" viewBox="0 0 16 16">
                <path d="M2.52 3.515A2.5 2.5 0 0 1 4.82 2h6.362c1 0 1.904.596 2.298 1.515l.792 1.848c.075.175.21.319.38.404.5.25.855.715.965 1.262l.335 1.679c.033.161.049.325.049.49v.413c0 .814-.39 1.543-1 1.997V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.338c-1.292.048-2.745.088-4 .088s-2.708-.04-4-.088V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.892c-.61-.454-1-1.183-1-1.997v-.413a2.5 2.5 0 0 1 .049-.49l.335-1.68c.11-.546.465-1.012.964-1.261a.807.807 0 0 0 .381-.404l.792-1.848ZM3 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Zm10 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2ZM6 8a1 1 0 0 0 0 2h4a1 1 0 1 0 0-2H6ZM2.906 5.189a.51.51 0 0 0 .497.731c.91-.073 3.35-.17 4.597-.17 1.247 0 3.688.097 4.597.17a.51.51 0 0 0 .497-.731l-.956-1.913A.5.5 0 0 0 11.691 3H4.309a.5.5 0 0 0-.447.276L2.906 5.19Z" />
              </svg>
              <i class="d-flex align-items-center bi bi-arrow-right mx-3" style="font-size: 1.5rem;"></i>
              <svg xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem" fill="var(--primary)" class="bi bi-buildings-fill" style="font-size: 2rem;" viewBox="0 0 16 16">
                <path d="M15 .5a.5.5 0 0 0-.724-.447l-8 4A.5.5 0 0 0 6 4.5v3.14L.342 9.526A.5.5 0 0 0 0 10v5.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V14h1v1.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5V.5ZM2 11h1v1H2v-1Zm2 0h1v1H4v-1Zm-1 2v1H2v-1h1Zm1 0h1v1H4v-1Zm9-10v1h-1V3h1ZM8 5h1v1H8V5Zm1 2v1H8V7h1ZM8 9h1v1H8V9Zm2 0h1v1h-1V9Zm-1 2v1H8v-1h1Zm1 0h1v1h-1v-1Zm3-2v1h-1V9h1Zm-1 2h1v1h-1v-1Zm-2-4h1v1h-1V7Zm3 0v1h-1V7h1Zm-2-2v1h-1V5h1Zm1 0h1v1h-1V5Z" />
              </svg>
            </div>
          </div>
        </div>

        <!-- Second Section -->
        <p class="text-center my-3 fw-semibold" style="font-size:1rem;">Step <span style="color:var(--secondary)">2</span> : Enter Carpool Details</p>
        <div class="card shadow p-3">
          <!-- Driver Section -->
          <div class="d-flex justify-content-between">
            <h5 style="color:var(--primary)"><b>Driver</b> <svg xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem" fill="currentColor" class="bi bi-car-front-fill ms-1" style="font-size: 2rem;" viewBox="0 0 16 16">
                <path d="M2.52 3.515A2.5 2.5 0 0 1 4.82 2h6.362c1 0 1.904.596 2.298 1.515l.792 1.848c.075.175.21.319.38.404.5.25.855.715.965 1.262l.335 1.679c.033.161.049.325.049.49v.413c0 .814-.39 1.543-1 1.997V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.338c-1.292.048-2.745.088-4 .088s-2.708-.04-4-.088V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.892c-.61-.454-1-1.183-1-1.997v-.413a2.5 2.5 0 0 1 .049-.49l.335-1.68c.11-.546.465-1.012.964-1.261a.807.807 0 0 0 .381-.404l.792-1.848ZM3 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Zm10 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2ZM6 8a1 1 0 0 0 0 2h4a1 1 0 1 0 0-2H6ZM2.906 5.189a.51.51 0 0 0 .497.731c.91-.073 3.35-.17 4.597-.17 1.247 0 3.688.097 4.597.17a.51.51 0 0 0 .497-.731l-.956-1.913A.5.5 0 0 0 11.691 3H4.309a.5.5 0 0 0-.447.276L2.906 5.19Z" />
              </svg></h5>
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="womenOnly">
              <label class="form-check-label p-0 fw-semibold" for="womenOnly">Women-Only</label>
            </div>
          </div>
          <div class="card bg-body-tertiary d-flex p-3">
            <div>
              <label for="driverName" class="form-label fw-semibold">Name</label>
              <input type="text" class="form-control" id="driverName" placeholder="Search by driver name">
            </div>
          </div>

          <!-- Schedule Section -->
          <h5 class="mt-3" style="color:var(--primary)"><b>Schedule</b> <i class="bi bi-calendar-week-fill ms-1"></i></h5>
          <div class="card bg-body-tertiary d-flex p-3">
            <div>
              <label for="carpoolDate" class="form-label fw-semibold">Date</label>
              <input type="date" class="form-control" id="carpoolDate">
            </div>
            <div class="mt-3">
              <label for="startTime" class="form-label fw-semibold">Time</label>
              <div class="d-flex">
                <input type="time" class="form-control" id="startTime">
                <p class="m-0 mx-3 d-flex align-items-center" style="font-size:1rem"> to </p><input type="time" class="form-control" id="endTime">
              </div>
            </div>
          </div>

          <!-- Location Section -->
          <h5 class="mt-3" style="color:var(--primary)"><b>Location</b> <i class="bi bi-geo-alt-fill ms-1"></i></h5>
          <div class="card bg-body-tertiary d-flex p-3">
            <div>
              <label for="pickupAreas" class="form-label fw-semibold">Pickup Area(s)</label>
              <input type="text" class="form-control" id="pickupAreas" placeholder="Enter pickup area">
            </div>
            <div class="mt-3">
              <label for="destination" class="form-label fw-semibold">Destination</label>
              <select id="destination" class="form-select">
                <option>Select destination</option>
              </select>
            </div>
          </div>
        </div>
      </div>

      <!-- Carpool Section -->
      <div class="col-9 h-100 card shadow p-0 d-flex">

        <!-- Ticket Section -->
        <div class="m-3 d-flex flex-row" style="border-radius:0.714rem">

          <!-- First Column (Driver Profile)-->
          <div class="d-flex flex-column p-3 driver-border col-2 align-items-center justify-content-center">
            <img src="images/person.png" alt="Avatar" class="shadow mb-3" style="border-radius: 50%;height: 5rem; width: 5rem;">
            <h5 style="font-weight:600; color:var(--primary)">John Doe</h5>
            <div class="d-flex justify-content-center mb-2">
              <p class="m-0" style="font-weight:600">5.0</p>
              <i class="bi bi-star-fill mx-1" style="color:#F6931A"></i>
              <p class="text-muted m-0" style="font-size:0.857rem; font-weight:500">(12 Ratings)</p>
            </div>
            <span class="badge rounded-pill shadow px-3">WXV9855</span>
          </div>

          <!-- Second Column (Ticket Line)-->
          <div class="d-flex flex-column">
            <div class="half-circle flipped"></div>
            <div class="h-100 d-flex justify-content-center align-items-center">
              <div class="dashed-line"></div>
            </div>
            <div class="half-circle"></div>
          </div>

          <!-- Third Column (Carpool Details) -->
          <div class="d-flex w-100 carpool-border p-2 justify-content-center ">

            <!-- First Section -->
            <div class="col-5 row p-4 mt-4 justify-content-center">

              <!-- Date & Contact No -->
              <div class="col-6 d-flex flex-column">
                <h6>Date <i class="ms-2 bi bi-calendar-week"></i></h6>
                <p>24/10/2023 (Tuesday)</p>
              </div>
              <div class="col-6 d-flex flex-column">
                <h6>Contact No <i class="ms-2 bi bi-telephone-fill"></i></h6>
                <p>+6016-338 1806</p>
              </div>

              <!-- Pickup Time  & Vehicle Details -->
              <div class="col-6 d-flex flex-column ">
                <h6>Pickup Time <i class="ms-2 bi bi-clock"></i></h6>
                <p>11:35 PM</p>
              </div>
              <div class="col-6 d-flex flex-column">
                <h6>Vehicle Details <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="ms-2 bi bi-car-front-fill" viewBox="0 0 16 16">
                    <path d="M2.52 3.515A2.5 2.5 0 0 1 4.82 2h6.362c1 0 1.904.596 2.298 1.515l.792 1.848c.075.175.21.319.38.404.5.25.855.715.965 1.262l.335 1.679c.033.161.049.325.049.49v.413c0 .814-.39 1.543-1 1.997V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.338c-1.292.048-2.745.088-4 .088s-2.708-.04-4-.088V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.892c-.61-.454-1-1.183-1-1.997v-.413a2.5 2.5 0 0 1 .049-.49l.335-1.68c.11-.546.465-1.012.964-1.261a.807.807 0 0 0 .381-.404l.792-1.848ZM3 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2m10 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2M6 8a1 1 0 0 0 0 2h4a1 1 0 1 0 0-2zM2.906 5.189a.51.51 0 0 0 .497.731c.91-.073 3.35-.17 4.597-.17 1.247 0 3.688.097 4.597.17a.51.51 0 0 0 .497-.731l-.956-1.913A.5.5 0 0 0 11.691 3H4.309a.5.5 0 0 0-.447.276L2.906 5.19Z" />
                  </svg></h6>
                <p>Perodua Axia, White</p>
              </div>
            </div>

            <!-- Line -->
            <div class="d-flex align-items-center">
              <div class="solid-line"></div>
            </div>

            <!-- Second Section -->
            <div class="col-5 px-4 py-3 ms-3">
              <div class="h-100 rounded d-flex flex-column d-flex  align-items-center p-3" style="border: 1px solid var(--secondary)">
                <h6>Pickup Area <i class="ms-2 bi bi-geo"></i></h6>
                <div class="d-flex gx-2">
                  <span class="badge rounded-pill shadow px-3 mx-2">SS15</span><span class="badge rounded-pill shadow px-3 mx-2">USJ 9</span>
                </div>
                <h3 class="my-2"><i class="bi bi-arrow-down-circle-fill"></i></h3>
                <h6>Destination <i class="ms-2 bi bi-flag"></i></i></h6>
                <span class="badge rounded-pill shadow px-3">Sunway University</span>
              </div>
            </div>

            <div class="col-2 px-2 py-3 d-flex flex-column justify-content-center align-items-center">
              <h1 style="font-size:3.571rem">3/4</h1>
              <h6 class="text-center">SEATS REMAINING</h6>
              <button type="button" class="btn btn-primary shadow px-4 mt-2">Hop On</button>
            </div>
          </div>
        </div>
        <!-- Ticket Section -->
        <div class="m-3 d-flex flex-row" style="border-radius:0.714rem">

          <!-- First Column (Driver Profile)-->
          <div class="d-flex flex-column p-3 driver-border col-2 align-items-center justify-content-center">
            <img src="images/person.png" alt="Avatar" class="shadow mb-3" style="border-radius: 50%;height: 5rem; width: 5rem;">
            <h5 style="font-weight:600; color:var(--primary)">John Doe</h5>
            <div class="d-flex justify-content-center mb-2">
              <p class="m-0" style="font-weight:600">5.0</p>
              <i class="bi bi-star-fill mx-1" style="color:#F6931A"></i>
              <p class="text-muted m-0" style="font-size:0.857rem; font-weight:500">(12 Ratings)</p>
            </div>
            <span class="badge rounded-pill shadow px-3">WXV9855</span>
          </div>

          <!-- Second Column (Ticket Line)-->
          <div class="d-flex flex-column">
            <div class="half-circle flipped"></div>
            <div class="h-100 d-flex justify-content-center align-items-center">
              <div class="dashed-line"></div>
            </div>
            <div class="half-circle"></div>
          </div>

          <!-- Third Column (Carpool Details) -->
          <div class="d-flex w-100 carpool-border p-2 justify-content-center ">

            <!-- First Section -->
            <div class="col-5 row p-4 mt-4 justify-content-center">

              <!-- Date & Contact No -->
              <div class="col-6 d-flex flex-column">
                <h6>Date <i class="ms-2 bi bi-calendar-week"></i></h6>
                <p>24/10/2023 (Tuesday)</p>
              </div>
              <div class="col-6 d-flex flex-column">
                <h6>Contact No <i class="ms-2 bi bi-telephone-fill"></i></h6>
                <p>+6016-338 1806</p>
              </div>

              <!-- Pickup Time  & Vehicle Details -->
              <div class="col-6 d-flex flex-column ">
                <h6>Pickup Time <i class="ms-2 bi bi-clock"></i></h6>
                <p>11:35 PM</p>
              </div>
              <div class="col-6 d-flex flex-column">
                <h6>Vehicle Details <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="ms-2 bi bi-car-front-fill" viewBox="0 0 16 16">
                    <path d="M2.52 3.515A2.5 2.5 0 0 1 4.82 2h6.362c1 0 1.904.596 2.298 1.515l.792 1.848c.075.175.21.319.38.404.5.25.855.715.965 1.262l.335 1.679c.033.161.049.325.049.49v.413c0 .814-.39 1.543-1 1.997V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.338c-1.292.048-2.745.088-4 .088s-2.708-.04-4-.088V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.892c-.61-.454-1-1.183-1-1.997v-.413a2.5 2.5 0 0 1 .049-.49l.335-1.68c.11-.546.465-1.012.964-1.261a.807.807 0 0 0 .381-.404l.792-1.848ZM3 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2m10 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2M6 8a1 1 0 0 0 0 2h4a1 1 0 1 0 0-2zM2.906 5.189a.51.51 0 0 0 .497.731c.91-.073 3.35-.17 4.597-.17 1.247 0 3.688.097 4.597.17a.51.51 0 0 0 .497-.731l-.956-1.913A.5.5 0 0 0 11.691 3H4.309a.5.5 0 0 0-.447.276L2.906 5.19Z" />
                  </svg></h6>
                <p>Perodua Axia, White</p>
              </div>
            </div>

            <!-- Line -->
            <div class="d-flex align-items-center">
              <div class="solid-line"></div>
            </div>

            <!-- Second Section -->
            <div class="col-5 px-4 py-3 ms-3">
              <div class="h-100 rounded d-flex flex-column d-flex  align-items-center p-3" style="border: 1px solid var(--secondary)">
                <h6>Pickup Area <i class="ms-2 bi bi-geo"></i></h6>
                <div class="d-flex gx-2">
                  <span class="badge rounded-pill shadow px-3 mx-2">SS15</span><span class="badge rounded-pill shadow px-3 mx-2">USJ 9</span>
                </div>
                <h3 class="my-2"><i class="bi bi-arrow-down-circle-fill"></i></h3>
                <h6>Destination <i class="ms-2 bi bi-flag"></i></i></h6>
                <span class="badge rounded-pill shadow px-3">Sunway University</span>
              </div>
            </div>

            <div class="col-2 px-2 py-3 d-flex flex-column justify-content-center align-items-center">
            <span class="badge rounded-pill shadow px-3 mb-2" style="background-color:#FF9BBC">Women-Only</span>
              <h1 style="font-size:3.571rem">3/4</h1>
              <h6 class="text-center">SEATS REMAINING</h6>
              <button type="button" class="btn btn-primary shadow px-4 mt-2">Hop On</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include './includes/footer.inc.php'; ?>
</body>


</html>