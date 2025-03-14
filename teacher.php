<?php session_start()?>
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
<?php require_once('aetsconn.php');?>   
<div class="container">
    <div class="teacher">
        <div class="teacher_header">
            <span class="teacher">Teachers</span>
            <span class="teacher_mgs">Manage Teachers</span>
        </div>
        <div class="teacher_content">
            <div class="teacher_title">
                <span>All Teachers</span>
                <!-- <div class="add">
                    <div class="add_icon"><i class="fa-solid fa-plus"></i></div>
                    <button onclick="location.href='createuser.php';">Add</button>    
                </div>  -->
            </div>

            <table class="teacher_table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                
                $sql = "SELECT u.*, ul.firstname, ul.lastname, ul.emailid, ul.phone_number, ul.temp_address
                        FROM userlist ul
                        JOIN user_db u ON ul.user_id = u.id
                        JOIN role_db r ON u.user_role = r.rolename
                        WHERE r.rolename = 'Teacher'";
                $result = mysqli_query($conn, $sql);

                if(mysqli_num_rows($result) > 0) {
                    foreach($result as $row) {
                        ?>
                        <tr>
                            <td>
                                <?php 
                                    echo $row['firstname'] . " " . 
                                        (!empty($row['midname']) ? $row['midname'] . " " : "") . 
                                        $row['lastname']; 
                                ?></td>
                            <td><?php echo $row['emailid']; ?></td>
                            <td><?php echo $row['phone_number']; ?></td>
                            <td><?php echo $row['temp_address']; ?></td>
                        </tr>
                        <?php
                    }   
                } else {
                    echo "<tr><td colspan='4'>No record found</td></tr>";
                }
            ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>