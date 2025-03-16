<?php session_start()?>

<?php
require_once('aetsconn.php');

$error = '';
$success_msg = '';
$user = [];

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if ($id > 0) {
        $sql = "SELECT * FROM userlist WHERE user_id = $id";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
        } else {
            $error = "User not found.";
        }
    } else {
        $error = "Invalid user ID.";
    }
} else {
    $error = "No user ID provided.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id = intval($_POST['id']);
    $f_name = $_POST['firstname'];
    $m_name = $_POST['midname'];
    $l_name = $_POST['lastname'];
    $email = $_POST['emailid'];
    $number = $_POST['phone_number'];
    $class = $_POST['class_selection'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $marital = $_POST['marital'];
    $blood = $_POST['blood'];
    $alter_contact = $_POST['alter_contact'];
    $perm_address = $_POST['perm_address'];
    $temp_address = $_POST['temp_address'];
    $father_name = $_POST['father_name'];
    $father_occupation = $_POST['father_occupation'];
    $father_contact = $_POST['father_contact'];
    $mother_name = $_POST['mother_name'];
    $mother_contact = $_POST['mother_contact'];
    $guardian_name = $_POST['guardian_name'];
    $guardian_contact = $_POST['guardian_contact'];

    if (!empty($_FILES["profile_pic"]["name"])) {
        $pic_name = $_FILES["profile_pic"]["name"];
        $temp_name = $_FILES["profile_pic"]["tmp_name"];
        $folder = "profilePic/" . $pic_name;

        if (move_uploaded_file($temp_name, $folder)) {
            $success_msg = "File uploaded successfully.";
        } else {
            $error = "Error uploading file.";
        }
    } else {
        $pic_name = $user['profile_pic'];
    }

    // Update userlist table
    $update_userlist = "UPDATE userlist SET
        firstname = '$f_name',
        midname = '$m_name',
        lastname = '$l_name',
        emailid = '$email',
        phone_number = '$number',
        profile_pic = '$pic_name',
        class_selection = '$class',
        dob = '$dob',
        gender = '$gender',
        marital = '$marital',
        blood = '$blood',
        alter_contact = '$alter_contact',
        perm_address = '$perm_address',
        temp_address = '$temp_address',
        father_name = '$father_name',
        father_occupation = '$father_occupation',
        father_contact = '$father_contact',
        mother_name = '$mother_name',
        mother_contact = '$mother_contact',
        guardian_name = '$guardian_name',
        guardian_contact = '$guardian_contact'
        WHERE user_id = $id";

    // Update user_db table
    $update_userdb = "UPDATE user_db SET
        email = '$email',
        user_role = '{$_POST['role_selection']}'
        WHERE user_id = $id";

    // Execute both updates
    if (mysqli_query($conn, $update_userlist) && mysqli_query($conn, $update_userdb)) {
        header("Location: user.php");
        exit();
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}

$sql = "SELECT * FROM role_db";
$result = mysqli_query($conn, $sql);
$roles = [];
while ($role = mysqli_fetch_assoc($result)) {
    $roles[] = $role;
}

$class_sql = "SELECT * FROM classroom";
$class_result = mysqli_query($conn, $class_sql);
$classrooms = [];
while ($classroom = mysqli_fetch_assoc($class_result)) {
    $classrooms[] = $classroom;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
</head>
<body>

<?php require_once('aetsheader.php'); ?>
<?php 
// require_once('aetssidebar.php');
require_once('aetsvalidside.php'); 
?>  


<div class="container">
    <div class="add_user">
        <div class="add_header">
            <span class="user">Update User</span>
        </div>

        <?php if (!empty($error)): ?>
            <div class="error_msg"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if (!empty($success_msg)): ?>
            <div class="success_msg"><?php echo $success_msg; ?></div>
        <?php endif; ?>

        <?php if (!empty($user)): ?>
            <form action="" name="updateuser" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">

                <div class="user_details">
                    <div class="form_row">
                        <div class="form_group">
                            <label for="fname" id="fname">First Name:*</label>
                            <input type="text" name="firstname" id="firstname" placeholder="First Name" value="<?php echo $user['firstname']; ?>" required>
                        </div>

                        <div class="form_group">
                            <label for="mname" id="mname">Middle Name:</label>
                            <input type="text" name="midname" id="midname" placeholder="Mid Name" value="<?php echo $user['midname']; ?>">
                        </div>

                        <div class="form_group">
                            <label for="lname" id="lname">Last Name:*</label>
                            <input type="text" name="lastname" id="lastname" placeholder="Last Name" value="<?php echo $user['lastname']; ?>" required>
                        </div>
                    </div>

                    <div class="form_row">
                        <div class="form_group">
                            <label for="email" id="email">Email:*</label>
                            <input type="email" name="emailid" id="emailid" placeholder="Email" value="<?php echo $user['emailid']; ?>" required>
                        </div>

                        <div class="form_group">
                            <label for="phone_number" id="num">Phone Number:*</label>
                            <input type="tel" name="phone_number" id="phone_number" placeholder="9*********" value="<?php echo $user['phone_number']; ?>" required>
                        </div>

                        <div class="form_group">
                            <label for="picture" id="picture">Choose a profile picture:</label>
                            <input type="file" name="profile_pic" id="profile_pic">
                            <small>Current: <?php echo $user['profile_pic']; ?></small>
                        </div>
                    </div>
                </div>

                <div class="role_permiss">
                    <h1>Role & Permissions</h1>

                    <div class="form_row">
                        <div class="form_group">
                            <label for="role_selection" id="role_selection">Select Role:*</label>
                            <select name="role_selection" id="roleselection" required>
                                <option value="">Please Select</option>
                                <?php 
                                    foreach ($roles as $role) {
                                        $selected = ($role['rolename'] == $user['user_role']) ? 'selected' : '';
                                        echo "<option value='" . $role['rolename'] . "' $selected>" . $role['rolename'] . "</option>";
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="form_group">
                            <label for="class_selection" id="class_selection">Select Class:*</label>
                            <select name="class_selection" id="classselection" required>
                                <option value="">Please Select</option>
                                <?php 
                                    foreach($classrooms as $classroom) {
                                        $selected = ($classroom['classroom_name'] == $user['class_selection']) ? 'selected' : '';
                                        echo "<option value='" . $classroom['classroom_name'] . "' $selected>" . $classroom['classroom_name'] . "</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="more_details">
                    <h1>More Information</h1>

                    <div class="form_row">
                        <div class="form_group">
                            <label for="dateofbirth" id="dateofbirth">Date of Birth:</label>
                            <input type="date" name="dob" id="dob" value="<?php echo $user['dob']; ?>" required>
                        </div>

                        <div class="form_group">
                            <label for="gender" id="gender">Gender:</label>
                            <select name="gender" id="gender">
                                <option value="">Please Select</option>
                                <option value="Male" <?php echo ($user['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                                <option value="Female" <?php echo ($user['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                                <option value="Other" <?php echo ($user['gender'] == 'Other') ? 'selected' : ''; ?>>Other</option>
                            </select>
                        </div>

                        <div class="form_group">
                            <label for="marital" id="marital">Marital Status:</label>
                            <select name="marital" id="marital">
                                <option value="">Please Select</option>
                                <option value="Married" <?php echo ($user['marital'] == 'Married') ? 'selected' : ''; ?>>Married</option>
                                <option value="Unmarried" <?php echo ($user['marital'] == 'Unmarried') ? 'selected' : ''; ?>>Unmarried</option>
                                <option value="Divorced" <?php echo ($user['marital'] == 'Divorced') ? 'selected' : ''; ?>>Divorced</option>
                            </select>
                        </div>

                        <div class="form_group">
                            <label for="blood" id="blood">Blood Group:</label>
                            <input type="text" name="blood" id="blood" placeholder="Blood Group" value="<?php echo $user['blood']; ?>" required>
                        </div>
                    </div>

                    <div class="form_row">
                        <div class="form_group">
                            <label for="alter_contact" id="alter_contact">Alternate Contact:</label>
                            <input type="text" name="alter_contact" id="alter_contact" placeholder="Alternate Contact" value="<?php echo $user['alter_contact']; ?>" required>
                        </div>

                        <div class="form_group">
                            <label for="perm_address" id="perm_address">Permanent Address:</label>
                            <input type="text" name="perm_address" id="perm_address" placeholder="Permanent Address" value="<?php echo $user['perm_address']; ?>" required>
                        </div>

                        <div class="form_group">
                            <label for="temp_address" id="temp_address">Temporary Address:</label>
                            <input type="text" name="temp_address" id="temp_address" placeholder="Temporary Address" value="<?php echo $user['temp_address']; ?>" required>
                        </div>
                    </div>

                    <div class="form_row">
                        <div class="form_group">
                            <label for="father_name" id="father_name">Father's Name:</label>
                            <input type="text" name="father_name" id="father_name" placeholder="Father's Name" value="<?php echo $user['father_name']; ?>" required>
                        </div>

                        <div class="form_group">
                            <label for="father_occupation" id="father_occupation">Father's Occupation:</label>
                            <input type="text" name="father_occupation" id="father_occupation" placeholder="Father's Occupation" value="<?php echo $user['father_occupation']; ?>" required>
                        </div>

                        <div class="form_group">
                            <label for="father_contact" id="father_contact">Father's Contact:</label>
                            <input type="text" name="father_contact" id="father_contact" placeholder="Father's Contact" value="<?php echo $user['father_contact']; ?>" required>
                        </div>
                    </div>

                    <div class="form_row">
                        <div class="form_group">
                            <label for="mother_name" id="mother_name">Mother's Name:</label>
                            <input type="text" name="mother_name" id="mother_name" placeholder="Mother's Name" value="<?php echo $user['mother_name']; ?>" required>
                        </div>

                        <div class="form_group">
                            <label for="mother_contact" id="mother_contact">Mother's Contact:</label>
                            <input type="text" name="mother_contact" id="mother_contact" placeholder="Mother's Contact" value="<?php echo $user['mother_contact']; ?>" required>
                        </div>
                    </div>

                    <div class="form_row">
                        <div class="form_group">
                            <label for="guardian_name" id="guardian_name">Guardian's Name:</label>
                            <input type="text" name="guardian_name" id="guardian_name" placeholder="Guardian's Name" value="<?php echo $user['guardian_name']; ?>" required>
                        </div>

                        <div class="form_group">
                            <label for="guardian_contact" id="guardian_contact">Guardian's Contact:</label>
                            <input type="text" name="guardian_contact" id="guardian_contact" placeholder="Guardian's Contact" value="<?php echo $user['guardian_contact']; ?>" required>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" name="update">Update</button>
                    </div>
                </div>
            </form>
        <?php endif; ?>
    </div>
</div>

</body>
</html>