<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Informasi Ujian - {{ $sesiUjian->ujian->nama_ujian ?? 'Ujian' }}</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
   <style>
      body {
         background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
         min-height: 100vh;
         font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      }

      .exam-info-container {
         max-width: 800px;
         margin: 0 auto;
         padding: 40px 20px;
      }

      .info-card {
         background: white;
         border-radius: 20px;
         padding: 40px;
         box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
         text-align: center;
      }

      .info-header {
         margin-bottom: 40px;
      }

      .info-title {
         color: #333;
         font-size: 2.5rem;
         font-weight: bold;
         margin-bottom: 10px;
      }

      .info-subtitle {
         color: #666;
         font-size: 1.2rem;
      }

      .info-section {
         background: #f8f9fa;
         border-radius: 15px;
         padding: 30px;
         margin-bottom: 30px;
         border-left: 5px solid #667eea;
      }

      .info-item {
         display: flex;
         align-items: center;
         margin-bottom: 20px;
         padding: 15px;
         background: white;
         border-radius: 10px;
         box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
      }

      .info-item:last-child {
         margin-bottom: 0;
      }

      .info-icon {
         width: 50px;
         height: 50px;
         border-radius: 50%;
         display: flex;
         align-items: center;
         justify-content: center;
         margin-right: 20px;
         font-size: 1.5rem;
      }

      .info-icon.participant {
         background: linear-gradient(135deg, #667eea, #764ba2);
         color: white;
      }

      .info-icon.code {
         background: linear-gradient(135deg, #f093fb, #f5576c);
         color: white;
      }

      .info-icon.time {
         background: linear-gradient(135deg, #4facfe, #00f2fe);
         color: white;
      }

      .info-icon.subject {
         background: linear-gradient(135deg, #43e97b, #38f9d7);
         color: white;
      }

      .info-content {
         flex-grow: 1;
         text-align: left;
      }

      .info-label {
         font-size: 0.9rem;
         color: #666;
         margin-bottom: 5px;
         font-weight: 500;
      }

      .info-value {
         font-size: 1.3rem;
         color: #333;
         font-weight: bold;
      }

      .next-btn {
         background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
         border: none;
         padding: 15px 50px;
         font-size: 1.2rem;
         font-weight: bold;
         border-radius: 50px;
         color: white;
         box-shadow: 0 10px 30px rgba(40, 167, 69, 0.3);
         transition: all 0.3s ease;
      }

      .next-btn:hover {
         transform: translateY(-3px);
         box-shadow: 0 15px 40px rgba(40, 167, 69, 0.4);
         color: white;
      }

      .warning-text {
         background: #fff3cd;
         border: 1px solid #ffeaa7;
         border-radius: 10px;
         padding: 20px;
         margin-top: 30px;
         color: #856404;
         font-weight: 500;
      }

      .time-display {
         font-family: 'Courier New', monospace;
         font-size: 1.4rem;
      }
   </style>
</head>

<body>
   <div class="exam-info-container">
      <div class="info-card">
         <!-- Header -->
         <div class="info-header">
            <h1 class="info-title">
               <i class="bi bi-file-text me-3"></i>
               Informasi Ujian
            </h1>
            <p class="info-subtitle">Silakan periksa informasi ujian Anda dengan teliti</p>
         </div>

         <!-- Informasi Peserta -->
         <div class="info-section">
            <h4 class="mb-4">
               <i class="bi bi-person-circle me-2"></i>
               Data Peserta
            </h4>

            <div class="info-item">
               <div class="info-icon participant">
                  <i class="bi bi-person"></i>
               </div>
               <div class="info-content">
                  <div class="info-label">Nama Peserta</div>
                  <div class="info-value">{{ $peserta->nama_peserta ?? $peserta->nama ?? 'Peserta' }}</div>
               </div>
            </div>

            <div class="info-item">
               <div class="info-icon code">
                  <i class="bi bi-key"></i>
               </div>
               <div class="info-content">
                  <div class="info-label">Kode Peserta</div>
                  <div class="info-value">{{ $peserta->kode_peserta ?? 'N/A' }}</div>
               </div>
            </div>
         </div>

         <!-- Informasi Ujian -->
         <div class="info-section">
            <h4 class="mb-4">
               <i class="bi bi-calendar-check me-2"></i>
               Detail Ujian
            </h4>

            <div class="info-item">
               <div class="info-icon time">
                  <i class="bi bi-clock"></i>
               </div>
               <div class="info-content">
                  <div class="info-label">Waktu Mulai</div>
                  <div class="info-value time-display">
                     {{ \Carbon\Carbon::parse($sesiUjian->tanggal_mulai)->format('d/m/Y H:i') }}
                  </div>
               </div>
            </div>

            <div class="info-item">
               <div class="info-icon time">
                  <i class="bi bi-clock-fill"></i>
               </div>
               <div class="info-content">
                  <div class="info-label">Waktu Selesai</div>
                  <div class="info-value time-display">
                     {{ \Carbon\Carbon::parse($sesiUjian->tanggal_selesai)->format('d/m/Y H:i') }}
                  </div>
               </div>
            </div>

            <div class="info-item">
               <div class="info-icon subject">
                  <i class="bi bi-book"></i>
               </div>
               <div class="info-content">
                  <div class="info-label">Mata Pelajaran</div>
                  <div class="info-value">{{ $sesiUjian->mata_pelajaran }}</div>
               </div>
            </div>

            <div class="info-item">
               <div class="info-icon time">
                  <i class="bi bi-hourglass-split"></i>
               </div>
               <div class="info-content">
                  <div class="info-label">Durasi Ujian</div>
                  <div class="info-value">{{ $sesiUjian->durasi_menit }} menit</div>
               </div>
            </div>
         </div>

         <!-- Pemberitahuan -->
         <div class="warning-text">
            <i class="bi bi-info-circle me-2"></i>
            <strong>Pemberitahuan:</strong> Pastikan Anda telah membaca dan memahami semua informasi di atas.
            Setelah menekan tombol "Lanjut", Anda akan diarahkan ke halaman peringatan dan larangan ujian.
         </div>

         <!-- Tombol Next -->
         <div class="text-center mt-4">
            <button type="button" class="btn next-btn" id="nextBtn">
               <i class="bi bi-arrow-right me-2"></i>
               LANJUT
            </button>
         </div>
      </div>
   </div>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
   <script>
      document.getElementById('nextBtn').addEventListener('click', function() {
         // Redirect ke halaman peringatan
         window.location.href = `/student/exam/{{ $sesiUjian->id_sesi }}/warning`;
      });
   </script>
</body>

</html>