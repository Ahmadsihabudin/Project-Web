<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Pengaturan - Ujian Online</title>
   <meta name="csrf-token" content="{{ csrf_token() }}">

   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   <!-- Bootstrap Icons -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

   <style>
      .sidebar {
         min-height: 100vh;
         background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      }

      .sidebar .nav-link {
         color: rgba(255, 255, 255, 0.8);
         padding: 0.75rem 1rem;
         border-radius: 0.375rem;
         margin: 0.25rem 0;
      }

      .sidebar .nav-link:hover,
      .sidebar .nav-link.active {
         color: white;
         background-color: rgba(255, 255, 255, 0.1);
      }

      .main-content {
         background-color: #f8f9fa;
         min-height: 100vh;
      }
   </style>
   @include('layouts.alert-system')
</head>

<body>
   <div class="container-fluid">
      <!-- Sidebar -->
      @include('layouts.sidebar')

      <!-- Main Content -->
      <div class="main-content">
         <!-- Navbar -->
         <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
            <div class="container-fluid">
               <span class="navbar-brand mb-0 h1">Pengaturan Sistem</span>
               <div class="navbar-nav ms-auto">
                  <div class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle me-1"></i>
                        Admin
                     </a>
                     <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Profil</a></li>
                        <li>
                           <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#" onclick="logout()">Logout</a></li>
                     </ul>
                  </div>
               </div>
            </div>
         </nav>

         <!-- Settings Content -->
         <div class="p-4">
            <div class="row">
               <div class="col-md-6">
                  <div class="card">
                     <div class="card-header">
                        <h6>Pengaturan Umum</h6>
                     </div>
                     <div class="card-body">
                        <div class="mb-3">
                           <label for="systemName" class="form-label">Nama Sistem</label>
                           <input type="text" class="form-control" id="systemName" value="Pembuat Ujian" />
                        </div>
                        <div class="mb-3">
                           <label for="timezone" class="form-label">Zona Waktu</label>
                           <select class="form-select" id="timezone">
                              <option value="UTC">UTC</option>
                              <option value="EST">Waktu Timur</option>
                              <option value="PST">Waktu Pasifik</option>
                              <option value="GMT">GMT</option>
                           </select>
                        </div>
                        <div class="form-check mb-3">
                           <input class="form-check-input" type="checkbox" id="emailNotifications" checked />
                           <label class="form-check-label" for="emailNotifications">
                              Aktifkan Notifikasi Email
                           </label>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="card">
                     <div class="card-header">
                        <h6>Pengaturan Pengawas</h6>
                     </div>
                     <div class="card-body">
                        <div class="form-check mb-3">
                           <input class="form-check-input" type="checkbox" id="enableGlobalProctoring" />
                           <label class="form-check-label" for="enableGlobalProctoring">
                              Aktifkan Pengawas Global
                           </label>
                        </div>
                        <div class="form-check mb-3">
                           <input class="form-check-input" type="checkbox" id="requireWebcamGlobal" />
                           <label class="form-check-label" for="requireWebcamGlobal">
                              Wajib Webcam Secara Default
                           </label>
                        </div>
                        <div class="mb-3">
                           <label for="flagThreshold" class="form-label">Ambang Tanda (detik)</label>
                           <input type="number" class="form-control" id="flagThreshold" value="5" />
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- Bootstrap JS -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

   <script>
      // CSRF Token
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

      // Settings Functions
      function saveSettings() {
         const loadingAlert = alertSystem.loading('Menyimpan pengaturan...');

         setTimeout(() => {
            alertSystem.hide(loadingAlert);
            alertSystem.success('Pengaturan Tersimpan', 'Pengaturan berhasil disimpan!');
         }, 1500);
      }

      function resetSettings() {
         if (confirm('Apakah Anda yakin ingin mengembalikan pengaturan ke default?')) {
            const loadingAlert = alertSystem.loading('Mengembalikan pengaturan...');

            setTimeout(() => {
               alertSystem.hide(loadingAlert);
               alertSystem.success('Pengaturan Direset', 'Pengaturan berhasil dikembalikan ke default!');
            }, 2000);
         }
      }

      function testEmailSettings() {
         const loadingAlert = alertSystem.loading('Menguji konfigurasi email...');

         setTimeout(() => {
            alertSystem.hide(loadingAlert);
            alertSystem.success('Email OK', 'Konfigurasi email berhasil diuji!');
         }, 3000);
      }

      function backupDatabase() {
         const loadingAlert = alertSystem.loading('Membuat backup database...');

         setTimeout(() => {
            alertSystem.hide(loadingAlert);
            alertSystem.success('Backup Berhasil', 'Database berhasil dibackup!');
         }, 5000);
      }

      function clearCache() {
         const loadingAlert = alertSystem.loading('Membersihkan cache...');

         setTimeout(() => {
            alertSystem.hide(loadingAlert);
            alertSystem.success('Cache Dibersihkan', 'Cache berhasil dibersihkan!');
         }, 2000);
      }

      // Make functions globally available
      window.saveSettings = saveSettings;
      window.resetSettings = resetSettings;
      window.testEmailSettings = testEmailSettings;
      window.backupDatabase = backupDatabase;
      window.clearCache = clearCache;

      // Logout function
      async function logout() {
         if (confirm('Apakah Anda yakin ingin logout?')) {
            try {
               const response = await fetch('/logout', {
                  method: 'POST',
                  headers: {
                     'Content-Type': 'application/json',
                     'X-CSRF-TOKEN': csrfToken
                  }
               });

               if (response.ok) {
                  window.location.href = '/auth/admin/login';
               }
            } catch (error) {
               console.error('Logout error:', error);
            }
         }
      }
   </script>
</body>

</html>