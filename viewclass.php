<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
</head>
<body>
<?php require_once('aetsheader.php'); ?>
<?php require_once('aetssidebar.php'); ?>  
<?php require_once('aetsconn.php'); ?>
 
    <div class="container">
        <div class="class"> <!--rolepannel-->
            <div class="class_header" >
                <span class="classeslist">Classes</span>
                <span class="class_mgs">Manage class</span>
            </div>
        <div class="class_content">
            <div class="class_title">
                    <span>All Classes</span>
                    <div class="add">
                        <div class="add_icon"><i class="fa-solid fa-plus"></i></div>
                        <button onclick="location.href='createclass.php';">Add</button>        
                    </div> 
            </div>
        </div>
        </div>
    </div>
</body>
</html>