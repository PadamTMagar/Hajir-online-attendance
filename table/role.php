<?php
include("../aetsconn.php");



$table = "CREATE TABLE user_db (
                role_id INT AUTO_INCREMENT PRIMARY KEY NOT NULL, 
                rolename VARCHAR(30) NOT NULL , 
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