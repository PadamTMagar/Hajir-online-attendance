<div class="header">
        <header>        
        <nav class="navbar">
            <ul>  
                <div class="navlist">
                     <span id="hovertext">User</span> 
                    <li><a href="user.php"><i class="fa-duotone fa-solid fa-users"></i></a></li> 
                </div>

                <div class="navlist">
                    <span id="hovertext">Calendar</span>
                    <li id="calanderpopup"><a href="#"><i class="fa-regular fa-calendar-days"></i></a></li>
                </div>

                <div class="navlist">
                    <span id="hovertext">Report</span>
                    <li><a href="report.php"><i class="fa-regular fa-clipboard"></i></a></li>
                </div>

                <div class="navlist">
                    <span id="hovertext">Notice</span>
                    <li><a href="#" id="notice" onclick="display()"><i class="fa-solid fa-bell fa-shake"></i></a></li>
                </div>
                
                <div id="date"></div>
                <div class="login" onclick="toggle('drop_menu')"><button class="drop_button">Logout</button></div>
            </ul>
        </nav>
                <div class="drop_content" id="drop_menu">
                    <div class="profile_selection">
                        <img src="assets/profilepic.jpg" alt="ProfilePic" class="profile_pic" >
                        <div class="user_name">Padam Thapa Magar</div>
                    </div>
                    <a href="#">Profile</a>
                    <a href="logout.php">Logout</a>
                </div>
    
    </div>



                    
    

    <script>
        const today = new Date();
        const day = today.getDate();
        const month = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"][today.getMonth()];
        const year = today.getFullYear();

        document.getElementById('date').textContent = `${day}, ${month}, ${year}`;
     </script>


     <script>
        function toggle(drop_menu){
            const drop = document.getElementById("drop_menu");
            
            if (drop.style.display  === "block"){
                drop.style.display  = "none";
            }
            else{
                drop.style.display = "block";
            }
        }

        window.addEventListener("click" , function(event){
            const drop = document.getElementById("drop_menu");
            const button = document.querySelector(".drop_button");

            if(!button.contains(event.target) && !drop.contains(event.target))  {
                drop.style.display = "none";
            }
        });
     </script>

     <script>
        document.getElementById("calanderpopup" ).addEventListener("click",function(){
            window.open("calendar.php")
        });
     </script>