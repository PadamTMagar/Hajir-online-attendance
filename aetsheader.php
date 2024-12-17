<div class="header">
        <header>        
        <nav class="navbar">
            <ul>  
                <div class="navlist">
                     <span id="hovertext">User</span> 
                    <li><a href="#"><i class="fa-duotone fa-solid fa-users"></i></a></li> 
                </div>

                <div class="navlist">
                    <span id="hovertext">Calendar</span>
                    <li><a href="#"><i class="fa-regular fa-calendar-days"></i></a></li>
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
                <div class="login">Logout</div>
            </ul>
        </nav>
    </div>









    

    <script>
        const today = new Date();
        const day = today.getDay();
        const month = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"][today.getMonth()];
        const year = today.getFullYear();

        document.getElementById('date').textContent = `${day}, ${month}, ${year}`;
     </script>