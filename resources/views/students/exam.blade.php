<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Ujian Online - @if(!$sesiUjian->hide_mata_pelajaran){{ $sesiUjian->ujian->nama_ujian ?? 'Ujian' }}@else Ujian @endif</title>
   <meta name="csrf-token" content="{{ csrf_token() }}">
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
         color: white;
         border-radius: 50px;
         cursor: pointer;
         transition: all 0.3s ease;
         box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
      }

      .submit-btn:disabled {
         background: #6c757d;
         cursor: not-allowed;
         transform: none;
      }

      .navigation-buttons {
         margin-top: 30px;
         padding: 20px;
         background: white;
         border-radius: 10px;
         box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      }

      #questionContainer {
         min-height: 400px;
      }

      .options {
         margin-top: 15px;
      }

      .form-check {
         padding: 10px;
         margin-bottom: 10px;
         border-radius: 8px;
         transition: background 0.2s;
      }

      .form-check:hover {
         background: #f8f9fa;
      }

      .form-check-input:checked+.form-check-label {
         font-weight: bold;
         color: #28a745;
      }

      textarea.form-control {
         min-height: 120px;
         resize: vertical;
      }
   </style>
</head>

<body>
   <div class="container-fluid">
      <div class="exam-container">
         <div class="exam-header">
            <div class="row align-items-center">
               <div class="col-md-8">
                  @if(!$sesiUjian->hide_mata_pelajaran)
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
                  @else
                     <h2 class="mb-2">
                        <i class="bi bi-file-text me-2"></i>
                      Selamat Mengerjakan
                     </h2>
                     <p class="mb-0">
                        <i class="bi bi-person me-2"></i>
                        {{ $peserta->nama_peserta ?? $peserta->nama ?? 'Peserta' }}
                     </p>
                  @endif
               </div>
               <div class="col-md-4 text-end">
                  <div class="timer" id="timer">
                     <i class="bi bi-clock me-2"></i>
                     <span id="timeDisplay">00:00:00</span>
                  </div>
               </div>
            </div>
         </div>

         <div id="examRoot" data-sesi-id="{{ $sesiUjian['id_sesi'] ?? '' }}" data-soal='@json($soal->map(function($item, $index) { return ['id' => $item->id_soal, 'durasi_soal' => $item->durasi_soal ?? null, 'pertanyaan' => $item->pertanyaan, 'tipe_soal' => $item->tipe_soal, 'opsi_a' => $item->opsi_a, 'opsi_b' => $item->opsi_b, 'opsi_c' => $item->opsi_c, 'opsi_d' => $item->opsi_d, 'opsi_e' => $item->opsi_e ?? null, 'opsi_f' => $item->opsi_f ?? null, 'gambar' => $item->gambar, 'poin' => $item->poin, 'index' => $index]; }))'></div>

         <form id="examForm">
            @csrf
            <div class="exam-container" id="questionContainer">
               <!-- Question will be dynamically loaded here -->
            </div>

            <!-- Navigation Buttons -->
            <div class="text-center mt-4" id="navigationButtons" style="display: none;">
               <button type="button" class="btn btn-secondary me-2" id="prevBtn" style="padding: 10px 30px; font-size: 16px;">
                  <i class="bi bi-arrow-left me-1"></i> Sebelumnya
               </button>
               <button type="button" class="btn btn-primary me-2" id="nextBtn" style="padding: 10px 30px; font-size: 16px;">
                  Selanjutnya <i class="bi bi-arrow-right ms-1"></i>
               </button>
               <button type="button" class="btn btn-success" id="finishBtn" style="padding: 10px 30px; font-size: 16px; display: none;">
                  <i class="bi bi-check-circle me-2"></i> Selesai
               </button>
            </div>
         </form>
      </div>
   </div>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
   <script>
      const examRoot = document.getElementById('examRoot');
      const sesiId = examRoot ? examRoot.dataset.sesiId : '';
      const soalData = JSON.parse(examRoot ? examRoot.dataset.soal : '[]');
      const hideNomorUrut = {{ $sesiUjian->hide_nomor_urut ? 'true' : 'false' }};
      const hidePoin = {{ $sesiUjian->hide_poin ? 'true' : 'false' }};
      
      let currentQuestionIndex = 0;
      let answers = {};
      let questionTimers = {};
      let timerInterval = null;
      let isSubmitting = false;
      let startTime = Date.now();

      // Load saved answers from localStorage
      function loadSavedAnswers() {
         const backup = localStorage.getItem('exam_backup_' + sesiId);
         if (backup) {
            try {
               const backupData = JSON.parse(backup);
               if (backupData.answers) {
                  answers = backupData.answers;
               }
               if (backupData.currentQuestionIndex !== undefined) {
                  currentQuestionIndex = parseInt(backupData.currentQuestionIndex);
               }
            } catch (e) {
               console.error('Error loading backup:', e);
            }
         }
      }

      // Save answers to localStorage
      function saveAnswers() {
         const backupData = {
            answers: answers,
            currentQuestionIndex: currentQuestionIndex,
            timestamp: new Date().toISOString()
         };
         localStorage.setItem('exam_backup_' + sesiId, JSON.stringify(backupData));
      }

      // Render question
      function renderQuestion(index) {
         if (index < 0 || index >= soalData.length) return;
         
         const question = soalData[index];
         const container = document.getElementById('questionContainer');
         
         // Save current answer before switching
         saveCurrentAnswer();
         
         // Clear timer
         if (timerInterval) {
            clearInterval(timerInterval);
            timerInterval = null;
         }
         
         // Build HTML
         let html = '<div class="question-card">';
         html += '<div class="d-flex align-items-start mb-3">';
         
         if (!hideNomorUrut) {
            html += '<div class="question-number">' + (index + 1) + '</div>';
         }
         
         html += '<div class="flex-grow-1">';
         html += '<h5 class="fw-bold mb-3">' + escapeHtml(question.pertanyaan) + '</h5>';
         
         // Show image if exists
         if (question.gambar) {
            html += '<div class="mb-3"><img src="/' + question.gambar + '" alt="Gambar Soal" class="img-fluid" style="max-width: 100%; height: auto;"></div>';
         }
         
         // Render options based on question type
         if (question.tipe_soal === 'pilihan_ganda') {
            html += '<div class="options">';
            const options = {
               'A': question.opsi_a,
               'B': question.opsi_b,
               'C': question.opsi_c,
               'D': question.opsi_d,
               'E': question.opsi_e,
               'F': question.opsi_f
            };
            
            Object.keys(options).forEach(function(key) {
               if (options[key]) {
                  const checked = answers[question.id] === key ? 'checked' : '';
                  html += '<div class="form-check mb-3">';
                  html += '<input class="form-check-input jawaban-radio" type="radio" name="jawaban_' + question.id + '" value="' + key + '" data-id="' + question.id + '" id="soal' + question.id + '_' + key + '" ' + checked + '>';
                  html += '<label class="form-check-label" for="soal' + question.id + '_' + key + '">' + key + '. ' + escapeHtml(options[key]) + '</label>';
                  html += '</div>';
               }
            });
            html += '</div>';
         } else if (question.tipe_soal === 'true_false') {
            html += '<div class="options">';
            const trueChecked = answers[question.id] === 'true' ? 'checked' : '';
            const falseChecked = answers[question.id] === 'false' ? 'checked' : '';
            html += '<div class="form-check mb-3">';
            html += '<input class="form-check-input jawaban-radio" type="radio" name="jawaban_' + question.id + '" value="true" data-id="' + question.id + '" id="soal' + question.id + '_true" ' + trueChecked + '>';
            html += '<label class="form-check-label fw-bold" for="soal' + question.id + '_true">Benar</label>';
            html += '</div>';
            html += '<div class="form-check mb-3">';
            html += '<input class="form-check-input jawaban-radio" type="radio" name="jawaban_' + question.id + '" value="false" data-id="' + question.id + '" id="soal' + question.id + '_false" ' + falseChecked + '>';
            html += '<label class="form-check-label fw-bold" for="soal' + question.id + '_false">Salah</label>';
            html += '</div>';
            html += '</div>';
         }
         
         html += '<div class="mt-3">';
         html += '<small class="text-muted">';
         if (!hidePoin) {
            html += '<i class="bi bi-star me-1"></i> Poin: ' + question.poin + ' | ';
         }
         html += '<i class="bi bi-tag me-1"></i> Tipe: ' + question.tipe_soal.replace('_', ' ').replace(/\b\w/g, l => l.toUpperCase());
         html += '</small>';
         html += '</div>';
         
         html += '</div></div></div>';
         
         container.innerHTML = html;
         
         // Update navigation buttons
         updateNavigationButtons();
         
         // Start timer for this question
         startQuestionTimer(question);
         
         // Add event listeners
         document.querySelectorAll('.jawaban-radio').forEach(function(r) {
            r.addEventListener('change', function() {
               saveCurrentAnswer();
            });
         });
         document.querySelectorAll('textarea[name^="jawaban["]').forEach(function(t) {
            t.addEventListener('input', function() {
               saveCurrentAnswer();
            });
         });
      }

      // Save current answer
      function saveCurrentAnswer() {
         if (currentQuestionIndex >= 0 && currentQuestionIndex < soalData.length) {
            const question = soalData[currentQuestionIndex];
            const radios = document.querySelectorAll('input[name="jawaban_' + question.id + '"]:checked');
            if (radios.length > 0) {
               answers[question.id] = radios[0].value;
            } else {
               const textarea = document.querySelector('textarea[name="jawaban[' + question.id + ']"]');
               if (textarea) {
                  answers[question.id] = textarea.value;
               }
            }
            saveAnswers();
         }
      }

      // Start timer for current question
      function startQuestionTimer(question) {
         if (!question.durasi_soal) {
            document.getElementById('timeDisplay').textContent = 'Tidak ada batas waktu';
            document.getElementById('timer').style.background = '#28a745';
            return;
         }
         
         let timeLeft = question.durasi_soal * 60; // Convert minutes to seconds
         
         function updateTimer() {
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            const timeString = String(minutes).padStart(2, '0') + ':' + String(seconds).padStart(2, '0');
            document.getElementById('timeDisplay').textContent = timeString;
            
            if (timeLeft <= 30) {
               document.getElementById('timer').style.background = '#dc3545';
            } else if (timeLeft <= 60) {
               document.getElementById('timer').style.background = '#ffc107';
               document.getElementById('timer').style.color = '#000';
            } else {
               document.getElementById('timer').style.background = '#667eea';
               document.getElementById('timer').style.color = '#fff';
            }
            
            if (timeLeft <= 0) {
               clearInterval(timerInterval);
               // Auto next to next question
               if (currentQuestionIndex < soalData.length - 1) {
                  nextQuestion();
               } else {
                  // Last question, submit exam
                  submitExam();
               }
            }
            timeLeft--;
         }
         
         updateTimer();
         timerInterval = setInterval(updateTimer, 1000);
      }

      // Update navigation buttons
      function updateNavigationButtons() {
         const prevBtn = document.getElementById('prevBtn');
         const nextBtn = document.getElementById('nextBtn');
         const finishBtn = document.getElementById('finishBtn');
         const navButtons = document.getElementById('navigationButtons');
         
         navButtons.style.display = 'block';
         
         prevBtn.style.display = currentQuestionIndex > 0 ? 'inline-block' : 'none';
         nextBtn.style.display = currentQuestionIndex < soalData.length - 1 ? 'inline-block' : 'none';
         finishBtn.style.display = currentQuestionIndex === soalData.length - 1 ? 'inline-block' : 'none';
      }

      // Next question
      function nextQuestion() {
         if (currentQuestionIndex < soalData.length - 1) {
            saveCurrentAnswer();
            currentQuestionIndex++;
            renderQuestion(currentQuestionIndex);
         }
      }

      // Previous question
      function prevQuestion() {
         if (currentQuestionIndex > 0) {
            saveCurrentAnswer();
            currentQuestionIndex--;
            renderQuestion(currentQuestionIndex);
         }
      }

      // Escape HTML
      function escapeHtml(text) {
         const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
         };
         return String(text).replace(/[&<>"']/g, function(m) { return map[m]; });
      }

      // Collect all answers
      function collectAnswers() {
         saveCurrentAnswer(); // Save current question answer
         return {
            jawaban: answers,
            waktu_pengerjaan: Math.round((Date.now() - startTime) / (1000 * 60))
         };
      }

      // Submit exam
      function submitExam() {
         if (isSubmitting) return;
         isSubmitting = true;
         
         if (timerInterval) {
            clearInterval(timerInterval);
         }
         
         const data = collectAnswers();
         const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
         
         fetch('/student/exam/' + sesiId + '/submit', {
            method: 'POST',
            headers: {
               'Content-Type': 'application/json',
               'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify(data)
         })
         .then(function(response) {
            return response.json();
         })
         .then(function(result) {
            if (result.success) {
               localStorage.removeItem('exam_backup_' + sesiId);
               if (result.redirect_url) {
                  window.location.replace(result.redirect_url);
               } else {
                  window.location.replace('/student/selesai');
               }
            } else {
               isSubmitting = false;
               alert('Terjadi kesalahan: ' + (result.message || 'Gagal menyimpan'));
            }
         })
         .catch(function(error) {
            isSubmitting = false;
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengirim jawaban');
         });
      }

      // Initialize
      document.addEventListener('DOMContentLoaded', function() {
         loadSavedAnswers();
         renderQuestion(currentQuestionIndex);
         
         // Event listeners for navigation
         document.getElementById('nextBtn').addEventListener('click', nextQuestion);
         document.getElementById('prevBtn').addEventListener('click', prevQuestion);
         document.getElementById('finishBtn').addEventListener('click', submitExam);
      });

   </script>
</body>

</html>