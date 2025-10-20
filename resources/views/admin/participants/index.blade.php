<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Manajemen Peserta - Ujian Online</title>
   <meta name="csrf-token" content="{{ csrf_token() }}">

   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   <!-- Bootstrap Icons -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
   <!-- Bootstrap JS -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

   <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
   @include('layouts.alert-system')

   <style>
      .page-header {
         background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
         color: white;
         border-radius: 10px;
         padding: 1.5rem;
         margin-bottom: 2rem;
      }

      .stats-card {
         background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
         color: white;
         border-radius: 10px;
         padding: 1.5rem;
         box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
         margin-bottom: 1.5rem;
         border: none;
      }

      .stats-card .text-muted {
         color: rgba(255, 255, 255, 0.8) !important;
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

      .card-header h6 {
         font-size: 1.1rem;
         font-weight: 600;
         color: #495057;
         margin: 0;
      }

      .btn-sm {
         padding: 0.375rem 0.75rem;
         font-size: 0.875rem;
         border-radius: 0.375rem;
      }

      .badge {
         font-size: 0.75rem;
         padding: 0.375rem 0.75rem;
         border-radius: 0.375rem;
      }

      /* Filter styling */
      .form-select-sm,
      .form-control-sm {
         font-size: 0.875rem;
      }

      .form-label.small {
         font-size: 0.8rem;
         font-weight: 600;
         color: #495057;
         margin-bottom: 0.25rem;
      }

      .input-group-sm .input-group-text {
         font-size: 0.875rem;
         background-color: #e9ecef;
         border-color: #ced4da;
      }

      .btn-outline-secondary.btn-sm {
         font-size: 0.8rem;
         padding: 0.375rem 0.75rem;
      }

      /* Badge styling */
      .badge {
         font-size: 0.75rem;
         padding: 0.35em 0.65em;
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
            <!-- Page Header -->
            <div class="page-header">
               <h2><i class="bi bi-people me-2"></i> Manajemen Peserta</h2>
               <p class="mb-0">Kelola data peserta ujian online</p>
            </div>

            <!-- Statistics Cards -->
            <div class="row mb-4" id="statsCards">
               <!-- Stats will be loaded here -->
            </div>

            <!-- Participants Table -->
            <div class="card">
               <div class="card-header">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                     <h6 class="m-0 font-weight-bold">Daftar Peserta</h6>
                     <div class="d-flex gap-2">
                        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#importModal">
                           <i class="bi bi-upload me-1"></i>
                           Import Excel
                        </button>
                        <a href="{{ route('admin.participants.create') }}" class="btn btn-primary btn-sm">
                           <i class="bi bi-person-plus me-1"></i>
                           Tambah Peserta
                        </a>
                     </div>
                  </div>

                  <!-- Filter dan Search -->
                  <div class="row g-3">
                     <div class="col-md-4">
                        <label for="batchFilter" class="form-label small fw-semibold">Filter Batch:</label>
                        <select class="form-select form-select-sm" id="batchFilter">
                           <option value="">Semua Batch</option>
                           <option value="Batch 1">Batch 1</option>
                           <option value="Batch 2">Batch 2</option>
                           <option value="Batch 3">Batch 3</option>
                           <option value="Batch 4">Batch 4</option>
                           <option value="Batch 5">Batch 5</option>
                           <option value="Batch 6">Batch 6</option>
                           <option value="Batch 7">Batch 7</option>
                           <option value="Batch 8">Batch 8</option>
                           <option value="Batch 9">Batch 9</option>
                           <option value="Batch 10">Batch 10</option>
                           <option value="Batch 11">Batch 11</option>
                           <option value="Batch 12">Batch 12</option>
                           <option value="Batch 13">Batch 13</option>
                           <option value="Batch 14">Batch 14</option>
                           <option value="Batch 15">Batch 15</option>
                           <option value="Batch 16">Batch 16</option>
                           <option value="Batch 17">Batch 17</option>
                           <option value="Batch 18">Batch 18</option>
                           <option value="Batch 19">Batch 19</option>
                           <option value="Batch 20">Batch 20</option>
                        </select>
                     </div>
                     <div class="col-md-6">
                        <label for="globalSearch" class="form-label small fw-semibold">Cari Peserta:</label>
                        <div class="input-group input-group-sm">
                           <span class="input-group-text"><i class="bi bi-search"></i></span>
                           <input type="text" class="form-control" id="globalSearch" placeholder="Cari berdasarkan nama atau kode peserta...">
                        </div>
                     </div>
                     <div class="col-md-2">
                        <label class="form-label small fw-semibold">&nbsp;</label>
                        <div class="d-grid">
                           <button class="btn btn-outline-secondary btn-sm" id="clearFilters">
                              <i class="bi bi-x-circle me-1"></i>
                              Reset
                           </button>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="card-body">
                  <!-- Filtered count display -->
                  <div class="d-flex justify-content-between align-items-center mb-3">
                     <span id="filteredCount" class="text-muted small">Memuat data...</span>
                     <div class="d-flex gap-2">
                        <span class="badge bg-light text-dark" id="totalCount">Total: 0</span>
                        <span class="badge bg-primary" id="filteredCountBadge">Ditampilkan: 0</span>
                     </div>
                  </div>

                  <div class="table-responsive">
                     <table class="table table-striped" id="participantsTable">
                        <thead>
                           <tr>
                              <th>No</th>
                              <th>Nama</th>
                              <th>Email</th>
                              <th>Kode Peserta</th>
                              <th>Kode Akses</th>
                              <th>Asal SMK</th>
                              <th>Jurusan</th>
                              <th>Batch</th>
                              <th>Aksi</th>
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

   <!-- Import Modal -->
   <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="importModalLabel">Import Data Peserta</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <!-- Template Download Section -->
               <div class="alert alert-info">
                  <h6><i class="bi bi-info-circle me-2"></i>Panduan Import</h6>
                  <p class="mb-2">Download template Excel terlebih dahulu, isi data peserta sesuai format, kemudian upload file tersebut.</p>
                  <a href="/admin/participants/template" class="btn btn-outline-primary btn-sm">
                     <i class="bi bi-download me-1"></i>Download Template Excel
                  </a>
               </div>

               <!-- Format Example -->
               <div class="mb-3">
                  <h6>Format Data yang Diperlukan:</h6>
                  <div class="table-responsive">
                     <table class="table table-sm table-bordered">
                        <thead class="table-light">
                           <tr>
                              <th>Nama</th>
                              <th>Email</th>
                              <th>NIM</th>
                              <th>Kode Akses</th>
                              <th>Asal SMK</th>
                              <th>Jurusan</th>
                              <th>Batch</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td>John Doe</td>
                              <td>john@example.com</td>
                              <td>123456789</td>
                              <td>ABC123</td>
                              <td>SMK Negeri 1 Jakarta</td>
                              <td>Teknik Komputer</td>
                              <td>2024</td>
                           </tr>
                           <tr>
                              <td>Jane Smith</td>
                              <td>jane@example.com</td>
                              <td>987654321</td>
                              <td>XYZ789</td>
                              <td>SMK Negeri 2 Bandung</td>
                              <td>Rekayasa Perangkat Lunak</td>
                              <td>2024</td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>

               <!-- Upload Form -->
               <form id="importForm" enctype="multipart/form-data">
                  @csrf
                  <div class="mb-3">
                     <label for="importFile" class="form-label">Pilih File Excel (.xlsx, .xls, .csv)</label>
                     <input type="file" class="form-control" id="importFile" name="file" accept=".xlsx,.xls,.csv" required>
                     <div class="form-text">File harus berformat Excel (.xlsx, .xls) atau CSV (.csv)</div>
                  </div>

                  <div class="mb-3">
                     <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="skipErrors" name="skip_errors">
                        <label class="form-check-label" for="skipErrors">
                           Skip baris dengan error dan lanjutkan import
                        </label>
                     </div>
                  </div>
               </form>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
               <button type="button" class="btn btn-success" onclick="importParticipants()">
                  <i class="bi bi-upload me-1"></i>Import Data
               </button>
            </div>
         </div>
      </div>
   </div>

   <script>
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      console.log('CSRF Token loaded:', csrfToken);

      // Load statistics
      async function loadStats() {
         try {
            const response = await fetch('/admin/participants/stats', {
               method: 'GET',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
               }
            });

            if (response.ok) {
               const result = await response.json();
               if (result.success) {
                  displayStats(result.data);
               }
            }
         } catch (error) {
            console.error('Error loading stats:', error);
         }
      }

      // Display statistics
      function displayStats(stats) {
         const statsHtml = `
            <div class="col-md-3">
               <div class="stats-card">
                  <div class="d-flex align-items-center">
                     <div class="flex-shrink-0">
                        <i class="bi bi-people-fill text-white" style="font-size: 2rem;"></i>
                     </div>
                     <div class="flex-grow-1 ms-3">
                        <h5 class="mb-0">${stats.total}</h5>
                        <p class="text-muted mb-0">Total Peserta</p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-3">
               <div class="stats-card">
                  <div class="d-flex align-items-center">
                     <div class="flex-shrink-0">
                        <i class="bi bi-building-fill text-white" style="font-size: 2rem;"></i>
                     </div>
                     <div class="flex-grow-1 ms-3">
                        <h5 class="mb-0">${stats.schools || 0}</h5>
                        <p class="text-muted mb-0">Jumlah Sekolah</p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-3">
               <div class="stats-card">
                  <div class="d-flex align-items-center">
                     <div class="flex-shrink-0">
                        <i class="bi bi-book text-white" style="font-size: 2rem;"></i>
                     </div>
                     <div class="flex-grow-1 ms-3">
                        <h5 class="mb-0">${stats.majors || 0}</h5>
                        <p class="text-muted mb-0">Jumlah Jurusan</p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-3">
               <div class="stats-card">
                  <div class="d-flex align-items-center">
                     <div class="flex-shrink-0">
                        <i class="bi bi-collection text-white" style="font-size: 2rem;"></i>
                     </div>
                     <div class="flex-grow-1 ms-3">
                        <h5 class="mb-0">${stats.batches || 0}</h5>
                        <p class="text-muted mb-0">Jumlah Batch</p>
                     </div>
                  </div>
               </div>
            </div>
         `;

         document.getElementById('statsCards').innerHTML = statsHtml;
      }

      // Load participants data
      async function loadParticipants() {
         try {
            console.log('Loading participants...');
            const response = await fetch('/admin/participants/data', {
               method: 'GET',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
               },
               credentials: 'same-origin'
            });

            console.log('Response status:', response.status);
            if (response.ok) {
               const result = await response.json();
               console.log('API result:', result);
               if (result.success) {
                  // Store all participants for filtering
                  allParticipants = result.data;
                  filteredParticipants = [...allParticipants];
                  console.log('Participants loaded:', allParticipants.length);

                  displayParticipants(filteredParticipants);
               } else {
                  console.error('API returned success: false', result);
                  // Fallback data jika API gagal
                  allParticipants = [];
                  filteredParticipants = [];
                  displayParticipants([]);
               }
            } else {
               // Fallback data jika response tidak ok
               allParticipants = [];
               filteredParticipants = [];
               displayParticipants([]);
            }
         } catch (error) {
            console.error('Error loading participants:', error);
            // Fallback data jika terjadi error
            displayParticipants([]);
         }
      }

      // Display participants
      function displayParticipants(participants) {
         console.log('Displaying participants:', participants.length);
         const tbody = document.querySelector('#participantsTable tbody');
         tbody.innerHTML = '';

         // Hitung statistik berdasarkan data participants
         const uniqueSchools = new Set(participants.map(p => p.asal_smk).filter(school => school));
         const uniqueMajors = new Set(participants.map(p => p.jurusan).filter(major => major));
         const uniqueBatches = new Set(participants.map(p => p.batch).filter(batch => batch));

         const stats = {
            total: participants.length,
            schools: uniqueSchools.size,
            majors: uniqueMajors.size,
            batches: uniqueBatches.size
         };

         // Update statistik
         displayStats(stats);

         // Show filtered count
         updateFilteredCount(participants.length);

         participants.forEach((participant, index) => {
            console.log('Creating row for participant:', participant.nama);
            const row = document.createElement('tr');
            row.innerHTML = `
               <td>${index + 1}</td>
               <td>${participant.nama || '-'}</td>
               <td>${participant.email || '-'}</td>
               <td><span class="badge bg-info">${participant.kode_peserta || '-'}</span></td>
               <td><span class="badge bg-success">${participant.kode_akses || '-'}</span></td>
               <td>${participant.asal_smk || '-'}</td>
               <td>${participant.jurusan || '-'}</td>
               <td><span class="badge bg-secondary">${participant.batch || '-'}</span></td>
               <td>
                  <div class="action-buttons">
                     <a href="/admin/participants/${participant.id}/edit" class="btn btn-warning btn-sm" title="Edit">
                        <i class="bi bi-pencil"></i>
                     </a>
                     <button class="btn btn-danger btn-sm" onclick="deleteParticipant(${participant.id})" title="Hapus">
                        <i class="bi bi-trash"></i>
                     </button>
                  </div>
               </td>
            `;
            tbody.appendChild(row);
         });
      }

      // Delete participant
      async function deleteParticipant(id) {
         if (confirm('Apakah Anda yakin ingin menghapus peserta ini?')) {
            try {
               const response = await fetch(`/admin/participants/${id}`, {
                  method: 'DELETE',
                  headers: {
                     'Content-Type': 'application/json',
                     'X-CSRF-TOKEN': csrfToken
                  }
               });

               const result = await response.json();

               if (result.success) {
                  alertSystem.deleteSuccess('Peserta');
                  loadParticipants(); // loadParticipants sudah menghitung ulang statistik
               } else {
                  alertSystem.error('Gagal menghapus peserta', result.message);
               }
            } catch (error) {
               console.error('Error deleting participant:', error);
               alertSystem.error('Gagal menghapus peserta', 'Terjadi kesalahan jaringan');
            }
         }
      }

      // Import participants function
      async function importParticipants() {
         try {
            console.log('Starting import process...');

            const fileInput = document.getElementById('importFile');
            const skipErrors = document.getElementById('skipErrors').checked;

            if (!fileInput.files[0]) {
               alertSystem.error('Pilih file terlebih dahulu');
               return;
            }

            console.log('File selected:', fileInput.files[0].name);
            console.log('File details:', {
               name: fileInput.files[0].name,
               size: fileInput.files[0].size,
               type: fileInput.files[0].type,
               lastModified: fileInput.files[0].lastModified
            });

            const formData = new FormData();
            formData.append('file', fileInput.files[0]);
            formData.append('skip_errors', skipErrors ? '1' : '0');
            formData.append('_token', csrfToken);

            console.log('Form data prepared');
            console.log('CSRF Token being sent:', csrfToken);

            // Show loading
            const importBtn = document.querySelector('[onclick="importParticipants()"]');
            const originalText = importBtn.innerHTML;
            importBtn.innerHTML = '<i class="bi bi-hourglass-split me-1"></i>Importing...';
            importBtn.disabled = true;

            console.log('Sending request to /admin/participants/import');

            const response = await fetch('/admin/participants/import', {
               method: 'POST',
               body: formData
            });

            console.log('Response received:', response.status);

            if (!response.ok) {
               // Get response body for error details
               const errorText = await response.text();
               console.error('Error response body:', errorText);

               let errorMessage = `HTTP error! status: ${response.status}`;
               try {
                  const errorData = JSON.parse(errorText);
                  if (errorData.message) {
                     errorMessage = errorData.message;
                  }
                  if (errorData.debug) {
                     console.error('Error debug info:', errorData.debug);
                  }
               } catch (e) {
                  console.error('Could not parse error response:', e);
               }

               throw new Error(errorMessage);
            }

            const responseText = await response.text();
            console.log('Response text length:', responseText.length);
            console.log('Response text preview:', responseText.substring(0, 200));

            let result;
            try {
               result = JSON.parse(responseText);
               console.log('JSON parsed successfully:', result);
            } catch (parseError) {
               console.error('JSON parse error:', parseError);
               console.error('Full response text:', responseText);
               throw new Error('Invalid JSON response from server');
            }

            if (result.success) {
               alertSystem.success(`Import berhasil! ${result.imported} data berhasil diimport.`);
               if (result.errors && result.errors.length > 0) {
                  console.warn('Import warnings:', result.errors);
                  alertSystem.warning(`${result.errors.length} baris memiliki error dan dilewati.`);
               }

               // Close modal and reload data
               const modal = bootstrap.Modal.getInstance(document.getElementById('importModal'));
               if (modal) {
                  modal.hide();
               }
               loadParticipants();
            } else {
               console.error('Import failed:', result);
               alertSystem.error('Import gagal', result.message);
               if (result.errors) {
                  console.error('Import errors:', result.errors);
               }
            }
         } catch (error) {
            console.error('Error in importParticipants:', error);
            console.error('Error stack:', error.stack);

            // Show more specific error message
            let errorMessage = 'Terjadi kesalahan jaringan';
            if (error.message.includes('HTTP error')) {
               errorMessage = 'Server error: ' + error.message;
            } else if (error.message.includes('JSON')) {
               errorMessage = 'Format response tidak valid dari server';
            } else if (error.message) {
               errorMessage = error.message;
            }

            alertSystem.error('Import gagal', errorMessage);
         } finally {
            // Reset button
            const importBtn = document.querySelector('[onclick="importParticipants()"]');
            if (importBtn) {
               importBtn.innerHTML = '<i class="bi bi-upload me-1"></i>Import Data';
               importBtn.disabled = false;
            }
         }
      }

      // Global variables for filtering
      let allParticipants = [];
      let filteredParticipants = [];

      // Filter and search functions
      function filterParticipants() {
         const batchFilter = document.getElementById('batchFilter').value;
         const searchTerm = document.getElementById('globalSearch').value.toLowerCase();

         filteredParticipants = allParticipants.filter(participant => {
            // Filter by batch
            const batchMatch = !batchFilter || participant.batch === batchFilter;

            // Filter by search term (nama or kode_peserta)
            const searchMatch = !searchTerm ||
               participant.nama.toLowerCase().includes(searchTerm) ||
               participant.kode_peserta.toLowerCase().includes(searchTerm);

            return batchMatch && searchMatch;
         });

         displayParticipants(filteredParticipants);
      }

      // Clear all filters
      function clearFilters() {
         document.getElementById('batchFilter').value = '';
         document.getElementById('globalSearch').value = '';
         filteredParticipants = [...allParticipants];
         displayParticipants(filteredParticipants);
      }

      // Update filtered count display
      function updateFilteredCount(count) {
         const totalCount = allParticipants.length;
         const countElement = document.getElementById('filteredCount');
         const totalCountBadge = document.getElementById('totalCount');
         const filteredCountBadge = document.getElementById('filteredCountBadge');

         if (countElement) {
            if (count === totalCount) {
               countElement.textContent = `Menampilkan ${count} dari ${totalCount} peserta`;
               countElement.className = 'text-muted small';
            } else {
               countElement.textContent = `Menampilkan ${count} dari ${totalCount} peserta (difilter)`;
               countElement.className = 'text-primary small fw-semibold';
            }
         }

         // Update badges
         if (totalCountBadge) {
            totalCountBadge.textContent = `Total: ${totalCount}`;
         }
         if (filteredCountBadge) {
            filteredCountBadge.textContent = `Ditampilkan: ${count}`;
            if (count < totalCount) {
               filteredCountBadge.className = 'badge bg-warning';
            } else {
               filteredCountBadge.className = 'badge bg-primary';
            }
         }
      }

      // Event listeners for filters
      document.getElementById('batchFilter').addEventListener('change', filterParticipants);
      document.getElementById('globalSearch').addEventListener('input', filterParticipants);
      document.getElementById('clearFilters').addEventListener('click', clearFilters);

      // Initialize on page load
      document.addEventListener('DOMContentLoaded', function() {
         console.log('DOM Content Loaded');
         loadParticipants(); // loadParticipants sudah menghitung statistik dari data tabel
      });
   </script>

</body>

</html>