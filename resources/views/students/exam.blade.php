<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Ujian Online - {{ $sesiUjian->ujian->nama_ujian ?? 'Ujian' }}</title>
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

         <div id="examRoot" data-time-left="{{ (($sesiUjian['durasi_menit'] ?? 0) * 60) }}" data-sesi-id="{{ $sesiUjian['id_sesi'] ?? '' }}"></div>

         <form id="examForm">
            @csrf
            <div class="exam-container">
               @foreach($soal as $index => $item)
               <div class="question-card" id="soal-{{ $item->id_soal }}">
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
                           'D' => $item->opsi_d,
                           'E' => $item->opsi_e ?? null,
                           'F' => $item->opsi_f ?? null,
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
                        @elseif($item->tipe_soal === 'true_false')
                        <div class="options">
                           <div class="form-check mb-3">
                              <input class="form-check-input jawaban-radio" type="radio"
                                 name="jawaban_{{ $item->id_soal }}"
                                 value="true"
                                 data-id="{{ $item->id_soal }}"
                                 id="soal{{ $item->id_soal }}_true">
                              <label class="form-check-label fw-bold" for="soal{{ $item->id_soal }}_true">Benar</label>
                           </div>
                           <div class="form-check mb-3">
                              <input class="form-check-input jawaban-radio" type="radio"
                                 name="jawaban_{{ $item->id_soal }}"
                                 value="false"
                                 data-id="{{ $item->id_soal }}"
                                 id="soal{{ $item->id_soal }}_false">
                              <label class="form-check-label fw-bold" for="soal{{ $item->id_soal }}_false">Salah</label>
                           </div>
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

               <div class="text-center mt-4">
                  <button type="submit" class="submit-btn" id="submitBtn">
                     <i class="bi bi-check-circle me-2"></i>
                     SELESAIKAN UJIAN
                  </button>
               </div>
            </div>
         </form>
      </div>
   </div>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
   <script>
      const examRoot = document.getElementById('examRoot');
      let timeLeft = parseInt((examRoot && examRoot.dataset.timeLeft) ? examRoot.dataset.timeLeft : '0', 10);
      let timerInterval;
      let isSubmitting = false;
      let startTime = Date.now();
      let networkFailureCount = 0;
      let hasResumedOnce = false;

      document.addEventListener('DOMContentLoaded', function() {
         const backup = localStorage.getItem('exam_backup_{{ $sesiUjian->id_sesi }}');
         if (backup) {
            try {
               const backupData = JSON.parse(backup);
               networkFailureCount = backupData.failureCount || 0;
               hasResumedOnce = backupData.hasResumedOnce || false;
               if (backupData.timeLeft && Number.isFinite(backupData.timeLeft)) {
                  timeLeft = Math.max(0, backupData.timeLeft);
               }
               if (backupData.jawaban && typeof backupData.jawaban === 'object') {
                  Object.keys(backupData.jawaban).forEach(function(soalId) {
                     const val = backupData.jawaban[soalId];
                     const radios = document.querySelectorAll('input[name="jawaban_' + soalId + '"]');
                     if (radios.length) {
                        radios.forEach(function(r) {
                           r.checked = (r.value === String(val));
                        });
                     } else {
                        const textarea = document.querySelector('textarea[name="jawaban[' + soalId + ']"]');
                        if (textarea) textarea.value = String(val);
                     }
                  });
               }
            } catch (_) {
               localStorage.removeItem('exam_backup_{{ $sesiUjian->id_sesi }}');
            }
         }

         startTimer();
         monitorNetworkConnection();
         monitorRadioButtons();
      });

      function startTimer() {
         updateTimerDisplay();
         timerInterval = setInterval(function() {
            timeLeft--;
            updateTimerDisplay();
            if (timeLeft <= 0) {
               clearInterval(timerInterval);
               if (!isSubmitting) {
                  if (navigator.onLine) {
                     submitExam();
                  } else {
                     networkFailureCount++;
                     saveToLocalStorage();
                     if (networkFailureCount >= 2) submitExamFinal();
                  }
               }
            }
         }, 1000);
      }

      function monitorNetworkConnection() {
         window.addEventListener('offline', function() {
            networkFailureCount++;
            saveToLocalStorage();
            if (networkFailureCount >= 2 && !isSubmitting) submitExamFinal();
         });
      }

      function monitorRadioButtons() {
         document.querySelectorAll('.jawaban-radio').forEach(function(r) {
            r.addEventListener('change', function() {
               saveToLocalStorage();
            });
         });
         document.querySelectorAll('textarea[name^="jawaban["]').forEach(function(t) {
            t.addEventListener('input', function() {
               saveToLocalStorage();
            });
         });
      }

      function saveToLocalStorage() {
         const data = collectAnswers();
         const backupData = {
            data: data,
            timestamp: new Date().toISOString(),
            timeLeft: timeLeft,
            sesiId: (examRoot && examRoot.dataset.sesiId) ? examRoot.dataset.sesiId : null,
            reason: 'network_issue',
            failureCount: networkFailureCount,
            hasResumedOnce: hasResumedOnce
         };
         localStorage.setItem('exam_backup_{{ $sesiUjian->id_sesi }}', JSON.stringify(backupData));
      }

      function collectAnswers() {
         const data = {
            jawaban: {},
            waktu_pengerjaan: 0
         };
         document.querySelectorAll('input.jawaban-radio:checked').forEach(function(input) {
            const soalId = input.getAttribute('data-id');
            data.jawaban[soalId] = input.value;
         });
         document.querySelectorAll('textarea[name^="jawaban["]').forEach(function(textarea) {
            const match = textarea.getAttribute('name').match(/jawaban\[(\d+)\]/);
            if (match) {
               data.jawaban[match[1]] = textarea.value;
            }
         });
         const endTime = Date.now();
         const timeSpentMs = endTime - startTime;
         data.waktu_pengerjaan = Math.round(timeSpentMs / (1000 * 60));
         return data;
      }

      function submitExamFinal() {
         const data = collectAnswers();
         const backupData = {
            data: data,
            timestamp: new Date().toISOString(),
            timeLeft: timeLeft,
            sesiId: (examRoot && examRoot.dataset.sesiId) ? examRoot.dataset.sesiId : null,
            reason: 'network_failure_final'
         };
         localStorage.setItem('exam_backup_final_{{ $sesiUjian->id_sesi }}', JSON.stringify(backupData));
         window.location.replace('/student/selesai');
      }

      function submitExam() {
         if (isSubmitting) return;
         isSubmitting = true;
         const data = collectAnswers();
         const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
         fetch(`/student/exam/{{ $sesiUjian->id_sesi }}/submit`, {
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
                  localStorage.removeItem('exam_backup_{{ $sesiUjian->id_sesi }}');
                  Object.keys(localStorage).forEach(function(key) {
                     if (key.startsWith('jawaban_')) localStorage.removeItem(key);
                  });
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
            .catch(function() {
               networkFailureCount++;
               saveToLocalStorage();
               if (networkFailureCount >= 2) submitExamFinal();
               else isSubmitting = false;
            });
      }

      function updateTimerDisplay() {
         const hours = Math.floor(timeLeft / 3600);
         const minutes = Math.floor((timeLeft % 3600) / 60);
         const seconds = timeLeft % 60;
         const timeString = String(hours).padStart(2, '0') + ':' + String(minutes).padStart(2, '0') + ':' + String(seconds).padStart(2, '0');
         document.getElementById('timeDisplay').textContent = timeString;
         if (timeLeft <= 300) {
            document.getElementById('timer').style.background = '#dc3545';
         } else if (timeLeft <= 600) {
            document.getElementById('timer').style.background = '#ffc107';
            document.getElementById('timer').style.color = '#000';
         }
      }

      document.getElementById('examForm').addEventListener('submit', function(e) {
         e.preventDefault();
         submitExam();
      });
   </script>
</body>

</html>