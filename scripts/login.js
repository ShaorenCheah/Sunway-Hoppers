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

  //check email input
  document.getElementById("accEmail").addEventListener("input", checkEmail);
  function checkEmail(event) {
    event.preventDefault();
    const email = document.getElementById("accEmail");
    const emailHelp = document.getElementById("accEmailHelp");

    if (email.value == "") {
      emailHelp.textContent = "Please enter your email";
      emailHelp.style.color = "red";
      email.style.borderColor = "red";
      flag[0] = 0;
    } else {
      emailHelp.textContent = "";
      email.style.borderColor = "green";
      flag[0] = 1;
    }
    updateLoginButton();
  }

  //check password input
  document.getElementById("accPwd").addEventListener("input", checkPassword);
  function checkPassword(event) {
    event.preventDefault();
    const password = document.getElementById("accPwd");
    const passwordHelp = document.getElementById("accPwdHelp");
    if (password.value == "") {
      passwordHelp.textContent = "Please enter your password";
      passwordHelp.style.color = "red";
      password.style.borderColor = "red";
      flag[1] = 0;
    } else {
      passwordHelp.textContent = "";
      password.style.borderColor = "green";
      flag[1] = 1;
    }
    updateLoginButton();
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
