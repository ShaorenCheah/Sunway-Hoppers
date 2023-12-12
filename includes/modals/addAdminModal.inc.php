<script src="scripts/registerAdmin.js"></script>
<script src="scripts/passwordVisibility.js"></script>
<div class="modal fade" tabindex="-1" id="addAdminModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body w-100 px-4 py-5">
        <div class="container-fluid">
          <h3 style="font-weight:700;">Register New Admin</h3>
          <form id="registerAdminForm" class="pt-3">
            <div class="form mb-3">
              <label for="adminName">Name</label>
              <input type="text" class="form-control" id="adminName" name="adminName">
              <small id="adminNameHelp" class="form-small-text" style="color: red"></small>
            </div>
            <div class="form mb-3">
              <label for="adminEmail">Email Address</label>
              <input type="email" class="form-control" id="adminEmail" name="adminEmail">
              <small id="adminEmailHelp" class="form-small-text" style="color: red"></small>
            </div>
            <div class="form mb-3">
              <label for="adminPhoneNo">Phone Number</label>
              <input type="tel" class="form-control" id="adminPhoneNo" name="adminPhoneNo">
              <small id="adminPhoneNoHelp" class="form-small-text">*Please enter phone number without dash (-)</small>
            </div>
            <div class="form mb-3">
              <label for="adminPwd">Password</label>
              <div class="input-group">
                <input type="password" class="form-control" id="adminPwd" name="adminPwd">
                <span class="input-group-text adminPwdEye" id="adminPwdIcon"><a><i class="bi bi-eye-slash-fill password-icon"></i></a></span>
              </div>
              <small id="adminPwdHelp" class="form-small-text">*Password should have at least 8 characters</small>
            </div>
            <div class="form mb-3">
              <label for="repeatAdminPwd">Repeat Password</label>
              <div class="input-group">
                <input type="password" class="form-control" id="repeatAdminPwd" name="repeatAdminPwd">
                <span class="input-group-text adminRepeatPwdEye" id="repeatAdminPwdIcon"><a><i class="bi bi-eye-slash-fill password-icon"></i></a></span>
              </div>
              <small id="repeatAdminPwdHelp" class="form-small-text" style="color: red"></small>
            </div>
            <div class="d-flex justify-content-center">
              <button type="submit" class="btn btn-primary shadow px-4" id="addAdminBtn" name=" addAdminBtn" disabled>Register</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>