<!-- this table is for user login database  -->



<?php
include("../aetsconn.php");



$table = "CREATE TABLE user_db (
                id INT AUTO_INCREMENT PRIMARY KEY NOT NULL, 
                user_id INT , 
                user VARCHAR(30) NOT NULL, 
                email VARCHAR(30) NOT NULL, 
                passwd VARCHAR(255) NOT NULL, 
                user_role VARCHAR(20) NOT NULL
                CONSTRAINT fk_user_id FOREIGN KEY (user_id) REFERENCES usertable(id) ON DELETE CASCADE ON UPDATE CASCADE
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
