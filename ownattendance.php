<?php
session_start();
include("aetsheader.php");
include("aetssidebar.php");
require_once 'aetsconn.php';


// Initialize the logged-in user's details
$user_name = '';  // Initialize the username variable
$user_id = '';    // Initialize user ID variable

// Check if the session contains the user information
if (isset($_SESSION['user'])) {
    $user_name = $_SESSION['user'];
}

// Query to get the logged-in user's ID based on their username
$sql = "SELECT u.id FROM user_db u WHERE u.user = '$user_name'";
$result = $conn->query($sql);

// Check if the result was fetched successfully
if ($result && $row = $result->fetch_assoc()) {
    $user_id = $row['id'];  // Store the logged-in user's ID
} else {
    die("User not found or session expired.");
}

// Fetch the logged-in user's attendance records
$sql = "
    SELECT u.id AS user_id, u.firstname, u.lastname, u.class_selection, a.attendance_date, a.status
    FROM userlist u
    LEFT JOIN attendance a ON u.user_id = a.user_id
    WHERE u.user_id = '$user_id'  -- Filter by logged-in user
    ORDER BY a.attendance_date DESC
";

$student_result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance View</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>


<div class="container">
    <div class="teacher">
        <div class="teacher_header">
            <span class="teacher">Attendance View</span>
            <span class="teacher_mgs">View Your Attendance</span>
        </div>

        <div class="teacher_content">
            <div class="teacher_title">
                <span>Your Attendance Details</span>
            </div>

            <table class="usertable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Classroom</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if (mysqli_num_rows($student_result) > 0) {
                        while ($student = mysqli_fetch_assoc($student_result)) {
                            $user_id = $student['user_id'];
                            $name = $student['firstname'] . " " . $student['lastname'];
                            $status = $student['status'] ?? 'Absent'; // Default to 'Absent' if NULL
                            $classroom = $student['class_selection'];
                            $attendance_date = $student['attendance_date'] ?? 'N/A'; // If no attendance date is present

                            echo "<tr>
                                    <td>$user_id</td>
                                    <td>$name</td>
                                    <td>$classroom</td>
                                    <td>" . $status . "</td> <!-- Displaying status directly from database -->
                                    <td>$attendance_date</td> <!-- Displaying the attendance date -->
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' style='color: red;'>No attendance records found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

</body>
</html>
