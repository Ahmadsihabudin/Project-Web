<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Ujian Online - {{ $sesiUjian->ujian->nama_ujian ?? 'Ujian' }}</title>
   <meta name="csrf-token" content="{{ csrf_token() }}">
   
   <!-- Favicon -->
   <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
   <link rel="icon" type="image/png" href="{{ asset('images/Favicon_akti.png') }}">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
   <style>
      body {
         background-color: #f8f9fa;
         font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      }

      .exam-container {
         max-width: 1200px;
         margin: 0 auto;
         padding: 20px;
      }

      .exam-header {
         background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
         color: white;
         padding: 20px;
         border-radius: 10px;
         margin-bottom: 30px;
         box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      }

      .question-card {
         background: white;
         border-radius: 10px;
         padding: 25px;
         margin-bottom: 20px;
         box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
         border-left: 4px solid #667eea;
         transition: all 0.3s ease;
      }

      .question-card.answered {
         border-left: 4px solid #28a745;
         background: #f8fff9;
      }

      .question-card.answered .question-number {
         background: #28a745;
      }

      .question-number {
         background: #667eea;
         color: white;
         width: 40px;
         height: 40px;
         border-radius: 50%;
         display: flex;
         align-items: center;
         justify-content: center;
         font-weight: bold;
         margin-right: 15px;
      }

      .timer {
         background: #dc3545;
         color: white;
         padding: 10px 20px;
         border-radius: 25px;
         font-weight: bold;
         font-size: 18px;
      }

      .submit-btn {
         background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
         border: none;
         padding: 15px 40px;
         font-size: 18px;
         font-weight: bold;
         border-radius: 25px;
         color: white;
         box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
      }

      .submit-btn:hover {
         transform: translateY(-2px);
         box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
      }


      .form-check-input:checked {
         background-color: #667eea;
         border-color: #667eea;
      }

      .form-check-input:focus {
         box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.25);
      }

      /* Modal dan Notifikasi */
      .modal.show {
         display: block !important;
      }

      #network-status {
         animation: slideInRight 0.3s ease-out;
      }

      @keyframes slideInRight {
         from {
            transform: translateX(100%);
            opacity: 0;
         }
         to {
            transform: translateX(0);
            opacity: 1;
         }
      }
   </style>
</head>

