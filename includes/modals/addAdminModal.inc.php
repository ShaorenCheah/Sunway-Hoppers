<script src="scripts/registerAdmin.js"></script>
<div class="modal fade" tabindex="-1" id="addAdminModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body w-100 px-4 py-5">
                <div class="container-fluid">
                    <h3 style="font-weight:700;">Register New Admin</h3>
                    <form id="registerAdminForm" class="pt-3">
                        <div class="form mb-3">
                            <label for="username">Name</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="" required>
                        </div>
                        <div class="form mb-3">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="" required>
                        </div>
                        <div class="form mb-3">
                            <label for="phoneNo">Phone Number</label>
                            <input type="tel" class="form-control" id="phoneNo" name="phoneNo" placeholder="" required>
                        </div>
                        <div class="form mb-3">
                            <label for="userPwd">Password</label>
                            <input type="password" class="form-control" id="userPwd" name="userPwd" placeholder="" required>
                        </div>
                        <div class="form mb-3">
                            <label for="repeatPwd">Repeat Password</label>
                            <input type="password" class="form-control" id="repeatPwd" name="repeatPwd" placeholder="" required>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary shadow px-4" id="addAdminBtn" name=" addAdminBtn">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>