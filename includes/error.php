<?php
require_once 'db.php';

function logError($message, $file, $line) {
    global $conn;

    $stmt = $conn->prepare("INSERT INTO error_logs (error_message, file_name, line_number) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $message, $file, $line);
    $stmt->execute();
}

// Catch all errors
set_error_handler(function($errno, $errstr, $errfile, $errline) {
    logError($errstr, $errfile, $errline);
});
