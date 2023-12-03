document.addEventListener("DOMContentLoaded", function () {

  // add admin
  document.getElementById("addAdminBtn").addEventListener("click", getAdminData);

  function getAdminData(event) {
    event.preventDefault();

    var register = document.getElementById("registerAdminForm");
    var userPwd = register.elements["userPwd"].value;
    var repeatPwd = register.elements["repeatPwd"].value;

    if (userPwd !== repeatPwd) {
      alert("Passwords do not match. Please try again.");
    } else if (register.checkValidity()) {
      var username = register.elements["username"].value;
      var email = register.elements["email"].value;
      var phoneNo = register.elements["phoneNo"].value;

      var adminData = {
        action: "addAdmin",
        username,
        email,
        phoneNo,
        userPwd,
      };
      
      sendData(adminData);
    }
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
