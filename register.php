
<?php 
include("aetsconn.php");
$error = '';
$succes_msg = '';

if(isset($_POST['submit'])){
    $User_name = $_POST['User_name'];
    $email = $_POST['email'];
    $passwd = $_POST['passwd']; 
    $confirm_password = $_POST['confirm_passwd'];
    $user_role = 'Admin';
    $secret_code = 'ADMIN123';

    if (empty($User_name) || empty($email) || empty($passwd) || empty($confirm_password))  {
        $error = "All fields are required!";
    }
    elseif(!filter_var($email ,FILTER_VALIDATE_EMAIL)){
        $error = "Invalid Email!";
    }
    elseif($passwd !== $confirm_password){
        $error = "The password didn't match!";
    }
    else{
        $verify_query = mysqli_query($conn , "SELECT user FROM user_db WHERE user='$User_name'");
        if(mysqli_num_rows($verify_query) != 0 ){
            $error = "This username is already taken, Try another one.";
        }
        else{
            $entered_code = $_POST['registration_code'];
            if ($entered_code !== $secret_code) {
                $error = "Invalid registration code!";
            }
            else{
                $hashedpw = password_hash($passwd ,PASSWORD_BCRYPT);
                $insert_data = "INSERT INTO user_db (user, email, passwd, user_role) VALUES('$User_name', '$email', '$hashedpw', '$user_role')"; 
                
                if(mysqli_query($conn, $insert_data)){
                    $succes_msg = "Registration Successful!";
                }
                else{
                    $error = "Error: " . mysqli_error($conn);
                }
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
    <title>Register As Admin</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <style>
        body{
            overflow: hidden;
        }
    </style>
</head>     
<body>

    <div class="login_button">
        <button class="register_button" onclick="location.href='Login.php';">login</button>
    </div>

    <div id="form">
        <h1>Register As Admin</h1>
        <form name="form" action="" method="POST">
            <div class="input_container">
                <i class="fa-solid fa-user"></i>
                <input type="text" name="User_name" id="User" placeholder="Username">    
            </div>

            <div class="input_container">
                <i class="fa-solid fa-envelope"></i>
                <input type="email" name="email" id="email" placeholder="Email"> 
            </div> 

            <div class="input_container">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="passwd" id="passwd" placeholder="Password"> 
            </div>

            <div class="input_container">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="confirm_passwd" id="confirm_passwd" placeholder="Confirm Password"> 
            </div> 

            <div class="input_container">
                <i class="fa-solid fa-key"></i>
                <input type="text" name="registration_code" id="registration_code" placeholder="Enter Registration Code"> 
            </div>

            <input type="Submit" id="btn" value="Register" name="submit">

            <div class="error_msg"><?php echo $error;?></div>
            <div class="succes_msg"><?php echo $succes_msg;?></div>

        </form>
    </div>
    
</body>
</html>
