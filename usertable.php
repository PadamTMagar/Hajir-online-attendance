<?php
include("aetsconn.php");



$table = "CREATE TABLE user_db (
                id INT AUTO_INCREMENT PRIMARY KEY NOT NULL, 
                User_name VARCHAR(30) NOT NULL, 
                email VARCHAR(30) NOT NULL, 
                passwd VARCHAR(255) NOT NULL, 
                user_role VARCHAR(20) NOT NULL
)";

$result = mysqli_query($conn, $table);

if ($result) {
    echo "Table created successfully";
} 

else {
    echo "Unsuccessful creation of table: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
