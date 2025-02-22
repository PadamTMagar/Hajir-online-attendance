<?php require_once('aetsconn.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
</head>
<body>

<?php require_once('aetsheader.php'); ?>
<?php require_once('aetssidebar.php'); ?>  

<div class="container">
    <div class="add_user">
        <div class="add_header">
            <span class="user">Add user</span>
        </div>

        <form action="" name="adduser" method="POST">
            <div class="user_details">
       
                <div class="form_row">
                    <div class="form_group">
                        <label for="fname" id="fname">First Name:*</label>
                        <input type="text" name="firstname" id="fistname" placeholder="First Name" required>
                    </div>

                    <div class="form_group">
                        <label for="mname" id="mname">Middle Name:</label>
                        <input type="text" name="midname" id="midname" placeholder="Mid Name">
                    </div>

                    <div class="form_group">
                        <label for="lname" id="lname">Last Name:*</label>
                        <input type="text" name="lastname" id="lastname" placeholder="Last Name">
                    </div>
                </div>
            

            
                <div class="form_row">
                    <div class="form_group">
                        <label for="email" id="email">Email:*</label>
                        <input type="email" name="emailid" id="emailid" placeholder="Email" required>
                    </div>
                        
                    <div class="form_group">
                        <label for="phone_number" id="num">Phone Number:*</label>
                        <input type="tel" name="phone_number" id="phone_number" placeholder="+977 - 9*********" required>
                    </div>

                    <div class="form_group">
                        <label for="picture" id="picture">Choose a profile picture:*</label>
                        <input type="file" name="profile_pic" id="profile_pic" required>
                    </div>
                </div>
            </div>
            

            <div class="role_permiss">
                <h1>Role & Permissions</h1>

                <div class="form_row">                    
                    <div class="form_group">
                        <label for="username" id="username">Username:*</label>
                        <input type="text" name="user" id="user" placeholder="User Name" required>
                    </div>

                    <div class="form_group">
                        <label for="password" id="password">Password:*</label>
                        <input type="password" name="passwd" id="passwd" placeholder="Password" required>
                    </div>

                    <div class="form_group">
                        <label for="confirm_pw" id="confirm_pw">Confirm Password:*</label>
                        <input type="password" name="confirm_pw" id="confirm_pw" placeholder="Confirm Password" required>
                    </div>
                    </div>

                    <div class="form_row">
                        <div class="form_group">
                            <label for="role_selection" id="role_selection">Select Role:*</label>
                            <select name="role_selection" id="roleselection" required>
                                <option value="">Please Select</option>
                                <option value="">Teacher</option>
                                <option value="">Student</option>
                            </select>
                        </div>
                        <div class="form_group">
                            <label for="class_selection" id="class_selection">Select Class:*</label>
                            <select name="class_selection" id="classselection" required>
                                <option value="">Please Select</option>
                                <option value="">class 1</option>
                                <option value="">class 2</option>
                            </select>
                        </div>
                    </div>   
            </div>

            <div class="more_details">
                <h1>More Information</h1>

                <div class="form_row">
                    <div class="form_group">
                        <label for="dateofbirth" id="dateofbirth">Date of Birth:</label>
                        <input type="date" name="dob" id="dob" required>
                    </div>

                    <div class="form_group">
                            <label for="gender" id="gender">Gender:</label>
                            <select name="gender" id="gender">
                                <option value="">Please Select</option>
                                <option value="">Male</option>
                                <option value="">Female</option>
                                <option value="">Other</option>
                            </select>
                    </div>

                    <div class="form_group">
                            <label for="marital" id="marital">Marital Status:</label>
                            <select name="marital" id="marital">
                                <option value="">Please Select</option>
                                <option value="">Married</option>
                                <option value="">Unmarried</option>
                                <option value="">Divorced</option>
                            </select>
                    </div>

                    <div class="form_group">
                        <label for="blood" id="blood">Blood Group:</label>
                        <input type="text" name="blood" id="blood" placeholder="Blood Group" required>
                    </div>
                </div>

                <div class="form_row">
                    <div class="form_group">
                        <label for="alter_contact" id="alter_contact">Alternate Contact:</label>
                        <input type="text" name="alter_contact" id="alter_contact" placeholder="Alternate Contact" required>
                    </div>

                    <div class="form_group">
                        <label for="per_address" id="perm_address">Permanent Address:</label>
                        <input type="text" name="per_address" id="per_address" placeholder="Permanent Address" required>
                    </div>

                    <div class="form_group">
                        <label for="temp_address" id="temp_address">Temporary Address:</label>
                        <input type="text" name="temp_address" id="temp_address" placeholder="Temporary Address" required>
                    </div>
                </div>

                <div class="form_row">
                    <div class="form_group">
                        <label for="father_name" id="father_name">Father's Name:</label>
                        <input type="text" name="father_name" id="father_name" placeholder="Father's Name" required>
                    </div>

                    <div class="form_group">
                        <label for="father_occupation" id="father_occupation">Father's Occupation:</label>
                        <input type="text" name="father_occupation" id="father_occupation" placeholder="Father's Occupation" required>
                    </div>

                    <div class="form_group">
                        <label for="father_contact" id="father_contact">Father's Contact:</label>
                        <input type="text" name="father_contact" id="father_contact" placeholder="Father's Contact" required>
                    </div>
                </div>

                <div class="form_row">
                    <div class="form_group">
                        <label for="mother_name" id="mother_name">Mother's Name:</label>
                        <input type="text" name="mother_name" id="mother_name" placeholder="Mother's Name" required>
                    </div>

                    <div class="form_group">
                        <label for="mother_contact" id="mother_contact">Mother's Contact:</label>
                        <input type="text" name="mother_contact" id="mother_contact" placeholder="Mother's Contact" required>
                    </div>
                </div>

                <div class="form_row">
                    <div class="form_group">
                        <label for="guardian_name" id="guardian_name">Guardian's Name:</label>
                        <input type="text" name="guardian_name" id="guardian_name" placeholder="Guardian's Name" required>
                    </div>

                    <div class="form_group">
                        <label for="guardian_contact" id="guardian_contact">Guardian's Contact:</label>
                        <input type="text" name="guardian_contact" id="guardian_contact" placeholder="Guardian's Contact" required>
                    </div>
                </div>

            </div>
        </form>    
    </div>
    <div class="form-actions">
                <button type="submit">Create</button>
    </div>
</div>
    
    
</div>

</body>
</html>