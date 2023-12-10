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

  // check whether username is empty
  document.getElementById("username").addEventListener("input", validateUsername);
  function validateUsername(event) {
    event.preventDefault();
    const username = document.getElementById("username");
    const usernameHelp = document.getElementById("usernameHelp");

    if (username.value == "") {
      usernameHelp.textContent = "Username cannot be empty";
      usernameHelp.style.color = "red";
      username.style.borderColor = "red";
      flag[0] = 0;
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
      emailHelp.style.color = "red";
      email.style.borderColor = "red";
      emailHelp.textContent = "Email cannot be empty";
      flag[1] = 0;
    } else if (!emailPattern.test(email.value)) {
      emailHelp.textContent = "Invalid email format";
      emailHelp.style.color = "red";
      email.style.borderColor = "red";
      flag[1] = 0;
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

    if (!phoneNoPattern.test(phoneNo.value)) {
      phoneNoHelp.textContent = "Invalid phone number format";
      phoneNoHelp.style.color = "red";
      phoneNo.style.borderColor = "red";
      flag[2] = 0;
    } else {
      var phoneData = {
        action: "checkPhoneNo",
        input: phoneNo.value,
      };
      checkAvailability(phoneData);
    }
  }

  // check whether username/email/phone number already exists in database
  function checkAvailability(checkData){
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
            if (!data.available) {
              // Username exists in the database
              document.getElementById("usernameHelp").style.color = "red";
              document.getElementById("username").style.borderColor = "red";
              flag[0] = 0;
            } else {
              // Username is valid and doesn't exist in the database
              document.getElementById("username").style.borderColor = "green";
              flag[0] = 1;
            }
            document.getElementById("usernameHelp").textContent = data.message;
            break;
          case "checkEmail":
            if (!data.available) {
              // Email exists in the database
              document.getElementById("emailHelp").style.color = "red";
              document.getElementById("email").style.borderColor = "red";
              flag[1] = 0;
            } else {
              // Email is valid and doesn't exist in the database
              document.getElementById("email").style.borderColor = "green";
              flag[1] = 1;
            }
            document.getElementById("emailHelp").textContent = data.message;
            break;
          case "checkPhoneNo":
            if (!data.available) {
              // Phone number exists in the database
              document.getElementById("phoneNoHelp").style.color = "red";
              document.getElementById("phoneNo").style.borderColor = "red";
              flag[2] = 0;
            } else {
              // Phone number is valid and doesn't exist in the database
              document.getElementById("phoneNo").style.borderColor = "green";
              flag[2] = 1;
            }
            document.getElementById("phoneNoHelp").textContent = data.message;
            break;
        }
        console.log(data);
        updateSubmitButton();
      })
      .catch((error) => {
        console.error("Error:", error);
        console.error(":", response);
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
      dobHelp.textContent = "Invalid date format";
      dobHelp.style.color = "red";
      dob.style.borderColor = "red";
      flag[3] = 0;
    } else if (dobDate > today) {
      dobHelp.textContent = "DOB cannot be in the future";
      dobHelp.style.color = "red";
      dob.style.borderColor = "red";
      flag[3] = 0;
    } else {
      dobHelp.textContent = "";
      dob.style.borderColor = "green";
      flag[3] = 1;
    }
    updateSubmitButton();
  }

  // check whether password is valid based on strength
  document.getElementById("userPwd").addEventListener("input", checkPasswordStrength);
  function checkPasswordStrength(event) {
    event.preventDefault();

    checkRepeatPwd(event); //check whether both passwords match

    const userPwd = document.getElementById("userPwd");
    const cond1 = document.getElementById("cond1");
    const cond2 = document.getElementById("cond2");
    const cond3 = document.getElementById("cond3");
    const passwordStrengthMeter = document.getElementById("password-strength-meter");
    //regex to check whether password has special characters
    const checkCharacters = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
    //regex to check whether password has at least 1 number
    const checkNumbers = /^(?=.*[0-9])/;

    userPwd.style.borderColor = "red";

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

    //check whether both passwords match
    if (repeatPwd.value !== userPwd.value) {
      repeatPwdHelp.textContent = "Passwords do not match.";
      repeatPwdHelp.style.color = "red";
      repeatPwd.style.borderColor = "red";
      flag[5] = 0;
    } else if (repeatPwd.value == "") { // if empty field, reset the border color and help text
      repeatPwdHelp.textContent = "Password cannot be empty";
      repeatPwdHelp.style.color = "red";
      repeatPwd.style.borderColor = "red";
      flag[5] = 0;
    } else { // if passwords match
      repeatPwdHelp.textContent = "";
      repeatPwd.style.borderColor = "green";
      flag[5] = 1;
    }
    updateSubmitButton();
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
