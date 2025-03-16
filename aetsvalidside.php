<?php
session_start();
require_once('aetsconn.php');

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$user_name = $_SESSION['user'] ?? '';

$sql = "SELECT user_role FROM user_db WHERE user = '$user_name'";
$result = $conn->query($sql);

$role_name = ($result && $row = $result->fetch_assoc()) ? $row['user_role'] : 'Unknown';

// Include the correct sidebar based on the role
if ($role_name === 'Student') {
    require_once('aetsstudent.php');
} elseif ($role_name === 'Teacher') {
    require_once('aetsteacher.php');
} else {
    require_once('aetssidebar.php'); // Default sidebar for Admin and others
}
?>
