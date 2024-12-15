<?php ?>

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
    </div>
</div>



<script>
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