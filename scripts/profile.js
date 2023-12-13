document.addEventListener("DOMContentLoaded", function () {
  fetch("./backend/profile/profile.php?action=getProfile")
    .then((response) => response.json())
    .then((data) => {
      console.log(data);

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

  getRequestTable();

  function getRequestTable() {
    fetch("./backend/profile/profile.php?action=getRequestTable")
      .then((response) => response.json())
      .then((data) => {
        //console.log(data);
        if (data.type == "Driver") {
          // Insert Request Table HTML
          document.getElementById("nav-request").innerHTML = data.html;

          var viewRequestBtns = document.getElementsByClassName("view-request");
          for (var i = 0; i < viewRequestBtns.length; i++) {
            viewRequestBtns[i].addEventListener("click", getSelectedData);
          }
        }
      });
  }
  fetch("./backend/profile/profile.php?action=getHistoryTable")
    .then((response) => response.json())
    .then((data) => {
      console.log(data);
      // Insert History Table HTML
      document.getElementById("nav-history").innerHTML += data.html;
    });

  fetch("./backend/profile/profile.php?action=getRewardTable")
    .then((response) => response.json())
    .then((data) => {
      console.log(data);
      // Insert History Table HTML
      document.getElementById("nav-reward").innerHTML += data.html;
      var viewRewardBtns = document.getElementsByClassName("view-reward");
      for (var i = 0; i < viewRewardBtns.length; i++) {
        viewRewardBtns[i].addEventListener("click", getRewardModalContent);
      }
    });

  // Edit Bio Feature
  var edit = document.getElementById("editBtn").value;
  document.getElementById("editBtn").addEventListener("click", function () {
    edit = !edit;
    // add disabled to textarea if edit is false
    document.getElementById("descText").disabled = edit ? true : false;
    document.getElementById("updateBioBtn").style.display = edit ? "none" : "";
    document.getElementById("editBtn").style.display = edit ? "" : "none";
  });

  document
    .getElementById("updateBioBtn")
    .addEventListener("click", function () {
      var bio = document.getElementById("descText").value;
      var formData = new FormData();
      formData.append("bio", bio);

      fetch("./backend/profile/updateBio.php", {
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
          console.log(data);
          alert(data.message);
          window.location.reload();
        });
    });

  function getSelectedData() {
    var data = {
      action: "newRequestModal",
      index: this.getAttribute("data-carpoolIndex"),
      carpoolID: this.getAttribute("data-carpoolID"),
    };
    getRequestModalContent(data);
  }

  var modalContent = document.getElementById("modal");
  var requestModal = null;

  function getRequestModalContent(data) {
    var type = data.action;
    var requestData = encodeURIComponent(JSON.stringify(data));
    fetch(
      `./backend/profile/profile.php?action=getRequestModalContent&requestData=${requestData}`
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
        modalContent.innerHTML = data.modal;

        requestModal = new bootstrap.Modal(modal);

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
        if (type != "refresh") {
          requestModal.show();
        }
      });
  }

  document.addEventListener('input', function(e) {
    if (e.target.classList.contains('redeem-code')) {
      if (e.target.value.length === 5) {
        var passengerID = e.target.getAttribute('data-passengerID');
        var carpoolID = e.target.getAttribute('data-carpoolID');
        var index = e.target.getAttribute('data-index');
        var code = e.target.value;
        var codeData = {
          passengerID: passengerID,
          carpoolID: carpoolID,
          code: code
        };
        var formData = new FormData();
        formData.append("codeData", JSON.stringify(codeData));
        fetch("./backend/profile/redeemCode.php", {
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
            console.log(data);
            alert(data.message);
            getRequestTable();
            data['action'] = 'refresh';
            data['index'] = document.getElementById("index").innerHTML;
            getRequestModalContent(data);
          });
      }
    }
  });

  var rewardModal = null;
  function getRewardModalContent() {
    var data = {
      action: "newRequestModal",
      index: this.getAttribute("data-redemptionIndex"),
      redemptionID: this.getAttribute("data-redemptionID"),
    };

    var rewardData = encodeURIComponent(JSON.stringify(data));
    fetch(
      `./backend/profile/profile.php?action=getRewardModalContent&rewardData=${rewardData}`
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
        modalContent.innerHTML = data.modal;
        rewardModal = new bootstrap.Modal(modalContent);

        rewardModal.show();
      });
  }

  function manageRequest() {
    var requestData = {
      action: "manageRequest",
      type: this.getAttribute("data-type"),
      carpoolID: this.getAttribute("data-carpoolID"),
      accountID: this.getAttribute("data-accountID"),
    };
    //console.log(requestData);
    var formData = new FormData();
    formData.append("formData", JSON.stringify(requestData));

    fetch("./backend/profile/profile.php", {
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
            index: document.getElementById("index").innerHTML,
            carpoolID: data.carpoolID,
          };
          getRequestModalContent(refresh);
          getRequestTable();
        } else {
          alert(data.message);
        }
      });
  }
});
