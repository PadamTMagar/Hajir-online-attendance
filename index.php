<?php
session_start();
require_once('aetsconn.php');

if (!isset($_SESSION['user'])) {
    // If not logged in, redirect to login page
    header('Location: login.php');
    exit;
}

$user_name = $_SESSION['user'] ?? '';

$sql = "SELECT u.user_role FROM user_db u WHERE u.user = '$user_name'";
$result = $conn->query($sql);

if ($result && $row = $result->fetch_assoc()) {
    $role_name = $row['user_role'];
} else {
    $role_name = 'Unknown';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
</head>
<body>

<?php
require_once('aetsheader.php'); 

if ($role_name === 'Student') {
    require_once('aetsstudent.php');
} elseif ($role_name === 'Teacher') {
    require_once('aetsteacher.php');
} else {
    require_once('aetssidebar.php'); // Default sidebar for Admin and others
}

require_once('dashboard.php');
?>

</body>
</html>
