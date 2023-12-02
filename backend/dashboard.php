<?php
require_once 'connection.php';

$formJSON = $_POST['formData'];
$data = json_decode($formJSON, true);
$action = $data['action'];

if ($action == 'addAdmin') {
    $username = $data['username'];
    $email = $data['email'];
    $pwd = $data['userPwd'];
    $phoneNo = $data['phoneNo'];

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    // Get new accountID
    $query = "SELECT COUNT(*) FROM Account";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $count = $stmt->fetchColumn();
    $accountID = "A" . str_pad($count + 1, 4, "0", STR_PAD_LEFT);

    // Insert new account
    $query   = "INSERT INTO account (accountID, email, password, type) VALUES (:accountID, :email, :password, 'Admin')";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':accountID', $accountID, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':password', $hashedPwd, PDO::PARAM_STR);
    $stmt->execute();

    // Fetch the new accountID from DB
    $query   = "SELECT accountID FROM account WHERE email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute();
    $result = $stmt->fetch();

    if ($result) {
        $accountID = $result->accountID;

        // Create new userID
        $query = "SELECT COUNT(*) FROM admin";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        $adminID = "AD" . str_pad($count + 1, 4, "0", STR_PAD_LEFT);

        // Insert new user
        $query   = "INSERT INTO admin (adminID, accountID, name, phoneNo) VALUES (:adminID, :accountID, :name, :phoneNo)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':adminID', $adminID, PDO::PARAM_STR);
        $stmt->bindParam(':accountID', $accountID, PDO::PARAM_STR);
        $stmt->bindParam(':name', $username, PDO::PARAM_STR);
        $stmt->bindParam(':phoneNo', $phoneNo, PDO::PARAM_STR);
        $stmt->execute();

        $success = true;
        $message = "New admin account created successfully.";
    } else {
        $success = false;
        $message = "Account created failed. Please try again.";
    }
} else if ($action == '') {

  
}

$response = [
    'success' => $success,
    'action' => $action,
    'message' => $message,
];

echo json_encode($response);
?>