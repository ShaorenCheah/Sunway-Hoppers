<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require './connection.php';

    session_start();

    // Get user ID
    $accountID = $_SESSION['user']['accountID'];

    // Get bio from POST data
    $bio = $_POST['descText'];

    // Update the database
    $stmt = $pdo->prepare('UPDATE user SET bio = :bio WHERE accountID = :accountID');
    $stmt->bindParam(':bio', $bio);
    $stmt->bindParam(':accountID', $accountID);
    $stmt->execute();

    // Send a success response (you can customize this based on your needs)
    $msg = 'Bio updated successfully';
    alert($msg);
} else {
    // Handle invalid requests (optional)
    $msg = 'Bio was not updated. Please try again.';
    alert($msg);
}

function alert($msg){
    echo "<script>alert('".$msg."');</script>";
    echo "<script>window.location = '../profile.php';</script>";
}
?>

