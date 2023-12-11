document.addEventListener('DOMContentLoaded', function () {

  var flag = [0, 0, 0, 0, 0]; //flag to check whether form inputs are valid

  function updateAddButton() {
    if (flag.every(value => value === 1)) {
      document.getElementById("submitDriverBtn").disabled = false;
    } else {
      document.getElementById("submitDriverBtn").disabled = true;
    }
  }

  //set invalid input fields to red and display error message
  function setInvalidInput(field, helpText, message, flagIndex) {
    field.style.borderColor = "red";
    helpText.textContent = message;
    helpText.style.color = "red";
    flag[flagIndex] = 0;
    updateAddButton();
  }

  //set valid input fields to green and remove error message
  function setValidInput(field, helpText, flagIndex) {
    field.style.borderColor = "green";
    helpText.textContent = "";
    flag[flagIndex] = 1;
    updateAddButton();
  }

  //check if car number is entered
  document.getElementById("carNo").addEventListener("input", checkCarNo);
  function checkCarNo(event) {
    event.preventDefault();
    const carNo = document.getElementById("carNo");
    const carNoHelp = document.getElementById("carNoHelp");
    if (carNo.value === "") {
      setInvalidInput(carNo, carNoHelp, "Please fill in this field", 0);
    } else {
      setValidInput(carNo, carNoHelp, 0);
    }
  }

  //check if car type is entered
  document.getElementById("carType").addEventListener("input", checkCarType);
  function checkCarType(event) {
    event.preventDefault();
    const carType = document.getElementById("carType");
    const carTypeHelp = document.getElementById("carTypeHelp");
    
    if (carType.value === "") {
      setInvalidInput(carType, carTypeHelp, "Please fill in this field", 1);
    } else {
      setValidInput(carType, carTypeHelp, 1);
    }
  }

  //check if car colour is selected
  document.getElementById("carColour").addEventListener("input", checkCarColour);
  function checkCarColour(event) {
    event.preventDefault();
    const carColour = document.getElementById("carColour");

    if (carColour.value !== "") {
      carColour.style.borderColor = "green";
      flag[2] = 1;
      updateAddButton();
    }
  }

  //check if license file is uploaded
  document.getElementById("licenseFiles").addEventListener("change", checkFile);
  function checkFile(event) {
    event.preventDefault();
    const licenseFiles = document.getElementById("licenseFiles");
    if (licenseFiles.files.length != 0) {
      licenseFiles.style.borderColor = "green";
      flag[3] = 1;
      updateAddButton();
    }
  }

  //check if car rules is entered
  document.getElementById("carRules").addEventListener("input", checkRules);
  function checkRules(event) {
    event.preventDefault();
    const carRules = document.getElementById("carRules");
    const carRulesHelp = document.getElementById("carRulesHelp");
    if (carRules.value === "") {
      setInvalidInput(carRules, carRulesHelp, "Please enter some rules that passengers should follow when carpooling", 4);
    }
    else {
      setValidInput(carRules, carRulesHelp, 4);
    }
  }
});