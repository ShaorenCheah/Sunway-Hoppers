<?php
require_once './connection.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}

$formJSON = $_POST['formData'];
$data = json_decode($formJSON, true);

$action = $data['action'];

// Login Process
if ($action == 'login') {
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
}


// Register Process
if ($action == 'register') {
  if (isset($data['userPwd']) === isset($data['repeatPwd'])) {
    $username = $data['username'];
    $email = $data['email'];
    $pwd = $data['userPwd'];
    $phoneNo = $data['phoneNo'];
    $dob = $data['dob'];
    $gender = $data['gender'];

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    // Get new accountID
    $query = "SELECT COUNT(*) FROM Account";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $count = $stmt->fetchColumn();
    $accountID = "A" . str_pad($count + 1, 4, "0", STR_PAD_LEFT);

    // Insert new account
    $query   = "INSERT INTO account (accountID, email, password, type) VALUES (:accountID, :email, :password, 'Passenger')";
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
      $query = "SELECT COUNT(*) FROM User";
      $stmt = $pdo->prepare($query);
      $stmt->execute();
      $count = $stmt->fetchColumn();
      $userID = "U" . str_pad($count + 1, 4, "0", STR_PAD_LEFT);

      // Insert new user
      $query   = "INSERT INTO user (userID, name, phoneNo, gender, dob, accountID) VALUES (:userID, :name, :phoneNo, :gender, :dob, :accountID)";
      $query_run = $pdo->prepare($query);
      $data = [
        ':userID' => $userID,
        ':name' => $username,
        ':phoneNo' => $phoneNo,
        ':gender' => $gender,
        ':dob' => $dob,
        ':accountID' => $accountID  
      ];
      $query_execute = $query_run->execute($data);
      
      $success = true;
      $message = "Account created successfully! Please login with your credentials to proceed.";
    } else {
      $success = false;
      $message = "Account created failed. Please try again.";
    }

    // if ($query_execute) {
    //   header('Location: index.php');
    //   exit(0);
    // } else {
    //   $_SESSION['message'] = "Not Inserted";
    //   header('Location: reward.php');
    //   exit(0);
    // }
  }
}


$stmt = null;

// Send a JSON response indicating success or failure
$response = [
  'success' => $success,
  'action' => $action,
  'message' => $message
];

echo json_encode($response);
