<?php
session_start();
require_once '../../includes/db.php';
require_once '../../includes/mail.php';

error_log("LOGIN API CALLED");

$data = json_decode(file_get_contents("php://input"), true);

$email = $data['email'];
$password = $data['password'];

error_log("Login attempt: " . $email);

$stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo json_encode(["status"=>"error","message"=>"User not found"]);
    exit;
}

$user = $result->fetch_assoc();

if (!password_verify($password, $user['password'])) {
    echo json_encode(["status"=>"error","message"=>"Wrong password"]);
    exit;
}

// OTP
$otp = rand(100000, 999999);

// store TEMP data only
$_SESSION['otp'] = $otp;
$_SESSION['otp_user'] = $user['id'];   // store temporarily
$_SESSION['email'] = $email;

error_log("OTP generated for user ID: " . $user['id']);

sendOTP($email, $otp);

echo json_encode([
    "status"=>"otp_sent",
    "message"=>"OTP sent"
]);
