<?php session_start()?>
<?php
require_once('aetsconn.php');

if (isset($_GET['id'])) {
    $classroom_id = intval($_GET['id']);  // get classroom id from url redirected from viewclass.php

    // query to check the classroom is existed in classroom or not in database 
    $check_sql = "SELECT * FROM classroom WHERE id = $classroom_id";
    $check_result = mysqli_query($conn, $check_sql);

    if ($check_result && mysqli_num_rows($check_result) > 0) {
        // query to detele the classroom from database 
        $delete_classroom_sql = "DELETE FROM classroom WHERE id = $classroom_id";
        if (mysqli_query($conn, $delete_classroom_sql)) {
            // Redirect to viewclass.php after deleting the classroom 
            header("Location: viewclass.php");
            exit(); // Don't forget to exit to prevent further code execution
        }
    }
}

// If the classroom is not found or deletion fails, just redirect back to viewclass.php
header("Location: viewclass.php");
exit(); // Don't forget to exit to prevent further code execution
?>
