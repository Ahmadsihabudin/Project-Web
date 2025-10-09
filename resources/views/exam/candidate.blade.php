<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard Peserta - Ujian Online</title>
   <meta name="csrf-token" content="{{ csrf_token() }}">

   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   <!-- Bootstrap Icons -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
   <!-- Google Fonts -->
   <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

   @include('layouts.sidebar-styles')
   @include('layouts.alert-system')

   <style>
      .main-content {
         background-color: #f8f9fa;
         min-height: 100vh;
      }

      .stats-card {
         background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
         color: white;
         border: none;
         border-radius: 12px;
         box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      }

      .stats-card .card-body {
         padding: 1.5rem;
      }

      .stats-card .text-uppercase {
         font-size: 0.75rem;
         font-weight: 600;
         letter-spacing: 0.5px;
         opacity: 0.9;
      }

      .stats-card .h2 {
         font-size: 2rem;
         font-weight: 700;
         margin-bottom: 0.5rem;
      }

      .stats-card .small {
         font-size: 0.875rem;
         opacity: 0.8;
      }

      .btn-primary {
         background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
         border: none;
         border-radius: 8px;
         padding: 0.75rem 1.5rem;
         font-weight: 500;
         transition: all 0.3s ease;
      }

      .btn-primary:hover {
         transform: translateY(-2px);
         box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
      }

      .exam-card {
         background: white;
         border: 1px solid #e5e7eb;
         border-radius: 12px;
         transition: all 0.3s ease;
         cursor: pointer;
         box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
      }

      .exam-card:hover {
         transform: translateY(-4px);
         box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
         border-color: #667eea;
      }

      .exam-card .card-body {
         padding: 1.5rem;
      }

      .text-white-60 {
         color: rgba(255, 255, 255, 0.6) !important;
      }

      .text-white-80 {
         color: rgba(255, 255, 255, 0.8) !important;
      }

      .fs-1 {
         font-size: 3rem !important;
      }

      .fw-semibold {
         font-weight: 600 !important;
      }

      .fw-bold {
         font-weight: 700 !important;
      }

      /* Additional consistency styles */
      .card {
         border-radius: 12px;
         box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
      }

      .card-header {
         border-radius: 12px 12px 0 0 !important;
         border-bottom: 1px solid #e5e7eb;
      }

      .btn-outline-primary {
         border-color: #667eea;
         color: #667eea;
         border-radius: 8px;
         font-weight: 500;
         transition: all 0.3s ease;
      }

      .btn-outline-primary:hover {
         background-color: #667eea;
         border-color: #667eea;
         transform: translateY(-1px);
         box-shadow: 0 2px 4px rgba(102, 126, 234, 0.3);
      }

      .text-primary {
         color: #667eea !important;
      }

      .text-muted {
         color: #6c757d !important;
      }

      .bg-gradient-primary {
         background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
      }

      .border-warning {
         border-color: #ffc107 !important;
      }

      .alert-warning {
         background-color: #fff3cd;
         border-color: #ffc107;
      }

      .form-check-input:checked {
         background-color: #667eea;
         border-color: #667eea;
      }

      .form-check-input:focus {
         border-color: #667eea;
         box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.25);
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
            <!-- Welcome Message -->
            <div class="row mb-4">
               <div class="col-12">
                  <div class="card border-0 shadow-sm bg-gradient-primary text-white">
                     <div class="card-body text-center py-5">
                        <i class="bi bi-mortarboard fs-1 mb-3"></i>
                        <h2 class="fw-bold mb-3">Selamat Datang di Sistem Ujian Online</h2>
                        <p class="fs-5 mb-0">Silakan baca tata cara ujian dan peringatan di bawah ini sebelum memulai ujian</p>
                     </div>
                  </div>
               </div>
            </div>

            <!-- Exam Instructions -->
            <div class="row mb-4">
               <div class="col-12">
                  <div class="card border-0 shadow-sm">
                     <div class="card-header bg-white border-0 py-3">
                        <h5 class="m-0 fw-bold text-dark">
                           <i class="bi bi-info-circle me-2 text-primary"></i>
                           Tata Cara Ujian
                        </h5>
                     </div>
                     <div class="card-body">
                        <div class="row">
                           <div class="col-md-6 mb-3">
                              <div class="d-flex align-items-start">
                                 <div class="flex-shrink-0">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                       <span class="fw-bold">1</span>
                                    </div>
                                 </div>
                                 <div class="flex-grow-1 ms-3">
                                    <h6 class="fw-bold mb-2">Persiapan Ujian</h6>
                                    <p class="text-muted mb-0">Pastikan koneksi internet stabil dan perangkat dalam kondisi baik sebelum memulai ujian.</p>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6 mb-3">
                              <div class="d-flex align-items-start">
                                 <div class="flex-shrink-0">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                       <span class="fw-bold">2</span>
                                    </div>
                                 </div>
                                 <div class="flex-grow-1 ms-3">
                                    <h6 class="fw-bold mb-2">Durasi Ujian</h6>
                                    <p class="text-muted mb-0">Setiap ujian memiliki batas waktu tertentu. Pastikan untuk menyelesaikan semua soal dalam waktu yang ditentukan.</p>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6 mb-3">
                              <div class="d-flex align-items-start">
                                 <div class="flex-shrink-0">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                       <span class="fw-bold">3</span>
                                    </div>
                                 </div>
                                 <div class="flex-grow-1 ms-3">
                                    <h6 class="fw-bold mb-2">Navigasi Soal</h6>
                                    <p class="text-muted mb-0">Gunakan tombol navigasi untuk berpindah antar soal. Pastikan menjawab semua soal sebelum submit.</p>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6 mb-3">
                              <div class="d-flex align-items-start">
                                 <div class="flex-shrink-0">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                       <span class="fw-bold">4</span>
                                    </div>
                                 </div>
                                 <div class="flex-grow-1 ms-3">
                                    <h6 class="fw-bold mb-2">Submit Jawaban</h6>
                                    <p class="text-muted mb-0">Setelah selesai menjawab semua soal, klik tombol submit untuk mengirimkan jawaban Anda.</p>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <!-- Warning Notice -->
            <div class="row mb-4">
               <div class="col-12">
                  <div class="card border-0 shadow-sm border-warning">
                     <div class="card-header bg-warning text-dark border-0 py-3">
                        <h5 class="m-0 fw-bold">
                           <i class="bi bi-exclamation-triangle me-2"></i>
                           Peringatan Penting
                        </h5>
                     </div>
                     <div class="card-body">
                        <div class="alert alert-warning border-0 mb-0">
                           <h6 class="fw-bold mb-3">Perhatian! Harap baca dengan seksama:</h6>
                           <ul class="mb-3">
                              <li class="mb-2">Ujian ini bersifat <strong>terbatas waktu</strong> dan tidak dapat diulang</li>
                              <li class="mb-2">Dilarang keras melakukan <strong>kecurangan</strong> atau bekerja sama dengan peserta lain</li>
                              <li class="mb-2">Pastikan tidak ada gangguan selama ujian berlangsung</li>
                              <li class="mb-2">Jawaban yang sudah disubmit <strong>tidak dapat diubah</strong></li>
                              <li class="mb-2">Sistem akan mencatat aktivitas ujian untuk keperluan monitoring</li>
                           </ul>
                           <div class="form-check">
                              <input class="form-check-input" type="checkbox" id="agreeTerms" required>
                              <label class="form-check-label fw-bold" for="agreeTerms">
                                 Saya telah membaca dan menyetujui semua peringatan di atas
                              </label>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <!-- Exam Status -->
            <div class="row" id="examStatusSection">
               <!-- Content will be loaded dynamically -->
            </div>
         </div>
      </div>
   </div>

   <!-- Bootstrap JS -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

   @include('layouts.logout-script')

   <script>
      // CSRF Token
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

      // Check exam status and load content
      async function loadExamStatus() {
         try {
            const response = await fetch('/candidate/exam/data', {
               method: 'GET',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
               }
            });

            const result = await response.json();
            const examStatusSection = document.getElementById('examStatusSection');

            if (result.success && result.exams && result.exams.length > 0) {
               // Show available exams
               examStatusSection.innerHTML = `
                  <div class="col-12">
                     <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-0 py-3">
                           <h5 class="m-0 fw-bold text-dark">
                              <i class="bi bi-file-text me-2 text-primary"></i>
                              Ujian Tersedia
                           </h5>
                        </div>
                        <div class="card-body">
                           <div class="row">
                              ${result.exams.map(exam => `
                                 <div class="col-md-6 mb-3">
                                    <div class="card exam-card h-100">
                                       <div class="card-body">
                                          <div class="d-flex align-items-center mb-3">
                                             <i class="bi bi-file-text fs-1 text-primary me-3"></i>
                                             <div>
                                                <h6 class="fw-bold mb-1">${exam.title || 'Ujian'}</h6>
                                                <small class="text-muted">${exam.subject || 'Mata Pelajaran'}</small>
                                             </div>
                                          </div>
                                          <p class="text-muted mb-3">${exam.description || 'Deskripsi ujian tidak tersedia'}</p>
                                          <div class="d-flex justify-content-between align-items-center">
                                             <small class="text-muted">
                                                <i class="bi bi-clock me-1"></i>
                                                ${exam.duration || '60'} menit
                                             </small>
                                             <button class="btn btn-primary btn-sm" onclick="startExam(${exam.id})" id="startExamBtn" disabled>
                                                <i class="bi bi-play-fill me-1"></i>
                                                Mulai Ujian
                                             </button>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              `).join('')}
                           </div>
                        </div>
                     </div>
                  </div>
               `;
            } else {
               // Show no exam message
               examStatusSection.innerHTML = `
                  <div class="col-12">
                     <div class="card border-0 shadow-sm">
                        <div class="card-body text-center py-5">
                           <i class="bi bi-exclamation-circle fs-1 text-warning mb-3"></i>
                           <h4 class="fw-bold text-dark mb-3">Tidak Ada Ujian Tersedia</h4>
                           <p class="text-muted mb-4">Belum ada ujian yang ditugaskan untuk Anda. Silakan hubungi staff untuk informasi lebih lanjut.</p>
                           <div class="alert alert-info border-0">
                              <h6 class="fw-bold mb-2">Kontak Staff</h6>
                              <p class="mb-0">Email: staff@ujian.com | Telepon: (021) 1234-5678</p>
                           </div>
                        </div>
                     </div>
                  </div>
               `;
            }
         } catch (error) {
            console.error('Error loading exam status:', error);
            document.getElementById('examStatusSection').innerHTML = `
               <div class="col-12">
                  <div class="alert alert-danger">
                     <i class="bi bi-exclamation-triangle me-2"></i>
                     Terjadi kesalahan saat memuat data ujian. Silakan refresh halaman.
                  </div>
               </div>
            `;
         }
      }

      // Handle agreement checkbox
      function handleAgreement() {
         const agreeCheckbox = document.getElementById('agreeTerms');
         const startExamBtns = document.querySelectorAll('#startExamBtn');

         agreeCheckbox.addEventListener('change', function() {
            startExamBtns.forEach(btn => {
               btn.disabled = !this.checked;
            });
         });
      }

      // Start exam function
      function startExam(examId) {
         if (!document.getElementById('agreeTerms').checked) {
            alert('Anda harus menyetujui peringatan terlebih dahulu!');
            return;
         }

         if (confirm('Apakah Anda yakin ingin memulai ujian? Pastikan Anda sudah siap.')) {
            window.location.href = `/candidate/exam/${examId}`;
         }
      }

      // Initialize on page load
      document.addEventListener('DOMContentLoaded', function() {
         loadExamStatus();
         handleAgreement();
      });
   </script>

</body>

</html>