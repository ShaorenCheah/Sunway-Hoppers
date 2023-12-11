document.addEventListener("DOMContentLoaded", function () {
  window.onload = function () {
    fetch("./backend/profile.php?action=getProfile")
      .then((response) => response.json())
      .then((data) => {
        //console.log(data);
        document
          .getElementById("profilePic")
          .setAttribute("src", data.user.profilePic);

        // Insert Profile Section HTML
        if (data.type == "Driver") {
          document.getElementById("userRating").innerHTML +=
            data.user.rating + '<i class="ms-1 bi bi-star-fill"></i>';
          document.getElementById("ratingsAmt").innerHTML +=
            "(" + data.user.ratingsAmt + " Ratings)";
        }
        document.getElementById("userPhoneNo").textContent = data.user.phoneNo;
        document.getElementById("userDOB").textContent = data.user.dob;
        document.getElementById("descText").textContent = data.user.bio;
        // Insert Account Status Section HTML
        document.getElementById("accStatus").innerHTML += data.html.accStatus;
        document.getElementById("statusImg").innerHTML += data.html.statusImg;
        document.getElementById("statusMsg").innerHTML += data.html.statusMsg;
      });

    fetch("./backend/profile.php?action=getRequestTable")
      .then((response) => response.json())
      .then((data) => {
        //console.log(data);

        // Insert Request Table HTML
        document.getElementById("nav-request").innerHTML += data.html;

        var viewRequestBtns = document.getElementsByClassName("view-request");
        for (var i = 0; i < viewRequestBtns.length; i++) {
          viewRequestBtns[i].addEventListener("click", getSelectedData);
        }
      });
  };

  // Edit Bio Feature
  var edit = document.getElementById("editBtn").value;
  document.getElementById("editBtn").addEventListener("click", function () {
    edit = !edit;
    // add disabled to textarea if edit is false
    document.getElementById("descText").disabled = edit ? true : false;
    document.getElementById("updateBioBtn").style.display = edit ? "none" : "";
    document.getElementById("editBtn").style.display = edit ? "" : "none";
  });

  function getSelectedData() {
    var data = {
      index: this.getAttribute("data-carpoolIndex"),
      carpoolID: this.getAttribute("data-carpoolID"),
      pickup: this.getAttribute("data-carpoolPickup"),
      destination: this.getAttribute("data-carpoolDestination"),
    };
    createRequestModal(data);
  }

  var requestContent = document.getElementById("requestModal");
  var requestModal = null;

  function createRequestModal(data) {
    console.log(data)
    var requestData = encodeURIComponent(JSON.stringify(data));

    fetch(
      `./backend/profile.php?action=createRequestModal&requestData=${requestData}`
    )
      .then((response) => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.text().then(function (text) {
          return text ? JSON.parse(text) : {};
        });
      })
      .then((data) => {
        // console.log(data);
        // Insert Request Table HTML
        requestContent.innerHTML = data.modal;

        requestModal = new bootstrap.Modal(requestContent);

        var acceptRequestBtns =
          document.getElementsByClassName("accept-request");
        for (var i = 0; i < acceptRequestBtns.length; i++) {
          acceptRequestBtns[i].addEventListener("click", manageRequest);
        }

        var rejectRequestBtns =
          document.getElementsByClassName("reject-request");
        for (var i = 0; i < rejectRequestBtns.length; i++) {
          rejectRequestBtns[i].addEventListener("click", manageRequest);
        }

        requestModal.show();
      });
  }

  function manageRequest() {
    var requestData = {
      action: "manageRequest",
      type: this.getAttribute("data-type"),
      carpoolID: this.getAttribute("data-carpoolID"),
      accountID: this.getAttribute("data-accountID"),
    };
    console.log(requestData);
    var formData = new FormData();
    formData.append("formData", JSON.stringify(requestData));

    fetch("./backend/profile.php", {
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
        if (data.status) {
          alert(data.message);
          var refresh = {
            action: "refresh",
            index: document.getElementById('index').innerHTML,
            carpoolID: data.carpoolID,
            pickup: document.getElementById('pickup').innerHTML,
            destination: document.getElementById('destination').innerHTML,
          };
          createRequestModal(refresh);
        } else {
          alert(data.message);
        }
      });
  }
});
