<?php session_start()?>
<?php 
include("aetsconn.php");

$error = '';
$succes_msg ='';


if(isset($_POST['submit'])){
    $User_name = $_POST['User_name'];
    $password = $_POST['password'];

    if(empty($User_name) || empty($password) ){
        $error = "Both fields are required!";
    }
    else
    {
        $verify_query = mysqli_query($conn , "SELECT * FROM user_db WHERE user ='$User_name'");
       
        if(mysqli_num_rows($verify_query) == 1){
            $user_data = mysqli_fetch_assoc($verify_query);
            $hashedpw = $user_data['passwd'];
            if(password_verify($password,$hashedpw)){
                $succes_msg = "Login Successfull!";
                session_start();
                $_SESSION['user'] = $User_name;
                header("location:index.php");
                exit();
            }
            else{
                $error = "Invalid Password!";
            }

        }
        else {
            $error = "Usename not found!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
</head>     
<body>
    <div class="login_button">
        <button class="register_button" onclick="location.href='register.php';">Register</button>
    </div>

    <div id="form">
        <h1>Login</h1>
        <form name="form" action="" method="POST">
            <div class="input_container">
                <i class="fa-solid fa-user"></i>
                <input type="text" name="User_name" id="User" placeholder="Username">    
            </div>

            <div class="input_container">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Password"> 
            </div> 


            <input type="Submit" id="btn" value="Login" name="submit">

                <div class="error_msg"><?php echo $error;?></div>
                <div class="succes_msg"><?php echo $succes_msg;?></div>
        </form>
    </div>
    
</body>
</html>