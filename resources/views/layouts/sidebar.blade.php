<button class="mobile-menu-toggle" onclick="toggleSidebar()">
   <i class="bi bi-list"></i>
</button>

<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

@if(session('user_type') === 'admin')
<div class="sidebar" id="sidebar">
   <div class="p-3">
      <div class="d-flex justify-content-between align-items-center mb-4">
         <h4 class="text-white mb-0">
            @php
               $appLogo = App\Models\Setting::where('key', 'app.logo')->first();
               $appName = App\Models\Setting::where('key', 'app.name')->first();
               $logoUrl = $appLogo ? $appLogo->value : null;
               $name = $appName ? $appName->value : 'Ujian Online';
            @endphp
            @if($logoUrl)
               <img src="{{ $logoUrl }}" alt="Logo" style="width: 32px; height: 32px; object-fit: contain; margin-right: 0.5rem;" onerror="this.style.display='none'; this.nextElementSibling.style.display='inline';">
            @endif
            <i class="bi bi-mortarboard me-2" @if($logoUrl) style="display: none;" @endif></i>
            {{ $name }}
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

         <div class="nav-item dropdown-nav">
            <a class="nav-link dropdown-toggle {{ request()->is('admin/settings*') ? 'active' : '' }}" href="#" id="pengaturanDropdown" role="button" onclick="toggleDropdown(event, 'pengaturanSubmenu')">
               <i class="bi bi-gear me-2"></i>
               Pengaturan
               <i class="bi bi-chevron-down ms-auto dropdown-icon" id="pengaturanIcon"></i>
            </a>
            <ul class="dropdown-submenu" id="pengaturanSubmenu">
               <li>
                  <a class="dropdown-item {{ request()->is('admin/settings/info-ujian*') ? 'active' : '' }}" href="/admin/settings/info-ujian">
                     <i class="bi bi-info-circle me-2"></i>
                     Info Ujian
                  </a>
               </li>
               <li>
                  <a class="dropdown-item {{ request()->is('admin/settings/backup*') ? 'active' : '' }}" href="/admin/settings/backup">
                     <i class="bi bi-database me-2"></i>
                     Backup Data
                  </a>
               </li>
               <li>
                  <a class="dropdown-item {{ request()->is('admin/settings/logo*') ? 'active' : '' }}" href="/admin/settings/logo">
                     <i class="bi bi-palette me-2"></i>
                     Logo & Tampilan
                  </a>
               </li>
            </ul>
         </div>
      </nav>
   </div>
</div>
@endif

@if(session('user_type') === 'staff')
<div class="sidebar" id="sidebar">
   <div class="p-3">
      <div class="d-flex justify-content-between align-items-center mb-4">
         <h4 class="text-white mb-0">
            @php
               $appLogo = App\Models\Setting::where('key', 'app.logo')->first();
               $appName = App\Models\Setting::where('key', 'app.name')->first();
               $logoUrl = $appLogo ? $appLogo->value : null;
               $name = $appName ? $appName->value : 'Ujian Online';
            @endphp
            @if($logoUrl)
               <img src="{{ $logoUrl }}" alt="Logo" style="width: 32px; height: 32px; object-fit: contain; margin-right: 0.5rem;" onerror="this.style.display='none'; this.nextElementSibling.style.display='inline';">
            @endif
            <i class="bi bi-person-badge me-2" @if($logoUrl) style="display: none;" @endif></i>
            {{ $name }}
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
         
         <div class="nav-item dropdown-nav">
            <a class="nav-link dropdown-toggle {{ request()->is('admin/settings*') ? 'active' : '' }}" href="#" id="pengaturanDropdownStaff" role="button" onclick="toggleDropdown(event, 'pengaturanSubmenuStaff')">
               <i class="bi bi-gear me-2"></i>
               Pengaturan
               <i class="bi bi-chevron-down ms-auto dropdown-icon" id="pengaturanIconStaff"></i>
            </a>
            <ul class="dropdown-submenu" id="pengaturanSubmenuStaff">
               <li>
                  <a class="dropdown-item {{ request()->is('admin/settings/info-ujian*') ? 'active' : '' }}" href="/admin/settings/info-ujian">
                     <i class="bi bi-info-circle me-2"></i>
                     Info Ujian
                  </a>
               </li>
               <li>
                  <a class="dropdown-item {{ request()->is('admin/settings/backup*') ? 'active' : '' }}" href="/admin/settings/backup">
                     <i class="bi bi-database me-2"></i>
                     Backup Data
                  </a>
               </li>
               <li>
                  <a class="dropdown-item {{ request()->is('admin/settings/logo*') ? 'active' : '' }}" href="/admin/settings/logo">
                     <i class="bi bi-palette me-2"></i>
                     Logo & Tampilan
                  </a>
               </li>
            </ul>
         </div>
      </nav>
   </div>
</div>
@endif

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

   document.addEventListener('keydown', function(event) {
      if (event.key === 'Escape') {
         closeSidebar();
      }
   });

   function toggleDropdown(event, submenuId) {
      event.preventDefault();
      const submenu = document.getElementById(submenuId);
      const icon = event.currentTarget.querySelector('.dropdown-icon');
      
      document.querySelectorAll('.dropdown-submenu').forEach(menu => {
         if (menu.id !== submenuId) {
            menu.classList.remove('show');
         }
      });
      
      if (submenu) {
         submenu.classList.toggle('show');
         if (icon) {
            icon.classList.toggle('rotate');
         }
      }
   }

   document.addEventListener('click', function(event) {
      if (!event.target.closest('.dropdown-nav')) {
         document.querySelectorAll('.dropdown-submenu').forEach(menu => {
            menu.classList.remove('show');
         });
         document.querySelectorAll('.dropdown-icon').forEach(icon => {
            icon.classList.remove('rotate');
         });
      }
   });

   document.addEventListener('DOMContentLoaded', function() {
      const currentPath = window.location.pathname;
      if (currentPath.includes('/settings/info-ujian') || currentPath.includes('/settings/backup') || currentPath.includes('/settings/logo')) {
         const pengaturanSubmenu = document.getElementById('pengaturanSubmenu') || document.getElementById('pengaturanSubmenuStaff');
         const pengaturanIcon = document.getElementById('pengaturanIcon') || document.getElementById('pengaturanIconStaff');
         
         if (pengaturanSubmenu) {
            pengaturanSubmenu.classList.add('show');
         }
         if (pengaturanIcon) {
            pengaturanIcon.classList.add('rotate');
         }
      }
   });
</script>