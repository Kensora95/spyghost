#!/data/data/com.termux/files/usr/bin/bash
clear
echo "───── 『 👻 SPY GHOST INSTALLER 』 ─────"
echo "        🔥 Coded by Boss Kensora"
echo "────────────────────────────────────────"

# Update & Upgrade
echo "[*] Updating system..."
pkg update && pkg upgrade -y

# Install PHP & Git
echo "[*] Installing PHP and Git..."
pkg install php git curl -y

# Install Cloudflared (Manual Binary for Android/ARM)
echo "[*] Installing Cloudflared..."
if [ ! -f "$PREFIX/bin/cloudflared" ]; then
    # Download binary sesuai arsitektur Android (ARM64)
    curl -L https://github.com/cloudflare/cloudflared/releases/latest/download/cloudflared-linux-arm64 -o $PREFIX/bin/cloudflared
    chmod +x $PREFIX/bin/cloudflared
    echo "[+] Cloudflared Installed!"
else
    echo "[+] Cloudflared already exists."
fi

echo "────────────────────────────────────────"
echo "✅ INSTALL SUCCESS, BOSS!"
echo "────────────────────────────────────────"
echo "1. Jalankan Server: php -S 127.0.0.1:8080"
echo "2. Jalankan Tunnel: cloudflared tunnel --url 127.0.0.1:8080"
echo "────────────────────────────────────────"
