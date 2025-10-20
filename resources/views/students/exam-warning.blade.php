<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Peringatan Ujian - {{ $sesiUjian->ujian->nama_ujian ?? 'Ujian' }}</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
   <style>
      body {
         background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
         min-height: 100vh;
         font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      }

      .warning-container {
         max-width: 900px;
         margin: 0 auto;
         padding: 40px 20px;
      }

      .warning-card {
         background: white;
         border-radius: 20px;
         padding: 40px;
         box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
      }

      .warning-header {
         text-align: center;
         margin-bottom: 40px;
      }

      .warning-title {
         color: #dc3545;
         font-size: 2.5rem;
         font-weight: bold;
         margin-bottom: 10px;
      }

      .warning-subtitle {
         color: #666;
         font-size: 1.2rem;
      }

      .warning-icon {
         font-size: 4rem;
         color: #dc3545;
         margin-bottom: 20px;
      }

      .prohibition-section {
         background: #f8d7da;
         border: 2px solid #f5c6cb;
         border-radius: 15px;
         padding: 30px;
         margin-bottom: 30px;
      }

      .prohibition-title {
         color: #721c24;
         font-size: 1.5rem;
         font-weight: bold;
         margin-bottom: 20px;
         text-align: center;
      }

      .prohibition-list {
         list-style: none;
         padding: 0;
      }

      .prohibition-item {
         background: white;
         border-radius: 10px;
         padding: 15px 20px;
         margin-bottom: 15px;
         border-left: 5px solid #dc3545;
         box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
         display: flex;
         align-items: center;
      }

      .prohibition-item:last-child {
         margin-bottom: 0;
      }

      .prohibition-icon {
         font-size: 1.5rem;
         color: #dc3545;
         margin-right: 15px;
      }

      .prohibition-text {
         color: #721c24;
         font-weight: 500;
         margin: 0;
      }

      .info-section {
         background: #d1ecf1;
         border: 2px solid #bee5eb;
         border-radius: 15px;
         padding: 30px;
         margin-bottom: 30px;
      }

      .info-title {
         color: #0c5460;
         font-size: 1.5rem;
         font-weight: bold;
         margin-bottom: 20px;
         text-align: center;
      }

      .info-list {
         list-style: none;
         padding: 0;
      }

      .info-item {
         background: white;
         border-radius: 10px;
         padding: 15px 20px;
         margin-bottom: 15px;
         border-left: 5px solid #17a2b8;
         box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
         display: flex;
         align-items: center;
      }

      .info-item:last-child {
         margin-bottom: 0;
      }

      .info-icon {
         font-size: 1.5rem;
         color: #17a2b8;
         margin-right: 15px;
      }

      .info-text {
         color: #0c5460;
         font-weight: 500;
         margin: 0;
      }

      .agreement-section {
         background: #fff3cd;
         border: 2px solid #ffeaa7;
         border-radius: 15px;
         padding: 30px;
         margin-bottom: 30px;
      }

      .agreement-checkbox {
         transform: scale(1.5);
         margin-right: 15px;
      }

      .agreement-label {
         font-size: 1.1rem;
         font-weight: bold;
         color: #856404;
      }

      .start-btn {
         background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
         border: none;
         padding: 20px 60px;
         font-size: 1.3rem;
         font-weight: bold;
         border-radius: 50px;
         color: white;
         box-shadow: 0 15px 40px rgba(40, 167, 69, 0.3);
         transition: all 0.3s ease;
      }

      .start-btn:hover {
         transform: translateY(-3px);
         box-shadow: 0 20px 50px rgba(40, 167, 69, 0.4);
         color: white;
      }

      .start-btn:disabled {
         background: #6c757d;
         box-shadow: none;
         transform: none;
      }
   </style>
</head>

