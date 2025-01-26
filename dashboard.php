<?php
$username = '';
if(isset($_SESSION['user'])){
    $username = $_SESSION['user'];
}

?>


<html>
    <head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.0.0/chart.js" integrity="sha512-heziW2w3+/erezjMdHOyvg67lCz19RzOQRy118vTH9+DU6GS56G2FdQJDrGlXuCKGpH+yPdWZajxK+IoqvjYjA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script> -->
</head>
    <div class="dashcontent">
    <div class="greeting">
        <span>Hi,  <?php echo $username;?>  </span>
        <div class="greet">
            <div class="greetele" id="greet"></div>
            <div class="msg" id="msg"></div>
        </div>
    </div>
    <div class="dashboard">

        <div class="total  student">
            <div class="icon"><i class="fa-duotone fa-solid fa-users"></i></div>
            <div class="content">
                <div class="title">Total Student</div>
                <div class="value">0</div>
            </div>
        </div>


        <div class="total  teacher">
            <div class="icon"><i class="fa-solid fa-chalkboard-user"></i></div>
            <div class="content">
                <div class="title">Total Teacher</div>
                <div class="value">0</div>
            </div>
        </div>


        <div class="total  present">
            <div class="icon"><i class="fa-solid fa-hand-fist"></i></div>
            <div class="content">
                <div class="title">Present</div>
                <div class="value">0</div>    
            </div>
        </div>


        <div class="total  absent">
            <div class="icon"><i class="fa-solid fa-user-slash"></i></div>
            <div class="content">
                <div class="title">Absent</div>
                <div class="value">0</div>
            </div>
        </div>


        <div class="total class">
            <div class="icon"><i class="fa-solid fa-people-roof"></i> </div>
            <div class="content">
                <div class="title">Classes</div>
                <div class="value">0</div>
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
                    <li>Total Present <span class="present" id="totalpresent">110</span></li>
                    <li>Total Absent <span class="absent" id="totalabsent">80</span></li>
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
    function currentMonth() {
        const now = new Date();
        const year = now.getFullYear();
        const month = now.getMonth();
        const startDate = new Date(year, month, 1);
        const lastDate = new Date(year, month + 1, 0);
        return { startDate, lastDate };
    }

    function dateRange(startDate, lastDate) {
        const dates = [];
        let currentDate = new Date(startDate);
        while (currentDate <= lastDate) {
            dates.push(currentDate.toISOString().split('T')[0]);
            currentDate.setDate(currentDate.getDate() + 1);
        }
        return dates;
    }

    function generateRandomData(length) {
        return Array.from({ length }, () => Math.floor(Math.random() * 100) + 1);
    }

    function renderLineChart() {
        const { startDate, lastDate } = currentMonth();
        const dates = dateRange(startDate, lastDate);
        const dataPoints = generateRandomData(dates.length);

        new Chart(document.getElementById("linegraph").getContext('2d'), {
            type: "line",
            data: {
                labels: dates,
                datasets: [{
                    data: dataPoints,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 2,
                    fill: true,
                }]
            },
            options: {
                scales: {
                    x: {
                        grid: { display: false }      
                    },
                    y: {
                        grid: { display: true },
                        ticks: { display: true },
                    }
                },
                plugins: {
                    legend: { 
                        display: false,        
                    }
                }
            }
        });
    }
    renderLineChart();
</script>

</html>

