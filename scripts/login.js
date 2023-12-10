document.addEventListener("DOMContentLoaded", function () {
  var activeModal = null;
  var loginModal = new bootstrap.Modal(document.getElementById("loginModal"));
  var registerModal = new bootstrap.Modal(
    document.getElementById("registerModal")
  );

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
          alert(data.message);
        }
      })
  }
});
