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

                  // Fill form fields (ensure options exist first)
                  document.getElementById('deskripsi').value = sesiUjian.deskripsi || '';

                  // Mata pelajaran: set value if option exists, else prepend option then select
                  const mpSelect = document.getElementById('mata_pelajaran');
                  if (mpSelect) {
                     const exists = Array.from(mpSelect.options).some(o => o.value === sesiUjian.mata_pelajaran);
                     if (!exists && sesiUjian.mata_pelajaran) {
                        const opt = document.createElement('option');
                        opt.value = sesiUjian.mata_pelajaran;
                        opt.textContent = sesiUjian.mata_pelajaran;
                        mpSelect.insertBefore(opt, mpSelect.firstChild);
                     }
                     mpSelect.value = sesiUjian.mata_pelajaran || '';
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

                  if (sesiUjian.tanggal_mulai && sesiUjian.jam_mulai) {
                     // Extract date part (YYYY-MM-DD) from tanggal_mulai
                     const tanggalMulai = sesiUjian.tanggal_mulai.split(' ')[0]; // Get date part only
                     // Extract time part (HH:MM) from jam_mulai (format: HH:MM:SS)
                     const jamMulai = sesiUjian.jam_mulai.substring(0, 5); // Get HH:MM from HH:MM:SS
                     const startDateTime = tanggalMulai + 'T' + jamMulai;
                     console.log('Setting tanggal_mulai:', startDateTime);

                     const tanggalMulaiElement = document.getElementById('tanggal_mulai');
                     if (tanggalMulaiElement) {
                        tanggalMulaiElement.value = startDateTime;
                        console.log('Tanggal mulai element value set to:', tanggalMulaiElement.value);
                     } else {
                        console.error('Tanggal mulai element not found!');
                     }
                  } else {
                     console.log('Missing data for tanggal_mulai or jam_mulai');
                  }

                  if (sesiUjian.tanggal_selesai && sesiUjian.jam_selesai) {
                     // Extract date part (YYYY-MM-DD) from tanggal_selesai
                     const tanggalSelesai = sesiUjian.tanggal_selesai.split(' ')[0]; // Get date part only
                     // Extract time part (HH:MM) from jam_selesai (format: HH:MM:SS)
                     const jamSelesai = sesiUjian.jam_selesai.substring(0, 5); // Get HH:MM from HH:MM:SS
                     const endDateTime = tanggalSelesai + 'T' + jamSelesai;
                     console.log('Setting tanggal_selesai:', endDateTime);

                     const tanggalSelesaiElement = document.getElementById('tanggal_selesai');
                     if (tanggalSelesaiElement) {
                        tanggalSelesaiElement.value = endDateTime;
                        console.log('Tanggal selesai element value set to:', tanggalSelesaiElement.value);
                     } else {
                        console.error('Tanggal selesai element not found!');
                     }
                  } else {
                     console.log('Missing data for tanggal_selesai or jam_selesai');
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