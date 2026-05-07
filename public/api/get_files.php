<?php
session_start();
require_once __DIR__ . '/../../includes/db.php';

error_log("GET FILES API CALLED");


if (!isset($_SESSION['temp_user'])) {
    error_log("User not logged in for get_files");

    echo json_encode([]);
    exit;
}

$user_id = $_SESSION['temp_user'];

// ✅ include file_path
$stmt = $conn->prepare("SELECT id, file_name, file_path FROM uploads WHERE user_id=?");
$stmt->bind_param("i", $user_id);
$stmt->execute();

$result = $stmt->get_result();
$files = [];

while ($row = $result->fetch_assoc()) {
    $files[] = $row;
}

error_log("Files fetched: " . count($files));

echo json_encode($files);
