@extends('layouts.student-navbar')

@section('title', 'Tidak Ada Ujian')

@section('content')
<style>
   body {
      background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
      min-height: 100vh;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
   }

   .no-exam-container {
      min-height: 80vh;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0;
      padding: 2rem;
   }

   .no-exam-card {
      background: white;
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
      padding: 3rem 4rem;
      text-align: center;
      max-width: 1200px;
      width: 100%;
      animation: slideUp 0.6s ease-out;
      border-top: 5px solid #991B1B;
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
      color: #991B1B;
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
      background: linear-gradient(135deg, #fff5f5 0%, #ffe5e5 100%);
      border-radius: 15px;
      padding: 2rem;
      border: 2px solid #991B1B;
      box-shadow: 0 4px 15px rgba(153, 27, 27, 0.1);
   }

   .contact-info h4 {
      color: #991B1B;
      margin-bottom: 1.5rem;
      font-size: 1.3rem;
      font-weight: 700;
      text-align: center;
      padding-bottom: 1rem;
      border-bottom: 2px solid #991B1B;
   }

   .contact-info p {
      color: #2c3e50;
      margin-bottom: 0.8rem;
      font-size: 1rem;
      line-height: 1.6;
   }

   .contact-info .highlight {
      color: #991B1B;
      font-weight: 600;
      font-size: 1.05rem;
   }

   .action-buttons {
      margin-top: 2rem;
   }

   .btn-contact {
      background: linear-gradient(135deg, #991B1B, #B91C1C);
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
      box-shadow: 0 6px 20px rgba(153, 27, 27, 0.3);
   }

   .btn-contact:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(153, 27, 27, 0.4);
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

   .content-wrapper {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 2rem;
      margin-top: 2rem;
      text-align: left;
   }

   .left-section {
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
   }

   .right-section {
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
   }

   .participant-info {
      background: linear-gradient(135deg, #ecf0f1 0%, #d5dbdb 100%);
      border-radius: 15px;
      padding: 2rem;
      text-align: left;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
      border: 1px solid #bdc3c7;
      height: fit-content;
   }

   .participant-info h5 {
      color: #2c3e50;
      margin-bottom: 1.5rem;
      font-size: 1.3rem;
      font-weight: 700;
      text-align: center;
      padding-bottom: 1rem;
      border-bottom: 2px solid #991B1B;
   }

   .info-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 1rem;
   }

   .info-row {
      background: white;
      border-radius: 10px;
      padding: 1rem;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
   }

   .info-row:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
   }

   .info-label {
      font-weight: 600;
      color: #991B1B;
      font-size: 0.85rem;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-bottom: 0.5rem;
      display: block;
   }

   .info-value {
      color: #2c3e50;
      font-size: 1rem;
      font-weight: 500;
   }

   @media (max-width: 992px) {
      .content-wrapper {
         grid-template-columns: 1fr;
         gap: 1.5rem;
      }
   }

   @media (max-width: 768px) {
      .no-exam-container {
         padding: 1rem;
      }

      .no-exam-card {
         padding: 2rem 1.5rem;
      }

      .no-exam-title {
         font-size: 1.75rem;
      }

      .no-exam-subtitle {
         font-size: 1rem;
      }

      .info-grid {
         grid-template-columns: 1fr;
         gap: 15px;
      }

      .info-item {
         padding: 12px;
      }

      .btn-primary {
         width: 100%;
         padding: 12px 20px;
      }
   }

   @media (max-width: 576px) {
      .no-exam-container {
         padding: 0.75rem;
      }

      .no-exam-card {
         padding: 1.5rem 1rem;
      }

      .no-exam-title {
         font-size: 1.5rem;
      }

      .no-exam-subtitle {
         font-size: 0.9rem;
      }

      .info-label {
         font-size: 0.75rem;
      }

      .info-value {
         font-size: 0.9rem;
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
      
      <div class="no-exam-icon">
         <i class="bi bi-exclamation-triangle-fill"></i>
      </div>

      
      <h1 class="no-exam-title">Tidak Ada Ujian</h1>

      
      <p class="no-exam-subtitle">
         Maaf, saat ini tidak ada jadwal ujian yang tersedia untuk batch Anda.
      </p>

      
      <div class="content-wrapper">
         
         <div class="left-section">
            <div class="participant-info">
               <h5><i class="bi bi-person-circle me-2"></i>Informasi Peserta</h5>
               <div class="info-grid">
                  <div class="info-row">
                     <span class="info-label">Nama</span>
                     <span class="info-value" id="participantName">{{ $pesertaData['nama'] ?? 'Memuat...' }}</span>
                  </div>
                  <div class="info-row">
                     <span class="info-label">Kode Peserta</span>
                     <span class="info-value" id="participantCode">{{ $pesertaData['kode_peserta'] ?? 'Memuat...' }}</span>
                  </div>
                  <div class="info-row">
                     <span class="info-label">Batch</span>
                     <span class="info-value" id="participantBatch">{{ $pesertaData['batch'] ?? 'Memuat...' }}</span>
                  </div>
                  <div class="info-row">
                     <span class="info-label">Email</span>
                     <span class="info-value" id="participantEmail">{{ $pesertaData['email'] ?? 'Memuat...' }}</span>
                  </div>
               </div>
            </div>
         </div>

         
         <div class="right-section">
            <div class="contact-info">
               <h4><i class="bi bi-telephone-fill me-2"></i>Hubungi Staff Akti</h4>
               <p><strong>Untuk mendapatkan akses ujian, silakan hubungi:</strong></p>
               <p class="highlight">📞 Telepon: (021) 1234-5678</p>
               <p class="highlight">📧 Email: staff@akti.ac.id</p>
               <p class="highlight">💬 WhatsApp: +62 812-3456-7890</p>
               <p><small>Jam kerja: Senin - Jumat, 08:00 - 17:00 WIB</small></p>
            </div>
         </div>
      </div>

      
      <div class="action-buttons">
         <a href="tel:+622112345678" class="btn-contact">
            <i class="bi bi-telephone me-2"></i>Hubungi Sekarang
         </a>
      </div>
   </div>
</div>

<script id="peserta-data" type="application/json">
   @json($pesertaData ?? null)
</script>
<script>
   const pesertaDataElement = document.getElementById('peserta-data');
   const pesertaData = pesertaDataElement ? JSON.parse(pesertaDataElement.textContent) : null;
</script>
@endsection