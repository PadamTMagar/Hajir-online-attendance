<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>teacher</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">

</head>
<body>
<?php require_once('aetsheader.php'); ?>
<?php require_once('aetssidebar.php'); ?>   
<div class="container">
    <div class="teacher"> <!--rolepannel-->
        <div class="teacher_header" >
            <span class="teacher">Teachers</span>
            <span class="teacher_mgs">Manage Teachers</span>
        </div>
    <div class="teacher_content">
        <div class="teacher_title">
                <span>All Teachers</span>
                <div class="add">
                    <div class="add_icon"><i class="fa-solid fa-plus"></i></div>
                    <button onclick="location.href='createnew.php';">Add</button>    
                </div> 
        </div>
    </div>
    </div>
</div>
</body>
</html>