<?php 
include("../aetsconn.php");

$table = "CREATE TABLE userlist(
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(50) NOT NULL,
    midname VARCHAR(50),
    lastname VARCHAR(50) NOT NULL,
    emailid VARCHAR(50) NOT NULL UNIQUE,
    number INT(10) NOT NULL,
    
)";
?> 