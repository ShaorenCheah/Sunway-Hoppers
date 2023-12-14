function deleteUser(accountID) {
  // You can use AJAX or fetch to send a request to the server to delete the user
  // For demonstration purposes, let's log the accountID to the console.
  console.log('Deleting user with accountID:', accountID);

  // You can add AJAX or fetch code here to send a request to delete the user on the server.
  // Example using fetch:
  var formData = new FormData();
  formData.append("formData", JSON.stringify({accountID: accountID, action: 'deleteUser' }));

  fetch('./backend/manageUserAcc.php', {
      method: 'POST',
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
    console.error("Error during deletion:", error);
    alert("Error deleting user");
  });
}
