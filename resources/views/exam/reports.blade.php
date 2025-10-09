<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Laporan - Ujian Online</title>
   <meta name="csrf-token" content="{{ csrf_token() }}">

   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   <!-- Bootstrap Icons -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

   @include('layouts.sidebar-styles')
   @include('layouts.alert-system')

   <style>
      .chart-card {
         transition: all 0.3s ease;
      }

      .chart-card:hover {
         transform: translateY(-2px);
         box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
      }

      .progress-ring {
         transform: rotate(-90deg);
      }

      .progress-ring-circle {
         stroke-dasharray: 251.2;
         stroke-dashoffset: 251.2;
         transition: stroke-dashoffset 0.5s ease-in-out;
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

         <!-- Reports Content -->
         <div class="p-4">
            <!-- Stats Cards -->
            <div class="row mb-4">
               <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card stats-card border-0 shadow-sm">
                     <div class="card-body">
                        <div class="d-flex align-items-center">
                           <div class="flex-grow-1">
                              <div class="text-uppercase text-white-60 small fw-semibold mb-2">Total Ujian</div>
                              <div class="h2 mb-0 fw-bold text-white">24</div>
                              <div class="small text-white-60 mt-1">Semua ujian</div>
                           </div>
                           <div class="flex-shrink-0">
                              <i class="bi bi-file-text fs-1 text-white-60"></i>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card stats-card border-0 shadow-sm">
                     <div class="card-body">
                        <div class="d-flex align-items-center">
                           <div class="flex-grow-1">
                              <div class="text-uppercase text-white-60 small fw-semibold mb-2">Peserta Aktif</div>
                              <div class="h2 mb-0 fw-bold text-white">156</div>
                              <div class="small text-white-60 mt-1">Sedang aktif</div>
                           </div>
                           <div class="flex-shrink-0">
                              <i class="bi bi-people fs-1 text-white-60"></i>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card stats-card border-0 shadow-sm">
                     <div class="card-body">
                        <div class="d-flex align-items-center">
                           <div class="flex-grow-1">
                              <div class="text-uppercase text-white-60 small fw-semibold mb-2">Nilai Rata-rata</div>
                              <div class="h2 mb-0 fw-bold text-white">78.5</div>
                              <div class="small text-white-60 mt-1">Rata-rata</div>
                           </div>
                           <div class="flex-shrink-0">
                              <i class="bi bi-graph-up fs-1 text-white-60"></i>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card stats-card border-0 shadow-sm">
                     <div class="card-body">
                        <div class="d-flex align-items-center">
                           <div class="flex-grow-1">
                              <div class="text-uppercase text-white-60 small fw-semibold mb-2">Tingkat Kelulusan</div>
                              <div class="h2 mb-0 fw-bold text-white">85%</div>
                              <div class="small text-white-60 mt-1">Tingkat kelulusan</div>
                           </div>
                           <div class="flex-shrink-0">
                              <i class="bi bi-check-circle fs-1 text-white-60"></i>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <!-- Charts Row -->
            <div class="row mb-4">
               <div class="col-md-6">
                  <div class="card chart-card">
                     <div class="card-header">
                        <h6 class="m-0 font-weight-bold">Distribusi Nilai</h6>
                     </div>
                     <div class="card-body">
                        <div class="text-center">
                           <div class="progress-ring" style="width: 200px; height: 200px; margin: 0 auto;">
                              <svg width="200" height="200">
                                 <circle cx="100" cy="100" r="80" stroke="#e9ecef" stroke-width="8" fill="none" />
                                 <circle cx="100" cy="100" r="80" stroke="#28a745" stroke-width="8" fill="none"
                                    stroke-dasharray="502.4" stroke-dashoffset="125.6" class="progress-ring-circle" />
                              </svg>
                              <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                                 <h4>75%</h4>
                                 <small>Lulus</small>
                              </div>
                           </div>
                        </div>
                        <div class="mt-3">
                           <div class="d-flex justify-content-between">
                              <span>Lulus (75%)</span>
                              <span class="text-success">112 peserta</span>
                           </div>
                           <div class="d-flex justify-content-between">
                              <span>Tidak Lulus (25%)</span>
                              <span class="text-danger">44 peserta</span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="col-md-6">
                  <div class="card chart-card">
                     <div class="card-header">
                        <h6 class="m-0 font-weight-bold">Ujian per Bulan</h6>
                     </div>
                     <div class="card-body">
                        <div class="text-center">
                           <div style="height: 200px; display: flex; align-items: end; justify-content: space-around; padding: 20px;">
                              <div style="width: 30px; background: linear-gradient(to top, #667eea, #764ba2); height: 60%; border-radius: 4px;"></div>
                              <div style="width: 30px; background: linear-gradient(to top, #667eea, #764ba2); height: 80%; border-radius: 4px;"></div>
                              <div style="width: 30px; background: linear-gradient(to top, #667eea, #764ba2); height: 45%; border-radius: 4px;"></div>
                              <div style="width: 30px; background: linear-gradient(to top, #667eea, #764ba2); height: 90%; border-radius: 4px;"></div>
                              <div style="width: 30px; background: linear-gradient(to top, #667eea, #764ba2); height: 70%; border-radius: 4px;"></div>
                              <div style="width: 30px; background: linear-gradient(to top, #667eea, #764ba2); height: 85%; border-radius: 4px;"></div>
                           </div>
                           <div class="d-flex justify-content-between mt-2">
                              <small>Jan</small>
                              <small>Feb</small>
                              <small>Mar</small>
                              <small>Apr</small>
                              <small>Mei</small>
                              <small>Jun</small>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <!-- Detailed Reports -->
            <div class="row">
               <div class="col-md-8">
                  <div class="card">
                     <div class="card-header">
                        <h6 class="m-0 font-weight-bold">Laporan Detail Ujian</h6>
                     </div>
                     <div class="card-body">
                        <div class="table-responsive">
                           <table class="table table-bordered">
                              <thead>
                                 <tr>
                                    <th>Nama Ujian</th>
                                    <th>Tanggal</th>
                                    <th>Peserta</th>
                                    <th>Nilai Rata-rata</th>
                                    <th>Tingkat Kelulusan</th>
                                    <th>Aksi</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <td>Ujian Matematika Dasar</td>
                                    <td>15 Jan 2024</td>
                                    <td>25</td>
                                    <td>82.5</td>
                                    <td><span class="badge bg-success">88%</span></td>
                                    <td>
                                       <button class="btn btn-sm btn-outline-primary me-1" onclick="viewReport(this)">Lihat</button>
                                       @if(session('user_type') === 'admin')
                                       <button class="btn btn-sm btn-outline-secondary" onclick="exportReport('Excel')">Export</button>
                                       @endif
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>Ujian Bahasa Indonesia</td>
                                    <td>16 Jan 2024</td>
                                    <td>30</td>
                                    <td>75.2</td>
                                    <td><span class="badge bg-warning">73%</span></td>
                                    <td>
                                       <button class="btn btn-sm btn-outline-primary me-1" onclick="viewReport(this)">Lihat</button>
                                       @if(session('user_type') === 'admin')
                                       <button class="btn btn-sm btn-outline-secondary" onclick="exportReport('Excel')">Export</button>
                                       @endif
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>Ujian Fisika</td>
                                    <td>17 Jan 2024</td>
                                    <td>28</td>
                                    <td>68.9</td>
                                    <td><span class="badge bg-danger">65%</span></td>
                                    <td>
                                       <button class="btn btn-sm btn-outline-primary me-1" onclick="viewReport(this)">Lihat</button>
                                       @if(session('user_type') === 'admin')
                                       <button class="btn btn-sm btn-outline-secondary" onclick="exportReport('Excel')">Export</button>
                                       @endif
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>

               <!-- Quick Stats -->
               <div class="col-md-4">
                  <div class="card">
                     <div class="card-header">
                        <h6 class="m-0 font-weight-bold">Statistik Cepat</h6>
                     </div>
                     <div class="card-body">
                        <div class="mb-3">
                           <div class="d-flex justify-content-between align-items-center">
                              <span>Ujian Terbaik</span>
                              <span class="badge bg-success">Matematika Dasar</span>
                           </div>
                           <small class="text-muted">Nilai rata-rata: 82.5</small>
                        </div>

                        <div class="mb-3">
                           <div class="d-flex justify-content-between align-items-center">
                              <span>Peserta Terbaik</span>
                              <span class="badge bg-primary">Ahmad Rizki</span>
                           </div>
                           <small class="text-muted">Nilai: 95/100</small>
                        </div>

                        <div class="mb-3">
                           <div class="d-flex justify-content-between align-items-center">
                              <span>Kategori Populer</span>
                              <span class="badge bg-info">Matematika</span>
                           </div>
                           <small class="text-muted">45 ujian</small>
                        </div>

                        <div class="mb-3">
                           <div class="d-flex justify-content-between align-items-center">
                              <span>Waktu Rata-rata</span>
                              <span class="badge bg-secondary">45 menit</span>
                           </div>
                           <small class="text-muted">Dari 60 menit</small>
                        </div>
                     </div>
                  </div>

                  <!-- Export Options -->
                  <div class="card mt-3">
                     <div class="card-header">
                        <h6 class="m-0 font-weight-bold">Export Laporan</h6>
                     </div>
                     <div class="card-body">
                        <div class="d-grid gap-2">
                           <button class="btn btn-outline-success" onclick="exportReport('Excel')">
                              <i class="bi bi-file-excel me-2"></i>
                              Export Excel
                           </button>
                           <button class="btn btn-outline-danger" onclick="exportReport('PDF')">
                              <i class="bi bi-file-pdf me-2"></i>
                              Export PDF
                           </button>
                           <button class="btn btn-outline-primary" onclick="printReport()">
                              <i class="bi bi-printer me-2"></i>
                              Cetak Laporan
                           </button>
                           @if(session('user_type') === 'admin')
                           <button class="btn btn-outline-info" onclick="generateCustomReport()">
                              <i class="bi bi-gear me-2"></i>
                              Laporan Kustom
                           </button>
                           @endif
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

      // Report Functions
      function exportReport(type) {
         const loadingAlert = alertSystem.loading(`Mengekspor laporan ${type}...`);

         setTimeout(() => {
            alertSystem.hide(loadingAlert);
            alertSystem.success('Export Berhasil', `Laporan ${type} berhasil diekspor!`);
         }, 2000);
      }

      function printReport() {
         const loadingAlert = alertSystem.loading('Mempersiapkan laporan untuk dicetak...');

         setTimeout(() => {
            alertSystem.hide(loadingAlert);
            alertSystem.info('Print', 'Laporan siap untuk dicetak!');
            window.print();
         }, 1500);
      }

      function refreshData() {
         const loadingAlert = alertSystem.loading('Memperbarui data...');

         setTimeout(() => {
            alertSystem.hide(loadingAlert);
            alertSystem.success('Data Diperbarui', 'Data laporan berhasil diperbarui!');
         }, 2000);
      }

      function generateCustomReport() {
         alertSystem.info('Fitur', 'Fitur laporan kustom akan segera tersedia!');
      }

      function viewReport(button) {
         const row = button.closest('tr');
         const examName = row.cells[0].textContent;
         alertSystem.info('Lihat Laporan', `Membuka laporan detail untuk: ${examName}`);
      }

      // Make functions globally available
      window.exportReport = exportReport;
      window.printReport = printReport;
      window.refreshData = refreshData;
      window.generateCustomReport = generateCustomReport;
      window.viewReport = viewReport;

      // Logout function
      async function logout() {
         if (confirm('Apakah Anda yakin ingin logout?')) {
            try {
               const response = await fetch('/auth/logout', {
                  method: 'POST',
                  headers: {
                     'Content-Type': 'application/json',
                     'X-CSRF-TOKEN': csrfToken
                  }
               });

               if (response.ok) {
                  window.location.href = '/';
               } else {
                  alert('Gagal logout. Silakan coba lagi.');
               }
            } catch (error) {
               console.error('Logout error:', error);
               alert('Terjadi kesalahan saat logout.');
            }
         }
      }
   </script>
</body>

</html>