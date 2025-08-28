<?php
    $servername = "192.168.1.68";
    $username = "root";
    $password = "";
    $dbname = "hajir";  
    $conn = new mysqli($servername, $username, $password, $dbname, 3306  );

    if ($conn->connect_error) {
        die("Connection failed". $conn->connect_error);
    }
    // echo"Connection successfully";  s  
    
?>

<!-- 
GRANT ALL PRIVILEGES ON *.* TO 'root'@'192.168.2.43' IDENTIFIED BY 'your_password';

FLUSH PRIVILEGES; -->
