<?php
require_once './connection.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (isset($_POST['loginSubmit'])) {
    $email_temp = $_POST['accEmail'];
    $pw_temp = $_POST['accPwd'];

    $stmt = $pdo->prepare('SELECT * FROM account WHERE email = :email');
    $stmt->bindParam(':email', $email_temp, PDO::PARAM_STR);
    $stmt->execute();

    // Fetch the result
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $rowCount = $stmt->rowCount();

    if ($rowCount > 0) {
        // Remove the unnecessary fetch, as you already fetched the result into $result
        $email = $result['email'];
        $pw = $result['password'];

        if (password_verify($pw_temp, $pw)) {
            // Password is correct
            if (session_status() !== PHP_SESSION_ACTIVE) {
                session_start();
            }
            $_SESSION['name'] = $email;
        } else {
            echo '<script type="text/javascript"> ';
            echo 'alert("Invalid username/password combination");';
            echo '</script>';
        }
    } else {
        // No matching records found
        die("User not found");
    }
}
?>

<div class="modal" tabindex="-1" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body w-100 text-center">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col"></div>
                        <div class="col-9">
                            <form action="./index.php" method="post">
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
                                    <button type="submit" name="loginSubmit" class="btn btn-primary shadow px-4 m-4">Login</button>
                                </div>
                                <p>Don't have an account? <a href="#" style="text-decoration: none; color: #F6931A;" data-bs-toggle="modal" data-bs-target="#registerModal">Sign Up</a></p>
                            </form>
                        </div>
                        <div class="col"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>