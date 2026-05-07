<?php
session_start();

error_reporting(E_ALL);
ini_set('log_errors', 1);
ini_set('error_log', '/var/www/html/login-app/app.log');

error_log("VERIFY OTP API CALLED");


$data = json_decode(file_get_contents("php://input"), true);

if (!isset($_SESSION['otp'])) {
    echo json_encode(["status"=>"error","message"=>"Session expired"]);
    exit;
}

if ($data['otp'] != $_SESSION['otp']) {
    echo json_encode(["status"=>"error","message"=>"Invalid OTP"]);
    exit;
}

// ✅ FINAL LOGIN SESSION
$_SESSION['temp_user'] = $_SESSION['otp_user'];

// clear temp
unset($_SESSION['otp']);
unset($_SESSION['otp_user']);

echo json_encode([
    "status"=>"success",
    "message"=>"Login successful"
]);
