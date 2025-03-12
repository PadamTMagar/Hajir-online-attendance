<?php
date_default_timezone_set('Asia/Kathmandu');

include("aetsheader.php");
include("aetssidebar.php");
include("aetsconn.php");

ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Fetch available classrooms
$class_sql = "SELECT DISTINCT class_selection FROM userlist";
$class_result = mysqli_query($conn, $class_sql);

// Get selected filters
$classroom_name = isset($_GET['classroom_name']) ? $_GET['classroom_name'] : 'all';
$status_filter = isset($_GET['status_filter_hidden']) ? $_GET['status_filter_hidden'] : 'all';
$date_option = isset($_GET['date_option']) ? $_GET['date_option'] : 'today';
$attendance_date = date('Y-m-d');

if ($date_option == 'yesterday') {
    $attendance_date = date('Y-m-d', strtotime('-1 day'));
} elseif ($date_option == 'custom' && isset($_GET['attendance_date'])) {
    $attendance_date = $_GET['attendance_date'];
}

// Fetch students with filters
$student_sql = "SELECT userlist.*, attendance.attendance_date, attendance.status 
                FROM userlist 
                LEFT JOIN attendance ON userlist.user_id = attendance.user_id 
                WHERE attendance.attendance_date = '$attendance_date'";

if ($classroom_name !== 'all') {
    $student_sql .= " AND userlist.class_selection = '$classroom_name'";
}

if ($status_filter !== 'all') {
    $student_sql .= " AND attendance.status = '$status_filter'";
}

$student_result = mysqli_query($conn, $student_sql);
if (!$student_result) {
    die("Error fetching students: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance View</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
</head>
<body>

<div class="container">
    <div class="teacher">
        <div class="teacher_header">
            <span class="teacher">Attendance View</span>
            <span class="teacher_mgs">View Attendance</span>
        </div>

        <div class="teacher_content">
            <div class="teacher_title">
                <span>Attendance Details</span>
            </div>

            <!-- Dropdowns for filtering -->
            <form method="GET" action="viewattendance.php" id="attendance_form">
                
                <label for="classroom">Select Classroom:</label>
                <select name="classroom_name" id="classroom" onchange="updateFilters()">
                    <option value="all" <?php if ($classroom_name == 'all') echo 'selected'; ?>>View All Attendance</option>
                    <?php 
                    while ($class = mysqli_fetch_assoc($class_result)) {
                        $class_value = $class['class_selection'];
                        echo "<option value='$class_value' " . ($classroom_name == $class_value ? "selected" : "") . ">$class_value</option>";
                    }
                    ?>
                </select>

                <!-- Status Selection -->
                <label for="status_filter">Select Status:</label>
                <select name="status_filter" id="status_filter" onchange="updateFilters()">
                    <option value="all" <?php if ($status_filter == 'all') echo 'selected'; ?>>All Attendance</option>
                    <option value="Present" <?php if ($status_filter == 'Present') echo 'selected'; ?>>Present</option>
                    <option value="Absent" <?php if ($status_filter == 'Absent') echo 'selected'; ?>>Absent</option>
                </select>

                <!-- Date Selection -->
                <label for="date_option">Select Date:</label>
                <select name="date_option" id="date_option" onchange="handleDateSelection()">
                    <option value="today" <?php if ($date_option == 'today') echo 'selected'; ?>>Today</option>
                    <option value="yesterday" <?php if ($date_option == 'yesterday') echo 'selected'; ?>>Yesterday</option>
                    <option value="custom" <?php if ($date_option == 'custom') echo 'selected'; ?>>Custom Date</option>
                </select>

                <!-- Custom Date Input -->
                <label for="attendance_date" id="attendance_date_label" style="display: none;">Custom Date:</label>
                <input type="date" name="attendance_date" id="attendance_date" style="display: none;" value="<?php echo $attendance_date; ?>" onchange="updateFilters()">

                <!-- Hidden input to store selected status -->
                <input type="hidden" name="status_filter_hidden" id="status_filter_hidden" value="<?php echo $status_filter; ?>">
            </form>

            <table class="usertable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Classroom</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if (mysqli_num_rows($student_result) > 0) {
                        while ($student = mysqli_fetch_assoc($student_result)) {
                            $user_id = $student['user_id'];
                            $name = $student['firstname'] . " " . $student['lastname'];
                            $status = $student['status'] ?? 'Absent';
                            $classroom = $student['class_selection'];

                            echo "<tr>
                                    <td>$user_id</td>
                                    <td>$name</td>
                                    <td>$classroom</td>
                                    <td>$status</td>
                                    <td class='action_row'>
                                        <a href='userattendance.php?id=$user_id' class='view_btn'>View</a>
                                    </td>
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

<script>
    function updateFilters() {
        // Store status filter in hidden input before submitting
        document.getElementById('status_filter_hidden').value = document.getElementById('status_filter').value;
        document.getElementById('attendance_form').submit();
    }

    function handleDateSelection() {
        var customDateInput = document.getElementById('attendance_date');
        var customDateLabel = document.getElementById('attendance_date_label');
        var dateOption = document.getElementById('date_option').value;

        if (dateOption === 'custom') {
            customDateInput.style.display = 'inline';
            customDateLabel.style.display = 'inline';
        } else {
            customDateInput.style.display = 'none';
            customDateLabel.style.display = 'none';
            updateFilters(); // Submit form immediately when changing date option (except custom)
        }
    }

    // Ensure the correct status is selected when the page loads
    document.addEventListener("DOMContentLoaded", function () {
        var savedStatus = document.getElementById('status_filter_hidden').value;
        document.getElementById('status_filter').value = savedStatus;
    });
</script>

</body>
</html>
