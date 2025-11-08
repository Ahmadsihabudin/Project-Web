@extends('layouts.student-navbar')

@section('title', 'Informasi Ujian - Peringatan & Komposisi')

@section('content')
@php
$subject = $exam->mata_pelajaran ?? optional($exam->ujian)->nama_ujian ?? '-';
$duration = $exam->durasi_menit ?? 0;
$startDateFormatted = $startDateTime ? $startDateTime->format('d/m/Y') : '-';
$startTimeFormatted = $startDateTime ? $startDateTime->format('H:i') : '-';

$startExamUrl = route('student.exam.start', $exam->id_sesi);
$backUrl = route('student.information');
$statusText = $statusLabel ?? 'Siap Dimulai';
$canStartExam = $canStart ?? false;

$participantName = $participant->nama_peserta ?? $participant->nama ?? 'Peserta';
$participantCode = $participant->kode_peserta ?? 'N/A';
$participantBatch = $participant->batch ?? 'N/A';
$participantEmail = $participant->email ?? 'N/A';
$participantSchool = $participant->asal_smk ?? '-';
$participantMajor = $participant->jurusan ?? '-';

$composition = $composition ?? [];
$multipleChoiceCount = isset($composition['pilihan_ganda']) ? (int)$composition['pilihan_ganda'] : 0;
$trueFalseCount = isset($composition['true_false']) ? (int)$composition['true_false'] : 0;
$totalQuestions = isset($composition['total']) ? (int)$composition['total'] : 0;
@endphp

