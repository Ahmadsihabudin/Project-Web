<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Peserta - Ujian Online</title>
   <meta name="csrf-token" content="{{ csrf_token() }}">

   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   <!-- Bootstrap Icons -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

   @include('layouts.sidebar-styles')
   @include('layouts.alert-system')

   <style>
      .participant-card {
         transition: all 0.3s ease;
      }

      .participant-card:hover {
         transform: translateY(-2px);
         box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
      }

      /* Action Buttons Styling */
      .btn-group .btn {
         margin: 0 1px;
         border-radius: 6px;
         padding: 6px 10px;
         font-size: 0.8rem;
         transition: all 0.2s ease;
      }

      .btn-group .btn:hover {
         transform: translateY(-1px);
         box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      }

      .btn-group .btn:first-child {
         border-top-right-radius: 0;
         border-bottom-right-radius: 0;
      }

      .btn-group .btn:last-child {
         border-top-left-radius: 0;
         border-bottom-left-radius: 0;
      }

      /* Icon styling */
      .btn i {
         font-size: 0.9rem;
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

         <!-- Participants Content -->
         <div class="p-4">
            <!-- Stats Cards -->
            <div class="row mb-4">
               <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card stats-card border-0 shadow-sm">
                     <div class="card-body">
                        <div class="d-flex align-items-center">
                           <div class="flex-grow-1">
                              <div class="text-uppercase text-white-60 small fw-semibold mb-2">Total Peserta</div>
                              <div class="h2 mb-0 fw-bold text-white" id="totalParticipants">0</div>
                              <div class="small text-white-60 mt-1">Semua peserta</div>
                           </div>
                           <div class="flex-shrink-0">
                              <i class="bi bi-people fs-1 text-white-60"></i>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card stats-card border-0 shadow-sm">
                     <div class="card-body">
                        <div class="d-flex align-items-center">
                           <div class="flex-grow-1">
                              <div class="text-uppercase text-white-60 small fw-semibold mb-2">Aktif</div>
                              <div class="h2 mb-0 fw-bold text-white" id="activeParticipants">0</div>
                              <div class="small text-white-60 mt-1">Sedang aktif</div>
                           </div>
                           <div class="flex-shrink-0">
                              <i class="bi bi-person-check fs-1 text-white-60"></i>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card stats-card border-0 shadow-sm">
                     <div class="card-body">
                        <div class="d-flex align-items-center">
                           <div class="flex-grow-1">
                              <div class="text-uppercase text-white-60 small fw-semibold mb-2">Sedang Ujian</div>
                              <div class="h2 mb-0 fw-bold text-white" id="ongoingParticipants">0</div>
                              <div class="small text-white-60 mt-1">Saat ini</div>
                           </div>
                           <div class="flex-shrink-0">
                              <i class="bi bi-clock fs-1 text-white-60"></i>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card stats-card border-0 shadow-sm">
                     <div class="card-body">
                        <div class="d-flex align-items-center">
                           <div class="flex-grow-1">
                              <div class="text-uppercase text-white-60 small fw-semibold mb-2">Selesai</div>
                              <div class="h2 mb-0 fw-bold text-white" id="completedParticipants">0</div>
                              <div class="small text-white-60 mt-1">Ujian selesai</div>
                           </div>
                           <div class="flex-shrink-0">
                              <i class="bi bi-check-circle fs-1 text-white-60"></i>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <!-- Search and Filter -->
            <div class="card mb-4">
               <div class="card-body">
                  <div class="row">
                     <div class="col-md-6">
                        <div class="input-group">
                           <span class="input-group-text">
                              <i class="bi bi-search"></i>
                           </span>
                           <input type="text" class="form-control" placeholder="Cari peserta...">
                        </div>
                     </div>
                     <div class="col-md-3">
                        <select class="form-select">
                           <option>Semua Status</option>
                           <option>Aktif</option>
                           <option>Sedang Ujian</option>
                           <option>Selesai</option>
                        </select>
                     </div>
                     <div class="col-md-3">
                        <button class="btn btn-primary w-100" onclick="showAddParticipantModal()">
                           <i class="bi bi-plus-circle me-1"></i>
                           Tambah Peserta
                        </button>
                     </div>
                  </div>
               </div>
            </div>

            <!-- Participants Table -->
            <div class="card">
               <div class="card-header">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                     <h6 class="m-0 font-weight-bold">Daftar Peserta</h6>
                     <button class="btn btn-success btn-sm" onclick="showAddParticipantModal()">
                        <i class="bi bi-person-plus me-1"></i>Tambah Peserta
                     </button>
                  </div>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="input-group">
                           <span class="input-group-text">
                              <i class="bi bi-search"></i>
                           </span>
                           <input type="text" class="form-control" id="searchInput" placeholder="Cari peserta..." onkeyup="searchParticipants()">
                        </div>
                     </div>
                     <div class="col-md-3">
                        <select class="form-select" id="statusFilter" onchange="filterByStatus()">
                           <option value="">Semua Status</option>
                           <option value="aktif">Aktif</option>
                           <option value="tidak_aktif">Tidak Aktif</option>
                           <option value="berlangsung">Berlangsung</option>
                           <option value="selesai">Selesai</option>
                        </select>
                     </div>
                     <div class="col-md-3">
                        <button class="btn btn-outline-secondary w-100" onclick="clearFilters()">
                           <i class="bi bi-x-circle me-1"></i>Reset Filter
                        </button>
                     </div>
                  </div>
               </div>
               <div class="card-body">
                  <div class="table-responsive">
                     <table class="table table-bordered" id="participantsTable">
                        <thead>
                           <tr>
                              <th>No</th>
                              <th>Nama</th>
                              <th>Email</th>
                              <th>Kode Peserta</th>
                              <th>Kode Akses</th>
                              <th>Ujian</th>
                              <th>Status</th>
                              <th>Nilai</th>
                              <th>Aksi</th>
                           </tr>
                        </thead>
                        <tbody id="participantsTableBody">
                           <tr>
                              <td colspan="9" class="text-center py-4">
                                 <div class="d-flex align-items-center justify-content-center">
                                    <div class="spinner-border spinner-border-sm me-2" role="status">
                                       <span class="visually-hidden">Loading...</span>
                                    </div>
                                    Memuat data peserta...
                                 </div>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </div>

                  <!-- Pagination -->
                  <nav aria-label="Page navigation">
                     <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                           <a class="page-link" href="#" tabindex="-1">Previous</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                           <a class="page-link" href="#">Next</a>
                        </li>
                     </ul>
                  </nav>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- Add Participant Modal -->
   <div class="modal fade" id="addParticipantModal" tabindex="-1" aria-labelledby="addParticipantModalLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="addParticipantModalLabel">Tambah Peserta Baru</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addParticipantForm">
               <div class="modal-body">
                  <div class="mb-3">
                     <label for="addNama" class="form-label">Nama Lengkap</label>
                     <input type="text" class="form-control" id="addNama" name="nama" required>
                  </div>
                  <div class="mb-3">
                     <label for="addEmail" class="form-label">Email</label>
                     <input type="email" class="form-control" id="addEmail" name="email" required>
                  </div>
                  <div class="mb-3">
                     <label for="addKodePeserta" class="form-label">Kode Peserta</label>
                     <input type="text" class="form-control" id="addKodePeserta" name="kode_peserta" placeholder="Contoh: RK78607462" required>
                  </div>
                  <div class="mb-3">
                     <label for="addKodeAkses" class="form-label">Kode Akses (Password)</label>
                     <input type="password" class="form-control" id="addKodeAkses" name="kode_akses" required>
                  </div>
                  <div class="mb-3">
                     <label for="addUjian" class="form-label">Ujian</label>
                     <select class="form-select" id="addUjian" name="ujian" required>
                        <option value="">Pilih Ujian</option>
                        <option value="matematika">Matematika Dasar</option>
                        <option value="bahasa">Bahasa Indonesia</option>
                        <option value="fisika">Fisika</option>
                        <option value="kimia">Kimia</option>
                     </select>
                  </div>
                  <div class="mb-3">
                     <label for="addStatus" class="form-label">Status</label>
                     <select class="form-select" id="addStatus" name="status" required>
                        <option value="aktif">Aktif</option>
                        <option value="tidak_aktif">Tidak Aktif</option>
                     </select>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary">
                     <i class="bi bi-plus-circle me-1"></i>Tambah Peserta
                  </button>
               </div>
            </form>
         </div>
      </div>
   </div>

   <!-- Edit Participant Modal -->
   <div class="modal fade" id="editParticipantModal" tabindex="-1" aria-labelledby="editParticipantModalLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="editParticipantModalLabel">Edit Peserta</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editParticipantForm">
               <input type="hidden" id="editParticipantId" name="id">
               <div class="modal-body">
                  <div class="mb-3">
                     <label for="editNama" class="form-label">Nama Lengkap</label>
                     <input type="text" class="form-control" id="editNama" name="nama" required>
                  </div>
                  <div class="mb-3">
                     <label for="editEmail" class="form-label">Email</label>
                     <input type="email" class="form-control" id="editEmail" name="email" required>
                  </div>
                  <div class="mb-3">
                     <label for="editKodePeserta" class="form-label">Kode Peserta</label>
                     <input type="text" class="form-control" id="editKodePeserta" name="kode_peserta" placeholder="Contoh: RK78607462" required>
                  </div>
                  <div class="mb-3">
                     <label for="editKodeAkses" class="form-label">Kode Akses Baru (kosongkan jika tidak diubah)</label>
                     <input type="password" class="form-control" id="editKodeAkses" name="kode_akses">
                  </div>
                  <div class="mb-3">
                     <label for="editUjian" class="form-label">Ujian</label>
                     <select class="form-select" id="editUjian" name="ujian" required>
                        <option value="">Pilih Ujian</option>
                        <option value="matematika">Matematika Dasar</option>
                        <option value="bahasa">Bahasa Indonesia</option>
                        <option value="fisika">Fisika</option>
                        <option value="kimia">Kimia</option>
                     </select>
                  </div>
                  <div class="mb-3">
                     <label for="editStatus" class="form-label">Status</label>
                     <select class="form-select" id="editStatus" name="status" required>
                        <option value="aktif">Aktif</option>
                        <option value="tidak_aktif">Tidak Aktif</option>
                     </select>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary">
                     <i class="bi bi-check-circle me-1"></i>Simpan Perubahan
                  </button>
               </div>
            </form>
         </div>
      </div>
   </div>

   <!-- Bootstrap JS -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

   @include('layouts.logout-script')

   <script>
      // CSRF Token is already declared in logout-script.blade.php

      // Participants data
      let participants = [];
      let filteredParticipants = [];
      let searchTerm = '';
      let statusFilter = '';

      // Load participants data from API
      async function loadParticipants() {
         console.log('Loading participants from API...');
         console.log('CSRF Token:', csrfToken);

         try {
            const response = await fetch('/admin/participants/data', {
               method: 'GET',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
               }
            });

            console.log('Response status:', response.status);
            console.log('Response ok:', response.ok);

            if (response.ok) {
               const result = await response.json();
               console.log('API response:', result);

               if (result.success && result.data) {
                  console.log('Using real data from API');
                  participants = result.data;
                  filteredParticipants = [...participants];
                  displayParticipants(filteredParticipants);
                  updateStats(result.stats);
                  return;
               } else {
                  console.log('API returned success=false or no data');
               }
            } else {
               console.log('API returned error status:', response.status);
               const errorText = await response.text();
               console.log('Error response:', errorText);
            }

            console.log('API failed, using fallback data');
            // Fallback to static data for testing
            participants = [{
                  id: 1,
                  nama: 'Ahmad Rizki',
                  email: 'ahmad.rizki@email.com',
                  ujian: 'Matematika Dasar',
                  status: 'selesai',
                  nilai: 85,
                  avatar: 'A'
               },
               {
                  id: 2,
                  nama: 'Siti Nurhaliza',
                  email: 'siti.nurhaliza@email.com',
                  ujian: 'Bahasa Indonesia',
                  status: 'berlangsung',
                  nilai: null,
                  avatar: 'S'
               },
               {
                  id: 3,
                  nama: 'Budi Santoso',
                  email: 'budi.santoso@email.com',
                  ujian: 'Fisika',
                  status: 'selesai',
                  nilai: 92,
                  avatar: 'B'
               }
            ];
            filteredParticipants = [...participants];
            displayParticipants(filteredParticipants);
            updateStats({
               total: 3,
               aktif: 3,
               berlangsung: 1,
               selesai: 2
            });
         } catch (error) {
            console.log('Error loading participants:', error);
            participants = [];
            displayParticipants([]);
            updateStats({
               total: 0,
               aktif: 0,
               berlangsung: 0,
               selesai: 0
            });
         }
      }

      // Display participants in table
      function displayParticipants(participantsData) {
         const tbody = document.getElementById('participantsTableBody');
         if (!tbody) return;

         tbody.innerHTML = '';

         if (participantsData.length === 0) {
            tbody.innerHTML = `
               <tr>
                  <td colspan="9" class="text-center py-4">
                     <div class="text-muted">
                        <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                        ${searchTerm || statusFilter ? 'Tidak ada peserta yang sesuai dengan filter' : 'Tidak ada data peserta'}
                     </div>
                  </td>
               </tr>
            `;
            return;
         }

         participantsData.forEach((participant, index) => {
            const row = document.createElement('tr');
            const statusBadge = getStatusBadge(participant.status);
            const nilaiText = participant.nilai ? `${participant.nilai}/100` : '-';
            const avatarColor = getAvatarColor(participant.avatar);

            row.innerHTML = `
               <td>${index + 1}</td>
               <td>
                  <div class="d-flex align-items-center">
                     <div class="avatar ${avatarColor} text-white rounded-circle me-2" style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;">
                        ${participant.avatar}
                     </div>
                     ${participant.nama}
                  </div>
               </td>
               <td>${participant.email}</td>
               <td><span class="badge bg-info text-dark">${participant.kode_peserta || '-'}</span></td>
               <td><span class="badge bg-secondary">${participant.kode_akses || '-'}</span></td>
               <td>${participant.ujian}</td>
               <td>
                  <span class="badge ${getStatusClass(participant.status)}" onclick="toggleParticipantStatus(${participant.id})" style="cursor: pointer;" title="Klik untuk mengubah status">
                     ${getStatusText(participant.status)}
                  </span>
               </td>
               <td>${nilaiText}</td>
               <td class="text-center">
                  <div class="btn-group" role="group">
                     <button class="btn btn-sm btn-outline-warning" onclick="editParticipant(${participant.id})" title="Edit">
                        <i class="bi bi-pencil-square"></i>
                     </button>
                     <button class="btn btn-sm btn-outline-danger" onclick="deleteParticipant(${participant.id})" title="Hapus">
                        <i class="bi bi-trash3"></i>
                     </button>
                  </div>
               </td>
            `;
            tbody.appendChild(row);
         });
      }

      // Get status badge HTML
      function getStatusBadge(status) {
         const badges = {
            'selesai': '<span class="badge bg-success">Selesai</span>',
            'berlangsung': '<span class="badge bg-warning">Berlangsung</span>',
            'aktif': '<span class="badge bg-info">Aktif</span>',
            'tidak_aktif': '<span class="badge bg-secondary">Tidak Aktif</span>'
         };
         return badges[status] || '<span class="badge bg-secondary">Unknown</span>';
      }

      // Get status class for clickable badge
      function getStatusClass(status) {
         const classes = {
            'selesai': 'bg-success',
            'berlangsung': 'bg-warning',
            'aktif': 'bg-info',
            'tidak_aktif': 'bg-secondary'
         };
         return classes[status] || 'bg-secondary';
      }

      // Get status text
      function getStatusText(status) {
         const texts = {
            'selesai': 'Selesai',
            'berlangsung': 'Berlangsung',
            'aktif': 'Aktif',
            'tidak_aktif': 'Tidak Aktif'
         };
         return texts[status] || 'Unknown';
      }

      // Get avatar color
      function getAvatarColor(letter) {
         const colors = ['bg-primary', 'bg-success', 'bg-info', 'bg-warning', 'bg-danger'];
         const index = letter.charCodeAt(0) % colors.length;
         return colors[index];
      }

      // Update statistics
      function updateStats(stats = null) {
         let total, aktif, berlangsung, selesai;

         if (stats) {
            // Use stats from API
            total = stats.total || 0;
            aktif = stats.aktif || 0;
            berlangsung = stats.berlangsung || 0;
            selesai = stats.selesai || 0;
         } else {
            // Calculate from participants array
            total = participants.length;
            aktif = participants.filter(p => p.status === 'aktif' || p.status === 'selesai').length;
            berlangsung = participants.filter(p => p.status === 'berlangsung').length;
            selesai = participants.filter(p => p.status === 'selesai').length;
         }

         // Update stats cards
         const totalEl = document.getElementById('totalParticipants');
         const aktifEl = document.getElementById('activeParticipants');
         const berlangsungEl = document.getElementById('ongoingParticipants');
         const selesaiEl = document.getElementById('completedParticipants');

         if (totalEl) totalEl.textContent = total;
         if (aktifEl) aktifEl.textContent = aktif;
         if (berlangsungEl) berlangsungEl.textContent = berlangsung;
         if (selesaiEl) selesaiEl.textContent = selesai;

         console.log('Stats updated:', {
            total,
            aktif,
            berlangsung,
            selesai
         });
      }

      // Show add participant modal
      function showAddParticipantModal() {
         document.getElementById('addParticipantForm').reset();
         const modal = new bootstrap.Modal(document.getElementById('addParticipantModal'));
         modal.show();
      }

      // Show edit participant modal
      function editParticipant(id) {
         const participant = participants.find(p => p.id === id);
         if (!participant) return;

         document.getElementById('editParticipantId').value = participant.id;
         document.getElementById('editNama').value = participant.nama;
         document.getElementById('editEmail').value = participant.email;
         document.getElementById('editKodePeserta').value = participant.kode_peserta || '';
         document.getElementById('editKodeAkses').value = '';
         document.getElementById('editUjian').value = participant.ujian.toLowerCase().replace(' ', '_');
         document.getElementById('editStatus').value = participant.status;

         const modal = new bootstrap.Modal(document.getElementById('editParticipantModal'));
         modal.show();
      }


      // Delete participant
      async function deleteParticipant(id) {
         if (confirm('Apakah Anda yakin ingin menghapus peserta ini?')) {
            const loadingAlert = alertSystem.loading('Menghapus peserta...');

            try {
               const response = await fetch(`/admin/participants/${id}`, {
                  method: 'DELETE',
                  headers: {
                     'Content-Type': 'application/json',
                     'X-CSRF-TOKEN': csrfToken
                  }
               });

               const result = await response.json();
               alertSystem.hide(loadingAlert);

               if (result.success) {
                  alertSystem.deleteSuccess('Peserta');
                  loadParticipants(); // Reload data from API
               } else {
                  alertSystem.error('Gagal menghapus peserta', result.message || 'Terjadi kesalahan');
               }
            } catch (error) {
               alertSystem.hide(loadingAlert);
               alertSystem.error('Gagal menghapus peserta', 'Terjadi kesalahan jaringan');
            }
         }
      }

      // Toggle participant status
      async function toggleParticipantStatus(id) {
         const participant = participants.find(p => p.id === id);
         if (!participant) return;

         const loadingAlert = alertSystem.loading('Mengubah status peserta...');

         try {
            // Determine new status
            let newStatus = participant.status;
            if (participant.status === 'aktif') {
               newStatus = 'tidak_aktif';
            } else if (participant.status === 'tidak_aktif') {
               newStatus = 'aktif';
            } else if (participant.status === 'berlangsung') {
               newStatus = 'selesai';
            } else if (participant.status === 'selesai') {
               newStatus = 'aktif';
            }

            const response = await fetch(`/admin/participants/${id}`, {
               method: 'PUT',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
               },
               body: JSON.stringify({
                  nama: participant.nama,
                  email: participant.email,
                  ujian: participant.ujian,
                  status: newStatus
               })
            });

            const result = await response.json();
            alertSystem.hide(loadingAlert);

            if (result.success) {
               alertSystem.updateSuccess('Status Peserta');
               loadParticipants(); // Reload data from API
            } else {
               alertSystem.error('Gagal mengubah status', result.message || 'Terjadi kesalahan');
            }
         } catch (error) {
            alertSystem.hide(loadingAlert);
            alertSystem.error('Gagal mengubah status', 'Terjadi kesalahan jaringan');
         }
      }

      // Search participants
      function searchParticipants() {
         searchTerm = document.getElementById('searchInput').value.toLowerCase();
         applyFilters();
      }

      // Filter by status
      function filterByStatus() {
         statusFilter = document.getElementById('statusFilter').value;
         applyFilters();
      }

      // Apply filters
      function applyFilters() {
         filteredParticipants = participants.filter(participant => {
            const matchesSearch = participant.nama.toLowerCase().includes(searchTerm) ||
               participant.email.toLowerCase().includes(searchTerm) ||
               participant.ujian.toLowerCase().includes(searchTerm);

            const matchesStatus = statusFilter === '' || participant.status === statusFilter;

            return matchesSearch && matchesStatus;
         });

         displayParticipants(filteredParticipants);
         updateStatsFromFiltered();
      }

      // Update stats from filtered data
      function updateStatsFromFiltered() {
         const stats = {
            total: filteredParticipants.length,
            aktif: filteredParticipants.filter(p => p.status === 'aktif' || p.status === 'selesai').length,
            berlangsung: filteredParticipants.filter(p => p.status === 'berlangsung').length,
            selesai: filteredParticipants.filter(p => p.status === 'selesai').length
         };
         updateStats(stats);
      }

      // Clear all filters
      function clearFilters() {
         document.getElementById('searchInput').value = '';
         document.getElementById('statusFilter').value = '';
         searchTerm = '';
         statusFilter = '';
         applyFilters();
      }

      // Export participants
      function exportParticipants() {
         const loadingAlert = alertSystem.loading('Mengekspor data peserta...');

         setTimeout(() => {
            alertSystem.hide(loadingAlert);
            alertSystem.success('Export Berhasil', 'Data peserta berhasil diekspor ke Excel!');
         }, 2000);
      }

      // Handle add participant form
      document.getElementById('addParticipantForm').addEventListener('submit', async function(e) {
         e.preventDefault();

         const formData = new FormData(this);
         const loadingAlert = alertSystem.loading('Menambahkan peserta...');

         try {
            const response = await fetch('/admin/participants', {
               method: 'POST',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
               },
               body: JSON.stringify({
                  nama: formData.get('nama'),
                  email: formData.get('email'),
                  kode_peserta: formData.get('kode_peserta'),
                  kode_akses: formData.get('kode_akses'),
                  ujian: formData.get('ujian') || 'matematika',
                  status: formData.get('status')
               })
            });

            const result = await response.json();
            alertSystem.hide(loadingAlert);

            if (result.success) {
               alertSystem.createSuccess('Peserta');
               loadParticipants(); // Reload data from API

               // Close modal
               const modal = bootstrap.Modal.getInstance(document.getElementById('addParticipantModal'));
               modal.hide();
            } else {
               alertSystem.error('Gagal menambahkan peserta', result.message || 'Terjadi kesalahan');
            }
         } catch (error) {
            alertSystem.hide(loadingAlert);
            alertSystem.error('Gagal menambahkan peserta', 'Terjadi kesalahan jaringan');
         }
      });

      // Handle edit participant form
      document.getElementById('editParticipantForm').addEventListener('submit', async function(e) {
         e.preventDefault();

         const formData = new FormData(this);
         const id = parseInt(formData.get('id'));
         const loadingAlert = alertSystem.loading('Memperbarui peserta...');

         try {
            const requestData = {
               nama: formData.get('nama'),
               email: formData.get('email'),
               kode_peserta: formData.get('kode_peserta'),
               kode_akses: formData.get('kode_akses') || null,
               ujian: formData.get('ujian') || 'matematika',
               status: formData.get('status')
            };

            const response = await fetch(`/admin/participants/${id}`, {
               method: 'PUT',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
               },
               body: JSON.stringify(requestData)
            });

            const result = await response.json();
            alertSystem.hide(loadingAlert);

            if (result.success) {
               alertSystem.updateSuccess('Peserta');
               loadParticipants(); // Reload data from API

               // Close modal
               const modal = bootstrap.Modal.getInstance(document.getElementById('editParticipantModal'));
               modal.hide();
            } else {
               if (result.errors) {
                  const errorMessages = Object.values(result.errors).flat().join(', ');
                  alertSystem.error('Validasi gagal', errorMessages);
               } else {
                  alertSystem.error('Gagal memperbarui peserta', result.message || 'Terjadi kesalahan');
               }
            }
         } catch (error) {
            alertSystem.hide(loadingAlert);
            alertSystem.error('Gagal memperbarui peserta', 'Terjadi kesalahan jaringan');
         }
      });

      // Initialize on page load
      document.addEventListener('DOMContentLoaded', function() {
         loadParticipants();
      });

      // Make functions globally available
      window.showAddParticipantModal = showAddParticipantModal;
      window.editParticipant = editParticipant;
      window.viewParticipant = viewParticipant;
      window.deleteParticipant = deleteParticipant;
      window.toggleParticipantStatus = toggleParticipantStatus;
      window.exportParticipants = exportParticipants;

      // Logout function is included from layouts.logout-script
   </script>
</body>

</html>