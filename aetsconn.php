<?php
    $servername = "192.168.2.146";
    $username = "root";
    $password = "";
    $dbname = "database1";  
    $conn = new mysqli($servername, $username, $password, $dbname, 3306  );

    if ($conn->connect_error) {
        die("Connection failed". $conn->connect_error);
    }
    echo"Connection successfully";    
    
?>