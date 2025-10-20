<!-- Mobile Menu Toggle Button -->
<button class="mobile-menu-toggle" onclick="toggleSidebar()">
   <i class="bi bi-list"></i>
</button>

<!-- Mobile Overlay -->
<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

<!-- Admin Sidebar -->
@if(session('user_type') === 'admin')
<div class="sidebar" id="sidebar">
   <div class="p-3">
      <div class="d-flex justify-content-between align-items-center mb-4">
         <h4 class="text-white mb-0">
            <i class="bi bi-mortarboard me-2"></i>
            Ujian Online
         </h4>
         <button class="btn btn-link text-white p-0 d-md-none" onclick="toggleSidebar()">
            <i class="bi bi-x-lg"></i>
         </button>
      </div>
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
         <a class="nav-link {{ request()->is('admin/sesi-ujian*') ? 'active' : '' }}" href="/admin/sesi-ujian">
            <i class="bi bi-calendar-event me-2"></i>
            Sesi Ujian
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
<div class="sidebar" id="sidebar">
   <div class="p-3">
      <div class="d-flex justify-content-between align-items-center mb-4">
         <h4 class="text-white mb-0">
            <i class="bi bi-person-badge me-2"></i>
            Staff Panel
         </h4>
         <button class="btn btn-link text-white p-0 d-md-none" onclick="toggleSidebar()">
            <i class="bi bi-x-lg"></i>
         </button>
      </div>
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
         <a class="nav-link {{ request()->is('student/exam*') ? 'active' : '' }}" href="/student/exam">
            <i class="bi bi-file-text me-2"></i>
            Sesi Ujian
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

<!-- Candidate Sidebar -->
@if(session('user_type') === 'peserta')
<div class="sidebar" id="sidebar">
   <div class="p-3">
      <div class="d-flex justify-content-between align-items-center mb-4">
         <h4 class="text-white mb-0">
            <i class="bi bi-person-circle me-2"></i>
            Peserta
         </h4>
         <button class="btn btn-link text-white p-0 d-md-none" onclick="toggleSidebar()">
            <i class="bi bi-x-lg"></i>
         </button>
      </div>
      <nav class="nav flex-column">
         <a class="nav-link {{ request()->is('student/dashboard') ? 'active' : '' }}" href="/student/dashboard">
            <i class="bi bi-house me-2"></i>
            Beranda
         </a>

      </nav>
   </div>
</div>
@endif

<script>
   function toggleSidebar() {
      const sidebar = document.getElementById('sidebar');
      const overlay = document.getElementById('sidebarOverlay');

      if (sidebar) {
         sidebar.classList.toggle('show');
         if (overlay) {
            overlay.classList.toggle('show');
         }
      }
   }

   function closeSidebar() {
      const sidebar = document.getElementById('sidebar');
      const overlay = document.getElementById('sidebarOverlay');

      if (sidebar) {
         sidebar.classList.remove('show');
      }
      if (overlay) {
         overlay.classList.remove('show');
      }
   }

   // Close sidebar when clicking outside on mobile
   document.addEventListener('click', function(event) {
      const sidebar = document.getElementById('sidebar');
      const toggleButton = document.querySelector('.mobile-menu-toggle');
      const overlay = document.getElementById('sidebarOverlay');

      if (window.innerWidth <= 768 && sidebar && !sidebar.contains(event.target) && !toggleButton.contains(event.target)) {
         sidebar.classList.remove('show');
         if (overlay) {
            overlay.classList.remove('show');
         }
      }
   });

   // Close sidebar when window is resized to desktop
   window.addEventListener('resize', function() {
      const sidebar = document.getElementById('sidebar');
      const overlay = document.getElementById('sidebarOverlay');

      if (window.innerWidth > 768) {
         if (sidebar) {
            sidebar.classList.remove('show');
         }
         if (overlay) {
            overlay.classList.remove('show');
         }
      }
   });

   // Close sidebar when pressing Escape key
   document.addEventListener('keydown', function(event) {
      if (event.key === 'Escape') {
         closeSidebar();
      }
   });
</script>