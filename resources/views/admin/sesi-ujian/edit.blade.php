<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Edit Sesi Ujian - Ujian Online</title>
   <meta name="csrf-token" content="{{ csrf_token() }}">

   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   <!-- Bootstrap Icons -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
   <!-- Bootstrap JS -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

   <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
   @include('layouts.alert-system')
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

   <style>
      .form-control.is-valid {
         border-color: #28a745;
         box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
      }

      .form-control.is-invalid {
         border-color: #dc3545;
         box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
      }

      .form-select.is-valid {
         border-color: #28a745;
         box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
      }

      .form-select.is-invalid {
         border-color: #dc3545;
         box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
      }

      /* DateTime input styles */
      input[type="date"],
      input[type="time"] {
         cursor: pointer;
      }

      .btn-outline-primary {
         transition: all 0.3s ease;
      }

      .btn-outline-primary:hover {
         transform: translateY(-1px);
         box-shadow: 0 4px 8px rgba(0, 123, 255, 0.3);
      }

      /* Mata Pelajaran Checkbox Styles */
      .mata-pelajaran-checkbox {
         transform: scale(1.2);
         margin-right: 0.5rem;
      }

      .form-check-label {
         font-size: 1rem;
         cursor: pointer;
         padding: 0.5rem;
         border-radius: 0.375rem;
         transition: background-color 0.2s ease;
      }

      .form-check-label:hover {
         background-color: #f8f9fa;
      }

      .form-check-input:checked+.form-check-label {
         background-color: #e3f2fd;
         color: #1976d2;
      }

      .page-header {
         background: #f8f9fa;
         color: #333;
         border-radius: 10px;
         padding: 1.5rem;
         margin-bottom: 2rem;
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
         <div class="p-4" data-sesi-ujian-id="{{ $id ?? '' }}">
            <!-- Page Header -->
            <div class="page-header">
               <div class="row align-items-center">
                  <div class="col-md-8">
                     <h4 class="mb-2"><i class="bi bi-pencil-square me-2" style="color: #991B1B;"></i>Edit Sesi Ujian</h4>
                     <p class="mb-0">Ubah informasi sesi ujian</p>
                  </div>
                  <div class="col-md-4 text-end">
                     <a href="{{ route('admin.sesi-ujian.index') }}" class="btn btn-light">
                        <i class="bi bi-arrow-left me-1"></i>
                        Kembali
                     </a>
                  </div>
               </div>
            </div>

            <!-- Form -->
            <div class="card">
               <div class="card-body">
                  <form id="editSessionForm">
                     <div class="row">
                        <!-- Basic Information -->
                        <div class="col-md-6">
                           <h6 class="mb-3">Informasi Dasar</h6>
                           <div class="mb-3">
                              <label class="form-label fw-bold">Mata Pelajaran <span class="text-danger">*</span></label>
                              <div class="card">
                                 <div class="card-header d-flex justify-content-between align-items-center">
                                    <span class="fw-bold">Pilih Mata Pelajaran</span>
                                    <div>
                                       <button type="button" class="btn btn-sm btn-outline-primary me-2" id="selectAllMataPelajaran">
                                          <i class="bi bi-check-square me-1"></i>Pilih Semua
                                       </button>
                                       <button type="button" class="btn btn-sm btn-outline-secondary" id="deselectAllMataPelajaran">
                                          <i class="bi bi-square me-1"></i>Batal Pilih
                                       </button>
                                       <button class="btn btn-sm btn-outline-secondary" type="button" id="refreshMataPelajaranBtn" title="Refresh Data Mata Pelajaran">
                                          <i class="bi bi-arrow-clockwise" id="refreshMataPelajaranIcon"></i>
                                          <span class="spinner-border spinner-border-sm d-none" id="refreshMataPelajaranSpinner" role="status"></span>
                                       </button>
                                    </div>
                                 </div>
                                 <div class="card-body">
                                    <div id="mataPelajaranList" class="row">
                                       <!-- Mata pelajaran checkboxes will be loaded here -->
                                       <div class="col-12 text-center">
                                          <div class="spinner-border text-primary" role="status">
                                             <span class="visually-hidden">Loading...</span>
                                          </div>
                                          <p class="mt-2 text-muted">Memuat mata pelajaran...</p>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-text">
                                 <small class="text-muted">Data mata pelajaran diambil dari tabel soal</small>
                              </div>
                           </div>
                           <div class="mb-3">
                              <label for="id_batch" class="form-label fw-bold">Batch <span class="text-danger">*</span></label>
                              <div class="input-group">
                                 <select class="form-select" id="id_batch" name="id_batch" required>
                                    <option value="">Pilih Batch</option>
                                 </select>
                                 <button class="btn btn-outline-secondary" type="button" id="refreshBatchBtn" title="Refresh Data Batch">
                                    <i class="bi bi-arrow-clockwise" id="refreshIcon"></i>
                                    <span class="spinner-border spinner-border-sm d-none" id="refreshSpinner" role="status"></span>
                                 </button>
                              </div>
                              <div class="form-text">
                                 <small class="text-muted">Data batch diambil dari tabel peserta</small>
                              </div>
                           </div>
                           <div class="mb-3">
                              <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                              <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
                           </div>
                        </div>

                        <!-- Schedule Information -->
                        <div class="col-md-6">
                           <h6 class="mb-3">Jadwal & Waktu</h6>
                           <div class="mb-3">
                              <label class="form-label fw-bold">Tanggal & Jam Mulai <span class="text-danger">*</span></label>
                              <div class="row">
                                 <div class="col-md-6">
                                    <label for="tanggal_mulai_date" class="form-label">Tanggal Mulai</label>
                                    <input type="date" class="form-control" id="tanggal_mulai_date" name="tanggal_mulai_date" required>
                                 </div>
                                 <div class="col-md-6">
                                    <label for="tanggal_mulai_time" class="form-label">Jam Mulai</label>
                                    <input type="time" class="form-control" id="tanggal_mulai_time" name="tanggal_mulai_time" required>
                                 </div>
                              </div>
                              <div class="mt-2">
                                 <button type="button" class="btn btn-sm btn-outline-primary" id="setTanggalMulaiBtn">
                                    <i class="bi bi-check-circle me-1"></i>Set Tanggal & Jam Mulai
                                 </button>
                                 <span class="ms-2 text-muted" id="tanggalMulaiDisplay">Belum dipilih</span>
                              </div>
                           </div>
                           <div class="mb-3">
                              <label class="form-label fw-bold">Tanggal & Jam Selesai <span class="text-danger">*</span></label>
                              <div class="row">
                                 <div class="col-md-6">
                                    <label for="tanggal_selesai_date" class="form-label">Tanggal Selesai</label>
                                    <input type="date" class="form-control" id="tanggal_selesai_date" name="tanggal_selesai_date" required>
                                 </div>
                                 <div class="col-md-6">
                                    <label for="tanggal_selesai_time" class="form-label">Jam Selesai</label>
                                    <input type="time" class="form-control" id="tanggal_selesai_time" name="tanggal_selesai_time" required>
                                 </div>
                              </div>
                              <div class="mt-2">
                                 <button type="button" class="btn btn-sm btn-outline-primary" id="setTanggalSelesaiBtn">
                                    <i class="bi bi-check-circle me-1"></i>Set Tanggal & Jam Selesai
                                 </button>
                                 <span class="ms-2 text-muted" id="tanggalSelesaiDisplay">Belum dipilih</span>
                              </div>
                           </div>
                           <div class="mb-3">
                              <label for="durasi_menit" class="form-label fw-bold">Total Durasi (Menit)</label>
                              <input type="number" class="form-control" id="durasi_menit" name="durasi_menit" min="0" readonly style="background-color: #e9ecef;">
                              <div class="form-text">
                                 <i class="bi bi-info-circle me-1"></i>
                                 Durasi dihitung otomatis berdasarkan jumlah soal dan durasi per soal
                                 <span id="durasiInfo" class="text-muted"></span>
                              </div>
                           </div>
                        </div>
                     </div>

                     <!-- Additional Settings -->
                     <!-- Hidden inputs for form submission -->
                     <input type="hidden" id="tanggal_mulai" name="tanggal_mulai">
                     <input type="hidden" id="tanggal_selesai" name="tanggal_selesai">

                     <div class="row mt-4">
                        <div class="col-12">
                           <h6 class="mb-3"><i class="bi bi-gear me-2"></i>Pengaturan Tampilan Peserta</h6>
                           <div class="card">
                              <div class="card-body">
                                 <p class="text-muted mb-3">Centang untuk menyembunyikan informasi dari peserta saat ujian:</p>
                                 <div class="row">
                                    <div class="col-md-4">
                                       <div class="form-check mb-3">
                                          <input class="form-check-input" type="checkbox" id="hide_nomor_urut" name="hide_nomor_urut" value="1">
                                          <label class="form-check-label fw-bold" for="hide_nomor_urut">
                                             <i class="bi bi-hash me-1"></i>Sembunyikan Nomor Urut Soal
                                          </label>
                                          <small class="form-text text-muted d-block">Peserta tidak akan melihat nomor urut soal</small>
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-check mb-3">
                                          <input class="form-check-input" type="checkbox" id="hide_poin" name="hide_poin" value="1">
                                          <label class="form-check-label fw-bold" for="hide_poin">
                                             <i class="bi bi-star me-1"></i>Sembunyikan Poin Soal
                                          </label>
                                          <small class="form-text text-muted d-block">Peserta tidak akan melihat poin setiap soal</small>
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-check mb-3">
                                          <input class="form-check-input" type="checkbox" id="hide_mata_pelajaran" name="hide_mata_pelajaran" value="1">
                                          <label class="form-check-label fw-bold" for="hide_mata_pelajaran">
                                             <i class="bi bi-book me-1"></i>Sembunyikan Nama Mata Pelajaran
                                          </label>
                                          <small class="form-text text-muted d-block">Peserta tidak akan melihat nama mata pelajaran</small>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="row mt-4">
                        <div class="col-12 text-end">
                           <button type="button" class="btn btn-secondary me-2 theme-btn" onclick="window.history.back()">
                              <i class="bi bi-x-circle me-1"></i>
                              Batal
                           </button>
                           <button type="submit" class="btn btn-success">
                              <i class="bi bi-check-circle me-1"></i>
                              Update Sesi Ujian
                           </button>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>

   <script>
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      const sesiUjianId = document.querySelector('[data-sesi-ujian-id]').getAttribute('data-sesi-ujian-id');

      // Load sesi ujian data for editing
      async function loadSesiUjianData(id) {
         try {
            console.log('Fetching sesi ujian data for ID:', id);
            const response = await fetch(`/admin/sesi-ujian/${id}/data`, {
               method: 'GET',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
               }
            });

            console.log('Response status:', response.status);
            if (response.ok) {
               const result = await response.json();
               console.log('Response data:', result);
               if (result.success) {
                  const sesiUjian = result.data;
                  console.log('SesiUjian data loaded:', sesiUjian);

                  // Fill form fields (ensure options exist first)
                  document.getElementById('deskripsi').value = sesiUjian.deskripsi || '';

                  // Set mata pelajaran checkboxes
                  if (sesiUjian.mata_pelajaran) {
                     // Split mata pelajaran string and set checkboxes
                     const mataPelajaranArray = sesiUjian.mata_pelajaran.split(',').map(s => s.trim());
                     selectedMataPelajaran = mataPelajaranArray;

                     // Check the corresponding checkboxes
                     setTimeout(() => {
                        mataPelajaranArray.forEach(mataPelajaran => {
                           const checkboxes = document.querySelectorAll('input[type="checkbox"][id^="mata_pelajaran_"]');
                           checkboxes.forEach(checkbox => {
                              if (checkbox.value === mataPelajaran) {
                                 checkbox.checked = true;
                              }
                           });
                        });
                     }, 100); // Small delay to ensure checkboxes are rendered

                     console.log('Mata pelajaran checkboxes will be set:', mataPelajaranArray);
                  } else {
                     console.log('No mata pelajaran data to set');
                  }

                  // Set hide/show checkboxes
                  if (sesiUjian.hide_nomor_urut) {
                     document.getElementById('hide_nomor_urut').checked = true;
                  }
                  if (sesiUjian.hide_poin) {
                     document.getElementById('hide_poin').checked = true;
                  }
                  if (sesiUjian.hide_mata_pelajaran) {
                     document.getElementById('hide_mata_pelajaran').checked = true;
                  }

                  // Batch: set by id; if current id not in list yet, inject option with current value
                  const batchSelect = document.getElementById('id_batch');
                  if (batchSelect) {
                     const batchId = sesiUjian.id_batch?.toString() || '';
                     const exists = Array.from(batchSelect.options).some(o => o.value === batchId);
                     if (!exists && batchId) {
                        const opt = document.createElement('option');
                        opt.value = batchId;
                        opt.textContent = sesiUjian.batch_name || `Batch ${batchId}`;
                        batchSelect.insertBefore(opt, batchSelect.firstChild);
                     }
                     batchSelect.value = batchId;
                  }

                  // Fill datetime-local fields
                  console.log('Raw data for datetime fields:', {
                     tanggal_mulai: sesiUjian.tanggal_mulai,
                     jam_mulai: sesiUjian.jam_mulai,
                     tanggal_selesai: sesiUjian.tanggal_selesai,
                     jam_selesai: sesiUjian.jam_selesai
                  });

                  // Set tanggal mulai
                  if (sesiUjian.tanggal_mulai && sesiUjian.jam_mulai) {
                     const tanggalMulai = sesiUjian.tanggal_mulai.split(' ')[0];
                     const jamMulai = sesiUjian.jam_mulai.substring(0, 5);

                     document.getElementById('tanggal_mulai_date').value = tanggalMulai;
                     document.getElementById('tanggal_mulai_time').value = jamMulai;

                     // Set combined value
                     const combinedDateTime = tanggalMulai + ' ' + jamMulai;
                     document.getElementById('tanggal_mulai').value = combinedDateTime;
                     document.getElementById('tanggalMulaiDisplay').textContent = combinedDateTime;
                     tanggalMulaiValue = combinedDateTime;

                     console.log('Tanggal mulai set:', combinedDateTime);
                  }

                  // Set tanggal selesai
                  if (sesiUjian.tanggal_selesai && sesiUjian.jam_selesai) {
                     const tanggalSelesai = sesiUjian.tanggal_selesai.split(' ')[0];
                     const jamSelesai = sesiUjian.jam_selesai.substring(0, 5);

                     document.getElementById('tanggal_selesai_date').value = tanggalSelesai;
                     document.getElementById('tanggal_selesai_time').value = jamSelesai;

                     // Set combined value
                     const combinedDateTime = tanggalSelesai + ' ' + jamSelesai;
                     document.getElementById('tanggal_selesai').value = combinedDateTime;
                     document.getElementById('tanggalSelesaiDisplay').textContent = combinedDateTime;
                     tanggalSelesaiValue = combinedDateTime;

                     console.log('Tanggal selesai set:', combinedDateTime);
                  }
                  document.getElementById('durasi_menit').value = sesiUjian.durasi_menit || '';
                  
                  // Calculate duration after loading data
                  setTimeout(function() {
                     calculateDuration();
                  }, 500);
               }
            }
         } catch (error) {
            console.error('Error loading sesi ujian data:', error);
            alertSystem.error('Gagal memuat data', 'Terjadi kesalahan saat memuat data');
         }
      }

      // Global variable to store selected mata pelajaran
      let selectedMataPelajaran = [];

      // Global variables for datetime
      let tanggalMulaiValue = '';
      let tanggalSelesaiValue = '';

      // Load mata pelajaran for form
      async function loadMataPelajaran() {
         console.log('=== LOAD MATA PELAJARAN START ===');

         // Show loading indicator
         const refreshIcon = document.getElementById('refreshMataPelajaranIcon');
         const refreshSpinner = document.getElementById('refreshMataPelajaranSpinner');
         if (refreshIcon && refreshSpinner) {
            refreshIcon.classList.add('d-none');
            refreshSpinner.classList.remove('d-none');
         }

         // Check if mata pelajaran list element exists
         const mataPelajaranList = document.getElementById('mataPelajaranList');
         if (!mataPelajaranList) {
            console.error('Mata pelajaran list element not found!');
            if (refreshIcon && refreshSpinner) {
               refreshIcon.classList.remove('d-none');
               refreshSpinner.classList.add('d-none');
            }
            return;
         }

         try {
            const response = await fetch('/admin/sesi-ujian/mata-pelajaran', {
               method: 'GET',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
               }
            });

            if (response.ok) {
               const result = await response.json();
               console.log('Mata pelajaran loaded:', result);

               if (result.success && result.data) {
                  renderMataPelajaranList(result.data);
                  console.log('Mata pelajaran checkboxes rendered successfully');
               } else {
                  console.error('Failed to load mata pelajaran:', result.message);
                  alertSystem.error('Gagal memuat mata pelajaran', result.message || 'Terjadi kesalahan');
               }
            } else {
               console.error('Failed to load mata pelajaran:', response.status, response.statusText);
               alertSystem.error('Gagal memuat mata pelajaran', 'Terjadi kesalahan saat memuat data');
            }
         } catch (error) {
            console.error('Error loading mata pelajaran:', error);
            alertSystem.error('Gagal memuat mata pelajaran', 'Terjadi kesalahan jaringan: ' + error.message);
         } finally {
            // Hide loading indicator
            if (refreshIcon && refreshSpinner) {
               refreshIcon.classList.remove('d-none');
               refreshSpinner.classList.add('d-none');
            }
            console.log('=== LOAD MATA PELAJARAN END ===');
         }
      }

      // Render mata pelajaran checkboxes
      function renderMataPelajaranList(mataPelajaranData) {
         const mataPelajaranList = document.getElementById('mataPelajaranList');
         mataPelajaranList.innerHTML = '';

         if (!mataPelajaranData || mataPelajaranData.length === 0) {
            mataPelajaranList.innerHTML = '<div class="col-12 text-center text-muted">Tidak ada mata pelajaran tersedia</div>';
            return;
         }

         mataPelajaranData.forEach((mataPelajaran, index) => {
            const col = document.createElement('div');
            col.className = 'col-md-6 col-lg-4 mb-2';

            col.innerHTML = `
               <div class="form-check">
                  <input class="form-check-input" type="checkbox" 
                         value="${mataPelajaran}" 
                         id="mata_pelajaran_${index}"
                         onchange="updateMataPelajaranSelection()">
                  <label class="form-check-label" for="mata_pelajaran_${index}">
                     ${mataPelajaran}
                  </label>
               </div>
            `;

            mataPelajaranList.appendChild(col);
         });
      }

      // Update selected mata pelajaran
      function updateMataPelajaranSelection() {
         const checkboxes = document.querySelectorAll('input[name="mata_pelajaran[]"]:checked, input[type="checkbox"][id^="mata_pelajaran_"]:checked');
         selectedMataPelajaran = Array.from(checkboxes).map(cb => cb.value);
         console.log('Selected mata pelajaran:', selectedMataPelajaran);
         
         // Calculate duration when mata pelajaran changes
         calculateDuration();
      }
      
      // Calculate total duration based on batch and mata pelajaran
      async function calculateDuration() {
         const idBatch = document.getElementById('id_batch')?.value;
         const durasiInput = document.getElementById('durasi_menit');
         const durasiInfo = document.getElementById('durasiInfo');
         
         if (!idBatch || selectedMataPelajaran.length === 0) {
            if (durasiInput) durasiInput.value = '';
            if (durasiInfo) durasiInfo.textContent = '';
            return;
         }
         
         try {
            const response = await fetch('/admin/sesi-ujian/calculate-duration', {
               method: 'POST',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
               },
               body: JSON.stringify({
                  id_batch: parseInt(idBatch),
                  mata_pelajaran: selectedMataPelajaran
               })
            });
            
            const result = await response.json();
            
            if (result.success) {
               const totalDuration = result.total_duration || 0;
               const totalSoal = result.total_soal || 0;
               
               if (durasiInput) {
                  durasiInput.value = totalDuration;
               }
               
               if (durasiInfo) {
                  if (totalSoal > 0) {
                     if (totalDuration > 0) {
                        durasiInfo.textContent = `(${totalSoal} soal × durasi per soal = ${totalDuration} menit)`;
                     } else {
                        durasiInfo.textContent = `(${totalSoal} soal, namun tidak ada durasi yang ditetapkan per soal)`;
                     }
                  } else {
                     durasiInfo.textContent = '(Belum ada soal yang dipilih)';
                  }
               }
            } else {
               console.error('Error calculating duration:', result.message);
               if (durasiInput) durasiInput.value = '';
               if (durasiInfo) durasiInfo.textContent = '';
            }
         } catch (error) {
            console.error('Error calculating duration:', error);
            if (durasiInput) durasiInput.value = '';
            if (durasiInfo) durasiInfo.textContent = '';
         }
      }

      // Select all mata pelajaran
      function selectAllMataPelajaran() {
         const checkboxes = document.querySelectorAll('input[type="checkbox"][id^="mata_pelajaran_"]');
         checkboxes.forEach(cb => {
            cb.checked = true;
         });
         updateMataPelajaranSelection();
      }

      // Deselect all mata pelajaran
      function deselectAllMataPelajaran() {
         const checkboxes = document.querySelectorAll('input[type="checkbox"][id^="mata_pelajaran_"]');
         checkboxes.forEach(cb => {
            cb.checked = false;
         });
         selectedMataPelajaran = [];
         console.log('Selected mata pelajaran:', selectedMataPelajaran);
      }

      // Set tanggal mulai
      async function setTanggalMulai() {
         const date = document.getElementById('tanggal_mulai_date').value;
         const time = document.getElementById('tanggal_mulai_time').value;

         if (date && time) {
            const datetime = date + ' ' + time;
            tanggalMulaiValue = datetime;
            document.getElementById('tanggal_mulai').value = datetime;
            document.getElementById('tanggalMulaiDisplay').textContent = datetime;

            // Auto-fill end date/time
            document.getElementById('tanggal_selesai_date').value = date;

            console.log('Tanggal mulai set:', datetime);
         } else {
            await Swal.fire({
               icon: 'warning',
               title: 'Validasi Gagal',
               text: 'Pilih tanggal dan jam mulai terlebih dahulu!',
               confirmButtonText: 'OK',
               confirmButtonColor: '#991B1B'
            });
         }
      }

      // Set tanggal selesai
      async function setTanggalSelesai() {
         const date = document.getElementById('tanggal_selesai_date').value;
         const time = document.getElementById('tanggal_selesai_time').value;

         if (date && time) {
            const datetime = date + ' ' + time;
            tanggalSelesaiValue = datetime;
            document.getElementById('tanggal_selesai').value = datetime;
            document.getElementById('tanggalSelesaiDisplay').textContent = datetime;

            console.log('Tanggal selesai set:', datetime);
         } else {
            await Swal.fire({
               icon: 'warning',
               title: 'Validasi Gagal',
               text: 'Pilih tanggal dan jam selesai terlebih dahulu!',
               confirmButtonText: 'OK',
               confirmButtonColor: '#991B1B'
            });
         }
      }

      // Load batches for form
      async function loadBatches() {
         console.log('=== LOAD BATCHES START ===');

         // Show loading indicator
         const refreshIcon = document.getElementById('refreshIcon');
         const refreshSpinner = document.getElementById('refreshSpinner');
         if (refreshIcon && refreshSpinner) {
            refreshIcon.classList.add('d-none');
            refreshSpinner.classList.remove('d-none');
         }

         // Check if batch element exists
         const batchElement = document.getElementById('id_batch');
         if (!batchElement) {
            console.error('Batch element not found!');
            if (refreshIcon && refreshSpinner) {
               refreshIcon.classList.remove('d-none');
               refreshSpinner.classList.add('d-none');
            }
            return;
         }

         try {
            const response = await fetch('/admin/participants/batches', {
               method: 'GET',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
               }
            });

            if (response.ok) {
               const result = await response.json();
               console.log('Batches loaded:', result);

               if (result.success && result.data) {
                  // Update form dropdown
                  const batchSelect = document.getElementById('id_batch');
                  if (batchSelect) {
                     // Clear existing options except the first one
                     batchSelect.innerHTML = '<option value="">Pilih Batch</option>';

                     // Add new options
                     result.data.forEach(batch => {
                        const option = document.createElement('option');
                        option.value = batch.id_batch;
                        option.textContent = batch.nama_batch;
                        option.setAttribute('data-batch-name', batch.nama_batch);
                        batchSelect.appendChild(option);
                     });

                     console.log('Batch dropdown updated with', result.data.length, 'options');
                  }
               }
            } else {
               console.error('Failed to load batches:', response.status);
            }
         } catch (error) {
            console.error('Error loading batches:', error);
         } finally {
            // Hide loading indicator
            if (refreshIcon && refreshSpinner) {
               refreshIcon.classList.remove('d-none');
               refreshSpinner.classList.add('d-none');
            }
         }
      }

      // Handle form submission
      async function handleEditForm(event) {
         event.preventDefault();

         // Validasi form sebelum submit
         const form = event.target;
         if (!form.checkValidity()) {
            console.log('Form validation failed');
            form.reportValidity();
            return;
         }

         // Validasi manual untuk field yang diperlukan
         const idBatch = form.querySelector('#id_batch').value;
         const tanggalMulai = form.querySelector('#tanggal_mulai').value;
         const tanggalSelesai = form.querySelector('#tanggal_selesai').value;

         console.log('Form validation check:', {
            idBatch: idBatch,
            selectedMataPelajaran: selectedMataPelajaran,
            tanggalMulai: tanggalMulai,
            tanggalSelesai: tanggalSelesai
         });

         if (!idBatch) {
            await Swal.fire({
               icon: 'warning',
               title: 'Validasi Gagal',
               text: 'Batch harus dipilih!',
               confirmButtonText: 'OK',
               confirmButtonColor: '#991B1B'
            });
            form.querySelector('#id_batch').focus();
            return;
         }

         if (selectedMataPelajaran.length === 0) {
            await Swal.fire({
               icon: 'warning',
               title: 'Validasi Gagal',
               text: 'Minimal satu Mata Pelajaran harus dipilih!',
               confirmButtonText: 'OK',
               confirmButtonColor: '#991B1B'
            });
            return;
         }

         if (!tanggalMulai) {
            await Swal.fire({
               icon: 'warning',
               title: 'Validasi Gagal',
               text: 'Tanggal & Jam Mulai harus diisi! Klik tombol "Set" setelah memilih tanggal dan jam.',
               confirmButtonText: 'OK',
               confirmButtonColor: '#991B1B'
            });
            return;
         }

         if (!tanggalSelesai) {
            await Swal.fire({
               icon: 'warning',
               title: 'Validasi Gagal',
               text: 'Tanggal & Jam Selesai harus diisi! Klik tombol "Set" setelah memilih tanggal dan jam.',
               confirmButtonText: 'OK',
               confirmButtonColor: '#991B1B'
            });
            return;
         }

         // Validasi waktu
         const startDateTime = new Date(tanggalMulai);
         const endDateTime = new Date(tanggalSelesai);

         if (endDateTime <= startDateTime) {
            await Swal.fire({
               icon: 'warning',
               title: 'Validasi Gagal',
               text: 'Waktu Selesai harus setelah Waktu Mulai!',
               confirmButtonText: 'OK',
               confirmButtonColor: '#991B1B'
            });
            form.querySelector('#tanggal_selesai').focus();
            return;
         }

         console.log('Form validation passed');

         const loadingAlert = alertSystem.loading('Memperbarui sesi ujian...');

         try {
            const formData = new FormData(event.target);

            // Update selected mata pelajaran before sending
            updateMataPelajaranSelection();

            const sesiUjianData = {
               deskripsi: formData.get('deskripsi'),
               id_batch: parseInt(formData.get('id_batch')),
               mata_pelajaran: selectedMataPelajaran,
               tanggal_mulai: tanggalMulai,
               tanggal_selesai: tanggalSelesai,
               durasi_menit: formData.get('durasi_menit') ? parseInt(formData.get('durasi_menit')) : null,
               hide_nomor_urut: document.getElementById('hide_nomor_urut').checked ? 1 : 0,
               hide_poin: document.getElementById('hide_poin').checked ? 1 : 0,
               hide_mata_pelajaran: document.getElementById('hide_mata_pelajaran').checked ? 1 : 0
            };

            // Debug log untuk melihat data yang dikirim
            console.log('Selected mata pelajaran before send:', selectedMataPelajaran);
            console.log('SesiUjian Data to be sent:', sesiUjianData);

            const response = await fetch(`/admin/sesi-ujian/${sesiUjianId}`, {
               method: 'PUT',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken,
                  'Accept': 'application/json'
               },
               body: JSON.stringify(sesiUjianData)
            });

            console.log('Response status:', response.status);
            console.log('Response headers:', response.headers);

            // Check if response is JSON
            const contentType = response.headers.get('content-type');
            if (!contentType || !contentType.includes('application/json')) {
               const textResponse = await response.text();
               console.error('Non-JSON response received:', textResponse);
               alertSystem.hide(loadingAlert);
               alertSystem.error('Gagal menyimpan', 'Server mengembalikan response yang tidak valid. Status: ' + response.status);
               return;
            }

            const result = await response.json();
            console.log('Response result:', result);
            alertSystem.hide(loadingAlert);

            if (result.success) {
               alertSystem.updateSuccess('Sesi Ujian');

               // Redirect to index page
               window.location.href = '{{ route("admin.sesi-ujian.index") }}';
            } else {
               alertSystem.error('Gagal menyimpan', result.message || 'Terjadi kesalahan');
            }
         } catch (error) {
            console.error('Error saving sesi ujian:', error);
            alertSystem.hide(loadingAlert);
            alertSystem.error('Gagal menyimpan', 'Terjadi kesalahan jaringan: ' + error.message);
         }
      }



      // Validate datetime
      function validateDateTime() {
         const tanggalMulai = document.getElementById('tanggal_mulai').value;
         const tanggalSelesai = document.getElementById('tanggal_selesai').value;

         if (tanggalMulai && tanggalSelesai) {
            const startDateTime = new Date(tanggalMulai);
            const endDateTime = new Date(tanggalSelesai);

            if (endDateTime <= startDateTime) {
               document.getElementById('tanggal_selesai').setCustomValidity('Waktu selesai harus setelah waktu mulai');
            } else {
               document.getElementById('tanggal_selesai').setCustomValidity('');
            }
         }
      }

      // Initialize on page load
      document.addEventListener('DOMContentLoaded', async function() {
         console.log('DOM Content Loaded');

         // Load sesi ujian data if ID is provided
         // Urutan: muat opsi (mata pelajaran & batch), lalu set nilai sesi agar select sudah punya opsi
         if (sesiUjianId) {
            await loadMataPelajaran();
            await loadBatches();
            console.log('Loading sesi ujian data for ID:', sesiUjianId);
            await loadSesiUjianData(sesiUjianId);
         } else {
            // No ID, just load dropdowns without awaiting
            loadMataPelajaran();
            loadBatches();
         }

         // Add form listeners
         const editForm = document.getElementById('editSessionForm');
         const tanggalMulai = document.getElementById('tanggal_mulai');
         const tanggalSelesai = document.getElementById('tanggal_selesai');
         const refreshBatchBtn = document.getElementById('refreshBatchBtn');
         const refreshMataPelajaranBtn = document.getElementById('refreshMataPelajaranBtn');

         if (editForm) {
            editForm.addEventListener('submit', handleEditForm);
         }
         if (tanggalMulai) {
            tanggalMulai.addEventListener('change', validateDateTime);
         }
         if (tanggalSelesai) {
            tanggalSelesai.addEventListener('change', validateDateTime);
         }
         if (refreshBatchBtn) {
            refreshBatchBtn.addEventListener('click', function() {
               console.log('Refresh batch button clicked');
               loadBatches();
            });
         }
         if (refreshMataPelajaranBtn) {
            refreshMataPelajaranBtn.addEventListener('click', function() {
               console.log('Refresh mata pelajaran button clicked');
               loadMataPelajaran();
            });
         }

         // Add event listeners for mata pelajaran buttons
         const selectAllBtn = document.getElementById('selectAllMataPelajaran');
         const deselectAllBtn = document.getElementById('deselectAllMataPelajaran');

         if (selectAllBtn) {
            selectAllBtn.addEventListener('click', selectAllMataPelajaran);
         }

         if (deselectAllBtn) {
            deselectAllBtn.addEventListener('click', deselectAllMataPelajaran);
         }
         
         // Add event listener for batch change
         const idBatchSelect = document.getElementById('id_batch');
         if (idBatchSelect) {
            idBatchSelect.addEventListener('change', function() {
               calculateDuration();
            });
         }

         // Add event listeners for datetime buttons
         const setTanggalMulaiBtn = document.getElementById('setTanggalMulaiBtn');
         const setTanggalSelesaiBtn = document.getElementById('setTanggalSelesaiBtn');

         if (setTanggalMulaiBtn) {
            setTanggalMulaiBtn.addEventListener('click', setTanggalMulai);
         }

         if (setTanggalSelesaiBtn) {
            setTanggalSelesaiBtn.addEventListener('click', setTanggalSelesai);
         }

         // Set minimum date to today
         const today = new Date().toISOString().split('T')[0];
         const dateInputs = document.querySelectorAll('input[type="date"]');
         dateInputs.forEach(input => {
            input.min = today;
         });


         // Add real-time validation for form fields
         const idBatchSelect = document.getElementById('id_batch');


         if (idBatchSelect) {
            idBatchSelect.addEventListener('change', function() {
               if (this.value) {
                  this.classList.remove('is-invalid');
                  this.classList.add('is-valid');
               } else {
                  this.classList.remove('is-valid');
                  this.classList.add('is-invalid');
               }
            });
         }
      });
   </script>

   @include('layouts.logout-script')

</body>

</html>