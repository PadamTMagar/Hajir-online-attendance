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
    class_selection ENUM('class1' , 'class2') NOT NULL,
    dob DATE NOT NULL,
    gender ENUM('Male' , 'Female' , 'Other') NOT NULL,
    marital ENUM('Married' , 'Unmarried' , 'Divorced')  ,
    blood VARCHAR(10) NOT NULL,
    alter_contact VARCHAR(20),
    perm_address VARCHAR(255) NOT NULL ,
    temp_address VARCHAR(255) NOT NULL ,
    father_name VARCHAR(50) NOT NULL ,
    father_occupation VARCHAR(50) NOT NULL ,
    father_contact VARCHAR(20) NOT NULL ,
    mother_name VARCHAR(50) NOT NULL,
    mother_contact VARCHAR(20) NOT NULL,
    guardian_name VARCHAR(20),
    guardian_contact VARCHAR(20)

)";

$result = mysqli_query($conn  , $table);

if ($result) {
    echo "Table created successfully";
} 

else {
    echo "Unsuccessful creation of table: " . mysqli_error($conn);
}

mysqli_close($conn);
?>


