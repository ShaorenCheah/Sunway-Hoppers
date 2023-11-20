<div class="modal" tabindex="-1" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
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
                      <input type="text" class="form-control" id="username" name="username" placeholder="" required>
                      <label for="username">Name</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input type="email" class="form-control" id="email" name="email" placeholder="" required>
                      <label for="email">Email Address</label>
                      <div class="d-flex justify-content-start mx-1">
                        <small id="email" class="form-text text-muted">*Please register with your Sunway student imail.</small>
                      </div>
                    </div>
                    <div class="form-floating mb-3">
                      <input type="tel" class="form-control" id="phoneNo" name="phoneNo" placeholder="" required>
                      <label for="phoneNo">Phone Number</label>
                    </div>
                    <div class="row">
                      <div class="col mb-3">
                        <div class="form-floating">
                          <input type="date" class="form-control" id="dob" name="dob" placeholder="" required>
                          <label for="dob">Date of Birth</label>
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-floating">
                          <select class="form-select" id="gender" name="gender" required>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                          </select>
                          <label for="gender">Gender</label>
                        </div>
                      </div>
                    </div>
                    <div class="form-floating mb-3">
                      <input type="password" class="form-control" id="userPwd" name="userPwd" placeholder="" required>
                      <label for="userPwd">Password</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input type="password" class="form-control" id="repeatPwd" name="repeatPwd" placeholder="" required>
                      <label for="repeatPwd">Repeat Password</label>
                    </div>
                    <button type="submit" class="btn btn-primary shadow px-4" id="registerBtn" name=" registerSubmit">Register</button>
                  </form>
                </div>
              </div>
              <div class="d-flex justify-content-end mx-4">
                <p>Already have an account? <a href="#" style="text-decoration: none; color: #F6931A;" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>