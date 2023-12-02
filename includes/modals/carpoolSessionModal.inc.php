<?php

$modal .= <<<HTML
<div class="modal fade" id="carpoolModal{$carpool['carpoolID']}" tabindex="-1" aria-labelledby="#carpoolModal{$carpool['carpoolID']}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="width:125%">
      <div class="modal-body m-3">
        <form class="join-carpool-forms">
          <h3 class="text-center mb-3"><b>Carpool Confirmation</b></h3>
          <div class="row flex-column">
            <div class="col-12 d-flex mb-3">
              <!-- Driver Profile -->
              <div class="col-6 d-flex flex-column p-3 align-items-center justify-content-center">
                  <img src="images/person.png" alt="Avatar" class="shadow mb-3" style="border-radius: 50%;height: 6rem; width: 6rem;">
                  <h5 style="font-weight:600; color:var(--primary)">{$carpool['name']}</h5>
                  <div class="d-flex justify-content-center mb-2">
                    <p class="m-0" style="font-weight:600">{$rating}</p>
                    <i class="bi bi-star-fill mx-1" style="color:#F6931A"></i>
                    <p class="text-muted m-0" style="font-size:0.857rem; font-weight:500">({$ratingsAmt} Ratings)</p>
                  </div>
                <span class="badge rounded-pill shadow px-3">{$vehicle['vehicleNo']}</span>
              </div>

              <!-- Carpool Details -->
              <div class="col-6 d-flex flex-column">
                <div class="d-flex flex-column mb-3">
                  <h6 class="m-0">Departure Time <i class="ms-2 bi bi-clock"></i></h6>
                  <p class="m-0">{$carpoolTime}</p>
                </div>
                <div class="d-flex flex-column mb-3">
                  <h6 class="m-0">Date <i class="ms-2 bi bi-calendar-week"></i></h6>
                  <p class="m-0">{$carpool['carpoolDate']} ({$carpoolDay})</p>
                </div>
                <div class="d-flex flex-column mb-3">
                  <h6 class="m-0">Contact No <i class="ms-2 bi bi-telephone-fill"></i></h6>
                  <p class="m-0">{$carpool['phoneNo']}</p>
                </div>
                <div class="d-flex flex-column">
                  <h6 class="m-0">Vehicle Details <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="ms-2 bi bi-car-front-fill" viewBox="0 0 16 16">
                      <path d="M2.52 3.515A2.5 2.5 0 0 1 4.82 2h6.362c1 0 1.904.596 2.298 1.515l.792 1.848c.075.175.21.319.38.404.5.25.855.715.965 1.262l.335 1.679c.033.161.049.325.049.49v.413c0 .814-.39 1.543-1 1.997V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.338c-1.292.048-2.745.088-4 .088s-2.708-.04-4-.088V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.892c-.61-.454-1-1.183-1-1.997v-.413a2.5 2.5 0 0 1 .049-.49l.335-1.68c.11-.546.465-1.012.964-1.261a.807.807 0 0 0 .381-.404l.792-1.848ZM3 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2m10 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2M6 8a1 1 0 0 0 0 2h4a1 1 0 1 0 0-2zM2.906 5.189a.51.51 0 0 0 .497.731c.91-.073 3.35-.17 4.597-.17 1.247 0 3.688.097 4.597.17a.51.51 0 0 0 .497-.731l-.956-1.913A.5.5 0 0 0 11.691 3H4.309a.5.5 0 0 0-.447.276L2.906 5.19Z" />
                    </svg></h6>
                  <p class="m-0">{$vehicle['vehicleType']}, {$vehicle['vehicleColour']}</p>
                </div>
              </div>
            </div>

            <div class="col-12 d-flex flex-column justify-content-center align-items-center">
              <div class="border w-100"></div>
              <div class="d-flex my-4">
                <div class="d-flex flex-column justify-content-center align-items-center">
                  <h6>Pickup Area <i class="ms-2 bi bi-geo"></i></h6>
                  <div class="d-flex gx-2">
                    {$pickup}
                  </div>
                </div> 
                <div class="d-flex justify-content-center align-items-center mx-3">
                  <h3 class="my-2 mt-3"><i class="bi bi-arrow-right-circle-fill"></i></h3>
                </div> 
                <div class="d-flex flex-column justify-content-center align-items-center">
                  <h6>Destination <i class="ms-2 bi bi-flag"></i></i></h6>
                  <div class="d-flex gx-2">
                    {$destination}
                  </div>
                </div> 
              </div>
              <div class="border w-100"></div>
            </div>

            <div class="col-12 d-flex flex-column mt-3">
              <h6>Carpool Details <i class="ms-2 bi bi-chat-dots"></i></h6>
              <div class="rounded py-2 px-3 mb-3" style="border:2px solid var(--primary); min-height:7rem">
                <p>{$carpool['details']}</p>
              </div>
              <div class="form-check">
                <input class="form-check-input" name="permission" type="checkbox" value="" id="flexCheckDefault" required>
                <label class="form-check-label text-muted" for="flexCheckDefault" style="font-size:0.857rem">
                Please ensure that you’ve contacted the driver and arranged for an accurate pickup point and time
                </label>
              </div>
              <div class="d-flex justify-content-center mt-4">
                <button type="submit" data-carpoolID="{$carpoolID}" class="btn btn-primary shadow px-4 join-carpool">Hop On!</button>
              </div>
            </div> 
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

HTML;
