<?php
session_start();
require_once __DIR__ . '/../../includes/db.php';

error_log("DELETE API CALLED");

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($_SESSION['temp_user'])) {
    error_log("Delete failed: not logged in");

    echo json_encode(["status"=>"error","message"=>"Unauthorized"]);
    exit;
}

$user_id = $_SESSION['temp_user'];
$file_id = $data['file_id'];
error_log("Deleting file ID: " . $file_id);

// get file
$stmt = $conn->prepare("SELECT file_path FROM uploads WHERE id=? AND user_id=?");
$stmt->bind_param("ii", $file_id, $user_id);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo json_encode(["status"=>"error","message"=>"Not found"]);
    exit;
}

$file = $result->fetch_assoc();

// delete file from server
if (file_exists($file['file_path'])) {
    unlink($file['file_path']);
}

// delete from DB
$stmt = $conn->prepare("DELETE FROM uploads WHERE id=? AND user_id=?");
$stmt->bind_param("ii", $file_id, $user_id);
$stmt->execute();
error_log("File deleted successfully");

echo json_encode(["status"=>"success"]);
