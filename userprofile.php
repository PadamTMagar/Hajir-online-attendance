<?php
require_once('aetsconn.php'); // Database connection
require_once('aetsvalidside.php'); // This already manages the session

// Ensure the user is logged in
if (!isset($_SESSION['user'])) {
    die("Access denied. Please log in.");
}

$username = $_SESSION['user']; // Get the logged-in username

// Step 1: Fetch user_id from user_db using the username
$sql = "SELECT id FROM user_db WHERE user = '$username'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $user_id = $row['id']; // Get the user_id
} else {
    die("User not found in user_db.");
}

// Step 2: Query the userlist table for logged-in user details using user_id
$sql = "SELECT * FROM userlist WHERE user_id = $user_id";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    die("User details not found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Profile</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
</head>
<body>
    <?php require_once('aetsheader.php'); ?>

    <div class="container">
        <div class="user_profile">
            <div class="profile_header">
                <span class="view_user">My Profile</span>
            </div>

            <div class="user_portal">
                <div class="user_info">
                    <div class="profile_pannel">
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
                    </div>

                    <div class="details_pannel">
                        <div class="pannel_row">
                            <span>Username</span>
                            <span class="value"><?php echo $user['firstname'] . ' ' . ($user['midname'] ?? '') . ' ' . $user['lastname']; ?></span>
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
                        <div class="more_info_msg">Personal Information</div>
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
