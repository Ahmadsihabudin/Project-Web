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

      /* Datetime input styles */
      input[type="datetime-local"] {
         cursor: pointer;
      }

      input[type="datetime-local"]::-webkit-calendar-picker-indicator {
         cursor: pointer;
         background: transparent;
         bottom: 0;
         color: transparent;
         height: auto;
         left: 0;
         position: absolute;
         right: 0;
         top: 0;
         width: auto;
      }

      .page-header {
         background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
         color: white;
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
                     <h4 class="mb-2"><i class="bi bi-pencil-square me-2"></i>Edit Sesi Ujian</h4>
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
                              <label for="mata_pelajaran" class="form-label fw-bold">Mata Pelajaran <span class="text-danger">*</span></label>
                              <div class="input-group">
                                 <select class="form-select" id="mata_pelajaran" name="mata_pelajaran" required>
                                    <option value="">Pilih Mata Pelajaran</option>
                                 </select>
                                 <button class="btn btn-outline-secondary" type="button" id="refreshMataPelajaranBtn" title="Refresh Data Mata Pelajaran">
                                    <i class="bi bi-arrow-clockwise" id="refreshMataPelajaranIcon"></i>
                                    <span class="spinner-border spinner-border-sm d-none" id="refreshMataPelajaranSpinner" role="status"></span>
                                 </button>
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
                              <label for="tanggal_mulai" class="form-label fw-bold">Tanggal & Jam Mulai <span class="text-danger">*</span></label>
                              <input type="datetime-local" class="form-control" id="tanggal_mulai" name="tanggal_mulai" required>
                           </div>
                           <div class="mb-3">
                              <label for="tanggal_selesai" class="form-label fw-bold">Tanggal & Jam Selesai <span class="text-danger">*</span></label>
                              <input type="datetime-local" class="form-control" id="tanggal_selesai" name="tanggal_selesai" required>
                           </div>
                           <div class="mb-3">
                              <label for="durasi_menit" class="form-label fw-bold">Durasi (Menit)</label>
                              <input type="number" class="form-control" id="durasi_menit" name="durasi_menit" min="1" placeholder="Contoh: 60">
                           </div>
                        </div>
                     </div>

                     <!-- Additional Settings -->
                     <div class="row mt-4">
                        <div class="col-12">
                           <h6 class="mb-3">Pengaturan Tambahan</h6>
                           <div class="row">
                              <div class="col-md-6">
                              </div>
                              <div class="col-md-6">
                                 <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="show_results_immediately" name="show_results_immediately" checked>
                                    <label class="form-check-label" for="show_results_immediately">
                                       Tampilkan hasil langsung
                                    </label>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="row mt-4">
                        <div class="col-12 text-end">
                           <button type="button" class="btn btn-secondary me-2" onclick="window.history.back()">
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

                  // Fill form fields
                  document.getElementById('deskripsi').value = sesiUjian.deskripsi || '';
                  document.getElementById('id_batch').value = sesiUjian.id_batch || '';
                  document.getElementById('mata_pelajaran').value = sesiUjian.mata_pelajaran || '';

                  // Fill datetime-local fields
                  if (sesiUjian.tanggal_mulai && sesiUjian.jam_mulai) {
                     // Convert HH:MM:SS to HH:MM for datetime-local
                     const jamMulai = sesiUjian.jam_mulai.substring(0, 5); // Remove seconds
                     const startDateTime = sesiUjian.tanggal_mulai + 'T' + jamMulai;
                     document.getElementById('tanggal_mulai').value = startDateTime;
                  }
                  if (sesiUjian.tanggal_selesai && sesiUjian.jam_selesai) {
                     // Convert HH:MM:SS to HH:MM for datetime-local
                     const jamSelesai = sesiUjian.jam_selesai.substring(0, 5); // Remove seconds
                     const endDateTime = sesiUjian.tanggal_selesai + 'T' + jamSelesai;
                     document.getElementById('tanggal_selesai').value = endDateTime;
                  }
                  document.getElementById('durasi_menit').value = sesiUjian.durasi_menit || '';
               }
            }
         } catch (error) {
            console.error('Error loading sesi ujian data:', error);
            alertSystem.error('Gagal memuat data', 'Terjadi kesalahan saat memuat data');
         }
      }

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

         // Check if mata pelajaran element exists
         const mataPelajaranElement = document.getElementById('mata_pelajaran');
         if (!mataPelajaranElement) {
            console.error('Mata pelajaran element not found!');
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
                  // Clear existing options except first
                  mataPelajaranElement.innerHTML = '<option value="">Pilih Mata Pelajaran</option>';

                  // Add options
                  result.data.forEach(mataPelajaran => {
                     const option = document.createElement('option');
                     option.value = mataPelajaran;
                     option.textContent = mataPelajaran;
                     mataPelajaranElement.appendChild(option);
                  });

                  console.log('Mata pelajaran options added successfully');
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
         const mataPelajaran = form.querySelector('#mata_pelajaran').value;
         const tanggalMulai = form.querySelector('#tanggal_mulai').value;
         const tanggalSelesai = form.querySelector('#tanggal_selesai').value;

         console.log('Form validation check:', {
            idBatch: idBatch,
            mataPelajaran: mataPelajaran,
            tanggalMulai: tanggalMulai,
            tanggalSelesai: tanggalSelesai
         });

         if (!idBatch) {
            alert('Batch harus dipilih!');
            form.querySelector('#id_batch').focus();
            return;
         }

         if (!mataPelajaran) {
            alert('Mata Pelajaran harus dipilih!');
            form.querySelector('#mata_pelajaran').focus();
            return;
         }

         if (!tanggalMulai) {
            alert('Tanggal & Jam Mulai harus diisi!');
            form.querySelector('#tanggal_mulai').focus();
            return;
         }

         if (!tanggalSelesai) {
            alert('Tanggal & Jam Selesai harus diisi!');
            form.querySelector('#tanggal_selesai').focus();
            return;
         }

         // Validasi waktu
         const startDateTime = new Date(tanggalMulai);
         const endDateTime = new Date(tanggalSelesai);

         if (endDateTime <= startDateTime) {
            alert('Waktu Selesai harus setelah Waktu Mulai!');
            form.querySelector('#tanggal_selesai').focus();
            return;
         }

         console.log('Form validation passed');

         const loadingAlert = alertSystem.loading('Memperbarui sesi ujian...');

         try {
            const formData = new FormData(event.target);

            const sesiUjianData = {
               deskripsi: formData.get('deskripsi'),
               id_batch: parseInt(formData.get('id_batch')),
               mata_pelajaran: formData.get('mata_pelajaran'),
               tanggal_mulai: formData.get('tanggal_mulai'),
               tanggal_selesai: formData.get('tanggal_selesai'),
               durasi_menit: formData.get('durasi_menit') ? parseInt(formData.get('durasi_menit')) : null
            };

            // Debug log untuk melihat data yang dikirim
            console.log('SesiUjian Data to be sent:', sesiUjianData);

            const response = await fetch(`/admin/sesi-ujian/${sesiUjianId}`, {
               method: 'PUT',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
               },
               body: JSON.stringify(sesiUjianData)
            });

            const result = await response.json();
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
      document.addEventListener('DOMContentLoaded', function() {
         console.log('DOM Content Loaded');

         // Load sesi ujian data if ID is provided
         if (sesiUjianId) {
            console.log('Loading sesi ujian data for ID:', sesiUjianId);
            loadSesiUjianData(sesiUjianId);
         } else {
            console.log('No sesiUjianId provided');
         }

         loadMataPelajaran();
         loadBatches();

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

         // Set minimum datetime to now for datetime-local
         const now = new Date();
         const nowString = now.toISOString().slice(0, 16); // Format: YYYY-MM-DDTHH:MM

         if (tanggalMulai) {
            tanggalMulai.min = nowString;
         }
         if (tanggalSelesai) {
            tanggalSelesai.min = nowString;
         }

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

</body>

</html>
