<?php
require_once 'aetsconn.php';

$user_name = '';

if (isset($_SESSION['user'])) {
    $user_name = $_SESSION['user'];
}

$sql = "SELECT u.user_role FROM user_db u WHERE u.user = '$user_name'";

$result = $conn->query($sql);

if ($result && $row = $result->fetch_assoc()) {
    $role_name = $row['user_role'];
} else {
    $role_name = 'Unknown';
}
?>


<?php
// Assuming you have a connection to the database
require_once 'aetsconn.php';

// Initialize values
$total_students = 0;
$total_teachers = 0;
$total_present = 0;
$total_absent = 0;
$total_classes = 0;

// Fetch total students
$result = $conn->query("SELECT COUNT(*) AS total_students FROM userlist ul INNER JOIN user_db u ON ul.user_id = u.id WHERE u.user_role = 'Student'");
if ($result) {
    $row = $result->fetch_assoc();
    $total_students = $row['total_students'];
}

// Fetch total teachers
$result = $conn->query("SELECT COUNT(*) AS total_teachers FROM userlist ul INNER JOIN user_db u ON ul.user_id = u.id WHERE u.user_role = 'Teacher'");
if ($result) {
    $row = $result->fetch_assoc();
    $total_teachers = $row['total_teachers'];
}

// Fetch total present today
$result = $conn->query("SELECT COUNT(*) AS total_present FROM attendance a INNER JOIN userlist ul ON a.user_id = ul.user_id WHERE a.attendance_date = CURDATE() AND a.status = 'Present'");
if ($result) {
    $row = $result->fetch_assoc();
    $total_present = $row['total_present'];
}

// Fetch total absent today
$result = $conn->query("SELECT COUNT(*) AS total_absent FROM attendance a INNER JOIN userlist ul ON a.user_id = ul.user_id WHERE a.attendance_date = CURDATE() AND a.status = 'Absent'");
if ($result) {
    $row = $result->fetch_assoc();
    $total_absent = $row['total_absent'];
}

// Fetch total classes
$result = $conn->query("SELECT COUNT(*) AS total_classes FROM classroom");
if ($result) {
    $row = $result->fetch_assoc();
    $total_classes = $row['total_classes'];
}
?>



<?php
// Get the current year and month
$currentYear = date('Y');
$currentMonth = date('m');

// Generate an array of all dates in the current month
$startDate = new DateTime("{$currentYear}-{$currentMonth}-01");
$endDate = new DateTime("{$currentYear}-{$currentMonth}-01");
$endDate = $endDate->modify('last day of this month');

// Create an array to hold all dates of the current month
$line_dates = [];
for ($date = $startDate; $date <= $endDate; $date->modify('+1 day')) {
    $line_dates[] = $date->format('Y-m-d'); // Store the date in YYYY-MM-DD format
}

// SQL query to fetch attendance data for the current month
$sql = "
    SELECT DATE(attendance_date) as date, COUNT(*) as total_present 
    FROM attendance 
    WHERE MONTH(attendance_date) = $currentMonth AND YEAR(attendance_date) = $currentYear 
    AND status = 'Present'
    GROUP BY DATE(attendance_date)
    ORDER BY DATE(attendance_date)";

// Execute the query
$result = $conn->query($sql);

// Initialize an array for the attendance count, set all to zero initially
$line_total_present = array_fill(0, count($line_dates), 0);

// Fetch the results and update the attendance count for each day
while ($row = $result->fetch_assoc()) {
    $attendanceDate = $row['date'];
    $presentCount = $row['total_present'];

    // Find the index of the date and update the present count
    $index = array_search($attendanceDate, $line_dates);
    if ($index !== false) {
        $line_total_present[$index] = $presentCount;
    }
}
?>






