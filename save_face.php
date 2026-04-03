<?php
require_once('aetsconn.php');
header('Content-Type: application/json');

error_reporting(E_ALL);
ini_set('display_errors', 0);

try {
    $rawInput = file_get_contents("php://input");

    if (!$rawInput) {
        echo json_encode([
            "status" => "error",
            "message" => "No input data received."
        ]);
        exit();
    }

    $data = json_decode($rawInput, true);

    if (!$data) {
        echo json_encode([
            "status" => "error",
            "message" => "Invalid JSON input."
        ]);
        exit();
    }

    if (!isset($data['user_id']) || !isset($data['image'])) {
        echo json_encode([
            "status" => "error",
            "message" => "Missing user_id or image."
        ]);
        exit();
    }

    $user_id = intval($data['user_id']);
    $imageData = $data['image'];

    if ($user_id <= 0) {
        echo json_encode([
            "status" => "error",
            "message" => "Invalid user ID."
        ]);
        exit();
    }

    $checkQuery = "SELECT id FROM userlist WHERE id = $user_id";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (!$checkResult || mysqli_num_rows($checkResult) == 0) {
        echo json_encode([
            "status" => "error",
            "message" => "User not found in userlist."
        ]);
        exit();
    }

    if (!preg_match('/^data:image\/(\w+);base64,/', $imageData)) {
        echo json_encode([
            "status" => "error",
            "message" => "Invalid image format."
        ]);
        exit();
    }

    $imageData = preg_replace('/^data:image\/\w+;base64,/', '', $imageData);
    $imageData = str_replace(' ', '+', $imageData);
    $decodedImage = base64_decode($imageData);

    if ($decodedImage === false) {
        echo json_encode([
            "status" => "error",
            "message" => "Failed to decode image."
        ]);
        exit();
    }

    $folder = "profilePic/";
    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }

    $fileName = "student_" . $user_id . ".jpg";
    $filePath = $folder . $fileName;

    if (file_put_contents($filePath, $decodedImage) === false) {
        echo json_encode([
            "status" => "error",
            "message" => "Failed to save image file."
        ]);
        exit();
    }

//     $python_path = 'C:\\Users\\acer\\anaconda3\\envs\\facereco\\python.exe';
// $script_path = 'C:\\xampp\\htdocs\\Hajir\\algorithm\\generate_encoding.py';

// if (!file_exists($python_path)) {
//     echo json_encode([
//         "status" => "error",
//         "message" => "Python executable not found.",
//         "debug" => $python_path
//     ]);
//     exit();
// }

// if (!file_exists($script_path)) {
//     echo json_encode([
//         "status" => "error",
//         "message" => "Python script not found.",
//         "debug" => $script_path
//     ]);
//     exit();
// }

// // Direct execution - NO cmd /c
// $command = '"' . $python_path . '" "' . $script_path . '" ' . escapeshellarg((string)$user_id) . ' 2>&1';

// $output = shell_exec($command);

// if ($output === null) {
//     echo json_encode([
//         "status" => "error",
//         "message" => "Python script did not run.",
//         "debug" => $command
//     ]);
//     exit();
// }

// if (stripos($output, "success") !== false) {
//     echo json_encode([
//         "status" => "success",
//         "message" => "Face registered successfully."
//     ]);
// } else {
//     echo json_encode([
//         "status" => "error",
//         "message" => "Image saved, but face encoding failed.",
//         "debug" => trim($output),
//         "command" => $command
//     ]);
// }
// exit();



$bat_path  = 'C:\\xampp\\htdocs\\Hajir\\algorithm\\run_encoding.bat';

if (!file_exists($bat_path)) {
    echo json_encode([
        "status"  => "error",
        "message" => "Batch file not found.",
        "debug"   => $bat_path
    ]);
    exit();
}

$command = 'cmd /c "' . $bat_path . '" ' . escapeshellarg((string)$user_id) . ' 2>&1';

$descriptors = [
    0 => ["pipe", "r"],
    1 => ["pipe", "w"],
    2 => ["pipe", "w"],
];

$process = proc_open($command, $descriptors, $pipes, 'C:\\xampp\\htdocs\\Hajir\\algorithm', null);

if (!is_resource($process)) {
    echo json_encode([
        "status"  => "error",
        "message" => "proc_open failed to start process.",
        "command" => $command
    ]);
    exit();
}

$stdout      = stream_get_contents($pipes[1]);
$stderr      = stream_get_contents($pipes[2]);
fclose($pipes[0]);
fclose($pipes[1]);
fclose($pipes[2]);
$return_code = proc_close($process);
$output      = trim($stdout . $stderr);

if ($output === '') {
    echo json_encode([
        "status"      => "error",
        "message"     => "Python ran but produced no output.",
        "return_code" => $return_code,
        "command"     => $command
    ]);
    exit();
}

if (stripos($output, "success") !== false) {
    echo json_encode([
        "status"  => "success",
        "message" => "Face registered successfully."
    ]);
} else {
    echo json_encode([
        "status"      => "error",
        "message"     => "Face encoding failed.",
        "debug"       => $output,
        "return_code" => $return_code
    ]);
}
exit();

    if (stripos($output, "success") !== false) {
        echo json_encode([
            "status" => "success",
            "message" => "Face registered successfully."
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Image saved, but face encoding failed.",
            "debug" => trim($output),
            "command" => $command
        ]);
    }

} catch (Throwable $e) {
    echo json_encode([
        "status" => "error",
        "message" => "Server exception.",
        "debug" => $e->getMessage()
    ]);
}