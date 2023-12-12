document.addEventListener("DOMContentLoaded", function () {
  var flag = [0, 0]; //flag to check whether form inputs are valid
  var loginStatus = document.getElementById("loginStatus"); //display login status

  //enable login button if all inputs are valid
  function updateLoginButton() {
    loginStatus.textContent = "";
    if (flag.every(value => value === 1)) {
      document.getElementById("loginBtn").disabled = false;
    } else {
      document.getElementById("loginBtn").disabled = true;
    }
  }

  //set invalid input fields to red and display error message
  function setInvalidInput(field, helpText, message, flagIndex) {
    field.style.borderColor = "red";
    helpText.textContent = message;
    helpText.style.color = "red";
    flag[flagIndex] = 0;
    updateLoginButton();
  }

  //set valid input fields to green and remove error message
  function setValidInput(field, helpText, flagIndex) {
    field.style.borderColor = "green";
    helpText.textContent = "";
    flag[flagIndex] = 1;
    updateLoginButton();
  }

  //check email input
  document.getElementById("accEmail").addEventListener("input", checkEmail);
  function checkEmail(event) {
    event.preventDefault();
    const email = document.getElementById("accEmail");
    const emailHelp = document.getElementById("accEmailHelp");

    if (email.value == "") {
      setInvalidInput(email, emailHelp, "Please enter your email", 0);
    } else {
      setValidInput(email, emailHelp, 0);
    }
  }

  //check password input
  document.getElementById("accPwd").addEventListener("input", checkPassword);
  function checkPassword(event) {
    event.preventDefault();
    const password = document.getElementById("accPwd");
    const passwordHelp = document.getElementById("accPwdHelp");
    const passwordIcon = document.getElementById("accPwdIcon");
    if (password.value == "") {
      setInvalidInput(password, passwordHelp, "Please enter your password", 1);
      passwordIcon.style.borderColor = "red";
    } else {
      setValidInput(password, passwordHelp, 1);
      passwordIcon.style.borderColor = "green";
    }
  }

  //Login Script
  document.getElementById("loginBtn").addEventListener("click", getLoginData);

  function getLoginData(event) {
    event.preventDefault(); // Prevent the default form submission

    var login = document.getElementById("loginForm");

    // Check the form validity
    if (login.checkValidity()) {
      // The form is valid, proceed with the loginData
      var email = login.elements["accEmail"].value;
      var password = login.elements["accPwd"].value;

      var loginData = {
        action: "login",
        email,
        password,
      };

      sendCredentials(loginData);
    } else {
      // The form is invalid, show an error message or handle it accordingly
      login.reportValidity();
    }
  }

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
          location.reload();
        } else {
          loginStatus.textContent = data.message; // display error message in login status
        }
      })
  }
});
