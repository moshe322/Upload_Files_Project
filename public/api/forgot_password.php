<?php
require_once '../../includes/db.php';
require_once '../../includes/mail.php';

$data = json_decode(file_get_contents("php://input"), true);
$email = $data['email'];

$token = bin2hex(random_bytes(16));
$expiry = date("Y-m-d H:i:s", strtotime("+1 hour"));

$stmt = $conn->prepare("UPDATE users SET reset_token=?, token_expiry=? WHERE email=?");
$stmt->bind_param("sss", $token, $expiry, $email);
$stmt->execute();

$link = "http://localhost:8000/reset.html?token=$token";

// send mail
sendLoginMail($email, "Reset your password: <a href='$link'>Click here</a>");

echo json_encode(["status"=>"success","message"=>"Reset link sent"]);
