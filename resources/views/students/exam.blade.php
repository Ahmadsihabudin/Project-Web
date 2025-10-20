<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Ujian Online - {{ $sesiUjian->ujian->nama_ujian ?? 'Ujian' }}</title>
   <meta name="csrf-token" content="{{ csrf_token() }}">
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
                     'A' => $item->jawaban_a,
                     'B' => $item->jawaban_b,
                     'C' => $item->jawaban_c,
                     'D' => $item->jawaban_d
                     ];
                     @endphp

                     @foreach($options as $key => $option)
                     @if($option)
                     <div class="form-check mb-3">
                        <input class="form-check-input" type="radio"
                           name="jawaban[{{ $item->id }}]"
                           value="{{ $key }}"
                           id="soal{{ $item->id }}_{{ $key }}">
                        <label class="form-check-label fw-bold" for="soal{{ $item->id }}_{{ $key }}">
                           {{ $key }}. {{ $option }}
                        </label>
                     </div>
                     @endif
                     @endforeach
                  </div>
                  @elseif($item->tipe_soal === 'essay')
                  <div class="form-group">
                     <textarea class="form-control"
                        name="jawaban[{{ $item->id }}]"
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

         <!-- Submit Button -->
         <div class="text-center mt-4">
            <button type="submit" class="submit-btn" id="submitBtn">
               <i class="bi bi-check-circle me-2"></i>
               SELESAIKAN UJIAN
            </button>
         </div>
      </form>
   </div>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
   <script>
      let timeLeft = {
         {
            $sesiUjian - > durasi_menit * 60
         }
      }; // Convert to seconds
      let timerInterval;

      // Start timer on page load
      document.addEventListener('DOMContentLoaded', function() {
         startTimer();
      });

      function startTimer() {
         timerInterval = setInterval(function() {
            timeLeft--;
            updateTimerDisplay();

            if (timeLeft <= 0) {
               clearInterval(timerInterval);
               alert('Waktu ujian telah habis! Jawaban akan otomatis disimpan.');
               submitExam();
            }
         }, 1000);
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

      function submitExam() {
         const form = document.getElementById('examForm');
         const formData = new FormData(form);

         // Convert FormData to JSON
         const data = {};
         for (let [key, value] of formData.entries()) {
            if (key.startsWith('jawaban[')) {
               const soalId = key.match(/\[(\d+)\]/)[1];
               if (!data.jawaban) data.jawaban = {};
               data.jawaban[soalId] = value;
            }
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
                  alert('Ujian berhasil diselesaikan!');
                  window.location.href = '/student/dashboard';
               } else {
                  alert('Terjadi kesalahan: ' + result.message);
               }
            })
            .catch(error => {
               console.error('Error:', error);
               alert('Terjadi kesalahan saat menyimpan jawaban');
            });
      }

      // Handle form submission
      document.getElementById('examForm').addEventListener('submit', function(e) {
         e.preventDefault();

         if (confirm('Apakah Anda yakin ingin menyelesaikan ujian? Pastikan semua jawaban sudah diisi.')) {
            submitExam();
         }
      });

      // Prevent page refresh/close
      window.addEventListener('beforeunload', function(e) {
         e.preventDefault();
         e.returnValue = 'Apakah Anda yakin ingin meninggalkan halaman ujian? Jawaban yang belum disimpan akan hilang.';
      });
   </script>
</body>

</html>