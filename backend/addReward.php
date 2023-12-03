<?php
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  try {
    // Check if the file was uploaded without errors
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
        $uploadFileDir = "../uploads/rewards/";
        $dest_path = $uploadFileDir . $newFileName;

        // Move the uploaded file to the destination
        if (move_uploaded_file($fileTmpPath, $dest_path)) {
          // Extract form data
          $rewardName = $_POST['rewardName'];
          $description = $_POST['desc'];
          $points = $_POST['points'];
          $type = $_POST['type'];
          $quantity = $_POST['qty'];
          $img = "./uploads/rewards/" . $newFileName;

          // Generate rewardID
          $query = "SELECT COUNT(*) FROM reward";
          $stmt = $pdo->prepare($query);
          $stmt->execute();
          $count = $stmt->fetchColumn();
          $rewardID = "R" . str_pad($count + 1, 4, "0", STR_PAD_LEFT);

          // Insert data into the database
          $insertQuery = "INSERT INTO reward (rewardID, rewardName, description, img, points, type, quantity) VALUES (:rewardID, :rewardName, :description, :img, :points, :type, :quantity)";
          $insertStmt = $pdo->prepare($insertQuery);
          $insertStmt->bindParam(':rewardID', $rewardID, PDO::PARAM_STR);
          $insertStmt->bindParam(':rewardName', $rewardName, PDO::PARAM_STR);
          $insertStmt->bindParam(':description', $description, PDO::PARAM_STR);
          $insertStmt->bindParam(':img', $img, PDO::PARAM_STR);
          $insertStmt->bindParam(':points', $points, PDO::PARAM_STR);
          $insertStmt->bindParam(':type', $type, PDO::PARAM_STR);
          $insertStmt->bindParam(':quantity', $quantity, PDO::PARAM_STR);
          $insertStmt->execute();
          $message = 'New reward added.';
        } else {
          $message = 'Error moving the uploaded file.';
        }
      } else {
        $message = 'Invalid file extension. Allowed extensions: jpg, png, jpeg.';
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
  echo "<script>window.location = '../dashboard.php?navPage=reward';</script>";
}
