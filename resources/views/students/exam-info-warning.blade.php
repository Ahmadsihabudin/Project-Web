@extends('layouts.student-navbar')

@section('title', 'Informasi Ujian - Peringatan & Komposisi')

@section('content')
<style>
   body {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100vh;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
   }

   .exam-container {
      max-width: 1400px;
      margin: 0 auto;
      padding: 40px 20px;
   }

   .exam-header {
      text-align: center;
      margin-bottom: 40px;
   }

   .exam-title {
      color: white;
      font-size: 2.5rem;
      font-weight: bold;
      margin-bottom: 10px;
      text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
   }

   .exam-subtitle {
      color: rgba(255, 255, 255, 0.9);
      font-size: 1.2rem;
   }

   .grid-container {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 30px;
      margin-bottom: 40px;
   }

   .warning-card {
      background: white;
      border-radius: 20px;
      padding: 40px;
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
      border-left: 5px solid #dc3545;
   }

   .composition-card {
      background: white;
      border-radius: 20px;
      padding: 40px;
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
      border-left: 5px solid #28a745;
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
      background: #fff5f5;
      border-radius: 10px;
      border-left: 4px solid #dc3545;
   }

   .warning-item:last-child {
      margin-bottom: 0;
   }

   .warning-icon {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: #dc3545;
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-right: 15px;
      flex-shrink: 0;
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
      background: #28a745;
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-right: 10px;
      font-size: 0.9rem;
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
   }

   .question-item:last-child {
      border-bottom: none;
   }

   .question-type {
      font-weight: 500;
      color: #333;
   }

   .question-count {
      background: #28a745;
      color: white;
      padding: 5px 12px;
      border-radius: 20px;
      font-size: 0.9rem;
      font-weight: bold;
   }

   .action-buttons {
      text-align: center;
      margin-top: 40px;
   }

   .btn-start-exam {
      background: linear-gradient(135deg, #28a745, #20c997);
      border: none;
      color: white;
      padding: 15px 40px;
      font-size: 1.2rem;
      font-weight: bold;
      border-radius: 50px;
      box-shadow: 0 10px 30px rgba(40, 167, 69, 0.3);
      transition: all 0.3s ease;
      text-decoration: none;
      display: inline-block;
   }

   .btn-start-exam:hover {
      transform: translateY(-3px);
      box-shadow: 0 15px 40px rgba(40, 167, 69, 0.4);
      color: white;
   }

   .btn-back {
      background: transparent;
      border: 2px solid white;
      color: white;
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
      background: white;
      color: #667eea;
      transform: translateY(-2px);
   }

   .exam-status {
      background: linear-gradient(135deg, #ffc107, #fd7e14);
      color: white;
      padding: 10px 20px;
      border-radius: 25px;
      font-weight: bold;
      display: inline-block;
      margin-bottom: 20px;
   }

   @media (max-width: 768px) {
      .grid-container {
         grid-template-columns: 1fr;
         gap: 20px;
      }

      .info-grid {
         grid-template-columns: 1fr;
      }

      .exam-title {
         font-size: 2rem;
      }
   }
</style>

<div class="exam-container">
   <!-- Header -->
   <div class="exam-header">
      <h1 class="exam-title">
         <i class="bi bi-exclamation-triangle me-3"></i>
         Informasi Ujian & Peringatan
      </h1>
      <p class="exam-subtitle">Silakan baca peringatan dan komposisi ujian sebelum memulai</p>
   </div>

   <!-- Grid Layout -->
   <div class="grid-container">
      <!-- Warning Card -->
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
                  <strong>Waktu Terbatas:</strong> Ujian memiliki batas waktu yang ketat. Pastikan koneksi internet stabil dan tidak ada gangguan.
               </div>
            </div>
         </div>

         <div class="warning-item">
            <div class="warning-icon">
               <i class="bi bi-shield-exclamation"></i>
            </div>
            <div class="warning-content">
               <div class="warning-text">
                  <strong>Integritas Ujian:</strong> Dilarang keras melakukan kecurangan, membuka tab lain, atau menggunakan bantuan eksternal.
               </div>
            </div>
         </div>

         <div class="warning-item">
            <div class="warning-icon">
               <i class="bi bi-arrow-left-right"></i>
            </div>
            <div class="warning-content">
               <div class="warning-text">
                  <strong>Navigasi Terbatas:</strong> Setelah memulai ujian, Anda tidak dapat kembali ke halaman sebelumnya atau mengubah jawaban yang sudah dikirim.
               </div>
            </div>
         </div>

         <div class="warning-item">
            <div class="warning-icon">
               <i class="bi bi-check-circle"></i>
            </div>
            <div class="warning-content">
               <div class="warning-text">
                  <strong>Konfirmasi Jawaban:</strong> Pastikan semua jawaban sudah benar sebelum mengirim. Tidak ada kesempatan untuk mengubah setelah submit.
               </div>
            </div>
         </div>
      </div>

      <!-- Composition Card -->
      <div class="composition-card">
         <h2 class="card-title composition-title">
            <i class="bi bi-list-check me-2"></i>
            Komposisi Ujian
         </h2>

         <!-- Exam Status -->
         <div class="text-center mb-4">
            <span class="exam-status" id="examStatus">Status: Siap Dimulai</span>
         </div>

         <!-- Basic Info -->
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
                  <div class="info-value" id="examSubject">Matematika</div>
               </div>
               <div class="info-item">
                  <div class="info-label">Durasi</div>
                  <div class="info-value" id="examDuration">60 Menit</div>
               </div>
               <div class="info-item">
                  <div class="info-label">Tanggal Mulai</div>
                  <div class="info-value" id="examStartDate">17/10/2025</div>
               </div>
               <div class="info-item">
                  <div class="info-label">Waktu Mulai</div>
                  <div class="info-value" id="examStartTime">12:00</div>
               </div>
            </div>
         </div>

         <!-- Question Composition -->
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
                  <span class="question-count" id="multipleChoiceCount">25 Soal</span>
               </div>
               <div class="question-item">
                  <span class="question-type">Essay</span>
                  <span class="question-count" id="essayCount">5 Soal</span>
               </div>
               <div class="question-item">
                  <span class="question-type">True/False</span>
                  <span class="question-count" id="trueFalseCount">10 Soal</span>
               </div>
               <div class="question-item" style="background: #e9ecef; font-weight: bold; color: #495057;">
                  <span>Total Soal</span>
                  <span class="question-count" style="background: #6c757d;" id="totalQuestions">40 Soal</span>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- Action Buttons -->
   <div class="action-buttons">
      <a href="/student/information" class="btn-back">
         <i class="bi bi-arrow-left me-2"></i>
         Kembali
      </a>
      <a href="#" class="btn-start-exam" id="startExamBtn">
         <i class="bi bi-play-circle me-2"></i>
         Mulai Ujian
      </a>
   </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
   // Load exam data
   async function loadExamData() {
      try {
         console.log('Loading exam data...');

         // Get exam ID from URL
         const pathParts = window.location.pathname.split('/');
         const examId = pathParts[pathParts.length - 2]; // Get ID from /student/exam/{id}/info-warning

         console.log('Exam ID:', examId);

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
         console.log('Exam data result:', result);

         if (result.success && result.data) {
            const exam = result.data;

            // Update exam information
            document.getElementById('examSubject').textContent = exam.mata_pelajaran || 'N/A';
            document.getElementById('examDuration').textContent = (exam.durasi_menit || 60) + ' Menit';

            // Format dates
            if (exam.tanggal_mulai) {
               const startDate = new Date(exam.tanggal_mulai);
               document.getElementById('examStartDate').textContent = startDate.toLocaleDateString('id-ID');
            }

            if (exam.jam_mulai) {
               const startTime = exam.jam_mulai.substring(0, 5);
               document.getElementById('examStartTime').textContent = startTime;
            }

            // Load question composition data
            await loadQuestionComposition(examId);

            // Set start exam button link
            const startBtn = document.getElementById('startExamBtn');
            startBtn.href = `/student/exam/${examId}/start`;

            // Update exam status
            const statusElement = document.getElementById('examStatus');
            if (exam.status === 'aktif') {
               statusElement.textContent = 'Status: Siap Dimulai';
               statusElement.style.background = 'linear-gradient(135deg, #28a745, #20c997)';
               startBtn.style.display = 'inline-block';
            } else {
               statusElement.textContent = 'Status: Belum Aktif';
               statusElement.style.background = 'linear-gradient(135deg, #6c757d, #495057)';
               startBtn.style.display = 'none';
            }

         } else {
            console.error('Failed to load exam data:', result);
            showError('Gagal memuat data ujian');
         }

      } catch (error) {
         console.error('Error loading exam data:', error);
         showError('Terjadi kesalahan saat memuat data ujian');
      }
   }

   // Load question composition data
   async function loadQuestionComposition(examId) {
      try {
         console.log('Loading question composition for exam:', examId);

         const response = await fetch(`/student/exam/${examId}/questions-composition`, {
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
         console.log('Question composition result:', result);

         if (result.success && result.data) {
            const composition = result.data;

            // Update question counts with real data
            document.getElementById('multipleChoiceCount').textContent = composition.pilihan_ganda + ' Soal';
            document.getElementById('essayCount').textContent = composition.essay + ' Soal';
            document.getElementById('trueFalseCount').textContent = composition.true_false + ' Soal';
            document.getElementById('totalQuestions').textContent = composition.total + ' Soal';

            console.log('Question composition updated:', composition);
         } else {
            console.error('Failed to load question composition:', result);
            // Set default values if API fails
            document.getElementById('multipleChoiceCount').textContent = '0 Soal';
            document.getElementById('essayCount').textContent = '0 Soal';
            document.getElementById('trueFalseCount').textContent = '0 Soal';
            document.getElementById('totalQuestions').textContent = '0 Soal';
         }

      } catch (error) {
         console.error('Error loading question composition:', error);
         // Set error values
         document.getElementById('multipleChoiceCount').textContent = 'Error';
         document.getElementById('essayCount').textContent = 'Error';
         document.getElementById('trueFalseCount').textContent = 'Error';
         document.getElementById('totalQuestions').textContent = 'Error';
      }
   }

   function showError(message) {
      // Update exam status to show error
      const statusElement = document.getElementById('examStatus');
      statusElement.textContent = 'Status: Error - ' + message;
      statusElement.style.background = 'linear-gradient(135deg, #dc3545, #c82333)';

      // Hide start button
      const startBtn = document.getElementById('startExamBtn');
      startBtn.style.display = 'none';
   }

   // Initialize on page load
   document.addEventListener('DOMContentLoaded', function() {
      loadExamData();
   });
</script>
@endsection