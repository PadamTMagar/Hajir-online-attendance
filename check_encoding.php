<?php
require_once('aetsconn.php');
header('Content-Type: application/json');

$user_id = intval($_GET['user_id'] ?? 0);

if ($user_id <= 0) {
    echo json_encode(["encoded" => false, "error" => "Invalid user ID"]);
    exit();
}

$stmt = mysqli_prepare($conn, "SELECT face_encoding FROM userlist WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user   = mysqli_fetch_assoc($result);

if ($user && !empty($user['face_encoding'])) {
    echo json_encode(["encoded" => true]);
} else {
    echo json_encode(["encoded" => false]);
}