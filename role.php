<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>role</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
</head>
<body>
<?php require_once('aetsheader.php'); ?>
<?php require_once('aetssidebar.php'); ?>  
<div class="container">
    <div class="rollpannel">
        <div class="role_header" >
            <span class="role">Roles</span>
            <span class="role_mgs">Manage Roles</span>
        </div>
    <div class="role_content">
        <div class="role_title">
                <span>All Roles</span>
                <div class="add">
                    <div class="add_icon"><i class="fa-solid fa-plus"></i></div>
                    <button>Add</button>    
                </div> 
        </div>
        
        <table class="roletable">
            <thread>
                <tr>
                    <th>Roles</th>
                    <th>Action</th>
                </tr>
            </thread>
            <tbody>
                </tbody>
                <tr>
                    <td><a href="">admin</a></td>
                    <td><a href="editrole.php"class="edit_btn" >Edit</a>
                        <a href="" class="delete_btn">Delete</a></td>
                </tr>
        </table>
    </div>  
    </div>
</div>    
</body>
</html>