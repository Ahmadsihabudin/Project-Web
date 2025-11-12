<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Edit Sesi Ujian - Ujian Online</title>
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

      @include('layouts.sidebar')


      <div class="main-content">

         @include('layouts.navbar')


         <div class="p-4" data-sesi-ujian-id="{{ $id ?? '' }}">

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


            <div class="card">
               <div class="card-body">
                  <form id="editSessionForm">
                     <div class="row">

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
      if (typeof csrfToken === 'undefined') {
         var csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
      }
      const sesiUjianId = document.querySelector('[data-sesi-ujian-id]').getAttribute('data-sesi-ujian-id');

      async function loadSesiUjianData(id) {
         try {
            const response = await fetch(`/admin/sesi-ujian/${id}/data`, {
               method: 'GET',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
               }
            });

            if (response.ok) {
               const result = await response.json();
               if (result.success) {
                  const sesiUjian = result.data;

                  document.getElementById('deskripsi').value = sesiUjian.deskripsi || '';

                  if (sesiUjian.mata_pelajaran) {
                     const mataPelajaranArray = sesiUjian.mata_pelajaran.split(',').map(s => s.trim()).filter(s => s !== '');
                     selectedMataPelajaran = Array.isArray(mataPelajaranArray) ? mataPelajaranArray : [];

                     setTimeout(() => {
                        selectedMataPelajaran.forEach(mataPelajaran => {
                           const checkboxes = document.querySelectorAll('input[type="checkbox"][id^="mata_pelajaran_"]');
                           checkboxes.forEach(checkbox => {
                              if (checkbox.value === mataPelajaran) {
                                 checkbox.checked = true;
                              }
                           });
                        });
                        // Update selection after checkboxes are checked
                        updateMataPelajaranSelection();
                     }, 100); // Small delay to ensure checkboxes are rendered
                  } else {
                     selectedMataPelajaran = [];
                  }

                  if (sesiUjian.hide_nomor_urut) {
                     document.getElementById('hide_nomor_urut').checked = true;
                  }
                  if (sesiUjian.hide_poin) {
                     document.getElementById('hide_poin').checked = true;
                  }
                  if (sesiUjian.hide_mata_pelajaran) {
                     document.getElementById('hide_mata_pelajaran').checked = true;
                  }

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

                  if (sesiUjian.tanggal_mulai && sesiUjian.jam_mulai) {
                     const tanggalMulai = sesiUjian.tanggal_mulai.split(' ')[0];
                     const jamMulai = sesiUjian.jam_mulai.substring(0, 5);

                     const tanggalMulaiDateInput = document.getElementById('tanggal_mulai_date');
                     const tanggalMulaiTimeInput = document.getElementById('tanggal_mulai_time');

                     if (tanggalMulaiDateInput) {
                        tanggalMulaiDateInput.value = tanggalMulai;
                        tanggalMulaiDateInput.removeAttribute('min'); // Remove min restriction for editing
                     }
                     if (tanggalMulaiTimeInput) {
                        tanggalMulaiTimeInput.value = jamMulai;
                     }

                     const combinedDateTime = tanggalMulai + ' ' + jamMulai;
                     document.getElementById('tanggal_mulai').value = combinedDateTime;
                     document.getElementById('tanggalMulaiDisplay').textContent = combinedDateTime;
                     tanggalMulaiValue = combinedDateTime;
                  }

                  if (sesiUjian.tanggal_selesai && sesiUjian.jam_selesai) {
                     const tanggalSelesai = sesiUjian.tanggal_selesai.split(' ')[0];
                     const jamSelesai = sesiUjian.jam_selesai.substring(0, 5);

                     const tanggalSelesaiDateInput = document.getElementById('tanggal_selesai_date');
                     const tanggalSelesaiTimeInput = document.getElementById('tanggal_selesai_time');

                     if (tanggalSelesaiDateInput) {
                        tanggalSelesaiDateInput.value = tanggalSelesai;
                        tanggalSelesaiDateInput.removeAttribute('min'); // Remove min restriction for editing
                     }
                     if (tanggalSelesaiTimeInput) {
                        tanggalSelesaiTimeInput.value = jamSelesai;
                     }

                     const combinedDateTime = tanggalSelesai + ' ' + jamSelesai;
                     document.getElementById('tanggal_selesai').value = combinedDateTime;
                     document.getElementById('tanggalSelesaiDisplay').textContent = combinedDateTime;
                     tanggalSelesaiValue = combinedDateTime;
                  }
                  document.getElementById('durasi_menit').value = sesiUjian.durasi_menit || '';

                  setTimeout(function() {
                     calculateDuration();
                  }, 500);
               }
            }
         } catch (error) {
            alertSystem.error('Gagal memuat data', 'Terjadi kesalahan saat memuat data');
         }
      }

      let selectedMataPelajaran = [];

      let tanggalMulaiValue = '';
      let tanggalSelesaiValue = '';

      async function loadMataPelajaran() {
         const refreshIcon = document.getElementById('refreshMataPelajaranIcon');
         const refreshSpinner = document.getElementById('refreshMataPelajaranSpinner');
         if (refreshIcon && refreshSpinner) {
            refreshIcon.classList.add('d-none');
            refreshSpinner.classList.remove('d-none');
         }

         const mataPelajaranList = document.getElementById('mataPelajaranList');
         if (!mataPelajaranList) {
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
               if (result.success && result.data) {
                  renderMataPelajaranList(result.data);
               } else {
                  alertSystem.error('Gagal memuat mata pelajaran', result.message || 'Terjadi kesalahan');
               }
            } else {
               alertSystem.error('Gagal memuat mata pelajaran', 'Terjadi kesalahan saat memuat data');
            }
         } catch (error) {
            alertSystem.error('Gagal memuat mata pelajaran', 'Terjadi kesalahan jaringan: ' + error.message);
         } finally {
            if (refreshIcon && refreshSpinner) {
               refreshIcon.classList.remove('d-none');
               refreshSpinner.classList.add('d-none');
            }
         }
      }

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

      function updateMataPelajaranSelection() {
         const checkboxes = document.querySelectorAll('input[name="mata_pelajaran[]"]:checked, input[type="checkbox"][id^="mata_pelajaran_"]:checked');
         selectedMataPelajaran = Array.from(checkboxes).map(cb => cb.value).filter(val => val && val.trim() !== '');

         // Ensure it's always an array
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
               if (durasiInput) durasiInput.value = '';
               if (durasiInfo) durasiInfo.textContent = '';
            }
         } catch (error) {
            if (durasiInput) durasiInput.value = '';
            if (durasiInfo) durasiInfo.textContent = '';
         }
      }

      function selectAllMataPelajaran() {
         const checkboxes = document.querySelectorAll('input[type="checkbox"][id^="mata_pelajaran_"]');
         checkboxes.forEach(cb => {
            cb.checked = true;
         });
         updateMataPelajaranSelection();
      }

      function deselectAllMataPelajaran() {
         const checkboxes = document.querySelectorAll('input[type="checkbox"][id^="mata_pelajaran_"]');
         checkboxes.forEach(cb => {
            cb.checked = false;
         });
         selectedMataPelajaran = [];
      }

      async function setTanggalMulai() {
         const date = document.getElementById('tanggal_mulai_date').value;
         const time = document.getElementById('tanggal_mulai_time').value;

         if (date && time) {
            const datetime = date + ' ' + time;
            tanggalMulaiValue = datetime;
            document.getElementById('tanggal_mulai').value = datetime;
            document.getElementById('tanggalMulaiDisplay').textContent = datetime;

            document.getElementById('tanggal_selesai_date').value = date;

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

      async function setTanggalSelesai() {
         const date = document.getElementById('tanggal_selesai_date').value;
         const time = document.getElementById('tanggal_selesai_time').value;

         if (date && time) {
            const datetime = date + ' ' + time;
            tanggalSelesaiValue = datetime;
            document.getElementById('tanggal_selesai').value = datetime;
            document.getElementById('tanggalSelesaiDisplay').textContent = datetime;

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

      async function loadBatches() {

         const refreshIcon = document.getElementById('refreshIcon');
         const refreshSpinner = document.getElementById('refreshSpinner');
         if (refreshIcon && refreshSpinner) {
            refreshIcon.classList.add('d-none');
            refreshSpinner.classList.remove('d-none');
         }

         const batchElement = document.getElementById('id_batch');
         if (!batchElement) {
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

                  }
               }
            } else {}
         } catch (error) {} finally {
            if (refreshIcon && refreshSpinner) {
               refreshIcon.classList.remove('d-none');
               refreshSpinner.classList.add('d-none');
            }
         }
      }

      async function handleEditForm(event) {
         event.preventDefault();

         const form = event.target;
         if (!form.checkValidity()) {
            form.reportValidity();
            return;
         }

         const idBatch = form.querySelector('#id_batch').value;

         // Get tanggal and jam from date and time inputs directly
         const tanggalMulaiDate = form.querySelector('#tanggal_mulai_date').value;
         const tanggalMulaiTime = form.querySelector('#tanggal_mulai_time').value;
         const tanggalSelesaiDate = form.querySelector('#tanggal_selesai_date').value;
         const tanggalSelesaiTime = form.querySelector('#tanggal_selesai_time').value;

         // Combine date and time - prioritize input values over hidden field
         let tanggalMulai = (tanggalMulaiDate && tanggalMulaiTime) ? (tanggalMulaiDate + ' ' + tanggalMulaiTime) : form.querySelector('#tanggal_mulai').value;
         let tanggalSelesai = (tanggalSelesaiDate && tanggalSelesaiTime) ? (tanggalSelesaiDate + ' ' + tanggalSelesaiTime) : form.querySelector('#tanggal_selesai').value;

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

         // Validate tanggal and jam from inputs
         if (!tanggalMulaiDate || !tanggalMulaiTime) {
            await Swal.fire({
               icon: 'warning',
               title: 'Validasi Gagal',
               text: 'Tanggal & Jam Mulai harus diisi!',
               confirmButtonText: 'OK',
               confirmButtonColor: '#991B1B'
            });
            return;
         }

         if (!tanggalSelesaiDate || !tanggalSelesaiTime) {
            await Swal.fire({
               icon: 'warning',
               title: 'Validasi Gagal',
               text: 'Tanggal & Jam Selesai harus diisi!',
               confirmButtonText: 'OK',
               confirmButtonColor: '#991B1B'
            });
            return;
         }

         // Ensure we have the combined datetime values
         if (!tanggalMulai) {
            tanggalMulai = tanggalMulaiDate + ' ' + tanggalMulaiTime;
         }
         if (!tanggalSelesai) {
            tanggalSelesai = tanggalSelesaiDate + ' ' + tanggalSelesaiTime;
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

         const loadingAlert = alertSystem.loading('Memperbarui sesi ujian...');

         try {
            const formData = new FormData(event.target);

            // Update mata pelajaran selection
            updateMataPelajaranSelection();

            // Validate selectedMataPelajaran is an array and not empty
            if (!Array.isArray(selectedMataPelajaran) || selectedMataPelajaran.length === 0) {
               alertSystem.hide(loadingAlert);
               await Swal.fire({
                  icon: 'warning',
                  title: 'Validasi Gagal',
                  text: 'Minimal satu Mata Pelajaran harus dipilih!',
                  confirmButtonText: 'OK',
                  confirmButtonColor: '#991B1B'
               });
               return;
            }

            // Validate id_batch
            const idBatchValue = formData.get('id_batch');
            const idBatch = idBatchValue ? parseInt(idBatchValue) : null;
            if (!idBatch || isNaN(idBatch)) {
               alertSystem.hide(loadingAlert);
               await Swal.fire({
                  icon: 'warning',
                  title: 'Validasi Gagal',
                  text: 'Batch harus dipilih!',
                  confirmButtonText: 'OK',
                  confirmButtonColor: '#991B1B'
               });
               return;
            }

            // Validate tanggal_mulai and tanggal_selesai
            if (!tanggalMulai || !tanggalSelesai) {
               alertSystem.hide(loadingAlert);
               await Swal.fire({
                  icon: 'warning',
                  title: 'Validasi Gagal',
                  text: 'Tanggal & Jam Mulai dan Selesai harus diisi! Klik tombol "Set" setelah memilih tanggal dan jam.',
                  confirmButtonText: 'OK',
                  confirmButtonColor: '#991B1B'
               });
               return;
            }

            // Validate date format
            const startDate = new Date(tanggalMulai);
            const endDate = new Date(tanggalSelesai);
            if (isNaN(startDate.getTime()) || isNaN(endDate.getTime())) {
               alertSystem.hide(loadingAlert);
               await Swal.fire({
                  icon: 'warning',
                  title: 'Validasi Gagal',
                  text: 'Format tanggal tidak valid! Pastikan tanggal dan jam sudah diisi dengan benar.',
                  confirmButtonText: 'OK',
                  confirmButtonColor: '#991B1B'
               });
               return;
            }

            // Ensure tanggal_mulai and tanggal_selesai are properly formatted from date and time inputs
            const finalTanggalMulai = tanggalMulai || (tanggalMulaiDate && tanggalMulaiTime ? (tanggalMulaiDate + ' ' + tanggalMulaiTime) : null);
            const finalTanggalSelesai = tanggalSelesai || (tanggalSelesaiDate && tanggalSelesaiTime ? (tanggalSelesaiDate + ' ' + tanggalSelesaiTime) : null);

            const sesiUjianData = {
               deskripsi: formData.get('deskripsi') || '',
               id_batch: idBatch,
               mata_pelajaran: selectedMataPelajaran,
               tanggal_mulai: finalTanggalMulai,
               tanggal_selesai: finalTanggalSelesai,
               durasi_menit: formData.get('durasi_menit') ? parseInt(formData.get('durasi_menit')) : null,
               hide_nomor_urut: document.getElementById('hide_nomor_urut').checked ? 1 : 0,
               hide_poin: document.getElementById('hide_poin').checked ? 1 : 0,
               hide_mata_pelajaran: document.getElementById('hide_mata_pelajaran').checked ? 1 : 0
            };

            // Debug log
            console.log('Data yang akan dikirim:', sesiUjianData);

            const response = await fetch(`/admin/sesi-ujian/${sesiUjianId}`, {
               method: 'PUT',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken,
                  'Accept': 'application/json'
               },
               body: JSON.stringify(sesiUjianData)
            });

            const contentType = response.headers.get('content-type');
            if (!contentType || !contentType.includes('application/json')) {
               const textResponse = await response.text();
               alertSystem.hide(loadingAlert);
               alertSystem.error('Gagal menyimpan', 'Server mengembalikan response yang tidak valid. Status: ' + response.status);
               return;
            }

            const result = await response.json();
            alertSystem.hide(loadingAlert);

            if (result.success) {
               alertSystem.updateSuccess('Sesi Ujian');

               window.location.href = '{{ route("admin.sesi-ujian.index") }}';
            } else {
               // Display validation errors if available
               let errorMessage = result.message || 'Terjadi kesalahan';
               if (result.errors) {
                  const errorMessages = Object.values(result.errors).flat().join('<br>');
                  if (errorMessages) {
                     errorMessage = errorMessages;
                  }
               }
               alertSystem.error('Gagal menyimpan', errorMessage);
            }
         } catch (error) {
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

      document.addEventListener('DOMContentLoaded', async function() {

         if (sesiUjianId) {
            await loadMataPelajaran();
            await loadBatches();
            await loadSesiUjianData(sesiUjianId);
         } else {
            loadMataPelajaran();
            loadBatches();
         }

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
               loadBatches();
            });
         }
         if (refreshMataPelajaranBtn) {
            refreshMataPelajaranBtn.addEventListener('click', function() {
               loadMataPelajaran();
            });
         }

         const selectAllBtn = document.getElementById('selectAllMataPelajaran');
         const deselectAllBtn = document.getElementById('deselectAllMataPelajaran');

         if (selectAllBtn) {
            selectAllBtn.addEventListener('click', selectAllMataPelajaran);
         }

         if (deselectAllBtn) {
            deselectAllBtn.addEventListener('click', deselectAllMataPelajaran);
         }

         const idBatchSelect = document.getElementById('id_batch');
         if (idBatchSelect) {
            idBatchSelect.addEventListener('change', function() {
               calculateDuration();
               if (this.value) {
                  this.classList.remove('is-invalid');
                  this.classList.add('is-valid');
               } else {
                  this.classList.remove('is-valid');
                  this.classList.add('is-invalid');
               }
            });
         }

         const setTanggalMulaiBtn = document.getElementById('setTanggalMulaiBtn');
         const setTanggalSelesaiBtn = document.getElementById('setTanggalSelesaiBtn');

         if (setTanggalMulaiBtn) {
            setTanggalMulaiBtn.addEventListener('click', setTanggalMulai);
         }

         if (setTanggalSelesaiBtn) {
            setTanggalSelesaiBtn.addEventListener('click', setTanggalSelesai);
         }

         // For edit form, allow past dates to be edited
         // Remove min date restriction to allow editing existing dates
         const dateInputs = document.querySelectorAll('input[type="date"]');
         dateInputs.forEach(input => {
            // Remove min restriction to allow editing past dates
            input.removeAttribute('min');
         });


      });
   </script>

   @include('layouts.logout-script')

</body>

</html>