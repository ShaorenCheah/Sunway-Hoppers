document.addEventListener('DOMContentLoaded', function () {

  var flag = [0, 0, 0, 0, 0]; //flag to check whether form inputs are valid

  function updateAddButton() {
    if (flag.every(value => value === 1)) {
      document.getElementById("addRewardBtn").disabled = false;
    } else {
      document.getElementById("addRewardBtn").disabled = true;
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


  //check if reward name is entered
  document.getElementById("rewardName").addEventListener("input", checkReward);
  function checkReward(event) {
    event.preventDefault();
    const rewardName = document.getElementById("rewardName");
    const rewardNameHelp = document.getElementById("rewardNameHelp");
    // limit the input to 16 characters
    if (rewardName.value.length > 16) {
      rewardName.value = rewardName.value.substring(0, 16);
    }
    var msg = "";
    if (rewardName.value === "") {
      msg = "Reward name cannot be empty";
      setInvalidInput(rewardName, rewardNameHelp, msg, 0);
    } else {
      setValidInput(rewardName, rewardNameHelp, 0);
    }
  }

  //check if points is entered
  document.getElementById("rewardPts").addEventListener("input", checkPts);
  function checkPts(event) {
    event.preventDefault();
    const rewardPts = document.getElementById("rewardPts");
    const rewardPtsHelp = document.getElementById("rewardPtsHelp");
    var msg = "";
    //regex to check if input is an integer
    const regex = /^[0-9]+$/;

    if (!regex.test(rewardPts.value) || rewardPts.value === "") {
      msg = "Please enter a valid number";
      setInvalidInput(rewardPts, rewardPtsHelp, msg, 1);
    } else {
      setValidInput(rewardPts, rewardPtsHelp, 1);
    }
  }

  //check if quantity is entered
  document.getElementById("rewardQty").addEventListener("input", checkQty);
  function checkQty(event) {
    event.preventDefault();
    const rewardQty = document.getElementById("rewardQty");
    const rewardQtyHelp = document.getElementById("rewardQtyHelp");
    var msg = "";
    //regex to check if input is an integer
    const regex = /^[0-9]+$/;

    if (!regex.test(rewardQty.value) || rewardQty.value === "") {
      msg = "Please enter a valid number";
      setInvalidInput(rewardQty, rewardQtyHelp, msg, 2);
    } else {
      setValidInput(rewardQty, rewardQtyHelp, 2);
    }
  }

  //check if file is uploaded
  document.getElementById("rewardImage").addEventListener("change", checkImg);
  function checkImg(event) {
    event.preventDefault();
    const rewardImage = document.getElementById("rewardImage");
    if (rewardImage.files.length != 0) {
      rewardImage.style.borderColor = "green";
      flag[3] = 1;
    }
  }

  //check if description is entered
  document.getElementById("rewardDesc").addEventListener("input", checkDesc);
  function checkDesc(event) {
    event.preventDefault();
    const rewardDesc = document.getElementById("rewardDesc");
    const rewardDescHelp = document.getElementById("rewardDescHelp");
    var msg = "";
    // limit the input to 160 characters, stop user from typing more
    if (rewardDesc.value.length > 160) {
      rewardDesc.value = rewardDesc.value.substring(0, 160);
    }
    if (rewardDesc.value === "") {
      msg = "Description cannot be empty";
      setInvalidInput(rewardDesc, rewardDescHelp, msg, 4);
    } else {
      setValidInput(rewardDesc, rewardDescHelp, 4);
    }
  }
});