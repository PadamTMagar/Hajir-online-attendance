<?php
require_once('aetsvalidside.php'); // ✅ First - before any HTML
require_once('aetsconn.php');

$error      = '';
$succes_msg = '';

$sql    = "SELECT * FROM role_db";
$result = mysqli_query($conn, $sql);
$roles  = [];
while ($role = mysqli_fetch_assoc($result)) {
    $roles[] = $role;
}

$class_sql    = "SELECT * FROM classroom";
$class_result = mysqli_query($conn, $class_sql);
$classrooms   = [];
while ($classroom = mysqli_fetch_assoc($class_result)) {
    $classrooms[] = $classroom;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $f_name            = $_POST['firstname'];
    $m_name            = $_POST['midname'];
    $l_name            = $_POST['lastname'];
    $email             = $_POST['emailid'];
    $number            = $_POST['phone_number'];
    $username          = $_POST['username'];
    $passwd            = $_POST['passwd'];
    $confirm_pw        = $_POST['confirm_pw'];
    $role_selection    = $_POST['role_selection'];
    $class_selection   = $_POST['class_selection'];
    $dob               = $_POST['dob'];
    $gender            = $_POST['gender'];
    $marital           = $_POST['marital'];
    $blood             = $_POST['blood'];
    $alter_contact     = $_POST['alter_contact'];
    $perm_address      = $_POST['perm_address'];
    $temp_address      = $_POST['temp_address'];
    $father_name       = $_POST['father_name'];
    $father_occupation = $_POST['father_occupation'];
    $father_contact    = $_POST['father_contact'];
    $mother_name       = $_POST['mother_name'];
    $mother_contact    = $_POST['mother_contact'];
    $guardian_name     = $_POST['guardian_name'];
    $guardian_contact  = $_POST['guardian_contact'];

    // ✅ Validation
    if (empty($username) || empty($email) || empty($passwd) || empty($confirm_pw) || empty($f_name) || empty($l_name) || empty($number)) {
        $error = "All fields are required!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format!";
    } elseif (!preg_match("/^[0-9]{10}$/", $number)) {
        $error = "Invalid phone number! Must be 10 digits.";
    } elseif ($passwd !== $confirm_pw) {
        $error = "Passwords do not match!";
    } else {
        // ✅ Check duplicate username
        $verify_query = mysqli_query($conn, "SELECT user FROM user_db WHERE user='$username'");

        if (mysqli_num_rows($verify_query) != 0) {
            $error = "This username is already taken, try another one.";
        } else {
            $hashed_password = password_hash($passwd, PASSWORD_DEFAULT);

            // ✅ Insert into user_db
            $insert_user = "INSERT INTO user_db (user, email, passwd, user_role) 
                            VALUES ('$username', '$email', '$hashed_password', '$role_selection')";

            if (mysqli_query($conn, $insert_user)) {
                $user_id = mysqli_insert_id($conn); // ✅ get user_db id

                // ✅ Insert into userlist with profile_pic as empty string
                $insert_data = "INSERT INTO userlist 
                                (firstname, midname, lastname, emailid, phone_number, 
                                 profile_pic, class_selection, dob, gender, marital, 
                                 blood, alter_contact, perm_address, temp_address, 
                                 father_name, father_occupation, father_contact, 
                                 mother_name, mother_contact, guardian_name, 
                                 guardian_contact, user_id) 
                                VALUES 
                                ('$f_name', '$m_name', '$l_name', '$email', '$number', 
                                 '', '$class_selection', '$dob', '$gender', '$marital', 
                                 '$blood', '$alter_contact', '$perm_address', '$temp_address', 
                                 '$father_name', '$father_occupation', '$father_contact', 
                                 '$mother_name', '$mother_contact', '$guardian_name', 
                                 '$guardian_contact', '$user_id')";

                if (mysqli_query($conn, $insert_data)) {
                    $userlist_id = mysqli_insert_id($conn); // ✅ get userlist id

                    // ✅ Redirect to face_capture with correct userlist id
                    header("Location: face_capture.php?user_id=" . $userlist_id);
                    exit();
                } else {
                    $error = "Error inserting into userlist: " . mysqli_error($conn);
                }
            } else {
                $error = "Error inserting into user_db: " . mysqli_error($conn);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
</head>
<body>

<?php require_once('aetsheader.php'); // ✅ After session ?>

<div class="container">
    <div class="add_user">
        <div class="add_header">
            <span class="user">Add User</span>
        </div>

        <?php if (!empty($error)): ?>
            <div class="error_msg"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if (!empty($succes_msg)): ?>
            <div class="succes_msg"><?php echo $succes_msg; ?></div>
        <?php endif; ?>

        <form action="" name="adduser" method="POST" enctype="multipart/form-data">
            <div class="user_details">
                <div class="form_row">
                    <div class="form_group">
                        <label for="firstname">First Name:*</label>
                        <input type="text" name="firstname" id="firstname" placeholder="First Name" required>
                    </div>

                    <div class="form_group">
                        <label for="midname">Middle Name:</label>
                        <input type="text" name="midname" id="midname" placeholder="Mid Name">
                    </div>

                    <div class="form_group">
                        <label for="lastname">Last Name:*</label>
                        <input type="text" name="lastname" id="lastname" placeholder="Last Name" required>
                    </div>
                </div>

                <div class="form_row">
                    <div class="form_group">
                        <label for="emailid">Email:*</label>
                        <input type="email" name="emailid" id="emailid" placeholder="Email" required>
                    </div>

                    <div class="form_group">
                        <label for="phone_number">Phone Number:*</label>
                        <input type="tel" name="phone_number" id="phone_number" placeholder="9*********" required>
                    </div>
                </div>
            </div>

            <div class="role_permiss">
                <h1>Role & Permissions</h1>

                <div class="form_row">
                    <div class="form_group">
                        <label for="username">Username:*</label>
                        <input type="text" name="username" id="username" placeholder="User Name" required>
                    </div>

                    <div class="form_group">
                        <label for="passwd">Password:*</label>
                        <input type="password" name="passwd" id="passwd" placeholder="Password" required>
                    </div>

                    <div class="form_group">
                        <label for="confirm_pw">Confirm Password:*</label>
                        <input type="password" name="confirm_pw" id="confirm_pw" placeholder="Confirm Password" required>
                    </div>
                </div>

                <div class="form_row">
                    <div class="form_group">
                        <label for="role_selection">Select Role:*</label>
                        <select name="role_selection" id="roleselection" required>
                            <option value="">Please Select</option>
                            <?php foreach ($roles as $role): ?>
                                <option value="<?php echo $role['rolename']; ?>">
                                    <?php echo $role['rolename']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form_group">
                        <label for="class_selection">Select Class:*</label>
                        <select name="class_selection" id="classselection" required>
                            <option value="">Please Select</option>
                            <?php foreach ($classrooms as $classroom): ?>
                                <option value="<?php echo $classroom['classroom_name']; ?>">
                                    <?php echo $classroom['classroom_name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="more_details">
                <h1>More Information</h1>

                <div class="form_row">
                    <div class="form_group">
                        <label for="dob">Date of Birth:</label>
                        <input type="date" name="dob" id="dob" required>
                    </div>

                    <div class="form_group">
                        <label for="gender">Gender:</label>
                        <select name="gender" id="gender">
                            <option value="">Please Select</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="form_group">
                        <label for="marital">Marital Status:</label>
                        <select name="marital" id="marital">
                            <option value="">Please Select</option>
                            <option value="Married">Married</option>
                            <option value="Unmarried">Unmarried</option>
                            <option value="Divorced">Divorced</option>
                        </select>
                    </div>

                    <div class="form_group">
                        <label for="blood">Blood Group:</label>
                        <select name="blood" id="blood">
                            <option value="">Please Select</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                        </select>
                    </div>
                </div>

                <div class="form_row">
                    <div class="form_group">
                        <label for="alter_contact">Alternate Contact:</label>
                        <input type="text" name="alter_contact" id="alter_contact" placeholder="Alternate Contact">
                    </div>

                    <div class="form_group">
                        <label for="perm_address">Permanent Address:</label>
                        <input type="text" name="perm_address" id="perm_address" placeholder="Permanent Address">
                    </div>

                    <div class="form_group">
                        <label for="temp_address">Temporary Address:</label>
                        <input type="text" name="temp_address" id="temp_address" placeholder="Temporary Address">
                    </div>
                </div>

                <div class="form_row">
                    <div class="form_group">
                        <label for="father_name">Father's Name:</label>
                        <input type="text" name="father_name" id="father_name" placeholder="Father's Name">
                    </div>

                    <div class="form_group">
                        <label for="father_occupation">Father's Occupation:</label>
                        <input type="text" name="father_occupation" id="father_occupation" placeholder="Father's Occupation">
                    </div>

                    <div class="form_group">
                        <label for="father_contact">Father's Contact:</label>
                        <input type="text" name="father_contact" id="father_contact" placeholder="Father's Contact">
                    </div>
                </div>

                <div class="form_row">
                    <div class="form_group">
                        <label for="mother_name">Mother's Name:</label>
                        <input type="text" name="mother_name" id="mother_name" placeholder="Mother's Name">
                    </div>

                    <div class="form_group">
                        <label for="mother_contact">Mother's Contact:</label>
                        <input type="text" name="mother_contact" id="mother_contact" placeholder="Mother's Contact">
                    </div>
                </div>

                <div class="form_row">
                    <div class="form_group">
                        <label for="guardian_name">Guardian's Name:</label>
                        <input type="text" name="guardian_name" id="guardian_name" placeholder="Guardian's Name">
                    </div>

                    <div class="form_group">
                        <label for="guardian_contact">Guardian's Contact:</label>
                        <input type="text" name="guardian_contact" id="guardian_contact" placeholder="Guardian's Contact">
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" name="submit">Create</button>
                </div>
            </div>
        </form>
    </div>
</div>

</body>
</html>