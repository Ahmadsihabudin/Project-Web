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
mysql -u root -p ujian_online < database/db/ujian_online(6).sql
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

# 4. Setup storage link
php artisan storage:link

# 5. Jalankan server (2 terminal terpisah)
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

### ✅ Yang Udah Kelar (100%)

-   **Authentication System** - Login admin & peserta dengan security ✅
-   **Admin Dashboard** - Dashboard dengan statistik real-time ✅
-   **User Management** - CRUD admin & staff dengan validasi ✅
-   **Participant Management** - CRUD peserta dengan import Excel ✅
-   **Question Bank** - CRUD soal dengan import Excel, gambar, dan sistem penilaian ✅
-   **Exam Session** - Kelola sesi ujian dengan batch ✅
-   **Exam Taking System** - Sistem ujian lengkap dengan timer ✅
-   **Results & Scoring** - Sistem penilaian otomatis dengan jenis penilaian ✅
-   **Reports System** - Laporan lengkap dengan chart per batch ✅
-   **Settings System** - Info Ujian (Dynamic), Backup Data, Logo & Tampilan ✅
-   **Anti-Cheating System** - Tab lock, camera monitoring, sound detection, fullscreen enforcement ✅
-   **Database Integration** - Semua data real dari MySQL ✅
-   **UI/UX Design** - Responsive & modern dengan sidebar dinamis ✅
-   **Security Features** - Activity logs, session management, lockout system, anti-cheating ✅

## 🎯 Fitur Lengkap Sistem

### 🔧 Admin Panel

#### Dashboard
-   Statistik real-time (total users, peserta, soal, sesi ujian)
-   Grafik data visualisasi
-   Recent exams dan activity logs

#### User Management
-   CRUD Admin & Staff
-   Role-based access control
-   Import/Export data
-   Validasi dan security features

#### Participant Management
-   CRUD Peserta ujian
-   Import Excel dengan validasi
-   Kelola batch peserta
-   Tracking status peserta

#### Question Bank
-   CRUD Soal dengan berbagai tipe (Pilihan Ganda, Benar/Salah)
-   Upload gambar untuk soal
-   Sistem penilaian (normal & pengurangan poin)
-   Durasi per soal
-   Import Excel dengan template
-   Kategori mata pelajaran

#### Exam Session Management
-   Kelola sesi ujian
-   Setting batch, tanggal, dan durasi
-   Status management (aktif/nonaktif)
-   Komposisi soal per mata pelajaran

#### Reports & Analytics
-   Laporan lengkap peserta ujian
-   Grafik rata-rata waktu pengerjaan **per batch**
-   Statistik skor dan jawaban
-   Export data
-   Tracking status submit (manual/auto_submit/cheat)

#### Settings System
-   **Info Ujian** - Dynamic content untuk peringatan ujian (editable)
-   **Backup Data** - Backup database dengan download/delete
-   **Logo & Tampilan** - Upload logo custom dan ubah nama aplikasi
-   Sidebar dinamis dengan logo dan nama aplikasi

#### Anti-Cheating System
-   **Tab/Browser Lock** - Deteksi dan prevent tab switching
-   **Camera Monitoring** - Face detection untuk multi-person detection
-   **Sound Detection** - Audio analysis untuk multiple voice detection
-   **Fullscreen Enforcement** - Force fullscreen mode
-   **Real-time Monitoring** - Live detection dan warning system
-   **Auto Submit on Violation** - Otomatis submit jika terdeteksi kecurangan

### 👨‍🎓 Student Panel

-   **Login** - Login dengan kode peserta & kode akses
-   **Information** - Info peserta dan batch
-   **Exam Info** - Komposisi soal dan peringatan dinamis
-   **Exam Taking** - Sistem ujian lengkap dengan:
    - Timer countdown
    - Auto-save jawaban
    - Auto-submit saat waktu habis
    - Navigation terbatas
    - **Anti-Cheating System**:
      - Tab/Browser lock detection
      - Camera monitoring (front camera only, face detection)
      - Sound detection (multiple voice detection)
      - Fullscreen enforcement
      - Real-time violation warnings
-   **Results** - Halaman selesai ujian (score disembunyikan untuk keamanan)

### 🔒 Sistem Anti-Cheating

Sistem ujian dilengkapi dengan fitur anti-cheating yang komprehensif untuk menjaga integritas ujian:

#### 1. **Tab/Browser Lock Detection**
   - **Deteksi Tab Switching**: Sistem mendeteksi ketika peserta beralih ke tab lain atau aplikasi lain
   - **Warning System**: Peringatan pertama kali ketika terdeteksi beralih tab
   - **Auto Submit**: Jika peserta mengulangi beralih tab, sistem akan otomatis submit ujian dengan status "cheat"
   - **Fullscreen Enforcement**: Mode fullscreen dipaksa saat ujian dimulai

#### 2. **Camera Monitoring System**
   - **Camera Access Required**: Camera wajib diaktifkan sebelum memulai ujian
   - **Front Camera Only**: Sistem memaksa penggunaan camera depan (tidak boleh camera belakang)
   - **Face Detection**: Deteksi jumlah orang dalam frame camera
   - **Multi-Person Detection**: Jika terdeteksi lebih dari 2 orang:
     - **Warning Pertama**: Peringatan bahwa terdeteksi lebih dari 2 orang
     - **Auto Submit**: Jika diulangi, sistem akan otomatis submit dengan status "cheat"
   - **Real-time Monitoring**: Camera aktif selama ujian berlangsung

