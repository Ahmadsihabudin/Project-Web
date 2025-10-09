<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm border-bottom">
   <div class="container-fluid">
      <span class="navbar-brand mb-0 h1 fw-bold text-primary">
         @if(session('user_type') === 'admin')
         @if(request()->is('admin/users*'))
         <i class="bi bi-people-fill me-2"></i>Manajemen User
         @elseif(request()->is('admin/participants*'))
         <i class="bi bi-people me-2"></i>Peserta
         @elseif(request()->is('admin/questions*'))
         <i class="bi bi-question-circle me-2"></i>Bank Soal
         @elseif(request()->is('admin/reports*'))
         <i class="bi bi-graph-up me-2"></i>Laporan
         @elseif(request()->is('admin/settings*'))
         <i class="bi bi-gear me-2"></i>Pengaturan
         @else
         <i class="bi bi-speedometer2 me-2"></i>Dashboard
         @endif
         @elseif(session('user_type') === 'staff')
         @if(request()->is('admin/participants*'))
         <i class="bi bi-people me-2"></i>Peserta
         @elseif(request()->is('admin/questions*'))
         <i class="bi bi-question-circle me-2"></i>Bank Soal
         @elseif(request()->is('admin/reports*'))
         <i class="bi bi-graph-up me-2"></i>Laporan
         @else
         <i class="bi bi-speedometer2 me-2"></i>Dashboard
         @endif
         @else
         @if(request()->is('candidate/exam*'))
         <i class="bi bi-journal-text me-2"></i>Ujian Online
         @elseif(request()->is('candidate/profile*'))
         <i class="bi bi-person me-2"></i>Profil
         @else
         <i class="bi bi-house me-2"></i>Dashboard Peserta
         @endif
         @endif
      </span>

      <div class="navbar-nav ms-auto">
         <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
               <div class="avatar-circle me-2">
                  <i class="bi bi-person-fill"></i>
               </div>
               <div class="d-flex flex-column">
                  <span class="fw-semibold">
                     @if(session('user_type') === 'admin')
                     Administrator
                     @elseif(session('user_type') === 'staff')
                     Staff
                     @else
                     Peserta
                     @endif
                  </span>
                  <small class="text-muted">{{ session('user_email', 'user@example.com') }}</small>
               </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" style="min-width: 200px;">
               <li class="dropdown-header d-flex align-items-center">
                  <i class="bi bi-person-circle me-2 text-primary"></i>
                  <div>
                     <div class="fw-semibold">{{ session('user_name', 'User') }}</div>
                     <small class="text-muted">{{ session('user_email', 'user@example.com') }}</small>
                  </div>
               </li>
               <li>
                  <hr class="dropdown-divider">
               </li>
               <li>
                  <a class="dropdown-item d-flex align-items-center" href="#" onclick="showProfile()">
                     <i class="bi bi-person me-2"></i>
                     <span>Profil Saya</span>
                  </a>
               </li>
               @if(session('user_type') === 'admin')
               <li>
                  <a class="dropdown-item d-flex align-items-center" href="#" onclick="showSettings()">
                     <i class="bi bi-gear me-2"></i>
                     <span>Pengaturan</span>
                  </a>
               </li>
               @endif
               <li>
                  <hr class="dropdown-divider">
               </li>
               <li>
                  <a class="dropdown-item d-flex align-items-center text-danger" href="#" onclick="simpleLogout()">
                     <i class="bi bi-box-arrow-right me-2"></i>
                     <span>Logout</span>
                  </a>
               </li>
            </ul>
         </div>
      </div>
   </div>
</nav>

<style>
   .avatar-circle {
      width: 32px;
      height: 32px;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 14px;
   }

   .dropdown-menu {
      border-radius: 8px;
      padding: 8px 0;
   }

   .dropdown-item {
      padding: 8px 16px;
      transition: all 0.2s ease;
   }

   .dropdown-item:hover {
      background-color: #f8f9fa;
      color: #667eea;
   }

   .dropdown-item.text-danger:hover {
      background-color: #fee;
      color: #dc3545;
   }

   .dropdown-header {
      padding: 12px 16px;
      background-color: #f8f9fa;
      border-bottom: 1px solid #dee2e6;
   }

   .navbar-brand {
      font-size: 1.5rem;
   }
</style>