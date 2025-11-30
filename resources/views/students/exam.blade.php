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

      /* Responsive Design */
      @media (max-width: 768px) {
         .exam-container {
            padding: 10px;
         }

         .exam-header {
            padding: 15px;
            margin-bottom: 20px;
         }

         .exam-header h2 {
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
         }

         .exam-header p {
            font-size: 0.875rem;
         }

         .timer {
            padding: 8px 15px;
            font-size: 14px;
            margin-top: 10px;
         }

         .question-card {
            padding: 15px;
            margin-bottom: 15px;
         }

         .question-number {
            width: 35px;
            height: 35px;
            font-size: 0.875rem;
            margin-right: 10px;
            flex-shrink: 0;
         }

         .question-card h5 {
            font-size: 1rem;
            line-height: 1.5;
         }

         .form-check {
            padding: 8px;
            margin-bottom: 8px;
         }

         .form-check-label {
            font-size: 0.9rem;
            line-height: 1.4;
         }

         .options img {
            max-width: 100%;
            height: auto;
         }

         #navigationButtons {
            padding: 15px 0;
         }

         #navigationButtons .btn {
            width: 100%;
            padding: 12px 20px;
            font-size: 14px;
         }

         #navigationButtons .d-flex {
            gap: 10px;
         }

         .container-fluid {
            padding: 0;
         }
      }

      @media (max-width: 576px) {
         .exam-container {
            padding: 8px;
         }

         .exam-header {
            padding: 12px;
         }

         .exam-header .row {
            flex-direction: column;
         }

         .exam-header .col-md-8,
         .exam-header .col-md-4 {
            width: 100%;
            text-align: center;
         }

         .exam-header .col-md-4 {
            margin-top: 10px;
         }

         .question-card {
            padding: 12px;
         }

         .question-card h5 {
            font-size: 0.95rem;
         }

         .form-check {
            padding: 6px;
         }

         .form-check-label {
            font-size: 0.85rem;
         }

         .timer {
            font-size: 12px;
            padding: 6px 12px;
         }
      }

      @media (min-width: 769px) and (max-width: 1024px) {
         .exam-container {
            padding: 15px;
         }

         .question-card {
            padding: 20px;
         }
      }/* 1. KONFIGURASI VIDEO (KECIL DI POJOK) */
      #video {
        position: fixed; /* Melayang tetap di posisi */
        bottom: 10px; /* Jarak dari bawah */
        left: 10px; /* Jarak dari kiri */

        width: 150px; /* Ukuran lebar kecil */
        height: 115px; /* Ukuran tinggi proporsional */

        border: 3px solid #333;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        z-index: 1000; /* Selalu di atas konten soal */
        background-color: black;
      }

      /* 2. KONFIGURASI LAYAR PERINGATAN (FULLSCREEN) */
      #fullscreen-alert {
        /* PENTING: Default-nya 'none' (sembunyi) */
        display: none;

        /* Membuat layer menutupi seluruh layar */
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;

        /* Warna Merah Transparan */
        background-color: rgba(220, 20, 60, 0.95);
        z-index: 9999; /* Paling atas menutupi segalanya */

        /* Menengahkan teks */
        justify-content: center;
        align-items: center;
        flex-direction: column;
      }

      #fullscreen-alert-text {
        color: white;
        font-size: 3em; /* Tulisan Besar */
        font-weight: bold;
        text-align: center;
        padding: 20px;
        text-transform: uppercase;
        border: 5px solid white;
        padding: 40px;
         background-color: rgba(0, 0, 0, 0.2); 
      }
   </style>
</head>

