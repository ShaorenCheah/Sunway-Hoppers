<?php
require_once './includes/connection.php';

if (isset($_POST['registerSubmit'])) {
    if (isset($_POST['userPwd']) === isset($_POST['repeatPwd'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $pwd = $_POST['userPwd'];
        $phoneNo = $_POST['phoneNo'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];

        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        $query   = "INSERT INTO account (email, password) VALUES (:email, :password)";
        $query_run = $pdo->prepare($query);
        $data = [
            ':email' => $email,
            ':password' => $hashedPwd,
        ];
        $query_execute = $query_run->execute($data);

        $query   = "SELECT accountID FROM account WHERE email = :email";
        $statement = $pdo->prepare($query);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->setFetchMode(PDO::FETCH_OBJ);

        $statement->execute();

        $result = $statement->fetch();

        if ($result) {
            $accountID = $result->accountID;
            $query   = "INSERT INTO user (name, phoneNo, gender, dob, accountID) VALUES (:name, :phoneNo, :gender, :dob, :accountID)";
            $query_run = $pdo->prepare($query);
            $data = [
                ':name' => $username,
                ':phoneNo' => $phoneNo,
                ':gender' => $gender,
                ':dob' => $dob,
                ':accountID' => $accountID,
            ];
            $query_execute = $query_run->execute($data);
            // Process or use $accountID as needed
        } else {
            // Handle the case where no matching record is found
        }


        if ($query_execute) {
            header('Location: index.php');
            exit(0);
        } else {
            $_SESSION['message'] = "Not Inserted";
            header('Location: reward.php');
            exit(0);
        }
    }
}


?>
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
                                    <form action="./index.php" method="post">
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
                                                        <option value="m">Male</option>
                                                        <option value="f">Female</option>
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
                                        <button type="submit" class="btn btn-primary shadow px-4" name="registerSubmit">Register</button>
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