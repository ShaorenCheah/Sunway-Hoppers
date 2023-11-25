<div class="modal fade" id="newCarpoolModal" tabindex="-1" aria-labelledby="newCarpoolModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body mx-4 my-3">
        <h3><b>Create Carpool Session</b></h3>
        <form id="newCarpoolForm">
          <div class="row p-0 mt-3 g-4">
            <div class="col-6">
              <label for="carpoolDate" class="form-label">Date <i class="ms-2 bi bi-calendar-week"></i></label>
              <input type="date" class="form-control" id="carpoolDate" name="carpoolDate" min="<?php echo date("Y-m-d"); ?>" required>
            </div>
            <div class="col-6">
              <label for="carpoolTime" class="form-label">Departure Time <i class="ms-2 bi bi-clock"></i></label>
              <input type="time" class="form-control" id="carpoolTime" name="carpoolTime" required>
            </div>
            <div class="col-12">
              <label for="passengerAmt" class="form-label">Number of Passengers <i class="ms-2 bi bi-people"></i></label>
              <input type="number" class="form-control" id="passengerAmt" name="passengerAmt" min="1" max="10" placeholder="Select number of passengers" required>
            </div>
            <div class="col-12">
              <div class="border-bottom pt-2"></div>
            </div>
            <div class="col-12">
              <div class="d-flex justify-content-between align-items-center mb-2">
                <label for="passengerAmt" class="form-label">Pickup Area <i class="ms-2 bi bi-geo"></i></label>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="direction" checked>
                  <label class="form-check-label" for="direction">
                    To Bandar Sunway
                  </label>
                </div>
              </div>
              <div class="d-flex" id="pickupInput">
                <select id='district' name='district' class='form-select' style='width:30%' placeholder='Select District' required>

                </select>

                <select id="neighborhood" name="neighborhood" class="form-select ms-3" style="width:70%" required disabled>
                  <option disabled selected>Select Neighborhood</option>
                </select>
              </div>
            </div>
            <div class="col-12 d-flex justify-content-center">
              <h3><i class="bi bi-arrow-down-circle-fill"></i></h3>
            </div>
            <div class="col-12 m-0">
              <label for="carpoolDestination" class="form-label">Destination <i class="ms-2 bi bi-flag"></i></label>
              <div class="d-flex" id="destinationInput">
                <select id="location" name="location" class="form-select" required>
                  <option value='' disabled selected>Select Location</option>
                  <option value="Sunway University">Sunway University</option>
                  <option value="Monash University">Monash University</option>
                  <option value="Sunway Pyramid">Sunway Pyramid</option>
                  <option value="Sunway Residence">Sunway Residence</option>
                  <option value="Sunway Medical Centre">Sunway Medical Centre</option>
                  <option value="Sunway Geo">Sunway Geo</option>
                  <option value="Sunway Mentari">Sunway Mentari</option>
                  <option value="Sunway Pinnacle">Sunway Pinnacle</option>
                </select>
              </div>
            </div>
            <div class="col-12">
              <div class="border-bottom pt-2"></div>
            </div>
            <div class="col-12">
              <div class="d-flex justify-content-between">
                <label for="details" class="form-label">Carpool Details <i class="ms-2 bi bi-chat-dots"></i></label>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="womenOnly">
                  <label class="form-check-label" for="womenOnly">
                    Women-Only
                  </label>
                </div>
              </div>
              <textarea class="form-control" id="details" name="details" placeholder="Hop on my carpool if you're around this area!" rows="4" required></textarea>
            </div>
            <div class="col-12">
              <div class="border-bottom pt-2"></div>
            </div>
            <div class="col-12 text-center">
              <p class="text-muted">Communicate with passengers for an improved carpool experience!</p>
              <button type="submit" class="btn btn-primary shadow px-4">Create</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  var districtSelect = document.getElementById('district');
  var pickupInput = document.getElementById('pickupInput');
  var destinationInput = document.getElementById('destinationInput');
  var districtSelect = document.getElementById('district');
  var neighborhoodSelect = document.getElementById('neighborhood');
  var locationSelect = document.getElementById('location');

  fetch('/sunwayhoppers/backend/findCarpool.php?action=getDistricts')
    .then(response => response.text())
    .then(data => {
      districtSelect.innerHTML = data;
    });

  var directionCheckbox = document.getElementById('direction');
  directionCheckbox.addEventListener('change', function() {

    if (directionCheckbox.checked) {
      // Move the #district and #neighborhood  fields to #pickupInput
      pickupInput.appendChild(districtSelect);
      pickupInput.appendChild(neighborhoodSelect);
      // Move #destination to #destinationInput
      destinationInput.appendChild(locationSelect);
    } else {
      // Move the #district and #neighborhood fields to #destinationInput
      destinationInput.appendChild(districtSelect);
      destinationInput.appendChild(neighborhoodSelect);
      // Move #destination to #pickupInput
      pickupInput.appendChild(locationSelect);
    }
  });

  districtSelect.addEventListener('change', function() {

    neighborhoodSelect.disabled = false;
    fetch(`/sunwayhoppers/backend/findCarpool.php?action=getNeighborhoods&district=${districtSelect.value}`)
      .then(response => response.text())
      .then(data => {
        neighborhoodSelect.innerHTML = data;
      });

  });
</script>