<!-- Admin Sidebar -->
@if(session('user_type') === 'admin')
<div class="sidebar">
   <div class="p-3">
      <h4 class="text-white mb-4">
         <i class="bi bi-mortarboard me-2"></i>
         Ujian Online
      </h4>
      <nav class="nav flex-column">
         <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" href="/admin/dashboard">
            <i class="bi bi-speedometer2 me-2"></i>
            Dashboard
         </a>
         <a class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}" href="/admin/users">
            <i class="bi bi-people-fill me-2"></i>
            Manajemen User
         </a>
         <a class="nav-link {{ request()->is('admin/participants*') ? 'active' : '' }}" href="/admin/participants">
            <i class="bi bi-people me-2"></i>
            Peserta
         </a>
         <a class="nav-link {{ request()->is('admin/questions*') ? 'active' : '' }}" href="/admin/questions">
            <i class="bi bi-question-circle me-2"></i>
            Soal
         </a>
         <a class="nav-link {{ request()->is('admin/reports*') ? 'active' : '' }}" href="/admin/reports">
            <i class="bi bi-graph-up me-2"></i>
            Laporan
         </a>
         <a class="nav-link {{ request()->is('admin/settings*') ? 'active' : '' }}" href="/admin/settings">
            <i class="bi bi-gear me-2"></i>
            Pengaturan
         </a>
      </nav>
   </div>
</div>
@endif

<!-- Staff Sidebar -->
@if(session('user_type') === 'staff')
<div class="sidebar">
   <div class="p-3">
      <h4 class="text-white mb-4">
         <i class="bi bi-person-badge me-2"></i>
         Staff Panel
      </h4>
      <nav class="nav flex-column">
         <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" href="/admin/dashboard">
            <i class="bi bi-speedometer2 me-2"></i>
            Dashboard
         </a>
         <a class="nav-link {{ request()->is('admin/participants*') ? 'active' : '' }}" href="/admin/participants">
            <i class="bi bi-people me-2"></i>
            Peserta
         </a>
         <a class="nav-link {{ request()->is('admin/questions*') ? 'active' : '' }}" href="/admin/questions">
            <i class="bi bi-question-circle me-2"></i>
            Soal
         </a>
         <a class="nav-link {{ request()->is('admin/reports*') ? 'active' : '' }}" href="/admin/reports">
            <i class="bi bi-graph-up me-2"></i>
            Laporan
         </a>
      </nav>
   </div>
</div>
@endif

<!-- Candidate Sidebar -->
@if(session('user_type') === 'peserta')
<div class="sidebar">
   <div class="p-3">
      <h4 class="text-white mb-4">
         <i class="bi bi-person-circle me-2"></i>
         Peserta
      </h4>
      <nav class="nav flex-column">
         <a class="nav-link {{ request()->is('candidate/dashboard') ? 'active' : '' }}" href="/candidate/dashboard">
            <i class="bi bi-house me-2"></i>
            Beranda
         </a>
         <a class="nav-link {{ request()->is('candidate/exam*') ? 'active' : '' }}" href="/candidate/exam">
            <i class="bi bi-file-text me-2"></i>
            Ujian
         </a>
      </nav>
   </div>
</div>
@endif