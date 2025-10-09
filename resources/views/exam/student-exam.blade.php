<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Ujian Online - Peserta</title>
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

      .exam-card {
         background: white;
         border-radius: 15px;
         box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
         border: none;
         transition: transform 0.3s ease;
      }

      .exam-card:hover {
         transform: translateY(-5px);
         box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
      }

      .exam-status {
         position: absolute;
         top: 15px;
         right: 15px;
         padding: 5px 12px;
         border-radius: 20px;
         font-size: 12px;
         font-weight: 600;
      }

      .status-available {
         background-color: #d4edda;
         color: #155724;
      }

      .status-ongoing {
         background-color: #fff3cd;
         color: #856404;
      }

      .status-completed {
         background-color: #d1ecf1;
         color: #0c5460;
      }

      .status-expired {
         background-color: #f8d7da;
         color: #721c24;
      }

      .btn-primary {
         background-color: #16A34A;
         border-color: #16A34A;
      }

      .btn-primary:hover {
         background-color: #15803D;
         border-color: #15803D;
      }

      .btn-success {
         background-color: #16A34A;
         border-color: #16A34A;
      }

      .btn-success:hover {
         background-color: #15803D;
         border-color: #15803D;
      }

      .exam-timer {
         background: linear-gradient(135deg, #16A34A 0%, #22C55E 100%);
         color: white;
         padding: 15px;
         border-radius: 10px;
         text-align: center;
         margin-bottom: 20px;
      }

      .timer-display {
         font-size: 24px;
         font-weight: bold;
         font-family: 'Courier New', monospace;
      }

      .question-card {
         background: white;
         border-radius: 10px;
         padding: 20px;
         margin-bottom: 20px;
         box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      }

      .option-item {
         background: #f8f9fa;
         border: 2px solid #e9ecef;
         border-radius: 8px;
         padding: 15px;
         margin-bottom: 10px;
         cursor: pointer;
         transition: all 0.3s ease;
      }

      .option-item:hover {
         background: #e3f2fd;
         border-color: #16A34A;
      }

      .option-item.selected {
         background: #16A34A;
         color: white;
         border-color: #16A34A;
      }

      .progress-bar {
         background-color: #16A34A;
      }

      .navbar-brand {
         color: #16A34A !important;
         font-weight: bold;
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
                     <a class="nav-link" href="/candidate/dashboard">
                        <i class="bi bi-speedometer2 me-2"></i>
                        Dashboard
                     </a>
                     <a class="nav-link active" href="/candidate/exam">
                        <i class="bi bi-file-text me-2"></i>
                        Ujian
                     </a>
                     <a class="nav-link" href="/candidate/profile">
                        <i class="bi bi-person me-2"></i>
                        Profil
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
                     <span class="navbar-brand mb-0 h1">Ujian Online</span>
                     <div class="navbar-nav ms-auto">
                        <div class="nav-item dropdown">
                           <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                              <i class="bi bi-person-circle me-1"></i>
                              Peserta
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

               <!-- Content -->
               <div class="p-4">
                  <!-- Timer Section (akan muncul saat ujian aktif) -->
                  <div id="timerSection" class="exam-timer" style="display: none;">
                     <div class="row align-items-center">
                        <div class="col-md-6">
                           <h5 class="mb-0">Ujian Sedang Berlangsung</h5>
                           <small>Waktu tersisa:</small>
                        </div>
                        <div class="col-md-6">
                           <div class="timer-display" id="timerDisplay">00:00:00</div>
                        </div>
                     </div>
                  </div>

                  <!-- Available Exams -->
                  <div id="examListSection">
                     <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2>Daftar Ujian Tersedia</h2>
                        <button class="btn btn-primary" onclick="loadExams()">
                           <i class="bi bi-arrow-clockwise me-2"></i>
                           Refresh
                        </button>
                     </div>

                     <div class="row" id="examList">
                        <!-- Exam cards will be loaded here -->
                     </div>
                  </div>

                  <!-- Exam Interface (akan muncul saat ujian dimulai) -->
                  <div id="examInterface" style="display: none;">
                     <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 id="examTitle">Ujian</h2>
                        <button class="btn btn-danger" onclick="confirmSubmit()">
                           <i class="bi bi-check-circle me-2"></i>
                           Selesai Ujian
                        </button>
                     </div>

                     <!-- Progress Bar -->
                     <div class="mb-4">
                        <div class="d-flex justify-content-between mb-2">
                           <span>Progress Ujian</span>
                           <span id="progressText">0/0</span>
                        </div>
                        <div class="progress">
                           <div class="progress-bar" role="progressbar" style="width: 0%" id="progressBar"></div>
                        </div>
                     </div>

                     <!-- Question Navigation -->
                     <div class="mb-4">
                        <div class="d-flex flex-wrap gap-2" id="questionNav">
                           <!-- Question navigation buttons will be generated here -->
                        </div>
                     </div>

                     <!-- Question Content -->
                     <div id="questionContent">
                        <!-- Question will be loaded here -->
                     </div>

                     <!-- Navigation Buttons -->
                     <div class="d-flex justify-content-between mt-4">
                        <button class="btn btn-outline-primary" id="prevBtn" onclick="previousQuestion()" disabled>
                           <i class="bi bi-chevron-left me-2"></i>
                           Sebelumnya
                        </button>
                        <button class="btn btn-outline-primary" id="nextBtn" onclick="nextQuestion()">
                           Selanjutnya
                           <i class="bi bi-chevron-right ms-2"></i>
                        </button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- Submit Confirmation Modal -->
   <div class="modal fade" id="submitModal" tabindex="-1">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title">Konfirmasi Selesai Ujian</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
               <p>Apakah Anda yakin ingin menyelesaikan ujian ini?</p>
               <p class="text-muted">Pastikan Anda telah menjawab semua pertanyaan sebelum mengirim.</p>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
               <button type="button" class="btn btn-success" onclick="submitExam()">Ya, Selesai Ujian</button>
            </div>
         </div>
      </div>
   </div>

   <!-- Bootstrap JS -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

   <script>
      // CSRF Token
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

      // Global variables
      let currentExam = null;
      let currentQuestion = 0;
      let examData = [];
      let answers = {};
      let examTimer = null;
      let timeRemaining = 0;

      // Load available exams
      async function loadExams() {
         try {
            const response = await fetch('/candidate/exam/data', {
               method: 'GET',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
               }
            });

            const result = await response.json();

            if (result.success) {
               displayExams(result.data);
            } else {
               showAlert('Gagal memuat daftar ujian', 'error');
            }
         } catch (error) {
            console.error('Error loading exams:', error);
            showAlert('Terjadi kesalahan saat memuat daftar ujian', 'error');
         }
      }

      // Display exams in cards
      function displayExams(exams) {
         const examList = document.getElementById('examList');
         examList.innerHTML = '';

         if (exams.length === 0) {
            examList.innerHTML = `
               <div class="col-12">
                  <div class="text-center py-5">
                     <i class="bi bi-file-text" style="font-size: 4rem; color: #ccc;"></i>
                     <h4 class="mt-3 text-muted">Tidak ada ujian tersedia</h4>
                     <p class="text-muted">Belum ada ujian yang dapat diakses saat ini.</p>
                  </div>
               </div>
            `;
            return;
         }

         exams.forEach(exam => {
            const card = document.createElement('div');
            card.className = 'col-md-6 col-lg-4 mb-4';

            const statusClass = getStatusClass(exam.status);
            const statusText = getStatusText(exam.status);

            card.innerHTML = `
               <div class="card exam-card h-100 position-relative">
                  <div class="exam-status ${statusClass}">${statusText}</div>
                  <div class="card-body">
                     <h5 class="card-title">${exam.nama_ujian}</h5>
                     <p class="card-text text-muted">${exam.deskripsi || 'Tidak ada deskripsi'}</p>
                     <div class="mb-3">
                        <small class="text-muted">
                           <i class="bi bi-clock me-1"></i>
                           Durasi: ${exam.durasi} menit
                        </small>
                     </div>
                     <div class="mb-3">
                        <small class="text-muted">
                           <i class="bi bi-question-circle me-1"></i>
                           Jumlah Soal: ${exam.jumlah_soal || 0}
                        </small>
                     </div>
                     <div class="mb-3">
                        <small class="text-muted">
                           <i class="bi bi-calendar me-1"></i>
                           Mulai: ${formatDateTime(exam.tanggal_mulai)}
                        </small>
                     </div>
                     <div class="mb-3">
                        <small class="text-muted">
                           <i class="bi bi-calendar-check me-1"></i>
                           Selesai: ${formatDateTime(exam.tanggal_selesai)}
                        </small>
                     </div>
                     <div class="d-grid">
                        ${getActionButton(exam.status, exam.id)}
                     </div>
                  </div>
               </div>
            `;

            examList.appendChild(card);
         });
      }

      // Get status class for styling
      function getStatusClass(status) {
         switch (status) {
            case 'available':
               return 'status-available';
            case 'ongoing':
               return 'status-ongoing';
            case 'completed':
               return 'status-completed';
            case 'expired':
               return 'status-expired';
            default:
               return 'status-expired';
         }
      }

      // Get status text
      function getStatusText(status) {
         switch (status) {
            case 'available':
               return 'Tersedia';
            case 'ongoing':
               return 'Berlangsung';
            case 'completed':
               return 'Selesai';
            case 'expired':
               return 'Kadaluarsa';
            default:
               return 'Tidak Diketahui';
         }
      }

      // Get action button based on status
      function getActionButton(status, examId) {
         switch (status) {
            case 'available':
               return `<button class="btn btn-success" onclick="startExam(${examId})">
                         <i class="bi bi-play-circle me-2"></i>
                         Mulai Ujian
                       </button>`;
            case 'ongoing':
               return `<button class="btn btn-primary" onclick="continueExam(${examId})">
                         <i class="bi bi-arrow-right-circle me-2"></i>
                         Lanjutkan
                       </button>`;
            case 'completed':
               return `<button class="btn btn-outline-secondary" disabled>
                         <i class="bi bi-check-circle me-2"></i>
                         Selesai
                       </button>`;
            case 'expired':
               return `<button class="btn btn-outline-secondary" disabled>
                         <i class="bi bi-x-circle me-2"></i>
                         Kadaluarsa
                       </button>`;
            default:
               return `<button class="btn btn-outline-secondary" disabled>
                         <i class="bi bi-question-circle me-2"></i>
                         Tidak Tersedia
                       </button>`;
         }
      }

      // Format datetime
      function formatDateTime(dateString) {
         if (!dateString) return 'Tidak ditentukan';
         const date = new Date(dateString);
         return date.toLocaleString('id-ID');
      }

      // Start exam
      async function startExam(examId) {
         try {
            const response = await fetch(`/candidate/exam/${examId}/start`, {
               method: 'POST',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
               }
            });

            const result = await response.json();

            if (result.success) {
               currentExam = examId;
               examData = result.data.questions;
               timeRemaining = result.data.duration * 60; // Convert to seconds

               showExamInterface();
               loadQuestion(0);
               startTimer();
            } else {
               showAlert(result.message || 'Gagal memulai ujian', 'error');
            }
         } catch (error) {
            console.error('Error starting exam:', error);
            showAlert('Terjadi kesalahan saat memulai ujian', 'error');
         }
      }

      // Continue exam
      async function continueExam(examId) {
         // Similar to startExam but load existing progress
         await startExam(examId);
      }

      // Show exam interface
      function showExamInterface() {
         document.getElementById('examListSection').style.display = 'none';
         document.getElementById('examInterface').style.display = 'block';
         document.getElementById('timerSection').style.display = 'block';
      }

      // Load question
      function loadQuestion(questionIndex) {
         if (questionIndex < 0 || questionIndex >= examData.length) return;

         currentQuestion = questionIndex;
         const question = examData[questionIndex];

         // Update question content
         document.getElementById('questionContent').innerHTML = `
            <div class="question-card">
               <h5>Soal ${questionIndex + 1}</h5>
               <p class="mb-4">${question.pertanyaan}</p>
               <div id="optionsContainer">
                  ${generateOptions(question.options, questionIndex)}
               </div>
            </div>
         `;

         // Update navigation
         updateNavigation();
         updateProgress();
      }

      // Generate options
      function generateOptions(options, questionIndex) {
         return options.map((option, index) => `
            <div class="option-item ${answers[questionIndex] === index ? 'selected' : ''}" 
                 onclick="selectOption(${questionIndex}, ${index})">
               <div class="d-flex align-items-center">
                  <span class="me-3 fw-bold">${String.fromCharCode(65 + index)}.</span>
                  <span>${option}</span>
               </div>
            </div>
         `).join('');
      }

      // Select option
      function selectOption(questionIndex, optionIndex) {
         answers[questionIndex] = optionIndex;
         loadQuestion(questionIndex); // Reload to update selection
      }

      // Update navigation
      function updateNavigation() {
         const questionNav = document.getElementById('questionNav');
         questionNav.innerHTML = '';

         examData.forEach((_, index) => {
            const button = document.createElement('button');
            button.className = `btn btn-sm ${index === currentQuestion ? 'btn-primary' : answers[index] !== undefined ? 'btn-success' : 'btn-outline-secondary'}`;
            button.textContent = index + 1;
            button.onclick = () => loadQuestion(index);
            questionNav.appendChild(button);
         });

         // Update prev/next buttons
         document.getElementById('prevBtn').disabled = currentQuestion === 0;
         document.getElementById('nextBtn').disabled = currentQuestion === examData.length - 1;
      }

      // Update progress
      function updateProgress() {
         const answered = Object.keys(answers).length;
         const total = examData.length;
         const percentage = (answered / total) * 100;

         document.getElementById('progressText').textContent = `${answered}/${total}`;
         document.getElementById('progressBar').style.width = `${percentage}%`;
      }

      // Previous question
      function previousQuestion() {
         if (currentQuestion > 0) {
            loadQuestion(currentQuestion - 1);
         }
      }

      // Next question
      function nextQuestion() {
         if (currentQuestion < examData.length - 1) {
            loadQuestion(currentQuestion + 1);
         }
      }

      // Start timer
      function startTimer() {
         examTimer = setInterval(() => {
            timeRemaining--;
            updateTimerDisplay();

            if (timeRemaining <= 0) {
               clearInterval(examTimer);
               submitExam();
            }
         }, 1000);
      }

      // Update timer display
      function updateTimerDisplay() {
         const hours = Math.floor(timeRemaining / 3600);
         const minutes = Math.floor((timeRemaining % 3600) / 60);
         const seconds = timeRemaining % 60;

         document.getElementById('timerDisplay').textContent =
            `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
      }

      // Confirm submit
      function confirmSubmit() {
         const modal = new bootstrap.Modal(document.getElementById('submitModal'));
         modal.show();
      }

      // Submit exam
      async function submitExam() {
         try {
            clearInterval(examTimer);

            const response = await fetch(`/candidate/exam/${currentExam}/submit`, {
               method: 'POST',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
               },
               body: JSON.stringify({
                  answers: answers
               })
            });

            const result = await response.json();

            if (result.success) {
               showAlert('Ujian berhasil diselesaikan!', 'success');
               setTimeout(() => {
                  location.reload();
               }, 2000);
            } else {
               showAlert(result.message || 'Gagal menyelesaikan ujian', 'error');
            }
         } catch (error) {
            console.error('Error submitting exam:', error);
            showAlert('Terjadi kesalahan saat menyelesaikan ujian', 'error');
         }
      }

      // Show alert
      function showAlert(message, type = 'error') {
         // Remove existing alerts
         const existingAlert = document.querySelector('.alert');
         if (existingAlert) {
            existingAlert.remove();
         }

         // Create new alert
         const alert = document.createElement('div');
         alert.className = `alert alert-${type === 'error' ? 'danger' : 'success'} alert-dismissible fade show`;
         alert.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
         `;

         // Insert at top of content
         const content = document.querySelector('.p-4');
         content.insertBefore(alert, content.firstChild);

         // Auto remove after 5 seconds
         setTimeout(() => {
            if (alert.parentNode) {
               alert.remove();
            }
         }, 5000);
      }

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
                  window.location.href = '/';
               }
            } catch (error) {
               console.error('Logout error:', error);
            }
         }
      }

      // Initialize on page load
      document.addEventListener('DOMContentLoaded', function() {
         loadExams();
      });
   </script>
</body>

</html>