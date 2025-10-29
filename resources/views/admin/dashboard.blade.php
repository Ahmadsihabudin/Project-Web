<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard Admin - Ujian Online</title>
   <meta name="csrf-token" content="{{ csrf_token() }}">

   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   <!-- Bootstrap Icons -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

   <!-- Custom Sidebar CSS -->
   <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
   @include('layouts.alert-system')

   <style>
      .stats-card {
         background: white !important;
         color: #333;
         border: 3px solid #991B1B;
         box-shadow: 0 2px 10px rgba(153, 27, 27, 0.1);
         position: relative;
         overflow: hidden;
      }

      .stats-card .card-body {
         margin: 2px;
         border-radius: 8px;
      }

      .stats-card::before {
         content: '';
         position: absolute;
         left: 0;
         top: 0;
         bottom: 0;
         width: 4px;
         border-radius: 4px 0 0 4px;
         z-index: 1;
      }

      .stats-card .text-white-60 {
         color: #666 !important;
      }

      .stats-card .text-white {
         color: #333 !important;
      }

      .stats-card .text-white-60.small {
         color: #999 !important;
      }

      .card-header {
         background-color: white !important;
         color: #333;
         position: relative;
         overflow: hidden;

      }

      .card-header::before {
         content: '';
         position: absolute;
         left: 0;
         top: 0;
         bottom: 0;
         width: 4px;
         border-radius: 4px 0 0 4px;
         z-index: 1;
      }

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

         <!-- Dashboard Content -->
         <div class="p-4">
            <!-- Stats Cards -->
            <div class="row mb-4">
               <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card stats-card border-0 shadow-sm">
                     <div class="card-body">
                        <div class="d-flex align-items-center">
                           <div class="flex-grow-1">
                              <div class="text-uppercase small fw-semibold mb-2">Total Ujian</div>
                              <div class="h2 mb-0 fw-bold text-white" id="totalUjian">0</div>
                              <div class="small text-white-60 mt-1">Semua ujian</div>
                           </div>
                           <div class="flex-shrink-0">
                              <i class="bi bi-file-text fs-1" style="color: #007bff;"></i>
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
                              <div class="text-uppercase small fw-semibold mb-2">Peserta Aktif</div>
                              <div class="h2 mb-0 fw-bold text-white" id="pesertaAktif">0</div>
                              <div class="small text-white-60 mt-1">Sedang aktif</div>
                           </div>
                           <div class="flex-shrink-0">
                              <i class="bi bi-people fs-1" style="color: #991B1B;"></i>
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
                              <div class="text-uppercase small fw-semibold mb-2">Ujian Hari Ini</div>
                              <div class="h2 mb-0 fw-bold text-white" id="ujianHariIni">0</div>
                              <div class="small text-white-60 mt-1">Hari ini</div>
                           </div>
                           <div class="flex-shrink-0">
                              <i class="bi bi-calendar-check fs-1" style="color: #ffc107;"></i>
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
                              <div class="text-uppercase small fw-semibold mb-2">Selesai</div>
                              <div class="h2 mb-0 fw-bold text-white" id="ujianSelesai">0</div>
                              <div class="small text-white-60 mt-1">Ujian selesai</div>
                           </div>
                           <div class="flex-shrink-0">
                              <i class="bi bi-check-circle fs-1" style="color: #28a745;"></i>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <!-- Recent Exams Table -->
            <div class="card">
               <div class="card-header">
                  <h6 class="m-0 font-weight-bold">Ujian Terbaru</h6>
               </div>
               <div class="card-body">
                  <div class="table-responsive">
                     <table class="table table-bordered">
                        <thead>
                           <tr>
                              <th>Nama Ujian</th>
                              <th>Tanggal</th>
                              <th>Peserta</th>
                              <th>Status</th>
                              <th>Aksi</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td>Ujian Matematika Dasar</td>
                              <td>2024-01-15</td>
                              <td>25</td>
                              <td><span class="badge bg-success">Selesai</span></td>
                              <td>
                                 <button class="theme-btn">Lihat</button>
                              </td>
                           </tr>
                           <tr>
                              <td>Ujian Bahasa Indonesia</td>
                              <td>2024-01-16</td>
                              <td>30</td>
                              <td><span class="badge bg-warning">Berlangsung</span></td>
                              <td>
                                 <button class="theme-btn">Lihat</button>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- Bootstrap JS -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

   @include('layouts.logout-script')

   <script>
      // CSRF Token is already declared in logout-script.blade.php

      // Load dashboard data from API
      async function loadDashboardData() {
         console.log('Loading dashboard data from API...');
         try {
            const response = await fetch('/admin/dashboard/data', {
               method: 'GET',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
               }
            });

            if (response.ok) {
               const result = await response.json();
               console.log('Dashboard API response:', result);

               if (result.success && result.data) {
                  updateDashboardStats(result.data);
                  return;
               }
            }

            console.log('Dashboard API failed, using fallback data');
            updateDashboardStats({
               total_ujian: 0,
               peserta_aktif: 0,
               ujian_hari_ini: 0,
               ujian_selesai: 0
            });
         } catch (error) {
            console.log('Error loading dashboard data:', error);
            updateDashboardStats({
               total_ujian: 0,
               peserta_aktif: 0,
               ujian_hari_ini: 0,
               ujian_selesai: 0
            });
         }
      }

      // Update dashboard statistics
      function updateDashboardStats(stats) {
         const totalUjianEl = document.getElementById('totalUjian');
         const pesertaAktifEl = document.getElementById('pesertaAktif');
         const ujianHariIniEl = document.getElementById('ujianHariIni');
         const ujianSelesaiEl = document.getElementById('ujianSelesai');

         if (totalUjianEl) totalUjianEl.textContent = stats.total_ujian || 0;
         if (pesertaAktifEl) pesertaAktifEl.textContent = stats.peserta_aktif || 0;
         if (ujianHariIniEl) ujianHariIniEl.textContent = stats.ujian_hari_ini || 0;
         if (ujianSelesaiEl) ujianSelesaiEl.textContent = stats.ujian_selesai || 0;

         console.log('Dashboard stats updated:', stats);
      }

      // Initialize user info
      function initializeUserInfo() {
         // Add any initialization logic here
      }

      // Initialize on page load
      document.addEventListener('DOMContentLoaded', function() {
         initializeUserInfo();
         loadDashboardData();
      });
   </script>
</body>

</html>