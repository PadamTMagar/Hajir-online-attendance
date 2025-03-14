<?php session_start()?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View User</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
</head>
<body>
    <?php require_once('aetsheader.php'); ?>
    <?php require_once('aetssidebar.php'); ?>  
    <?php
require_once('aetsconn.php');

if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']);
} else {
    die("User ID not provided.");
}

// Query the userlist table
$sql = "SELECT * FROM userlist WHERE user_id = $user_id";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    die("User not found.");
}
?>

    <div class="container">
        <div class="user_profile">
            <div class="profile_header">
                <span class="view_user">View User</span>
            </div>

            <div class="user_portal">
                <div class="user_info">
                    <div class="profile_pannel">
                        <!-- Display the profile picture -->
                        <img src="profilePic/<?php echo $user['profile_pic']; ?>" alt="ProfilePic" class="profile_pic1">
                        <div class="user_name1">
                            <?php 
                                echo $user['firstname']; 
                                if (!empty($user['midname'])) {
                                    echo ' ' . $user['midname'];
                                }
                                echo ' ' . $user['lastname']; 
                            ?>
                        </div>
                        <!-- <div class="role_of_user"><?php echo $user['role_selection']; ?></div> -->
                    </div>

                    <div class="details_pannel">
                        <div class="pannel_row">
                            <span>Username</span>
                            <span class="value">
                                <?php 
                                    echo $user['firstname']; 
                                    if (!empty($user['midname'])) {
                                        echo ' ' . $user['midname'];
                                    }
                                    echo ' ' . $user['lastname']; 
                                ?>
                            </span>
                        </div>

                        <div class="pannel_row">
                            <span>Email</span>
                            <span class="value"><?php echo $user['emailid']; ?></span>
                        </div>

                        <div class="pannel_row">
                            <span>Phone</span>
                            <span class="value"><?php echo $user['phone_number']; ?></span>
                        </div>
                    </div>
                </div>

                <div class="more_info">
                    <div class="more_info_header">
                        <div><i class="fa-solid fa-user"></i></div>
                        <div class="more_info_msg">User Information</div>
                    </div>  

                    <div class="more_info_data_column">
                        <div class="data_row_group">
                            <span class="label">Date of Birth:</span>
                            <span class="value"><?php echo $user['dob']; ?></span>
                        </div>

                        <div class="data_row_group">
                            <span class="label">Gender:</span>
                            <span class="value"><?php echo $user['gender']; ?></span>
                        </div>

                        <div class="data_row_group">
                            <span class="label">Marital Status:</span>
                            <span class="value"><?php echo $user['marital']; ?></span>
                        </div>

                        <div class="data_row_group">
                            <span class="label">Blood Group:</span>
                            <span class="value"><?php echo $user['blood']; ?></span>
                        </div>

                        <div class="data_row_group">
                            <span class="label">Alternate Contact:</span>
                            <span class="value"><?php echo $user['alter_contact']; ?></span>
                        </div>

                        <div class="data_row_group">
                            <span class="label">Father's Name:</span>
                            <span class="value"><?php echo $user['father_name']; ?></span>
                        </div>

                        <div class="data_row_group">
                            <span class="label">Father's Occupation:</span>
                            <span class="value"><?php echo $user['father_occupation']; ?></span>
                        </div>

                        <div class="data_row_group">
                            <span class="label">Father's Contact:</span>
                            <span class="value"><?php echo $user['father_contact']; ?></span>
                        </div>

                        <div class="data_row_group">
                            <span class="label">Mother's Name:</span>
                            <span class="value"><?php echo $user['mother_name']; ?></span>
                        </div>

                        <div class="data_row_group">
                            <span class="label">Mother's Contact:</span>
                            <span class="value"><?php echo $user['mother_contact']; ?></span>
                        </div>

                        <div class="data_row_group">
                            <span class="label">Guardian's Name:</span>
                            <span class="value"><?php echo $user['guardian_name']; ?></span>
                        </div>

                        <div class="data_row_group">
                            <span class="label">Guardian's Contact:</span>
                            <span class="value"><?php echo $user['guardian_contact']; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>