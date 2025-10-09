# 🎓 Sistem Ujian Online

Sistem ujian online berbasis Laravel dengan fitur lengkap untuk admin, staff, dan peserta ujian.

## 📋 Fitur Utama

### 👨‍💼 Admin Dashboard

-   **Manajemen User** - Kelola staff dan admin
-   **Manajemen Peserta** - Kelola data peserta ujian
-   **Bank Soal** - Kelola soal ujian
-   **Laporan** - Laporan hasil ujian
-   **Pengaturan** - Konfigurasi sistem

### 👨‍🏫 Staff Dashboard

-   **Manajemen Peserta** - Kelola data peserta
-   **Bank Soal** - Kelola soal ujian
-   **Laporan** - Lihat laporan ujian

### 👨‍🎓 Peserta Dashboard

-   **Tata Cara Ujian** - Panduan lengkap ujian
-   **Peringatan & Agreement** - Sistem consent wajib
-   **Ujian Online** - Interface ujian yang user-friendly

## 🚀 Setup Awal untuk Kolaborasi

### Prerequisites

-   PHP 8.1 atau lebih tinggi
-   Composer
-   Node.js & NPM
-   MySQL/MariaDB
-   Git

### 1. Clone Repository

```bash
git clone https://github.com/Ahmadsihabudin/Project-Web.git
cd Project-Web
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3. Setup Environment

```bash
# Copy file environment
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Konfigurasi Database

Edit file `.env` dan sesuaikan dengan database Anda:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ujian_online
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Setup Database

```bash
# Buat database
mysql -u root -p
CREATE DATABASE ujian_online;
exit

# Jalankan migrations
php artisan migrate

# Jalankan seeders untuk data sample
php artisan db:seed --class=StaffSeeder
php artisan db:seed --class=ExamSeeder
```

### 6. Build Assets

```bash
# Build frontend assets
npm run build
# atau untuk development
npm run dev
```

### 7. Jalankan Server

```bash
php artisan serve
```

Akses aplikasi di: `http://127.0.0.1:8000`

## 👥 Kolaborasi Tim

### 🔄 Mengambil Perubahan Terbaru

**Setiap kali ada perubahan dari tim, lakukan langkah berikut:**

#### 1. Pull Perubahan Terbaru

```bash
git pull origin main
```

#### 2. Update Dependencies (jika ada yang baru)

```bash
composer install
npm install
```

#### 3. Jalankan Migrations Baru

```bash
php artisan migrate
```

#### 4. Jalankan Seeders (jika ada data baru)

```bash
# Jalankan semua seeders
php artisan db:seed

# Atau jalankan seeders tertentu
php artisan db:seed --class=StaffSeeder
php artisan db:seed --class=ExamSeeder
```

#### 5. Clear Cache

```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

#### 6. Build Assets (jika ada perubahan frontend)

```bash
npm run build
```

### 🚨 Troubleshooting

#### Jika Migration Error:

```bash
# Rollback migration terakhir
php artisan migrate:rollback

# Jalankan migration lagi
php artisan migrate
```

#### Jika Seeder Error (Duplicate Data):

```bash
# Masuk ke tinker
php artisan tinker

# Hapus data lama (HATI-HATI!)
DB::table('users')->truncate();
DB::table('ujian')->truncate();
DB::table('peserta')->truncate();
exit

# Jalankan seeders lagi
php artisan db:seed
```

#### Jika Database Kosong:

```bash
# Reset database lengkap
php artisan migrate:fresh --seed
```

### 📊 Verifikasi Database

Setelah setup, verifikasi data dengan:

```bash
php artisan tinker

# Cek data
App\Models\User::count();        # Harus ada data staff/admin
App\Models\Ujian::count();       # Harus ada data ujian
App\Models\Peserta::count();     # Harus ada data peserta
App\Models\Soal::count();        # Harus ada data soal
```

## 🔐 Login Default

### Admin

-   **Email:** admin@ujian.com
-   **Password:** password

### Staff

-   **Email:** proktor@ujian.com
-   **Password:** password

### Peserta

-   **Kode Peserta:** TEST001
-   **Kode Akses:** password123

## 📁 Struktur Database

### Tabel Utama

-   `users` - Data admin dan staff
-   `peserta` - Data peserta ujian
-   `ujian` - Data ujian
-   `soal` - Bank soal
-   `jawaban` - Jawaban peserta
-   `batches` - Batch ujian

### Relasi

-   Ujian → Soal (One to Many)
-   Peserta → Jawaban (One to Many)
-   Ujian → Jawaban (One to Many)

## 🛠️ Development

### Menjalankan Development Server

```bash
# Backend
php artisan serve

# Frontend (terminal terpisah)
npm run dev
```

### Menjalankan Tests

```bash
php artisan test
```

## 📝 Changelog

### v1.0.0

-   ✅ Admin dashboard dengan manajemen user
-   ✅ Staff dashboard dengan akses terbatas
-   ✅ Peserta dashboard dengan tata cara ujian
-   ✅ Sistem agreement dan peringatan
-   ✅ Database schema lengkap
-   ✅ API endpoints untuk semua fitur
-   ✅ Design responsif dan konsisten

## 🤝 Contributing

1. Fork repository
2. Buat feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

## 📞 Support

Jika ada masalah atau pertanyaan, silakan buat issue di GitHub atau hubungi tim development.

## 📄 License

Project ini menggunakan [MIT License](https://opensource.org/licenses/MIT).

---

**Happy Coding! 🚀**
