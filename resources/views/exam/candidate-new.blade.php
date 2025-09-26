@extends('layouts.candidate')

@section('title', 'Ujian Online - Peserta')

@push('styles')
<style>
   .exam-intro {
      text-align: center;
   }

   .exam-intro .card {
      max-width: 800px;
      margin: 0 auto;
   }

   .exam-intro .card-body {
      padding: 3rem;
   }

   .exam-intro h2 {
      margin-bottom: 1.5rem;
   }

   .exam-intro .lead {
      margin-bottom: 2rem;
   }

   .alert {
      text-align: left;
      margin-bottom: 2rem;
   }

   .alert h6 {
      margin-bottom: 1rem;
   }

   .alert ul {
      margin-bottom: 0;
   }

   .btn-lg {
      padding: 12px 30px;
      font-size: 18px;
   }

   .exam-interface {
      display: none;
   }

   .exam-header {
      background: white;
      border-radius: 12px;
      padding: 1.5rem;
      margin-bottom: 2rem;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
   }

   .timer {
      font-family: "Courier New", monospace;
      font-weight: bold;
      color: #dc3545;
      font-size: 1.5rem;
   }

   .question-card {
      background: white;
      border-radius: 12px;
      padding: 2rem;
      margin-bottom: 2rem;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
   }

   .question-nav {
      position: sticky;
      top: 20px;
   }

   .question-item {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 5px;
      cursor: pointer;
      transition: all 0.3s;
      border: 2px solid transparent;
   }

   .question-item.answered {
      background-color: #28a745;
      color: white;
      border-color: #1e7e34;
   }

   .question-item.current {
      background-color: #007bff;
      color: white;
      border-color: #0056b3;
   }

   .question-item.unanswered {
      background-color: #e9ecef;
      color: #6c757d;
      border-color: #dee2e6;
   }

   .question-item:hover {
      transform: scale(1.1);
   }

   .form-check {
      margin-bottom: 1rem;
   }

   .form-check-input {
      margin-top: 0.25rem;
   }

   .form-check-label {
      font-size: 1rem;
      padding-left: 0.5rem;
   }

   .navigation-buttons {
      display: flex;
      justify-content: space-between;
      margin-top: 2rem;
   }

   .submit-section {
      text-align: center;
      margin-top: 2rem;
   }

   .progress-info {
      font-size: 0.9rem;
      color: #6c757d;
   }

   .modal-content {
      border-radius: 12px;
   }

   .modal-header {
      border-bottom: 1px solid #dee2e6;
   }

   .modal-footer {
      border-top: 1px solid #dee2e6;
   }

   .webcam-container {
      text-align: center;
      margin: 2rem 0;
   }

   .webcam-video {
      width: 100%;
      max-width: 400px;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
   }

   .webcam-placeholder {
      width: 100%;
      max-width: 400px;
      height: 300px;
      background: linear-gradient(45deg, #f8f9fa, #e9ecef);
      border-radius: 8px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      margin: 0 auto;
      border: 2px dashed #dee2e6;
   }

   .webcam-placeholder i {
      font-size: 3rem;
      color: #6c757d;
      margin-bottom: 1rem;
   }

   .webcam-placeholder p {
      color: #6c757d;
      margin: 0;
   }

   .btn-group .btn {
      margin: 0 5px;
   }

   .fade-in {
      animation: fadeIn 0.5s ease-in;
   }

   @keyframes fadeIn {
      from {
         opacity: 0;
         transform: translateY(20px);
      }

      to {
         opacity: 1;
         transform: translateY(0);
      }
   }

   .loading {
      text-align: center;
      padding: 2rem;
   }

   .spinner-border {
      width: 3rem;
      height: 3rem;
   }

   @media (max-width: 768px) {
      .exam-intro .card-body {
         padding: 2rem 1rem;
      }

      .question-card {
         padding: 1.5rem;
      }

      .navigation-buttons {
         flex-direction: column;
         gap: 1rem;
      }

      .navigation-buttons .btn {
         width: 100%;
      }
   }
</style>
@endpush

@section('content')
<!-- Exam Introduction -->
<div id="examIntro" class="exam-intro">
   <div class="card">
      <div class="card-body">
         <h2 class="card-title">
            <i class="bi bi-mortarboard text-primary me-2"></i>
            Ujian Online - Matematika
         </h2>
         <p class="card-text lead">Selamat datang di sistem ujian online. Silakan baca petunjuk dengan seksama sebelum memulai ujian.</p>

         <div class="alert alert-info">
            <h6><i class="bi bi-info-circle me-2"></i>Petunjuk Ujian:</h6>
            <ul class="mb-0">
               <li>Durasi: 120 menit</li>
               <li>Total Soal: 25 soal</li>
               <li>Anda dapat berpindah antar soal menggunakan navigasi</li>
               <li>Jawaban akan tersimpan otomatis setiap 30 detik</li>
               <li>Pastikan koneksi internet stabil</li>
            </ul>
         </div>

         <div class="alert alert-warning">
            <h6><i class="bi bi-exclamation-triangle me-2"></i>Perhatian:</h6>
            <ul class="mb-0">
               <li>Jangan menutup tab browser atau meminimalkan jendela</li>
               <li>Pastikan kamera dalam kondisi baik dan terlihat jelas</li>
               <li>Dilarang menggunakan bantuan eksternal atau sumber lain</li>
               <li>Segala bentuk kecurangan akan dilaporkan</li>
            </ul>
         </div>

         <div class="webcam-container">
            <div id="webcamContainer">
               <video id="webcamVideo" class="webcam-video" autoplay muted style="display: none"></video>
               <div id="webcamPlaceholder" class="webcam-placeholder">
                  <i class="bi bi-camera-video"></i>
                  <p>Kamera akan aktif saat ujian dimulai</p>
               </div>
            </div>
         </div>

         <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" id="agreeTerms" required>
            <label class="form-check-label" for="agreeTerms">
               Saya telah membaca dan menyetujui semua petunjuk ujian di atas
            </label>
         </div>

         <button class="btn btn-primary btn-lg" id="startExamBtn" disabled>
            <i class="bi bi-play-circle me-2"></i>Mulai Ujian
         </button>
      </div>
   </div>
</div>

<!-- Exam Interface -->
<div id="examInterface" class="exam-interface">
   <!-- Exam Header -->
   <div class="exam-header">
      <div class="row align-items-center">
         <div class="col-md-6">
            <h5 class="mb-0">Ujian Matematika</h5>
            <small class="text-muted">Soal <span id="currentQuestionNum">1</span> dari 25</small>
         </div>
         <div class="col-md-6 text-end">
            <div class="timer h4" id="examTimer">02:00:00</div>
            <small class="text-muted">Waktu Tersisa</small>
         </div>
      </div>
   </div>

   <div class="row">
      <!-- Question Area -->
      <div class="col-md-8">
         <div class="question-card">
            <h6 class="card-title">Soal <span id="questionNumber">1</span></h6>
            <p class="card-text" id="questionText">Berapakah hasil dari 2 + 2?</p>

            <div class="mt-4" id="optionsContainer">
               <div class="form-check">
                  <input class="form-check-input" type="radio" name="answer" id="optionA" value="A">
                  <label class="form-check-label" for="optionA">A) 3</label>
               </div>
               <div class="form-check">
                  <input class="form-check-input" type="radio" name="answer" id="optionB" value="B">
                  <label class="form-check-label" for="optionB">B) 4</label>
               </div>
               <div class="form-check">
                  <input class="form-check-input" type="radio" name="answer" id="optionC" value="C">
                  <label class="form-check-label" for="optionC">C) 5</label>
               </div>
               <div class="form-check">
                  <input class="form-check-input" type="radio" name="answer" id="optionD" value="D">
                  <label class="form-check-label" for="optionD">D) 6</label>
               </div>
            </div>

            <div class="navigation-buttons">
               <button class="btn btn-outline-secondary" id="prevQuestionBtn" disabled>
                  <i class="bi bi-arrow-left me-1"></i>Sebelumnya
               </button>
               <button class="btn btn-primary" id="nextQuestionBtn">
                  Selanjutnya <i class="bi bi-arrow-right ms-1"></i>
               </button>
            </div>
         </div>
      </div>

      <!-- Navigation Panel -->
      <div class="col-md-4">
         <div class="card question-nav">
            <div class="card-header">
               <h6 class="mb-0">Navigasi Soal</h6>
            </div>
            <div class="card-body">
               <div class="d-flex flex-wrap" id="questionNavigation">
                  <!-- Question navigation items will be generated here -->
               </div>

               <hr>

               <div class="d-grid gap-2">
                  <button class="btn btn-success" id="submitExamBtn">
                     <i class="bi bi-check-circle me-1"></i>Submit Ujian
                  </button>
                  <button class="btn btn-outline-primary" id="reviewAnswersBtn">
                     <i class="bi bi-eye me-1"></i>Review Jawaban
                  </button>
               </div>

               <div class="mt-3">
                  <small class="progress-info">
                     <i class="bi bi-info-circle me-1"></i>
                     <span id="answeredCount">0</span> dari 25 dijawab
                  </small>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- Submit Exam Modal -->