#### 3. **Sound Detection System**
   - **Microphone Access**: Microphone wajib diaktifkan untuk mendeteksi suara
   - **Audio Analysis**: Analisis frekuensi suara untuk mendeteksi multiple voices
   - **Noise Detection**: Mendeteksi suara berkelanjutan atau noise yang tidak wajar
   - **Multiple Voice Detection**: Jika terdeteksi lebih dari 2 suara:
     - **Warning**: Peringatan pertama
     - **Auto Submit**: Auto submit jika diulangi dengan status "cheat"

#### 4. **Security Features**
   - **Fullscreen Lock**: Mode fullscreen dipaksa, tidak bisa keluar tanpa submit
   - **Right-Click Disabled**: Mouse right-click dinonaktifkan selama ujian
   - **Copy-Paste Disabled**: Copy-paste dinonaktifkan untuk mencegah cheating
   - **Keyboard Shortcuts Disabled**: Keyboard shortcuts (Ctrl+C, Ctrl+V, F12, dll) dinonaktifkan
   - **Activity Logging**: Semua aktivitas mencurigakan dicatat ke activity logs

#### 5. **Cheating Status Tracking**
   - **Status Submit Options**:
     - `manual` - Submit normal oleh peserta
     - `auto_submit` - Auto submit karena waktu habis
     - `cheat` - Auto submit karena terdeteksi kecurangan:
       - Tab switching berulang
       - Multiple person detection
       - Multiple voice detection
       - Violation lainnya

#### 6. **Warning System**
   - **First Warning**: Peringatan pertama untuk setiap jenis pelanggaran
   - **Second Violation**: Auto submit otomatis jika melanggar lagi
   - **Real-time Alert**: Alert muncul di layar saat pelanggaran terdeteksi
   - **Visual Indicator**: Indikator visual menunjukkan status monitoring

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

Database sudah include di `database/db/ujian_online(6).sql` dengan data sample lengkap:

### Tabel Utama
-   **users** - Admin & staff dengan session tracking
-   **peserta** - Data peserta ujian dengan security features
-   **soal** - Bank soal dengan gambar, durasi, dan sistem penilaian
-   **jawaban** - Jawaban peserta dengan status penilaian
-   **laporan** - Laporan hasil ujian dengan tracking per batch
-   **sesi_ujian** - Jadwal ujian dengan batch dan mata pelajaran
-   **batch** - Kelompok peserta
-   **ujian** - Master data ujian
-   **settings** - Pengaturan sistem (Info Ujian, Logo, App Name)
-   **activity_logs** - Log aktivitas user untuk security

### Field Penting

#### Tabel `soal`
- `gambar` - Upload gambar untuk soal
- `durasi_soal` - Durasi pengerjaan per soal (menit)
- `jenis_penilaian` - Normal atau pengurangan poin
- `poin_benar` - Poin jika benar (nullable, default pakai poin)
- `poin_salah` - Poin jika salah (default 0, bisa negatif)

#### Tabel `laporan`
- `batch_saat_ujian` - Tracking batch saat ujian
- `jumlah_salah` - Jumlah jawaban salah
- `waktu_pengerjaan` - Waktu pengerjaan dalam detik
- `status_submit` enum:
  - `manual` - Submit normal oleh peserta
  - `auto_submit` - Auto submit karena waktu habis
  - `cheat` - Auto submit karena terdeteksi kecurangan (tab switch, multiple person, multiple voice)

#### Tabel `settings`
- Dynamic content untuk Info Ujian
- Logo aplikasi dan nama aplikasi

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
# Import database: mysql -u root -p ujian_online < database/db/ujian_online(6).sql
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

_Project ini sudah 100% lengkap dengan semua fitur utama! Sistem ujian online sudah fully functional dengan fitur-fitur lengkap seperti dynamic settings, backup data, sistem penilaian, dan laporan per batch. Semua fitur admin dan student panel sudah bisa digunakan dengan lancar! Alhamdulillah_

---

## 📝 Checklist Setup

- [ ] PHP 8.2+ terinstall
- [ ] Node.js 20.19+ terinstall  
- [ ] Composer terinstall
- [ ] MySQL/MariaDB running
- [ ] Dependencies terinstall (`composer install` + `npm install`)
- [ ] Application key generated (`php artisan key:generate`)
- [ ] Storage link created (`php artisan storage:link`)
- [ ] Database diimport (`ujian_online(6).sql`)
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

# 3. Setup storage link untuk upload file
php artisan storage:link

# 4. Import database
mysql -u root -p ujian_online < database/db/ujian_online(6).sql

# 5. Jalankan server (2 terminal)
# Terminal 1:
php artisan serve --host=127.0.0.1 --port=8000

# Terminal 2:
npm run dev

# 6. Akses aplikasi
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
mysql -u root -p ujian_online < database/db/ujian_online(6).sql
```

### Port Error
```bash
# Cek port terpakai
netstat -an | findstr :8000

# Gunakan port lain
php artisan serve --port=8001
```

**Semua masalah sudah ada solusinya di README ini! 💪**