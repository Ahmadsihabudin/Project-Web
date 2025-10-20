# 🎓 Sistem Ujian Online - Laravel

sistem kelompok 7

## 🚀 Quick Start

### Yang Perlu Disiapin

-   PHP 8.1+ (diusahkan banget ini mah kalo bisa di samain)
-   Composer
-   MySQL/MariaDB
-   Git

### 1. Clone & Install

```bash
git clone https://github.com/username/Project-Web.git
cd Project-Web
composer install
npm install
```

### 2. Setup Database

```bash
# Copy environment file
cp .env.example .env

# Edit .env file, sesuaikan database:
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
mysql -u root -p ujian_online < database/db/ujian_online.sql
```

### 4. Generate Key & Run

```bash
php artisan key:generate
php artisan serve
```

Buka: `http://127.0.0.1:8000`

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

### Database Error

```bash
# Cek koneksi database
php artisan tinker
DB::connection()->getPdo();
```

### Permission Error

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




---

**Happy Coding! 🚀**

_Project ini udah 95% kelar, tinggal sistem ujian aktual yang masih dikerjain. Semua fitur admin & info peserta udah bisa dipake dengan lancar! Alhamdulillah_