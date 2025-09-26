<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>@yield('title', 'Ujian Online - Peserta')</title>
   <meta name="csrf-token" content="{{ csrf_token() }}">

   <!-- Bootstrap 5 CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
   <!-- Bootstrap Icons -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" />

   <style>
      body {
         font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
         background-color: #f8f9fa;
      }

      .candidate-header {
         background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
         color: white;
         padding: 15px 0;
         box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      }

      .candidate-header .container {
         display: flex;
         justify-content: space-between;
         align-items: center;
      }

      .logo h3 {
         margin: 0;
         font-weight: 700;
      }

      .user-info {
         display: flex;
         align-items: center;
         gap: 15px;
      }

      .user-avatar {
         width: 35px;
         height: 35px;
         background: rgba(255, 255, 255, 0.2);
         border-radius: 50%;
         display: flex;
         align-items: center;
         justify-content: center;
         font-weight: bold;
      }

      .logout-btn {
         background: rgba(255, 255, 255, 0.2);
         border: 1px solid rgba(255, 255, 255, 0.3);
         color: white;
         padding: 6px 12px;
         border-radius: 15px;
         cursor: pointer;
         transition: all 0.3s ease;
         font-size: 14px;
      }

      .logout-btn:hover {
         background: rgba(255, 255, 255, 0.3);
      }

      .main-content {
         min-height: calc(100vh - 80px);
         padding: 20px 0;
      }

      .card {
         border: none;
         border-radius: 12px;
         box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
         transition: transform 0.2s, box-shadow 0.2s;
      }

      .card:hover {
         transform: translateY(-2px);
         box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
      }

      .timer {
         font-family: "Courier New", monospace;
         font-weight: bold;
         color: #dc3545;
      }

      .question-nav {
         position: sticky;
         top: 20px;
      }

      .question-item {
         width: 40px;
         height: 40px;
         border-radius: 50%;
         display: flex;
         align-items: center;
         justify-content: center;
         margin: 5px;
         cursor: pointer;
         transition: all 0.3s;
      }

      .question-item.answered {
         background-color: #28a745;
         color: white;
      }

      .question-item.current {
         background-color: #007bff;
         color: white;
      }

      .question-item.unanswered {
         background-color: #e9ecef;
         color: #6c757d;
      }

      .auto-save-indicator {
         position: fixed;
         top: 20px;
         right: 20px;
         z-index: 1050;
      }

      .fade-in {
         animation: fadeIn 0.5s ease-in;
      }

      @keyframes fadeIn {
         from {
            opacity: 0;
            transform: translateY(20px);
         }

         to {
            opacity: 1;
            transform: translateY(0);
         }
      }

      .btn-primary {
         background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
         border: none;
         border-radius: 8px;
      }

      .btn-primary:hover {
         background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
         transform: translateY(-1px);
      }

      .alert {
         border-radius: 10px;
      }

      .footer {
         background: #343a40;
         color: white;
         padding: 20px 0;
         margin-top: 50px;
      }

      .footer .container {
         text-align: center;
      }

      .footer p {
         margin: 0;
         font-size: 14px;
      }

      .footer .security-badges {
         display: flex;
         justify-content: center;
         gap: 20px;
         margin-bottom: 15px;
      }

      .footer .badge {
         display: flex;
         flex-direction: column;
         align-items: center;
         padding: 8px 12px;
         background: rgba(255, 255, 255, 0.1);
         border-radius: 8px;
         transition: all 0.3s ease;
      }

      .footer .badge:hover {
         background: rgba(255, 255, 255, 0.2);
         transform: translateY(-2px);
      }

      .footer .badge i {
         font-size: 16px;
         margin-bottom: 3px;
      }

      .footer .badge span {
         font-size: 10px;
         font-weight: 600;
      }

      @media (max-width: 768px) {
         .candidate-header .container {
            flex-direction: column;
            gap: 10px;
         }

         .footer .security-badges {
            gap: 10px;
         }
      }
   </style>

   @stack('styles')
</head>

<body>
   <!-- Auto-save indicator -->
   <div class="auto-save-indicator" id="autoSaveIndicator" style="display: none">
      <div class="alert alert-success alert-dismissible fade show" role="alert">
         <i class="bi bi-check-circle me-2"></i>
         <span id="autoSaveText">Auto-saved</span>
      </div>
   </div>

   <!-- Candidate Header -->
   <div class="candidate-header">
      <div class="container">
         <div class="logo">
            <h3>🎓 Ujian Online - Peserta</h3>
         </div>
         <div class="user-info">
            <div class="user-avatar">P</div>
            <span id="userName">Peserta</span>
            <button class="logout-btn" onclick="logout()">Logout</button>
         </div>
      </div>
   </div>

   <!-- Main Content -->
   <div class="main-content">
      <div class="container">
         @yield('content')
      </div>
   </div>

   @hasSection('footer')
   <!-- Footer -->
   <div class="footer">
      <div class="container">
         <div class="security-badges">
            <div class="badge">
               <i>🛡️</i>
               <span>Secure</span>
            </div>
            <div class="badge">
               <i>🔒</i>
               <span>Encrypted</span>
            </div>
            <div class="badge">
               <i>✅</i>
               <span>Verified</span>
            </div>
         </div>
         <p>© 2024 Ujian Online. All rights reserved.</p>
      </div>
   </div>
   @else
   <!-- Default Footer -->
   <div class="footer">
      <div class="container">
         <div class="security-badges">
            <div class="badge">
               <i>🛡️</i>
               <span>Secure</span>
            </div>
            <div class="badge">
               <i>🔒</i>
               <span>Encrypted</span>
            </div>
            <div class="badge">
               <i>✅</i>
               <span>Verified</span>
            </div>
         </div>
         <p>© 2024 Ujian Online. All rights reserved.</p>
      </div>
   </div>
   @endif

   <!-- Bootstrap 5 JS -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

   <script>
      // CSRF Token
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

      // Logout function
      async function logout() {
         if (confirm('Apakah Anda yakin ingin logout?')) {
            try {
               const response = await fetch('/auth/logout', {
                  method: 'POST',
                  headers: {
                     'Content-Type': 'application/json',
                     'X-CSRF-TOKEN': csrfToken
                  },
                  body: JSON.stringify({
                     user_type: 'peserta',
                     user_id: 1
                  })
               });

               const result = await response.json();

               if (result.success) {
                  window.location.href = '/';
               } else {
                  alert('Logout gagal. Silakan coba lagi.');
               }
            } catch (error) {
               console.error('Error:', error);
               alert('Terjadi kesalahan saat logout.');
            }
         }
      }

      // Initialize user info
      function initializeUserInfo() {
         const userName = document.getElementById('userName');
         if (userName) {
            userName.textContent = 'Peserta Ujian';
         }
      }

      // Initialize on page load
      document.addEventListener('DOMContentLoaded', function() {
         initializeUserInfo();
      });
   </script>

   @stack('scripts')
</body>

</html>