<?php
include("aetsheader.php");
include("aetssidebar.php");
include("aetsconn.php");

ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$class_sql = "SELECT * FROM classroom";
$class_result = mysqli_query($conn, $class_sql);
$classrooms = [];
while ($classroom = mysqli_fetch_assoc($class_result)) {
    $classrooms[] = $classroom;
}

$student_result = null;
$selected_class = null;

if (isset($_POST['class_selection'])) {
    $selected_class = $_POST['class_selection'];

    $student_sql = "SELECT * FROM userlist WHERE class_selection = '$selected_class' 
                    AND id IN (SELECT id FROM user_db WHERE user_role = 3)";
    $student_result = mysqli_query($conn, $student_sql);

    if (!$student_result) {
        echo "<br>Error fetching students: " . mysqli_error($conn);
    }
}

if (isset($_POST['save_attendance'])) {
    if (isset($_POST['attendance'])) {
        $attendance = $_POST['attendance']; 
        $current_date = date('Y-m-d');

        foreach ($attendance as $user_id) {

            $attendance_sql = "INSERT INTO attendance (date) VALUES ('$current_date')";

            if (mysqli_query($conn, $attendance_sql)) {

                $attendance_id = mysqli_insert_id($conn);

                $update_sql = "UPDATE userlist SET atten_id = '$attendance_id' WHERE user_id = '$user_id'";

                if (mysqli_query($conn, $update_sql)) {
                    echo "<br>Attendance saved  ";
                } else {
                    echo "<br>Error updating userlist: " . mysqli_error($conn);
                }
            } else {
                echo "<br>Error saving attendance: " . mysqli_error($conn);
            }
        }
    } else {
        echo "<br>No students selected for attendance.";
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
                                <th>Mark Attendance</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if (mysqli_num_rows($student_result) > 0) {
                                while ($student = mysqli_fetch_assoc($student_result)) {
                                    echo "<tr>";
                                    echo "<td>" . $student['user_id'] . "</td>";
                                    echo "<td>" . $student['firstname'] . " " . $student['lastname'] . "</td>";
                                    echo "<td><input type='checkbox' name='attendance[]' value='" . $student['user_id'] . "'></td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='3' style='color: red;'>No students found in this class.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <button type="submit" name="save_attendance" class="save_button">Save Attendance</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>

</body>
</html>
