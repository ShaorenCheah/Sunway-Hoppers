//load dom
document.addEventListener("DOMContentLoaded", function () {
  var modal = null;
  var username = "";
  var usernameHelp = ""
  var email = "";
  var emailHelp = "";
  var phoneNo = "";
  var phoneNoHelp = "";

  //save original values of input fields 
  var originalUsername = "";
  var originalEmail = "";
  var originalPhoneNo = "";

  var editModal = document.getElementById("editUserModal");
  document.querySelectorAll('.editUserBtn').forEach(function (button) {
    button.addEventListener('click', function () {
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
            modal = new bootstrap.Modal(editModal);
            modal.show();

            //after modal instance is created, add event listeners
            document.getElementById("editName").addEventListener("input", validateUsername);
            document.getElementById("editPhone").addEventListener("input", validatePhoneNo);
            document.getElementById("editEmail").addEventListener("input", validateEmail);
            document.getElementById("saveEditBtn").addEventListener("click", submitEditUserForm);

            username = document.getElementById("editName");
            usernameHelp = document.getElementById("editNameHelp");
            email = document.getElementById("editEmail");
            emailHelp = document.getElementById("editEmailHelp");
            phoneNo = document.getElementById("editPhone");
            phoneNoHelp = document.getElementById("editPhoneHelp");

            //store original values of input fields
            originalUsername = username.value;
            originalEmail = email.value;
            originalPhoneNo = phoneNo.value;
          } else {
            alert("Error showing modal");
          }
        })
        .catch((error) => {
          console.error("Error:", error);
        });
    });
  });

  var flag = [1, 1, 1]; //flag to check whether input fields are valid

  //if all input fields are valid, enable the submit button
  function updateSaveButton() {
    if (flag.every(value => value === 1)) {
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

  // check whether username is empty and whether it exists in the database
  function validateUsername(event) {
    event.preventDefault();
    if (username.value == "") {
      setInvalidInput(username, usernameHelp, "Username cannot be empty", 0);
    } else if (username.value.toLowerCase() === originalUsername.toLowerCase()) {
      setValidInput(username, usernameHelp, 0);
    } else {
      var usernameData = {
        action: "checkUsername",
        input: username.value,
      };
      checkAvailability(usernameData);
    }
  }

  // check whether email is valid and whether it exists in the database
  function validateEmail(event) {
    event.preventDefault();
    const emailPattern = /^[a-zA-Z0-9._-]+@imail.sunway.edu.my$/;

    //check whether email is in valid format
    if (email.value == "") {
      setInvalidInput(email, emailHelp, "Email cannot be empty", 1);
    } else if (!emailPattern.test(email.value)) {
      setInvalidInput(email, emailHelp, "Invalid email format", 1);
    } else if (email.value.toLowerCase() == originalEmail.toLowerCase()) { //if email is unchanged
      setValidInput(email, emailHelp, 1);
    } else {
      var emailData = {
        action: "checkEmail",
        input: email.value,
      };
      checkAvailability(emailData);
    }
  }

  // check whether phone number is valid and whether it exists in the database
  function validatePhoneNo(event) {
    event.preventDefault();
    const phoneNoPattern = /^01\d{8,9}$/;

    if (phoneNo.value == "") {
      setInvalidInput(phoneNo, phoneNoHelp, "Phone number cannot be empty", 2);
    } else if (!phoneNoPattern.test(phoneNo.value)) {
      setInvalidInput(phoneNo, phoneNoHelp, "Invalid phone number format", 2);
    } else if (phoneNo.value == originalPhoneNo) { //if phone number is unchanged
      setValidInput(phoneNo, phoneNoHelp, 2);
    } else {
      var phoneData = {
        action: "checkPhoneNo",
        input: phoneNo.value,
      };
      checkAvailability(phoneData);
    }
  }

  //check whether input exists in the database
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
        // console.error("Error:", error);
      });
  }

  function submitEditUserForm(event) {
    event.preventDefault();

    var editedInfo = {
      action: "editUser",
      accountID: this.getAttribute("data-account-id"),
      username: username.value,
      email: email.value,
      phoneNo: phoneNo.value,
    };

    var formData = new FormData();
    formData.append("formData", JSON.stringify(editedInfo));
    fetch("./backend/manageUserAcc.php", {
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
          window.location.reload();
        } else {
          alert(data.message);
        }
      })
      .catch((error) => {
        // console.error("Error:", error);
      });
  }
});

function deleteUser(accountID) {
  var formData = new FormData();
  formData.append("formData", JSON.stringify({ accountID: accountID, action: 'deleteUser' }));

  fetch('./backend/manageUserAcc.php', {
    method: 'POST',
    body: formData,
  })
    .then((response) => {
      // console.log(response);
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
      alert("Error deleting user");
    });
}

