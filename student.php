<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>student</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
</head>
<body>
<?php require_once('aetsheader.php'); ?>
<?php require_once('aetssidebar.php'); ?>   
<div class="container">
    <div class="student"> 
        <div class="student_header" >
            <span class="student">Students</span>
            <span class="student_mgs">Manage Students</span>
        </div>
    <div class="student_content">
        <div class="student_title">
                <span>All Student</span>
                <div class="add">
                    <div class="add_icon"><i class="fa-solid fa-plus"></i></div>
                    <button onclick="location.href='createuser.php';">Add</button>       
                </div> 
        </div>
    </div>
    </div>
</div>
</body>
</html>