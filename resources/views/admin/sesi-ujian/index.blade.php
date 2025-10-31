<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Sesi Ujian - Ujian Online</title>
   <meta name="csrf-token" content="{{ csrf_token() }}">

   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   <!-- Bootstrap Icons -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
   <!-- Bootstrap JS -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

   <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
   @include('layouts.alert-system')

   <link rel="icon" type="image/png" href="{{ asset('images/Favicon_akti.png') }}">

   <style>
      .page-header {
         background: #f8f9fa;
         color: #333;
         border-radius: 10px;
         padding: 1.5rem;
         margin-bottom: 2rem;
      }

      .stats-card {
         background: #f8f9fa;
         color: #333;
         border-radius: 10px;
         padding: 1.5rem;
         box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
         margin-bottom: 1.5rem;
         border: none;
      }

      .stats-card .text-muted {
         color: #6c757d !important;
      }

      .action-buttons {
         display: flex;
         gap: 0.25rem;
         flex-wrap: nowrap;
         justify-content: center;
      }

      .action-buttons .btn {
         padding: 0.25rem 0.5rem;
         font-size: 0.75rem;
         border-radius: 0.25rem;
         min-width: 32px;
         height: 32px;
         display: flex;
         align-items: center;
         justify-content: center;
      }

      .table {
         margin-bottom: 0;
      }

      .table th {
         background-color: #f8f9fa;
         border-bottom: 2px solid #dee2e6;
         font-weight: 600;
         color: #495057;
         padding: 1rem 0.75rem;
         font-size: 0.875rem;
         text-transform: uppercase;
         letter-spacing: 0.5px;
      }

      .table td {
         vertical-align: middle;
         padding: 0.875rem 0.75rem;
         border-top: 1px solid #dee2e6;
      }

      .table tbody tr:hover {
         background-color: #f8f9fa;
      }

      .card {
         border: none;
         box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
         border-radius: 0.5rem;
      }

      .card-header {
         background-color: #f8f9fa;
         border-bottom: 1px solid #dee2e6;
         border-radius: 0.5rem 0.5rem 0 0 !important;
         padding: 1rem 1.25rem;
      }

      /* Responsive table */
      @media (max-width: 768px) {
         .table-responsive {
            border: none;
         }

         .table th,
         .table td {
            padding: 0.5rem 0.25rem;
            font-size: 0.8rem;
         }

         .action-buttons {
            gap: 0.125rem;
         }

         .action-buttons .btn {
            padding: 0.125rem 0.25rem;
            font-size: 0.7rem;
            min-width: 28px;
            height: 28px;
         }
      }

      @media (max-width: 576px) {

         .table th,
         .table td {
            padding: 0.375rem 0.125rem;
            font-size: 0.75rem;
         }

         .action-buttons .btn {
            padding: 0.1rem 0.2rem;
            font-size: 0.65rem;
            min-width: 24px;
            height: 24px;
         }
      }

      .sesi-ujian-card {
         background: white;
         border-radius: 10px;
         padding: 1.5rem;
         margin-bottom: 1rem;
         box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
         transition: transform 0.2s ease;
      }

      .sesi-ujian-card:hover {
         transform: translateY(-2px);
      }

      .status-badge {
         font-size: 0.9rem;
         padding: 0.5rem 1rem;
      }

      .datetime-input {
         background: #f8f9fa;
         border: 1px solid #dee2e6;
         border-radius: 5px;
         padding: 0.5rem;
      }

      input[type="datetime-local"]::-webkit-datetime-edit-text,
      input[type="datetime-local"]::-webkit-datetime-edit-month-field,
      input[type="datetime-local"]::-webkit-datetime-edit-day-field,
      input[type="datetime-local"]::-webkit-datetime-edit-year-field,
      input[type="datetime-local"]::-webkit-datetime-edit-hour-field,
      input[type="datetime-local"]::-webkit-datetime-edit-minute-field {
         color: #495057;
      }

      /* Nama ujian cell styling */
      .nama-ujian-cell {
         max-width: 250px;
         word-wrap: break-word;
      }

      .nama-ujian-title {
         font-weight: 600;
         color: #495057;
         margin-bottom: 0.25rem;
         font-size: 0.9rem;
      }

      .mata-pelajaran-badges {
         margin-top: 0.25rem;
      }

      .nama-ujian-cell .badge {
         font-size: 0.7rem;
         padding: 0.2rem 0.4rem;
      }

      .clickable-subject {
         transition: all 0.2s ease;
      }

      .clickable-subject:hover {
         transform: scale(1.05);
         box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
      }

      /* Disable Bootstrap Button Styles */
      .btn-primary {
         background-color: transparent !important;
         border-color: transparent !important;
         color: inherit !important;
      }

      .btn-primary:hover {
         background-color: transparent !important;
         border-color: transparent !important;
         color: inherit !important;
      }

      /* Theme Button Style */
      .theme-btn {
         padding: 0.5rem 1rem;
         /* Padding lebih kecil */
         border: 2px solid #74292a;
         /* Border maroon 2px */
         color: #292929;
         /* Warna teks hitam (--heading-color) */
         text-transform: capitalize;
         /* Huruf kapital */
         font-weight: 400;
         /* Font weight normal */
         border-radius: 0.375rem;
         /* Border radius normal */
         transition: 0.4s cubic-bezier(0, 0, 1, 1);
         /* Transisi smooth */
         position: relative;
         /* Untuk pseudo-element */
         z-index: 1;
         /* Layer di atas */
         background: white;
         /* Background putih */
         font-size: 0.875rem;
         /* Font size lebih kecil */
      }

      .theme-btn i {
         margin-left: 7px;
         /* Jarak 7px dari teks */
      }

      .theme-btn:hover {
         color: #fff;
         /* Warna teks putih saat hover */
         border-color: white;
         /* Border putih saat hover */
      }

      .theme-btn::before {
         position: absolute;
         /* Posisi absolut */
         z-index: -1;
         /* Di belakang teks */
         content: "";
         /* Elemen kosong */
         background-color: #74292a;
         /* Background maroon */
         height: 0%;
         /* Tinggi 0% (tidak terlihat) */
         width: 0%;
         /* Lebar 0% (tidak terlihat) */
         top: 50%;
         /* Posisi tengah vertikal */
         left: 50%;
         /* Posisi tengah horizontal */
         transform: translate(-50%, -50%);
         /* Posisi tepat di tengah */
         opacity: 0;
         /* Tidak terlihat */
         transition: 0.4s cubic-bezier(0, 0, 1, 1);
         /* Transisi smooth */
         border-radius: 0.375rem;
         /* Border radius sama dengan button */
      }

      .theme-btn:hover::before {
         opacity: 1;
         /* Terlihat */
         width: 98%;
         /* Lebar hampir penuh */
         height: 96%;
         /* Tinggi hampir penuh */
      }

      .theme-btn {
         text-decoration: none !important;
      }

      .theme-btn:hover {
         text-decoration: none !important;
      }
   </style>
