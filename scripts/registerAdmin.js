document.addEventListener("DOMContentLoaded", function () {

  var flag = [0, 0, 0, 0, 0]; //flag to check whether form inputs are valid

  function updateAddButton() {
    if (flag.every(value => value === 1)) {
      document.getElementById("addAdminBtn").disabled = false;
    } else {
      document.getElementById("addAdminBtn").disabled = true;
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

  //check if admin name is entered
  document.getElementById("adminName").addEventListener("input", checkAdmin);
  function checkAdmin(event) {
    event.preventDefault();
    const adminName = document.getElementById("adminName");
    const adminNameHelp = document.getElementById("adminNameHelp");

    if (adminName.value === "") {
      setInvalidInput(adminName, adminNameHelp, "Admin name cannot be empty", 0);
    } else {
      var adminData = {
        action: "checkAdminName",
        input: adminName.value,
      };
      checkAvailability(adminData);
    }
  }

  // check whether email is valid
  document.getElementById("adminEmail").addEventListener("input", validateEmail);
  function validateEmail(event) {
    event.preventDefault();
    const adminEmail = document.getElementById("adminEmail");
    const adminEmailHelp = document.getElementById("adminEmailHelp");
    //regex for email
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

    //check whether email is in valid format
    if (adminEmail.value == "") {
      setInvalidInput(adminEmail, adminEmailHelp, "Email cannot be empty", 1);
    } else if (!emailPattern.test(adminEmail.value)) {
      setInvalidInput(adminEmail, adminEmailHelp, "Invalid email format", 1);
    } else {
      var emailData = {
        action: "checkAdminEmail",
        input: adminEmail.value,
      };
      checkAvailability(emailData);
    }
  }

  // check whether phone number is valid
  document.getElementById("adminPhoneNo").addEventListener("input", validatePhoneNo);
  function validatePhoneNo(event) {
    event.preventDefault();
    const adminPhoneNo = document.getElementById("adminPhoneNo");
    const adminPhoneNoHelp = document.getElementById("adminPhoneNoHelp");
    const phoneNoPattern = /^01\d{8,9}$/;
    adminPhoneNoHelp.style.color = "red";

    if (adminPhoneNo.value == "") {
      setInvalidInput(adminPhoneNo, adminPhoneNoHelp, "Phone number cannot be empty", 2);
    } else if (!phoneNoPattern.test(adminPhoneNo.value)) {
      setInvalidInput(adminPhoneNo, adminPhoneNoHelp, "Invalid phone number format", 2);
    } else {
      var phoneData = {
        action: "checkAdminPhoneNo",
        input: adminPhoneNo.value,
      };
      checkAvailability(phoneData);
    }
  }

  // check whether username/email/phone number already exists in database
  function checkAvailability(checkData) {
    var formData = new FormData();
    formData.append("formData", JSON.stringify(checkData));
    // Make an asynchronous request to your server-side script
    fetch("./backend/formValidation.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        switch (data.action) {
          case "checkAdminName":
            !data.available ?
              // admin name exists in the database
              setInvalidInput(adminName, adminNameHelp, data.message, 0) :
              // admin name is valid and doesn't exist in the database
              setValidInput(adminName, adminNameHelp, 0);
            break;
          case "checkAdminEmail":
            !data.available ?
              // email exists in the database
              setInvalidInput(adminEmail, adminEmailHelp, data.message, 1) :
              // email is valid and doesn't exist in the database
              setValidInput(adminEmail, adminEmailHelp, 1);
            break;
          case "checkAdminPhoneNo":
            !data.available ?
              // Phone number exists in the database
              setInvalidInput(adminPhoneNo, adminPhoneNoHelp, data.message, 2) :
              // Phone number is valid and doesn't exist in the database
              setValidInput(adminPhoneNo, adminPhoneNoHelp, 2);
            break;
        }
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  }

  // check whether password is valid based on length
  document.getElementById("adminPwd").addEventListener("input", checkPassword);
  function checkPassword(event) {
    event.preventDefault();

    checkRepeatPwd(event); //check whether both passwords match

    const adminPwd = document.getElementById("adminPwd");
    const adminPwdHelp = document.getElementById("adminPwdHelp");
    const adminPwdIcon = document.getElementById("adminPwdIcon");
    adminPwdHelp.style.color = "red";
    
    if (adminPwd.value.length >= 8) {
      setValidInput(adminPwd, adminPwdHelp, 3);
      adminPwdIcon.style.borderColor = "green";
    } else {
      adminPwdIcon.style.borderColor = "red";
      setInvalidInput(adminPwd, adminPwdHelp, "Password must be at least 8 characters", 3);
    }
  }

  // check whether repeat password == admin password
  document.getElementById("repeatAdminPwd").addEventListener("input", checkRepeatPwd);
  function checkRepeatPwd(event) {
    event.preventDefault();
    const adminPwd = document.getElementById("adminPwd");
    const repeatAdminPwdIcon = document.getElementById("repeatAdminPwdIcon");
    const repeatAdminPwd = document.getElementById("repeatAdminPwd");
    const repeatAdminPwdHelp = document.getElementById("repeatAdminPwdHelp");

    //check whether both passwords match
    if (repeatAdminPwd.value !== adminPwd.value) {
      setInvalidInput(repeatAdminPwd, repeatAdminPwdHelp, "Passwords do not match", 4);
      repeatAdminPwdIcon.style.borderColor = "red";
    } else if (repeatAdminPwd.value == "") { // if empty field, reset the border color and help text
      setInvalidInput(repeatAdminPwd, repeatAdminPwdHelp, "Password cannot be empty", 4);
      repeatAdminPwdIcon.style.borderColor = "red";
    } else { // if passwords match
      setValidInput(repeatAdminPwd, repeatAdminPwdHelp, 4);
      repeatAdminPwdIcon.style.borderColor = "green";
    }
  }

  // add admin
  document.getElementById("addAdminBtn").addEventListener("click", getAdminData);

  function getAdminData(event) {
    event.preventDefault();

    var register = document.getElementById("registerAdminForm");

    var adminName = register.elements["adminName"].value;
    var adminEmail = register.elements["adminEmail"].value;
    var adminPhoneNo = register.elements["adminPhoneNo"].value;
    var adminPwd = register.elements["adminPwd"].value;

    var adminData = {
      action: "addAdmin",
      adminName,
      adminEmail,
      adminPhoneNo,
      adminPwd,
    };

    sendData(adminData);
  }

  function sendData(data) {
    var formData = new FormData();
    formData.append('formData', JSON.stringify(data));
    console.log(formData);

    fetch('./backend/registerAdmin.php', {
      method: 'POST',
      body: formData
    })
      .then((response) => {
        console.log(response);
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.json();
      })
      .then((data) => {
        console.log(data);
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
