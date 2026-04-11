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
                    <span id="hovertext">Attendance</span>
                    <li><a href="#" onclick="openFaceAttendance(); return false;">
                        <i class="fa-solid fa-camera"></i>
                    </a></li>
                </div>

                <div class="navlist">
                    <span id="hovertext">Profile</span>
                    <li><a href="userprofile.php" id="profile"><i class="fa-solid fa-id-card"></i></a></li>
                </div>
                
                <div id="date"></div>
                <div class="login" onclick="toggle('drop_menu')"><button class="drop_button">Logout</button></div>
            </ul>
        </nav>
                <div class="drop_content" id="drop_menu">
                    <div class="profile_selection">
                    </div>
                    <a href="logout.php">Logout</a>
                </div>

    <!-- ✅ Face Attendance Modal -->
    <div id="faceAttendanceModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.75); z-index:99999; justify-content:center; align-items:center;">
        <div style="background:#fff; padding:25px; border-radius:12px; max-width:500px; width:95%; text-align:center; box-shadow:0 8px 30px rgba(0,0,0,0.3);">
            
            <h3 style="margin:0 0 5px 0; color:#333;">
                <i class="fa-solid fa-camera"></i> Face Attendance
            </h3>
            <p style="color:#777; font-size:13px; margin:0 0 15px 0;">
                Look at the camera and click Scan to mark your attendance.
            </p>

            <video id="faceAttVideo" autoplay playsinline 
                   style="width:100%; border-radius:8px; border:2px solid #ddd; background:#000; max-height:300px;">
            </video>
            <canvas id="faceAttCanvas" style="display:none;"></canvas>

            <div style="margin-top:15px; display:flex; justify-content:center; gap:10px; flex-wrap:wrap;">
                <button onclick="captureFaceAtt()" id="scanBtn"
                    style="padding:10px 22px; background:#28a745; color:#fff; border:none; border-radius:6px; cursor:pointer; font-size:14px;">
                    <i class="fa-solid fa-face-smile"></i> Scan Face
                </button>
                <button onclick="closeFaceAttendance()"
                    style="padding:10px 18px; background:#dc3545; color:#fff; border:none; border-radius:6px; cursor:pointer; font-size:14px;">
                    <i class="fa-solid fa-xmark"></i> Cancel
                </button>
            </div>

            <div id="faceAttStatus" style="margin-top:15px; font-size:14px; font-weight:bold; min-height:22px;"></div>
        </div>
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
        if (drop.style.display === "block"){
            drop.style.display = "none";
        } else {
            drop.style.display = "block";
        }
    }

    window.addEventListener("click", function(event){
        const drop   = document.getElementById("drop_menu");
        const button = document.querySelector(".drop_button");
        if(!button.contains(event.target) && !drop.contains(event.target)) {
            drop.style.display = "none";
        }
    });
</script>

<script>
    document.getElementById("calanderpopup").addEventListener("click", function(){
        window.open("calendar.php")
    });
</script>

<!-- ✅ Face Attendance Script -->
<script>
let faceAttStream = null;

async function openFaceAttendance() {
    document.getElementById('faceAttendanceModal').style.display = 'flex';
    document.getElementById('faceAttStatus').innerText           = '';
    document.getElementById('scanBtn').disabled                  = false;

    try {
        faceAttStream = await navigator.mediaDevices.getUserMedia({ 
            video: { facingMode: "user" }, 
            audio: false 
        });
        document.getElementById('faceAttVideo').srcObject = faceAttStream;
        document.getElementById('faceAttStatus').style.color  = '#007bff';
        document.getElementById('faceAttStatus').innerText    = 'Camera ready. Click Scan Face.';
    } catch(e) {
        document.getElementById('faceAttStatus').style.color  = 'red';
        document.getElementById('faceAttStatus').innerText    = '❌ Camera access denied. Please allow camera permission.';
    }
}

function closeFaceAttendance() {
    if (faceAttStream) faceAttStream.getTracks().forEach(t => t.stop());
    faceAttStream = null;
    document.getElementById('faceAttendanceModal').style.display = 'none';
    document.getElementById('faceAttStatus').innerText           = '';
}

async function captureFaceAtt() {
    const video   = document.getElementById('faceAttVideo');
    const canvas  = document.getElementById('faceAttCanvas');
    const status  = document.getElementById('faceAttStatus');
    const scanBtn = document.getElementById('scanBtn');

    canvas.width  = video.videoWidth;
    canvas.height = video.videoHeight;
    canvas.getContext('2d').drawImage(video, 0, 0);

    const imageData = canvas.toDataURL('image/jpeg', 0.9);

    scanBtn.disabled      = true;
    status.style.color    = '#007bff';
    status.innerText      = '⏳ Scanning face, please wait...';

    try {
        const response = await fetch('face_mark_attendance.php', {
            method:  'POST',
            headers: { 'Content-Type': 'application/json' },
            body:    JSON.stringify({ image: imageData })
        });

        const result = await response.json();

        if (result.status === 'success') {
            status.style.color = 'green';
            status.innerText   = '✅ ' + result.message;
            setTimeout(() => closeFaceAttendance(), 2500);

        } else if (result.status === 'already_marked') {
            status.style.color = 'orange';
            status.innerText   = '⚠️ ' + result.message;
            setTimeout(() => closeFaceAttendance(), 2500);

        } else {
            status.style.color = 'red';
            status.innerText   = '❌ ' + result.message;
            scanBtn.disabled   = false;
        }

    } catch(e) {
        status.style.color = 'red';
        status.innerText   = '❌ Connection error. Please try again.';
        scanBtn.disabled   = false;
    }
}
</script>