# 🎓 Sistem Ujian Online - Laravel

sistem kelompok 7

## 🚀 Quick Start

### Yang Perlu Disiapin

-   **PHP 8.2+** (WAJIB! Laravel 12 butuh PHP 8.2 minimum)
-   **Node.js 20.19+ atau 22.12+** (WAJIB untuk Vite!)
-   **Composer** (untuk dependency PHP)
-   **MySQL/MariaDB** (database)
-   **Git** (untuk clone project)

### ✅ Versi yang Sudah Ditest

| Software | Versi Minimum | Versi Rekomendasi | Status |
|----------|---------------|-------------------|---------|
| PHP | 8.2 | 8.3+ | ✅ |
| Node.js | 20.19 | 22.12+ | ✅ |
| Composer | 2.0 | Latest | ✅ |
| MySQL | 5.7 | 8.0+ | ✅ |

### 1. Clone & Install Dependencies

```bash
git clone https://github.com/username/Project-Web.git
cd Project-Web

# Install PHP dependencies (WAJIB DULU!)
composer install

# Install Node.js dependencies
npm install
```

> ⚠️ **PENTING**: Urutan instalasi HARUS benar!
> 1. `composer install` dulu (untuk vendor/autoload.php)
> 2. `npm install` setelahnya (untuk assets)
> 3. `php artisan key:generate` (untuk APP_KEY)

### 2. Setup Environment

```bash
# Generate application key (WAJIB!)
php artisan key:generate

# File .env sudah ada, tapi pastikan konfigurasi database:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ujian_online
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Import Database

```bash
# Import database dari folder database/db/
mysql -u root -p ujian_online < database/db/ujian_online(4).sql
```

### 4. Jalankan Server

> ⚠️ **PENTING**: Butuh 2 terminal terpisah!

**Terminal 1 - Laravel Server:**
```bash
php artisan serve --host=127.0.0.1 --port=8000
```

**Terminal 2 - Vite Dev Server:**
```bash
npm run dev
```

**Akses Aplikasi:**
- **URL**: `http://localhost:8000` atau `http://127.0.0.1:8000`
- **Laravel Server**: Port 8000
- **Vite Dev Server**: Port 5173 (otomatis)

> 💡 **Tips**: Jika Vite error karena Node.js versi lama, aplikasi tetap bisa diakses di port 8000, hanya assets (CSS/JS) yang tidak akan ter-reload otomatis.

### 🚀 Alternatif: Jalankan Semua Sekaligus

```bash
# Jika Node.js versi sudah benar, bisa pakai:
composer run dev
```

> ⚠️ **Catatan**: Command ini akan menjalankan Laravel server, Vite, queue worker, dan logs sekaligus. Cocok untuk development yang intensif.

## 🪟 Setup untuk Windows + Laragon

