document.addEventListener("DOMContentLoaded", function () {
  window.onload = function () {

    fetch("./backend/findCarpool.php?action=getProfile")
    .then((response) => response.text())
    .then((data) => {
      districtSelect.innerHTML = data;
    });
  };
});
