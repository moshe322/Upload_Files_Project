<?php
session_start();

$data = json_decode(file_get_contents("php://input"), true);

$user_id = $_SESSION['user_id'];

$old = __DIR__ . "/../../uploads/user_" . $user_id . "/" . $data['oldName'];
$new = __DIR__ . "/../../uploads/user_" . $user_id . "/" . $data['newName'];

if (rename($old, $new)) {
    echo json_encode(["message"=>"Renamed"]);
} else {
    echo json_encode(["message"=>"Rename failed"]);
}
