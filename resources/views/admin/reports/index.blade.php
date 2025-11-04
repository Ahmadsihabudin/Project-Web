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
   <!-- Chart.js -->
   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   <!-- Bootstrap JS -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

   <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
   @include('layouts.alert-system')

   <link rel="icon" type="image/png" href="{{ asset('images/Favicon_akti.png') }}">

   <style>
      .page-header {
         background: #f8f9fa;
         color: #333;
         border-radius: 15px;
         padding: 2rem;
         margin-bottom: 2rem;
         box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
      }

      .stats-card {
         background: white;
         border-radius: 15px;
         padding: 1.5rem;
         box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
         margin-bottom: 1.5rem;
         border: none;
         transition: transform 0.3s ease, box-shadow 0.3s ease;
         position: relative;
         overflow: hidden;
      }

      .stats-card:hover {
         transform: translateY(-5px);
         box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
      }

      .stats-card::before {
         content: '';
         position: absolute;
         top: 0;
         left: 0;
         right: 0;
         height: 4px;
         background: linear-gradient(90deg, #3498db, #2ecc71, #f39c12, #e74c3c);
      }

      .stats-card .icon-wrapper {
         width: 60px;
         height: 60px;
         border-radius: 50%;
         display: flex;
         align-items: center;
         justify-content: center;
         margin-bottom: 1rem;
      }

      .stats-card.primary .icon-wrapper {
         background: linear-gradient(135deg, #3498db, #2980b9);
      }

      .stats-card.success .icon-wrapper {
         background: linear-gradient(135deg, #2ecc71, #27ae60);
      }

      .stats-card.warning .icon-wrapper {
         background: linear-gradient(135deg, #f39c12, #e67e22);
      }

      .stats-card.info .icon-wrapper {
         background: linear-gradient(135deg, #17a2b8, #138496);
      }

      .stats-card.danger .icon-wrapper {
         background: linear-gradient(135deg, #e74c3c, #c0392b);
      }

      .chart-container {
         background: white;
         border-radius: 15px;
         padding: 1.5rem;
         box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
         margin-bottom: 1.5rem;
      }

      .chart-title {
         font-size: 1.2rem;
         font-weight: 600;
         color: #2c3e50;
         margin-bottom: 1rem;
         display: flex;
         align-items: center;
      }

      .chart-title i {
         margin-right: 0.5rem;
         color: #3498db;
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
            <div class="page-header">
               <h2><i class="bi bi-file-earmark-text me-2" style="color: #991B1B;"></i> Laporan Hasil Ujian</h2>
               <p class="mb-0">Data hasil ujian peserta yang telah diselesaikan</p>
            </div>

            <!-- Statistics Cards -->
            <div class="row mb-4" id="statsCards">
               <!-- Stats will be loaded here -->
            </div>

            <!-- Charts Section -->
            <div class="row mb-4">
               <div class="col-lg-8">
                  <div class="chart-container">
                     <div class="chart-title">
                        <i class="bi bi-graph-up"></i>
                        Distribusi Skor Ujian
                     </div>
                     <canvas id="scoreDistributionChart" width="400" height="200"></canvas>
                  </div>
               </div>
               <div class="col-lg-4">
                  <div class="chart-container">
                     <div class="chart-title">
                        <i class="bi bi-pie-chart"></i>
                        Status Submit
                     </div>
                     <canvas id="statusChart" width="300" height="200"></canvas>
                  </div>
               </div>
            </div>

            <!-- Performance Metrics -->
            <div class="row mb-4">
               <div class="col-lg-6">
                  <div class="chart-container">
                     <div class="chart-title">
                        <i class="bi bi-clock-history"></i>
                        Rata-rata Waktu Pengerjaan
                     </div>
                     <canvas id="timeChart" width="400" height="200"></canvas>
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="chart-container">
                     <div class="chart-title">
                        <i class="bi bi-trophy"></i>
                        Top Performers
                     </div>
                     <div id="topPerformers">
                        <!-- Top performers will be loaded here -->
                     </div>
                  </div>
               </div>
            </div>

            <!-- Detailed Results Table -->
            <div class="card">
               <div class="card-header d-flex justify-content-between align-items-center">
                  <h6 class="m-0 font-weight-bold">
                     <i class="bi bi-table me-2"></i>
                     Detail Hasil Ujian
                  </h6>
                  <div class="d-flex gap-2">
                     <button class="theme-btn" onclick="exportToPDF()">
                        <i class="bi bi-file-pdf me-1"></i> Export PDF
                     </button>
                     <button class="theme-btn" onclick="exportToExcel()">
                        <i class="bi bi-file-excel me-1"></i> Export Excel
                     </button>
                     <button class="theme-btn" onclick="deleteSelected()" id="deleteSelectedBtn" disabled>
                        <i class="bi bi-trash me-1"></i> Hapus Terpilih
                     </button>
                  </div>
               </div>
               <div class="card-body">
                  <div class="table-responsive">
                     <table class="table table-striped table-hover" id="reportsTable">
                        <thead>
                           <tr>
                              <th>
                                 <input type="checkbox" id="selectAll" onchange="toggleSelectAll()">
                              </th>
                              <th>No</th>
                              <th>Nama Peserta</th>
                              <th>Skor</th>
                              <th>Jawaban Benar</th>
                              <th>Jawaban Salah</th>
                              <th>Waktu Pengerjaan</th>
                              <th>Status Submit</th>
                              <th>Tanggal</th>
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
            <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
               <div class="stats-card primary">
                  <div class="icon-wrapper">
                     <i class="bi bi-file-earmark-text-fill" style="font-size: 1.5rem; color: #007bff;"></i>
                  </div>
                  <h3 class="mb-1">${stats.total}</h3>
                  <p class="text-muted mb-0">Total Ujian</p>
               </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
               <div class="stats-card success">
                  <div class="icon-wrapper">
                     <i class="bi bi-check-circle-fill" style="font-size: 1.5rem; color: #28a745;"></i>
                  </div>
                  <h3 class="mb-1">${stats.completed}</h3>
                  <p class="text-muted mb-0">Selesai</p>
               </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
               <div class="stats-card warning">
                  <div class="icon-wrapper">
                     <i class="bi bi-graph-up" style="font-size: 1.5rem; color: #ffc107;"></i>
                  </div>
                  <h3 class="mb-1">${stats.average_score}%</h3>
                  <p class="text-muted mb-0">Rata-rata Skor</p>
               </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
               <div class="stats-card info">
                  <div class="icon-wrapper">
                     <i class="bi bi-clock-history" style="font-size: 1.5rem; color: #17a2b8;"></i>
                  </div>
                  <h3 class="mb-1">${stats.average_time || 0}</h3>
                  <p class="text-muted mb-0">Rata-rata Waktu (menit)</p>
               </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
               <div class="stats-card danger">
                  <div class="icon-wrapper">
                     <i class="bi bi-people-fill" style="font-size: 1.5rem; color: #007bff;"></i>
                  </div>
                  <h3 class="mb-1">${stats.participants}</h3>
                  <p class="text-muted mb-0">Peserta</p>
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
            const scoreClass = report.total_score >= 80 ? 'success' : report.total_score >= 60 ? 'warning' : 'danger';
            const statusClass = report.status_submit === 'auto_submit' ? 'success' : 'info';

            row.innerHTML = `
               <td>
                  <input type="checkbox" class="report-checkbox" value="${report.id_laporan}" onchange="updateDeleteButton()">
               </td>
               <td>${index + 1}</td>
               <td>
                  <div class="d-flex align-items-center">
                     <div class="avatar-sm bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                        ${report.nama_peserta ? report.nama_peserta.charAt(0).toUpperCase() : 'U'}
                     </div>
                     <div>
                        <div class="fw-bold">${report.nama_peserta || 'Unknown'}</div>
                        <small class="text-muted">ID: ${report.id_peserta}</small>
                     </div>
                  </div>
               </td>
               <td>
                  <span class="badge bg-${scoreClass} fs-6">${report.total_score}%</span>
               </td>
               <td>
                  <div class="d-flex align-items-center">
                     <span class="fw-bold me-1 text-success">${report.jumlah_benar}</span>
                     <small class="text-muted">benar</small>
                  </div>
               </td>
               <td>
                  <div class="d-flex align-items-center">
                     <span class="fw-bold me-1 text-danger">${report.jumlah_salah || 0}</span>
                     <small class="text-muted">salah</small>
                  </div>
               </td>
               <td>
                  <div class="d-flex align-items-center">
                     <i class="bi bi-clock me-1"></i>
                     <span>${report.waktu_pengerjaan} menit</span>
                  </div>
               </td>
               <td>
                  <span class="badge bg-${statusClass}">${report.status_submit}</span>
               </td>
               <td>
                  <div class="d-flex align-items-center">
                     <i class="bi bi-calendar me-1"></i>
                     <span>${formatDate(report.created_at)}</span>
                  </div>
               </td>
               <td>
                  <div class="action-buttons">
                     <button class="btn btn-info btn-sm" onclick="viewDetails(${report.id_laporan})" title="Detail">
                        <i class="bi bi-eye"></i>
                     </button>
                     <button class="btn btn-primary btn-sm" onclick="downloadReport(${report.id_laporan})" title="Download">
                        <i class="bi bi-download"></i>
                     </button>
                  </div>
               </td>
            `;
            tbody.appendChild(row);
         });

         // Initialize charts after data is loaded
         initializeCharts(reports);
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
         const confirmed = await Swal.fire({
            title: 'Hapus Laporan?',
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
            const response = await fetch(`/admin/reports/${id}`, {
               method: 'DELETE',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
               }
            });
            const result = await response.json();
            if (result.success) {
               await Swal.fire({
                  title: 'Berhasil',
                  text: 'Laporan telah dihapus.',
                  icon: 'success',
                  confirmButtonText: 'OK',
                  confirmButtonColor: '#0d6efd'
               });
               loadReports();
               loadStats();
            } else {
               Swal.fire({
                  title: 'Gagal menghapus',
                  text: result.message || 'Terjadi kesalahan.',
                  icon: 'error',
                  confirmButtonText: 'Tutup'
               });
            }
         } catch (_) {
            Swal.fire({
               title: 'Gagal menghapus',
               text: 'Terjadi kesalahan jaringan.',
               icon: 'error',
               confirmButtonText: 'Tutup'
            });
         }
      }

      // Initialize charts
      function initializeCharts(reports) {
         // Score Distribution Chart
         const scoreCtx = document.getElementById('scoreDistributionChart').getContext('2d');
         const scores = reports.map(r => r.total_score);
         const scoreRanges = {
            '0-20': scores.filter(s => s >= 0 && s <= 20).length,
            '21-40': scores.filter(s => s > 20 && s <= 40).length,
            '41-60': scores.filter(s => s > 40 && s <= 60).length,
            '61-80': scores.filter(s => s > 60 && s <= 80).length,
            '81-100': scores.filter(s => s > 80 && s <= 100).length
         };

         new Chart(scoreCtx, {
            type: 'bar',
            data: {
               labels: ['0-20%', '21-40%', '41-60%', '61-80%', '81-100%'],
               datasets: [{
                  label: 'Jumlah Peserta',
                  data: Object.values(scoreRanges),
                  backgroundColor: [
                     'rgba(231, 76, 60, 0.8)',
                     'rgba(230, 126, 34, 0.8)',
                     'rgba(241, 196, 15, 0.8)',
                     'rgba(46, 204, 113, 0.8)',
                     'rgba(52, 152, 219, 0.8)'
                  ],
                  borderColor: [
                     'rgba(231, 76, 60, 1)',
                     'rgba(230, 126, 34, 1)',
                     'rgba(241, 196, 15, 1)',
                     'rgba(46, 204, 113, 1)',
                     'rgba(52, 152, 219, 1)'
                  ],
                  borderWidth: 2
               }]
            },
            options: {
               responsive: true,
               plugins: {
                  legend: {
                     display: false
                  }
               },
               scales: {
                  y: {
                     beginAtZero: true,
                     ticks: {
                        stepSize: 1
                     }
                  }
               }
            }
         });

         // Status Chart
         const statusCtx = document.getElementById('statusChart').getContext('2d');
         const statusCounts = reports.reduce((acc, r) => {
            acc[r.status_submit] = (acc[r.status_submit] || 0) + 1;
            return acc;
         }, {});

         new Chart(statusCtx, {
            type: 'doughnut',
            data: {
               labels: Object.keys(statusCounts),
               datasets: [{
                  data: Object.values(statusCounts),
                  backgroundColor: [
                     'rgba(52, 152, 219, 0.8)',
                     'rgba(46, 204, 113, 0.8)',
                     'rgba(241, 196, 15, 0.8)'
                  ],
                  borderWidth: 2
               }]
            },
            options: {
               responsive: true,
               plugins: {
                  legend: {
                     position: 'bottom'
                  }
               }
            }
         });

         // Time Chart
         const timeCtx = document.getElementById('timeChart').getContext('2d');
         const timeData = reports.map(r => ({
            x: r.nama_peserta,
            y: r.waktu_pengerjaan
         }));

         new Chart(timeCtx, {
            type: 'line',
            data: {
               labels: reports.map(r => r.nama_peserta),
               datasets: [{
                  label: 'Waktu Pengerjaan (menit)',
                  data: reports.map(r => r.waktu_pengerjaan),
                  borderColor: 'rgba(52, 152, 219, 1)',
                  backgroundColor: 'rgba(52, 152, 219, 0.1)',
                  tension: 0.4,
                  fill: true
               }]
            },
            options: {
               responsive: true,
               scales: {
                  y: {
                     beginAtZero: true,
                     title: {
                        display: true,
                        text: 'Waktu (menit)'
                     }
                  }
               }
            }
         });

         // Top Performers
         const topPerformers = reports
            .sort((a, b) => b.total_score - a.total_score)
            .slice(0, 5);

         const topPerformersHtml = topPerformers.map((performer, index) => `
            <div class="d-flex align-items-center mb-3">
               <div class="rank-badge me-3" style="width: 30px; height: 30px; background: linear-gradient(135deg, #f39c12, #e67e22); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold;">
                  ${index + 1}
               </div>
               <div class="flex-grow-1">
                  <div class="fw-bold">${performer.nama_peserta}</div>
                  <small class="text-muted">${performer.total_score}% • ${performer.jumlah_benar} jawaban benar</small>
               </div>
               <div class="text-end">
                  <span class="badge bg-success">${performer.total_score}%</span>
               </div>
            </div>
         `).join('');

         document.getElementById('topPerformers').innerHTML = topPerformersHtml || '<p class="text-muted text-center">Belum ada data</p>';
      }

      // View details
      async function viewDetails(id) {
         await Swal.fire({
            icon: 'info',
            title: 'Segera Hadir',
            text: 'Fitur detail akan segera tersedia',
            confirmButtonText: 'OK',
            confirmButtonColor: '#991B1B'
         });
      }

      // Download report
      async function downloadReport(id) {
         await Swal.fire({
            icon: 'info',
            title: 'Segera Hadir',
            text: 'Fitur download akan segera tersedia',
            confirmButtonText: 'OK',
            confirmButtonColor: '#991B1B'
         });
      }

      // Export functions
      async function exportToPDF() {
         await Swal.fire({
            icon: 'info',
            title: 'Segera Hadir',
            text: 'Fitur export PDF akan segera tersedia',
            confirmButtonText: 'OK',
            confirmButtonColor: '#991B1B'
         });
      }

      async function exportToExcel() {
         await Swal.fire({
            icon: 'info',
            title: 'Segera Hadir',
            text: 'Fitur export Excel akan segera tersedia',
            confirmButtonText: 'OK',
            confirmButtonColor: '#991B1B'
         });
      }

      // Checkbox functions
      function toggleSelectAll() {
         const selectAllCheckbox = document.getElementById('selectAll');
         const checkboxes = document.querySelectorAll('.report-checkbox');

         checkboxes.forEach(checkbox => {
            checkbox.checked = selectAllCheckbox.checked;
         });

         updateDeleteButton();
      }

      function updateDeleteButton() {
         const checkboxes = document.querySelectorAll('.report-checkbox:checked');
         const deleteBtn = document.getElementById('deleteSelectedBtn');

         if (checkboxes.length > 0) {
            deleteBtn.disabled = false;
            deleteBtn.textContent = `Hapus Terpilih (${checkboxes.length})`;
         } else {
            deleteBtn.disabled = true;
            deleteBtn.textContent = 'Hapus Terpilih';
         }
      }

      // Delete selected reports
      async function deleteSelected() {
         const checkboxes = document.querySelectorAll('.report-checkbox:checked');
         const selectedIds = Array.from(checkboxes).map(cb => cb.value);

         if (selectedIds.length === 0) {
            await Swal.fire({
               title: 'Tidak ada data',
               text: 'Pilih data yang akan dihapus.',
               icon: 'info',
               confirmButtonText: 'OK'
            });
            return;
         }

         const confirmed = await Swal.fire({
            title: 'Hapus Laporan Terpilih?',
            text: `Anda akan menghapus ${selectedIds.length} data. Tindakan ini tidak dapat dibatalkan.`,
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
            const response = await fetch('/admin/reports/bulk-delete', {
               method: 'POST',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
               },
               body: JSON.stringify({
                  ids: selectedIds
               })
            });

            const result = await response.json();

            if (result.success) {
               await Swal.fire({
                  title: 'Berhasil',
                  text: `Berhasil menghapus ${result.deleted_count} data laporan.`,
                  icon: 'success',
                  confirmButtonText: 'OK',
                  confirmButtonColor: '#0d6efd'
               });
               loadReports();
               loadStats();
            } else {
               await Swal.fire({
                  icon: 'error',
                  title: 'Gagal Menghapus',
                  text: result.message || 'Gagal menghapus data',
                  confirmButtonText: 'OK',
                  confirmButtonColor: '#991B1B'
               });
            }
         } catch (error) {
            console.error('Error deleting reports:', error);
            await Swal.fire({
               icon: 'error',
               title: 'Terjadi Kesalahan',
               text: 'Terjadi kesalahan saat menghapus data',
               confirmButtonText: 'OK',
               confirmButtonColor: '#991B1B'
            });
         }
      }

      // Initialize on page load
      document.addEventListener('DOMContentLoaded', function() {
         console.log('DOM Content Loaded');
         loadStats();
         loadReports();
      });
   </script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

   @include('layouts.logout-script')

</body>

</html>