<div class="modal fade" id="submitExamModal" tabindex="-1" aria-labelledby="submitExamModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="submitExamModalLabel">Submit Ujian</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <p>Apakah Anda yakin ingin mengirim jawaban ujian? Tindakan ini tidak dapat dibatalkan.</p>
            <div class="alert alert-info">
               <i class="bi bi-info-circle me-2"></i>
               <strong>Catatan:</strong> Jawaban Anda telah tersimpan otomatis. Anda dapat meninjau jawaban sebelum mengirim.
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Review Jawaban</button>
            <button type="button" class="btn btn-success" id="confirmSubmitBtn">Submit Ujian</button>
         </div>
      </div>
   </div>
</div>
@endsection

@push('scripts')
<script>
   // CSRF Token
   const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

   // Global variables
   let currentQuestion = 1;
   let totalQuestions = 25;
   let examTimer = null;
   let answers = {};
   let timeLeft = 120 * 60; // 120 minutes in seconds

   // Initialize exam
   document.addEventListener('DOMContentLoaded', function() {
      initializeExam();
      setupEventListeners();
   });

   function initializeExam() {
      // Generate question navigation
      generateQuestionNavigation();

      // Setup terms agreement
      const agreeCheckbox = document.getElementById('agreeTerms');
      const startBtn = document.getElementById('startExamBtn');

      agreeCheckbox.addEventListener('change', function() {
         startBtn.disabled = !this.checked;
      });
   }

   function setupEventListeners() {
      // Start exam button
      document.getElementById('startExamBtn').addEventListener('click', startExam);

      // Navigation buttons
      document.getElementById('prevQuestionBtn').addEventListener('click', () => goToQuestion(currentQuestion - 1));
      document.getElementById('nextQuestionBtn').addEventListener('click', () => goToQuestion(currentQuestion + 1));

      // Submit exam
      document.getElementById('submitExamBtn').addEventListener('click', () => {
         const modal = new bootstrap.Modal(document.getElementById('submitExamModal'));
         modal.show();
      });

      document.getElementById('confirmSubmitBtn').addEventListener('click', submitExam);

      // Answer selection
      document.querySelectorAll('input[name="answer"]').forEach(radio => {
         radio.addEventListener('change', function() {
            answers[currentQuestion] = this.value;
            updateQuestionNavigation();
            updateAnsweredCount();
         });
      });
   }

   function generateQuestionNavigation() {
      const container = document.getElementById('questionNavigation');
      container.innerHTML = '';

      for (let i = 1; i <= totalQuestions; i++) {
         const questionItem = document.createElement('div');
         questionItem.className = 'question-item unanswered';
         questionItem.textContent = i;
         questionItem.onclick = () => goToQuestion(i);
         container.appendChild(questionItem);
      }
   }

   function startExam() {
      // Hide intro, show exam interface
      document.getElementById('examIntro').style.display = 'none';
      document.getElementById('examInterface').style.display = 'block';

      // Start timer
      startTimer();

      // Enable webcam (if available)
      enableWebcam();

      // Start auto-save
      startAutoSave();
   }

   function startTimer() {
      examTimer = setInterval(() => {
         const hours = Math.floor(timeLeft / 3600);
         const minutes = Math.floor((timeLeft % 3600) / 60);
         const seconds = timeLeft % 60;

         document.getElementById('examTimer').textContent =
            `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

         if (timeLeft <= 0) {
            clearInterval(examTimer);
            autoSubmitExam();
         }

         timeLeft--;
      }, 1000);
   }

   function enableWebcam() {
      if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
         navigator.mediaDevices.getUserMedia({
               video: true
            })
            .then(stream => {
               const video = document.getElementById('webcamVideo');
               const placeholder = document.getElementById('webcamPlaceholder');

               video.srcObject = stream;
               video.style.display = 'block';
               placeholder.style.display = 'none';
            })
            .catch(err => {
               console.log('Webcam not available:', err);
            });
      }
   }

   function startAutoSave() {
      setInterval(() => {
         // Auto-save answers
         saveAnswers();
         showAutoSaveIndicator();
      }, 30000); // Every 30 seconds
   }

   function saveAnswers() {
      // In a real application, this would send data to server
      localStorage.setItem('examAnswers', JSON.stringify(answers));
   }

   function showAutoSaveIndicator() {
      const indicator = document.getElementById('autoSaveIndicator');
      indicator.style.display = 'block';
      setTimeout(() => {
         indicator.style.display = 'none';
      }, 3000);
   }

   function goToQuestion(questionNum) {
      if (questionNum < 1 || questionNum > totalQuestions) return;

      currentQuestion = questionNum;

      // Update UI
      document.getElementById('currentQuestionNum').textContent = questionNum;
      document.getElementById('questionNumber').textContent = questionNum;

      // Update navigation
      document.querySelectorAll('.question-item').forEach((item, index) => {
         item.classList.remove('current');
         if (index + 1 === questionNum) {
            item.classList.add('current');
         }
      });

      // Update navigation buttons
      document.getElementById('prevQuestionBtn').disabled = questionNum === 1;
      document.getElementById('nextQuestionBtn').disabled = questionNum === totalQuestions;

      // Load question content (mock)
      loadQuestion(questionNum);
   }

   function loadQuestion(questionNum) {
      // Mock question data
      const questions = [
         "Berapakah hasil dari 2 + 2?",
         "Berapakah hasil dari 5 × 3?",
         "Berapakah hasil dari 10 - 4?",
         "Berapakah hasil dari 8 ÷ 2?",
         "Berapakah hasil dari 3²?"
      ];

      const questionText = questions[questionNum - 1] || `Soal ${questionNum}`;
      document.getElementById('questionText').textContent = questionText;

      // Clear previous selection
      document.querySelectorAll('input[name="answer"]').forEach(radio => {
         radio.checked = false;
      });

      // Restore saved answer
      if (answers[questionNum]) {
         document.querySelector(`input[value="${answers[questionNum]}"]`).checked = true;
      }
   }

   function updateQuestionNavigation() {
      document.querySelectorAll('.question-item').forEach((item, index) => {
         const questionNum = index + 1;
         item.classList.remove('answered', 'unanswered');

         if (answers[questionNum]) {
            item.classList.add('answered');
         } else {
            item.classList.add('unanswered');
         }
      });
   }

   function updateAnsweredCount() {
      const answeredCount = Object.keys(answers).length;
      document.getElementById('answeredCount').textContent = answeredCount;
   }

   function submitExam() {
      // Close modal
      const modal = bootstrap.Modal.getInstance(document.getElementById('submitExamModal'));
      modal.hide();

      // Stop timer
      clearInterval(examTimer);

      // Show loading
      showLoading();

      // Submit answers (mock)
      setTimeout(() => {
         hideLoading();
         alert('Ujian berhasil dikirim! Terima kasih telah mengikuti ujian.');
         window.location.href = '/';
      }, 2000);
   }

   function autoSubmitExam() {
      alert('Waktu ujian telah habis! Jawaban akan dikirim otomatis.');
      submitExam();
   }

   function showLoading() {
      // Show loading indicator
      const loading = document.createElement('div');
      loading.className = 'loading';
      loading.innerHTML = `
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2">Mengirim jawaban...</p>
        `;
      document.getElementById('examInterface').appendChild(loading);
   }

   function hideLoading() {
      const loading = document.querySelector('.loading');
      if (loading) {
         loading.remove();
      }
   }
</script>
@endpush