<body>
   <div class="container-fluid">
      <div class="exam-container">
         <div class="exam-header">
            <div class="row align-items-center">
               <div class="col-md-8 col-12 mb-3 mb-md-0">
                  @if(!$sesiUjian->hide_mata_pelajaran)
                     <h2 class="mb-2" style="font-size: clamp(1.1rem, 4vw, 1.5rem);">
                        <i class="bi bi-file-text me-2"></i>
                        {{ $sesiUjian->ujian->nama_ujian ?? 'Ujian' }}
                     </h2>
                     <p class="mb-0" style="font-size: clamp(0.85rem, 3vw, 1rem); word-wrap: break-word;">
                        <i class="bi bi-book me-2"></i>
                        <span class="d-inline d-sm-inline">{{ $sesiUjian->mata_pelajaran }}</span>
                        <span class="d-none d-sm-inline"> | </span><br class="d-sm-none">
                        <i class="bi bi-person me-2"></i>
                        {{ $peserta->nama_peserta ?? $peserta->nama ?? 'Peserta' }}
                     </p>
                  @else
                     <h2 class="mb-2" style="font-size: clamp(1.1rem, 4vw, 1.5rem);">
                        <i class="bi bi-file-text me-2"></i>
                        Selamat Mengerjakan
                     </h2>
                     <p class="mb-0" style="font-size: clamp(0.85rem, 3vw, 1rem);">
                        <i class="bi bi-person me-2"></i>
                        {{ $peserta->nama_peserta ?? $peserta->nama ?? 'Peserta' }}
                     </p>
                  @endif
               </div>
               <div class="col-md-4 col-12 text-md-end text-center">
                  <div class="timer" id="timer" style="display: inline-block;">
                     <i class="bi bi-clock me-2"></i>
                     <span id="timeDisplay">00:00:00</span>
                  </div>
               </div>
            </div>
         </div>

         @php
            $soalData = $soal->map(function($item, $index) {
               return [
                  'id' => $item->id_soal,
                  'durasi_soal' => $item->durasi_soal ?? null,
                  'pertanyaan' => $item->pertanyaan ?? '',
                  'tipe_soal' => $item->tipe_soal ?? '',
                  'opsi_a' => $item->opsi_a ?? '',
                  'opsi_b' => $item->opsi_b ?? '',
                  'opsi_c' => $item->opsi_c ?? '',
                  'opsi_d' => $item->opsi_d ?? '',
                  'opsi_e' => $item->opsi_e ?? null,
                  'opsi_f' => $item->opsi_f ?? null,
                  'gambar' => $item->gambar ?? null,
                  'poin' => $item->poin ?? 0,
                  'index' => $index
               ];
            })->toArray();
            $soalJson = json_encode($soalData, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
         @endphp
         <div id="examRoot" data-sesi-id="{{ $sesiUjian['id_sesi'] ?? '' }}"></div>
         <script type="application/json" id="soalDataJson">{!! $soalJson !!}</script>

         <form id="examForm">
            @csrf
            <div class="exam-container" id="questionContainer">
               
            </div>

            
            <div class="text-center mt-4" id="navigationButtons" style="display: none;">
               <div class="d-flex flex-column flex-sm-row gap-2 justify-content-center">
                  <button type="button" class="btn btn-secondary" id="prevBtn" style="padding: 10px 30px; font-size: 16px;">
                     <i class="bi bi-arrow-left me-1"></i> <span class="d-none d-sm-inline">Sebelumnya</span><span class="d-sm-none">Sebelum</span>
                  </button>
                  <button type="button" class="btn btn-primary" id="nextBtn" style="padding: 10px 30px; font-size: 16px;">
                     <span class="d-none d-sm-inline">Selanjutnya</span><span class="d-sm-none">Lanjut</span> <i class="bi bi-arrow-right ms-1"></i>
                  </button>
                  <button type="button" class="btn btn-success" id="finishBtn" style="padding: 10px 30px; font-size: 16px; display: none;">
                     <i class="bi bi-check-circle me-2"></i> Selesai
                  </button>
               </div>
            </div>
         </form>
      </div>
   </div>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
   <script>
      const examRoot = document.getElementById('examRoot');
      const sesiId = examRoot ? examRoot.dataset.sesiId : '';
      const soalDataJson = document.getElementById('soalDataJson');
      const soalData = soalDataJson ? JSON.parse(soalDataJson.textContent) : [];
      const hideNomorUrut = {{ $sesiUjian->hide_nomor_urut ? 'true' : 'false' }};
      const hidePoin = {{ $sesiUjian->hide_poin ? 'true' : 'false' }};
      
      let currentQuestionIndex = 0;
      let answers = {};
      let questionTimers = {};
      let timerInterval = null;
      let isSubmitting = false;
      let startTime = Date.now();

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

      function saveAnswers() {
         const backupData = {
            answers: answers,
            currentQuestionIndex: currentQuestionIndex,
            timestamp: new Date().toISOString()
         };
         localStorage.setItem('exam_backup_' + sesiId, JSON.stringify(backupData));
      }

      function renderQuestion(index) {
         if (index < 0 || index >= soalData.length) return;
         
         const question = soalData[index];
         const container = document.getElementById('questionContainer');
         
         saveCurrentAnswer();
         
         if (timerInterval) {
            clearInterval(timerInterval);
            timerInterval = null;
         }
         
         let html = '<div class="question-card">';
         html += '<div class="d-flex align-items-start mb-3 flex-wrap">';
         
         if (!hideNomorUrut) {
            html += '<div class="question-number flex-shrink-0">' + (index + 1) + '</div>';
         }
         
         html += '<div class="flex-grow-1" style="min-width: 0;">';
         html += '<h5 class="fw-bold mb-3" style="word-wrap: break-word; overflow-wrap: break-word;">' + escapeHtml(question.pertanyaan) + '</h5>';
         
         if (question.gambar) {
            html += '<div class="mb-3"><img src="/' + question.gambar + '" alt="Gambar Soal" class="img-fluid" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);"></div>';
         }
         
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
                  html += '<label class="form-check-label" for="soal' + question.id + '_' + key + '" style="word-wrap: break-word; overflow-wrap: break-word; cursor: pointer;">' + key + '. ' + escapeHtml(options[key]) + '</label>';
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
         
         updateNavigationButtons();
         
         startQuestionTimer(question);
         
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
               if (currentQuestionIndex < soalData.length - 1) {
                  nextQuestion();
               } else {
                  submitExam();
               }
            }
            timeLeft--;
         }
         
         updateTimer();
         timerInterval = setInterval(updateTimer, 1000);
      }

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

      function nextQuestion() {
         if (currentQuestionIndex < soalData.length - 1) {
            saveCurrentAnswer();
            currentQuestionIndex++;
            renderQuestion(currentQuestionIndex);
         }
      }

      function prevQuestion() {
         if (currentQuestionIndex > 0) {
            saveCurrentAnswer();
            currentQuestionIndex--;
            renderQuestion(currentQuestionIndex);
         }
      }

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

      function collectAnswers() {
         saveCurrentAnswer(); // Save current question answer
         return {
            jawaban: answers,
            waktu_pengerjaan: Math.round((Date.now() - startTime) / (1000 * 60))
         };
      }

      function confirmSubmitExam() {
         if (isSubmitting) return;
         
         const confirmed = confirm('Apakah Anda yakin ingin menyelesaikan ujian sesi ini?');
         if (confirmed) {
            submitExam();
         }
      }

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

      document.addEventListener('DOMContentLoaded', function() {
         loadSavedAnswers();
         renderQuestion(currentQuestionIndex);
         
         document.getElementById('nextBtn').addEventListener('click', nextQuestion);
         document.getElementById('prevBtn').addEventListener('click', prevQuestion);
         document.getElementById('finishBtn').addEventListener('click', confirmSubmitExam);
      });
   </script>
   <!-- ========================================== -->
   <!--       FITUR PENGAWASAN (CCTV ANTI-JOKI)    -->
   <!-- ========================================== -->

   <img id="ref-img-patrol" src="{{ asset('storage/' . $peserta->foto) }}" style="display: none;" crossorigin="anonymous">

   <!-- 2. VIDEO CCTV (KECIL DI POJOK) -->
   <video id="video-cctv" autoplay muted style="position: fixed; bottom: 10px; left: 10px; width: 150px; height: 115px; border: 3px solid #333; border-radius: 10px; z-index: 1000; object-fit: cover; background: black;"></video>

   <!-- 3. ALERT FULLSCREEN -->
   <div id="fullscreen-alert" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background-color: rgba(220, 20, 60, 0.95); z-index: 9999; justify-content: center; align-items: center; flex-direction: column;">
      <div id="fullscreen-alert-text" style="color: white; font-size: 2em; font-weight: bold; text-align: center; padding: 20px; border: 5px solid white; background-color: rgba(0,0,0,0.2);">
         PELANGGARAN TERDETEKSI!<br>
         <span id="alert-message" style="font-size: 0.6em; font-weight: normal;"></span>
      </div>
   </div>

   <!-- 4. LOAD LIBRARY DULUAN (PENTING!) -->
   <script src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

   <!-- 5. SCRIPT LOGIKA PATROLI -->
   <script>
      (function() { // Bungkus dalam fungsi agar variabel tidak bentrok
         const videoCCTV = document.getElementById('video-cctv');
         const refImgPatrol = document.getElementById('ref-img-patrol');
         const alertOverlay = document.getElementById('fullscreen-alert');
         const alertMessage = document.getElementById('alert-message');
         
         const MODEL_URL_PATROL = "https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/weights";
         let faceMatcherPatrol = null;
         let isPatrolRunning = false;

         // Load Model
         Promise.all([
            faceapi.nets.tinyFaceDetector.loadFromUri(MODEL_URL_PATROL),
            faceapi.nets.faceLandmark68Net.loadFromUri(MODEL_URL_PATROL),
            faceapi.nets.faceRecognitionNet.loadFromUri(MODEL_URL_PATROL),
            faceapi.nets.ssdMobilenetv1.loadFromUri(MODEL_URL_PATROL) // Untuk foto profil
         ]).then(initPatroli).catch(err => console.error("Gagal load AI:", err));

         async function initPatroli() {
            try {
               console.log("Memulai CCTV Patroli...");
               
               // A. Proses Foto Database
               if (refImgPatrol.complete) {
                   await processReference();
               } else {
                   refImgPatrol.onload = processReference;
               }

               async function processReference() {
                   const refDetection = await faceapi.detectSingleFace(refImgPatrol, new faceapi.SsdMobilenetv1Options())
                       .withFaceLandmarks().withFaceDescriptor();
                   
                   if (!refDetection) {
                       console.warn("Foto profil database tidak terbaca AI. Patroli Joki dinonaktifkan sementara.");
                       return;
                   }

                   faceMatcherPatrol = new faceapi.FaceMatcher(refDetection);
                   startWebcam();
               }

            } catch (e) {
               console.error("Error init patrol:", e);
            }
         }

         async function startWebcam() {
             try {
                 const stream = await navigator.mediaDevices.getUserMedia({ video: {} });
                 videoCCTV.srcObject = stream;
                 isPatrolRunning = true;
                 jalankanPatroli();
             } catch (err) {
                 console.error("Gagal akses kamera untuk patroli:", err);
                 alert("Wajib menyalakan kamera untuk ujian ini!");
             }
         }

         function jalankanPatroli() {
            // Cek setiap 5 detik
            setInterval(async () => {
               if (!isPatrolRunning || !faceMatcherPatrol) return;

               // 1. Deteksi Wajah di Webcam
               const detection = await faceapi.detectSingleFace(videoCCTV, new faceapi.TinyFaceDetectorOptions())
                  .withFaceLandmarks().withFaceDescriptor();

               if (detection) {
                  // 2. Bandingkan dengan Foto Database
                  const match = faceMatcherPatrol.findBestMatch(detection.descriptor);
                  
                  // Jika Unknown (Beda Orang)
                  if (match.label === 'unknown') {
                     tampilkanLayarMerah("WAJAH TIDAK SESUAI! (Indikasi Joki)");
                  } else {
                     // Jika Cocok, sembunyikan layar merah jika sedang tampil
                     alertOverlay.style.display = 'none';
                  }
               } else {
                  // Jika Wajah Hilang (Opsional: bisa ditegur juga)
                  // tampilkanLayarMerah("WAJAH TIDAK TERLIHAT!");
               }
            }, 5000); 
         }

         function tampilkanLayarMerah(pesan) {
            alertMessage.innerText = pesan;
            alertOverlay.style.display = 'flex';
            
            // Opsional: Kirim log ke server
            // console.log("Pelanggaran:", pesan);
         }
      })();
   </script>
</body>

</html>