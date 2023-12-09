document.addEventListener("DOMContentLoaded", function () {
  document.getElementById('addRewardBtn').addEventListener('click', getRewardData);

  function getRewardData(event) {
    document.getElementById('rewardForm2').submit();

    event.preventDefault();

    var rewardForm = document.getElementById('rewardForm1');
    var rewardName = rewardForm.elements['rewardName'].value;
    var desc = rewardForm.elements['desc'].value;
    var points = rewardForm.elements['points'].value;
    var type = rewardForm.elements['type'].value;
    var qty = rewardForm.elements['qty'].value;

    var rewardData = {
      action: 'addReward',
      rewardName,
      desc,
      points,
      type,
      qty
    };

    sendData(rewardData);
  }

  function sendData(data) {
    var formData = new FormData();
    formData.append('formData', JSON.stringify(data));

    fetch('./backend/addReward.php', {
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
