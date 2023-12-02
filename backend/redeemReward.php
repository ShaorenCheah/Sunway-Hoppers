<?php
require_once 'connection.php';

// Check if the 'formData' key exists in the POST request
if (!isset($_POST['formData'])) {
    $response = [
        'success' => false,
        'message' => 'Invalid request. formData is missing.',
    ];

    echo json_encode($response);
    exit; // Stop further execution
}

$formJSON = $_POST['formData'];
$data = json_decode($formJSON, true);

// Check if required keys exist in the decoded JSON
if (!isset($data['userPoints']) || !isset($data['requiredPoints'])) {
    $response = [
        'success' => false,
        'message' => 'Invalid request. Missing userPoints or requiredPoints.',
    ];

    echo json_encode($response);
    exit; // Stop further execution
}

$userPoints = $data['userPoints'];
$requiredPoints = $data['requiredPoints'];
$accountID = $data['accountID'];

// Perform the redemption logic
$newPoints = $userPoints - $requiredPoints;

// Update the user's points in the database
$updateQuery = "UPDATE user SET rewardPoints = :newPoints WHERE accountID = :accountID";
$stmt = $pdo->prepare($updateQuery);
$stmt->bindParam(':newPoints', $newPoints, PDO::PARAM_INT);
$stmt->bindParam(':accountID', $accountID, PDO::PARAM_STR);

// Check if the update query was successful
if ($stmt->execute()) {
    $success = true;
    $message = "You have successfully redeemed this reward! Your new points balance is $newPoints.";
} else {
    $success = false;
    $message = "Error updating user points in the database.";
}

$response = [
    'success' => $success,
    'message' => $message,
];

// Send a JSON response indicating success or failure
echo json_encode($response);
?>
