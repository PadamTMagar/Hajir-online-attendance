<?php
require_once('aetsconn.php');

if (!isset($_GET['user_id']) || empty($_GET['user_id'])) {
    die("Invalid user ID.");
}

$user_id = intval($_GET['user_id']);

// check if user exists in userlist
$query = "SELECT id, firstname, lastname, profile_pic, face_encoding FROM userlist WHERE id = $user_id";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    die("User not found.");
}

$user = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Face Capture</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f7fb;
            margin: 0;
            padding: 0;
        }

        .capture-container {
            max-width: 800px;
            margin: 40px auto;
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            text-align: center;
        }

        .capture-container h2 {
            margin-bottom: 10px;
        }

        .capture-container p {
            color: #555;
            margin-bottom: 20px;
        }

        .video-wrapper {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        video, canvas {
            width: 100%;
            max-width: 500px;
            border-radius: 10px;
            border: 2px solid #ddd;
            background: #000;
        }

        .btn-group {
            margin-top: 20px;
        }

        button {
            padding: 12px 22px;
            margin: 8px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 15px;
        }

        .start-btn {
            background: #007bff;
            color: #fff;
        }

        .capture-btn {
            background: #28a745;
            color: #fff;
        }

        .retry-btn {
            background: #ffc107;
            color: #000;
        }

        .hidden {
            display: none;
        }

        .status {
            margin-top: 18px;
            font-weight: bold;
        }

        .preview-box {
            margin-top: 20px;
        }

        .preview-box img {
            max-width: 300px;
            border-radius: 10px;
            border: 2px solid #ddd;
        }
    </style>
</head>
<body>

<div class="capture-container">
    <h2>Face Registration</h2>
    <p>
        User: <strong><?php echo htmlspecialchars($user['firstname'] . ' ' . $user['lastname']); ?></strong><br>
        Please allow camera access and capture a clear front-facing image.
    </p>

    <div class="video-wrapper">
        <video id="video" autoplay playsinline></video>
    </div>

    <canvas id="canvas" class="hidden"></canvas>

    <div class="btn-group">
        <button type="button" class="start-btn" id="startCameraBtn">Start Camera</button>
        <button type="button" class="capture-btn hidden" id="captureBtn">Capture Photo</button>
        <button type="button" class="retry-btn hidden" id="retryBtn">Retry</button>
    </div>

    <div class="preview-box hidden" id="previewBox">
        <h3>Captured Preview</h3>
        <img id="previewImage" src="" alt="Captured Image">
    </div>

    <div class="status" id="statusMsg"></div>
</div>

<script>
    const video = document.getElementById("video");
    const canvas = document.getElementById("canvas");
    const startCameraBtn = document.getElementById("startCameraBtn");
    const captureBtn = document.getElementById("captureBtn");
    const retryBtn = document.getElementById("retryBtn");
    const statusMsg = document.getElementById("statusMsg");
    const previewBox = document.getElementById("previewBox");
    const previewImage = document.getElementById("previewImage");

    let stream = null;
    const userId = <?php echo $user_id; ?>;

    async function startCamera() {
        try {
            stream = await navigator.mediaDevices.getUserMedia({
                video: {
                    facingMode: "user"
                },
                audio: false
            });

            video.srcObject = stream;
            statusMsg.innerText = "Camera started. Position your face clearly and click Capture Photo.";
            captureBtn.classList.remove("hidden");
            startCameraBtn.classList.add("hidden");
        } catch (error) {
            console.error(error);
            statusMsg.innerText = "Unable to access camera. Please allow camera permission.";
        }
    }

    function stopCamera() {
        if (stream) {
            stream.getTracks().forEach(track => track.stop());
        }
    }

    async function capturePhoto() {
        const context = canvas.getContext("2d");

        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;

        context.drawImage(video, 0, 0, canvas.width, canvas.height);

        const imageData = canvas.toDataURL("image/jpeg", 0.9);

        previewImage.src = imageData;
        previewBox.classList.remove("hidden");
        retryBtn.classList.remove("hidden");

        statusMsg.innerText = "Uploading image and generating face encoding...";

        stopCamera();
        video.srcObject = null;
        captureBtn.classList.add("hidden");

        try {
            const response = await fetch("save_face.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    user_id: userId,
                    image: imageData
                })
            });

            const result = await response.json();

            if (result.status === "success") {
                statusMsg.innerText = result.message;
                setTimeout(() => {
                    window.location.href = "user.php";
                }, 2000);
            } else {
                statusMsg.innerText = result.message;
            }
        } catch (error) {
            console.error(error);
            statusMsg.innerText = "Error while saving face data.";
        }
    }

    function retryCapture() {
        previewBox.classList.add("hidden");
        retryBtn.classList.add("hidden");
        startCameraBtn.classList.remove("hidden");
        statusMsg.innerText = "Click Start Camera to try again.";
    }

    startCameraBtn.addEventListener("click", startCamera);
    captureBtn.addEventListener("click", capturePhoto);
    retryBtn.addEventListener("click", retryCapture);
</script>

</body>
</html>