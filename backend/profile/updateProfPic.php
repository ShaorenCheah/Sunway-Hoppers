<?php
require_once '../connection.php';
session_start();

if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
	$fileTmpPath = $_FILES['image']['tmp_name'];
	$fileName = $_FILES['image']['name'];
	$fileSize = $_FILES['image']['size'];
	$fileType = $_FILES['image']['type'];
	$fileNameCmps = explode(".", $fileName);
	$fileExtension = strtolower(end($fileNameCmps));

	// Check if the file extension is allowed
	$allowedfileExtensions = array('jpg', 'png', 'jpeg');
	if (in_array($fileExtension, $allowedfileExtensions)) {
		$newFileName = md5(time() . $fileName) . '.' . $fileExtension;
		// Set the upload directory
		$uploadFileDir = "../../uploads/profile_pics/";
		$dest_path = $uploadFileDir . $newFileName;

		// Move the uploaded file to the destination
		if (move_uploaded_file($fileTmpPath, $dest_path)) {
			$profPic = "./uploads/profile_pics/" . $newFileName;

			// update data into the database
			$updateQuery = "UPDATE user SET profilePic = :profilePic WHERE accountID = :accountID";
			$updateStmt = $pdo->prepare($updateQuery);
			$updateStmt->bindParam(':profilePic', $profPic, PDO::PARAM_STR);
			$updateStmt->bindParam(':accountID', $_SESSION['user']['accountID'], PDO::PARAM_STR);
			$updateStmt->execute();
			$message = 'Profile picture is successfully changed.';
			$_SESSION['user']['profilePic'] = $profPic;
		} else {
			$message = 'Error moving the uploaded file.';
		}
	} else {
		$message = 'Invalid file extension. Allowed extensions: jpg, png, jpeg.';
	}
} else {
	$message = 'Error uploading the file.';
}

$response = [
	'action' => 'addProfilePic',
	'message' => $message,
];

echo json_encode($response);


