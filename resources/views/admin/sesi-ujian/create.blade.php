<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Tambah Sesi Ujian - Ujian Online</title>
   <meta name="csrf-token" content="{{ csrf_token() }}">

   
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
   
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

      .page-header {
         background: #f8f9fa;
         color: #333;
         border-radius: 10px;
         padding: 1.5rem;
         margin-bottom: 2rem;
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
   </style>
</head>

<body>
   <div class="container-fluid">
      
      @include('layouts.sidebar')

      
      <div class="main-content">
         
         @include('layouts.navbar')

         
         <div class="p-4">
            
            <div class="page-header">
               <div class="row align-items-center">
                  <div class="col-md-8">
                     <h4 class="mb-2"><i class="bi bi-calendar-plus me-2" style="color: #991B1B;"></i>Tambah Sesi Ujian</h4>
                     <p class="mb-0">Buat sesi ujian baru untuk peserta</p>
                  </div>
                  <div class="col-md-4 text-end">
                     <a href="{{ route('admin.sesi-ujian.index') }}" class="btn btn-light">
                        <i class="bi bi-arrow-left me-1"></i>
                        Kembali
                     </a>
                  </div>
               </div>
            </div>

            
            <div class="card">
               <div class="card-body">
                  <form id="createSessionForm">
                     
                     <input type="hidden" id="tanggal_mulai" name="tanggal_mulai">
                     <input type="hidden" id="tanggal_selesai" name="tanggal_selesai">

                     <div class="row">
                        
                        <div class="col-md-6">
                           <h6 class="mb-3">Informasi Dasar</h6>
                           <div class="mb-3">
                              <label class="form-label fw-bold">Mata Pelajaran <span class="text-danger">*</span></label>
                              <div class="card">
                                 <div class="card-header">
                                    <div class="row align-items-center">
                                       <div class="col-md-6">
                                          <h6 class="mb-0">Pilih Mata Pelajaran</h6>
                                       </div>
                                       <div class="col-md-6 text-end">
                                          <button type="button" class="btn btn-sm btn-outline-primary" id="selectAllMataPelajaranBtn">
                                             <i class="bi bi-check-square me-1"></i>Pilih Semua
                                          </button>
                                          <button type="button" class="btn btn-sm btn-outline-secondary" id="deselectAllMataPelajaranBtn">
                                             <i class="bi bi-square me-1"></i>Batal Pilih
                                          </button>
                                          <button class="btn btn-sm btn-outline-info" type="button" id="refreshMataPelajaranBtn" title="Refresh Data Mata Pelajaran">
                                             <i class="bi bi-arrow-clockwise" id="refreshMataPelajaranIcon"></i>
                                             <span class="spinner-border spinner-border-sm d-none" id="refreshMataPelajaranSpinner" role="status"></span>
                                          </button>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="card-body">
                                    <div id="mataPelajaranListContainer">
                                       <div class="text-center text-muted py-4">
                                          <div class="spinner-border text-primary" role="status">
                                             <span class="visually-hidden">Loading...</span>
                                          </div>
                                          <p class="mt-2 text-muted">Memuat daftar mata pelajaran...</p>
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
                           <button type="submit" class="btn btn-success theme-btn">
                              <i class="bi bi-calendar-plus me-1"></i>
                              Buat Sesi Ujian
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

      let selectedMataPelajaran = [];
      let mataPelajaranData = [];

      let tanggalMulaiValue = '';
      let tanggalSelesaiValue = '';

      document.addEventListener('DOMContentLoaded', function() {
         selectedMataPelajaran = [];
         console.log('selectedMataPelajaran initialized:', selectedMataPelajaran);
      });

      async function loadMataPelajaran() {
         console.log('=== LOAD MATA PELAJARAN START ===');

         const refreshIcon = document.getElementById('refreshMataPelajaranIcon');
         const refreshSpinner = document.getElementById('refreshMataPelajaranSpinner');
         if (refreshIcon && refreshSpinner) {
            refreshIcon.classList.add('d-none');
            refreshSpinner.classList.remove('d-none');
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
                  mataPelajaranData = result.data;
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
            if (refreshIcon && refreshSpinner) {
               refreshIcon.classList.remove('d-none');
               refreshSpinner.classList.add('d-none');
            }
            console.log('=== LOAD MATA PELAJARAN END ===');
         }
      }

      async function loadBatches() {
         console.log('=== LOAD BATCHES START ===');

         const refreshIcon = document.getElementById('refreshIcon');
         const refreshSpinner = document.getElementById('refreshSpinner');
         if (refreshIcon && refreshSpinner) {
            refreshIcon.classList.add('d-none');
            refreshSpinner.classList.remove('d-none');
         }

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
                  const batchSelect = document.getElementById('id_batch');
                  if (batchSelect) {
                     batchSelect.innerHTML = '<option value="">Pilih Batch</option>';

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
            if (refreshIcon && refreshSpinner) {
               refreshIcon.classList.remove('d-none');
               refreshSpinner.classList.add('d-none');
            }
         }
      }

      async function handleCreateForm(event) {
         event.preventDefault();

         const form = event.target;
         if (!form.checkValidity()) {
            console.log('Form validation failed');
            form.reportValidity();
            return;
         }

         const idBatch = form.querySelector('#id_batch').value;
         const tanggalMulai = form.querySelector('#tanggal_mulai').value;
         const tanggalSelesai = form.querySelector('#tanggal_selesai').value;

         console.log('Form validation check:', {
            idBatch: idBatch,
            selectedMataPelajaran: selectedMataPelajaran,
            selectedMataPelajaranLength: selectedMataPelajaran.length,
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
               text: 'Mata Pelajaran harus dipilih minimal 1!',
               confirmButtonText: 'OK',
               confirmButtonColor: '#991B1B'
            });
            return;
         }

         if (!tanggalMulai) {
            await Swal.fire({
               icon: 'warning',
               title: 'Validasi Gagal',
               text: 'Tanggal & Jam Mulai harus di-set! Klik tombol "Set Tanggal & Jam Mulai" setelah memilih tanggal dan jam.',
               confirmButtonText: 'OK',
               confirmButtonColor: '#991B1B'
            });
            return;
         }

         if (!tanggalSelesai) {
            await Swal.fire({
               icon: 'warning',
               title: 'Validasi Gagal',
               text: 'Tanggal & Jam Selesai harus di-set! Klik tombol "Set Tanggal & Jam Selesai" setelah memilih tanggal dan jam.',
               confirmButtonText: 'OK',
               confirmButtonColor: '#991B1B'
            });
            return;
         }

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

         const loadingAlert = alertSystem.loading('Membuat sesi ujian...');

         try {
            const formData = new FormData(event.target);

            const sesiUjianData = {
               deskripsi: formData.get('deskripsi'),
               id_batch: parseInt(formData.get('id_batch')),
               mata_pelajaran: selectedMataPelajaran,
               tanggal_mulai: formData.get('tanggal_mulai'),
               tanggal_selesai: formData.get('tanggal_selesai'),
               durasi_menit: formData.get('durasi_menit') ? parseInt(formData.get('durasi_menit')) : null,
               hide_nomor_urut: document.getElementById('hide_nomor_urut').checked ? 1 : 0,
               hide_poin: document.getElementById('hide_poin').checked ? 1 : 0,
               hide_mata_pelajaran: document.getElementById('hide_mata_pelajaran').checked ? 1 : 0
            };

            console.log('SesiUjian Data to be sent:', sesiUjianData);
            console.log('Request headers:', {
               'Content-Type': 'application/json',
               'X-CSRF-TOKEN': csrfToken,
               'Accept': 'application/json'
            });

            const response = await fetch('/admin/sesi-ujian', {
               method: 'POST',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken,
                  'Accept': 'application/json'
               },
               body: JSON.stringify(sesiUjianData)
            });

            const contentType = response.headers.get('content-type');
            if (!contentType || !contentType.includes('application/json')) {
               const text = await response.text();
               console.error('Non-JSON response:', text);
               alertSystem.hide(loadingAlert);
               alertSystem.error('Gagal menyimpan', 'Server mengembalikan response yang tidak valid. Status: ' + response.status);
               return;
            }

            const result = await response.json();
            alertSystem.hide(loadingAlert);

            if (result.success) {
               alertSystem.createSuccess('Sesi Ujian');

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

      document.addEventListener('DOMContentLoaded', function() {
         console.log('DOM Content Loaded');
         loadMataPelajaran();
         loadBatches();

         const createForm = document.getElementById('createSessionForm');
         const tanggalMulai = document.getElementById('tanggal_mulai');
         const tanggalSelesai = document.getElementById('tanggal_selesai');
         const refreshBatchBtn = document.getElementById('refreshBatchBtn');
         const refreshMataPelajaranBtn = document.getElementById('refreshMataPelajaranBtn');

         if (createForm) {
            createForm.addEventListener('submit', handleCreateForm);
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

         const today = new Date().toISOString().split('T')[0];
         const tanggalMulaiDate = document.getElementById('tanggal_mulai_date');
         const tanggalSelesaiDate = document.getElementById('tanggal_selesai_date');

         if (tanggalMulaiDate) {
            tanggalMulaiDate.setAttribute('min', today);
         }
         if (tanggalSelesaiDate) {
            tanggalSelesaiDate.setAttribute('min', today);
         }

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

      document.getElementById('setTanggalMulaiBtn').addEventListener('click', async function() {
         const date = document.getElementById('tanggal_mulai_date').value;
         const time = document.getElementById('tanggal_mulai_time').value;

         if (!date || !time) {
            await Swal.fire({
               icon: 'warning',
               title: 'Validasi Gagal',
               text: 'Pilih tanggal dan jam mulai terlebih dahulu!',
               confirmButtonText: 'OK',
               confirmButtonColor: '#991B1B'
            });
            return;
         }

         const datetime = date + 'T' + time;
         tanggalMulaiValue = datetime;

         document.getElementById('tanggal_mulai').value = datetime;

         const display = new Date(datetime).toLocaleString('id-ID', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
         });
         document.getElementById('tanggalMulaiDisplay').textContent = display;
         document.getElementById('tanggalMulaiDisplay').className = 'ms-2 text-success fw-bold';

         if (!tanggalSelesaiValue) {
            const endDate = new Date(datetime);
            endDate.setHours(endDate.getHours() + 1); // Add 1 hour by default

            const endDateStr = endDate.toISOString().split('T')[0];
            const endTimeStr = endDate.toTimeString().split(' ')[0].substring(0, 5);

            document.getElementById('tanggal_selesai_date').value = endDateStr;
            document.getElementById('tanggal_selesai_time').value = endTimeStr;
         }

         console.log('Tanggal mulai set:', datetime);
      });

      document.getElementById('setTanggalSelesaiBtn').addEventListener('click', async function() {
         const date = document.getElementById('tanggal_selesai_date').value;
         const time = document.getElementById('tanggal_selesai_time').value;

         if (!date || !time) {
            await Swal.fire({
               icon: 'warning',
               title: 'Validasi Gagal',
               text: 'Pilih tanggal dan jam selesai terlebih dahulu!',
               confirmButtonText: 'OK',
               confirmButtonColor: '#991B1B'
            });
            return;
         }

         const datetime = date + 'T' + time;
         tanggalSelesaiValue = datetime;

         document.getElementById('tanggal_selesai').value = datetime;

         const display = new Date(datetime).toLocaleString('id-ID', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
         });
         document.getElementById('tanggalSelesaiDisplay').textContent = display;
         document.getElementById('tanggalSelesaiDisplay').className = 'ms-2 text-success fw-bold';

         if (tanggalMulaiValue && new Date(datetime) <= new Date(tanggalMulaiValue)) {
            await Swal.fire({
               icon: 'warning',
               title: 'Validasi Gagal',
               text: 'Waktu selesai harus setelah waktu mulai!',
               confirmButtonText: 'OK',
               confirmButtonColor: '#991B1B'
            });
            document.getElementById('tanggalSelesaiDisplay').textContent = 'Waktu tidak valid!';
            document.getElementById('tanggalSelesaiDisplay').className = 'ms-2 text-danger fw-bold';
            return;
         }

         console.log('Tanggal selesai set:', datetime);
      });

      function renderMataPelajaranList(mataPelajaranList) {
         const container = document.getElementById('mataPelajaranListContainer');

         if (mataPelajaranList.length === 0) {
            container.innerHTML = `
               <div class="text-center text-muted py-4">
                  <i class="bi bi-exclamation-circle me-2"></i>
                  Tidak ada mata pelajaran tersedia
               </div>
            `;
            return;
         }

         const mataPelajaranHtml = mataPelajaranList.map((mataPelajaran, index) => `
            <div class="form-check mb-2">
               <input class="form-check-input mata-pelajaran-checkbox" type="checkbox" 
                      value="${mataPelajaran}" 
                      id="mata_pelajaran_${index}"
                      name="mata_pelajaran[]"
                      onchange="updateMataPelajaranSelection()">
               <label class="form-check-label" for="mata_pelajaran_${index}">
                  <strong>${mataPelajaran}</strong>
               </label>
            </div>
         `).join('');

         container.innerHTML = mataPelajaranHtml;

         updateMataPelajaranSelection();
      }

      function updateMataPelajaranSelection() {
         const checkboxes = document.querySelectorAll('.mata-pelajaran-checkbox:checked');
         selectedMataPelajaran = Array.from(checkboxes).map(cb => cb.value);

         console.log('Selected mata pelajaran:', selectedMataPelajaran);

         if (!Array.isArray(selectedMataPelajaran)) {
            selectedMataPelajaran = [];
         }
         
         calculateDuration();
      }
      
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

         document.getElementById('selectAllMataPelajaranBtn').addEventListener('click', function() {
            document.querySelectorAll('.mata-pelajaran-checkbox').forEach(checkbox => {
               checkbox.checked = true;
            });
            updateMataPelajaranSelection();
         });

         document.getElementById('deselectAllMataPelajaranBtn').addEventListener('click', function() {
            document.querySelectorAll('.mata-pelajaran-checkbox').forEach(checkbox => {
               checkbox.checked = false;
            });
            updateMataPelajaranSelection();
         });
         
         const idBatchSelect = document.getElementById('id_batch');
         if (idBatchSelect) {
            idBatchSelect.addEventListener('change', function() {
               calculateDuration();
            });
         }
   </script>

   @include('layouts.logout-script')

</body>

</html>