<body>
   <!-- Main Exam Content -->
   <div class="exam-container">
      <!-- Header -->
      <div class="exam-header">
         <div class="row align-items-center">
            <div class="col-md-8">
               <h2 class="mb-2">
                  <i class="bi bi-file-text me-2"></i>
                  {{ $sesiUjian->ujian->nama_ujian ?? 'Ujian' }}
               </h2>
               <p class="mb-0">
                  <i class="bi bi-book me-2"></i>
                  {{ $sesiUjian->mata_pelajaran }} |
                  <i class="bi bi-person me-2"></i>
                  {{ $peserta->nama_peserta ?? $peserta->nama ?? 'Peserta' }}
               </p>
            </div>
            <div class="col-md-4 text-end">
               <div class="timer" id="timer">
                  <i class="bi bi-clock me-2"></i>
                  <span id="timeDisplay">00:00:00</span>
               </div>
            </div>
         </div>
      </div>

      <!-- Questions -->
      <form id="examForm">
         @csrf
         <!-- Hidden inputs for backend compatibility -->
         @foreach($soal as $item)
         @if($item->tipe_soal === 'pilihan_ganda')
         <input type="hidden" name="jawaban[{{ $item->id_soal }}]" id="hidden_jawaban_{{ $item->id_soal }}">
         @endif
         @endforeach
         @foreach($soal as $index => $item)
         <div class="question-card">
            <div class="d-flex align-items-start mb-3">
               <div class="question-number">{{ $index + 1 }}</div>
               <div class="flex-grow-1">
                  <h5 class="fw-bold mb-3">{{ $item->pertanyaan }}</h5>

                  @if($item->tipe_soal === 'pilihan_ganda')
                  <div class="options">
                     @php
                     $options = [
                     'A' => $item->opsi_a,
                     'B' => $item->opsi_b,
                     'C' => $item->opsi_c,
                     'D' => $item->opsi_d
                     ];
                     @endphp

                     @foreach($options as $key => $option)
                     @if($option)
                     <div class="form-check mb-3">
                        <input class="form-check-input jawaban-radio" type="radio"
                           name="jawaban_{{ $item->id_soal }}"
                           value="{{ $key }}"
                           data-id="{{ $item->id_soal }}"
                           id="soal{{ $item->id_soal }}_{{ $key }}">
                        <label class="form-check-label fw-bold" for="soal{{ $item->id_soal }}_{{ $key }}">
                           {{ $key }}. {{ $option }}
                        </label>
                     </div>
                     @endif
                     @endforeach
                  </div>
                  @elseif($item->tipe_soal === 'essay')
                  <div class="form-group">
                     <textarea class="form-control"
                        name="jawaban[{{ $item->id_soal }}]"
                        rows="4"
                        placeholder="Tulis jawaban Anda di sini..."></textarea>
                  </div>
                  @endif

                  <div class="mt-3">
                     <small class="text-muted">
                        <i class="bi bi-star me-1"></i>
                        Poin: {{ $item->poin }} |
                        <i class="bi bi-tag me-1"></i>
                        Tipe: {{ ucfirst(str_replace('_', ' ', $item->tipe_soal)) }}
                     </small>
                  </div>
               </div>
            </div>
         </div>
         @endforeach

         <!-- Debug and Submit Buttons -->
         <div class="text-center mt-4">
            <button type="button" class="btn btn-info me-3" onclick="checkFormState()">
               <i class="bi bi-bug me-2"></i>
               DEBUG FORM
            </button>
            <button type="submit" class="submit-btn" id="submitBtn">
               <i class="bi bi-check-circle me-2"></i>
               SELESAIKAN UJIAN
            </button>
         </div>
      </form>
   </div>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
   <script>
      let timeLeft = {{ $sesiUjian->durasi_menit * 60 }}; // Convert to seconds
      let timerInterval;
      let isSubmitting = false;
      let hasNetworkIssue = false;
      let answerPersistence = {}; // Store answers to prevent loss
      let startTime = Date.now(); // Track when exam started

      // Start timer on page load
      document.addEventListener('DOMContentLoaded', function() {
         // Cek apakah ada backup data dari jaringan jelek sebelumnya
         checkForBackup();
         
         // Start timer
         startTimer();
         
         // Monitor koneksi jaringan
         monitorNetworkConnection();
         
         // Debug: Monitor radio button changes
         monitorRadioButtons();
         
         // Load answers from localStorage on page load
         loadAnswersFromLocalStorage();
         
         // Auto-restore answers every 2 seconds
         setInterval(restoreAnswers, 2000);
      });

      function startTimer() {
         timerInterval = setInterval(function() {
            timeLeft--;
            updateTimerDisplay();

            if (timeLeft <= 0) {
               clearInterval(timerInterval);
               
               if (!isSubmitting) {
                  // Cek koneksi sebelum auto submit
                  if (navigator.onLine && !hasNetworkIssue) {
                     alert('Waktu ujian telah habis! Jawaban akan otomatis disimpan.');
                     submitExam();
                  } else {
                     // Jaringan jelek, simpan ke localStorage
                     alert('Waktu ujian habis! Karena jaringan tidak stabil, jawaban disimpan sementara. Silakan login kembali untuk melanjutkan.');
                     saveToLocalStorage();
                  }
               }
            }
         }, 1000);
      }

      function monitorNetworkConnection() {
         // Cek koneksi saat ini
         if (!navigator.onLine) {
            hasNetworkIssue = true;
            showNetworkStatus('Tidak ada koneksi internet!', 'danger');
         }

         // Monitor perubahan koneksi
         window.addEventListener('online', function() {
            hasNetworkIssue = false;
            showNetworkStatus('Koneksi internet kembali normal', 'success');
         });

         window.addEventListener('offline', function() {
            hasNetworkIssue = true;
            showNetworkStatus('Koneksi internet terputus!', 'danger');
         });
      }

      function checkForBackup() {
         const backup = localStorage.getItem('exam_backup_{{ $sesiUjian->id_sesi }}');
         if (backup) {
            try {
               const backupData = JSON.parse(backup);
               
               // Cek apakah backup masih valid (tidak lebih dari 24 jam)
               const backupTime = new Date(backupData.timestamp);
               const now = new Date();
               const hoursDiff = (now - backupTime) / (1000 * 60 * 60);
               
               if (hoursDiff < 24) {
                  showResumeDialog(backupData);
               } else {
                  // Hapus backup yang sudah expired
                  localStorage.removeItem('exam_backup_{{ $sesiUjian->id_sesi }}');
               }
            } catch (e) {
               console.error('Error parsing backup data:', e);
               localStorage.removeItem('exam_backup_{{ $sesiUjian->id_sesi }}');
            }
         }
      }

      function showResumeDialog(backupData) {
         const resumeDialog = document.createElement('div');
         resumeDialog.className = 'modal fade show';
         resumeDialog.style.display = 'block';
         resumeDialog.style.backgroundColor = 'rgba(0,0,0,0.5)';
         resumeDialog.innerHTML = `
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header bg-warning">
                     <h5 class="modal-title">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        Ujian Tersimpan
                     </h5>
                  </div>
                  <div class="modal-body">
                     <p>Ditemukan data ujian yang belum selesai karena masalah jaringan:</p>
                     <ul>
                        <li><strong>Waktu tersisa:</strong> ${formatTime(backupData.timeLeft)}</li>
                        <li><strong>Terakhir disimpan:</strong> ${new Date(backupData.timestamp).toLocaleString()}</li>
                        <li><strong>Alasan:</strong> ${backupData.reason === 'network_issue' ? 'Masalah jaringan' : 'Waktu habis'}</li>
                     </ul>
                     <p class="text-muted">Apakah Anda ingin melanjutkan ujian dari titik terakhir?</p>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" onclick="startFresh()">
                        <i class="bi bi-arrow-clockwise me-2"></i>Mulai Baru
                     </button>
                     <button type="button" class="btn btn-primary" onclick="resumeExam()">
                        <i class="bi bi-play-circle me-2"></i>Lanjutkan
                     </button>
                  </div>
               </div>
            </div>
         `;
         
         document.body.appendChild(resumeDialog);
         
         window.startFresh = function() {
            localStorage.removeItem('exam_backup_{{ $sesiUjian->id_sesi }}');
            resumeDialog.remove();
         };
         
         window.resumeExam = function() {
            restoreFromBackup(backupData);
            resumeDialog.remove();
         };
      }

      function restoreFromBackup(backupData) {
         // Restore waktu
         timeLeft = backupData.timeLeft;
         updateTimerDisplay();
         
         // Restore jawaban
         if (backupData.data && backupData.data.jawaban) {
            Object.keys(backupData.data.jawaban).forEach(soalId => {
               const value = backupData.data.jawaban[soalId];
               
               // Untuk pilihan ganda (radio button)
               const radioInput = document.querySelector(`input[name="jawaban[${soalId}]"][value="${value}"]`);
               if (radioInput) {
                  radioInput.checked = true;
               }
               
               // Untuk essay
               const textarea = document.querySelector(`textarea[name="jawaban[${soalId}]"]`);
               if (textarea) {
                  textarea.value = value;
               }
            });
         }
         
         showNetworkStatus('Ujian berhasil dilanjutkan!', 'success');
      }

      function saveToLocalStorage() {
         const form = document.getElementById('examForm');
         const formData = new FormData(form);
         
         const data = {};
         for (let [key, value] of formData.entries()) {
            if (key.startsWith('jawaban[')) {
               const match = key.match(/\[(\d+)\]/);
               if (match && match[1]) {
                  const soalId = match[1];
                  if (!data.jawaban) data.jawaban = {};
                  data.jawaban[soalId] = value;
               }
            }
         }

         const backupData = {
            data: data,
            timestamp: new Date().toISOString(),
            timeLeft: timeLeft,
            sesiId: {{ $sesiUjian->id_sesi }},
            reason: 'network_issue'
         };

         localStorage.setItem('exam_backup_{{ $sesiUjian->id_sesi }}', JSON.stringify(backupData));
         console.log('Data ujian disimpan ke localStorage karena masalah jaringan');
      }

      function submitExam() {
         if (isSubmitting) return;
         
         isSubmitting = true;
         const form = document.getElementById('examForm');
         const formData = new FormData(form);

         // Calculate actual time spent (in minutes)
         const endTime = Date.now();
         const timeSpentMs = endTime - startTime;
         const timeSpentMinutes = Math.round(timeSpentMs / (1000 * 60)); // Convert to minutes

         // Convert FormData to JSON
         const data = {
            jawaban: {},
            waktu_pengerjaan: timeSpentMinutes
         };
         
         for (let [key, value] of formData.entries()) {
            if (key.startsWith('jawaban[')) {
               const match = key.match(/\[(\d+)\]/);
               if (match && match[1]) {
                  const soalId = match[1];
                  data.jawaban[soalId] = value;
               }
            }
         }

         // Cek koneksi sebelum submit
         if (!navigator.onLine || hasNetworkIssue) {
            showNetworkStatus('Jaringan tidak stabil. Data disimpan sementara.', 'warning');
            saveToLocalStorage();
            isSubmitting = false;
            return;
         }

         fetch(`/student/exam/{{ $sesiUjian->id_sesi }}/submit`, {
               method: 'POST',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
               },
               body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(result => {
               if (result.success) {
                  // Hapus backup setelah berhasil
                  localStorage.removeItem('exam_backup_{{ $sesiUjian->id_sesi }}');
                  
                  // Redirect langsung ke halaman selesai tanpa menampilkan hasil
                  if (result.redirect_url) {
                     window.location.href = result.redirect_url;
                  } else {
                     window.location.href = '/student/selesai';
                  }
               } else {
                  alert('Terjadi kesalahan: ' + result.message);
                  isSubmitting = false;
               }
            })
            .catch(error => {
               console.error('Error:', error);
               // Jika gagal submit karena jaringan, simpan ke localStorage
               showNetworkStatus('Gagal mengirim data. Disimpan sementara karena masalah jaringan.', 'danger');
               saveToLocalStorage();
               isSubmitting = false;
            });
      }

      function updateTimerDisplay() {
         const hours = Math.floor(timeLeft / 3600);
         const minutes = Math.floor((timeLeft % 3600) / 60);
         const seconds = timeLeft % 60;

         const timeString =
            String(hours).padStart(2, '0') + ':' +
            String(minutes).padStart(2, '0') + ':' +
            String(seconds).padStart(2, '0');

         document.getElementById('timeDisplay').textContent = timeString;

         // Change color when time is running low
         if (timeLeft <= 300) { // 5 minutes
            document.getElementById('timer').style.background = '#dc3545';
         } else if (timeLeft <= 600) { // 10 minutes
            document.getElementById('timer').style.background = '#ffc107';
            document.getElementById('timer').style.color = '#000';
         }
      }

      function formatTime(seconds) {
         const hours = Math.floor(seconds / 3600);
         const minutes = Math.floor((seconds % 3600) / 60);
         const secs = seconds % 60;
         return String(hours).padStart(2, '0') + ':' + 
                String(minutes).padStart(2, '0') + ':' + 
                String(secs).padStart(2, '0');
      }

      function showNetworkStatus(message, type = 'info') {
         const existing = document.getElementById('network-status');
         if (existing) existing.remove();

         const notification = document.createElement('div');
         notification.id = 'network-status';
         notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
         notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; max-width: 400px;';
         notification.innerHTML = `
            <i class="bi bi-wifi me-2"></i>
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
         `;
         
         document.body.appendChild(notification);
         
         setTimeout(() => {
            if (notification.parentNode) {
               notification.remove();
            }
         }, 5000);
      }

      function monitorRadioButtons() {
         console.log('🔍 Setting up radio button monitoring...');
         
         // Monitor all radio buttons with jawaban-radio class
         const radioButtons = document.querySelectorAll('.jawaban-radio');
         console.log('🔍 Found radio buttons:', radioButtons.length);
         
         radioButtons.forEach((radio, index) => {
            radio.addEventListener('change', function() {
               // Extract soal ID from name attribute (jawaban_1 -> 1)
               const nameMatch = this.name.match(/jawaban_(\d+)/);
               const soalId = nameMatch ? nameMatch[1] : null;
               
               if (!soalId) {
                  console.error('❌ Could not extract soal ID from radio button:', this);
                  return;
               }
               
               const key = `jawaban_${soalId}`;
               
               console.log('📻 Radio button changed:', {
                  soalId: soalId,
                  key: key,
                  value: this.value,
                  checked: this.checked
               });
               
               // Store answer in persistence system with soal ID
               if (this.checked) {
                  answerPersistence[key] = this.value;
                  // Also store in localStorage for backup
                  localStorage.setItem(key, this.value);
                  console.log('💾 Answer stored:', key, '=', this.value);
                  
                  // Sync with hidden input for backend
                  const hiddenInput = document.getElementById(`hidden_jawaban_${soalId}`);
                  if (hiddenInput) {
                     hiddenInput.value = this.value;
                     console.log('🔄 Synced hidden input:', `jawaban[${soalId}]`, '=', this.value);
                  }
                  
                  // Add visual feedback
                  const questionCard = this.closest('.question-card');
                  if (questionCard) {
                     questionCard.classList.add('answered');
                  }
               }
               
               // Check all radio buttons in the same group
               const sameGroup = document.querySelectorAll(`input[name="${this.name}"]`);
               const checkedInGroup = Array.from(sameGroup).filter(r => r.checked);
               console.log('📻 Same group radios:', sameGroup.length, 'Checked:', checkedInGroup.length);
            });
         });
         
         // Monitor form changes
         const form = document.getElementById('examForm');
         if (form) {
            form.addEventListener('change', function(e) {
               if (e.target.type === 'radio') {
                  console.log('📝 Form change detected:', {
                     target: e.target.name,
                     value: e.target.value,
                     checked: e.target.checked
                  });
               }
            });
         }
      }

      // Function to load answers from localStorage on page load
      function loadAnswersFromLocalStorage() {
         console.log('🔄 Loading answers from localStorage...');
         
         // Get all radio buttons
         const radioButtons = document.querySelectorAll('.jawaban-radio');
         console.log('🔍 Found radio buttons:', radioButtons.length);
         
         radioButtons.forEach(radio => {
            // Extract soal ID from name attribute (jawaban_1 -> 1)
            const nameMatch = radio.name.match(/jawaban_(\d+)/);
            const soalId = nameMatch ? nameMatch[1] : null;
            
            if (!soalId) {
               console.error('❌ Could not extract soal ID from radio:', radio);
               return;
            }
            
            const key = `jawaban_${soalId}`;
            const savedAnswer = localStorage.getItem(key);
            
            console.log('🔍 Loading from localStorage:', key, '=', savedAnswer);
            
            if (savedAnswer && savedAnswer === radio.value) {
               radio.checked = true;
               answerPersistence[key] = savedAnswer;
               
               // Sync with hidden input
               const hiddenInput = document.getElementById(`hidden_jawaban_${soalId}`);
               if (hiddenInput) {
                  hiddenInput.value = savedAnswer;
               }
               
               // Add visual feedback
               const questionCard = radio.closest('.question-card');
               if (questionCard) {
                  questionCard.classList.add('answered');
               }
               
               console.log('✅ Loaded from localStorage:', key, '=', savedAnswer);
            }
         });
         
         console.log('💾 Loaded persistence data:', answerPersistence);
      }

      // Function to restore answers from persistence
      function restoreAnswers() {
         console.log('🔄 Restoring answers from persistence...');
         console.log('💾 Stored answers:', answerPersistence);
         
         Object.keys(answerPersistence).forEach(key => {
            const answer = answerPersistence[key];
            const soalId = key.replace('jawaban_', '');
            
            // Find radio button by name attribute
            const radioInput = document.querySelector(`input[name="jawaban_${soalId}"][value="${answer}"]`);
            
            if (radioInput) {
               radioInput.checked = true;
               console.log('✅ Restored:', key, '=', answer);
               
               // Sync with hidden input
               const hiddenInput = document.getElementById(`hidden_jawaban_${soalId}`);
               if (hiddenInput) {
                  hiddenInput.value = answer;
                  console.log('🔄 Synced hidden input:', `jawaban[${soalId}]`, '=', answer);
               }
               
               // Add visual feedback
               const questionCard = radioInput.closest('.question-card');
               if (questionCard) {
                  questionCard.classList.add('answered');
               }
            } else {
               console.log('❌ Could not find radio for:', key, '=', answer);
            }
         });
      }

      // Function to check current form state
      function checkFormState() {
         console.log('🔍 Checking form state...');
         const form = document.getElementById('examForm');
         const formData = new FormData(form);
         
         const answers = {};
         for (let [key, value] of formData.entries()) {
            if (key.startsWith('jawaban[')) {
               const match = key.match(/\[(\d+)\]/);
               if (match && match[1]) {
                  const soalId = match[1];
                  if (!answers[soalId]) answers[soalId] = {};
                  answers[soalId][key] = value;
               }
            }
         }
         
         console.log('📝 Current answers (form data):', answers);
         console.log('💾 Persistence answers (jawaban_soalId):', answerPersistence);
         
         // Check hidden inputs for backend format
         const hiddenInputs = document.querySelectorAll('input[type="hidden"][name^="jawaban["]');
         console.log('🔗 Hidden inputs for backend:', hiddenInputs.length);
         hiddenInputs.forEach(input => {
            if (input.value) {
               console.log('🔗 Hidden:', input.name, '=', input.value);
            }
         });
         
         // Check radio buttons specifically
         const radioButtons = document.querySelectorAll('input[type="radio"]:checked');
         console.log('📻 Checked radio buttons:', radioButtons.length);
         radioButtons.forEach(radio => {
            console.log('📻 Checked:', radio.name, '=', radio.value);
         });
         
         return answers;
      }

      // Handle form submission
      document.getElementById('examForm').addEventListener('submit', function(e) {
         e.preventDefault();
         showConfirmationDialog();
      });

      function showConfirmationDialog() {
         const confirmationDialog = document.createElement('div');
         confirmationDialog.className = 'modal fade show';
         confirmationDialog.style.display = 'block';
         confirmationDialog.style.backgroundColor = 'rgba(0,0,0,0.5)';
         confirmationDialog.innerHTML = `
            <div class="modal-dialog modal-dialog-centered">
               <div class="modal-content" style="border-radius: 15px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.3);">
                  <div class="modal-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 15px 15px 0 0; border: none;">
                     <h5 class="modal-title fw-bold">
                        <i class="bi bi-check-circle me-2"></i>
                        Konfirmasi Penyelesaian Ujian
                     </h5>
                  </div>
                  <div class="modal-body text-center py-4">
                     <div class="mb-3">
                        <i class="bi bi-question-circle text-warning" style="font-size: 3rem;"></i>
                     </div>
                     <h6 class="fw-bold mb-3">Apakah Anda yakin ingin menyelesaikan ujian?</h6>
                     <p class="text-muted mb-0">Pastikan semua jawaban sudah diisi dengan benar. Setelah mengirim, Anda tidak dapat mengubah jawaban lagi.</p>
                  </div>
                  <div class="modal-footer border-0 justify-content-center">
                     <button type="button" class="btn btn-outline-secondary me-3" onclick="closeConfirmationDialog()">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                     </button>
                     <button type="button" class="btn btn-success px-4" onclick="confirmSubmit()">
                        <i class="bi bi-check-circle me-2"></i>Ya, Selesaikan Ujian
                     </button>
                  </div>
               </div>
            </div>
         `;
         
         document.body.appendChild(confirmationDialog);
         
         window.closeConfirmationDialog = function() {
            confirmationDialog.remove();
         };
         
         window.confirmSubmit = function() {
            confirmationDialog.remove();
            submitExam();
         };
      }

      // Auto-save HANYA saat keluar dari halaman dengan jaringan jelek
      window.addEventListener('beforeunload', function(e) {
         // Hanya auto-save jika ada masalah jaringan
         if (!navigator.onLine || hasNetworkIssue) {
            saveToLocalStorage();
            e.preventDefault();
            e.returnValue = 'Jaringan tidak stabil. Data ujian akan disimpan sementara.';
         } else {
            // Jaringan normal, biarkan user memutuskan
            e.preventDefault();
            e.returnValue = 'Apakah Anda yakin ingin meninggalkan halaman ujian?';
         }
      });
   </script>
</body>

</html>