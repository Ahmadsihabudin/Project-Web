<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login - Ujian Online</title>
   <meta name="csrf-token" content="{{ csrf_token() }}">

   
   <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
   <link rel="icon" type="image/png" href="{{ asset('images/Favicon_akti.png') }}">
   <style>
      * {
         margin: 0;
         padding: 0;
         box-sizing: border-box;
      }

      body {
         font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
         min-height: 100vh;
         display: flex;
         align-items: center;
         justify-content: center;
         position: relative;
         background: #f8f9fa;
      }

      /* Background Pattern Batik Peta Indonesia Abu-Abu Transparan */
      body::before {
         content: '';
         position: fixed;
         top: 0;
         left: 0;
         width: 100%;
         height: 100%;
         background-image: 
            /* Motif pulau-pulau utama Indonesia (bentuk memanjang vertikal) */
            radial-gradient(ellipse 80% 20% at 15% 25%, rgba(108, 117, 125, 0.07) 0%, rgba(108, 117, 125, 0.04) 30%, transparent 60%),
            radial-gradient(ellipse 70% 25% at 20% 50%, rgba(108, 117, 125, 0.06) 0%, rgba(108, 117, 125, 0.03) 35%, transparent 65%),
            radial-gradient(ellipse 60% 30% at 25% 75%, rgba(108, 117, 125, 0.065) 0%, rgba(108, 117, 125, 0.035) 40%, transparent 70%),
            /* Pulau-pulau kecil (Kepulauan) */
            radial-gradient(circle at 85% 20%, rgba(108, 117, 125, 0.05) 0%, transparent 45%),
            radial-gradient(ellipse 40% 15% at 80% 35%, rgba(108, 117, 125, 0.045) 0%, transparent 50%),
            radial-gradient(ellipse 35% 20% at 75% 55%, rgba(108, 117, 125, 0.05) 0%, transparent 55%),
            radial-gradient(circle at 90% 70%, rgba(108, 117, 125, 0.045) 0%, transparent 40%),
            radial-gradient(ellipse 30% 25% at 85% 85%, rgba(108, 117, 125, 0.04) 0%, transparent 60%),
            /* Garis pantai dan detail (motif batik garis) */
            repeating-linear-gradient(0deg, transparent 0px, transparent 2px, rgba(108, 117, 125, 0.03) 2px, rgba(108, 117, 125, 0.03) 3px, transparent 3px, transparent 8px),
            repeating-linear-gradient(90deg, transparent 0px, transparent 2px, rgba(108, 117, 125, 0.03) 2px, rgba(108, 117, 125, 0.03) 3px, transparent 3px, transparent 8px),
            /* Garis diagonal untuk efek batik tradisional */
            repeating-linear-gradient(45deg, transparent 0px, transparent 4px, rgba(108, 117, 125, 0.035) 4px, rgba(108, 117, 125, 0.035) 5px, transparent 5px, transparent 10px),
            repeating-linear-gradient(-45deg, transparent 0px, transparent 4px, rgba(108, 117, 125, 0.035) 4px, rgba(108, 117, 125, 0.035) 5px, transparent 5px, transparent 10px),
            /* Pola tambahan untuk kompleksitas */
            radial-gradient(ellipse 50% 15% at 50% 10%, rgba(108, 117, 125, 0.035) 0%, transparent 50%),
            radial-gradient(ellipse 45% 18% at 45% 90%, rgba(108, 117, 125, 0.04) 0%, transparent 55%);
         background-size: 
            100% 100%, 100% 100%, 100% 100%,
            100% 100%, 100% 100%, 100% 100%, 100% 100%, 100% 100%,
            40px 40px, 40px 40px,
            80px 80px, 80px 80px,
            100% 100%, 100% 100%;
         background-position: 
            0 0, 0 0, 0 0,
            0 0, 0 0, 0 0, 0 0, 0 0,
            0 0, 0 0,
            0 0, 0 0,
            0 0, 0 0;
         z-index: -2;
         opacity: 0.7;
      }

      body::after {
         content: '';
         position: fixed;
         top: 0;
         left: 0;
         width: 100%;
         height: 100%;
         background: rgba(255, 255, 255, 0.3);
         z-index: -1;
      }

      .login-container {
         background: rgba(255, 255, 255, 0.95);
         backdrop-filter: blur(10px);
         border-radius: 20px;
         box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
         padding: 40px;
         width: 100%;
         max-width: 400px;
         position: relative;
         overflow: hidden;
         animation: fadeInUp 0.8s ease-out;
         border: 1px solid rgba(255, 255, 255, 0.2);
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

      .login-container::before {
         content: '';
         position: absolute;
         top: 0;
         left: 0;
         right: 0;
         height: 5px;
         background: linear-gradient(90deg, #991B1B, #B91C1C);
      }

      .logo {
         text-align: center;
         margin-bottom: 30px;
      }

      .logo h1 {
         color: #333;
         font-size: 28px;
         font-weight: 700;
         margin-bottom: 5px;
      }

      .logo p {
         color: #666;
         font-size: 14px;
      }

      .login-tabs {
         display: flex;
         margin-bottom: 30px;
         border-radius: 10px;
         overflow: hidden;
         background: #f8f9fa;
      }

      .tab-button {
         flex: 1;
         padding: 12px;
         border: none;
         background: transparent;
         cursor: pointer;
         font-weight: 600;
         transition: all 0.3s ease;
         color: #666;
      }

      .tab-button.active {
         background: #991B1B;
         color: white;
      }

      .tab-content {
         display: none;
      }

      .tab-content.active {
         display: block;
      }

      .form-group {
         margin-bottom: 20px;
         animation: fadeInUp 0.6s ease-out;
         opacity: 0;
         animation-fill-mode: forwards;
      }

      .form-group:nth-child(1) {
         animation-delay: 0.1s;
      }

      .form-group:nth-child(2) {
         animation-delay: 0.2s;
      }

      .form-group:nth-child(3) {
         animation-delay: 0.3s;
      }

      .form-group label {
         display: block;
         margin-bottom: 8px;
         color: #333;
         font-weight: 600;
         font-size: 14px;
      }

      .form-group input {
         width: 100%;
         padding: 12px 16px;
         border: 2px solid #e1e5e9;
         border-radius: 10px;
         font-size: 16px;
         transition: all 0.3s ease;
         background: #f8f9fa;
      }

      .form-group input:focus {
         outline: none;
         border-color: #991B1B;
         background: white;
         box-shadow: 0 0 0 3px rgba(153, 27, 27, 0.1);
      }

      /* Password toggle icon */
      .password-input-wrapper {
         position: relative;
      }

      .password-toggle {
         position: absolute;
         right: 12px;
         top: 50%;
         transform: translateY(-50%);
         background: none;
         border: none;
         cursor: pointer;
         color: #666;
         padding: 5px 8px;
         display: flex;
         align-items: center;
         justify-content: center;
         transition: color 0.3s ease;
         z-index: 10;
         width: 32px;
         height: 32px;
      }

      .password-toggle:hover {
         color: #991B1B;
      }

      .password-toggle:focus {
         outline: none;
      }

      .password-toggle svg {
         width: 20px;
         height: 20px;
         stroke-width: 2;
         transition: all 0.3s ease;
      }

      .password-toggle:hover svg {
         stroke-width: 2.5;
      }

      .password-input-wrapper input {
         padding-right: 45px;
      }

      .login-btn {
         width: 100%;
         padding: 14px;
         background: linear-gradient(135deg, #991B1B 0%, #B91C1C 100%);
         color: white;
         border: none;
         border-radius: 10px;
         font-size: 16px;
         font-weight: 600;
         cursor: pointer;
         transition: all 0.3s ease;
         margin-top: 10px;
      }

      .login-btn:hover {
         transform: translateY(-2px);
         box-shadow: 0 10px 20px rgba(153, 27, 27, 0.3);
      }

      .login-btn:disabled {
         opacity: 0.6;
         cursor: not-allowed;
         transform: none;
      }

      .alert {
         padding: 12px 16px;
         border-radius: 8px;
         margin-bottom: 20px;
         font-size: 14px;
      }

      .alert-success {
         background: #d4edda;
         color: #155724;
         border: 1px solid #c3e6cb;
      }

      .alert-error {
         background: #f8d7da;
         color: #721c24;
         border: 1px solid #f5c6cb;
      }

      .loading {
         display: none;
         text-align: center;
         margin-top: 10px;
      }

      .spinner {
         border: 2px solid #f3f3f3;
         border-top: 2px solid #667eea;
         border-radius: 50%;
         width: 20px;
         height: 20px;
         animation: spin 1s linear infinite;
         margin: 0 auto;
      }

      @keyframes spin {
         0% {
            transform: rotate(0deg);
         }

         100% {
            transform: rotate(360deg);
         }
      }

      /* Animations */
      .login-container {
         animation: slideInUp 0.8s ease-out;
      }

      @keyframes slideInUp {
         from {
            opacity: 0;
            transform: translateY(50px);
         }

         to {
            opacity: 1;
            transform: translateY(0);
         }
      }

      .logo h1 {
         animation: fadeInDown 1s ease-out 0.2s both;
      }

      .logo p {
         animation: fadeInDown 1s ease-out 0.4s both;
      }

      .form-group {
         animation: fadeInUp 1s ease-out 0.6s both;
      }

      .form-group:nth-child(2) {
         animation-delay: 0.8s;
      }

      @keyframes fadeInDown {
         from {
            opacity: 0;
            transform: translateY(-30px);
         }

         to {
            opacity: 1;
            transform: translateY(0);
         }
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

      /* Floating animation for background - disabled when using background image */
      /* body::before {
         content: '';
         position: fixed;
         top: 0;
         left: 0;
         width: 100%;
         height: 100%;
         background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
         z-index: -2;
         animation: float 6s ease-in-out infinite;
      } */

      /* Animated Particles */
      .particles {
         position: fixed;
         top: 0;
         left: 0;
         width: 100%;
         height: 100%;
         z-index: -1;
         overflow: hidden;
      }

      .particle {
         position: absolute;
         background: rgba(108, 117, 125, 0.1);
         border-radius: 50%;
         animation: floatParticle 8s infinite linear;
      }

      .particle:nth-child(1) {
         width: 80px;
         height: 80px;
         left: 10%;
         animation-delay: 0s;
         animation-duration: 8s;
      }

      .particle:nth-child(2) {
         width: 60px;
         height: 60px;
         left: 20%;
         animation-delay: 2s;
         animation-duration: 10s;
      }

      .particle:nth-child(3) {
         width: 100px;
         height: 100px;
         left: 70%;
         animation-delay: 4s;
         animation-duration: 12s;
      }

      .particle:nth-child(4) {
         width: 40px;
         height: 40px;
         left: 80%;
         animation-delay: 1s;
         animation-duration: 9s;
      }

      .particle:nth-child(5) {
         width: 120px;
         height: 120px;
         left: 50%;
         animation-delay: 3s;
         animation-duration: 11s;
      }

      .particle:nth-child(6) {
         width: 70px;
         height: 70px;
         left: 30%;
         animation-delay: 5s;
         animation-duration: 7s;
      }

      @keyframes floatParticle {
         0% {
            transform: translateY(100vh) rotate(0deg);
            opacity: 0;
         }

         10% {
            opacity: 1;
         }

         90% {
            opacity: 1;
         }

         100% {
            transform: translateY(-100px) rotate(360deg);
            opacity: 0;
         }
      }

      @keyframes float {

         0%,
         100% {
            transform: translateY(0px);
         }

         50% {
            transform: translateY(-20px);
         }
      }

      /* Input focus animation */
      .form-group input:focus {
         animation: pulse 0.3s ease-in-out;
      }

      @keyframes pulse {
         0% {
            transform: scale(1);
         }

         50% {
            transform: scale(1.02);
         }

         100% {
            transform: scale(1);
         }
      }

      /* Button hover animation */
      .login-btn:hover {
         animation: bounce 0.6s ease-in-out;
      }

      @keyframes bounce {

         0%,
         20%,
         50%,
         80%,
         100% {
            transform: translateY(0);
         }

         40% {
            transform: translateY(-10px);
         }

         60% {
            transform: translateY(-5px);
         }
      }

      /* Loading animation enhancement */
      .spinner {
         animation: spin 1s linear infinite, pulse 2s ease-in-out infinite;
      }

      /* Success animation */
      .alert-success {
         animation: slideInRight 0.5s ease-out;
      }

      @keyframes slideInRight {
         from {
            opacity: 0;
            transform: translateX(50px);
         }

         to {
            opacity: 1;
            transform: translateX(0);
         }
      }

      /* Error animation */
      .alert-error {
         animation: shake 0.5s ease-in-out;
      }

      @keyframes shake {

         0%,
         100% {
            transform: translateX(0);
         }

         25% {
            transform: translateX(-5px);
         }

         75% {
            transform: translateX(5px);
         }
      }

      /* Professional Footer */
      .login-footer {
         margin-top: 40px;
         padding-top: 30px;
         border-top: 1px solid #e9ecef;
         animation: fadeInUp 1s ease-out 1.2s both;
      }

      .footer-bottom {
         text-align: center;
         padding-top: 15px;
         border-top: 1px solid #f1f3f4;
      }

      .footer-bottom p {
         color: #999;
         font-size: 11px;
         margin: 0;
      }

      /* Notification Span */
      .notification-container {
         margin-top: 20px;
         overflow: hidden;
         white-space: nowrap;
         border-top: 1px solid #e9ecef;
         padding-top: 15px;
      }

      .notification-text {
         display: inline-block;
         font-size: 13px;
         color: #666;
         animation: scrollText 15s linear infinite;
         font-style: italic;
         transition: all 0.3s ease;
      }

      .notification-container:hover .notification-text {
         animation-play-state: paused;
         color: #991B1B;
      }

      @keyframes scrollText {
         0% {
            transform: translateX(100%);
         }

         100% {
            transform: translateX(-100%);
         }
      }

      /* Enhanced form styling */
      .form-group input {
         transition: all 0.3s ease;
         position: relative;
      }

      .form-group input:focus {
         transform: translateY(-2px);
         box-shadow: 0 8px 25px rgba(153, 27, 27, 0.15);
      }

      /* Logo enhancement */
      .logo h1 {
         background: linear-gradient(135deg, #991B1B 0%, #B91C1C 100%);
         -webkit-background-clip: text;
         -webkit-text-fill-color: transparent;
         background-clip: text;
         text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      }

      /* Button enhancement */
      .login-btn {
         position: relative;
         overflow: hidden;
      }

      .login-btn::before {
         content: '';
         position: absolute;
         top: 0;
         left: -100%;
         width: 100%;
         height: 100%;
         background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
         transition: left 0.5s;
      }

      .login-btn:hover::before {
         left: 100%;
      }

      /* Loading enhancement */
      .loading p {
         animation: fadeInOut 2s ease-in-out infinite;
      }

      @keyframes fadeInOut {

         0%,
         100% {
            opacity: 0.5;
         }

         50% {
            opacity: 1;
         }
      }

      @media (max-width: 480px) {
         .login-container {
            margin: 20px;
            padding: 30px 20px;
         }
      }
   </style>
</head>

<body>
   
   <div class="particles">
      <div class="particle"></div>
      <div class="particle"></div>
      <div class="particle"></div>
      <div class="particle"></div>
      <div class="particle"></div>
      <div class="particle"></div>
   </div>

   <div class="login-container">
      <div class="logo">
         <h1>🎓 Ujian Online</h1>
         <p>Sistem Ujian Online yang Aman & Terpercaya</p>
      </div>

      
      <form id="loginForm">
         <div class="form-group">
            <label for="username" id="usernameLabel">Username / Email / Kode Peserta</label>
            <input type="text" id="username" name="username" required
               placeholder="Masukkan username, email, atau kode peserta">
         </div>
         <div class="form-group">
            <label for="password" id="passwordLabel">Password / Kode Akses</label>
            <div class="password-input-wrapper">
               <input type="password" id="password" name="password" required
                  placeholder="Masukkan password atau kode akses">
               <button type="button" class="password-toggle" id="passwordToggle" aria-label="Toggle password visibility">
                  <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                     <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                  </svg>
               </button>
            </div>
         </div>
         <button type="submit" class="login-btn" id="loginBtn">
            <span id="loginText">Login</span>
            <div id="loginSpinner" class="spinner" style="display: none;"></div>
         </button>
      </form>

      <div id="loading" class="loading">
         <div class="spinner"></div>
         <p>Memproses login...</p>
      </div>

      
      <div class="notification-container">
         <span class="notification-text">Harap pastikan username dan password anda benar!!</span>
      </div>

      
      <div class="login-footer">
         <div class="footer-bottom">
            <p><strong style="color: #800000; border: 2px solid #fff; padding: 2px 8px; border-radius: 4px;">AKADEMI TOYOTA INDONESIA</strong><strong>&copy; 2025</strong></p>
         </div>
      </div>

   </div>

   <script>
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      function detectUserType(username) {
         if (username.includes('@')) {
            return 'admin';
         }
         if (username.toLowerCase() === 'admin') {
            return 'admin';
         }
         return 'peserta';
      }

      function updateFormLabels(userType) {
         const usernameLabel = document.getElementById('usernameLabel');
         const passwordLabel = document.getElementById('passwordLabel');
         const usernameInput = document.getElementById('username');
         const passwordInput = document.getElementById('password');

         if (userType === 'admin') {
            usernameLabel.textContent = 'Username / Email';
            passwordLabel.textContent = 'Password';
            usernameInput.placeholder = 'Masukkan username atau email';
            passwordInput.placeholder = 'Masukkan password';
         } else {
            usernameLabel.textContent = 'Kode Peserta';
            passwordLabel.textContent = 'Kode Akses';
            usernameInput.placeholder = 'Masukkan kode peserta (contoh: RK78607462)';
            passwordInput.placeholder = 'Masukkan kode akses';
         }
      }

      function showAlert(message, type = 'error') {
         const existingAlert = document.querySelector('.alert');
         if (existingAlert) {
            existingAlert.remove();
         }

         const alert = document.createElement('div');
         alert.className = `alert alert-${type}`;
         alert.textContent = message;

         const logo = document.querySelector('.logo');
         logo.insertAdjacentElement('afterend', alert);

         setTimeout(() => {
            if (alert.parentNode) {
               alert.remove();
            }
         }, 5000);
      }

      function showLoading(show) {
         document.getElementById('loading').style.display = show ? 'block' : 'none';
         document.getElementById('loginBtn').disabled = show;

         if (show) {
            document.getElementById('loginText').style.display = 'none';
            document.getElementById('loginSpinner').style.display = 'inline-block';
         } else {
            document.getElementById('loginText').style.display = 'inline';
            document.getElementById('loginSpinner').style.display = 'none';
         }
      }

      document.getElementById('loginForm').addEventListener('submit', async function(e) {
         e.preventDefault();

         const formData = new FormData(this);
         const username = formData.get('username');
         const password = formData.get('password');

         const userType = detectUserType(username);

         showLoading(true);

         try {
            let endpoint, data;

            if (userType === 'admin') {
               endpoint = '/auth/admin/login';
               data = {
                  email: username,
                  password: password
               };
            } else {
               endpoint = '/auth/peserta/login';
               data = {
                  kode_peserta: username,
                  kode_akses: password
               };
            }

            const DEBUG_MODE = false;

            if (DEBUG_MODE) {
               console.log('Login attempt:', {
                  userType,
                  endpoint,
                  data
               });
            }

            const response = await fetch(endpoint, {
               method: 'POST',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken,
                  'Accept': 'application/json'
               },
               body: JSON.stringify(data)
            });

            const contentType = response.headers.get('content-type');
            let result;
            
            if (!contentType || !contentType.includes('application/json')) {
               const text = await response.text();
               
               if (DEBUG_MODE) {
                  console.error('Non-JSON response:', text);
                  console.log('Response status:', response.status);
               }
               
               if (response.status === 401) {
                  showAlert('Akun sedang digunakan di browser lain. Silakan logout terlebih dahulu atau tunggu beberapa saat.');
                  showLoading(false);
                  return;
               }
               
               throw new Error('Server returned non-JSON response');
            }

            result = await response.json();
            
            if (DEBUG_MODE) {
               console.log('=== LOGIN RESULT ===');
               console.log('Response Status:', response.status);
               console.log('Result Object:', result);
               console.log('User Type:', userType);
               console.log('Success:', result.success);
               console.log('Wrong Batch:', result.wrong_batch);
               console.log('Redirect:', result.redirect);
               console.log('===================');
            }

            if (response.status === 419) {
               showAlert('Session expired. Silakan refresh halaman dan coba lagi.');
               location.reload();
               return;
            }

            if (response.status === 409) {
               const errorMessage = result.message || 'Akun sedang digunakan di browser lain. Silakan logout terlebih dahulu atau tunggu beberapa saat.';
               showAlert(errorMessage);
               showLoading(false);
               return;
            }

            if (response.status === 401) {
               const errorMessage = result.message || 'Username atau password salah.';
               
               if (userType === 'admin' && (errorMessage.includes('browser lain') || errorMessage.includes('sedang digunakan'))) {
                  showAlert('Akun sedang digunakan di browser lain. Silakan logout terlebih dahulu atau tunggu beberapa saat.');
               } else {
                  showAlert(errorMessage);
               }
               showLoading(false);
               return;
            }

            if (result.wrong_batch === true) {
               if (DEBUG_MODE) {
                  console.log('🔴 WRONG BATCH DETECTED - Redirecting immediately');
                  console.log('Redirect URL:', result.redirect || '/student/peserta-wrong');
                  console.log('Peserta data:', result.peserta);
               }

               const redirectUrl = result.redirect || '/student/peserta-wrong';

               if (result.peserta) {
                  localStorage.setItem('peserta_wrong_data', JSON.stringify(result.peserta));
               }

               showLoading(false);

               try {
                  window.location.replace(redirectUrl);

                  throw new Error('Redirecting to peserta-wrong');
               } catch (err) {
                  if (DEBUG_MODE) {
                     console.log('Redirect initiated:', err.message);
                  }
               }
               return;
            }

            if (result.success) {
               showAlert('Login berhasil! Mengalihkan ke dashboard...', 'success');

               setTimeout(() => {
                  if (userType === 'admin') {
                     window.location.href = '/admin/dashboard';
                  } else {
                     window.location.href = result.redirect || '/student/information';
                  }
               }, 1500);
            } else {
               const errorMessage = result.message || 'Login gagal! Periksa kembali kredensial Anda.';
               
               if (errorMessage.includes('browser lain') || errorMessage.includes('sedang digunakan')) {
                  showAlert('Akun sedang digunakan di browser lain. Silakan logout terlebih dahulu atau tunggu beberapa saat.');
               } else {
                  showAlert(errorMessage);
               }
               showLoading(false);
            }
         } catch (error) {
            if (DEBUG_MODE) {
               console.error('Login Error:', error);
            }
            
            let errorMessage = 'Terjadi kesalahan. Silakan coba lagi.';
            
            if (error.message && !error.message.includes('non-JSON')) {
               errorMessage = error.message;
            }
            
            showAlert(errorMessage);
            showLoading(false);
         }
      });

      document.getElementById('username').addEventListener('input', function() {
         const userType = detectUserType(this.value);
         updateFormLabels(userType);
      });

      updateFormLabels('peserta');

      const passwordToggle = document.getElementById('passwordToggle');
      const passwordInput = document.getElementById('password');
      const eyeIcon = document.getElementById('eyeIcon');

      passwordToggle.addEventListener('click', function() {
         const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
         passwordInput.setAttribute('type', type);
         
         if (type === 'password') {
            eyeIcon.innerHTML = `
               <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
               <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            `;
            passwordToggle.setAttribute('title', 'Show password');
         } else {
            eyeIcon.innerHTML = `
               <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
            `;
            passwordToggle.setAttribute('title', 'Hide password');
         }
      });
   </script>
</body>

</html>