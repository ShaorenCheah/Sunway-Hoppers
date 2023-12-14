<?php

// Check if the session has expired (30 Minutes)
if (isset($_SESSION['login_time']) && time() - $_SESSION['login_time'] > 1800) {
  // Show an alert
  echo "
  <script>
    alert('Your session has expired. Please log in again.');
    window.location.href='index.php';
  </script>";

  // Session has expired, destroy it
  session_unset();
  session_destroy();

} else {
  // Session has not expired, update the login time
  $_SESSION['login_time'] = time();
}

?>