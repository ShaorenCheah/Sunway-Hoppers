//load dom
document.addEventListener("DOMContentLoaded", function () {
  var editModal = new bootstrap.Modal(document.getElementById("editUserModal"));
  var editUserBtn = document.getElementById("editUserBtn");

  editUserBtn.addEventListener("click", function () {
    var accountID = this.getAttribute("data-account-id");

    var formData = new FormData();
    formData.append("formData", JSON.stringify({ accountID: accountID, action: 'showModal' }));

    fetch('./backend/manageUserAcc.php', {
      method: 'POST',
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
          editModal.innerHTML = data.modal;
          editModal.show();
        } else {
          alert("Error showing modal");
        }
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  });

  var flag = [0, 0, 0];

  //if either input field is edited, enable the submit button
  function updateSaveButton() {
    if (flag[0] === 1 || flag[1] === 1) {
      document.getElementById("saveEditBtn").disabled = false;
    } else {
      document.getElementById("saveEditBtn").disabled = true;
    }
  }

  //set invalid input fields to red and display error message
  function setInvalidInput(field, helpText, message, flagIndex) {
    field.style.borderColor = "red";
    helpText.textContent = message;
    helpText.style.color = "red";
    flag[flagIndex] = 0;
    updateSaveButton();
  }

  //set valid input fields to green and remove error message
  function setValidInput(field, helpText, flagIndex) {
    field.style.borderColor = "green";
    helpText.textContent = "";
    flag[flagIndex] = 1;
    updateSaveButton();
  }

  // check whether username is empty
  document.getElementById("editName").addEventListener("input", validateUsername);
  function validateUsername(event) {
    event.preventDefault();
    const username = document.getElementById("editName");
    const usernameHelp = document.getElementById("editNameHelp");

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
  document.getElementById("editEmail").addEventListener("input", validateEmail);
  function validateEmail(event) {
    event.preventDefault();
    const email = document.getElementById("editEmail");
    const emailHelp = document.getElementById("editEmailHelp");
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
  document.getElementById("editPhone").addEventListener("input", validatePhoneNo);
  function validatePhoneNo(event) {
    event.preventDefault();
    const phoneNo = document.getElementById("editPhone");
    const phoneNoHelp = document.getElementById("editPhoneHelp");
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
});

function deleteUser(accountID) {
  console.log('Deleting user with accountID:', accountID);

  var formData = new FormData();
  formData.append("formData", JSON.stringify({ accountID: accountID, action: 'deleteUser' }));

  fetch('./backend/manageUserAcc.php', {
    method: 'POST',
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
        window.location.reload();
      } else {
        alert(data.message);
      }
    })
    .catch((error) => {
      console.error("Error during deletion:", error);
      alert("Error deleting user");
    });
}

