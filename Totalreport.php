<?php session_start(); ?>
<?php
date_default_timezone_set('Asia/Kathmandu');
include("aetsheader.php");
include("aetssidebar.php");
include("aetsconn.php");

ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!$conn) die("Database connection failed: " . mysqli_connect_error());

// Get all filters from request
$classroom_name = $_GET['classroom_name'] ?? 'all';
$date_option = $_GET['date_option'] ?? 'today';
$status_filter = $_GET['status_filter'] ?? 'all';

// Handle date selection
$attendance_date = date('Y-m-d');  // Default to today's date
$start_date = $end_date = ''; // Initialize start and end dates for week
if ($date_option === 'yesterday') {
    // Correctly calculate yesterday's date
    $attendance_date = date('Y-m-d', strtotime('-1 day'));  
} elseif ($date_option === 'custom' && !empty($_GET['attendance_date'])) {
    $attendance_date = $_GET['attendance_date'];
} elseif ($date_option === 'week') {
    // Week logic: Get Monday of the current week to Sunday of the current week
    $start_date = date('Y-m-d', strtotime('monday this week'));
    $end_date = date('Y-m-d', strtotime('sunday this week'));
}

// Base SQL query with correct LEFT JOIN
$student_sql = "SELECT userlist.*, 
                attendance.attendance_date,
                COALESCE(attendance.status, 'Not Marked') AS status 
                FROM userlist 
                LEFT JOIN attendance ON userlist.user_id = attendance.user_id";

// Apply date filters
if ($date_option === 'week') {
    $student_sql .= " AND DATE(attendance.attendance_date) BETWEEN '$start_date' AND '$end_date'";
} else {
    $student_sql .= " AND DATE(attendance.attendance_date) = '$attendance_date'";
}

$student_sql .= " WHERE 1";

// Apply classroom filter
if ($classroom_name !== 'all') {
    $student_sql .= " AND userlist.class_selection = '$classroom_name'";
}

// Apply status filter
if ($status_filter !== 'all') {
    if ($status_filter === 'Present') {
        $student_sql .= " AND attendance.status = 'Present'";
    } elseif ($status_filter === 'Absent') {
        $student_sql .= " AND (attendance.status = 'Absent' OR attendance.status IS NULL)";
    }
}

$student_result = mysqli_query($conn, $student_sql);
if (!$student_result) die("Error fetching students: " . mysqli_error($conn));

// Get classrooms for dropdown
$class_result = mysqli_query($conn, "SELECT DISTINCT class_selection FROM userlist");
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

            <!-- Filter Form -->
            <form method="GET" id="attendance_form">
                <!-- Classroom Filter -->
                <label>Classroom:</label>
                <select name="classroom_name" onchange="this.form.submit()">
                    <option value="all" <?= $classroom_name === 'all' ? 'selected' : '' ?>>All Classes</option>
                    <?php while ($class = mysqli_fetch_assoc($class_result)) : ?>
                        <option value="<?= $class['class_selection'] ?>" 
                            <?= $classroom_name === $class['class_selection'] ? 'selected' : '' ?> >
                            <?= $class['class_selection'] ?>
                        </option>
                    <?php endwhile; ?>
                </select>

                <!-- Date Filter -->
                <label>Date:</label>
                <select name="date_option" onchange="handleDateSelection()">
                    <option value="today" <?= $date_option === 'today' ? 'selected' : '' ?>>Today</option>
                    <option value="yesterday" <?= $date_option === 'yesterday' ? 'selected' : '' ?>>Yesterday</option>
                    <option value="week" <?= $date_option === 'week' ? 'selected' : '' ?>>This Week</option>
                    <option value="custom" <?= $date_option === 'custom' ? 'selected' : '' ?>>Custom Date</option>
                </select>
                
                <!-- Custom Date Input -->
                <input type="date" name="attendance_date" id="attendance_date"
                    style="display: <?= $date_option === 'custom' ? 'inline-block' : 'none' ?>"
                    value="<?= $attendance_date ?>" 
                    onchange="this.form.submit()">

                <!-- Status Filter -->
                <label>Status:</label>
                <select name="status_filter" onchange="this.form.submit()">
                    <option value="all" <?= $status_filter === 'all' ? 'selected' : '' ?>>All Statuses</option>
                    <option value="Present" <?= $status_filter === 'Present' ? 'selected' : '' ?>>Present</option>
                    <option value="Absent" <?= $status_filter === 'Absent' ? 'selected' : '' ?>>Absent</option>
                </select>
            </form>

            <!-- Attendance Table -->
            <table class="usertable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Classroom</th>
                        <th>Status</th>
                        <th>Date</th> <!-- Added Date column -->
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($student_result) > 0) : ?>
                        <?php while ($student = mysqli_fetch_assoc($student_result)) : ?>
                            <tr>
                                <td><?= $student['user_id'] ?></td>
                                <td><?= $student['firstname'] . ' ' . $student['lastname'] ?></td>
                                <td><?= $student['class_selection'] ?></td>
                                <td><?= $student['status'] ?></td>
                                <td><?= $student['attendance_date'] ?></td> <!-- Display the date -->
                                <td><a href="userattendance.php?id=<?= $student['user_id'] ?>" class="view_btn">View</a></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <tr><td colspan="6">No records found</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function handleDateSelection() {
        const dateSelect = document.querySelector('[name="date_option"]');
        const customDateInput = document.getElementById('attendance_date');
        
        if (dateSelect.value === 'custom') {
            customDateInput.style.display = 'inline-block';
        } else {
            customDateInput.style.display = 'none';
            document.getElementById('attendance_form').submit();
        }
    }
</script>
</body>
</html>
