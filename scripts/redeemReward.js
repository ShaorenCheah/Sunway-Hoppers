// redeem reward when user clicks on redeem button
$(document).ready(function () {
  $('.redeemBtn').click(function () {
    var requiredPoints = $(this).data('points');
    var rewardID = $(this).data('reward');
    var accountID = $(this).data('account-id');
    var userPoints = $(this).data('user-points');

    var pointData = {
      requiredPoints: requiredPoints,
      userPoints: userPoints,
      accountID: accountID,
      rewardID: rewardID,
    }
    redeemReward(pointData);
  });
});

function redeemReward(pointData) {
  var confirmation = confirm("Are you sure you want to redeem this reward?");
  if (confirmation) {
    var formData = new FormData();
    formData.append("formData", JSON.stringify(pointData));
    fetch("./backend/redeemReward.php", {
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
        console.error("Error during redemption:", error);
        alert("Error occurred during redemption");
      });
  }
}