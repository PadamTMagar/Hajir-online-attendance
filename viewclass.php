<?php session_start()?>

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
            <table class="usertable">
            <thread>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Class Size</th>
                    <th>Action</th>
                </tr>
            </thread>
            <tbody>
                    <?php 
                        $sql = "SELECT * FROM classroom";
                        $result = mysqli_query($conn , $sql);
                        if(mysqli_num_rows($result) > 0 ){
                            foreach($result as $row)
                            {
                               
                                ?>
                                    <tr>
                                        <td><?php echo$row['id']; ?></td>
                                        <td><?php echo$row['classroom_name']; ?></td>
                                        <td><?php echo$row['class_size']; ?></td>
                                        <td class="action_row">
                                            <!-- <a href="viewuser.php" class="view_btn">View</a> -->
                                            <a href="editclass.php?id=<?php echo $row['id']; ?>" class="edit_btn">Edit</a>
                                            <a href="deleteclass.php?id=<?php echo $row['id']; ?>" class="delete_btn">Delete</a>

                                        </td>

                                    </tr>

                                <?php
                            }   
                        }else
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