<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["status"=>"error"]);
    exit;
}

echo json_encode([
    "status"=>"success",
    "user_id"=>$_SESSION['user_id'],
    "email"=>$_SESSION['email']
]);
