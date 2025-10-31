<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Pengaturan Sistem - Ujian Online</title>
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
         white-space: nowrap;
      }

      .table td {
         vertical-align: middle;
         padding: 0.875rem 0.75rem;
         border-top: 1px solid #dee2e6;
         font-size: 0.9rem;
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

      .badge.bg-success {
         background-color: #198754 !important;
      }

      .badge.bg-danger {
         background-color: #dc3545 !important;
      }

      .badge.bg-secondary {
         background-color: #6c757d !important;
      }

      .badge.bg-info {
         background-color: #0dcaf0 !important;
      }

      .badge.bg-warning {
         background-color: #ffc107 !important;
         color: #000 !important;
      }

      .setting-value {
         font-family: 'Courier New', monospace;
         background: #f8f9fa;
         padding: 0.25rem 0.5rem;
         border-radius: 4px;
         font-size: 0.85rem;
         border: 1px solid #e9ecef;
      }

      .setting-key {
         font-weight: 600;
         color: #495057;
      }

      .setting-category {
         font-size: 0.8rem;
         color: #6c757d;
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

         .page-header {
            padding: 1rem;
            margin-bottom: 1rem;
         }

         .page-header h2 {
            font-size: 1.5rem;
         }

         .card-header {
            padding: 0.75rem 1rem;
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

         .page-header {
            padding: 0.75rem;
            margin-bottom: 0.75rem;
         }

         .page-header h2 {
            font-size: 1.25rem;
         }

         .page-header p {
            font-size: 0.9rem;
         }

         .card-header {
            padding: 0.5rem 0.75rem;
         }

         .card-header h6 {
            font-size: 1rem;
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
            <div class="page-header">
               <h2><i class="bi bi-gear me-2" style="color: #991B1B;"></i> Pengaturan Sistem</h2>
               <p class="mb-0">Kelola konfigurasi sistem ujian online</p>
            </div>

            <!-- Statistics Cards -->
            <div class="row mb-4" id="statsCards">
               <!-- Stats will be loaded here -->
            </div>

            <!-- Settings Table -->
            <div class="card">
               <div class="card-header d-flex justify-content-between align-items-center">
                  <h6 class="m-0 font-weight-bold">Daftar Pengaturan</h6>
                  <a href="{{ route('admin.settings.create') }}" class="theme-btn">
                     <i class="bi bi-gear me-1"></i>
                     Tambah Pengaturan
                  </a>
               </div>
               <div class="card-body">
                  <div class="table-responsive">
                     <table class="table table-striped" id="settingsTable">
                        <thead>
                           <tr>
                              <th>No</th>
                              <th>Key</th>
                              <th>Value</th>
                              <th>Kategori</th>
                              <th>Tipe</th>
                              <th>Public</th>
                              <th>Encrypted</th>
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
            const response = await fetch('/admin/settings/stats', {
               method: 'GET',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
               },
               credentials: 'same-origin'
            });

            if (response.ok) {
               const result = await response.json();
               if (result.success) {
                  displayStats(result.data);
               }
            }
         } catch (error) {
            console.error('Error loading stats:', error);
         }
      }

      // Display statistics
      function displayStats(stats) {
         const statsHtml = `
            <div class="col-md-3">
               <div class="stats-card">
                  <div class="d-flex align-items-center">
                     <div class="flex-shrink-0">
                        <i class="bi bi-gear-fill" style="font-size: 2rem; color: #6c757d;"></i>
                     </div>
                     <div class="flex-grow-1 ms-3">
                        <h5 class="mb-0">${stats.total || 0}</h5>
                        <p class="text-muted mb-0">Total Pengaturan</p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-3">
               <div class="stats-card">
                  <div class="d-flex align-items-center">
                     <div class="flex-shrink-0">
                        <i class="bi bi-check-circle-fill" style="font-size: 2rem; color: #28a745;"></i>
                     </div>
                     <div class="flex-grow-1 ms-3">
                        <h5 class="mb-0">${stats.active || 0}</h5>
                        <p class="text-muted mb-0">Aktif</p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-3">
               <div class="stats-card">
                  <div class="d-flex align-items-center">
                     <div class="flex-shrink-0">
                        <i class="bi bi-shield-lock-fill" style="font-size: 2rem; color: #dc3545;"></i>
                     </div>
                     <div class="flex-grow-1 ms-3">
                        <h5 class="mb-0">${stats.encrypted || 0}</h5>
                        <p class="text-muted mb-0">Terenskripsi</p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-3">
               <div class="stats-card">
                  <div class="d-flex align-items-center">
                     <div class="flex-shrink-0">
                        <i class="bi bi-globe" style="font-size: 2rem; color: #17a2b8;"></i>
                     </div>
                     <div class="flex-grow-1 ms-3">
                        <h5 class="mb-0">${stats.public || 0}</h5>
                        <p class="text-muted mb-0">Public</p>
                     </div>
                  </div>
               </div>
            </div>
         `;

         document.getElementById('statsCards').innerHTML = statsHtml;
      }

      // Load settings data
      async function loadSettings() {
         try {
            console.log('Loading settings...');
            const response = await fetch('/admin/settings/data', {
               method: 'GET',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
               },
               credentials: 'same-origin'
            });

            console.log('Settings response status:', response.status);
            if (response.ok) {
               const result = await response.json();
               console.log('Settings API result:', result);
               if (result.success) {
                  console.log('Settings loaded:', result.data.length);
                  displaySettings(result.data);
               } else {
                  console.error('Settings API returned success: false', result);
                  displaySettings([]);
               }
            } else {
               console.error('Settings response not ok:', response.status);
               displaySettings([]);
            }
         } catch (error) {
            console.error('Error loading settings:', error);
            displaySettings([]);
         }
      }

      // Display settings
      function displaySettings(settings) {
         console.log('Displaying settings:', settings.length);
         const tbody = document.querySelector('#settingsTable tbody');
         tbody.innerHTML = '';

         if (settings.length === 0) {
            tbody.innerHTML = `
               <tr>
                  <td colspan="8" class="text-center py-4">
                     <i class="bi bi-gear text-muted" style="font-size: 2rem;"></i>
                     <p class="text-muted mt-2 mb-0">Belum ada pengaturan</p>
                  </td>
               </tr>
            `;
            return;
         }

         settings.forEach((setting, index) => {
            console.log('Creating row for setting:', setting.key);
            const row = document.createElement('tr');
            row.innerHTML = `
               <td>${index + 1}</td>
               <td>
                  <span class="setting-key">${setting.key || '-'}</span>
               </td>
               <td>
                  <span class="setting-value">${setting.value || '-'}</span>
               </td>
               <td>
                  <span class="badge bg-info">${setting.category || 'General'}</span>
               </td>
               <td>
                  <span class="badge bg-secondary">${getTypeText(setting.type)}</span>
               </td>
               <td>
                  <span class="badge ${setting.is_public ? 'bg-success' : 'bg-danger'}">
                     ${setting.is_public ? 'Ya' : 'Tidak'}
                  </span>
               </td>
               <td>
                  <span class="badge ${setting.is_encrypted ? 'bg-warning' : 'bg-secondary'}">
                     ${setting.is_encrypted ? 'Ya' : 'Tidak'}
                  </span>
               </td>
               <td>
                  <div class="action-buttons">
                     <a href="/admin/settings/${setting.id}/edit" class="btn btn-warning btn-sm" title="Edit">
                        <i class="bi bi-pencil"></i>
                     </a>
                     <button class="btn btn-info btn-sm" onclick="viewSetting(${setting.id})" title="Lihat">
                        <i class="bi bi-eye"></i>
                     </button>
                     <button class="btn btn-danger btn-sm" onclick="deleteSetting(${setting.id})" title="Hapus">
                        <i class="bi bi-trash"></i>
                     </button>
                  </div>
               </td>
            `;
            tbody.appendChild(row);
         });
      }

      // Get type text
      function getTypeText(type) {
         const typeMap = {
            'string': 'String',
            'integer': 'Integer',
            'boolean': 'Boolean',
            'array': 'Array',
            'object': 'Object',
            'json': 'JSON'
         };
         return typeMap[type] || type || 'String';
      }

      // View setting
      function viewSetting(id) {
         // Implementation for viewing setting details
         console.log('Viewing setting:', id);
         alert('Fitur lihat detail pengaturan akan segera tersedia');
      }

      // Delete setting
      async function deleteSetting(id) {
         const confirmed = await Swal.fire({
            title: 'Hapus Pengaturan?',
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
            const response = await fetch(`/admin/settings/${id}`, {
               method: 'DELETE',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
               },
               credentials: 'same-origin'
            });
            const result = await response.json();
            if (result.success) {
               await Swal.fire({ title: 'Berhasil', text: 'Pengaturan telah dihapus.', icon: 'success', confirmButtonText: 'OK', confirmButtonColor: '#0d6efd' });
               loadSettings();
               loadStats();
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
         loadStats();
         loadSettings();
      });
   </script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

   @include('layouts.logout-script')

</body>

</html>