<?php?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Role</title>
</head>
<body>
    <h1>Edit Role</h1>
    <div class="rolebox">
        <label for="contact-type">Role Name:</label>
                <select id="contact-type" name="contact_type" required>
                    <option value="">Select</option>
                    <option value="teacher">Teacher</option>
                    <option value="student">Student</option>
                </select>
        <span> Permissons:</span>
        <div class="rolelist">

            <h2>Role</h2>
            <div class="selectall">
                <input type="checkbox" id="selectall" name="selectall" value="select all">
                <label for="selectall">select all</label>
                </div>
            <div class="selectindivdual">
                <input type="checkbox" id="roleview" name="roleview" value="roleview">
                <label for="viewuser">View Role</label>
                <input type="checkbox" id="addrole" name="addrole" value="addrole">
                <label for="adduser">Add Role</label>
                <input type="checkbox" id="editrole" name="editrole" value="editrole">
                <label for="edituser">Edit Role</label>
                <input type="checkbox" id="deleterole" name="deleterole" value="deleterole">
                <label for="viewuser">Delete Role</label>
            </div>
            
                
            <h2>User</h2>
            <div class="selectall">
                <input type="checkbox" id="selectall" name="selectall" value="select all">
                <label for="selectall">select all</label>
                </div>
            <div class="selectindivdual">
                <input type="checkbox" id="viewuser" name="viewuser" value="viewuser">
                <label for="viewuser">View User</label>
                <input type="checkbox" id="adduser" name="adduser" value="adduser">
                <label for="adduser">Add User</label>
                <input type="checkbox" id="edituser" name="edituser" value="edituser">
                <label for="edituser">Edit User</label>
                <input type="checkbox" id="deleteuser" name="deleteuser" value="deleteuser">
                <label for="viewuser">Delete User</label>
            </div>


            <h2>Teacher</h2>
            <div class="selectall">
                <input type="checkbox" id="selectall" name="selectall" value="select all">
                <label for="selectall">select all</label>
                </div>
            <div class="selectindivdual">
                <input type="checkbox" id="viewteacher" name="viewteacher" value="viewteacher">
                <label for="viewuser">View Teacher</label>
                <input type="checkbox" id="addteacher" name="addteacher" value="addteacher">
                <label for="adduser">Add Teacher</label>
                <input type="checkbox" id="editeacher" name="editeacher" value="editeacher">
                <label for="edituser">Edit Teacher</label>
                <input type="checkbox" id="deleteteacher" name="deleteteacher" value="deleteteacher">
                <label for="viewuser">Delete Teacher</label>
            </div>


            <h2>Student</h2>
            <div class="selectall">
                <input type="checkbox" id="selectall" name="selectall" value="select all">
                <label for="selectall">select all</label>
                </div>
            <div class="selectindivdual">
                <input type="checkbox" id="viewstudent" name="viewstudent" value="viewstudent">
                <label for="viewuser">View Student</label>
                <input type="checkbox" id="addstudent" name="addstudent" value="addstudent">
                <label for="adduser">Add Student</label>
                <input type="checkbox" id="editstudent" name="editstudent" value="editstudent">
                <label for="edituser">Edit Student</label>
                <input type="checkbox" id="deletestudent" name="deletestudent" value="deletestudent">
                <label for="viewuser">Delete Student</label>
            </div>


            <h2>Classroom</h2>
            <div class="selectall">
                <input type="checkbox" id="selectall" name="selectall" value="select all">
                <label for="selectall">select all</label>
                </div>
            <div class="selectindivdual">
                <input type="checkbox" id="viewclass" name="viewclass" value="viewclass">
                <label for="viewuser">View Classroom</label>
                <input type="checkbox" id="addclass" name="addclass" value="addclass">
                <label for="adduser">Add Classroom</label>
                <input type="checkbox" id="editclass" name="editclass" value="editclass">
                <label for="edituser">Edit Classroom</label>
                <input type="checkbox" id="deleteclass" name="deleteclass" value="deleteclass">
                <label for="viewuser">Delete Classroom</label>
            </div>
            <h2>Attendance</h2>
            <div class="selectall">
                <input type="checkbox" id="selectall" name="selectall" value="select all">
                <label for="selectall">select all</label>
                </div>
            <div class="selectindivdual">
                <input type="checkbox" id="viewattendance" name="viewattendance" value="viewattendance">
                <label for="viewuser">View Attendance</label>
                <input type="checkbox" id="addattendance" name="addattendance" value="addattendance">
                <label for="adduser">Add Attendance</label>
                <input type="checkbox" id="editattendance" name="editattendance" value="editattendance">
                <label for="edituser">Edit Attendance</label>
                <input type="checkbox" id="deleteattendance" name="deleteattendance" value="deleteattendance">
                <label for="viewuser">Delete Attendance</label>
            </div>
            </div>


            <h2>Generate Qr</h2>
            <div class="selectall">
                <input type="checkbox" id="selectall" name="selectall" value="select all">
                <label for="selectall">select all</label>
                </div>
            <div class="selectindivdual">
                <input type="checkbox" id="viewqr" name="viewqr" value="viewqr">
                <label for="viewuser">View Qr</label>
                <input type="checkbox" id="generateqr" name="generateqr" value="generateqr">
                <label for="adduser">Generate Qr</label>
                <input type="checkbox" id="deleteqr" name="deleteqr" value="deleteqr">
                <label for="viewuser">Delete Qr</label>
            </div>
            </div>
            <h2>Attendance</h2>
            <div class="selectall">
                <input type="checkbox" id="selectall" name="selectall" value="select all">
                <label for="selectall">select all</label>
                </div>
            <div class="selectindivdual">
                <input type="checkbox" id="viewattendance" name="viewattendance" value="viewattendance">
                <label for="viewuser">View Attendance</label>
                <input type="checkbox" id="addattendance" name="addattendance" value="addattendance">
                <label for="adduser">Add Attendance</label>
                <input type="checkbox" id="editattendance" name="editattendance" value="editattendance">
                <label for="edituser">Edit Attendance</label>
                <input type="checkbox" id="deleteattendance" name="deleteattendance" value="deleteattendance">
                <label for="viewuser">Delete Attendance</label>
            </div>
            </div>
            <h2>Attendance</h2>
            <div class="selectall">
                <input type="checkbox" id="selectall" name="selectall" value="select all">
                <label for="selectall">select all</label>
                </div>
            <div class="selectindivdual">
                <input type="checkbox" id="viewattendance" name="viewattendance" value="viewattendance">
                <label for="viewuser">View Attendance</label>
                <input type="checkbox" id="addattendance" name="addattendance" value="addattendance">
                <label for="adduser">Add Attendance</label>
                <input type="checkbox" id="editattendance" name="editattendance" value="editattendance">
                <label for="edituser">Edit Attendance</label>
                <input type="checkbox" id="deleteattendance" name="deleteattendance" value="deleteattendance">
                <label for="viewuser">Delete Attendance</label>
            </div>
            </div>
            <h2>Attendance</h2>
            <div class="selectall">
                <input type="checkbox" id="selectall" name="selectall" value="select all">
                <label for="selectall">select all</label>
                </div>
            <div class="selectindivdual">
                <input type="checkbox" id="viewattendance" name="viewattendance" value="viewattendance">
                <label for="viewuser">View Attendance</label>
                <input type="checkbox" id="addattendance" name="addattendance" value="addattendance">
                <label for="adduser">Add Attendance</label>
                <input type="checkbox" id="editattendance" name="editattendance" value="editattendance">
                <label for="edituser">Edit Attendance</label>
                <input type="checkbox" id="deleteattendance" name="deleteattendance" value="deleteattendance">
                <label for="viewuser">Delete Attendance</label>
            </div>
        </div>
    </div>
</body>
</html>