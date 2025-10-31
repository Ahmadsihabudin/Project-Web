<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>@yield('title', 'Ujian Online - Student Portal')</title>

   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <!-- Bootstrap Icons -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

   <style>
      .student-navbar {
         background-color: #991B1B;
         box-shadow: 0 8px 36px 0 rgba(0, 0, 0, 0.35);
         padding: 15px 0;
         position: sticky;
         top: 0;
         z-index: 1000;
      }

      .navbar-brand {
         display: flex;
         align-items: center;
         text-decoration: none;
         color: white !important;
         font-weight: 700;
         font-size: 1.5rem;
      }

      .navbar-logo {
         width: 50px;
         height: 50px;
         margin-right: 15px;
         object-fit: cover;
      }

      .navbar-brand-text {
         display: flex;
         flex-direction: column;
      }

      .navbar-title {
         font-size: 1.5rem;
         font-weight: 700;
         margin: 0;
         line-height: 1.2;
      }

      .navbar-tagline {
         font-size: 0.85rem;
         font-weight: 400;
         opacity: 0.9;
         margin: 0;
         line-height: 1;
      }

      .navbar-nav {
         display: flex;
         align-items: center;
         gap: 20px;
      }

      .nav-link {
         color: #f5f5f5 !important;
         font-weight: 600;
         padding: 8px 16px !important;
         border-radius: 25px;
         transition: all 0.3s ease;
         text-decoration: none;
      }

      .nav-link:hover {
         background: white;
         color: #333 !important;
         transform: translateY(-2px);
      }

      .nav-link.active {
         background: #B91C1C;
         box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
      }

      .user-info {
         display: flex;
         align-items: center;
         gap: 15px;
         color: white;
      }

      .user-avatar {
         width: 40px;
         height: 40px;
         border-radius: 50%;
         background: #f5f5f5;
         color: #333;
         display: flex;
         align-items: center;
         justify-content: center;
         font-size: 1.2rem;
         font-weight: bold;
         transition: all 0.3s ease;
      }

      .user-avatar:hover {
         background: white;
         color: #333;
      }

      .user-details {
         display: flex;
         flex-direction: column;
      }

      .user-name {
         font-weight: 600;
         font-size: 0.9rem;
         margin: 0;
         line-height: 1.2;
      }

      .user-batch {
         font-size: 0.8rem;
         opacity: 0.8;
         margin: 0;
         line-height: 1;
      }

      .logout-btn {
         background: #f5f5f5;
         border: 2px solid #f5f5f5;
         color: #991B1B;
         padding: 8px 20px;
         border-radius: 25px;
         font-weight: 600;
         transition: all 0.3s ease;
         text-decoration: none;
      }

      .logout-btn:hover {
         background: white;
         border-color: white;
         color: maroon;
         transform: translateY(-2px);
      }

      @media (max-width: 768px) {
         .navbar-brand-text {
            display: none;
         }

         .user-details {
            display: none;
         }

         .navbar-nav {
            gap: 10px;
         }
      }
   </style>
</head>

<body>
   <nav class="navbar navbar-expand-lg student-navbar">
      <div class="container">
         <!-- Brand/Logo -->
         <a class="navbar-brand" href="{{ route('student.information') }}">
            <img src="{{ asset('images/Favicon_akti.png') }}" alt="Logo" class="navbar-logo" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
            <div class="navbar-brand-text" style="display: none;">
               <h1 class="navbar-title">Ujian Online</h1>
               <p class="navbar-tagline">Student Portal</p>
            </div>
         </a>

         <!-- Navigation Links -->


         <!-- User Info & Logout -->
         <div class="user-info">
            <div class="user-avatar" id="userAvatar">
               <i class="bi bi-person"></i>
            </div>
            <div class="user-details">
               <p class="user-name" id="userName">Peserta</p>
               <p class="user-batch" id="userBatch">-</p>
            </div>
            <a href="{{ route('auth.logout') }}" class="logout-btn" onclick="return confirm('Apakah Anda yakin ingin keluar?')">
               <i class="bi bi-box-arrow-right me-1"></i>
               Keluar
            </a>
         </div>
      </div>
   </nav>

   <!-- Main Content -->
   <main>
      @yield('content')
   </main>

   <!-- Bootstrap JS -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

   <script>
      // Load user info
      document.addEventListener('DOMContentLoaded', function() {
         loadUserInfo();
      });

      async function loadUserInfo() {
         try {
            // First, check if peserta data is available from peserta-wrong page
            const pesertaDataElement = document.getElementById('peserta-data');
            if (pesertaDataElement) {
               const pesertaData = JSON.parse(pesertaDataElement.textContent);
               if (pesertaData) {
                  updateNavbarInfo(pesertaData);
                  return;
               }
            }

            // Otherwise, try to fetch from exam data endpoint
            const response = await fetch('/student/exam/data', {
               headers: {
                  'Accept': 'application/json'
               }
            });

            // Check if response is JSON
            const contentType = response.headers.get('content-type');
            if (!contentType || !contentType.includes('application/json')) {
               // Not authenticated or got HTML redirect
               console.log('User not authenticated, skipping navbar data load');
               return;
            }

            const result = await response.json();

            if (result.success && result.peserta) {
               updateNavbarInfo(result.peserta);
            }
         } catch (error) {
            // Silently fail if user is not authenticated
            console.log('Could not load user info, user may not be authenticated');
         }
      }

      function updateNavbarInfo(user) {
         const userNameEl = document.getElementById('userName');
         const userBatchEl = document.getElementById('userBatch');
         const avatarEl = document.getElementById('userAvatar');

         if (userNameEl) userNameEl.textContent = user.nama || 'Peserta';
         if (userBatchEl) userBatchEl.textContent = user.batch || '-';

         // Update avatar with first letter of name
         if (avatarEl) {
            const firstName = (user.nama || 'P').charAt(0).toUpperCase();
            avatarEl.innerHTML = firstName;
         }
      }

      function showProfile() {
         alert('Fitur profil akan segera hadir!');
      }
   </script>
</body>

</html>