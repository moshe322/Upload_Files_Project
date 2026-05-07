<?php
session_start();
require_once __DIR__ . '/../../includes/db.php';

error_log("UPLOAD API CALLED");


if (!isset($_SESSION['temp_user'])) {
    echo json_encode(["status"=>"error","message"=>"Login required"]);
    exit;
}

$user_id = $_SESSION['temp_user'];

if (!isset($_FILES['resume'])) {
    echo json_encode(["status"=>"error","message"=>"No file"]);
    exit;
}

$file = $_FILES['resume'];

error_log("Uploading file: " . $file['name']);

$filename = time() . "_" . basename($file["name"]);
$target_dir = __DIR__ . "/../../uploads/";
$target_file = $target_dir . $filename;

// create folder if not exists
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}

// upload file
if (move_uploaded_file($file["tmp_name"], $target_file)) {

    $stmt = $conn->prepare("INSERT INTO uploads(user_id, file_name, file_path) VALUES(?,?,?)");
    $stmt->bind_param("iss", $user_id, $filename, $target_file);
    $stmt->execute();

    error_log("File uploaded successfully: " . $filename);

    echo json_encode(["status"=>"success","message"=>"Uploaded"]);

} else {
    error_log("File upload failed");
    echo json_encode(["status"=>"error","message"=>"Upload failed"]);
}
