<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Pengawas - Ujian Online</title>
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

      .stats-card {
         background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
         color: white;
         border: none;
      }

      .proctoring-card {
         transition: all 0.3s ease;
      }

      .proctoring-card:hover {
         transform: translateY(-2px);
         box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
      }

      .webcam-feed {
         background: #000;
         border-radius: 8px;
         overflow: hidden;
         position: relative;
      }

      .webcam-placeholder {
         width: 100%;
         height: 200px;
         background: #333;
         display: flex;
         align-items: center;
         justify-content: center;
         color: white;
      }

      .alert-item {
         border-left: 4px solid #dc3545;
         background: #f8d7da;
         padding: 1rem;
         margin-bottom: 1rem;
         border-radius: 0 8px 8px 0;
      }

      .alert-item.warning {
         border-left-color: #ffc107;
         background: #fff3cd;
      }

      .alert-item.info {
         border-left-color: #17a2b8;
         background: #d1ecf1;
      }
   </style>
</head>

<body>
   <div class="container-fluid">
      <div class="row">
         <!-- Sidebar -->
         <div class="col-md-3 col-lg-2 px-0">
            <div class="sidebar">
               <div class="p-3">
                  <h4 class="text-white mb-4">
                     <i class="bi bi-mortarboard me-2"></i>
                     Ujian Online
                  </h4>
                  <nav class="nav flex-column">
                     <a class="nav-link" href="/admin/dashboard">
                        <i class="bi bi-speedometer2 me-2"></i>
                        Dashboard
                     </a>
                     <a class="nav-link" href="/admin/users">
                        <i class="bi bi-people-fill me-2"></i>
                        Manajemen User
                     </a>
                     <a class="nav-link" href="/admin/participants">
                        <i class="bi bi-people me-2"></i>
                        Peserta
                     </a>
                     <a class="nav-link active" href="/admin/proctoring">
                        <i class="bi bi-eye me-2"></i>
                        Pengawas
                     </a>
                     <a class="nav-link" href="/admin/questions">
                        <i class="bi bi-question-circle me-2"></i>
                        Soal
                     </a>
                     <a class="nav-link" href="/admin/reports">
                        <i class="bi bi-graph-up me-2"></i>
                        Laporan
                     </a>
                     <a class="nav-link" href="/admin/settings">
                        <i class="bi bi-gear me-2"></i>
                        Pengaturan
                     </a>
                  </nav>
               </div>
            </div>
         </div>

         <!-- Main Content -->
         <div class="col-md-9 col-lg-10">
            <div class="main-content">
               <!-- Navbar -->
               <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
                  <div class="container-fluid">
                     <span class="navbar-brand mb-0 h1">Pengawas Langsung</span>
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

               <!-- Proctoring Content -->
               <div class="p-4">
                  <!-- Stats Cards -->
                  <div class="row mb-4">
                     <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card stats-card">
                           <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                 <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">Peserta Aktif</div>
                                    <div class="h5 mb-0 font-weight-bold">8</div>
                                 </div>
                                 <div class="col-auto">
                                    <i class="bi bi-people fa-2x text-white-50"></i>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card stats-card">
                           <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                 <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">Alert Hari Ini</div>
                                    <div class="h5 mb-0 font-weight-bold">3</div>
                                 </div>
                                 <div class="col-auto">
                                    <i class="bi bi-exclamation-triangle fa-2x text-white-50"></i>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card stats-card">
                           <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                 <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">Webcam Aktif</div>
                                    <div class="h5 mb-0 font-weight-bold">6</div>
                                 </div>
                                 <div class="col-auto">
                                    <i class="bi bi-camera-video fa-2x text-white-50"></i>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card stats-card">
                           <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                 <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">Selesai</div>
                                    <div class="h5 mb-0 font-weight-bold">2</div>
                                 </div>
                                 <div class="col-auto">
                                    <i class="bi bi-check-circle fa-2x text-white-50"></i>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="row">
                     <!-- Live Monitoring -->
                     <div class="col-md-8">
                        <div class="card proctoring-card">
                           <div class="card-header">
                              <h6 class="m-0 font-weight-bold">Monitoring Langsung</h6>
                           </div>
                           <div class="card-body">
                              <div class="row">
                                 <div class="col-md-6 mb-3">
                                    <div class="webcam-feed">
                                       <div class="webcam-placeholder">
                                          <div class="text-center">
                                             <i class="bi bi-camera-video fa-3x mb-2"></i>
                                             <p>Webcam Peserta 1</p>
                                             <small>Status: Aktif</small>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                       <div class="webcam-feed">
                                          <div class="webcam-placeholder">
                                             <div class="text-center">
                                                <i class="bi bi-camera-video fa-3x mb-2"></i>
                                                <p>Webcam Peserta 2</p>
                                                <small>Status: Aktif</small>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-md-6 mb-3">
                                          <div class="webcam-feed">
                                             <div class="webcam-placeholder">
                                                <div class="text-center">
                                                   <i class="bi bi-camera-video-off fa-3x mb-2"></i>
                                                   <p>Webcam Peserta 3</p>
                                                   <small>Status: Nonaktif</small>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-md-6 mb-3">
                                             <div class="webcam-feed">
                                                <div class="webcam-placeholder">
                                                   <div class="text-center">
                                                      <i class="bi bi-camera-video fa-3x mb-2"></i>
                                                      <p>Webcam Peserta 4</p>
                                                      <small>Status: Aktif</small>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>

                                 <!-- Alerts & Controls -->
                                 <div class="col-md-4">
                                    <div class="card proctoring-card">
                                       <div class="card-header">
                                          <h6 class="m-0 font-weight-bold">Alert & Kontrol</h6>
                                       </div>
                                       <div class="card-body">
                                          <div class="alert-item">
                                             <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                   <strong>Peserta Ahmad Rizki</strong>
                                                   <p class="mb-1">Terdeteksi menoleh ke samping</p>
                                                   <small class="text-muted">2 menit yang lalu</small>
                                                </div>
                                                <button class="btn btn-sm btn-outline-danger">Tindak</button>
                                             </div>
                                          </div>

                                          <div class="alert-item warning">
                                             <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                   <strong>Peserta Siti Nurhaliza</strong>
                                                   <p class="mb-1">Webcam terputus</p>
                                                   <small class="text-muted">5 menit yang lalu</small>
                                                </div>
                                                <button class="btn btn-sm btn-outline-warning">Periksa</button>
                                             </div>
                                          </div>

                                          <div class="alert-item info">
                                             <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                   <strong>Peserta Budi Santoso</strong>
                                                   <p class="mb-1">Mengajukan pertanyaan</p>
                                                   <small class="text-muted">10 menit yang lalu</small>
                                                </div>
                                                <button class="btn btn-sm btn-outline-info">Jawab</button>
                                             </div>
                                          </div>
                                       </div>
                                    </div>

                                    <!-- Quick Actions -->
                                    <div class="card proctoring-card mt-3">
                                       <div class="card-header">
                                          <h6 class="m-0 font-weight-bold">Aksi Cepat</h6>
                                       </div>
                                       <div class="card-body">
                                          <div class="d-grid gap-2">
                                             <button class="btn btn-outline-primary">
                                                <i class="bi bi-broadcast me-2"></i>
                                                Broadcast Pesan
                                             </button>
                                             <button class="btn btn-outline-warning">
                                                <i class="bi bi-pause-circle me-2"></i>
                                                Pause Ujian
                                             </button>
                                             <button class="btn btn-outline-danger">
                                                <i class="bi bi-stop-circle me-2"></i>
                                                Stop Ujian
                                             </button>
                                          </div>
                                       </div>
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