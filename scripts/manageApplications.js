function rejectApplication(applicationID) {
  // Make an AJAX request to update the status to "Rejected"
  $.ajax({
    type: 'POST',
    url: 'backend/updateAppStatus.php',
    data: {
      applicationID: applicationID,
      status: 'Rejected'
    },
    success: function(response) {
      // Handle the response, if needed
      console.log(response);
      location.reload();
    },
    error: function(xhr, status, error) {
      // Handle errors, if any
      console.error(xhr.responseText);
    }
  });
}

function approveApplication(applicationID) {
  // Make an AJAX request to update the status to "Approved "
  $.ajax({
    type: 'POST',
    url: 'backend/updateAppStatus.php',
    data: {
      applicationID: applicationID,
      status: 'Approved'
    },
    success: function(response) {
      // Handle the response, if needed
      console.log(response);
      location.reload();
    },
    error: function(xhr, status, error) {
      // Handle errors, if any
      console.error(xhr.responseText);
    }
  });
}