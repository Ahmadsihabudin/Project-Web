<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Manajemen Soal - Ujian Online</title>
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

      /* Question Card Styling */
      .question-card {
         background: #fff;
         border: 1px solid #e9ecef;
         border-radius: 0.5rem;
         padding: 1.5rem;
         margin-bottom: 1rem;
         box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
         transition: box-shadow 0.3s ease;
      }

      .question-card:hover {
         box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
      }

      .question-header {
         border-bottom: 1px solid #e9ecef;
         padding-bottom: 1rem;
         margin-bottom: 1rem;
      }

      .question-meta .badge {
         font-size: 0.75rem;
         padding: 0.375rem 0.75rem;
      }

      .question-text {
         font-size: 1.1rem;
         line-height: 1.6;
         color: #333;
      }

      .options-container {
         margin-top: 1rem;
      }

      .option-item {
         display: flex;
         align-items: center;
         padding: 0.75rem 1rem;
         margin-bottom: 0.5rem;
         background: #f8f9fa;
         border: 1px solid #e9ecef;
         border-radius: 0.375rem;
         transition: all 0.3s ease;
      }

      .option-item:hover {
         background: #e9ecef;
      }

      .option-item.correct-answer {
         background: #d1edff;
         border-color: #0d6efd;
         border-left: 4px solid #0d6efd;
      }

      .option-label {
         font-weight: 600;
         color: #495057;
         margin-right: 0.75rem;
         min-width: 1.5rem;
      }

      .option-text {
         flex: 1;
         color: #333;
      }

      .correct-badge {
         background: #198754;
         color: white;
         padding: 0.25rem 0.5rem;
         border-radius: 0.25rem;
         font-size: 0.75rem;
         font-weight: 600;
         margin-left: 0.5rem;
      }

      .answer-section {
         background: #f8f9fa;
         padding: 1rem;
         border-radius: 0.375rem;
         border-left: 4px solid #198754;
      }

      .answer-label {
         font-weight: 600;
         color: #495057;
         margin-bottom: 0.5rem;
         font-size: 0.9rem;
      }

      .answer-text {
         color: #333;
         font-size: 1rem;
         line-height: 1.5;
      }

      /* Responsive table */
      @media (max-width: 768px) {
         .table-responsive {
            border: none;
         }

         .question-card {
            padding: 1rem;
         }

         .question-meta {
            flex-direction: column;
            align-items: flex-start !important;
         }

         .question-meta .badge {
            margin-bottom: 0.25rem;
            margin-right: 0.25rem;
         }

         .action-buttons {
            margin-top: 0.5rem;
         }
      }

      /* Umpan Balik Styling */
      .umpan-balik-section {
         background: #f8f9fa;
         border: 1px solid #e9ecef;
         border-radius: 0.375rem;
         padding: 1rem;
         margin-top: 1rem;
      }

      .umpan-balik-label {
         color: #6c757d;
         font-size: 0.875rem;
         margin-bottom: 0.5rem;
         display: flex;
         align-items: center;
      }

      .umpan-balik-label i {
         color: #ffc107;
      }

      .umpan-balik-content {
         color: #495057;
         font-size: 0.9rem;
         line-height: 1.5;
         white-space: pre-wrap;
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


            <!-- Statistics Cards -->
            <div class="row mb-4" id="statsCards">
               <!-- Stats will be loaded here -->
            </div>

            <!-- Questions Table -->
            <div class="card">
               <div class="card-header d-flex justify-content-between align-items-center">
                  <h6 class="m-0 font-weight-bold">Daftar Soal</h6>
                  <div class="btn-group" role="group" style="gap: 0.5rem;">
                     <button type="button" class="theme-btn" data-bs-toggle="modal" data-bs-target="#importModal">
                        <i class="bi bi-upload me-1"></i>
                        Import Soal
                     </button>
                     <a href="{{ route('admin.questions.create') }}" class="theme-btn">
                        <i class="bi bi-plus-circle me-1"></i>
                        Tambah Soal
                     </a>
                  </div>
               </div>
               <div class="card-body">
                  <div class="questions-container" id="questionsTable">
                     <div class="questions-list">
                        <!-- Data will be loaded here -->
                     </div>
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
            const response = await fetch('/admin/questions/stats', {
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
                        <i class="bi bi-question-circle-fill" style="font-size: 2rem; color: #007bff;"></i>
                     </div>
                     <div class="flex-grow-1 ms-3">
                        <h5 class="mb-0">${stats.total}</h5>
                        <p class="text-muted mb-0">Total Soal</p>
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
                        <i class="bi bi-tags-fill" style="font-size: 2rem; color: #ffc107;"></i>
                     </div>
                     <div class="flex-grow-1 ms-3">
                        <h5 class="mb-0">${stats.by_category ? stats.by_category.length : 0}</h5>
                        <p class="text-muted mb-0">Kategori</p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-3">
               <div class="stats-card">
                  <div class="d-flex align-items-center">
                     <div class="flex-shrink-0">
                        <i class="bi bi-bar-chart-fill" style="font-size: 2rem; color: #17a2b8;"></i>
                     </div>
                     <div class="flex-grow-1 ms-3">
                        <h5 class="mb-0">${stats.by_difficulty ? stats.by_difficulty.length : 0}</h5>
                        <p class="text-muted mb-0">Level</p>
                     </div>
                  </div>
               </div>
               </div>
            `;

         document.getElementById('statsCards').innerHTML = statsHtml;
      }

      // Load questions data
      async function loadQuestions() {
         try {
            const response = await fetch('/admin/questions/data', {
               method: 'GET',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
               }
            });

            if (response.ok) {
               const result = await response.json();
               if (result.success) {
                  displayQuestions(result.data);
               }
            }
         } catch (error) {
            console.error('Error loading questions:', error);
         }
      }

      // Display questions
      function displayQuestions(questions) {
         const container = document.querySelector('.questions-list');
         container.innerHTML = '';

         questions.forEach((question, index) => {
            // Generate question content based on type
            let questionContent = '';
            if (question.tipe_soal === 'pilihan_ganda') {
               questionContent = generateMultipleChoiceDisplay(question);
            } else if (question.tipe_soal === 'essay') {
               questionContent = generateEssayDisplay(question);
            }

            // Add umpan balik if exists
            if (question.umpan_balik && question.umpan_balik.trim() !== '') {
               questionContent += `
                  <div class="umpan-balik-section mt-3">
                     <div class="umpan-balik-label">
                        <i class="bi bi-lightbulb me-1"></i>
                        <strong>Umpan Balik:</strong>
                     </div>
                     <div class="umpan-balik-content">
                        ${question.umpan_balik}
                     </div>
                  </div>
               `;
            }

            const questionCard = document.createElement('div');
            questionCard.innerHTML = `
               <div class="question-card">
                  <div class="question-header">
                     <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="question-meta">
                           <span class="badge bg-primary me-2">Soal ${index + 1}</span>
                           <span class="badge bg-secondary me-2">${question.mata_pelajaran || 'Umum'}</span>
                           <span class="badge bg-info me-2">${getTipeSoalText(question.tipe_soal)}</span>
                           <span class="badge bg-warning me-2">${question.batch || 'Batch'}</span>
                           <span class="badge bg-success">${question.poin} Poin</span>
                        </div>
                  <div class="action-buttons">
                           <a href="/admin/questions/${question.id}/edit" class="btn btn-warning btn-sm" title="Edit">
                        <i class="bi bi-pencil"></i>
                     </a>
                           <button class="btn btn-danger btn-sm" onclick="deleteQuestion(${question.id})" title="Hapus">
                        <i class="bi bi-trash"></i>
                     </button>
                        </div>
                     </div>
                  </div>
                  <div class="question-content">
                     ${questionContent}
                  </div>
               </div>
            `;
            container.appendChild(questionCard);
         });
      }

      // Generate multiple choice display
      function generateMultipleChoiceDisplay(question) {
         const options = [{
               key: 'A',
               value: question.opsi_a
            },
            {
               key: 'B',
               value: question.opsi_b
            },
            {
               key: 'C',
               value: question.opsi_c
            },
            {
               key: 'D',
               value: question.opsi_d
            },
            {
               key: 'E',
               value: question.opsi_e
            },
            {
               key: 'F',
               value: question.opsi_f
            }
         ].filter(option => option.value && option.value.trim() !== '');

         const optionsHtml = options.map(option => {
            const isCorrect = option.key.toLowerCase() === question.jawaban_benar;
            return `
               <div class="option-item ${isCorrect ? 'correct-answer' : ''}">
                  <span class="option-label">${option.key}.</span>
                  <span class="option-text">${option.value}</span>
                  ${isCorrect ? '<span class="correct-badge"><i class="bi bi-check-circle-fill"></i> Benar</span>' : ''}
               </div>
            `;
         }).join('');

         return `
            <div class="question-text mb-3">
               <strong>${question.pertanyaan}</strong>
            </div>
            <div class="options-container">
               ${optionsHtml}
            </div>
         `;
      }

      // Generate essay display
      function generateEssayDisplay(question) {
         return `
            <div class="question-text mb-3">
               <strong>${question.pertanyaan}</strong>
            </div>
            <div class="answer-section">
               <div class="answer-label">Jawaban Benar:</div>
               <div class="answer-text">${question.jawaban_benar}</div>
            </div>
         `;
      }

      // Generate true/false display
      function generateTrueFalseDisplay(question) {
         const isTrue = question.jawaban_benar.toLowerCase() === 'benar' || question.jawaban_benar.toLowerCase() === 'true';
         return `
            <div class="question-text mb-3">
               <strong>${question.pertanyaan}</strong>
            </div>
            <div class="answer-section">
               <div class="answer-label">Jawaban Benar:</div>
               <div class="answer-text">
                  <span class="badge ${isTrue ? 'bg-success' : 'bg-danger'} fs-6">
                     ${isTrue ? 'Benar' : 'Salah'}
                  </span>
               </div>
            </div>
         `;
      }

      // Get tipe soal text
      function getTipeSoalText(tipeSoal) {
         const tipeMap = {
            'pilihan_ganda': 'Pilihan Ganda',
            'essay': 'Essay'
         };
         return tipeMap[tipeSoal] || tipeSoal;
      }


      // Delete question
      async function deleteQuestion(id) {
         if (confirm('Apakah Anda yakin ingin menghapus soal ini?')) {
            try {
               const response = await fetch(`/admin/questions/${id}`, {
                  method: 'DELETE',
                  headers: {
                     'Content-Type': 'application/json',
                     'X-CSRF-TOKEN': csrfToken
                  }
               });

               const result = await response.json();

               if (result.success) {
                  alertSystem.deleteSuccess('Soal');
                  loadQuestions();
                  loadStats();
               } else {
                  alertSystem.error('Gagal menghapus soal', result.message);
               }
            } catch (error) {
               console.error('Error deleting question:', error);
               alertSystem.error('Gagal menghapus soal', 'Terjadi kesalahan jaringan');
            }
         }
      }

      // Initialize on page load
      document.addEventListener('DOMContentLoaded', function() {
         console.log('DOM Content Loaded');
         loadStats();
         loadQuestions();
      });

      // Download template function
      function downloadTemplate() {
         window.location.href = '{{ route("admin.questions.import.template") }}';
      }

      // Import soal function
      async function importSoal() {
         const fileInput = document.getElementById('importFile');
         const file = fileInput.files[0];

         if (!file) {
            alert('Pilih file Excel terlebih dahulu!');
            return;
         }

         const formData = new FormData();
         formData.append('file', file);
         formData.append('_token', csrfToken);

         const loadingAlert = alertSystem.loading('Mengimpor soal...');

         try {
            const response = await fetch('{{ route("admin.questions.import") }}', {
               method: 'POST',
               body: formData
            });

            const result = await response.json();

            if (result.success) {
               alertSystem.success('Import Berhasil!', result.message);
               loadQuestions();
               loadStats();

               // Close modal
               const modal = bootstrap.Modal.getInstance(document.getElementById('importModal'));
               modal.hide();

               // Reset form
               document.getElementById('importForm').reset();
            } else {
               if (result.errors && result.errors.length > 0) {
                  let errorMessage = result.message + '\n\nDetail kesalahan:\n';
                  result.errors.forEach((error, index) => {
                     if (index < 5) { // Show max 5 errors
                        errorMessage += `Baris ${error.row}: ${error.errors.join(', ')}\n`;
                     }
                  });
                  if (result.errors.length > 5) {
                     errorMessage += `... dan ${result.errors.length - 5} kesalahan lainnya.`;
                  }
                  alert(errorMessage);
               } else {
                  alertSystem.error('Import Gagal!', result.message);
               }
            }
         } catch (error) {
            console.error('Error importing questions:', error);
            alertSystem.error('Import Gagal!', 'Terjadi kesalahan jaringan');
         } finally {
            alertSystem.hide(loadingAlert);
         }
      }
   </script>

   <!-- Import Modal -->
   <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="importModalLabel">
                  <i class="bi bi-upload me-2"></i>Import Soal
               </h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <div class="alert alert-info">
                  <i class="bi bi-info-circle me-2"></i>
                  <strong>Petunjuk Import:</strong>
                  <ul class="mb-0 mt-2">
                     <li><strong>1. Klik "Download Template"</strong> untuk mendapatkan file Excel</li>
                     <li><strong>2. Isi data</strong> sesuai dengan format template</li>
                     <li><strong>3. Pertanyaan tidak boleh sama (duplikasi)</strong></li>
                     <li>Sistem akan mengecek duplikasi dalam file dan database</li>
                     <li><strong>4. Upload file Excel</strong> yang sudah diisi</li>
                     <li>Maksimal ukuran file: 10MB</li>
                  </ul>
               </div>

               <form id="importForm">
                  <div class="mb-3">
                     <label for="importFile" class="form-label fw-bold">Pilih File Excel</label>
                     <input type="file" class="form-control" id="importFile" accept=".xlsx,.xls,.csv" required>
                     <div class="form-text">Format yang didukung: .xlsx, .xls, .csv</div>
                  </div>
               </form>
            </div>
            <div class="modal-footer">
               <button type="button" class="theme-btn" onclick="downloadTemplate()">
                  <i class="bi bi-download me-1"></i>Download Template
               </button>
               <button type="button" class="theme-btn" data-bs-dismiss="modal">Batal</button>
               <button type="button" class="theme-btn" onclick="importSoal()">
                  <i class="bi bi-upload me-1"></i>Import Soal
               </button>
            </div>
         </div>
      </div>
   </div>

   @include('layouts.logout-script')

</body>

</html>