document.addEventListener("DOMContentLoaded", function () {
  window.onload = function () {
    // Load locations in Bandar Sunway
    var newCarpoolDestination = document.getElementById("location");
    var filterDestination = document.getElementById("filterLocation");

    var locations = [
      "Sunway University",
      "Monash University",
      "Sunway Pyramid",
      "Sunway Residence",
      "Sunway Medical Centre",
      "Sunway Geo",
      "Sunway Mentari",
      "Sunway Pinnacle",
    ];

    locations.forEach(function (location) {
      var option1 = document.createElement("option");
      option1.value = location;
      option1.text = location;
      newCarpoolDestination.appendChild(option1);

      var option2 = document.createElement("option");
      option2.value = location;
      option2.text = location;
      filterDestination.appendChild(option2);
    });

    var filterData = { action: "getCarpoolList", type: "allList" };
    getCarpoolList(filterData); // Get carpool list

    var districtSelect = document.getElementById("district");

    // Get the districts for new carpool form
    fetch("./backend/findCarpool.php?action=getDistricts")
      .then((response) => response.text())
      .then((data) => {
        districtSelect.innerHTML = data;
      });

    var filterDistrict = document.getElementById("filterDistrict");
    // Get the districts for filter
    fetch("./backend/findCarpool.php?action=getDistricts")
      .then((response) => response.text())
      .then((data) => {
        filterDistrict.innerHTML = data;
      });
  };

  // Filter section
  var filter = document.getElementById("filterCarpool");
  var filterWomenOnly = document.getElementById("filterWomenOnly");
  var filterName = document.getElementById("filterName");
  var filterDate = document.getElementById("filterDate");
  var filterStartTime = document.getElementById("filterStartTime");
  var filterEndTime = document.getElementById("filterEndTime");
  var filterDirection = document.getElementById("filterDirection");
  var filterPickup = document.getElementById("filterPickup");
  var filterDestination = document.getElementById("filterDestination");

  filterData = {
    action: "getCarpoolList",
    type: "filteredList",
    filterName: null,
    filterDirection: null,
    filterWomenOnly: null,
    filterDate: null,
    filterStartTime: null,
    filterEndTime: null,
    filterDistrict: null,
    filterNeighborhood: null,
    filterLocation: null,
  };

  filterName.addEventListener("input", function (event) {
    filterData.filterName = filterName.value;
    getCarpoolList(filterData);
  });

  filterWomenOnly.addEventListener("change", function (event) {
    if (filterWomenOnly.checked) {
      filterData.filterWomenOnly = true;
    } else {
      filterData.filterWomenOnly = null;
    }
    getCarpoolList(filterData);
  });

  filter.addEventListener("change", function (event) {
    filterData.filterDirection = filterDirection.value;
    filterData.filterDate = filterDate.value;
    filterData.filterStartTime = filterStartTime.value;
    filterData.filterEndTime = filterEndTime.value;
    filterData.filterDistrict = filterDistrict.value;
    filterData.filterNeighborhood = filterNeighborhood.value;
    filterData.filterLocation = filterLocation.value;
    getCarpoolList(filterData);
  });

  filterDirection.addEventListener("change", function (event) {
    var direction1 = document.getElementById("direction1");
    var direction2 = document.getElementById("direction2");

    if (filterDirection.value == "to") {
      direction1.outerHTML =
        '<i id="direction1" class="d-flex align-items-center bi bi-arrow-right mx-3" style="font-size: 1.5rem;"></i>';
      direction2.outerHTML =
        '<i id="direction2" class="d-flex align-items-center bi bi-arrow-right mx-3" style="font-size: 1.5rem;"></i>';

      // Move the #district and #neighborhood  fields to #pickupInput
      filterPickup.appendChild(filterDistrict);
      filterPickup.appendChild(filterNeighborhood);
      // Move #destination to #destinationInput
      filterDestination.appendChild(filterLocation);
    } else if (filterDirection.value == "from") {
      direction1.outerHTML =
        '<i id="direction1" class="d-flex align-items-center bi bi-arrow-left mx-3" style="font-size: 1.5rem;"></i>';
      direction2.outerHTML =
        '<i id="direction2" class="d-flex align-items-center bi bi-arrow-left mx-3" style="font-size: 1.5rem;"></i>';
      // Move the #district and #neighborhood fields to #destinationInput
      filterDestination.appendChild(filterDistrict);
      filterDestination.appendChild(filterNeighborhood);
      // Move #destination to #pickupInput
      filterPickup.appendChild(filterLocation);
    } else if (filterDirection.value == "") {
      direction1.outerHTML =
        '<i id="direction1" class="d-flex align-items-center bi bi-dot mx-3" style="font-size: 1.5rem;"></i>';
      direction2.outerHTML =
        '<i id="direction2" class="d-flex align-items-center bi bi-dot mx-3" style="font-size: 1.5rem;"></i>';
    }
  });

  // Reset filter
  var resetFilterBtn = document.getElementById("resetFilterBtn");

  resetFilterBtn.addEventListener("click", function () {
    filterName.value = null;
    filterWomenOnly.checked = false;
    filterDirection.value = "";
    filterDate.value = null;
    filterStartTime.value = "";
    filterEndTime.value = "";
    filterDistrict.value = "";
    filterNeighborhood.value = "";
    filterLocation.value = "";

    filterData = {
      action: "getCarpoolList",
      type: "filteredList",
      filterName: null,
      filterDirection: null,
      filterWomenOnly: null,
      filterDate: null,
      filterStartTime: null,
      filterEndTime: null,
      filterDistrict: null,
      filterNeighborhood: null,
      filterLocation: null,
    };

    direction1.outerHTML =
      '<i id="direction1" class="d-flex align-items-center bi bi-dot mx-3" style="font-size: 1.5rem;"></i>';
    direction2.outerHTML =
      '<i id="direction2" class="d-flex align-items-center bi bi-dot mx-3" style="font-size: 1.5rem;"></i>';

    filterNeighborhood.disabled = true;

    getCarpoolList(filterData);
  });

  // Get the carpool list
  function getCarpoolList(filterData) {
    console.log(filterData);
    var filterDataString = encodeURIComponent(JSON.stringify(filterData));
    fetch(
      `./backend/findCarpool.php?action=getCarpoolList&filterData=${filterDataString}`
    )
      .then((response) => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.text().then(function (text) {
          return text ? JSON.parse(text) : {};
        });
      })
      .then((data) => {
        var carpoolList = document.getElementById("carpoolList");
        carpoolList.innerHTML = data.html;

        var carpoolModals = document.getElementById("carpoolModals");
        carpoolModals.innerHTML = data.modal;

        var joinCarpoolBtns = document.getElementsByClassName("join-carpool");
        for (var i = 0; i < joinCarpoolBtns.length; i++) {
          joinCarpoolBtns[i].addEventListener("click", joinCarpool);
        }
      });
  }

  // Get the neighborhoods for filter
  filterDistrict.addEventListener("change", function () {
    if (filterDistrict.value == "") {
      filterNeighborhood.disabled = true;
    } else {
      filterNeighborhood.disabled = false;
    }
    fetch(
      `./backend/findCarpool.php?action=getNeighborhoods&district=${filterDistrict.value}`
    )
      .then((response) => response.text())
      .then((data) => {
        filterNeighborhood.innerHTML = data;
      });
  });

  // New Carpool Form Section
  var pickupInput = document.getElementById("pickupInput");
  var destinationInput = document.getElementById("destinationInput");
  var districtSelect = document.getElementById("district");
  var neighborhoodSelect = document.getElementById("neighborhood");
  var locationSelect = document.getElementById("location");

  // Swap inputs for new carpool form
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

  // Get the neighborhoods based on selected district for new carpool form
  districtSelect.addEventListener("change", function () {
    neighborhoodSelect.disabled = false;
    fetch(
      `./backend/findCarpool.php?action=getNeighborhoods&district=${districtSelect.value}`
    )
      .then((response) => response.text())
      .then((data) => {
        neighborhoodSelect.innerHTML = data;
      });
  });

  // New carpool form submission
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

  // New carpool form send to database
  function sendCarpoolData(carpoolData) {
    var formData = new FormData();
    formData.append("formData", JSON.stringify(carpoolData));

    fetch("./backend/findCarpool.php", {
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
          window.location.href = './profile.php'; // Redirect to profile.php
        } else {
          alert(data.message);
        }
      })
      .catch((error) => {
        console.error("Fetch error:", error);
      });
  }

  // Join carpool
  function joinCarpool(event) {
    event.preventDefault();
    var forms = document.querySelectorAll(".join-carpool-forms");

    forms.forEach((form) => {
      if (!form.elements.permission.checked) {
        form.elements.permission.focus();
        form.elements.permission.reportValidity();
      } else {
        // All required form values are entered, you can submit the form
        var carpoolID = this.getAttribute("data-carpoolID");
        console.log(carpoolID);

        var joinCarpoolData = {
          action: "joinCarpool",
          carpoolID
        };

        sendJoinCarpoolData(joinCarpoolData);
      }
    });
  }

  // Send join carpool data to database
  function sendJoinCarpoolData(joinCarpoolData) {
    var formData = new FormData();
    formData.append("formData", JSON.stringify(joinCarpoolData));

    fetch("./backend/findCarpool.php", {
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
          location.reload();
        } else {
          alert(data.message);
        }
      })
      .catch((error) => {
        console.error("Fetch error:", error);
      });
  }
});
