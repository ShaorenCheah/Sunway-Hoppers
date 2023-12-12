<div class="modal fade" tabindex="-1" id="profilePicModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body w-100 p-4">
        <div class="container-fluid">
          <div class="row text-center">
            <h4 style="font-weight:700;">Update Your Profile Picture</h4>
            <div class="justify-content-center d-flex">
              <img id="previewImage" src="<?php echo $_SESSION['user']['profilePic']; ?>" alt="Avatar" class="my-4" style="border-radius: 50%; height: 10rem; width: 10rem; border: 0.2rem solid var(--secondary); object-fit: cover;">
            </div>
            <form id="profPicForm" method="post" enctype="multipart/form-data" >
              <div class="mb-4 px-4">
                <input type="file" class="form-control" id="image" name="image" required onchange="previewImage()" accept=".jpg, .jpeg, .png">
                <small class="form-small-text">*Only JPG, JPEG and PNG files are allowed.</small>
              </div>
              <button type="submit" name="updatePicBtn" id="updatePicBtn" class="btn btn-primary shadow px-4" disabled>Update</button>
            </form>
          </div>
          <div class="col"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
function previewImage() {
  var input = document.getElementById('image');
  var preview = document.getElementById('previewImage');

  var reader = new FileReader();

  reader.onload = function(e) {
    preview.src = e.target.result;

    // Change border color to var(--primary)
    preview.style.border = '0.2rem solid var(--primary)';
  };

  reader.readAsDataURL(input.files[0]);
  document.getElementById('updatePicBtn').disabled = false;
}

document.getElementById('profPicForm').addEventListener('submit', function(e) {
  e.preventDefault();
  var formData = new FormData();
  var fileField = document.querySelector('#image');

  formData.append('image', fileField.files[0]);

  fetch('./backend/profile/updateProfPic.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.json())
  .then(data => {
    alert(data.message);
    location.reload();
  })
});
</script>

