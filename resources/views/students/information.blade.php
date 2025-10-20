@extends('layouts.student-navbar')

@section('title', 'Informasi Ujian - Dashboard Siswa')

@section('content')
<style>
   body {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100vh;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
   }

   .info-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 40px 20px;
   }


   .info-card {
      background: white;
      border-radius: 20px;
      padding: 40px;
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
   }

   .info-header {
      text-align: center;
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

   .welcome-section {
      background: linear-gradient(135deg, #667eea, #764ba2);
      color: white;
      border-radius: 15px;
      padding: 30px;
      margin-bottom: 30px;
      text-align: center;
   }

   .welcome-title {
      font-size: 2rem;
      font-weight: bold;
      margin-bottom: 10px;
   }

   .welcome-subtitle {
      font-size: 1.1rem;
      opacity: 0.9;
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

   .info-icon.batch {
      background: linear-gradient(135deg, #4facfe, #00f2fe);
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
</style>

<div class="info-container">
   <!-- Welcome Section -->
   <div class="welcome-section">
      <h1 class="welcome-title">
         <i class="bi bi-person-circle me-3"></i>
         Selamat Datang di Sistem Ujian Online
      </h1>
      <p class="welcome-subtitle">
         Silakan periksa informasi Anda dan pilih ujian yang tersedia
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
         <div class="info-item">
            <div class="info-icon participant">
               <i class="bi bi-person"></i>
            </div>
            <div class="info-content">
               <div class="info-label">Nama Peserta</div>
               <div class="info-value" id="studentName">Memuat...</div>
            </div>
         </div>

         <div class="info-item">
            <div class="info-icon code">
               <i class="bi bi-key"></i>
            </div>
            <div class="info-content">
               <div class="info-label">Kode Peserta</div>
               <div class="info-value" id="studentCode">Memuat...</div>
            </div>
         </div>

         <div class="info-item">
            <div class="info-icon batch">
               <i class="bi bi-people"></i>
            </div>
            <div class="info-content">
               <div class="info-label">Batch</div>
               <div class="info-value" id="studentBatch">Memuat...</div>
            </div>
         </div>
      </div>
   </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
   // Load user info only
   async function loadUserInfo() {
      try {
         console.log('Loading user info...');
         const response = await fetch('/student/exam/data');
         console.log('Response status:', response.status);

         if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
         }

         const result = await response.json();
         console.log('API result:', result);

         if (result.success && result.peserta) {
            // Update student info
            document.getElementById('studentName').textContent = result.peserta.nama || 'Peserta';
            document.getElementById('studentCode').textContent = result.peserta.kode_peserta || 'N/A';
            document.getElementById('studentBatch').textContent = result.peserta.batch || 'N/A';
            console.log('User info updated successfully');
         } else {
            console.error('API returned unsuccessful result:', result);
            // Set default values if API fails
            document.getElementById('studentName').textContent = 'Error loading data';
            document.getElementById('studentCode').textContent = 'Error loading data';
            document.getElementById('studentBatch').textContent = 'Error loading data';
         }
      } catch (error) {
         console.error('Error loading user info:', error);
         // Set error values
         document.getElementById('studentName').textContent = 'Error: ' + error.message;
         document.getElementById('studentCode').textContent = 'Error: ' + error.message;
         document.getElementById('studentBatch').textContent = 'Error: ' + error.message;
      }
   }

   // Initialize on page load
   document.addEventListener('DOMContentLoaded', function() {
      loadUserInfo();
   });
</script>
@endsection