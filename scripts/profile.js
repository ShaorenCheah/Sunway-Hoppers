document.addEventListener("DOMContentLoaded", function () {
  window.onload = function () {

    fetch("./backend/profile.php?action=getProfile")
    .then((response) => response.json())
    .then((data) => {
      // console.log(data)
      console.log(data.html)
      console.log(data.user)

      // Insert Profile Section HTML

      // Insert Account Status Section HTML
      document.getElementById("accStatus").innerHTML += data.html.accStatus;
      document.getElementById("statusImg").innerHTML += data.html.statusImg;
      document.getElementById("statusMsg").innerHTML += data.html.statusMsg;
    });

  };
});
