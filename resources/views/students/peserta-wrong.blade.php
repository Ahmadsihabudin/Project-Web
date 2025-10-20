@extends('layouts.student-navbar')

@section('title', 'Tidak Ada Ujian')

@section('content')
<style>
   .no-exam-container {
      min-height: 80vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      margin: 0;
      padding: 2rem;
   }

   .no-exam-card {
      background: white;
      border-radius: 20px;
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
      padding: 3rem;
      text-align: center;
      max-width: 600px;
      width: 100%;
      animation: slideUp 0.6s ease-out;
   }

   @keyframes slideUp {
      from {
         opacity: 0;
         transform: translateY(30px);
      }

      to {
         opacity: 1;
         transform: translateY(0);
      }
   }

   .no-exam-icon {
      font-size: 4rem;
      color: #ff6b6b;
      margin-bottom: 1.5rem;
      animation: pulse 2s infinite;
   }

   @keyframes pulse {
      0% {
         transform: scale(1);
      }

      50% {
         transform: scale(1.05);
      }

      100% {
         transform: scale(1);
      }
   }

   .no-exam-title {
      font-size: 2.5rem;
      font-weight: 700;
      color: #2c3e50;
      margin-bottom: 1rem;
      line-height: 1.2;
   }

   .no-exam-subtitle {
      font-size: 1.2rem;
      color: #7f8c8d;
      margin-bottom: 2rem;
      line-height: 1.6;
   }

   .contact-info {
      background: #f8f9fa;
      border-radius: 15px;
      padding: 2rem;
      margin: 2rem 0;
      border-left: 5px solid #3498db;
   }

   .contact-info h4 {
      color: #2c3e50;
      margin-bottom: 1rem;
      font-size: 1.3rem;
   }

   .contact-info p {
      color: #7f8c8d;
      margin-bottom: 0.5rem;
      font-size: 1rem;
   }

   .contact-info .highlight {
      color: #e74c3c;
      font-weight: 600;
   }

   .action-buttons {
      margin-top: 2rem;
   }

   .btn-contact {
      background: linear-gradient(45deg, #3498db, #2980b9);
      border: none;
      color: white;
      padding: 12px 30px;
      border-radius: 25px;
      font-size: 1rem;
      font-weight: 600;
      text-decoration: none;
      display: inline-block;
      margin: 0 10px;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
   }

   .btn-contact:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(52, 152, 219, 0.4);
      color: white;
      text-decoration: none;
   }

   .btn-logout {
      background: linear-gradient(45deg, #e74c3c, #c0392b);
      border: none;
      color: white;
      padding: 12px 30px;
      border-radius: 25px;
      font-size: 1rem;
      font-weight: 600;
      text-decoration: none;
      display: inline-block;
      margin: 0 10px;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
   }

   .btn-logout:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(231, 76, 60, 0.4);
      color: white;
      text-decoration: none;
   }

   .participant-info {
      background: #ecf0f1;
      border-radius: 10px;
      padding: 1.5rem;
      margin: 1.5rem 0;
      text-align: left;
   }

   .participant-info h5 {
      color: #2c3e50;
      margin-bottom: 1rem;
      font-size: 1.1rem;
   }

   .info-row {
      display: flex;
      justify-content: space-between;
      margin-bottom: 0.5rem;
      padding: 0.5rem 0;
      border-bottom: 1px solid #bdc3c7;
   }

   .info-row:last-child {
      border-bottom: none;
      margin-bottom: 0;
   }

   .info-label {
      font-weight: 600;
      color: #34495e;
   }

   .info-value {
      color: #7f8c8d;
   }

   @media (max-width: 768px) {
      .no-exam-container {
         padding: 1rem;
      }

      .no-exam-card {
         padding: 2rem;
      }

      .no-exam-title {
         font-size: 2rem;
      }

      .no-exam-subtitle {
         font-size: 1rem;
      }

      .action-buttons {
         display: flex;
         flex-direction: column;
         gap: 1rem;
      }

      .btn-contact,
      .btn-logout {
         margin: 0;
      }
   }
</style>

<div class="no-exam-container">
   <div class="no-exam-card">
      <!-- Icon -->
      <div class="no-exam-icon">
         <i class="bi bi-exclamation-triangle-fill"></i>
      </div>

      <!-- Title -->
      <h1 class="no-exam-title">Tidak Ada Ujian</h1>

      <!-- Subtitle -->
      <p class="no-exam-subtitle">
         Maaf, saat ini tidak ada jadwal ujian yang tersedia untuk batch Anda.
      </p>

      <!-- Participant Info -->
      <div class="participant-info">
         <h5><i class="bi bi-person-circle me-2"></i>Informasi Peserta</h5>
         <div class="info-row">
            <span class="info-label">Nama:</span>
            <span class="info-value" id="participantName">Memuat...</span>
         </div>
         <div class="info-row">
            <span class="info-label">Kode Peserta:</span>
            <span class="info-value" id="participantCode">Memuat...</span>
         </div>
         <div class="info-row">
            <span class="info-label">Batch:</span>
            <span class="info-value" id="participantBatch">Memuat...</span>
         </div>
         <div class="info-row">
            <span class="info-label">Email:</span>
            <span class="info-value" id="participantEmail">Memuat...</span>
         </div>
      </div>

      <!-- Contact Info -->
      <div class="contact-info">
         <h4><i class="bi bi-telephone-fill me-2"></i>Hubungi Staff Akti</h4>
         <p><strong>Untuk mendapatkan akses ujian, silakan hubungi:</strong></p>
         <p class="highlight">📞 Telepon: (021) 1234-5678</p>
         <p class="highlight">📧 Email: staff@akti.ac.id</p>
         <p class="highlight">💬 WhatsApp: +62 812-3456-7890</p>
         <p><small>Jam kerja: Senin - Jumat, 08:00 - 17:00 WIB</small></p>
      </div>

      <!-- Action Buttons -->
      <div class="action-buttons">
         <a href="tel:+622112345678" class="btn-contact">
            <i class="bi bi-telephone me-2"></i>Hubungi Sekarang
         </a>

      </div>
   </div>
</div>

<script>
   // Load participant information
   async function loadParticipantInfo() {
      try {
         const response = await fetch('/student/exam/data', {
            method: 'GET',
            headers: {
               'Accept': 'application/json'
            },
            credentials: 'same-origin'
         });

         if (response.ok) {
            const result = await response.json();
            if (result.success && result.peserta) {
               // Update participant info
               document.getElementById('participantName').textContent = result.peserta.nama || 'Peserta';
               document.getElementById('participantCode').textContent = result.peserta.kode_peserta || 'N/A';
               document.getElementById('participantBatch').textContent = result.peserta.batch || 'N/A';
               document.getElementById('participantEmail').textContent = result.peserta.email || 'N/A';
            }
         }
      } catch (error) {
         console.error('Error loading participant info:', error);
         // Set error values
         document.getElementById('participantName').textContent = 'Error loading data';
         document.getElementById('participantCode').textContent = 'Error loading data';
         document.getElementById('participantBatch').textContent = 'Error loading data';
         document.getElementById('participantEmail').textContent = 'Error loading data';
      }
   }

   // Load participant info on page load
   document.addEventListener('DOMContentLoaded', function() {
      loadParticipantInfo();
   });
</script>
@endsection