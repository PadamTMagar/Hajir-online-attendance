<div class="header">
        <header>        
        <nav class="navbar">
            <ul>
                <li><a href="#"><i class="fa-duotone fa-solid fa-users"></i></a></li>
                <li><a href="#"><i class="fa-regular fa-calendar-days"></i></a></li>
                <li><a href="#"><i class="fa-regular fa-clipboard"></i></a></li>
                <li><a href="#"><i class="fa-solid fa-bell fa-shake"></i></a></li>
                <div id="date"></div>
                <div class="login">Login</div>
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