### Prerequisites
- **Laragon** sudah terinstall dan running
- **PHP 8.2+** (cek di Laragon: `php -v`)
- **Node.js 20.19+** (download dari [nodejs.org](https://nodejs.org))

### Langkah Setup
```bash
# 1. Buka terminal di folder project
cd C:\laragon\www\Project-Web

# 2. Install dependencies (urutan WAJIB!)
composer install
npm install

# 3. Generate key
php artisan key:generate

# 4. Jalankan server (2 terminal terpisah)
# Terminal 1:
php artisan serve --host=127.0.0.1 --port=8000

# Terminal 2:
npm run dev
```

### Cek Status
```bash
# Cek Laravel server
netstat -an | findstr :8000

# Cek Node.js process
tasklist | findstr node
```

### Cek Versi Software
```bash
# Cek versi PHP
php -v

# Cek versi Node.js
node -v

# Cek versi Composer
composer -v

# Cek versi MySQL
mysql --version
```

### ✅ Cek Setup Sudah Benar

```bash
# 1. Cek PHP versi (harus 8.2+)
php -v

# 2. Cek Node.js versi (harus 20.19+)
node -v

# 3. Cek dependencies sudah terinstall
ls vendor/autoload.php
ls node_modules/

# 4. Cek Laravel bisa jalan
php artisan --version

# 5. Cek server bisa start
php artisan serve --port=8000
# (Tekan Ctrl+C untuk stop)
```

## 🔐 Login Default

### Admin

-   **Email:** `admin@ujianonline.com`
-   **Password:** `admin123`

### Peserta

-   **Kode Peserta:** `RK00001`
-   **Kode Akses:** `123456`

## 📊 Progress Project

### ✅ Yang Udah Kelar (95%)

-   **Authentication System** - Login admin & peserta ✅
-   **Admin Dashboard** - Manajemen user, peserta, soal ✅
-   **Database Integration** - Semua data real dari MySQL ✅
-   **Student Information** - Info peserta & routing ✅
-   **Exam Info Warning** - Komposisi soal real ✅
-   **UI/UX Design** - Responsive & modern ✅
-   **Navigation Flow** - Routing yang bener ✅

### 🔄 Yang Masih Dikerjain (5%)

-   **Exam Taking System** - Halaman ujian aktual 🔄
-   **Results & Scoring** - Hasil ujian & nilai 🔄
-   **Timer System** - Countdown ujian 🔄

## 🎯 Fitur Yang Bisa Dipake Sekarang

### Admin Panel

-   Dashboard dengan statistik real
-   Kelola user (admin/staff)
-   Kelola peserta ujian
-   Kelola bank soal
-   Kelola sesi ujian
-   Laporan basic

### Student Panel

-   Login dengan kode akses
-   Lihat info peserta
-   Lihat komposisi ujian
-   Navigation yang smooth

## 🛠️ Development

### Update dari GitHub

```bash
git pull origin main
composer install
php artisan migrate
php artisan config:clear
```

### Reset Database

```bash
php artisan migrate:fresh --seed
```

## 📁 Struktur Database

Database udah include di `database/db/ujian_online.sql` dengan data sample:

-   **users** - Admin & staff
-   **peserta** - Data peserta ujian
-   **soal** - Bank soal
-   **sesi_ujian** - Jadwal ujian
-   **batch** - Kelompok peserta
-   **jawaban** - Jawaban peserta

## 🚨 Troubleshooting

### ❌ Error: "Failed opening required vendor/autoload.php"

**Penyebab**: Dependencies belum diinstall
**Solusi**:
```bash
composer install
```

### ❌ Error: "Vite requires Node.js version 20.19+ or 22.12+"

**Penyebab**: Node.js versi terlalu lama
**Solusi**:
1. Download Node.js terbaru dari [nodejs.org](https://nodejs.org)
2. Install versi 20.19+ atau 22.12+
3. Restart terminal
4. Jalankan `npm run dev` lagi

### ❌ Error: "crypto.hash is not a function"

**Penyebab**: Node.js versi tidak kompatibel dengan Vite
**Solusi**: 
1. Uninstall Node.js lama
2. Download Node.js 20.19+ dari [nodejs.org](https://nodejs.org)
3. Install dengan opsi "Add to PATH"
4. Restart terminal
5. Cek versi: `node -v`
6. Jalankan `npm run dev` lagi

### ❌ Error: "You are using Node.js 18.8.0. Vite requires Node.js version 20.19+"

**Penyebab**: Node.js 18.x tidak didukung Vite terbaru
**Solusi**: Upgrade ke Node.js 20.19+ atau 22.12+

### Database Error

```bash
# Cek koneksi database
php artisan tinker
DB::connection()->getPdo();
```

### Permission Error (Linux/Mac)

```bash
# Fix permission
chmod -R 755 storage bootstrap/cache
```

### Cache Error

```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

### Server Tidak Bisa Start

```bash
# Cek port 8000 sudah digunakan
netstat -an | findstr :8000

# Jika port terpakai, gunakan port lain
php artisan serve --port=8001
```

### 🔧 Fix Masalah Umum

**Masalah**: Aplikasi bisa diakses tapi CSS/JS tidak muncul
**Solusi**: 
```bash
# Jalankan Vite di terminal terpisah
npm run dev
```

**Masalah**: Error "Class not found" atau "Service provider not found"
**Solusi**:
```bash
composer install
php artisan config:clear
php artisan cache:clear
```

**Masalah**: Database connection error
**Solusi**:
```bash
# Cek file .env
# Pastikan database sudah dibuat
# Import database: mysql -u root -p ujian_online < database/db/ujian_online(4).sql
```

## 🎯 Cara Menjalankan Aplikasi

### Setelah Setup Selesai

1. **Buka 2 terminal terpisah**
2. **Terminal 1**: `php artisan serve --host=127.0.0.1 --port=8000`
3. **Terminal 2**: `npm run dev`
4. **Buka browser**: `http://localhost:8000`

### Cek Aplikasi Berjalan

- ✅ **Laravel Server**: Lihat pesan "Server running on [http://127.0.0.1:8000]"
- ✅ **Vite Server**: Lihat pesan "Local: http://localhost:5173"
- ✅ **Browser**: Halaman login muncul dengan styling yang benar

### Jika Ada Masalah

1. **Cek versi software** dengan command di atas
2. **Cek dependencies** sudah terinstall
3. **Cek database** sudah diimport
4. **Cek port** tidak bentrok
5. **Restart terminal** jika perlu




---

**Happy Coding! 🚀**

_Project ini udah 95% kelar, tinggal sistem ujian aktual yang masih dikerjain. Semua fitur admin & info peserta udah bisa dipake dengan lancar! Alhamdulillah_

---

## 📝 Checklist Setup

- [ ] PHP 8.2+ terinstall
- [ ] Node.js 20.19+ terinstall  
- [ ] Composer terinstall
- [ ] MySQL/MariaDB running
- [ ] Dependencies terinstall (`composer install` + `npm install`)
- [ ] Application key generated (`php artisan key:generate`)
- [ ] Database diimport
- [ ] Laravel server running di port 8000
- [ ] Vite server running (opsional, untuk assets)
- [ ] Browser bisa akses `http://localhost:8000`

**Jika semua checklist ✅, aplikasi siap digunakan!**

---

## 🆘 Butuh Bantuan?

Jika masih ada masalah, cek:

1. **Versi software** sesuai requirement
2. **Urutan instalasi** sudah benar
3. **Dependencies** sudah terinstall
4. **Database** sudah diimport
5. **Port** tidak bentrok
6. **Terminal** sudah restart

**Good luck! 🍀**

---

## 📋 Summary Setup yang Benar

```bash
# 1. Install dependencies (urutan WAJIB!)
composer install
npm install

# 2. Generate key
php artisan key:generate

# 3. Import database
mysql -u root -p ujian_online < database/db/ujian_online(4).sql

# 4. Jalankan server (2 terminal)
# Terminal 1:
php artisan serve --host=127.0.0.1 --port=8000

# Terminal 2:
npm run dev

# 5. Akses aplikasi
# Browser: http://localhost:8000
```

**That's it! 🎉**

---

## 🔥 Quick Fix untuk Masalah Umum

### Node.js Error
```bash
# Download Node.js 20.19+ dari nodejs.org
# Install dengan "Add to PATH"
# Restart terminal
node -v  # Cek versi
npm run dev  # Coba lagi
```

### Composer Error
```bash
composer install
php artisan key:generate
```

### Database Error
```bash
# Cek MySQL running
# Import database
mysql -u root -p ujian_online < database/db/ujian_online(4).sql
```

### Port Error
```bash
# Cek port terpakai
netstat -an | findstr :8000

# Gunakan port lain
php artisan serve --port=8001
```

**Semua masalah sudah ada solusinya di README ini! 💪**