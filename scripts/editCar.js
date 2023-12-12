document.addEventListener("DOMContentLoaded", function () {

  var flag = [0, 0];

  //if either input field is edited, enable the submit button
  function updateSubmitButton() {
    if (flag[0] === 1 || flag[1] === 1) {
      document.getElementById("submitCarBtn").disabled = false;
    } else {
      document.getElementById("submitCarBtn").disabled = true;
    }
  }

  //check if car rules is empty
  document.getElementById('editCarRules').addEventListener('input', function () {
    const carRules = document.getElementById('editCarRules');
    const carRulesHelp = document.getElementById('editCarRulesHelp');

    if (carRules.value === "") {
      carRulesHelp.textContent = "Please enter your car rules";
      carRules.style.borderColor = "red";
      flag[1] = 0;
    } else {
      carRulesHelp.textContent = "";
      carRules.style.borderColor = "green";
      flag[1] = 1;
    }
    updateSubmitButton();
  });

  //detect if car color is changed
  document.getElementById('editCarColour').addEventListener('change', function () {
    const carColour = document.getElementById('editCarColour');
    carColour.style.borderColor = "green";
    flag[0] = 1;
    updateSubmitButton();
  });

  document.getElementById("submitCarBtn").addEventListener("click", function (event) {
    event.preventDefault();

    var form = document.getElementById("editCarForm");

    // Check the form validity
    if (form.checkValidity()) {
      var carNo = form.elements["editCarNo"].value;
      var carType = form.elements["editCarType"].value;
      var carColour = form.elements["editCarColour"].value;
      var carRules = form.elements["editCarRules"].value;

      var formData = {
        carNo,
        carType,
        carColour,
        carRules,
      };

      sendCredentials(formData);
    } else {
      // The form is invalid, show an error message or handle it accordingly
      form.reportValidity();
    }
  });
  
  // Send to PHP
  function sendCredentials(credentialsData) {
    var formData = new FormData();
    formData.append("formData", JSON.stringify(credentialsData));

    fetch("./backend/profile/editCar.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => {
        console.log(response);
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.json();
      })
      .then((data) => {
        alert(data.message);
        location.reload();
      })
  }
});
