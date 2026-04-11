<?php
set_time_limit(120);
ini_set('max_execution_time', 120);

$rawInput = file_get_contents("php://input");
require_once('aetsconn.php');
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 0);

date_default_timezone_set('Asia/Kathmandu');

try {
    $data = json_decode($rawInput, true);

    if (!isset($data['image'])) {
        echo json_encode(["status" => "error", "message" => "No image received."]);
        exit();
    }

    // ✅ Decode and save temp image
    $imageData    = $data['image'];
    $imageData    = preg_replace('/^data:image\/\w+;base64,/', '', $imageData);
    $imageData    = str_replace(' ', '+', $imageData);
    $decodedImage = base64_decode($imageData);

    if (!$decodedImage) {
        echo json_encode(["status" => "error", "message" => "Invalid image data."]);
        exit();
    }

    $temp_folder = "temp_attendance/";
    if (!is_dir($temp_folder)) mkdir($temp_folder, 0777, true);

    $temp_image = $temp_folder . "scan_" . time() . "_" . rand(100,999) . ".jpg";
    file_put_contents($temp_image, $decodedImage);
    $full_image_path = realpath($temp_image);

    // ✅ Run Python via batch file
    $bat_path = 'C:\\xampp\\htdocs\\Hajir\\algorithm\\run_face_attendance.bat';

    if (!file_exists($bat_path)) {
        echo json_encode(["status" => "error", "message" => "Batch file not found."]);
        exit();
    }

    $command = 'cmd /c ""' . $bat_path . '" "' . $full_image_path . '"" 2>&1';

    $descriptors = [
        0 => ["pipe", "r"],
        1 => ["pipe", "w"],
        2 => ["pipe", "w"],
    ];

    $process = proc_open($command, $descriptors, $pipes, null, null);

    if (!is_resource($process)) {
        echo json_encode(["status" => "error", "message" => "Failed to start face recognition."]);
        exit();
    }

    stream_set_blocking($pipes[1], false);
    stream_set_blocking($pipes[2], false);

    $stdout = '';
    $stderr = '';
    $start  = time();

    while (true) {
        $stdout .= stream_get_contents($pipes[1]);
        $stderr .= stream_get_contents($pipes[2]);

        $procStatus = proc_get_status($process);
        if (!$procStatus['running']) break;

        if ((time() - $start) > 110) {
            proc_terminate($process);
            if (file_exists($temp_image)) unlink($temp_image);
            echo json_encode(["status" => "error", "message" => "Face recognition timed out. Please try again."]);
            exit();
        }
        usleep(200000);
    }

    fclose($pipes[0]);
    fclose($pipes[1]);
    fclose($pipes[2]);
    proc_close($process);

    if (file_exists($temp_image)) unlink($temp_image);

    // ✅ Extract JSON from Python output (ignore dlib/pkg warning lines)
    $output = trim($stdout . $stderr);
    preg_match('/\{.*\}/s', $output, $matches);

    if (empty($matches)) {
        echo json_encode([
            "status"  => "error",
            "message" => "Face not recognized. Please try again.",
            "debug"   => $output
        ]);
        exit();
    }

    $result = json_decode($matches[0], true);

    if (!$result || $result['status'] !== 'success') {
        echo json_encode([
            "status"  => "error",
            "message" => $result['message'] ?? "Face not recognized."
        ]);
        exit();
    }

    if (empty($result['matched'])) {
        echo json_encode([
            "status"  => "error",
            "message" => "Face not recognized. Please register your face first."
        ]);
        exit();
    }

    // ✅ Pick best match (lowest distance)
    usort($result['matched'], fn($a, $b) => $a['distance'] <=> $b['distance']);
    $best_match   = $result['matched'][0];
    $matched_uid  = $best_match['user_id'];
    $matched_name = $best_match['name'];

    // ✅ Check if already marked today
    $check = mysqli_query($conn,
        "SELECT id, status FROM attendance 
         WHERE user_id = '$matched_uid' 
         AND DATE(attendance_date) = CURDATE()"
    );

    if (mysqli_num_rows($check) > 0) {
        $existing = mysqli_fetch_assoc($check);
        echo json_encode([
            "status"  => "already_marked",
            "message" => "Attendance already marked for $matched_name today (Status: " . $existing['status'] . ")."
        ]);
        exit();
    }

    // ✅ Get classroom of matched user
    $class_query = mysqli_query($conn,
        "SELECT class_selection FROM userlist WHERE user_id = '$matched_uid'"
    );
    $class_row      = mysqli_fetch_assoc($class_query);
    $classroom_name = $class_row['class_selection'] ?? 'Unknown';
    $current_date   = date('Y-m-d');

    // ✅ Insert attendance - Present
    $insert = mysqli_query($conn,
        "INSERT INTO attendance (user_id, attendance_date, status, classroom_name) 
         VALUES ('$matched_uid', '$current_date', 'Present', '$classroom_name')"
    );

    if ($insert) {
        echo json_encode([
            "status"  => "success",
            "message" => "Welcome $matched_name! Attendance marked as Present."
        ]);
    } else {
        echo json_encode([
            "status"  => "error",
            "message" => "Face recognized but failed to save attendance."
        ]);
    }

} catch (Throwable $e) {
    echo json_encode([
        "status"  => "error",
        "message" => "Server error.",
        "debug"   => $e->getMessage()
    ]);
}