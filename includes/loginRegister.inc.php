<?php
require_once './connection.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$formJSON = $_POST['formData'];
$data = json_decode($formJSON, true);

if ($data['action'] == 'login') {
    $email_temp = $data['email'];
    $pw_temp = $data['password'];

    $stmt = $pdo->prepare('SELECT * FROM account WHERE email = :email');
    $stmt->bindParam(':email', $email_temp, PDO::PARAM_STR);
    $stmt->execute();

    // Fetch the result
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $rowCount = $stmt->rowCount();
    
    if ($rowCount > 0) {
        $success = true;

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
            // echo '<script type="text/javascript"> ';
            // echo 'alert("Invalid username/password combination");';
            // echo '</script>';
        }
    } else {
        $success = false;
    }

    $stmt = null;

    // Send a JSON response indicating success or failure
    $response = [
        'success' => $success,
        'name' => $_SESSION['name'],
    ];

    echo json_encode($response);
}
