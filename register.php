<?php 
include("aetsconn.php");

if(isset($_POST['submit'])){

    $User_name = $_POST['User_name'];
    $passwd = $_POST['passwd']; 
    $sql = "SELECT * from user_db where User_name='$User_name' and passwd = '$passwd'";
    $result = mysqli_query($conn , $sql);
   echo $count = mysqli_num_rows($result);
    if($count>0){
            $row = mysqli_fetch_assoc($result);
    }else{
        $error = 'Please enter correct login details';
    }
};
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
        <button class="register_button" onclick="location.href='Loginform.php';">login</button>
    </div>

    <div id="form">
        <h1>Register As Admin</h1>
        <form name="form" action="index.php" method="POST">
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
                <input type="password" name="passwd" id="passwd" placeholder="Confirm Password"> 
            </div> 


            <input type="Submit" id="btn" value="Register" name="submit">
                        <?php echo $error;?> 
        </form>
    </div>
    
</body>
</html>