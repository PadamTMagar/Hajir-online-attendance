
<?php
date_default_timezone_set('Asia/Kathmandu');  // Nepal Time Zone

include("aetsheader.php");
// include("aetssidebar.php");
require_once('aetsvalidside.php');
include("aetsconn.php");

ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Fetch available classrooms from the database
$class_sql = "SELECT DISTINCT class_selection FROM userlist";
$class_result = mysqli_query($conn, $class_sql);

// Get selected classroom from dropdown (default: 'View All Attendance')
$classroom_name = isset($_GET['classroom_name']) ? $_GET['classroom_name'] : 'all';

// Get the selected date option from the form
$date_option = isset($_GET['date_option']) ? $_GET['date_option'] : 'today';
$attendance_date = date('Y-m-d');  // Default to today's date

if ($date_option == 'yesterday') {
    // Set date to yesterday
    $attendance_date = date('Y-m-d', strtotime('-1 day'));
} elseif ($date_option == 'custom' && isset($_GET['attendance_date'])) {
    // Custom date selected
    $attendance_date = $_GET['attendance_date'];
}

// Fetch students and their attendance
$student_sql = "SELECT userlist.*, attendance.attendance_date, attendance.status 
                FROM userlist 
                LEFT JOIN attendance ON userlist.user_id = attendance.user_id 
                WHERE attendance.attendance_date = '$attendance_date'";

if ($classroom_name !== 'all') {
    // Filter by specific classroom if selected
    $student_sql .= " AND userlist.class_selection = '$classroom_name'";
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

            <!-- Dropdown for selecting classroom and date -->
            <form method="GET" action="viewattendance.php" id="attendance_form">
                <label for="classroom">Select Classroom:</label>
                <select name="classroom_name" id="classroom" onchange="this.form.submit()">
                    <option value="all" <?php if ($classroom_name == 'all') echo 'selected'; ?>>View All Attendance</option>
                    <?php 
                    if (mysqli_num_rows($class_result) > 0) {
                        while ($class = mysqli_fetch_assoc($class_result)) {
                            $class_value = $class['class_selection'];
                            echo "<option value='$class_value' " . ($classroom_name == $class_value ? "selected" : "") . ">$class_value</option>";
                        }
                    }
                    ?>
                </select>

                <!-- Date Selection Dropdown -->
                <label for="date_option">Select Date:</label>
                <select name="date_option" id="date_option" onchange="handleDateSelection()">
                    <option value="today" <?php if ($date_option == 'today') echo 'selected'; ?>>Today</option>
                    <option value="yesterday" <?php if ($date_option == 'yesterday') echo 'selected'; ?>>Yesterday</option>
                    <option value="custom" <?php if ($date_option == 'custom') echo 'selected'; ?>>Custom Date</option>
                </select>

                <!-- Custom Date Input (hidden initially, shown when 'Custom Date' is selected) -->
                <label for="attendance_date" id="attendance_date_label" style="display: none;">Custom Date:</label>
                <input type="date" name="attendance_date" id="attendance_date" style="display: none;" value="<?php echo isset($attendance_date) ? $attendance_date : date('Y-m-d'); ?>" placeholder="Custom Date">
            </form>

            <table class="usertable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Classroom</th>
                        <th>Status</th>
                        <th>Action</th> <!-- Added Action column -->
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

                            echo "<tr>
                                    <td>$user_id</td>
                                    <td>$name</td>
                                    <td>$classroom</td>
                                    <td>" . $status . "</td> <!-- Displaying status directly from database -->
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
    // This function handles showing and hiding the custom date input based on the selection
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
        }

        // Submit the form after the dropdown change
        if (dateOption !== 'custom') {
            document.getElementById('attendance_form').submit();
        }
    }

    // Submit the form when a custom date is selected
    document.getElementById('attendance_date').addEventListener('change', function() {
        document.getElementById('attendance_form').submit();
    });
</script>

</body>
</html>
