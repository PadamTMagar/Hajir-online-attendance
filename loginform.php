<?php 
include("aetsconn.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="form">
        <h1>Login</h1>
        <form name="form" action="loginvalue.php" method="POST">
            <label for="username">Username</label>
            <input type="text" name="user" id="user" placeholder="Username"> <br> <br>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Password"> <br> <br>
            <input type="Submit" id="btn" value="Login" name="submit" />
        </form>
    </div>
    
</body>
</html>