<div class="modal fade" tabindex="-1" id="registerDriverModal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body w-100 p-4">
                <div class="container-fluid">
                    <div class="row">
                        <h4 style="font-weight:700;">Be a Driver Today!</h4>
                        <form id="registerDriverForm" method="post" enctype="multipart/form-data" action="../backend/registerDriver.php">
                            <h6>Car Details</h6>
                            <div class="row mb-4">
                                <div class="col ">
                                    <label for="carNo" class="form-label ">Car Plate Number <i class="bi bi-123"></i></label>
                                    <input type="text" class="form-control" id="carNo" name="carNo" placeholder="Ex: ABC1234" required>
                                </div>
                                <div class="col">
                                    <label for="carType" class="form-label">Car Type <i class="bi bi-car-front-fill"></i></label>
                                    <input type="text" class="form-control" id="carType" name="carType" placeholder="Ex: Perodua Axia" required>
                                </div>
                                <div class="col">
                                    <label for="carColour" class="form-label">Car Colour <i class="bi bi-palette"></i></label>
                                    <select name="carColour" id="carColour" class="form-select" onchange="checkColor()">
                                        <option selected disabled>-Select-</option>
                                        <option value="red">Red</option>
                                        <option value="blue">Blue</option>
                                        <option value="green">Green</option>
                                        <option value="white">White</option>
                                        <option value="black">Black</option>
                                        <option value="silver">Silver</option>
                                        <option value="gray">Gray</option>
                                        <option value="yellow">Yellow</option>
                                        <option value="orange">Orange</option>
                                        <option value="purple">Purple</option>
                                        <option value="brown">Brown</option>
                                        <option value="pink">Pink</option>
                                        <option value="other">Others</option>
                                    </select </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="files" class="form-label">Driver License & Vehicle License <i class="bi bi-file-earmark-person"></i></label>
                                <input type="file" class="form-control" id="file" name="file" accept=".zip" required>
                                <div id="fileNote" class="form-text">**Upload a zipped folder containing both documents [format accepted: .zip]</div>
                                <hr class="my-4">
                            </div>
                            <h6>Driver Information</h6>
                            <div class="mb-4">
                                <label for="driverBio" class="form-label ">Introduce Yourself <i class="bi bi-chat-dots-fill"></i></label>
                                <textarea class="form-control" id="driverBio" name="driverBio" placeholder="This helps your passengers know you better. Who knows you two might share similar interests?" required></textarea>
                            </div>
                            <div class="mb-4">
                                <label for="carRules" class="form-label">Car Rules <i class="bi bi-list-ol"></i></label>
                                <textarea class="form-control" id="carRules" name="carRules" style="height: 8rem" placeholder="Ex: No food in my car!" required></textarea>
                            </div>
                            <p class="text-muted text-center">SunwayHoppers admins will go through your driver application</p>
                            <div class="d-flex justify-content-center">
                                <button type="submit" name="submitDriverBtn" id="submitDriverBtn" class="btn btn-primary shadow px-4">Apply</button>
                            </div>
                        </form>
                    </div>
                    <div class="col"></div>
                </div>
            </div>
        </div>
    </div>
</div>