<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Bank Soal - Ujian Online</title>
   <meta name="csrf-token" content="{{ csrf_token() }}">

   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   <!-- Bootstrap Icons -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

   @include('layouts.sidebar-styles')
   @include('layouts.alert-system')

   <style>
      .question-card {
         transition: all 0.3s ease;
      }

      .question-card:hover {
         transform: translateY(-2px);
         box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
      }

      .difficulty-easy {
         border-left: 4px solid #28a745;
      }

      .difficulty-medium {
         border-left: 4px solid #ffc107;
      }

      .difficulty-hard {
         border-left: 4px solid #dc3545;
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

         <!-- Questions Content -->
         <div class="p-4">
            <!-- Stats Cards -->
            <div class="row mb-4">
               <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card stats-card border-0 shadow-sm">
                     <div class="card-body">
                        <div class="d-flex align-items-center">
                           <div class="flex-grow-1">
                              <div class="text-uppercase text-white-60 small fw-semibold mb-2">Total Soal</div>
                              <div class="h2 mb-0 fw-bold text-white">156</div>
                              <div class="small text-white-60 mt-1">Semua soal</div>
                           </div>
                           <div class="flex-shrink-0">
                              <i class="bi bi-question-circle fs-1 text-white-60"></i>
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
                              <div class="text-uppercase text-white-60 small fw-semibold mb-2">Mudah</div>
                              <div class="h2 mb-0 fw-bold text-white">45</div>
                              <div class="small text-white-60 mt-1">Level mudah</div>
                           </div>
                           <div class="flex-shrink-0">
                              <i class="bi bi-check-circle fs-1 text-white-60"></i>
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
                              <div class="text-uppercase text-white-60 small fw-semibold mb-2">Sedang</div>
                              <div class="h2 mb-0 fw-bold text-white">78</div>
                              <div class="small text-white-60 mt-1">Level sedang</div>
                           </div>
                           <div class="flex-shrink-0">
                              <i class="bi bi-exclamation-circle fs-1 text-white-60"></i>
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
                              <div class="text-uppercase text-white-60 small fw-semibold mb-2">Sulit</div>
                              <div class="h2 mb-0 fw-bold text-white">33</div>
                              <div class="small text-white-60 mt-1">Level sulit</div>
                           </div>
                           <div class="flex-shrink-0">
                              <i class="bi bi-x-circle fs-1 text-white-60"></i>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <!-- Search and Filter -->
            <div class="card mb-4">
               <div class="card-body">
                  <div class="row">
                     <div class="col-md-4">
                        <div class="input-group">
                           <span class="input-group-text">
                              <i class="bi bi-search"></i>
                           </span>
                           <input type="text" class="form-control" placeholder="Cari soal...">
                        </div>
                     </div>
                     <div class="col-md-3">
                        <select class="form-select">
                           <option>Semua Kategori</option>
                           <option>Matematika</option>
                           <option>Bahasa Indonesia</option>
                           <option>Fisika</option>
                           <option>Kimia</option>
                        </select>
                     </div>
                     <div class="col-md-3">
                        <select class="form-select">
                           <option>Semua Tingkat</option>
                           <option>Mudah</option>
                           <option>Sedang</option>
                           <option>Sulit</option>
                        </select>
                     </div>
                     <div class="col-md-2">
                        <button class="btn btn-primary w-100">
                           <i class="bi bi-plus-circle me-1"></i>
                           Tambah
                        </button>
                     </div>
                  </div>
               </div>
            </div>

            <!-- Questions List -->
            <div class="row">
               <div class="col-md-8">
                  <div class="card question-card difficulty-easy">
                     <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                           <div>
                              <h6 class="card-title mb-1">Soal #001</h6>
                              <span class="badge bg-success">Mudah</span>
                              <span class="badge bg-primary ms-2">Matematika</span>
                           </div>
                           <div class="dropdown">
                              <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                 <i class="bi bi-three-dots"></i>
                              </button>
                              <ul class="dropdown-menu">
                                 <li><a class="dropdown-item" href="#">Edit</a></li>
                                 <li><a class="dropdown-item" href="#">Duplikat</a></li>
                                 <li>
                                    <hr class="dropdown-divider">
                                 </li>
                                 <li><a class="dropdown-item text-danger" href="#">Hapus</a></li>
                              </ul>
                           </div>
                        </div>
                        <p class="card-text">Berapakah hasil dari 15 + 27?</p>
                        <div class="row">
                           <div class="col-md-6">
                              <small class="text-muted">A. 40</small>
                           </div>
                           <div class="col-md-6">
                              <small class="text-muted">B. 42</small>
                           </div>
                           <div class="col-md-6">
                              <small class="text-muted">C. 32</small>
                           </div>
                           <div class="col-md-6">
                              <small class="text-success"><strong>D. 42 (Benar)</strong></small>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="card question-card difficulty-medium">
                     <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                           <div>
                              <h6 class="card-title mb-1">Soal #002</h6>
                              <span class="badge bg-warning">Sedang</span>
                              <span class="badge bg-info ms-2">Bahasa Indonesia</span>
                           </div>
                           <div class="dropdown">
                              <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                 <i class="bi bi-three-dots"></i>
                              </button>
                              <ul class="dropdown-menu">
                                 <li><a class="dropdown-item" href="#">Edit</a></li>
                                 <li><a class="dropdown-item" href="#">Duplikat</a></li>
                                 <li>
                                    <hr class="dropdown-divider">
                                 </li>
                                 <li><a class="dropdown-item text-danger" href="#">Hapus</a></li>
                              </ul>
                           </div>
                        </div>
                        <p class="card-text">Manakah yang merupakan kalimat efektif?</p>
                        <div class="row">
                           <div class="col-md-6">
                              <small class="text-muted">A. Saya pergi ke sekolah dengan berjalan kaki</small>
                           </div>
                           <div class="col-md-6">
                              <small class="text-success"><strong>B. Saya berjalan kaki ke sekolah (Benar)</strong></small>
                           </div>
                           <div class="col-md-6">
                              <small class="text-muted">C. Saya pergi ke sekolah dengan cara berjalan kaki</small>
                           </div>
                           <div class="col-md-6">
                              <small class="text-muted">D. Saya pergi ke sekolah dengan berjalan kaki dengan kaki</small>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="card question-card difficulty-hard">
                     <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                           <div>
                              <h6 class="card-title mb-1">Soal #003</h6>
                              <span class="badge bg-danger">Sulit</span>
                              <span class="badge bg-secondary ms-2">Fisika</span>
                           </div>
                           <div class="dropdown">
                              <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                 <i class="bi bi-three-dots"></i>
                              </button>
                              <ul class="dropdown-menu">
                                 <li><a class="dropdown-item" href="#">Edit</a></li>
                                 <li><a class="dropdown-item" href="#">Duplikat</a></li>
                                 <li>
                                    <hr class="dropdown-divider">
                                 </li>
                                 <li><a class="dropdown-item text-danger" href="#">Hapus</a></li>
                              </ul>
                           </div>
                        </div>
                        <p class="card-text">Sebuah benda bermassa 2 kg bergerak dengan kecepatan 10 m/s. Berapakah energi kinetiknya?</p>
                        <div class="row">
                           <div class="col-md-6">
                              <small class="text-muted">A. 20 J</small>
                           </div>
                           <div class="col-md-6">
                              <small class="text-muted">B. 40 J</small>
                           </div>
                           <div class="col-md-6">
                              <small class="text-success"><strong>C. 100 J (Benar)</strong></small>
                           </div>
                           <div class="col-md-6">
                              <small class="text-muted">D. 200 J</small>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <!-- Categories Sidebar -->
               <div class="col-md-4">
                  <div class="card">
                     <div class="card-header">
                        <h6 class="m-0 font-weight-bold">Kategori Soal</h6>
                     </div>
                     <div class="card-body">
                        <div class="list-group list-group-flush">
                           <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                              Matematika
                              <span class="badge bg-primary rounded-pill">45</span>
                           </a>
                           <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                              Bahasa Indonesia
                              <span class="badge bg-primary rounded-pill">32</span>
                           </a>
                           <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                              Fisika
                              <span class="badge bg-primary rounded-pill">28</span>
                           </a>
                           <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                              Kimia
                              <span class="badge bg-primary rounded-pill">25</span>
                           </a>
                           <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                              Biologi
                              <span class="badge bg-primary rounded-pill">26</span>
                           </a>
                        </div>
                     </div>
                  </div>

                  <!-- Recent Activity -->
                  <div class="card mt-3">
                     <div class="card-header">
                        <h6 class="m-0 font-weight-bold">Aktivitas Terbaru</h6>
                     </div>
                     <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                           <div class="flex-shrink-0">
                              <i class="bi bi-plus-circle text-success"></i>
                           </div>
                           <div class="flex-grow-1 ms-3">
                              <small>Soal baru ditambahkan</small>
                              <br><small class="text-muted">2 jam yang lalu</small>
                           </div>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                           <div class="flex-shrink-0">
                              <i class="bi bi-pencil text-warning"></i>
                           </div>
                           <div class="flex-grow-1 ms-3">
                              <small>Soal #001 diedit</small>
                              <br><small class="text-muted">4 jam yang lalu</small>
                           </div>
                        </div>
                        <div class="d-flex align-items-center">
                           <div class="flex-shrink-0">
                              <i class="bi bi-trash text-danger"></i>
                           </div>
                           <div class="flex-grow-1 ms-3">
                              <small>Soal #045 dihapus</small>
                              <br><small class="text-muted">1 hari yang lalu</small>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <!-- Pagination -->
            <nav aria-label="Page navigation" class="mt-4">
               <ul class="pagination justify-content-center">
                  <li class="page-item disabled">
                     <a class="page-link" href="#" tabindex="-1">Previous</a>
                  </li>
                  <li class="page-item active"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                     <a class="page-link" href="#">Next</a>
                  </li>
               </ul>
            </nav>
         </div>
      </div>
   </div>

   <!-- Bootstrap JS -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

   @include('layouts.logout-script')

   <script>
      // CSRF Token
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

      // Question CRUD Functions
      function addQuestion() {
         alertSystem.info('Fitur', 'Fitur tambah soal akan segera tersedia!');
      }

      function editQuestion(id) {
         alertSystem.info('Fitur', 'Fitur edit soal akan segera tersedia!');
      }

      function deleteQuestion(id) {
         if (confirm('Apakah Anda yakin ingin menghapus soal ini?')) {
            const loadingAlert = alertSystem.loading('Menghapus soal...');

            setTimeout(() => {
               alertSystem.hide(loadingAlert);
               alertSystem.deleteSuccess('Soal');
            }, 1500);
         }
      }

      function toggleQuestionStatus(id) {
         const loadingAlert = alertSystem.loading('Mengubah status soal...');

         setTimeout(() => {
            alertSystem.hide(loadingAlert);
            alertSystem.updateSuccess('Status Soal');
         }, 1000);
      }

      // Make functions globally available
      window.addQuestion = addQuestion;
      window.editQuestion = editQuestion;
      window.deleteQuestion = deleteQuestion;
      window.toggleQuestionStatus = toggleQuestionStatus;

      // Logout function is included from layouts.logout-script
   </script>
</body>

</html>