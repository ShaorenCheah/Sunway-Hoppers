document.addEventListener("DOMContentLoaded", function () {
  var activeModal = false;
  var intervalId = null;
  var ratingModal = null;

  function getRating() {
    if (activeModal) {
      clearInterval(intervalId);
      return;
    }
    //console.log("getRating");

    var data = { action: "getRating" };
    var ratingData = new FormData();
    ratingData.append("ratingData", JSON.stringify(data));
    fetch("./backend/rating.php", {
      method: "POST",
      body: ratingData,
    })
      .then((response) => response.json())
      .then((data) => {
        //console.log(data);
        if (data.status == "newRating") {
          var ratingModalElement = document.getElementById("ratingModal");
          ratingModalElement.innerHTML = data.modal;
          ratingModal = new bootstrap.Modal(ratingModalElement);
          activeModal = !activeModal;
          ratingModal.show();
          initializeRating(data.rating);
        }
      });
  }

  function initializeRating(ratingData) {
    let stars = document.querySelectorAll(".ratings span");
    let rateBtn = document.getElementById("rateBtn");

    for (let star of stars) {
      star.addEventListener("click", function () {
        let children = Array.from(star.parentElement.children).reverse();
        let clickedIndex = children.indexOf(star);
        // Reset data-clicked attribute for all stars in the group
        for (let i = 0; i < children.length; i++) {
          children[i].setAttribute(
            "data-clicked",
            i <= clickedIndex ? "true" : "false"
          );
        }
        let rating = this.dataset.rating;
        let data = {
          ratingData: ratingData,
          rating: rating,
        };
        // console.log(data);
        let newRateBtn = rateBtn.cloneNode(true);
        rateBtn.parentNode.replaceChild(newRateBtn, rateBtn);
        rateBtn = newRateBtn;

        rateBtn.addEventListener("click", function () {
          submitRating(data);
          activeModal = !activeModal;
          ratingModal.hide();
        });

        rateBtn.disabled = false;
      });
    }
  }

  function submitRating(data) {
    var ratingData = data;
    ratingData["action"] = "submitRating";
    // console.log(ratingData);
    var ratingData = new FormData();
    ratingData.append("ratingData", JSON.stringify(data));
    fetch("./backend/rating.php", {
      method: "POST",
      body: ratingData,
    })
      .then((response) => response.json())
      .then((data) => {
        alert(data.message);
        createNotification(data.notification)
      });
  }

  function createNotification(data) {
    // console.log(data);
    var notificationData = new FormData();
    notificationData.append("notificationData", JSON.stringify(data));
    fetch("./backend/notification.php", {
      method: "POST",
      body: notificationData,
    })
      .then((response) => response.json())
      .then((data) => {
        //console.log(data);
      });
  }

  intervalId = setInterval(getRating, 5000);
});