<body>
   <div class="warning-container">
      <div class="warning-card">
         <!-- Header -->
         <div class="warning-header">
            <div class="warning-icon">
               <i class="bi bi-shield-exclamation"></i>
            </div>
            <h1 class="warning-title">PERINGATAN PENTING</h1>
            <p class="warning-subtitle">Aturan dan Larangan Ujian Online</p>
         </div>

         <!-- Larangan Ketat -->
         <div class="prohibition-section">
            <h3 class="prohibition-title">
               <i class="bi bi-exclamation-triangle me-2"></i>
               LARANGAN KETAT
            </h3>
            <ul class="prohibition-list">
               <li class="prohibition-item">
                  <i class="bi bi-x-circle prohibition-icon"></i>
                  <p class="prohibition-text">
                     <strong>DILARANG</strong> membuka tab browser lain atau aplikasi lain selama ujian
                  </p>
               </li>
               <li class="prohibition-item">
                  <i class="bi bi-x-circle prohibition-icon"></i>
                  <p class="prohibition-text">
                     <strong>DILARANG</strong> menggunakan kalkulator, HP, atau alat bantu apapun
                  </p>
               </li>
               <li class="prohibition-item">
                  <i class="bi bi-x-circle prohibition-icon"></i>
                  <p class="prohibition-text">
                     <strong>DILARANG</strong> berkomunikasi dengan peserta lain atau orang lain
                  </p>
               </li>
               <li class="prohibition-item">
                  <i class="bi bi-x-circle prohibition-icon"></i>
                  <p class="prohibition-text">
                     <strong>DILARANG</strong> menutup browser, refresh halaman, atau keluar dari ujian
                  </p>
               </li>
               <li class="prohibition-item">
                  <i class="bi bi-x-circle prohibition-icon"></i>
                  <p class="prohibition-text">
                     <strong>DILARANG</strong> menggunakan buku, catatan, atau referensi apapun
                  </p>
               </li>
               <li class="prohibition-item">
                  <i class="bi bi-x-circle prohibition-icon"></i>
                  <p class="prohibition-text">
                     <strong>DILARANG</strong> mengambil screenshot atau merekam layar
                  </p>
               </li>
            </ul>
         </div>

         <!-- Informasi Penting -->
         <div class="info-section">
            <h3 class="info-title">
               <i class="bi bi-info-circle me-2"></i>
               INFORMASI PENTING
            </h3>
            <ul class="info-list">
               <li class="info-item">
                  <i class="bi bi-clock info-icon"></i>
                  <p class="info-text">
                     <strong>Waktu Ujian:</strong> {{ $sesiUjian->durasi_menit }} menit
                  </p>
               </li>
               <li class="info-item">
                  <i class="bi bi-file-text info-icon"></i>
                  <p class="info-text">
                     <strong>Jumlah Soal:</strong> {{ $soal->count() }} soal
                  </p>
               </li>
               <li class="info-item">
                  <i class="bi bi-book info-icon"></i>
                  <p class="info-text">
                     <strong>Mata Pelajaran:</strong> {{ $sesiUjian->mata_pelajaran }}
                  </p>
               </li>
               <li class="info-item">
                  <i class="bi bi-layout-text-window info-icon"></i>
                  <p class="info-text">
                     <strong>Format Ujian:</strong> Semua soal ditampilkan dalam 1 halaman
                  </p>
               </li>
               <li class="info-item">
                  <i class="bi bi-person info-icon"></i>
                  <p class="info-text">
                     <strong>Peserta:</strong> {{ $peserta->nama_peserta ?? $peserta->nama ?? 'Peserta' }}
                  </p>
               </li>
            </ul>
         </div>

         <!-- Persetujuan -->
         <div class="agreement-section">
            <div class="d-flex justify-content-center align-items-center">
               <input class="form-check-input agreement-checkbox" type="checkbox" id="agreeTerms">
               <label class="form-check-label agreement-label" for="agreeTerms">
                  Saya telah membaca, memahami, dan menyetujui semua aturan dan larangan di atas
               </label>
            </div>
         </div>

         <!-- Tombol Mulai Ujian -->
         <div class="text-center">
            <button type="button" class="btn start-btn" id="startExamBtn" disabled>
               <i class="bi bi-play-fill me-2"></i>
               MULAI UJIAN
            </button>
         </div>
      </div>
   </div>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
   <script>
      // Handle agreement checkbox
      const agreeCheckbox = document.getElementById('agreeTerms');
      const startBtn = document.getElementById('startExamBtn');

      agreeCheckbox.addEventListener('change', function() {
         startBtn.disabled = !this.checked;
      });

      // Handle start exam
      startBtn.addEventListener('click', function() {
         if (confirm('Apakah Anda yakin ingin memulai ujian? Pastikan Anda sudah siap dan memahami semua aturan.')) {
            window.location.href = `/student/exam/{{ $sesiUjian->id_sesi }}`;
         }
      });
   </script>
</body>

</html>