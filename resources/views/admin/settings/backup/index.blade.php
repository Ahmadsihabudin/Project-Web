<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Backup Data - Ujian Online</title>
   <meta name="csrf-token" content="{{ csrf_token() }}">

   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

   <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
   @include('layouts.alert-system')
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

   <link rel="icon" type="image/png" href="{{ asset('images/Favicon_akti.png') }}">

   <style>
      .page-header {
         background: #f8f9fa;
         color: #333;
         border-radius: 10px;
         padding: 1.5rem;
         margin-bottom: 2rem;
      }

      .card {
         border: none;
         box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
         border-radius: 0.5rem;
         margin-bottom: 1.5rem;
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

      .theme-btn {
         padding: 0.5rem 1rem;
         border: 2px solid #74292a;
         color: #292929;
         text-transform: capitalize;
         font-weight: 400;
         border-radius: 0.375rem;
         transition: 0.4s cubic-bezier(0, 0, 1, 1);
         position: relative;
         z-index: 1;
         background: white;
         font-size: 0.875rem;
      }

      .theme-btn i {
         margin-left: 7px;
      }

      .theme-btn:hover {
         color: #fff;
         border-color: white;
      }

      .theme-btn::before {
         position: absolute;
         z-index: -1;
         content: "";
         background-color: #74292a;
         height: 0%;
         width: 0%;
         top: 50%;
         left: 50%;
         transform: translate(-50%, -50%);
         opacity: 0;
         transition: 0.4s cubic-bezier(0, 0, 1, 1);
         border-radius: 0.375rem;
      }

      .theme-btn:hover::before {
         height: 100%;
         width: 100%;
         opacity: 1;
      }

      .info-box {
         background-color: #e7f3ff;
         border-left: 4px solid #0d6efd;
         padding: 1rem;
         border-radius: 0.375rem;
         margin-bottom: 1.5rem;
      }

      .info-box p {
         margin: 0;
         color: #0c5460;
      }

      .backup-list {
         list-style: none;
         padding: 0;
      }

      .backup-item {
         background: #f8f9fa;
         border: 1px solid #dee2e6;
         border-radius: 0.375rem;
         padding: 1rem;
         margin-bottom: 0.5rem;
         display: flex;
         justify-content: space-between;
         align-items: center;
      }

      .backup-item-info {
         flex: 1;
      }

      .backup-item-name {
         font-weight: 600;
         color: #495057;
         margin-bottom: 0.25rem;
      }

      .backup-item-meta {
         font-size: 0.875rem;
         color: #6c757d;
      }

      .btn-loading {
         position: relative;
         pointer-events: none;
      }

      .btn-loading::after {
         content: "";
         position: absolute;
         width: 16px;
         height: 16px;
         top: 50%;
         left: 50%;
         margin-left: -8px;
         margin-top: -8px;
         border: 2px solid #ffffff;
         border-radius: 50%;
         border-top-color: transparent;
         animation: spinner 0.6s linear infinite;
      }

      @keyframes spinner {
         to {
            transform: rotate(360deg);
         }
      }
   </style>
</head>

<body>
   <div class="container-fluid">
      @include('layouts.sidebar')

      <div class="main-content">
         @include('layouts.navbar')

         <div class="p-4">
            <div class="page-header">
               <h2><i class="bi bi-database me-2" style="color: #991B1B;"></i> Backup Data</h2>
               <p class="mb-0">Buat backup database untuk keamanan data</p>
            </div>

            <div class="info-box">
               <p><i class="bi bi-info-circle me-2"></i>
                  <strong>Penting:</strong> Backup database secara berkala untuk menjaga keamanan data. File backup akan disimpan dengan format SQL dan dapat di-restore kapan saja.
               </p>
            </div>

            <div class="card">
               <div class="card-header">
                  <h6 class="m-0 font-weight-bold"><i class="bi bi-database-check me-2"></i>Buat Backup Database</h6>
               </div>
               <div class="card-body">
                  <div class="row">
                     <div class="col-md-6">
                        <h6 class="mb-3">Informasi Database</h6>
                        <div class="mb-3">
                           <label class="form-label">Nama Database:</label>
                           <input type="text" class="form-control" value="{{ config('database.connections.mysql.database') }}" readonly>
                        </div>
                        <div class="mb-3">
                           <label class="form-label">Host:</label>
                           <input type="text" class="form-control" value="{{ config('database.connections.mysql.host') }}" readonly>
                        </div>
                        <div class="mb-3">
                           <label class="form-label">Port:</label>
                           <input type="text" class="form-control" value="{{ config('database.connections.mysql.port') }}" readonly>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <h6 class="mb-3">Aksi Backup</h6>
                        <p class="text-muted">Klik tombol di bawah untuk membuat backup database sekarang.</p>
                        <button type="button" class="theme-btn" id="btnBackup" onclick="createBackup()">
                           <i class="bi bi-download"></i>
                           Buat Backup Sekarang
                        </button>
                        <p class="text-muted mt-3 small">
                           <i class="bi bi-clock me-1"></i>
                           Backup akan dibuat dengan timestamp otomatis
                        </p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="card">
               <div class="card-header">
                  <h6 class="m-0 font-weight-bold"><i class="bi bi-clock-history me-2"></i>Riwayat Backup</h6>
               </div>
               <div class="card-body">
                  <div id="backupHistory">
                     <p class="text-muted text-center">Memuat riwayat backup...</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <script>
      if (typeof csrfToken === 'undefined') {
         var csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
      }

      async function createBackup() {
         const btnBackup = document.getElementById('btnBackup');
         const originalText = btnBackup.innerHTML;
         
         btnBackup.classList.add('btn-loading');
         btnBackup.disabled = true;
         btnBackup.innerHTML = 'Memproses...';

         try {
            const response = await fetch('/admin/settings/backup/create', {
               method: 'POST',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken,
                  'Accept': 'application/json'
               }
            });

            const data = await response.json();

            if (response.ok && data.success) {
               await Swal.fire({
                  title: 'Berhasil!',
                  text: data.message || 'Backup database berhasil dibuat.',
                  icon: 'success',
                  confirmButtonText: 'OK',
                  confirmButtonColor: '#0d6efd'
               });

               loadBackupHistory();
            } else {
               throw new Error(data.message || 'Gagal membuat backup database.');
            }
         } catch (error) {
            console.error('Backup error:', error);
            await Swal.fire({
               title: 'Gagal!',
               text: error.message || 'Terjadi kesalahan saat membuat backup. Pastikan mysqldump tersedia dan konfigurasi database benar.',
               icon: 'error',
               confirmButtonText: 'Tutup',
               confirmButtonColor: '#dc3545'
            });
         } finally {
            btnBackup.classList.remove('btn-loading');
            btnBackup.disabled = false;
            btnBackup.innerHTML = originalText;
         }
      }

      async function loadBackupHistory() {
         const backupHistory = document.getElementById('backupHistory');
         
         try {
            const response = await fetch('/admin/settings/backup/list', {
               method: 'GET',
               headers: {
                  'X-CSRF-TOKEN': csrfToken,
                  'Accept': 'application/json'
               }
            });

            const data = await response.json();

            if (response.ok && data.success) {
               const backups = data.data || [];
               
               if (backups.length === 0) {
                  backupHistory.innerHTML = '<p class="text-muted text-center">Belum ada backup yang dibuat.</p>';
                  return;
               }

               let html = '<ul class="backup-list">';
               backups.forEach(backup => {
                  const fileSize = formatFileSize(backup.size || 0);
                  const date = new Date(backup.created_at || backup.date);
                  const formattedDate = date.toLocaleString('id-ID', {
                     year: 'numeric',
                     month: 'long',
                     day: 'numeric',
                     hour: '2-digit',
                     minute: '2-digit'
                  });

                  html += `
                     <li class="backup-item">
                        <div class="backup-item-info">
                           <div class="backup-item-name">
                              <i class="bi bi-file-earmark-zip me-2"></i>${backup.name || backup.filename}
                           </div>
                           <div class="backup-item-meta">
                              <i class="bi bi-clock me-1"></i>${formattedDate} | 
                              <i class="bi bi-file-earmark me-1"></i>${fileSize}
                           </div>
                        </div>
                        <div>
                           <a href="/admin/settings/backup/download/${backup.filename || backup.name}" 
                              class="btn btn-sm btn-primary me-2" 
                              title="Download">
                              <i class="bi bi-download"></i>
                           </a>
                           <button type="button" 
                                   class="btn btn-sm btn-danger" 
                                   onclick="deleteBackup('${backup.filename || backup.name}')"
                                   title="Hapus">
                              <i class="bi bi-trash"></i>
                           </button>
                        </div>
                     </li>
                  `;
               });
               html += '</ul>';
               backupHistory.innerHTML = html;
            } else {
               backupHistory.innerHTML = '<p class="text-danger text-center">Gagal memuat riwayat backup.</p>';
            }
         } catch (error) {
            console.error('Load backup history error:', error);
            backupHistory.innerHTML = '<p class="text-danger text-center">Terjadi kesalahan saat memuat riwayat backup.</p>';
         }
      }

      async function deleteBackup(filename) {
         const confirmed = await Swal.fire({
            title: 'Hapus Backup?',
            text: `Apakah Anda yakin ingin menghapus backup "${filename}"?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d'
         });

         if (!confirmed.isConfirmed) return;

         try {
            const response = await fetch(`/admin/settings/backup/delete/${filename}`, {
               method: 'DELETE',
               headers: {
                  'X-CSRF-TOKEN': csrfToken,
                  'Accept': 'application/json'
               }
            });

            const data = await response.json();

            if (response.ok && data.success) {
               await Swal.fire({
                  title: 'Berhasil!',
                  text: 'Backup berhasil dihapus.',
                  icon: 'success',
                  confirmButtonText: 'OK',
                  confirmButtonColor: '#0d6efd'
               });

               loadBackupHistory();
            } else {
               throw new Error(data.message || 'Gagal menghapus backup.');
            }
         } catch (error) {
            console.error('Delete backup error:', error);
            await Swal.fire({
               title: 'Gagal!',
               text: error.message || 'Terjadi kesalahan saat menghapus backup.',
               icon: 'error',
               confirmButtonText: 'Tutup',
               confirmButtonColor: '#dc3545'
            });
         }
      }

      function formatFileSize(bytes) {
         if (bytes === 0) return '0 Bytes';
         const k = 1024;
         const sizes = ['Bytes', 'KB', 'MB', 'GB'];
         const i = Math.floor(Math.log(bytes) / Math.log(k));
         return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
      }

      document.addEventListener('DOMContentLoaded', function() {
         loadBackupHistory();
      });
   </script>
</body>

</html>

