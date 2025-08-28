
<?php
include("aetsheader.php");
require_once('aetsvalidside.php');
include("aetsconn.php");

ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Set the correct timezone (change to your preferred timezone if needed)
date_default_timezone_set('Asia/Kathmandu');  // Nepal Time 

// Fetch classrooms
$class_sql = "SELECT * FROM classroom";
$class_result = mysqli_query($conn, $class_sql);
$classrooms = [];
while ($classroom = mysqli_fetch_assoc($class_result)) {
    $classrooms[] = $classroom;
}

$student_result = null;
$selected_class = null;

$succes_msg = '';
$error = '';

// Fetch students for the selected class
if (isset($_POST['class_selection'])) {
    $selected_class = $_POST['class_selection'];

    $student_sql = "SELECT userlist.* FROM userlist
                    JOIN user_db ON userlist.user_id = user_db.id
                    WHERE userlist.class_selection = '$selected_class' 
                    AND user_db.user_role = 'Student'";

    $student_result = mysqli_query($conn, $student_sql);

    if (!$student_result) {
        $error = "Error fetching students: " . mysqli_error($conn);
    }
}

// Save attendance
if (isset($_POST['save_attendance'])) {
    if (isset($_POST['attendance'])) {
        $attendance = $_POST['attendance']; 
        $current_date = date('Y-m-d'); // Get the current date in Y-m-d format
        $classroom_name = $_POST['class_selection'];

        foreach ($attendance as $user_id => $status) {
            // Check if the student has already been marked today
            $check_sql = "SELECT * FROM attendance WHERE user_id = '$user_id' AND DATE(attendance_date) = CURDATE()";
            $check_result = mysqli_query($conn, $check_sql);

            if (mysqli_num_rows($check_result) > 0) {
                // If attendance is already marked, update the status instead of inserting
                $update_sql = "UPDATE attendance 
                               SET status = '$status', classroom_name = '$classroom_name'
                               WHERE user_id = '$user_id' AND DATE(attendance_date) = CURDATE()";

                if (mysqli_query($conn, $update_sql)) {
                    $succes_msg = "Attendance updated";
                } else {
                    $error = "Error updating attendance: " . mysqli_error($conn);
                }
            } else {
                // Insert the attendance if not already marked
                $attendance_sql = "INSERT INTO attendance (user_id, attendance_date, status, classroom_name) 
                                   VALUES ('$user_id', '$current_date', '$status', '$classroom_name')";

                if (mysqli_query($conn, $attendance_sql)) {
                    $succes_msg = "Attendance saved  ";
                } else {
                    $error = "Error saving attendance: " . mysqli_error($conn);
                }
            }
        }
    } else {
        $error = "No students selected for attendance.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mark Attendance</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
</head>
<body>

<div class="container">
    <div class="teacher">
        <div class="teacher_header">
            <span class="teacher">Attendance</span>
            <span class="teacher_mgs">Manage Attendance</span>
        </div>

        <div class="teacher_content">
            <div class="teacher_title">
                <span>Mark Attendance</span>
            </div>
            <div class="select_class">
            </div>
            <form method="POST">
                <label for="class_selection">Select Class:*</label>
                <select name="class_selection" id="classselection" required onchange="this.form.submit()">
                    <option value="">Please Select</option>
                    <?php 
                        foreach ($classrooms as $classroom) {
                            $selected = ($selected_class === $classroom['classroom_name']) ? "selected" : "";
                            echo "<option value='" . $classroom['classroom_name'] . "' $selected>" . $classroom['classroom_name'] . "</option>";
                        }
                    ?>
                </select>
            </form>

            <?php if ($student_result !== null): ?>
                <form method="POST">
                    <input type="hidden" name="class_selection" value="<?php echo $selected_class; ?>" />
                    <table class="usertable">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Attendance Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if (mysqli_num_rows($student_result) > 0) {
                                while ($student = mysqli_fetch_assoc($student_result)) {
                                    $user_id = $student['user_id'];

                                    // Check if attendance has already been marked today
                                    $attendance_check_sql = "SELECT * FROM attendance WHERE user_id = '$user_id' AND DATE(attendance_date) = CURDATE()";
                                    $attendance_check_result = mysqli_query($conn, $attendance_check_sql);
                                    $status = (mysqli_num_rows($attendance_check_result) > 0) ? mysqli_fetch_assoc($attendance_check_result)['status'] : '';

                                    echo "<tr>";
                                    echo "<td>" . $student['user_id'] . "</td>";
                                    echo "<td>" . $student['firstname'] . " " . $student['lastname'] . "</td>";
                                    echo "<td>";

                                    // Present radio button
                                    echo "<input type='radio' name='attendance[" . $user_id . "]' value='Present' ";
                                    if ($status === "Present") {
                                        echo "checked";
                                    }
                                    echo "> Present ";

                                    // Absent radio button
                                    echo "<input type='radio' name='attendance[" . $user_id . "]' value='Absent' ";
                                    if ($status === "Absent") {
                                        echo "checked";
                                    }
                                    echo "> Absent";

                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='3' style='color: red;'>No students found in this class.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="update_button">
                        <button class="role_update" type="submit" name="save_attendance" class="save_button">Save Attendance</button>
                    </div>
                </form>
            <?php endif; ?>

            <div class="error_msg"><?php echo $error;?></div>
            <div class="succes_msg"><?php echo $succes_msg;?></div>
        </div>
    </div>
</div>

</body>
</html>
