<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Manajemen User - Ujian Online</title>
   <meta name="csrf-token" content="{{ csrf_token() }}">

   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   <!-- Bootstrap Icons -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
   <!-- Bootstrap JS -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

   <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
   @include('layouts.alert-system')

   <link rel="icon" type="image/png" href="{{ asset('images/Favicon_akti.png') }}">

   <style>
      .page-header {
         background: #f8f9fa;
         color: #333;
         border-radius: 10px;
         padding: 1.5rem;
         margin-bottom: 2rem;
      }

      .stats-card {
         background: #f8f9fa;
         color: #333;
         border-radius: 10px;
         padding: 1.5rem;
         box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
         margin-bottom: 1.5rem;
         border: none;
      }

      .stats-card .text-muted {
         color: #6c757d !important;
      }

      .action-buttons {
         display: flex;
         gap: 0.25rem;
         flex-wrap: nowrap;
         justify-content: center;
      }

      .action-buttons .btn {
         padding: 0.25rem 0.5rem;
         font-size: 0.75rem;
         border-radius: 0.25rem;
         min-width: 32px;
         height: 32px;
         display: flex;
         align-items: center;
         justify-content: center;
      }

      .table {
         margin-bottom: 0;
      }

      .table th {
         background-color: #f8f9fa;
         border-bottom: 2px solid #dee2e6;
         font-weight: 600;
         color: #495057;
         padding: 1rem 0.75rem;
         font-size: 0.875rem;
         text-transform: uppercase;
         letter-spacing: 0.5px;
      }

      .table td {
         vertical-align: middle;
         padding: 0.875rem 0.75rem;
         border-top: 1px solid #dee2e6;
      }

      .table tbody tr:hover {
         background-color: #f8f9fa;
      }

      .card {
         border: none;
         box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
         border-radius: 0.5rem;
      }

      .card-header {
         background-color: #f8f9fa;
         border-bottom: 1px solid #dee2e6;
         border-radius: 0.5rem 0.5rem 0 0 !important;
         padding: 1rem 1.25rem;
      }

      .card-header h6 {
         font-size: 1.1rem;
         font-weight: 600;
         color: #495057;
         margin: 0;
      }

      .btn-sm {
         padding: 0.375rem 0.75rem;
         font-size: 0.875rem;
         border-radius: 0.375rem;
      }

      .badge {
         font-size: 0.75rem;
         padding: 0.375rem 0.75rem;
         border-radius: 0.375rem;
      }

      /* Responsive table */
      @media (max-width: 768px) {
         .table-responsive {
            border: none;
         }

         .table th,
         .table td {
            padding: 0.5rem 0.25rem;
            font-size: 0.8rem;
         }

         .action-buttons {
            gap: 0.125rem;
         }

         .action-buttons .btn {
            padding: 0.125rem 0.25rem;
            font-size: 0.7rem;
            min-width: 28px;
            height: 28px;
         }
      }

      @media (max-width: 576px) {

         .table th,
         .table td {
            padding: 0.375rem 0.125rem;
            font-size: 0.75rem;
         }

         .action-buttons .btn {
            padding: 0.1rem 0.2rem;
            font-size: 0.65rem;
            min-width: 24px;
            height: 24px;
         }
      }

      /* Disable Bootstrap Button Styles */
      .btn-primary {
         background-color: transparent !important;
         border-color: transparent !important;
         color: inherit !important;
      }

      .btn-primary:hover {
         background-color: transparent !important;
         border-color: transparent !important;
         color: inherit !important;
      }

      /* Theme Button Style */
      .theme-btn {
         padding: 0.5rem 1rem;
         /* Padding lebih kecil */
         border: 2px solid #74292a;
         /* Border maroon 2px */
         color: #292929;
         /* Warna teks hitam (--heading-color) */
         text-transform: capitalize;
         /* Huruf kapital */
         font-weight: 400;
         /* Font weight normal */
         border-radius: 0.375rem;
         /* Border radius normal */
         transition: 0.4s cubic-bezier(0, 0, 1, 1);
         /* Transisi smooth */
         position: relative;
         /* Untuk pseudo-element */
         z-index: 1;
         /* Layer di atas */
         background: white;
         /* Background putih */
         font-size: 0.875rem;
         /* Font size lebih kecil */
      }

      .theme-btn i {
         margin-left: 7px;
         /* Jarak 7px dari teks */
      }

      .theme-btn:hover {
         color: #fff;
         /* Warna teks putih saat hover */
         border-color: white;
         /* Border putih saat hover */
      }

      .theme-btn::before {
         position: absolute;
         /* Posisi absolut */
         z-index: -1;
         /* Di belakang teks */
         content: "";
         /* Elemen kosong */
         background-color: #74292a;
         /* Background maroon */
         height: 0%;
         /* Tinggi 0% (tidak terlihat) */
         width: 0%;
         /* Lebar 0% (tidak terlihat) */
         top: 50%;
         /* Posisi tengah vertikal */
         left: 50%;
         /* Posisi tengah horizontal */
         transform: translate(-50%, -50%);
         /* Posisi tepat di tengah */
         opacity: 0;
         /* Tidak terlihat */
         transition: 0.4s cubic-bezier(0, 0, 1, 1);
         /* Transisi smooth */
         border-radius: 0.375rem;
         /* Border radius sama dengan button */
      }

      .theme-btn:hover::before {
         opacity: 1;
         /* Terlihat */
         width: 98%;
         /* Lebar hampir penuh */
         height: 96%;
         /* Tinggi hampir penuh */
      }

      .theme-btn {
         text-decoration: none !important;
      }

      .theme-btn:hover {
         text-decoration: none !important;
      }
   </style>
