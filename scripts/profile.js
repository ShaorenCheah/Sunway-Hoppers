document.addEventListener("DOMContentLoaded", function () {
  window.onload = function () {

    fetch("./backend/profile.php?action=getProfile")
    .then((response) => response.json())
    .then((data) => {
      console.log(data)
      document.getElementById("profilePic").setAttribute("src", data.user.profilePic);
    
      // Insert Profile Section HTML
      if(data.type == "Driver"){
        document.getElementById("userRating").innerHTML += data.user.rating +'<i class="ms-1 bi bi-star-fill"></i>';
        document.getElementById("ratingsAmt").innerHTML += "(" + data.user.ratingsAmt + " Ratings)";
      }
      document.getElementById("userPhoneNo").textContent = data.user.phoneNo;
      document.getElementById("userDOB").textContent = data.user.dob;
      document.getElementById("descText").textContent = data.user.bio;
      // Insert Account Status Section HTML
      document.getElementById("accStatus").innerHTML += data.html.accStatus;
      document.getElementById("statusImg").innerHTML += data.html.statusImg;
      document.getElementById("statusMsg").innerHTML += data.html.statusMsg;
    });

  };
});
