document.addEventListener("DOMContentLoaded", function () {
  var districtSelect = document.getElementById("district");
  var pickupInput = document.getElementById("pickupInput");
  var destinationInput = document.getElementById("destinationInput");
  var districtSelect = document.getElementById("district");
  var neighborhoodSelect = document.getElementById("neighborhood");
  var locationSelect = document.getElementById("location");

  // Get the districts
  fetch("/sunwayhoppers/backend/findCarpool.php?action=getDistricts")
    .then((response) => response.text())
    .then((data) => {
      districtSelect.innerHTML = data;
    });

  // Swap inputs
  var directionCheckbox = document.getElementById("direction");
  directionCheckbox.addEventListener("change", function () {
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

  // Get the neighborhoods
  districtSelect.addEventListener("change", function () {
    neighborhoodSelect.disabled = false;
    fetch(
      `/sunwayhoppers/backend/findCarpool.php?action=getNeighborhoods&district=${districtSelect.value}`
    )
      .then((response) => response.text())
      .then((data) => {
        neighborhoodSelect.innerHTML = data;
      });
  });

  document
    .getElementById("newCarpoolBtn")
    .addEventListener("click", getCarpoolData);

  function getCarpoolData(event) {
    event.preventDefault(); // Prevent the default form submission

    var carpool = document.getElementById("newCarpoolForm");

    // Check the form validity
    if (carpool.checkValidity()) {
      var date = carpool.elements["carpoolDate"].value;
      var time = carpool.elements["carpoolTime"].value;
      var passengerAmt = carpool.elements["passengerAmt"].value;
      var direction = carpool.elements["direction"].checked;
      var district = carpool.elements["district"].value;
      var neighborhood = carpool.elements["neighborhood"].value;
      var location = carpool.elements["location"].value;
      var details = carpool.elements["details"].value;
      var womenOnly = carpool.elements["womenOnly"].checked;

      var carpoolData = {
        action: "newCarpool",
        date,
        time,
        passengerAmt,
        direction,
        district,
        neighborhood,
        location,
        details,
        womenOnly,
      };

      sendCarpoolData(carpoolData);
    } else {
      // The form is invalid, show an error message or handle it accordingly
      carpool.reportValidity();
    }
  }

  // Send to PHP
  function sendCarpoolData(carpoolData) {
    var formData = new FormData();
    formData.append("formData", JSON.stringify(carpoolData));

    fetch("/sunwayhoppers/backend/findCarpool.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.json();
      })
      .then((data) => {
        if (data.success) {
          alert(data.message);
        } else {
          alert(data.message);
        }
      })
      .catch((error) => {
        console.error("Fetch error:", error);
      });
  }
});