</head>

<body>
   <div class="container-fluid">
      <!-- Sidebar -->
      @include('layouts.sidebar')

      <!-- Main Content -->
      <div class="main-content">
         <!-- Navbar -->
         @include('layouts.navbar')

         <!-- Content -->
         <div class="p-4">
            <!-- Page Header -->


            <!-- Statistics Cards -->
            <div class="row mb-4" id="statsCards">
               <!-- Stats will be loaded here -->
            </div>

            <!-- Users Table -->
            <div class="card">
               <div class="card-header d-flex justify-content-between align-items-center">
                  <h6 class="m-0 font-weight-bold">Daftar User</h6>
                  <a href="{{ route('admin.users.create') }}" class="theme-btn">
                     <i class="bi bi-person-plus me-1"></i>
                     Tambah User
                  </a>
               </div>
               <div class="card-body">
                  <div class="table-responsive">
                     <table class="table table-striped" id="usersTable">
                        <thead>
                           <tr>
                              <th>No</th>
                              <th>Nama</th>
                              <th>Email</th>
                              <th>Role</th>
                              <th>Login Terakhir</th>
                              <th>Aksi</th>
                           </tr>
                        </thead>
                        <tbody>
                           <!-- Data will be loaded here -->
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <script>
      // csrfToken is already declared in logout-script.blade.php

      // Load statistics
      async function loadStats() {
         try {
            const response = await fetch('/admin/users/stats', {
               method: 'GET',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
               }
            });

            if (response.ok) {
               const result = await response.json();
               if (result.success) {
                  displayStats(result.data);
               } else {
                  // Fallback data jika API gagal
                  displayStats({
                     total: 0,
                     staff: 0,
                     admin: 0
                  });
               }
            } else {
               // Fallback data jika response tidak ok
               displayStats({
                  total: 0,
                  staff: 0,
                  admin: 0
               });
            }
         } catch (error) {
            console.error('Error loading stats:', error);
            // Fallback data jika terjadi error
            displayStats({
               total: 0,
               staff: 0,
               admin: 0
            });
         }
      }

      // Display statistics
      function displayStats(stats) {
         const statsHtml = `
            <div class="col-md-4">
               <div class="stats-card">
                  <div class="d-flex align-items-center">
                     <div class="flex-shrink-0">
                        <i class="bi bi-people-fill" style="font-size: 2rem; color: #007bff;"></i>
                     </div>
                     <div class="flex-grow-1 ms-3">
                        <h5 class="mb-0">${stats.total || 0}</h5>
                        <p class="text-muted mb-0">Total User</p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-4">
               <div class="stats-card">
                  <div class="d-flex align-items-center">
                     <div class="flex-shrink-0">
                        <i class="bi bi-person-badge-fill" style="font-size: 2rem; color: #6c757d;"></i>
                     </div>
                     <div class="flex-grow-1 ms-3">
                        <h5 class="mb-0">${stats.staff || 0}</h5>
                        <p class="text-muted mb-0">Jumlah Staff</p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-4">
               <div class="stats-card">
                  <div class="d-flex align-items-center">
                     <div class="flex-shrink-0">
                        <i class="bi bi-shield-fill" style="font-size: 2rem; color: #dc3545;"></i>
                     </div>
                     <div class="flex-grow-1 ms-3">
                        <h5 class="mb-0">${stats.admin || 0}</h5>
                        <p class="text-muted mb-0">Jumlah Admin</p>
                     </div>
                  </div>
               </div>
            </div>
         `;

         document.getElementById('statsCards').innerHTML = statsHtml;
      }

      // Load users data
      async function loadUsers() {
         try {
            console.log('Loading users...');


            const response = await fetch('/admin/users/data', {
               method: 'GET',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
               },
               credentials: 'same-origin'
            });

            console.log('Users response status:', response.status);
            if (response.ok) {
               const result = await response.json();
               console.log('Users API result:', result);
               if (result.success) {
                  console.log('Users loaded:', result.data.length);
                  displayUsers(result.data);
               } else {
                  console.error('Users API returned success: false', result);
                  displayUsers([]);
               }
            } else {
               console.error('Users response not ok:', response.status);
               displayUsers([]);
            }
         } catch (error) {
            console.error('Error loading users:', error);
            displayUsers([]);
         }
      }

      // Display users
      function displayUsers(users) {
         console.log('Displaying users:', users.length);
         const tbody = document.querySelector('#usersTable tbody');
         tbody.innerHTML = '';

         // Hitung statistik berdasarkan data users
         const stats = {
            total: users.length,
            staff: users.filter(user => user.role === 'staff').length,
            admin: users.filter(user => user.role === 'admin').length
         };

         // Update statistik
         displayStats(stats);

         users.forEach((user, index) => {
            console.log('Creating row for user:', user.name);
            const row = document.createElement('tr');
            row.innerHTML = `
               <td>${index + 1}</td>
               <td>${user.name}</td>
               <td>${user.email}</td>
               <td><span class="badge ${getRoleBadgeClass(user.role)}">${getRoleText(user.role)}</span></td>
               <td>${user.last_login_at ? formatDateTime(user.last_login_at) : 'Belum pernah'}</td>
               <td>
                  <div class="action-buttons">
                     <a href="/admin/users/${user.id}/edit" class="btn btn-warning btn-sm" title="Edit">
                        <i class="bi bi-pencil"></i>
                     </a>
                     <button class="btn btn-secondary btn-sm" onclick="resetPassword(${user.id})" title="Reset Password">
                        <i class="bi bi-key"></i>
                     </button>
                     <button class="btn btn-danger btn-sm" onclick="deleteUser(${user.id})" title="Hapus">
                        <i class="bi bi-trash"></i>
                     </button>
                  </div>
               </td>
            `;
            tbody.appendChild(row);
         });
      }

      // Get role text
      function getRoleText(role) {
         const roleMap = {
            'admin': 'Administrator',
            'staff': 'Staff',
            'supervisor': 'Supervisor'
         };
         return roleMap[role] || role;
      }

      // Get role badge class
      function getRoleBadgeClass(role) {
         const classMap = {
            'admin': 'bg-danger',
            'staff': 'bg-primary',
            'supervisor': 'bg-warning'
         };
         return classMap[role] || 'bg-secondary';
      }

      // Format datetime
      function formatDateTime(dateTimeString) {
         if (!dateTimeString) return '-';
         const date = new Date(dateTimeString);
         return date.toLocaleDateString('id-ID') + ' ' + date.toLocaleTimeString('id-ID', {
            hour: '2-digit',
            minute: '2-digit'
         });
      }

      // Reset password
      async function resetPassword(id) {
         const confirmed = await Swal.fire({
            title: 'Reset Password?',
            text: 'Password akan direset dan tidak dapat dibatalkan.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, reset',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            reverseButtons: true
         }).then(r => r.isConfirmed);
         if (!confirmed) return;
         try {
            const response = await fetch(`/admin/users/${id}/reset-password`, {
               method: 'POST',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
               }
            });
            const result = await response.json();
            if (result.success) {
               let html = 'Password berhasil direset';
               if (result.new_password) {
                  html = `<div>Password baru:</div><div class="mt-2"><code>${result.new_password}</code></div>`;
               }
               Swal.fire({ title: 'Berhasil', html: html, icon: 'success', confirmButtonText: 'OK', confirmButtonColor: '#0d6efd' });
            } else {
               Swal.fire({ title: 'Gagal mereset', text: result.message || 'Terjadi kesalahan.', icon: 'error', confirmButtonText: 'Tutup' });
            }
         } catch (_) {
            Swal.fire({ title: 'Gagal mereset', text: 'Terjadi kesalahan jaringan.', icon: 'error', confirmButtonText: 'Tutup' });
         }
      }

      // Delete user
      async function deleteUser(id) {
         const confirmed = await Swal.fire({
            title: 'Hapus User?',
            text: 'Data yang dihapus tidak dapat dikembalikan.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            reverseButtons: true
         }).then(r => r.isConfirmed);
         if (!confirmed) return;
         try {
            const response = await fetch(`/admin/users/${id}`, {
               method: 'DELETE',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
               }
            });
            const result = await response.json();
            if (result.success) {
               await Swal.fire({ title: 'Berhasil', text: 'User telah dihapus.', icon: 'success', confirmButtonText: 'OK', confirmButtonColor: '#0d6efd' });
               loadUsers();
            } else {
               Swal.fire({ title: 'Gagal menghapus', text: result.message || 'Terjadi kesalahan.', icon: 'error', confirmButtonText: 'Tutup' });
            }
         } catch (_) {
            Swal.fire({ title: 'Gagal menghapus', text: 'Terjadi kesalahan jaringan.', icon: 'error', confirmButtonText: 'Tutup' });
         }
      }

      // Initialize on page load
      document.addEventListener('DOMContentLoaded', function() {
         console.log('DOM Content Loaded');
         loadUsers(); // loadUsers sudah menghitung statistik dari data tabel
      });
   </script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

   @include('layouts.logout-script')

</body>

</html>