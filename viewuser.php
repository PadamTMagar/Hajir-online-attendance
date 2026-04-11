<?php
require_once('aetsvalidside.php'); // ✅ First - before any HTML
require_once('aetsconn.php');

if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']);
} else {
    die("User ID not provided.");
}

$sql    = "SELECT * FROM userlist WHERE user_id = $user_id";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    die("User not found.");
}

// ✅ Handle profile pic - null, empty, or with/without path prefix
$pic = $user['profile_pic'];
if (!empty($pic)) {
    $picSrc = (strpos($pic, 'profilePic/') === 0) ? $pic : 'profilePic/' . $pic;
} else {
    $picSrc = 'profilePic/default_avatar.png';
}
?>
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
    <?php require_once('aetsheader.php'); // ✅ After session and DB ?>

    <div class="container">
        <div class="user_profile">
            <div class="profile_header">
                <span class="view_user">View User</span>
            </div>

            <div class="user_portal">
                <div class="user_info">
                    <div class="profile_pannel">
                        <!-- ✅ Fixed profile picture -->
                        <img src="<?php echo htmlspecialchars($picSrc); ?>" alt="ProfilePic" class="profile_pic1">
                        <div class="user_name1">
                            <?php 
                                echo htmlspecialchars($user['firstname']); 
                                if (!empty($user['midname'])) {
                                    echo ' ' . htmlspecialchars($user['midname']);
                                }
                                echo ' ' . htmlspecialchars($user['lastname']); 
                            ?>
                        </div>
                    </div>

                    <div class="details_pannel">
                        <div class="pannel_row">
                            <span>Username</span>
                            <span class="value">
                                <?php 
                                    echo htmlspecialchars($user['firstname']); 
                                    if (!empty($user['midname'])) {
                                        echo ' ' . htmlspecialchars($user['midname']);
                                    }
                                    echo ' ' . htmlspecialchars($user['lastname']); 
                                ?>
                            </span>
                        </div>

                        <div class="pannel_row">
                            <span>Email</span>
                            <span class="value"><?php echo htmlspecialchars($user['emailid']); ?></span>
                        </div>

                        <div class="pannel_row">
                            <span>Phone</span>
                            <span class="value"><?php echo htmlspecialchars($user['phone_number']); ?></span>
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
                            <span class="value"><?php echo htmlspecialchars($user['dob']); ?></span>
                        </div>

                        <div class="data_row_group">
                            <span class="label">Gender:</span>
                            <span class="value"><?php echo htmlspecialchars($user['gender']); ?></span>
                        </div>

                        <div class="data_row_group">
                            <span class="label">Marital Status:</span>
                            <span class="value"><?php echo htmlspecialchars($user['marital']); ?></span>
                        </div>

                        <div class="data_row_group">
                            <span class="label">Blood Group:</span>
                            <span class="value"><?php echo htmlspecialchars($user['blood']); ?></span>
                        </div>

                        <div class="data_row_group">
                            <span class="label">Alternate Contact:</span>
                            <span class="value"><?php echo htmlspecialchars($user['alter_contact']); ?></span>
                        </div>

                        <div class="data_row_group">
                            <span class="label">Father's Name:</span>
                            <span class="value"><?php echo htmlspecialchars($user['father_name']); ?></span>
                        </div>

                        <div class="data_row_group">
                            <span class="label">Father's Occupation:</span>
                            <span class="value"><?php echo htmlspecialchars($user['father_occupation']); ?></span>
                        </div>

                        <div class="data_row_group">
                            <span class="label">Father's Contact:</span>
                            <span class="value"><?php echo htmlspecialchars($user['father_contact']); ?></span>
                        </div>

                        <div class="data_row_group">
                            <span class="label">Mother's Name:</span>
                            <span class="value"><?php echo htmlspecialchars($user['mother_name']); ?></span>
                        </div>

                        <div class="data_row_group">
                            <span class="label">Mother's Contact:</span>
                            <span class="value"><?php echo htmlspecialchars($user['mother_contact']); ?></span>
                        </div>

                        <div class="data_row_group">
                            <span class="label">Guardian's Name:</span>
                            <span class="value"><?php echo htmlspecialchars($user['guardian_name']); ?></span>
                        </div>

                        <div class="data_row_group">
                            <span class="label">Guardian's Contact:</span>
                            <span class="value"><?php echo htmlspecialchars($user['guardian_contact']); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>