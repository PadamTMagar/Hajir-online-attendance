<?php
set_time_limit(60);
ini_set('max_execution_time', 60);

$rawInput = file_get_contents("php://input");
require_once('aetsconn.php');
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 0);

try {
    if (!$rawInput) {
        echo json_encode(["status" => "error", "message" => "No input data received."]);
        exit();
    }

    $data = json_decode($rawInput, true);

    if (!$data) {
        echo json_encode(["status" => "error", "message" => "Invalid JSON input."]);
        exit();
    }

    if (!isset($data['user_id']) || !isset($data['image'])) {
        echo json_encode(["status" => "error", "message" => "Missing user_id or image."]);
        exit();
    }

    $user_id   = intval($data['user_id']);
    $imageData = $data['image'];

    if ($user_id <= 0) {
        echo json_encode(["status" => "error", "message" => "Invalid user ID."]);
        exit();
    }

    $stmt = mysqli_prepare($conn, "SELECT id FROM userlist WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $checkResult = mysqli_stmt_get_result($stmt);

    if (!$checkResult || mysqli_num_rows($checkResult) == 0) {
        echo json_encode(["status" => "error", "message" => "User not found in userlist."]);
        exit();
    }

    if (!preg_match('/^data:image\/(\w+);base64,/', $imageData)) {
        echo json_encode(["status" => "error", "message" => "Invalid image format."]);
        exit();
    }

    $imageData    = preg_replace('/^data:image\/\w+;base64,/', '', $imageData);
    $imageData    = str_replace(' ', '+', $imageData);
    $decodedImage = base64_decode($imageData);

    if ($decodedImage === false) {
        echo json_encode(["status" => "error", "message" => "Failed to decode image."]);
        exit();
    }

    $folder = "profilePic/";
    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }

    $fileName = "student_" . $user_id . ".jpg";
    $filePath = $folder . $fileName;

    if (file_put_contents($filePath, $decodedImage) === false) {
        echo json_encode(["status" => "error", "message" => "Failed to save image file."]);
        exit();
    }

    // ✅ Save profile_pic path to DB immediately
    $picPath   = "profilePic/" . $fileName;
    $updatePic = mysqli_prepare($conn, "UPDATE userlist SET profile_pic = ? WHERE id = ?");
    mysqli_stmt_bind_param($updatePic, "si", $picPath, $user_id);
    mysqli_stmt_execute($updatePic);

    // ✅ Fire Python in background - completely detached from Apache
    $bat_path  = 'C:\\xampp\\htdocs\\Hajir\\algorithm\\run_encoding.bat';
    $log_path  = 'C:\\xampp\\htdocs\\Hajir\\algorithm\\encoding_log.txt';

    $command = 'cmd /c start /B ""' 
             . ' "' . $bat_path . '"'
             . ' ' . intval($user_id)
             . ' > "' . $log_path . '" 2>&1';

    pclose(popen($command, 'r'));

    // ✅ Return success immediately - Python runs in background
    echo json_encode([
        "status"  => "success",
        "message" => "Image saved. Face encoding is processing in background."
    ]);
    exit();

} catch (Throwable $e) {
    echo json_encode([
        "status"  => "error",
        "message" => "Server exception.",
        "debug"   => $e->getMessage()
    ]);
}