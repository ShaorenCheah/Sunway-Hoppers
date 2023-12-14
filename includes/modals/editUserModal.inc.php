<?php
$modal .= <<<HTML
  <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-body w-100 px-4 py-5">
          <div class="container-fluid">
            <h3 style="font-weight:700;">Edit User Details</h3>
            <form id="editUserForm" class="pt-3" method="post">
              <div class="row mb-4">
                <div class="col ">
                  <label for="editName" class="form-label ">User Name</label>
                  <input type="text" class="form-control" id="editName" name="editName" value="{$user['name']}">
                  <small id="editNameHelp" class="form-small-text" style="color:red"></small>                  
                </div>
                <div class="col">
                  <label for="editPhone" class="form-label">Phone Number</label>
                  <input type="text" class="form-control" id="editPhone" name="editPhone" value="{$user['phoneNo']}">
                  <small id="editPhoneHelp" class="form-small-text" style="color:red"></small>                
                </div>
                <div class="col">
                  <label for="editEmail" class="form-label">Email</label>
                  <input type="text" class="form-control" id="editEmail" name="editEmail" value="{$user['email']}">
                  <small id="editEmailHelp" class="form-small-text" style="color:red"></small>               
                </div>
              </div>
              <div class="d-flex justify-content-center">
                <button type="submit" name="saveEditBtn" id="saveEditBtn" class="btn btn-primary shadow px-4" data-account-id="{$user['accountID']}" disabled>Save</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>
HTML;
