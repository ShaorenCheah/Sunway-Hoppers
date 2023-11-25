<?php
require_once 'connection.php';
session_start();

$accountID = $_SESSION['user']['accountID'];
$carNo = $_POST['carNo'];
$carType = $_POST['carType'];
$carColour = $_POST['carColour'];
$carRules = $_POST['carRules'];
$driverBio = $_POST['driverBio'];

$query = "SELECT COUNT(*) FROM application";
$stmt = $pdo->prepare($query);
$stmt->execute();
$count = $stmt->fetchColumn();
$appID = "APP" . str_pad($count + 1, 4, "0", STR_PAD_LEFT);

//	applicationID	accountID	vehicleNo	vehicleType	vehicleColour	driverCredentials	driverBio vehicleRules



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Check if the file was uploaded without errors
        if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['file']['tmp_name'];
            $fileName = $_FILES['file']['name'];
            $fileSize = $_FILES['file']['size'];
            $fileType = $_FILES['file']['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            // Check if the file extension is allowed
            $allowedfileExtensions = array('zip');
            if (in_array($fileExtension, $allowedfileExtensions)) {
                $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                // Set the upload directory
                $uploadFileDir = "../applications/";
                $dest_path = $uploadFileDir . $newFileName;

                // Move the uploaded file to the destination
                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    $downloadLink = 'http://localhost/sunwayhoppers/applications/' . $newFileName;

                    // Insert new account
                    $query   = "INSERT INTO application (applicationID, accountID, vehicleNo, vehicleType, vehicleColour, driverCredentials, driverBio, vehicleRules) 
    VALUES (:applicationID, :accountID, :vehicleNo, :vehicleType, :vehicleColour, :driverCredentials, :driverBio, :vehicleRules)";
                    $stmt = $pdo->prepare($query);
                    $stmt->bindParam(':accountID', $accountID, PDO::PARAM_STR);
                    $stmt->bindParam(':applicationID', $appID, PDO::PARAM_STR);
                    $stmt->bindParam(':vehicleNo', $carNo, PDO::PARAM_STR);
                    $stmt->bindParam(':vehicleType', $carType, PDO::PARAM_STR);
                    $stmt->bindParam(':vehicleColour', $carColour, PDO::PARAM_STR);
                    $stmt->bindParam(':driverCredentials', $downloadLink, PDO::PARAM_STR);
                    $stmt->bindParam(':driverBio', $driverBio, PDO::PARAM_STR);
                    $stmt->bindParam(':vehicleRules', $carRules, PDO::PARAM_STR);

                    $stmt->execute();
                    $message = 'Application sent.';
                } else {
                    $message = 'Error moving the uploaded file.';
                }
            } else {
                $message = 'Invalid file extension. Allowed extensions: zip.';
            }
        } else {
            $message = 'Error uploading the file.';
        }
    } catch (Exception $e) {
        $message = 'Error processing the request: ' . $e->getMessage();
    }
    alert($message);
}

function alert($msg)
{
    echo "<script>alert('" . $msg . "');</script>";
    echo "<script>window.location = '../profile.php';</script>";
}
