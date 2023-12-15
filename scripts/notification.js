document.addEventListener("DOMContentLoaded", function () {
  function getNotifications() {
    var data = { action: "getNotifications" };
    var notificationData = new FormData();
    notificationData.append("notificationData", JSON.stringify(data));
    fetch("./backend/notification.php", {
      method: "POST",
      body: notificationData,
    })
      .then((response) => response.json())
      .then((data) => {
         console.log(data);
        createToast(data.notifications);
      });
  }

  function createToast(notifications) {
    // Get the toast container
    var container = document.querySelector(".toast-container");

    notifications.forEach((notification) => {
      // Create toast element
      var toast = document.createElement("div");
      toast.className = "toast";
      toast.setAttribute("role", "alert");
      toast.setAttribute("aria-live", "assertive");
      toast.setAttribute("aria-atomic", "true");
      toast.setAttribute("data-bs-autohide", "false");

      // Create toast header
      var header = document.createElement("div");
      header.className = "toast-header";

      var img = document.createElement("img");
      img.src = "images/logo/tab.ico"; // replace with actual image source
      img.className = "rounded me-2";
      img.alt = "SunwayHoppers";
      img.style.width = "1.786rem"; 
      img.style.height = "1.786rem"; 

      var strong = document.createElement("strong");
      strong.className = "me-auto";
      strong.textContent = notification.title; // replace with actual notification title


      var button = document.createElement("button");
      button.type = "button";
      button.className = "btn-close";
      button.setAttribute("data-bs-dismiss", "toast");
      button.setAttribute("aria-label", "Close");

      // Append elements to header
      header.appendChild(img);
      header.appendChild(strong);
      header.appendChild(button);

      // Create toast body
      var body = document.createElement("div");
      body.className = "toast-body";
      body.textContent = notification.message; // replace with actual notification content

      // Append header and body to toast
      toast.appendChild(header);
      toast.appendChild(body);

      // Append toast to container
      container.appendChild(toast);

      // Show toast
      var toastInstance = new bootstrap.Toast(toast);
      toastInstance.show();
    });
  }

  // Call getNotifications every 5 seconds
  setInterval(getNotifications, 5000);
});
