@extends('layouts.student-navbar')

@section('title', 'Informasi Ujian - Dashboard Siswa')

@section('content')
<style>
   body {
      background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
      min-height: 100vh;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
   }

   .info-container {
      max-width: 1000px;
      margin: 0 auto;
      padding: 20px 15px;
      animation: fadeInUp 0.8s ease-out;
   }

   @keyframes fadeInUp {
      from {
         opacity: 0;
         transform: translateY(30px);
      }

      to {
         opacity: 1;
         transform: translateY(0);
      }
   }


   .info-card {
      background: white;
      border-radius: 15px;
      padding: 25px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      animation: fadeInUp 0.8s ease-out 0.2s both;
   }

   .info-header {
      text-align: center;
      margin-bottom: 25px;
   }

   .info-title {
      color: #333;
      font-size: 1.8rem;
      font-weight: bold;
      margin-bottom: 8px;
   }

   .info-subtitle {
      color: #666;
      font-size: 1rem;
   }

   .welcome-section {
      margin-top: 50px;
      background: #991B1B;
      color: white;
      border-radius: 12px;
      border: 3px solid #fff;
      box-shadow: 0 0 20px rgba(255, 255, 255, 0.3), 0 8px 25px rgba(0, 0, 0, 0.15);
      padding: 20px;
      margin-bottom: 20px;
      text-align: center;
      animation: fadeInDown 0.6s ease-out;
      position: relative;
      overflow: hidden;
   }

   .welcome-section::before {
      content: '';
      position: absolute;
      top: -2px;
      left: -2px;
      right: -2px;
      bottom: -2px;
      background: linear-gradient(45deg, #fff, transparent, #fff);
      border-radius: 14px;
      z-index: -1;
      animation: borderGlow 3s ease-in-out infinite;
   }

   @keyframes borderGlow {

      0%,
      100% {
         opacity: 0.8;
      }

      50% {
         opacity: 1;
      }
   }

   @keyframes fadeInDown {
      from {
         opacity: 0;
         transform: translateY(-20px);
      }

      to {
         opacity: 1;
         transform: translateY(0);
      }
   }

   .welcome-section.no-schedule {
      background: linear-gradient(135deg, #ff6b6b, #ee5a24);
   }

   .welcome-section.no-schedule .welcome-title {
      font-size: 1.4rem;
   }

   .welcome-section.no-schedule .welcome-subtitle {
      font-size: 0.9rem;
      opacity: 0.95;
   }

   .welcome-title {
      font-size: 1.5rem;
      font-weight: bold;
      margin-bottom: 8px;
   }

   .welcome-subtitle {
      font-size: 0.95rem;
      opacity: 0.9;
   }

   .info-section {
      background: #f8f9fa;
      border-radius: 12px;
      padding: 20px;
      margin-bottom: 20px;
      border-left: 4px solid maroon;
   }

   .info-item {
      display: flex;
      align-items: center;
      margin-bottom: 0;
      padding: 12px;
      background: white;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
      height: 100%;
      animation: fadeInUp 0.6s ease-out;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      opacity: 0;
      animation-fill-mode: forwards;
   }

   .info-item:nth-child(1) {
      animation-delay: 0.1s;
   }

   .info-item:nth-child(2) {
      animation-delay: 0.2s;
   }

   .info-item:nth-child(3) {
      animation-delay: 0.3s;
   }

   .info-item:nth-child(4) {
      animation-delay: 0.4s;
   }

   .info-item:nth-child(5) {
      animation-delay: 0.5s;
   }

   .info-item:nth-child(6) {
      animation-delay: 0.6s;
   }

   .info-item:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
   }

   .info-item:last-child {
      margin-bottom: 0;
   }

   .row.g-3>* {
      padding-right: calc(var(--bs-gutter-x) * 0.5);
      padding-left: calc(var(--bs-gutter-x) * 0.5);
      margin-bottom: 12px;
   }

   .info-icon {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-right: 15px;
      font-size: 1.2rem;
      transition: transform 0.3s ease;
   }

   .info-icon:hover {
      transform: scale(1.1) rotate(5deg);
   }

   .info-icon.participant {
      background: linear-gradient(135deg, #667eea, #764ba2);
      color: white;
   }

   .info-icon.code {
      background: linear-gradient(135deg, #f093fb, #f5576c);
      color: white;
   }

   .info-icon.batch {
      background: linear-gradient(135deg, #4facfe, #00f2fe);
      color: white;
   }

   .info-icon.email {
      background: linear-gradient(135deg, #ff6b6b, #ee5a24);
      color: white;
   }

   .info-icon.school {
      background: linear-gradient(135deg, #4834d4, #686de0);
      color: white;
   }

   .info-icon.major {
      background: linear-gradient(135deg, #00d2d3, #54a0ff);
      color: white;
   }

   .info-content {
      flex-grow: 1;
      text-align: left;
   }

   .info-label {
      font-size: 0.8rem;
      color: #666;
      margin-bottom: 3px;
      font-weight: 500;
   }

   .info-value {
      font-size: 1.1rem;
      color: #333;
      font-weight: bold;
   }


   .btn-primary {
      background: linear-gradient(135deg, #991B1B, #B91C1C);
      border: none;
      color: white;
      padding: 12px 25px;
      font-size: 1rem;
      font-weight: bold;
      border-radius: 25px;
      box-shadow: 0 6px 20px rgba(153, 27, 27, 0.3);
      transition: all 0.3s ease;
      text-decoration: none;
      display: inline-block;
      animation: fadeInUp 0.8s ease-out 0.4s both;
   }

   .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(153, 27, 27, 0.4);
      color: white;
   }

   .btn-primary.disabled {
      background: #6c757d;
      cursor: not-allowed;
      transform: none;
      box-shadow: none;
      pointer-events: none;
   }

   .btn-primary.disabled:hover {
      transform: none;
      box-shadow: none;
   }

   /* Ensure button is clickable when not disabled */
   .btn-primary:not(.disabled) {
      cursor: pointer;
      pointer-events: auto;
   }

   .text-white-50 {
      color: rgba(255, 255, 255, 0.7) !important;
   }

   /* Responsive Design */
   @media (max-width: 768px) {
      .info-container {
         padding: 15px 10px;
      }

      .info-card {
         padding: 20px;
      }

      .welcome-section {
         padding: 15px;
         margin-bottom: 15px;
      }

      .welcome-title {
         font-size: 1.3rem;
      }

      .welcome-subtitle {
         font-size: 0.9rem;
      }

      .info-title {
         font-size: 1.5rem;
      }

      .info-subtitle {
         font-size: 0.9rem;
      }

      .info-section {
         padding: 15px;
         margin-bottom: 15px;
      }

      .info-item {
         padding: 10px;
         margin-bottom: 0;
      }

      .row.g-3>* {
         margin-bottom: 10px;
      }

      .info-icon {
         width: 35px;
         height: 35px;
         margin-right: 12px;
         font-size: 1rem;
      }

      .info-label {
         font-size: 0.75rem;
      }

      .info-value {
         font-size: 1rem;
      }

      .btn-primary {
         padding: 10px 20px;
         font-size: 0.9rem;
      }
   }

   /* Mobile: Single column layout */
   @media (max-width: 576px) {
      .col-md-6 {
         flex: 0 0 100%;
         max-width: 100%;
      }
   }
</style>

<div class="info-container">
   <!-- Welcome Section -->
   <div class="welcome-section" id="welcomeSection">
      <h1 class="welcome-title">
         <i class="bi bi-person-circle me-3"></i>
         <span id="welcomeTitle">Selamat Datang di Sistem Ujian Online</span>
      </h1>
      <p class="welcome-subtitle">
         <span id="welcomeSubtitle">Silakan periksa informasi ujian anda</span>
      </p>
   </div>

   <!-- Student Information Only -->
   <div class="info-card">
      <div class="info-header">
         <h2 class="info-title">
            <i class="bi bi-person-badge me-3"></i>
            Informasi Peserta
         </h2>
         <p class="info-subtitle">Data pribadi dan informasi batch Anda</p>
      </div>

      <div class="info-section">
         <div class="row g-3">
            <div class="col-md-6">
               <div class="info-item">
                  <div class="info-icon participant">
                     <i class="bi bi-person"></i>
                  </div>
                  <div class="info-content">
                     <div class="info-label">Nama Peserta</div>
                     <div class="info-value" id="studentName">{{ $initialPeserta['nama'] ?? 'Memuat...' }}</div>
                  </div>
               </div>
            </div>

            <div class="col-md-6">
               <div class="info-item">
                  <div class="info-icon code">
                     <i class="bi bi-key"></i>
                  </div>
                  <div class="info-content">
                     <div class="info-label">Kode Peserta</div>
                     <div class="info-value" id="studentCode">{{ $initialPeserta['kode_peserta'] ?? 'Memuat...' }}</div>
                  </div>
               </div>
            </div>

            <div class="col-md-6">
               <div class="info-item">
                  <div class="info-icon batch">
                     <i class="bi bi-people"></i>
                  </div>
                  <div class="info-content">
                     <div class="info-label">Batch</div>
                     <div class="info-value" id="studentBatch">{{ $initialPeserta['batch'] ?? 'Memuat...' }}</div>
                  </div>
               </div>
            </div>

            <div class="col-md-6">
               <div class="info-item">
                  <div class="info-icon email">
                     <i class="bi bi-envelope"></i>
                  </div>
                  <div class="info-content">
                     <div class="info-label">Email</div>
                     <div class="info-value" id="studentEmail">{{ $initialPeserta['email'] ?? 'Memuat...' }}</div>
                  </div>
               </div>
            </div>

            <div class="col-md-6">
               <div class="info-item">
                  <div class="info-icon school">
                     <i class="bi bi-building"></i>
                  </div>
                  <div class="info-content">
                     <div class="info-label">Asal Sekolah</div>
                     <div class="info-value" id="studentSchool">{{ $initialPeserta['asal_smk'] ?? 'Memuat...' }}</div>
                  </div>
               </div>
            </div>

            <div class="col-md-6">
               <div class="info-item">
                  <div class="info-icon major">
                     <i class="bi bi-book"></i>
                  </div>
                  <div class="info-content">
                     <div class="info-label">Jurusan</div>
                     <div class="info-value" id="studentMajor">{{ $initialPeserta['jurusan'] ?? 'Memuat...' }}</div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- Next to Exam Info Button -->
   <div class="text-center mt-3 mb-3">
      @if(isset($initialExamInfoUrl) && !empty($initialExamInfoUrl) && $initialExamInfoUrl !== '#')
      <a id="nextExamBtn" href="{{ $initialExamInfoUrl }}" class="btn btn-primary" role="button">
         <i class="bi bi-arrow-right-circle me-2"></i>
         Next
      </a>
      @elseif(isset($initialExamId) && !empty($initialExamId))
      <a id="nextExamBtn" href="{{ route('student.exam.info-warning', $initialExamId) }}" class="btn btn-primary" role="button">
         <i class="bi bi-arrow-right-circle me-2"></i>
         Next
      </a>
      @else
      <a id="nextExamBtn" href="#" class="btn btn-primary" role="button">
         <i class="bi bi-arrow-right-circle me-2"></i>
         Next
      </a>
      @endif
   </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
   async function loadUserInfo() {
      try {
         const response = await fetch('/student/exam/data', {
            method: 'GET',
            headers: {
               'Accept': 'application/json'
            },
            credentials: 'same-origin'
         });

         if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
         }

         const result = await response.json();

         if (result.success && result.peserta) {
            // Update student info
            document.getElementById('studentName').textContent = result.peserta.nama || 'Peserta';
            document.getElementById('studentCode').textContent = result.peserta.kode_peserta || 'N/A';
            document.getElementById('studentBatch').textContent = result.peserta.batch || 'N/A';
            document.getElementById('studentEmail').textContent = result.peserta.email || 'N/A';
            document.getElementById('studentSchool').textContent = result.peserta.asal_smk || 'N/A';
            document.getElementById('studentMajor').textContent = result.peserta.jurusan || 'N/A';
         }
      } catch (error) {
         // Error loading user info
      }
   }
</script>

@if(session('error'))
<script id="session-error-data" type="application/json">
   @json(session('error'))
</script>
@endif

<script>
   document.addEventListener('DOMContentLoaded', function() {
      // Check for error message from session
      const errorDataElement = document.getElementById('session-error-data');
      if (errorDataElement) {
         const errorMessage = JSON.parse(errorDataElement.textContent);
         if (errorMessage) {
            alert(errorMessage);
         }
      }

      // Load user and exam data first
      loadUserInfo();

      // Ensure Next button has valid URL
      const nextBtn = document.getElementById('nextExamBtn');
      if (nextBtn) {
         const currentHref = nextBtn.getAttribute('href');

         // Function to update button URL
         const updateButtonUrl = (url) => {
            nextBtn.href = url;
         };

         nextBtn.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            const isDisabled = this.style.pointerEvents === 'none' || this.style.opacity === '0.6';

            if (isDisabled) {
               e.preventDefault();
               return false;
            }

            if (!href || href === '#' || href === '') {
               e.preventDefault();
               alert('Sedang memuat data ujian, silakan tunggu sebentar...');
               return false;
            }
         });

         if (!currentHref || currentHref === '#' || currentHref === '') {

            nextBtn.style.opacity = '0.6';
            nextBtn.style.pointerEvents = 'none';
            nextBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Memuat...';


            fetch('/student/exam/data')
               .then(response => {
                  if (!response.ok) {
                     throw new Error(`HTTP error! status: ${response.status}`);
                  }
                  return response.json();
               })
               .then(result => {
                  if (result.success && result.data && Array.isArray(result.data) && result.data.length > 0) {
                     const firstExam = result.data[0];
                     let newUrl = null;

                     if (firstExam.info_warning_url) {
                        const url = new URL(firstExam.info_warning_url);
                        newUrl = url.pathname;
                     } else {
                        const examId = firstExam.id || firstExam.id_sesi;
                        if (examId) {
                           newUrl = `/student/exam/${examId}/info-warning`;
                        }
                     }

                     if (newUrl) {
                        updateButtonUrl(newUrl);
                        nextBtn.style.opacity = '1';
                        nextBtn.style.pointerEvents = 'auto';
                        nextBtn.innerHTML = '<i class="bi bi-arrow-right-circle me-2"></i>Next';
                     } else {
                        nextBtn.innerHTML = '<i class="bi bi-exclamation-triangle me-2"></i>Error';
                     }
                  } else {
                     nextBtn.innerHTML = '<i class="bi bi-exclamation-triangle me-2"></i>Error';
                  }
               })
               .catch(err => {
                  nextBtn.innerHTML = '<i class="bi bi-exclamation-triangle me-2"></i>Error';
                  nextBtn.style.opacity = '1';
               });
         }
      }
   });
</script>
@endsection