</head>

<body>
   <div class="container-fluid">
      <!-- Sidebar -->
      @include('layouts.sidebar')

      <!-- Main Content -->
      <div class="main-content">
         <!-- Navbar -->
         @include('layouts.navbar')

         <!-- Content -->
         <div class="p-4">
            <!-- Statistics Cards -->
            <div class="row mb-4">
               <div class="col-md-3">
                  <div class="stats-card">
                     <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                           <i class="bi bi-calendar-event-fill" style="font-size: 2rem; color: #007bff;"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                           <h5 class="mb-0" id="totalSesiUjian">0</h5>
                           <p class="text-muted mb-0">Total Sesi</p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="stats-card">
                     <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                           <i class="bi bi-play-circle-fill" style="font-size: 2rem; color: #28a745;"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                           <h5 class="mb-0" id="activeSesiUjian">0</h5>
                           <p class="text-muted mb-0">Aktif</p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="stats-card">
                     <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                           <i class="bi bi-pause-circle-fill" style="font-size: 2rem; color: #ffc107;"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                           <h5 class="mb-0" id="scheduledSesiUjian">0</h5>
                           <p class="text-muted mb-0">Terjadwal</p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="stats-card">
                     <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                           <i class="bi bi-check-circle-fill" style="font-size: 2rem; color: #28a745;"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                           <h5 class="mb-0" id="completedSesiUjian">0</h5>
                           <p class="text-muted mb-0">Selesai</p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <!-- Sessions Table -->
            <div class="card">
               <div class="card-header d-flex justify-content-between align-items-center">
                  <h6 class="m-0 font-weight-bold">Daftar Sesi Ujian</h6>
                  <a href="{{ route('admin.sesi-ujian.create') }}" class="theme-btn">
                     <i class="bi bi-plus-circle me-1"></i>
                     Buat Sesi Ujian
                  </a>
               </div>
               <div class="card-body">
                  <div class="table-responsive">
                     <table class="table table-striped" id="sesiUjianTable">
                        <thead>
                           <tr>
                              <th width="5%">No</th>
                              <th width="25%">Nama Ujian</th>
                              <th width="10%">Batch</th>
                              <th width="15%">Tanggal Mulai</th>
                              <th width="10%">Jam Mulai</th>
                              <th width="15%">Tanggal Selesai</th>
                              <th width="10%">Jam Selesai</th>
                              <th width="8%">Durasi</th>
                              <th width="7%">Status</th>
                              <th width="10%">Aksi</th>
                           </tr>
                        </thead>
                        <tbody>
                           <!-- Data will be loaded here -->
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <script>
      if (typeof csrfToken === 'undefined') {
         var csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
      }

      async function loadStats() {
         try {
            console.log('Loading stats...');
            const response = await fetch('/admin/sesi-ujian/stats', {
               method: 'GET',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
               }
            });

            console.log('Stats response status:', response.status);

            if (response.ok) {
               const result = await response.json();
               console.log('Stats data:', result);
               if (result.success) {
                  displayStats(result.data);
               } else {
                  console.error('Stats API returned error:', result.message);
               }
            } else {
               console.error('Stats HTTP error:', response.status, response.statusText);
            }
         } catch (error) {
            console.error('Error loading stats:', error);
         }
      }

      function displayStats(stats) {
         document.getElementById('totalSesiUjian').textContent = stats.total || 0;
         document.getElementById('activeSesiUjian').textContent = stats.active || 0;
         document.getElementById('scheduledSesiUjian').textContent = stats.scheduled || 0;
         document.getElementById('completedSesiUjian').textContent = stats.completed || 0;
      }

      async function loadSesiUjian() {
         try {
            console.log('Loading sesi ujian...');
            const response = await fetch('/admin/sesi-ujian/data', {
               method: 'GET',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
               }
            });

            console.log('Response status:', response.status);

            if (response.ok) {
               const result = await response.json();
               console.log('SesiUjian data:', result);
               if (result.success) {
                  displaySesiUjian(result.data);
               } else {
                  console.error('API returned error:', result.message);
                  alertSystem.error('Gagal memuat data', result.message);
               }
            } else {
               console.error('HTTP error:', response.status, response.statusText);
               const errorText = await response.text();
               console.error('Error response:', errorText);
               alertSystem.error('Gagal memuat data', `HTTP ${response.status}: ${response.statusText}`);
            }
         } catch (error) {
            console.error('Error loading sesi ujian:', error);
            alertSystem.error('Gagal memuat data', 'Terjadi kesalahan jaringan');
         }
      }

      function createNamaUjianDisplay(namaUjian, mataPelajaranString) {
         if (!namaUjian) return '<span class="text-muted">Tidak ada nama ujian</span>';

         if (mataPelajaranString && mataPelajaranString.includes(',')) {
            const subjects = mataPelajaranString.split(',').map(s => s.trim().toLowerCase());
            const maxDisplay = 2;

            if (subjects.length <= maxDisplay) {
               // Show all subjects if 2 or less
               return `
                  <div class="nama-ujian-title">${namaUjian}</div>
                  <div class="mata-pelajaran-badges">
                     ${subjects.map(subject => 
                        `<span class="badge bg-primary me-1 mb-1">${subject}</span>`
                     ).join('')}
                  </div>
               `;
            } else {
               // Show first 2 subjects + "..."
               const displaySubjects = subjects.slice(0, maxDisplay);
               const remainingCount = subjects.length - maxDisplay;

               return `
                  <div class="nama-ujian-title">${namaUjian}</div>
                  <div class="mata-pelajaran-badges">
                     ${displaySubjects.map(subject => 
                        `<span class="badge bg-primary me-1 mb-1">${subject}</span>`
                     ).join('')}
                     <span class="badge bg-secondary me-1 mb-1 clickable-subject" 
                           style="cursor: pointer;" 
                           title="Klik untuk melihat semua mata pelajaran">
                        +${remainingCount} lainnya
                     </span>
                  </div>
               `;
            }
         } else {
            // Single subject or no subjects
            return `
               <div class="nama-ujian-title">${namaUjian}</div>
               ${mataPelajaranString ? `<div class="mata-pelajaran-badges"><span class="badge bg-primary me-1 mb-1">${mataPelajaranString.toLowerCase()}</span></div>` : ''}
            `;
         }
      }

      // Display sesi ujian
      function displaySesiUjian(sesiUjian) {
         console.log('Displaying sesi ujian:', sesiUjian);
         const tbody = document.querySelector('#sesiUjianTable tbody');
         tbody.innerHTML = '';

         if (!sesiUjian || sesiUjian.length === 0) {
            tbody.innerHTML = '<tr><td colspan="10" class="text-center">Tidak ada data sesi ujian</td></tr>';
            return;
         }

         sesiUjian.forEach((sesiUjianItem, index) => {
            const row = document.createElement('tr');
            const namaUjianDisplay = createNamaUjianDisplay(sesiUjianItem.nama_ujian, sesiUjianItem.mata_pelajaran);

            row.innerHTML = `
               <td>${index + 1}</td>
               <td>
                  <div class="nama-ujian-cell" data-full-text="${sesiUjianItem.nama_ujian || ''}" data-mata-pelajaran="${sesiUjianItem.mata_pelajaran || ''}">
                     ${namaUjianDisplay}
                  </div>
               </td>
               <td><span class="badge bg-secondary">${sesiUjianItem.batch_name || 'N/A'}</span></td>
               <td>${formatDate(sesiUjianItem.tanggal_mulai)}</td>
               <td>${formatTime(sesiUjianItem.jam_mulai)}</td>
               <td>${formatDate(sesiUjianItem.tanggal_selesai)}</td>
               <td>${formatTime(sesiUjianItem.jam_selesai)}</td>
               <td>
                  <span class="badge bg-info">${sesiUjianItem.durasi_menit ? sesiUjianItem.durasi_menit + ' menit' : '-'}</span>
               </td>
               <td>
                  <span class="badge ${sesiUjianItem.status === 'aktif' ? 'bg-success' : 'bg-warning'}">${sesiUjianItem.status || 'N/A'}</span>
               </td>
               <td>
                  <div class="action-buttons">
                     <a href="/admin/sesi-ujian/${sesiUjianItem.id}/edit" class="btn btn-warning btn-sm" title="Edit">
                        <i class="bi bi-pencil"></i>
                     </a>
                     <button class="btn btn-danger btn-sm" onclick="deleteSesiUjian(${sesiUjianItem.id})" title="Hapus">
                        <i class="bi bi-trash"></i>
                     </button>
                  </div>
               </td>
            `;
            tbody.appendChild(row);
         });

         // Add click event listeners for preview functionality
         addPreviewEventListeners();
      }

      // Add preview event listeners
      function addPreviewEventListeners() {
         const clickableSubjects = document.querySelectorAll('.clickable-subject');
         clickableSubjects.forEach(element => {
            element.addEventListener('click', function(e) {
               e.preventDefault();
               const cell = this.closest('.nama-ujian-cell');
               const namaUjian = cell.getAttribute('data-full-text');
               const mataPelajaranString = cell.getAttribute('data-mata-pelajaran');

               if (this.textContent.includes('lainnya')) {
                  // Show all subjects
                  const subjects = mataPelajaranString.split(',').map(s => s.trim().toLowerCase());
                  const allSubjectsHtml = subjects.map(subject =>
                     `<span class="badge bg-primary me-1 mb-1">${subject}</span>`
                  ).join('');

                  cell.innerHTML = `
                     <div class="nama-ujian-title">${namaUjian}</div>
                     <div class="mata-pelajaran-badges">
                        ${allSubjectsHtml}
                        <span class="badge bg-secondary me-1 mb-1 clickable-subject" 
                              style="cursor: pointer;" 
                              title="Klik untuk menutup">
                           <i class="bi bi-chevron-up"></i> Tutup
                        </span>
                     </div>
                  `;

                  // Re-add event listeners
                  addPreviewEventListeners();
               } else {
                  // Show truncated view
                  const subjects = mataPelajaranString.split(',').map(s => s.trim().toLowerCase());
                  const maxDisplay = 2;
                  const displaySubjects = subjects.slice(0, maxDisplay);
                  const remainingCount = subjects.length - maxDisplay;

                  cell.innerHTML = `
                     <div class="nama-ujian-title">${namaUjian}</div>
                     <div class="mata-pelajaran-badges">
                        ${displaySubjects.map(subject => 
                           `<span class="badge bg-primary me-1 mb-1">${subject}</span>`
                        ).join('')}
                        <span class="badge bg-secondary me-1 mb-1 clickable-subject" 
                              style="cursor: pointer;" 
                              title="Klik untuk melihat semua mata pelajaran">
                           +${remainingCount} lainnya
                        </span>
                     </div>
                  `;

                  // Re-add event listeners
                  addPreviewEventListeners();
               }
            });
         });
      }

      // Format date for display
      function formatDate(dateString) {
         if (!dateString) return '-';

         try {
            // Handle different date formats
            let cleanDateString = dateString.toString().trim();

            // If it's in YYYY-MM-DD format
            if (cleanDateString.match(/^\d{4}-\d{2}-\d{2}$/)) {
               const date = new Date(cleanDateString);
               if (!isNaN(date.getTime())) {
                  return date.toLocaleDateString('id-ID', {
                     day: '2-digit',
                     month: '2-digit',
                     year: 'numeric'
                  });
               }
            }

            // If it's a full datetime string, extract just the date part
            if (cleanDateString.includes('T')) {
               const datePart = cleanDateString.split('T')[0];
               const date = new Date(datePart);
               if (!isNaN(date.getTime())) {
                  return date.toLocaleDateString('id-ID', {
                     day: '2-digit',
                     month: '2-digit',
                     year: 'numeric'
                  });
               }
            }

            // Try to parse as is
            const date = new Date(cleanDateString);
            if (!isNaN(date.getTime())) {
               return date.toLocaleDateString('id-ID', {
                  day: '2-digit',
                  month: '2-digit',
                  year: 'numeric'
               });
            }

            return cleanDateString; // Return as is if can't parse
         } catch (error) {
            console.error('Error formatting date:', error, 'Input:', dateString);
            return dateString || '-';
         }
      }

      // Format time for display
      function formatTime(timeString) {
         if (!timeString) return '-';

         try {
            let cleanTimeString = timeString.toString().trim();

            // If it's in HH:MM:SS format
            if (cleanTimeString.match(/^\d{2}:\d{2}:\d{2}$/)) {
               return cleanTimeString.substring(0, 5); // Return HH:MM
            }

            // If it's a full datetime string, extract just the time part
            if (cleanTimeString.includes('T')) {
               const timePart = cleanTimeString.split('T')[1];
               if (timePart) {
                  const timeOnly = timePart.split('.')[0]; // Remove milliseconds
                  if (timeOnly.match(/^\d{2}:\d{2}:\d{2}$/)) {
                     return timeOnly.substring(0, 5); // Return HH:MM
                  }
               }
            }

            return cleanTimeString; // Return as is if can't parse
         } catch (error) {
            console.error('Error formatting time:', error, 'Input:', timeString);
            return timeString || '-';
         }
      }

      // Format datetime for display
      function formatDateTime(dateTimeString) {
         if (!dateTimeString) return '-';

         try {
            // Clean the date string first
            let cleanDateString = dateTimeString.toString().trim();

            // If it's already in YYYY-MM-DD HH:MM:SS format
            if (cleanDateString.includes(' ') && !cleanDateString.includes('T')) {
               // Already in correct format
               const date = new Date(cleanDateString);
               if (!isNaN(date.getTime())) {
                  const formattedDate = date.toLocaleDateString('id-ID', {
                     day: '2-digit',
                     month: '2-digit',
                     year: 'numeric'
                  });
                  const formattedTime = date.toLocaleTimeString('id-ID', {
                     hour: '2-digit',
                     minute: '2-digit',
                     hour12: false
                  });
                  return `${formattedDate} ${formattedTime}`;
               }
            }
            // If it's in YYYY-MM-DDTHH:MM:SS format
            else if (cleanDateString.includes('T')) {
               const date = new Date(cleanDateString);
               if (!isNaN(date.getTime())) {
                  const formattedDate = date.toLocaleDateString('id-ID', {
                     day: '2-digit',
                     month: '2-digit',
                     year: 'numeric'
                  });
                  const formattedTime = date.toLocaleTimeString('id-ID', {
                     hour: '2-digit',
                     minute: '2-digit',
                     hour12: false
                  });
                  return `${formattedDate} ${formattedTime}`;
               }
            }
            // If it's just date (YYYY-MM-DD)
            else if (cleanDateString.match(/^\d{4}-\d{2}-\d{2}$/)) {
               const date = new Date(cleanDateString);
               if (!isNaN(date.getTime())) {
                  return date.toLocaleDateString('id-ID', {
                     day: '2-digit',
                     month: '2-digit',
                     year: 'numeric'
                  });
               }
            }
            // If it's just time (HH:MM:SS)
            else if (cleanDateString.match(/^\d{2}:\d{2}:\d{2}$/)) {
               return cleanDateString.substring(0, 5); // Return HH:MM
            }

            // If all else fails, try to parse as is
            const date = new Date(cleanDateString);
            if (!isNaN(date.getTime())) {
               const formattedDate = date.toLocaleDateString('id-ID', {
                  day: '2-digit',
                  month: '2-digit',
                  year: 'numeric'
               });
               const formattedTime = date.toLocaleTimeString('id-ID', {
                  hour: '2-digit',
                  minute: '2-digit',
                  hour12: false
               });
               return `${formattedDate} ${formattedTime}`;
            }

            console.warn('Invalid date string:', dateTimeString);
            return 'Format tanggal tidak valid';
         } catch (error) {
            console.error('Error formatting datetime:', error, 'Input:', dateTimeString);
            return 'Format tanggal tidak valid';
         }
      }

      // Delete sesi ujian
      async function deleteSesiUjian(id) {
         const confirmed = await Swal.fire({
            title: 'Hapus Sesi Ujian?',
            text: 'Data yang dihapus tidak dapat dikembalikan.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            reverseButtons: true
         }).then(r => r.isConfirmed);
         if (!confirmed) return;
         try {
            const response = await fetch(`/admin/sesi-ujian/${id}`, {
               method: 'DELETE',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
               }
            });
            const result = await response.json();
            if (result.success) {
               await Swal.fire({
                  title: 'Berhasil',
                  text: 'Sesi ujian telah dihapus.',
                  icon: 'success',
                  confirmButtonText: 'OK',
                  confirmButtonColor: '#0d6efd'
               });
               loadSesiUjian();
               loadStats();
            } else {
               Swal.fire({
                  title: 'Gagal menghapus',
                  text: result.message || 'Terjadi kesalahan.',
                  icon: 'error',
                  confirmButtonText: 'Tutup'
               });
            }
         } catch (_) {
            Swal.fire({
               title: 'Gagal menghapus',
               text: 'Terjadi kesalahan jaringan.',
               icon: 'error',
               confirmButtonText: 'Tutup'
            });
         }
      }

      // Initialize on page load
      document.addEventListener('DOMContentLoaded', function() {
         console.log('DOM Content Loaded');
         loadStats();
         loadSesiUjian();
      });
   </script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

   @include('layouts.logout-script')

</body>

</html>