<div class="modal fade" tabindex="-1" id="loginModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body w-100 text-center">
        <div class="container-fluid">
          <div class="row">
            <div class="col"></div>
            <div class="col-9">
              <form id="loginForm">
                <img src="./images/logo/modal.png" width="100" style="margin: 2rem;">
                <h2 style="font-weight:700;">LOGIN</h2>
                <p style="font-size: 1rem;">Please enter your student email and password<br></p>
                <div class="form-floating mb-3 pb-2">
                  <input type="email" class="form-control" id="accEmail" name="accEmail" placeholder="" required>
                  <label for="accEmail">Email Address</label>
                </div>
                <div class="form-floating mb-3 pb-2">
                  <input type="password" class="form-control" id="accPwd" name="accPwd" placeholder="" required>
                  <label for="accPwd">Password</label>
                </div>
                <a href="#" style="text-decoration: none; color: #F6931A;">Forgot Password?</a>
                <div>
                  <button name="loginSubmit" id="loginBtn" class="btn btn-primary shadow px-4 m-4">Login</button>
                </div>
                <p>Don't have an account? <a href="#" style="text-decoration: none; color: #F6931A;" onclick="showRegisterModal()">Sign Up</a></p>
              </form>
            </div>
            <div class="col"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