<style>
   body {
      background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
      min-height: 100vh;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
   }

   .exam-container {
      max-width: 1400px;
      margin: 0 auto;
      padding: 40px 20px;
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

   .exam-header {
      text-align: center;
      margin-bottom: 40px;
      animation: fadeInDown 0.6s ease-out;
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

   .exam-title {
      color: #333;
      font-size: 2.5rem;
      font-weight: bold;
      margin-bottom: 10px;
      text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
   }

   .exam-subtitle {
      color: #666;
      font-size: 1.2rem;
   }

   .grid-container {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 30px;
      margin-bottom: 40px;
      animation: fadeInUp 0.8s ease-out 0.2s both;
   }

   .warning-card {
      background: white;
      border-radius: 20px;
      padding: 40px;
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
      border-left: 5px solid #991B1B;
      animation: fadeInLeft 0.6s ease-out 0.3s both;
   }

   @keyframes fadeInLeft {
      from {
         opacity: 0;
         transform: translateX(-30px);
      }

      to {
         opacity: 1;
         transform: translateX(0);
      }
   }

   .composition-card {
      background: white;
      border-radius: 20px;
      padding: 40px;
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
      border-left: 5px solid #991B1B;
      animation: fadeInRight 0.6s ease-out 0.4s both;
   }

   @keyframes fadeInRight {
      from {
         opacity: 0;
         transform: translateX(30px);
      }

      to {
         opacity: 1;
         transform: translateX(0);
      }
   }

   .card-title {
      font-size: 1.8rem;
      font-weight: bold;
      margin-bottom: 20px;
      display: flex;
      align-items: center;
   }

   .warning-title {
      color: #dc3545;
   }

   .composition-title {
      color: #28a745;
   }

   .warning-item {
      display: flex;
      align-items: flex-start;
      margin-bottom: 20px;
      padding: 15px;
      background: #fef2f2;
      border-radius: 10px;
      border-left: 4px solid #991B1B;
      animation: fadeInUp 0.6s ease-out;
      opacity: 0;
      animation-fill-mode: forwards;
   }

   .warning-item:nth-child(1) {
      animation-delay: 0.1s;
   }

   .warning-item:nth-child(2) {
      animation-delay: 0.2s;
   }

   .warning-item:nth-child(3) {
      animation-delay: 0.3s;
   }

   .warning-item:nth-child(4) {
      animation-delay: 0.4s;
   }

   .warning-item:last-child {
      margin-bottom: 0;
   }

   .warning-item:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
   }

   .warning-icon {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: #991B1B;
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-right: 15px;
      flex-shrink: 0;
      transition: transform 0.3s ease;
   }

   .warning-icon:hover {
      transform: scale(1.1) rotate(5deg);
   }

   .warning-content {
      flex-grow: 1;
   }

   .warning-text {
      color: #333;
      font-size: 1rem;
      line-height: 1.5;
   }

   .composition-section {
      margin-bottom: 25px;
   }

   .composition-section:last-child {
      margin-bottom: 0;
   }

   .section-title {
      font-size: 1.2rem;
      font-weight: bold;
      color: #333;
      margin-bottom: 15px;
      display: flex;
      align-items: center;
   }

   .section-icon {
      width: 30px;
      height: 30px;
      border-radius: 50%;
      background: #991B1B;
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-right: 10px;
      font-size: 0.9rem;
      transition: transform 0.3s ease;
   }

   .section-icon:hover {
      transform: scale(1.1) rotate(5deg);
   }

   .info-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 15px;
      margin-bottom: 20px;
   }

   .info-item {
      background: #f8f9fa;
      padding: 15px;
      border-radius: 10px;
      border-left: 4px solid #28a745;
   }

   .info-label {
      font-size: 0.9rem;
      color: #666;
      margin-bottom: 5px;
      font-weight: 500;
   }

   .info-value {
      font-size: 1.1rem;
      color: #333;
      font-weight: bold;
   }

   .question-list {
      background: #f8f9fa;
      border-radius: 10px;
      padding: 20px;
   }

   .question-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 0;
      border-bottom: 1px solid #dee2e6;
      animation: fadeInUp 0.6s ease-out;
      opacity: 0;
      animation-fill-mode: forwards;
   }

   .question-item:nth-child(1) {
      animation-delay: 0.1s;
   }

   .question-item:nth-child(2) {
      animation-delay: 0.2s;
   }

   .question-item:nth-child(3) {
      animation-delay: 0.3s;
   }

   .question-item:nth-child(4) {
      animation-delay: 0.4s;
   }

   .question-item:last-child {
      border-bottom: none;
   }

   .question-item:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
   }

   .question-type {
      font-weight: 500;
      color: #333;
   }

   .question-count {
      background: #991B1B;
      color: white;
      padding: 5px 12px;
      border-radius: 20px;
      font-size: 0.9rem;
      font-weight: bold;
   }

   .action-buttons {
      text-align: center;
      margin-top: 40px;
      animation: fadeInUp 0.8s ease-out 0.5s both;
   }

   .btn-start-exam {
      background: linear-gradient(135deg, #991B1B, #B91C1C);
      border: none;
      color: white;
      padding: 15px 40px;
      font-size: 1.2rem;
      font-weight: bold;
      border-radius: 50px;
      box-shadow: 0 10px 30px rgba(153, 27, 27, 0.3);
      transition: all 0.3s ease;
      text-decoration: none;
      display: inline-block;
   }

   .btn-start-exam:hover {
      transform: translateY(-3px);
      box-shadow: 0 15px 40px rgba(153, 27, 27, 0.4);
      color: white;
   }

   .btn-back {
      background: transparent;
      border: 2px solid #991B1B;
      color: #991B1B;
      padding: 12px 30px;
      font-size: 1rem;
      font-weight: 500;
      border-radius: 50px;
      margin-right: 20px;
      transition: all 0.3s ease;
      text-decoration: none;
      display: inline-block;
   }

   .btn-back:hover {
      background: #991B1B;
      color: white;
      transform: translateY(-2px);
   }

   .exam-status {
      background: linear-gradient(135deg, #991B1B, #B91C1C);
      color: white;
      padding: 10px 20px;
      border-radius: 25px;
      font-weight: bold;
      display: inline-block;
      margin-bottom: 20px;
   }

   @media (max-width: 768px) {
      .exam-container {
         padding: 20px 15px;
      }

      .grid-container {
         grid-template-columns: 1fr;
         gap: 20px;
      }

      .info-grid {
         grid-template-columns: 1fr;
      }

      .exam-title {
         font-size: 1.75rem;
      }

      .exam-subtitle {
         font-size: 1rem;
      }

      .warning-card,
      .composition-card {
         padding: 20px 15px;
      }

      .card-title {
         font-size: 1.25rem;
      }

      .warning-item,
      .composition-item {
         padding: 12px;
         margin-bottom: 12px;
      }

      .warning-icon {
         width: 40px;
         height: 40px;
         font-size: 1.2rem;
      }

      .btn-primary {
         width: 100%;
         padding: 12px 20px;
         font-size: 1rem;
      }
   }

   @media (max-width: 576px) {
      .exam-container {
         padding: 15px 10px;
      }

      .exam-title {
         font-size: 1.5rem;
      }

      .exam-subtitle {
         font-size: 0.9rem;
      }

      .warning-card,
      .composition-card {
         padding: 15px 12px;
      }

      .card-title {
         font-size: 1.1rem;
      }

      .warning-item,
      .composition-item {
         padding: 10px;
         flex-direction: column;
         text-align: center;
         align-items: center;
      }

      .warning-icon {
         width: 35px;
         height: 35px;
         margin-bottom: 8px;
         margin-right: 0;
         flex-shrink: 0;
      }

      .warning-content {
         width: 100%;
         text-align: center;
      }

      .composition-item .badge {
         font-size: 0.85rem;
         padding: 6px 12px;
      }
   }
</style>

<div class="exam-container">
   
   <div class="exam-header">
      <h1 class="exam-title">
         <i class="bi bi-exclamation-triangle me-3"></i>
         Informasi Ujian & Peringatan
      </h1>
      <p class="exam-subtitle">Silakan baca peringatan dan komposisi ujian sebelum memulai</p>
   </div>

   
   <div class="grid-container">
      
      <div class="warning-card">
         <h2 class="card-title warning-title">
            <i class="bi bi-exclamation-triangle me-2"></i>
            Peringatan Penting
         </h2>

         <div class="warning-item">
            <div class="warning-icon">
               <i class="bi bi-clock"></i>
            </div>
            <div class="warning-content">
               <div class="warning-text">
                  {!! $warnings['warning_waktu'] ?? 'Waktu Terbatas: Ujian memiliki batas waktu yang ketat. Pastikan koneksi internet stabil dan tidak ada gangguan.' !!}
               </div>
            </div>
         </div>

         <div class="warning-item">
            <div class="warning-icon">
               <i class="bi bi-shield-exclamation"></i>
            </div>
            <div class="warning-content">
               <div class="warning-text">
                  {!! $warnings['warning_integritas'] ?? 'Integritas Ujian: Dilarang keras melakukan kecurangan, membuka tab lain, atau menggunakan bantuan eksternal.' !!}
               </div>
            </div>
         </div>

         <div class="warning-item">
            <div class="warning-icon">
               <i class="bi bi-arrow-left-right"></i>
            </div>
            <div class="warning-content">
               <div class="warning-text">
                  {!! $warnings['warning_navigasi'] ?? 'Navigasi Terbatas: Setelah memulai ujian, Anda tidak dapat kembali ke halaman sebelumnya atau mengubah jawaban yang sudah dikirim.' !!}
               </div>
            </div>
         </div>

         <div class="warning-item">
            <div class="warning-icon">
               <i class="bi bi-check-circle"></i>
            </div>
            <div class="warning-content">
               <div class="warning-text">
                  {!! $warnings['warning_konfirmasi'] ?? 'Konfirmasi Jawaban: Pastikan semua jawaban sudah benar sebelum mengirim. Tidak ada kesempatan untuk mengubah setelah submit.' !!}
               </div>
            </div>
         </div>
      </div>

      
      <div class="composition-card">
         <h2 class="card-title composition-title">
            <i class="bi bi-list-check me-2"></i>
            Komposisi Ujian
         </h2>

         
         <div class="text-center mb-4">
            <span class="exam-status" id="examStatus">Status: {{ $statusLabel }}</span>
         </div>

         
         <div class="composition-section">
            <h3 class="section-title">
               <div class="section-icon">
                  <i class="bi bi-info-circle"></i>
               </div>
               Informasi Ujian
            </h3>
            <div class="info-grid">
               <div class="info-item">
                  <div class="info-label">Mata Pelajaran</div>
                  <div class="info-value" id="examSubject">{{ $subject }}</div>
               </div>
               <div class="info-item">
                  <div class="info-label">Durasi</div>
                  <div class="info-value" id="examDuration">{{ $duration }} Menit</div>
               </div>
               <div class="info-item">
                  <div class="info-label">Tanggal Mulai</div>
                  <div class="info-value" id="examStartDate">{{ $startDateFormatted }}</div>
               </div>
               <div class="info-item">
                  <div class="info-label">Waktu Mulai</div>
                  <div class="info-value" id="examStartTime">{{ $startTimeFormatted }}</div>
               </div>
            </div>
         </div>

         
         <div class="composition-section">
            <h3 class="section-title">
               <div class="section-icon">
                  <i class="bi bi-question-circle"></i>
               </div>
               Komposisi Soal
            </h3>
            <div class="question-list">
               <div class="question-item">
                  <span class="question-type">Pilihan Ganda</span>
                  <span class="question-count">{{ $multipleChoiceCount }} Soal</span>
               </div>
               <div class="question-item">
                  <span class="question-type">True/False</span>
                  <span class="question-count">{{ $trueFalseCount }} Soal</span>
               </div>
               <div class="question-item" style="background: #e9ecef; font-weight: bold; color: #495057;">
                  <span>Total Soal</span>
                  <span class="question-count" style="background: #991B1B;">{{ $totalQuestions }} Soal</span>
               </div>
            </div>

         </div>
      </div>
   </div>

   
   <div class="action-buttons">
      <a href="{{ $backUrl }}" class="btn-back">
         <i class="bi bi-arrow-left me-2"></i>
         Kembali
      </a>
      @if($canStart)
      <a href="{{ $startExamUrl }}" class="btn-start-exam" id="startExamBtn">
         <i class="bi bi-play-circle me-2"></i>
         Mulai Ujian
      </a>
      @else
      <span class="btn-start-exam" style="opacity: 0.6; cursor: not-allowed;">Ujian belum dapat dimulai</span>
      @endif
   </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
   async function loadExamData() {
      try {
         const pathParts = window.location.pathname.split('/');
         const examId = pathParts[pathParts.length - 2];

         const response = await fetch(`/student/exam/${examId}/data`, {
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

         if (result.success && result.data) {
            const exam = result.data;

            document.getElementById('examSubject').textContent = exam.mata_pelajaran || 'N/A';
            document.getElementById('examDuration').textContent = (exam.durasi_menit || 60) + ' Menit';

            if (exam.tanggal_mulai) {
               const startDate = new Date(exam.tanggal_mulai);
               document.getElementById('examStartDate').textContent = startDate.toLocaleDateString('id-ID');
            }

            if (exam.jam_mulai) {
               const startTime = exam.jam_mulai.substring(0, 5);
               document.getElementById('examStartTime').textContent = startTime;
            }

            const startBtn = document.getElementById('startExamBtn');
            if (startBtn) {
               const newHref = `/student/exam/${examId}/start`;
               startBtn.href = newHref;
            }

            const statusElement = document.getElementById('examStatus');
            if (exam.status === 'aktif') {
               statusElement.textContent = 'Status: Siap Dimulai';
               statusElement.style.background = 'linear-gradient(135deg, #991B1B, #B91C1C)';
               startBtn.style.display = 'inline-block';
            } else {
               statusElement.textContent = 'Status: Belum Aktif';
               statusElement.style.background = 'linear-gradient(135deg, #6c757d, #495057)';
               startBtn.style.display = 'none';
            }

         } else {
            if (result.error === 'EXAM_NOT_FOUND') {
               alert('Sesi ujian tidak ditemukan. Mungkin sudah dihapus. Anda akan diarahkan ke halaman informasi.');
               window.location.href = '/student/information';
            } else {
               showError('Gagal memuat data ujian: ' + (result.message || 'Unknown error'));
            }
         }

      } catch (error) {
         if (error.message.includes('404')) {
            alert('Sesi ujian tidak ditemukan. Mungkin sudah dihapus. Anda akan diarahkan ke halaman informasi.');
            window.location.href = '/student/information';
         } else {
            showError('Terjadi kesalahan saat memuat data ujian');
         }
      }
   }

   function showError(message) {
      const statusElement = document.getElementById('examStatus');
      statusElement.textContent = 'Status: Error - ' + message;
      statusElement.style.background = 'linear-gradient(135deg, #991B1B, #B91C1C)';

      const startBtn = document.getElementById('startExamBtn');
      startBtn.style.display = 'none';
   }

   document.addEventListener('DOMContentLoaded', function() {
      const pathParts = window.location.pathname.split('/');
      const examId = pathParts[pathParts.length - 2];

      loadExamData();

      const startBtn = document.getElementById('startExamBtn');
      if (startBtn) {
         startBtn.addEventListener('click', function(e) {
            if (this.href === '#' || this.href === window.location.href) {
               e.preventDefault();
               alert('Button belum diatur dengan benar. Silakan refresh halaman.');
            }
         });
      }
   });

   if (document.readyState !== 'loading') {
      const pathParts = window.location.pathname.split('/');
      const examId = pathParts[pathParts.length - 2];
      loadExamData();
   }
</script>
@endsection