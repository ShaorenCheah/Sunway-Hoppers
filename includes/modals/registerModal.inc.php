<div class="modal fade" tabindex="-1" id="registerModal">
  <div class="modal-dialog modal-dialog-centered modal-xl h-25">
    <div class="modal-content">
      <div class="modal-body w-100 text-center">
        <div class="container-fluid">
          <div class="row">
            <div class="col d-flex align-items-center mx-2">
              <div>
                <div class="row">
                  <p style="font-weight: bold; font-size: 2.2rem; text-align:left;">
                    Carpooling With <span class="highlight2">Purpose</span>,<br>
                    Connecting Through <span class="highlight2">Hops</span>.<br>
                  </p>
                </div>
                <div class="row my-2">
                  <p style="font-weight: 300; text-align:left;">
                    Start reducing your carbin footprint today and make a difference. Sign up now and be a part of our carpool community!</p>
                </div>
                <div class="row">
                  <img src="./images/route.png">
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card text-center shadow m-4">
                <div class="card-body my-3 mx-4">
                  <form id="registerForm">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="username" name="username" placeholder="">
                      <label for="username">Name</label>
                      <small id = "usernameHelp" class="form-small-text">*Enter a name that will help drivers recognise you</small>
                    </div>
                    <div class="form-floating mb-3">
                      <input type="email" class="form-control" id="email" name="email" placeholder="">
                      <label for="email">Email Address</label>
                      <small id="emailHelp" class="form-small-text">*Please register with your Sunway student imail</small>
                    </div>
                    <div class="form-floating mb-3">
                      <input type="tel" class="form-control" id="phoneNo" name="phoneNo" placeholder="">
                      <label for="phoneNo">Phone Number</label>
                      <small id="phoneNoHelp" class="form-small-text">*Please enter phone number without dash (-)</small>
                    </div>
                    <div class="row">
                      <div class="col mb-3">
                        <div class="form-floating">
                          <input type="date" class="form-control" id="dob" name="dob" placeholder="">
                          <label for="dob">Date of Birth</label>
                          <small id = "dobHelp" class="form-small-text"></small>
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-floating">
                          <select class="form-select" id="gender" name="gender" style="border-color: green">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                          </select>
                          <label for="gender">Gender</label>
                        </div>
                      </div>
                    </div>
                    <div class="form-floating mb-3">
                      <input type="password" class="form-control" id="userPwd" name="userPwd" placeholder="">
                      <label for="userPwd">Password</label>
                      <!--password strength meter-->
                      <div class="progress" style="height: 5px;">
                        <div class="progress-bar" id="password-strength-meter" role="progressbar" style="width: 0%;"></div>
                      </div>
                      <div class="d-flex flex-row justify-content-between">
                        <small id="cond1" class="form-small-text">8 characters &#x2717</small>
                        <small id="cond2" class="form-small-text">Numbers &#x2717</small>
                        <small id="cond3" class="form-small-text">Special characters &#x2717</small>
                      </div>
                    </div>
                    <div class="form-floating mb-3">
                      <input type="password" class="form-control" id="repeatPwd" name="repeatPwd" placeholder="">
                      <label for="repeatPwd">Repeat Password</label>
                      <small id="repeatPwdHelp" class="form-small-text"></small>
                    </div>
                    <button type="submit" class="btn btn-primary shadow px-4" id="registerBtn" name=" registerSubmit" disabled>Register</button>
                  </form>
                </div>
              </div>
              <div class="d-flex justify-content-end mx-4">
                <p>Already have an account? <a href="#" style="text-decoration: none; color: #F6931A;" onclick="showLoginModal()">Login</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>