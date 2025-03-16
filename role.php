
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Role</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
</head>
<body>
    <?php require_once('aetsheader.php'); ?>
    <?php 
    // require_once('aetssidebar.php');
    require_once('aetsvalidside.php');
     ?>  
    <?php require_once('aetsconn.php');?>
    <div class="container">
        <div class="rollpannel">
            <div class="role_header">
                <span class="role">Roles</span>
                <span class="role_mgs">Manage Roles</span>
            </div>
            <div class="role_content">
                <div class="role_title">
                    <span>All Roles</span>
                    <div class="add">
                        <div class="add_icon"><i class="fa-solid fa-plus"></i></div>
                        <button onclick="location.href='createrole.php'">Add</button>    
                    </div> 
                </div>
                
                <table class="roletable">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Roles</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM role_db";
                        $result = mysqli_query($conn, $sql);
                        
                        if ($result && mysqli_num_rows($result) > 0) {
                            foreach($result as $row)
                            {
                                ?>
                                <tr>
                                    <td><?php echo$row['role_id'];?></td>
                                    <td><?php echo$row['rolename'];?></td>
                                    <td>
                                        <a href='editrole.php?id=<?php echo $row['role_id']; ?>' class='edit_btn'>Edit</a>
                                        <a href='' class='delete_btn'>Delete</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        else
                        {
                            echo"No record found";
                        }  
                        ?>
                    </tbody>
                </table>
            </div>  
        </div>
    </div>    
</body>
</html>
