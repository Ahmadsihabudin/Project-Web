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

   <style>
      .page-header {
         background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
         color: white;
         border-radius: 10px;
         padding: 1.5rem;
         margin-bottom: 2rem;
      }

      .stats-card {
         background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
         color: white;
         border-radius: 10px;
         padding: 1.5rem;
         box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
         margin-bottom: 1.5rem;
         border: none;
      }

      .stats-card .text-muted {
         color: rgba(255, 255, 255, 0.8) !important;
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
            <div class="page-header">
               <h2><i class="bi bi-people-fill me-2"></i> Manajemen User</h2>
               <p class="mb-0">Kelola data pengguna sistem</p>
            </div>

            <!-- Statistics Cards -->
            <div class="row mb-4" id="statsCards">
               <!-- Stats will be loaded here -->
            </div>

            <!-- Users Table -->
            <div class="card">
               <div class="card-header d-flex justify-content-between align-items-center">
                  <h6 class="m-0 font-weight-bold">Daftar User</h6>
                  <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">
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
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

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
                        <i class="bi bi-people-fill text-white" style="font-size: 2rem;"></i>
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
                        <i class="bi bi-person-badge-fill text-white" style="font-size: 2rem;"></i>
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
                        <i class="bi bi-shield-fill text-white" style="font-size: 2rem;"></i>
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
         if (confirm('Apakah Anda yakin ingin mereset password user ini?')) {
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
                  alertSystem.success('Password berhasil direset');
                  if (result.new_password) {
                     alert(`Password baru: ${result.new_password}`);
                  }
               } else {
                  alertSystem.error('Gagal mereset password', result.message);
               }
            } catch (error) {
               console.error('Error resetting password:', error);
               alertSystem.error('Gagal mereset password', 'Terjadi kesalahan jaringan');
            }
         }
      }

      // Delete user
      async function deleteUser(id) {
         if (confirm('Apakah Anda yakin ingin menghapus user ini?')) {
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
                  alertSystem.deleteSuccess('User');
                  loadUsers(); // loadUsers sudah menghitung ulang statistik
               } else {
                  alertSystem.error('Gagal menghapus user', result.message);
               }
            } catch (error) {
               console.error('Error deleting user:', error);
               alertSystem.error('Gagal menghapus user', 'Terjadi kesalahan jaringan');
            }
         }
      }

      // Initialize on page load
      document.addEventListener('DOMContentLoaded', function() {
         console.log('DOM Content Loaded');
         loadUsers(); // loadUsers sudah menghitung statistik dari data tabel
      });
   </script>

</body>

</html>