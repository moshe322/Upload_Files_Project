<?php
session_start();
require_once __DIR__ . '/../../includes/db.php';

if (!isset($_SESSION['temp_user'])) {
    die("Unauthorized");
}

$user_id = $_SESSION['temp_user'];
$file_id = $_GET['id'] ?? null;

if (!$file_id) {
    die("Invalid request");
}

// get file from DB
$stmt = $conn->prepare("SELECT file_name, file_path FROM uploads WHERE id=? AND user_id=?");
$stmt->bind_param("ii", $file_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("File not found");
}

$file = $result->fetch_assoc();

if (!file_exists($file['file_path'])) {
    die("File missing on server");
}

// 🔥 FORCE DOWNLOAD
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($file['file_name']) . '"');
header('Content-Length: ' . filesize($file['file_path']));

readfile($file['file_path']);
exit;
