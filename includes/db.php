<?php

error_reporting(E_ALL);
ini_set('log_errors', 1);
ini_set('error_log', '/var/www/html/login-app/app.log');


$host = "localhost";
$user = "php";
$pass = "Php@123456!";
$db   = "MSH";

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}
