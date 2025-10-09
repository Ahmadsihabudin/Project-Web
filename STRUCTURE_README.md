# 📁 Struktur File Views yang Terorganisir

## 🎯 **Tujuan Restrukturisasi**

-   Memisahkan layout admin dan candidate
-   Membuat partials untuk komponen yang dapat digunakan ulang
-   Mengorganisir file berdasarkan fungsi dan role
-   Memudahkan maintenance dan pengembangan

## 📂 **Struktur Baru**

### **Layouts**

```
resources/views/layouts/
├── admin-layout.blade.php          # Layout utama untuk admin
├── candidate-layout.blade.php      # Layout untuk peserta
├── exam-layout.blade.php           # Layout khusus ujian
├── app.blade.php                   # Layout lama (untuk kompatibilitas)
└── partials/                       # Komponen partial
    ├── admin-sidebar.blade.php     # Sidebar admin
    ├── admin-navbar.blade.php      # Navbar admin
    ├── candidate-navbar.blade.php  # Navbar peserta
    ├── exam-sidebar.blade.php      # Sidebar navigasi soal
    └── footer.blade.php            # Footer umum
```

### **Exam Pages**

```
resources/views/exam/
├── admin/                          # Halaman admin
│   ├── dashboard.blade.php         # Dashboard admin
│   ├── exams.blade.php             # Manajemen ujian
│   ├── questions.blade.php         # Bank soal
│   ├── participants.blade.php      # Manajemen peserta
│   ├── proctoring.blade.php        # Pengawas
│   ├── reports.blade.php           # Laporan
│   └── settings.blade.php          # Pengaturan
└── candidate/                      # Halaman peserta
    ├── dashboard.blade.php         # Dashboard peserta
    ├── exam.blade.php              # Halaman ujian
    └── profile.blade.php           # Profil peserta
```

## 🔄 **Perubahan Routes**

### **Admin Routes**

-   `/admin/dashboard` → `exam.admin.dashboard`
-   `/admin/users` → `exam.users` (Manajemen User)
-   `/admin/questions` → `exam.admin.questions`
-   `/admin/participants` → `exam.admin.participants`
-   `/admin/proctoring` → `exam.admin.proctoring`
-   `/admin/reports` → `exam.admin.reports`
-   `/admin/settings` → `exam.admin.settings`

### **Candidate Routes**

-   `/candidate/dashboard` → `exam.candidate.dashboard`
-   `/candidate/exam` → `exam.candidate.exam`
-   `/candidate/profile` → `exam.candidate.profile`

### **Legacy Routes (Redirect)**

-   `/exam` → `/admin/dashboard`
-   `/exam/candidate` → `/candidate/dashboard`
-   `/exam/exam` → `/admin/users` (Manajemen User)
-   `/exam/participants` → `/admin/participants`
-   `/exam/proctoring` → `/admin/proctoring`
-   `/exam/questions` → `/admin/questions`
-   `/exam/reports` → `/admin/reports`
-   `/exam/settings` → `/admin/settings`

## 🎨 **Layout Features**

### **Admin Layout**

-   Sidebar navigasi dengan menu admin
-   Navbar dengan dropdown user
-   Auto-save indicator
-   Responsive design

### **Candidate Layout**

-   Navbar sederhana untuk peserta
-   Focus pada konten ujian
-   User-friendly interface

### **Exam Layout**

-   Timer bar untuk countdown
-   Question navigation sidebar
-   Auto-save functionality
-   Full-screen exam experience

## 🚀 **Cara Penggunaan**

### **Menggunakan Layout Admin**

```php
@extends('layouts.admin-layout')

@section('title', 'Judul Halaman')
@section('page-title', 'Judul Navbar')

@section('content')
    <!-- Konten halaman -->
@endsection
```

### **Menggunakan Layout Candidate**

```php
@extends('layouts.candidate-layout')

@section('title', 'Judul Halaman')

@section('content')
    <!-- Konten halaman -->
@endsection
```

### **Menggunakan Layout Exam**

```php
@extends('layouts.exam-layout')

@section('title', 'Ujian Matematika')
@section('exam-title', 'Ujian Matematika Kelas 10')

@section('content')
    <!-- Konten ujian -->
@endsection
```

## 📱 **Responsive Design**

-   Mobile-first approach
-   Sidebar collapse pada mobile
-   Touch-friendly interactions
-   Optimized untuk berbagai ukuran layar

## 🔧 **Maintenance**

-   File partials mudah diupdate
-   Layout terpisah untuk setiap role
-   CSS terorganisir dengan baik
-   Routes yang jelas dan konsisten

## 📋 **Todo List**

-   [x] Membuat struktur layout yang terorganisir
-   [x] Membuat partials untuk komponen
-   [x] Memindahkan file exam ke struktur baru
-   [x] Update routes untuk struktur baru
-   [x] Menambahkan CSS untuk exam layout
-   [ ] Update controller untuk menggunakan view baru
-   [ ] Testing semua halaman
-   [ ] Dokumentasi lengkap
