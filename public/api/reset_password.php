<?php
require_once '../../includes/db.php';

$data = json_decode(file_get_contents("php://input"), true);

$token = $data['token'];
$newPassword = password_hash($data['password'], PASSWORD_DEFAULT);

$stmt = $conn->prepare("SELECT * FROM users WHERE reset_token=? AND token_expiry > NOW()");
$stmt->bind_param("s", $token);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(["status"=>"error","message"=>"Invalid or expired token"]);
    exit;
}

$stmt = $conn->prepare("UPDATE users SET password=?, reset_token=NULL WHERE reset_token=?");
$stmt->bind_param("ss", $newPassword, $token);
$stmt->execute();

echo json_encode(["status"=>"success","message"=>"Password updated"]);
