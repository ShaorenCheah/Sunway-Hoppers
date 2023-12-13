document.addEventListener("DOMContentLoaded", function () {
  var activeModal = false;
  var intervalId = null;

  function getRating() {
    if (activeModal) {
      clearInterval(intervalId);
      return;
    }
    console.log("getRating");

    var data = { action: "getRating" };
    var ratingData = new FormData();
    ratingData.append("ratingData", JSON.stringify(data));
    fetch("./backend/rating.php", {
      method: "POST",
      body: ratingData,
    })
      .then((response) => response.json())
      .then((data) => {
        console.log(data);
        if (data.status == "newRating") {
          var ratingModal = document.getElementById("ratingModal");
          ratingModal.innerHTML = data.modal;
          var ratingModal = new bootstrap.Modal(ratingModal);
          activeModal = !activeModal;
          ratingModal.show();
          initializeRating();
        }
      });
  }

  function initializeRating() {
    let stars = document.querySelectorAll(".ratings span");
    let rateBtn = document.getElementById("rateBtn");
    for (let star of stars) {
      star.addEventListener("click", function () {
        let children = Array.from(star.parentElement.children).reverse();
        let clickedIndex = children.indexOf(star);
        // Reset data-clicked attribute for all stars in the group
        for (let i = 0; i < children.length; i++) {
          children[i].setAttribute("data-clicked", i <= clickedIndex ? "true" : "false");
        }
        let rating = this.dataset.rating;
        let data = {
          rating: rating,
        };
        console.log(data);
        rateBtn.disabled = false;
      });
    }
  }

  intervalId = setInterval(getRating, 5000);
});
