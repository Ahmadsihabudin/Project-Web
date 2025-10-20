<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Manajemen Laporan - Ujian Online</title>
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
               <h2><i class="bi bi-file-earmark-text me-2"></i> Manajemen Laporan</h2>
               <p class="mb-0">Kelola dan generate laporan ujian online</p>
            </div>

            <!-- Statistics Cards -->
            <div class="row mb-4" id="statsCards">
               <!-- Stats will be loaded here -->
            </div>

            <!-- Reports Table -->
            <div class="card">
               <div class="card-header d-flex justify-content-between align-items-center">
                  <h6 class="m-0 font-weight-bold">Daftar Laporan</h6>
                  <a href="{{ route('admin.reports.create') }}" class="btn btn-primary btn-sm">
                     <i class="bi bi-file-earmark-plus me-1"></i>
                     Buat Laporan
                  </a>
               </div>
               <div class="card-body">
                  <div class="table-responsive">
                     <table class="table table-striped" id="reportsTable">
                        <thead>
                           <tr>
                              <th>No</th>
                              <th>Judul Laporan</th>
                              <th>Tipe</th>
                              <th>Format</th>
                              <th>Periode</th>
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
            const response = await fetch('/admin/reports/stats', {
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
                        <i class="bi bi-file-earmark-text-fill text-white" style="font-size: 2rem;"></i>
                     </div>
                     <div class="flex-grow-1 ms-3">
                        <h5 class="mb-0">${stats.total}</h5>
                        <p class="text-muted mb-0">Total Laporan</p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-3">
               <div class="stats-card">
                  <div class="d-flex align-items-center">
                     <div class="flex-shrink-0">
                        <i class="bi bi-check-circle-fill text-white" style="font-size: 2rem;"></i>
                     </div>
                     <div class="flex-grow-1 ms-3">
                        <h5 class="mb-0">${stats.active}</h5>
                        <p class="text-muted mb-0">Aktif</p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-3">
               <div class="stats-card">
                  <div class="d-flex align-items-center">
                     <div class="flex-shrink-0">
                        <i class="bi bi-pencil-square text-white" style="font-size: 2rem;"></i>
                     </div>
                     <div class="flex-grow-1 ms-3">
                        <h5 class="mb-0">${stats.draft}</h5>
                        <p class="text-muted mb-0">Draft</p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-3">
               <div class="stats-card">
                  <div class="d-flex align-items-center">
                     <div class="flex-shrink-0">
                        <i class="bi bi-archive-fill text-secondary" style="font-size: 2rem;"></i>
                     </div>
                     <div class="flex-grow-1 ms-3">
                        <h5 class="mb-0">${stats.archived}</h5>
                        <p class="text-muted mb-0">Arsip</p>
                     </div>
                  </div>
               </div>
            </div>
         `;

         document.getElementById('statsCards').innerHTML = statsHtml;
      }

      // Load reports data
      async function loadReports() {
         try {
            const response = await fetch('/admin/reports/data', {
               method: 'GET',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
               }
            });

            if (response.ok) {
               const result = await response.json();
               if (result.success) {
                  displayReports(result.data);
               }
            }
         } catch (error) {
            console.error('Error loading reports:', error);
         }
      }

      // Display reports
      function displayReports(reports) {
         const tbody = document.querySelector('#reportsTable tbody');
         tbody.innerHTML = '';

         reports.forEach((report, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `
               <td>${index + 1}</td>
               <td>${report.judul_laporan}</td>
               <td><span class="badge bg-info">${getTipeLaporanText(report.tipe_laporan)}</span></td>
               <td><span class="badge bg-secondary">${report.format_laporan.toUpperCase()}</span></td>
               <td>${formatDateRange(report.periode_mulai, report.periode_selesai)}</td>
               <td>
                  <div class="action-buttons">
                     <a href="/admin/reports/${report.id}/edit" class="btn btn-warning btn-sm" title="Edit">
                        <i class="bi bi-pencil"></i>
                     </a>
                     <button class="btn btn-primary btn-sm" onclick="generateReport(${report.id})" title="Generate">
                        <i class="bi bi-download"></i>
                     </button>
                     <button class="btn btn-danger btn-sm" onclick="deleteReport(${report.id})" title="Hapus">
                        <i class="bi bi-trash"></i>
                     </button>
                  </div>
               </td>
            `;
            tbody.appendChild(row);
         });
      }

      // Get tipe laporan text
      function getTipeLaporanText(tipeLaporan) {
         const tipeMap = {
            'hasil_ujian': 'Hasil Ujian',
            'statistik_peserta': 'Statistik Peserta',
            'analisis_soal': 'Analisis Soal',
            'laporan_kehadiran': 'Laporan Kehadiran',
            'laporan_umum': 'Laporan Umum'
         };
         return tipeMap[tipeLaporan] || tipeLaporan;
      }


      // Format date range
      function formatDateRange(startDate, endDate) {
         if (!startDate && !endDate) return '-';
         if (!startDate) return `Sampai ${formatDate(endDate)}`;
         if (!endDate) return `Dari ${formatDate(startDate)}`;
         return `${formatDate(startDate)} - ${formatDate(endDate)}`;
      }

      // Format date
      function formatDate(dateString) {
         if (!dateString) return '-';
         const date = new Date(dateString);
         return date.toLocaleDateString('id-ID');
      }

      // Generate report
      async function generateReport(id) {
         try {
            const response = await fetch(`/admin/reports/${id}/generate`, {
               method: 'POST',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
               }
            });

            const result = await response.json();

            if (result.success) {
               alertSystem.success('Laporan berhasil digenerate');
               if (result.download_url) {
                  window.open(result.download_url, '_blank');
               }
            } else {
               alertSystem.error('Gagal menggenerate laporan', result.message);
            }
         } catch (error) {
            console.error('Error generating report:', error);
            alertSystem.error('Gagal menggenerate laporan', 'Terjadi kesalahan jaringan');
         }
      }

      // Delete report
      async function deleteReport(id) {
         if (confirm('Apakah Anda yakin ingin menghapus laporan ini?')) {
            try {
               const response = await fetch(`/admin/reports/${id}`, {
                  method: 'DELETE',
                  headers: {
                     'Content-Type': 'application/json',
                     'X-CSRF-TOKEN': csrfToken
                  }
               });

               const result = await response.json();

               if (result.success) {
                  alertSystem.deleteSuccess('Laporan');
                  loadReports();
                  loadStats();
               } else {
                  alertSystem.error('Gagal menghapus laporan', result.message);
               }
            } catch (error) {
               console.error('Error deleting report:', error);
               alertSystem.error('Gagal menghapus laporan', 'Terjadi kesalahan jaringan');
            }
         }
      }

      // Initialize on page load
      document.addEventListener('DOMContentLoaded', function() {
         console.log('DOM Content Loaded');
         loadStats();
         loadReports();
      });
   </script>

</body>

</html>