<?php 
include("aetsconn.php");

if(isset($_POST['submit'])){
    $user =$_POST['user'];
    $password =$_POST['user'];

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
    <div id="form">
        <h1>Login</h1>
        <form name="form" action="index.php" method="POST">
            <div class="input_container">
                <i class="fa-solid fa-user"></i>
                <input type="text" name="user" id="user" placeholder="Username">    
            </div>

            <div class="input_container">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Password"> 
            </div> 


            <input type="Submit" id="btn" value="Login" name="submit" />
        </form>
    </div>
    
</body>
</html>