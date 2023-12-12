document.addEventListener("DOMContentLoaded", function () {
  var activeModal = null;
  var loginModal = new bootstrap.Modal(document.getElementById("loginModal"));
  var registerModal = new bootstrap.Modal(
    document.getElementById("registerModal")
  );

  // display login modal after registering
  window.showLoginModal = function () {
    if (activeModal == "registerModal") {
      registerModal.hide();
    }
    activeModal = "loginModal";
    loginModal.show();
  };

  window.showRegisterModal = function () {
    if (activeModal == "loginModal") {
      loginModal.hide();
    }
    activeModal = "registerModal";
    registerModal.show();
  };

  var flag = [0, 0, 0, 0, 0, 0]; //flag to check whether form inputs are valid

  function updateSubmitButton() {
    if (flag.every(value => value === 1)) {
      document.getElementById("registerBtn").disabled = false;
    } else {
      document.getElementById("registerBtn").disabled = true;
    }
  }

  //set invalid input fields to red and display error message
  function setInvalidInput(field, helpText, message, flagIndex) {
    field.style.borderColor = "red";
    helpText.textContent = message;
    helpText.style.color = "red";
    flag[flagIndex] = 0;
    updateSubmitButton();
  }

  //set valid input fields to green and remove error message
  function setValidInput(field, helpText, flagIndex) {
    field.style.borderColor = "green";
    helpText.textContent = "";
    flag[flagIndex] = 1;
    updateSubmitButton();
  }

  // check whether username is empty
  document.getElementById("username").addEventListener("input", validateUsername);
  function validateUsername(event) {
    event.preventDefault();
    const username = document.getElementById("username");
    const usernameHelp = document.getElementById("usernameHelp");

    if (username.value == "") {
      setInvalidInput(username, usernameHelp, "Username cannot be empty", 0);
    } else {
      var usernameData = {
        action: "checkUsername",
        input: username.value,
      };
      checkAvailability(usernameData);
    }
  }

  // check whether email is valid
  document.getElementById("email").addEventListener("input", validateEmail);
  function validateEmail(event) {
    event.preventDefault();
    const email = document.getElementById("email");
    const emailHelp = document.getElementById("emailHelp");
    const emailPattern = /^[a-zA-Z0-9._-]+@imail.sunway.edu.my$/;

    //check whether email is in valid format
    if (email.value == "") {
      setInvalidInput(email, emailHelp, "Email cannot be empty", 1);
    } else if (!emailPattern.test(email.value)) {
      setInvalidInput(email, emailHelp, "Invalid email format", 1);
    } else {
      var emailData = {
        action: "checkEmail",
        input: email.value,
      };
      checkAvailability(emailData);
    }
  }

  // check whether phone number is valid
  document.getElementById("phoneNo").addEventListener("input", validatePhoneNo);
  function validatePhoneNo(event) {
    event.preventDefault();
    const phoneNo = document.getElementById("phoneNo");
    const phoneNoHelp = document.getElementById("phoneNoHelp");
    const phoneNoPattern = /^01\d{8,9}$/;

    if (phoneNo.value == "") {
      setInvalidInput(phoneNo, phoneNoHelp, "Phone number cannot be empty", 2);
    } else if (!phoneNoPattern.test(phoneNo.value)) {
      setInvalidInput(phoneNo, phoneNoHelp, "Invalid phone number format", 2);
    } else {
      var phoneData = {
        action: "checkPhoneNo",
        input: phoneNo.value,
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
          case "checkUsername":
            !data.available ?
              // Username exists in the database
              setInvalidInput(username, usernameHelp, data.message, 0) :
              // Username is valid and doesn't exist in the database
              setValidInput(username, usernameHelp, 0);
            break;
          case "checkEmail":
            !data.available ?
              // email exists in the database
              setInvalidInput(email, emailHelp, data.message, 1) :
              // email is valid and doesn't exist in the database
              setValidInput(email, emailHelp, 1);
            break;
          case "checkPhoneNo":
            !data.available ?
              // Phone number exists in the database
              setInvalidInput(phoneNo, phoneNoHelp, data.message, 2) :
              // Phone number is valid and doesn't exist in the database
              setValidInput(phoneNo, phoneNoHelp, 2);
            break;
        }
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  }

  // check whether date of birth is in valid format
  document.getElementById("dob").addEventListener("input", validateDob);
  function validateDob(event) {
    event.preventDefault();
    const dob = document.getElementById("dob");
    const dobHelp = document.getElementById("dobHelp");
    const dobPattern = /^(19\d{2}|20(?:[012]\d))-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01])$/;

    const today = new Date();
    const dobDate = new Date(dob.value);

    if (!dobPattern.test(dob.value)) {
      setInvalidInput(dob, dobHelp, "Invalid date format", 3);
    } else if (dobDate > today) {
      setInvalidInput(dob, dobHelp, "DOB cannot be in the future", 3);
    } else {
      setValidInput(dob, dobHelp, 3);
    }
  }

  // check whether password is valid based on strength
  document.getElementById("userPwd").addEventListener("input", checkPasswordStrength);
  function checkPasswordStrength(event) {
    event.preventDefault();

    checkRepeatPwd(event); //check whether both passwords match

    const userPwd = document.getElementById("userPwd");
    const userPwdIcon = document.getElementById("userPwdIcon");
    const cond1 = document.getElementById("cond1");
    const cond2 = document.getElementById("cond2");
    const cond3 = document.getElementById("cond3");
    const passwordStrengthMeter = document.getElementById("password-strength-meter");
    //regex to check whether password has special characters
    const checkCharacters = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
    //regex to check whether password has at least 1 number
    const checkNumbers = /^(?=.*[0-9])/;
    userPwd.style.borderColor = "red";
    userPwdIcon.style.borderColor = "red";

    //increase the progress bar width when each condition is met
    var conditionsMet = 0;
    if (userPwd.value.length >= 8) {
      cond1.textContent = "8 characters \u2713";
      cond1.style.color = "var(--sub)";
      conditionsMet++;
    } else { //reset condition style if not met
      cond1.textContent = "8 characters \u2717";
      cond1.style.color = "grey";
    }

    if (checkNumbers.test(userPwd.value)) {
      cond2.textContent = "Numbers \u2713";
      cond2.style.color = "var(--sub)";
      conditionsMet++;
    } else { //reset condition style if not met
      cond2.textContent = "Numbers \u2717";
      cond2.style.color = "grey";
    }

    if (checkCharacters.test(userPwd.value)) {
      cond3.textContent = "Special characters \u2713";
      cond3.style.color = "var(--sub)";
      conditionsMet++;
    } else { //reset condition style if not met
      cond3.textContent = "Special characters \u2717";
      cond3.style.color = "grey";
    }

    switch (conditionsMet) {
      case 1:
        document.getElementById("password-strength-meter").style.width = "33%";
        passwordStrengthMeter.style.backgroundColor = "red";
        flag[4] = 0;
        break;
      case 2:
        document.getElementById("password-strength-meter").style.width = "66%";
        passwordStrengthMeter.style.backgroundColor = "orange";
        flag[4] = 0;
        break;
      case 3:
        document.getElementById("password-strength-meter").style.width = "100%";
        passwordStrengthMeter.style.backgroundColor = "green";
        userPwd.style.borderColor = "green";
        userPwdIcon.style.borderColor = "green";
        flag[4] = 1;
        break;
      default:
        document.getElementById("password-strength-meter").style.width = "0%";
        flag[4] = 0;
    }
    updateSubmitButton();
  }

  // check whether repeat password == user password
  document.getElementById("repeatPwd").addEventListener("input", checkRepeatPwd);
  function checkRepeatPwd(event) {
    event.preventDefault();
    const userPwd = document.getElementById("userPwd");
    const repeatPwd = document.getElementById("repeatPwd");
    const repeatPwdHelp = document.getElementById("repeatPwdHelp");
    const repeatPwdIcon = document.getElementById("userRepeatPwdIcon");

    //check whether both passwords match
    if (repeatPwd.value !== userPwd.value) {
      setInvalidInput(repeatPwd, repeatPwdHelp, "Passwords do not match", 5);
      repeatPwdIcon.style.borderColor = "red";
    } else if (repeatPwd.value == "") { // if empty field, reset the border color and help text
      setInvalidInput(repeatPwd, repeatPwdHelp, "Password cannot be empty", 5);
      repeatPwdIcon.style.borderColor = "red";
    } else { // if passwords match
      setValidInput(repeatPwd, repeatPwdHelp, 5);
      repeatPwdIcon.style.borderColor = "green";
    }
  }

  // submit register form
  document.getElementById("registerForm").addEventListener("submit", getRegisterData);
  function getRegisterData(event) {
    event.preventDefault();

    var register = document.getElementById("registerForm");
    var userPwd = register.elements["userPwd"].value;
    var repeatPwd = register.elements["repeatPwd"].value;

    if (register.checkValidity()) {
      var username = register.elements["username"].value;
      var email = register.elements["email"].value;
      var phoneNo = register.elements["phoneNo"].value;
      var dob = register.elements["dob"].value;
      var gender = register.elements["gender"].value;
      var userPwd = register.elements["userPwd"].value;
      var repeatPwd = register.elements["repeatPwd"].value;

      var registerData = {
        action: "register",
        username,
        email,
        phoneNo,
        dob,
        gender,
        userPwd,
        repeatPwd,
      };
      console.log(flag);
      //if all inputs are valid, send credentials to PHP
      if (flag) {
        sendCredentials(registerData);
      }
    } else {
      register.reportValidity();
    }
  }

  // Send to PHP
  function sendCredentials(credentialsData) {
    var formData = new FormData();
    formData.append("formData", JSON.stringify(credentialsData));

    fetch("./backend/loginRegister.php", {
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
        if (data.success) {
          alert(data.message);
          window.showLoginModal();
        } else {
          alert(data.message);
        }
      })
  }
});