<html>
    <head> 
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.0.0/chart.js" integrity="sha512-heziW2w3+/erezjMdHOyvg67lCz19RzOQRy118vTH9+DU6GS56G2FdQJDrGlXuCKGpH+yPdWZajxK+IoqvjYjA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script> -->
</head>
    <div class="dashcontent">
    <div class="greeting">
                    <span>Hi, <?php echo $user_name; ?> 
                    -<?php echo $role_name; ?>
                    </span>

        <div class="greet">
            <div class="greetele" id="greet"></div>
            <div class="msg" id="msg"></div>
        </div>
    </div>
    <div class="dashboard">

            <div class="total student">
                <div class="icon"><i class="fa-duotone fa-solid fa-users"></i></div>
                <div class="content">
                    <div class="title">Total Student</div>
                    <div class="value"><?php echo $total_students; ?></div>
                </div>
            </div>

            <div class="total teacher">
                <div class="icon"><i class="fa-solid fa-chalkboard-user"></i></div>
                <div class="content">
                    <div class="title">Total Teacher</div>
                    <div class="value"><?php echo $total_teachers; ?></div>
                </div>
            </div>

            <div class="total present">
                <div class="icon"><i class="fa-solid fa-hand-fist"></i></div>
                <div class="content">
                    <div class="title">Present</div>
                    <div class="value"><?php echo $total_present; ?></div>
                </div>
            </div>

            <div class="total absent">
                <div class="icon"><i class="fa-solid fa-user-slash"></i></div>
                <div class="content">
                    <div class="title">Absent</div>
                    <div class="value"><?php echo $total_absent; ?></div>
                </div>
            </div>

            <div class="total class">
                <div class="icon"><i class="fa-solid fa-people-roof"></i></div>
                <div class="content">
                    <div class="title">Classes</div>
                    <div class="value"><?php echo $total_classes; ?></div>
                </div>
            </div>
    </div>
</div>


<div class="analysis">
    <div class="pie">
        <div class="attendance">
            
            <div class="atten_header"> 
            <div class="atten_icon"><i class="fa-regular fa-calendar-check"></i></div>
                <span>Attendance</span>
            </div>

            <div class="chart" id="chart" >
            <canvas id="atten_chart" style="width:100px; height:100px;"></canvas>
            
            <div class="details">
                <ul>
                    <li class="hidden">Total Present <span class="present" id="totalpresent"><?php echo $total_present; ?></span></li>
                    <li class="hidden">Total Absent <span class="absent" id="totalabsent"><?php echo $total_absent; ?></span></li>
                </ul>
            </div>
        </div>
    </div>


    </div>

    <div class="linegraph">
        <div class="monthly_report">

            <div class="monthly_header">
            <div class="monthly_icon"><i class="fa-regular fa-calendar-days"></i></div>
                <span>Monthly Attendance</span>
            </div>

            <div class="line_value">
                <canvas id="linegraph" style="width:100%; height:220px"></canvas>
            </div>
        </div>
    </div>
</div>



<script>

    // greeting java stript
    function greeting() {
        const hour = new Date().getHours();
        const greetele = document.getElementById("greet");
        const msgele = document.getElementById("msg");

        if(hour>=5 && hour <12){
            greetele.innerText = "Good Morning";
            msgele.innerText = "Have a great day!";
        }

        else if(hour>=12 && hour <17){
            greetele.innerText = "Good Afternoon";
            msgele.innerText = "Keep going strong!";
        }

        else if(hour>=17 && hour <20){
            greetele.innerText = "Good Evening";
            msgele.innerText = "Have a relaxing evening!";
        }

        else{
            greetele.innerText = "Good Night";
            msgele.innerText = "Sweet dreams!";
        }

      }
      greeting();
  
</script>


<!-- doughnut chart script -->
<script>
    
    var totalpresents  = parseInt(document.getElementById("totalpresent").innerText);
    var totalabsents = parseInt(document.getElementById("totalabsent").innerText);

    var xvalue = ["Present" , "Absent"];
    var yvalue = [totalpresents , totalabsents];
    var colors = ["#00aba9", "#b91d47"];


    new Chart(document.getElementById("atten_chart"),{
        type: "doughnut",
        data:{
            labels : xvalue,
            datasets: [{
                backgroundColor: colors,
                data: yvalue
            }]
        },
        options: {
                plugins: {
                    legend: {
                        display: true 
                    },
                    title: {
                        display: false 
                    }
                }
            }
    });
</script>



<!-- line graph script -->
<script>
    // Pass the PHP arrays to JavaScript
    const line_dates = <?php echo json_encode($line_dates); ?>;
    const line_total_present = <?php echo json_encode($line_total_present); ?>;

    // Render the Line Chart with the fetched data
    function renderLineChart() {
        new Chart(document.getElementById("linegraph").getContext('2d'), {
            type: "line",
            data: {
                labels: line_dates, // Use the fetched dates as labels
                datasets: [{
                    label: 'Present Attendance', // Line label
                    data: line_total_present, // Use the fetched attendance data as data points
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 2,
                    fill: true,
                }]
            },
            options: {
                scales: {
                    x: {
                        grid: { display: false },
                        title: { display: true, text: 'Date' }
                    },
                    y: {
                        grid: { display: true },
                        ticks: { display: true },
                        title: { display: true, text: 'Attendance Count' }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                    },
                    title: {
                        display: true,
                        text: 'Monthly Attendance'
                    }
                }
            }
        });
    }

    // Call the function to render the chart
    renderLineChart();
</script>

</html>

