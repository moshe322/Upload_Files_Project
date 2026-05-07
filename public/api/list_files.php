<?php
session_start();

$user_id = $_SESSION['user_id'] ?? 1; // fallback for testing

$dir = __DIR__ . "/../../uploads/user_" . $user_id;

$files = [];

if (is_dir($dir)) {
    $files = array_values(array_diff(scandir($dir), ['.', '..']));
}

echo json_encode([
    "status" => "success",
    "files" => $files
]);
