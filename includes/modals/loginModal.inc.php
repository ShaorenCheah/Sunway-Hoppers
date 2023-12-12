<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="./scripts/passwordVisibility.js"></script>

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
                <div class="form-floating mb-3">
                  <input type="email" class="form-control" id="accEmail" name="accEmail" placeholder="">
                  <label for="accEmail">Email Address</label>
                  <small id="accEmailHelp" class="form-small-text"></small>
                </div>
                <div class="input-group my-0">
                  <div class="form-floating flex-grow-1">
                    <input type="password" class="form-control" id="accPwd" name="accPwd" placeholder="">
                    <label for="accPwd">Password</label>
                  </div>
                  <span class="input-group-text" id="accPwdIcon"><a><i class="bi bi-eye-slash-fill password-icon"></i></a></span>
                </div>
                <small id="accPwdHelp" class="form-small-text"></small>
                <p class="mt-3" id="loginStatus" style="color:#F65555; font-weight: 500"></p>
                <a href="#" style="text-decoration: none; color: #F6931A;">Forgot Password?</a>
                <div>
                  <button name="loginSubmit" id="loginBtn" class="btn btn-primary shadow px-4 m-2 mb-4" disabled>Login</button>
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