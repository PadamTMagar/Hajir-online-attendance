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
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
</head>     
<body>


    <div id="form">
        <h1>Login</h1>
        <form name="form" action="" method="POST">
            <div class="input_container">
                <i class="fa-solid fa-user"></i>
                <input type="text" name="User_name" id="User" placeholder="Username">    
            </div>

            <div class="input_container">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="passwd" id="passwd" placeholder="Password"> 
            </div> 


            <input type="Submit" id="btn" value="Login" name="submit">
                        <?php echo $error;?> 
        </form>
    </div>
    
</body>
</html>