<?php
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
    // Check if the file was uploaded without errors
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {

        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = $_FILES['image']['name'];
        $fileSize = $_FILES['image']['size'];
        $fileType = $_FILES['image']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        // sanitize file-name
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

        // check if file has one of the following extensions
        $allowedfileExtensions = array('jpg', 'png', 'jpeg');
        if (in_array($fileExtension, $allowedfileExtensions)) {
            // directory in which the uploaded file will be moved
            $uploadFileDir = "images/uploads/";
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {

                $formJSON = $_POST['formData'];
                $data = json_decode($formJSON, true);
                $action = $data['action'] = 'addReward';

                //create new rewardID
                $query = "SELECT COUNT(*) FROM reward";
                $stmt = $pdo->prepare($query);
                $stmt->execute();
                $count = $stmt->fetchColumn();
                $rewardID = "R" . str_pad($count + 1, 4, "0", STR_PAD_LEFT);

                $rewardName = $data['rewardName'];
                $description = $data['desc'];
                $points = $data['points'];
                $type = $data['type'];
                $quantity = $data['qty'];

                $query = "INSERT INTO reward (rewardID, rewardName, description, img, points, type, quantity) VALUES (:rewardID, :rewardName, :description, :img, :points, :type, :quantity)";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':rewardID', $rewardID, PDO::PARAM_STR);
                $stmt->bindParam(':rewardName', $rewardName, PDO::PARAM_STR);
                $stmt->bindParam(':description', $description, PDO::PARAM_STR);
                $stmt->bindParam(':img', $dest_path, PDO::PARAM_STR);
                $stmt->bindParam(':points', $points, PDO::PARAM_STR);
                $stmt->bindParam(':type', $type, PDO::PARAM_STR);
                $stmt->bindParam(':quantity', $quantity, PDO::PARAM_STR);
                $stmt->execute();

                $success = true;
                $message = "New reward added.";
            } else {
                $success = false;
                $message = 'There was an error uploading the file. Please try again.';
            }
        } else {
            $success = false;
            $message = 'There was an error uploading the file. Please try again.';
        }
    }
}

$stmt = null;

$response = [
    'success' => $success,
    'action' => $action,
    'message' => $message,
];
// Send a JSON response indicating success or failure

echo json_encode($response);
