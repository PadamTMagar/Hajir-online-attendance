<?php
require_once('aetsconn.php');

if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']);

    $check_sql = "SELECT * FROM user_db WHERE id = $user_id";
    $check_result = mysqli_query($conn, $check_sql);

    if ($check_result && mysqli_num_rows($check_result) > 0) {
        $delete_userdb_sql = "DELETE FROM user_db WHERE id = $user_id";
        if (mysqli_query($conn, $delete_userdb_sql)) {
            header("Location: user.php?success=User deleted successfully.");
            exit();
        } else {
            header("Location: user.php?error=Failed to delete user: " . mysqli_error($conn));
            exit();
        }
    } else {
        header("Location: user.php?error=User not found.");
        exit();
    }
} else {
    header("Location: user.php?error=No user ID provided.");
    exit();
}
