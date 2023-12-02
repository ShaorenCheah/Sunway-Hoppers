document.addEventListener("DOMContentLoaded", function () {
  document.getElementById("submitCarBtn").addEventListener("click", function (event) {
    event.preventDefault();

    var form = document.getElementById("editCarForm");

    // Check the form validity
    if (form.checkValidity()) {
      var carNo = form.elements["carNo"].value;
      var carType = form.elements["carType"].value;
      var carColour = form.elements["carColour"].value;
      var carRules = form.elements["carRules"].value;

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

    fetch("./backend/editCar.php", {
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
