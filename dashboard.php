<?php

// require_once('filter.php');
?>

<!-- <?php require_once('filter.php');?> -->



<div class="dashcontent">
    <div class="greeting">
        <span>Hi, User</span>
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

            <div class="chart" id="chart">
                <canvas class="atten_chart"></canvas>
        

            <div class="details">
                <ul>
                    <li>Total Present <span class="value">100</span></li>
                    <li>Total Present <span class="value">100</span></li>
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


</script>