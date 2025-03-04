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
    <div class="userpannel"> <!--rolepannel-->
        <div class="user_header" >
            <span class="user">Users</span>
            <span class="user_mgs">Manage Users</span>
        </div>
    <div class="user_content">
        <div class="user_title">
                <span>All Users</span>
                <div class="add">
                    <div class="add_icon"><i class="fa-solid fa-plus"></i></div>
                    <button onclick="location.href='createuser.php';">Add</button>        
                </div> 
        </div>
            
        <table class="usertable">
            <thread>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thread>
            <tbody>
                    <?php 
                        $sql = "SELECT * FROM user_db";
                        $result = mysqli_query($conn , $sql);
                        if(mysqli_num_rows($result) > 0 ){
                            foreach($result as $row)
                            {
                               
                                ?>
                                    <tr>
                                        <td><?php echo$row['id']; ?></td>
                                        <td><?php echo$row['user']; ?></td>
                                        <td><?php echo$row['email']; ?></td>
                                        <td><?php echo$row['user_role']; ?></td>
                                        <td class="action_row">
                                            <a href="viewuser.php?id=<?php echo $row['id']; ?>" class="view_btn">View</a>
                                            <a href='edituser.php?id=<?php echo $row['id']; ?>' class="edit_btn">Edit</a>
                                            <a href="delete.php?id=<?php echo $row['id']; ?>" class="delete_btn" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                                    </tr>

                                <?php
                            }   
                        }else
                        {
                            echo"No record found";
                        }
                    ?>
                    <?php
                        if (isset($_GET['success'])) {
                            echo '<div class="success_msg">' . htmlspecialchars($_GET['success']) . '</div>';
                        }
                        if (isset($_GET['error'])) {
                            echo '<div class="error_msg">' . htmlspecialchars($_GET['error']) . '</div>';
                        }
                    ?>
            </tbody>
        </table>
    </div>
    </div>
</div>
</body>
</html>