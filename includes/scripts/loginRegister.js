document.addEventListener("DOMContentLoaded", function () {
  document.getElementById("loginBtn").addEventListener("click", getLoginData);

  function getLoginData(event) {
    event.preventDefault();
    var login = document.getElementById("loginForm");

    var email = login.elements["accEmail"].value;
    var password = login.elements["accPwd"].value;

    var loginData = {
      action: "login",
      email,
      password,
    };
    sendCredentials(loginData);
  }

  // Register Script
  document
    .getElementById("registerBtn")
    .addEventListener("click", getRegisterData);

  function getRegisterData(event) {
    event.preventDefault();
    var register = document.getElementById("registerForm");

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
    sendCredentials(registerData);
  }

  // Send to PHP
  function sendCredentials(credentialsData) {
    var formData = new FormData();
    formData.append("formData", JSON.stringify(credentialsData));

    fetch("/sunwayhoppers/includes/loginRegister.php", {
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
          location.reload()

        } else {
          alert(data.message);
        }
      })
      .catch((error) => {
        console.error("Fetch error:", error);
      });
  }
});
// Login Script
