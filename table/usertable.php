<?php 
include("../aetsconn.php");

$table = "CREATE TABLE userlist(
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(50) NOT NULL,
    midname VARCHAR(50),
    lastname VARCHAR(50) NOT NULL,
    emailid VARCHAR(50) NOT NULL UNIQUE,
    phone_number INT(10) NOT NULL,
    profile_pic VARCHAR(255) NOT NULL,
    


)";
?> 