<?php
include("aetsheader.php");
include("aetssidebar.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Role</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
</head>
<body>
    <div class="container">
        <h1>Edit Role</h1>  <br>
        <div class="rolebox">
            <label for="contact-type">Role Name:</label>
                    <select id="contact-type" name="contact_type" required>
                        <option value="">Select</option>
                        <option value="teacher">Teacher</option>
                        <option value="student">Student</option>
                    </select><br><br>
            <span class="text"> Permissons:</span>
            <div class="rolelist">


                <h2>Role</h2>
                <div class="item">
                    <div class="selectall">
                        <input type="checkbox" id="selectall" name="selectall" value="select all">
                        <label for="selectall">select all</label>
                        </div>
                    <div class="selectindivdual">
                        <input type="checkbox" id="roleview" name="roleview" value="roleview">
                        <label for="viewuser">View Role</label><br>
                        <input type="checkbox" id="addrole" name="addrole" value="addrole">
                        <label for="adduser">Add Role</label><br>
                        <input type="checkbox" id="editrole" name="editrole" value="editrole">
                        <label for="edituser">Edit Role</label><br>
                        <input type="checkbox" id="deleterole" name="deleterole" value="deleterole">
                        <label for="viewuser">Delete Role</label><br>
                    </div>
                </div>
            

                <h2>User</h2>
                <div class="item">
                    <div class="selectall">
                        <input type="checkbox" id="selectall" name="selectall" value="select all">
                        <label for="selectall">select all</label>
                        </div>
                    <div class="selectindivdual">
                        <input type="checkbox" id="viewuser" name="viewuser" value="viewuser">
                        <label for="viewuser">View User</label><br>
                        <input type="checkbox" id="adduser" name="adduser" value="adduser">
                        <label for="adduser">Add User</label><br>
                        <input type="checkbox" id="edituser" name="edituser" value="edituser">
                        <label for="edituser">Edit User</label><br>
                        <input type="checkbox" id="deleteuser" name="deleteuser" value="deleteuser">
                        <label for="viewuser">Delete User</label><br>
                    </div>
                </div>


                <h2>Teacher</h2>
                <div class="item">
                    <div class="selectall">
                        <input type="checkbox" id="selectall" name="selectall" value="select all">
                        <label for="selectall">select all</label>
                        </div>
                    <div class="selectindivdual">
                        <input type="checkbox" id="viewteacher" name="viewteacher" value="viewteacher">
                        <label for="viewuser">View Teacher</label><br>
                        <input type="checkbox" id="addteacher" name="addteacher" value="addteacher">
                        <label for="adduser">Add Teacher</label><br>
                        <input type="checkbox" id="editeacher" name="editeacher" value="editeacher">
                        <label for="edituser">Edit Teacher</label><br>
                        <input type="checkbox" id="deleteteacher" name="deleteteacher" value="deleteteacher">
                        <label for="viewuser">Delete Teacher</label><br>
                    </div>
                </div>


                <h2>Student</h2>
                <div class="item">
                    <div class="selectall">
                        <input type="checkbox" id="selectall" name="selectall" value="select all">
                        <label for="selectall">select all</label>
                        </div>
                    <div class="selectindivdual">
                        <input type="checkbox" id="viewstudent" name="viewstudent" value="viewstudent">
                        <label for="viewuser">View Student</label><br>
                        <input type="checkbox" id="addstudent" name="addstudent" value="addstudent">
                        <label for="adduser">Add Student</label><br>
                        <input type="checkbox" id="editstudent" name="editstudent" value="editstudent">
                        <label for="edituser">Edit Student</label><br>
                        <input type="checkbox" id="deletestudent" name="deletestudent" value="deletestudent">
                        <label for="viewuser">Delete Student</label><br>
                    </div>
                </div>


                <h2>Classroom</h2>
                <div class="item">
                    <div class="selectall">
                        <input type="checkbox" id="selectall" name="selectall" value="select all">
                        <label for="selectall">select all</label>
                        </div>
                    <div class="selectindivdual">
                        <input type="checkbox" id="viewclass" name="viewclass" value="viewclass">
                        <label for="viewuser">View Classroom</label><br>
                        <input type="checkbox" id="addclass" name="addclass" value="addclass">
                        <label for="adduser">Add Classroom</label><br>
                        <input type="checkbox" id="editclass" name="editclass" value="editclass">
                        <label for="edituser">Edit Classroom</label><br>
                        <input type="checkbox" id="deleteclass" name="deleteclass" value="deleteclass">
                        <label for="viewuser">Delete Classroom</label><br>
                    </div>
                </div>


                <h2>Attendance</h2>
                <div class="item">
                    <div class="selectall">
                        <input type="checkbox" id="selectall" name="selectall" value="select all">
                        <label for="selectall">select all</label>
                        </div>
                    <div class="selectindivdual">
                        <input type="checkbox" id="viewattendance" name="viewattendance" value="viewattendance">
                        <label for="viewuser">View Attendance</label><br>
                        <input type="checkbox" id="addattendance" name="addattendance" value="addattendance">
                        <label for="adduser">Add Attendance</label><br>
                        <input type="checkbox" id="editattendance" name="editattendance" value="editattendance">
                        <label for="edituser">Edit Attendance</label><br>
                        <input type="checkbox" id="deleteattendance" name="deleteattendance" value="deleteattendance">
                        <label for="viewuser">Delete Attendance</label><br>
                    </div>
                </div>


                <h2>Generate Qr</h2>
                <div class="item">
                    <div class="selectall">
                        <input type="checkbox" id="selectall" name="selectall" value="select all">
                        <label for="selectall">select all</label>
                        </div>
                    <div class="selectindivdual">
                        <input type="checkbox" id="viewqr" name="viewqr" value="viewqr">
                        <label for="viewuser">View Qr</label><br>
                        <input type="checkbox" id="generateqr" name="generateqr" value="generateqr">
                        <label for="adduser">Generate Qr</label><br>
                        <input type="checkbox" id="deleteqr" name="deleteqr" value="deleteqr">
                        <label for="viewuser">Delete Qr</label><br>
                    </div>
                </div>


                <h2>Notice</h2>
                <div class="item">
                    <div class="selectall">
                        <input type="checkbox" id="selectall" name="selectall" value="select all">
                        <label for="selectall">select all</label>
                        </div>
                    <div class="selectindivdual">
                        <input type="checkbox" id="viewnotice" name="viewnotice" value="viewnotice">
                        <label for="viewuser">View Notice</label><br>
                        <input type="checkbox" id="addnotice" name="addnotice" value="addnotice">
                        <label for="adduser">Add Notice</label><br>
                        <input type="checkbox" id="editnotice" name="editnotice" value="editnotice">
                        <label for="edituser">Edit Notice</label><br>
                        <input type="checkbox" id="deletenotice" name="deletenotice" value="deletenotive">
                        <label for="viewuser">Delete Notive</label><br>
                    </div>
                </div>


                <h2>Report</h2>
                <div class="item">   
                    <div class="selectall">
                        <input type="checkbox" id="selectall" name="selectall" value="select all">
                        <label for="selectall">select all</label>
                        </div>
                    <div class="selectindivdual">
                        <input type="checkbox" id="viewteachers" name="viewteachers" value="viewteachers">
                        <label for="viewuser">View Teachers</label><br>
                        <input type="checkbox" id="viewstudent" name="viewstudent" value="viewstudent">
                        <label for="adduser">View Students</label><br>
                        <input type="checkbox" id="classroom" name="classroom" value="classroom">
                        <label for="edituser">Classroom</label><br>
                        <input type="checkbox" id="attendance" name="attendance" value="attendance">
                        <label for="viewuser">Attendance</label><br>
                    </div>
                </div>


                <div class="item"></div>
        
            </div>
        </div>
    </div>
    
</body>
</html>