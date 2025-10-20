<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Edit Laporan - Ujian Online</title>
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

      .page-header {
         background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
         color: white;
         border-radius: 10px;
         padding: 1.5rem;
         margin-bottom: 2rem;
      }

      .form-section {
         background: #f8f9fa;
         border-radius: 10px;
         padding: 1.5rem;
         margin-bottom: 1.5rem;
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
         <div class="p-4" data-report-id="{{ $id ?? '' }}">
            <!-- Page Header -->
            <div class="page-header">
               <div class="row align-items-center">
                  <div class="col-md-8">
                     <h4 class="mb-2"><i class="bi bi-pencil-square me-2"></i>Edit Laporan</h4>
                     <p class="mb-0">Ubah informasi laporan</p>
                  </div>
                  <div class="col-md-4 text-end">
                     <a href="{{ route('admin.reports.index') }}" class="btn btn-light">
                        <i class="bi bi-arrow-left me-1"></i>
                        Kembali
                     </a>
                  </div>
               </div>
            </div>

            <!-- Form -->
            <div class="card">
               <div class="card-body">
                  <form id="editReportForm">
                     <div class="row">
                        <!-- Report Information -->
                        <div class="col-md-6">
                           <div class="form-section">
                              <h6 class="mb-3"><i class="bi bi-file-text me-2"></i>Informasi Laporan</h6>
                              <div class="mb-3">
                                 <label for="judul_laporan" class="form-label fw-bold">Judul Laporan <span class="text-danger">*</span></label>
                                 <input type="text" class="form-control" id="judul_laporan" name="judul_laporan" required>
                              </div>
                              <div class="mb-3">
                                 <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                                 <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Deskripsi laporan..."></textarea>
                              </div>
                              <div class="mb-3">
                                 <label for="tipe_laporan" class="form-label fw-bold">Tipe Laporan <span class="text-danger">*</span></label>
                                 <select class="form-select" id="tipe_laporan" name="tipe_laporan" required>
                                    <option value="">Pilih Tipe Laporan</option>
                                    <option value="hasil_ujian">Hasil Ujian</option>
                                    <option value="statistik_peserta">Statistik Peserta</option>
                                    <option value="analisis_soal">Analisis Soal</option>
                                    <option value="laporan_kehadiran">Laporan Kehadiran</option>
                                    <option value="laporan_umum">Laporan Umum</option>
                                 </select>
                              </div>
                              <div class="mb-3">
                                 <label for="periode_mulai" class="form-label fw-bold">Periode Mulai</label>
                                 <input type="date" class="form-control" id="periode_mulai" name="periode_mulai">
                              </div>
                              <div class="mb-3">
                                 <label for="periode_selesai" class="form-label fw-bold">Periode Selesai</label>
                                 <input type="date" class="form-control" id="periode_selesai" name="periode_selesai">
                              </div>
                           </div>
                        </div>

                        <!-- Report Settings -->
                        <div class="col-md-6">
                           <div class="form-section">
                              <h6 class="mb-3"><i class="bi bi-gear me-2"></i>Pengaturan Laporan</h6>
                              <div class="mb-3">
                                 <label for="format_laporan" class="form-label fw-bold">Format Laporan <span class="text-danger">*</span></label>
                                 <select class="form-select" id="format_laporan" name="format_laporan" required>
                                    <option value="">Pilih Format</option>
                                    <option value="pdf">PDF</option>
                                    <option value="excel">Excel</option>
                                    <option value="csv">CSV</option>
                                    <option value="html">HTML</option>
                                 </select>
                              </div>
                              <div class="mb-3">
                                 <label for="level_detail" class="form-label fw-bold">Level Detail</label>
                                 <select class="form-select" id="level_detail" name="level_detail">
                                    <option value="ringkas">Ringkas</option>
                                    <option value="lengkap">Lengkap</option>
                                    <option value="detail">Sangat Detail</option>
                                 </select>
                              </div>
                              <div class="mb-3">
                                 <label for="include_chart" class="form-label fw-bold">Include Chart/Grafik</label>
                                 <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="include_chart" name="include_chart">
                                    <label class="form-check-label" for="include_chart">
                                       Sertakan grafik dan chart
                                    </label>
                                 </div>
                              </div>
                              <div class="mb-3">
                                 <label for="include_statistik" class="form-label fw-bold">Include Statistik</label>
                                 <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="include_statistik" name="include_statistik">
                                    <label class="form-check-label" for="include_statistik">
                                       Sertakan statistik detail
                                    </label>
                                 </div>
                              </div>
                              <div class="mb-3">
                                 <label for="status" class="form-label fw-bold">Status</label>
                                 <select class="form-select" id="status" name="status">
                                    <option value="draft">Draft</option>
                                    <option value="aktif">Aktif</option>
                                    <option value="arsip">Arsip</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                     </div>

                     <!-- Filter Options -->
                     <div class="row">
                        <div class="col-12">
                           <div class="form-section">
                              <h6 class="mb-3"><i class="bi bi-funnel me-2"></i>Filter Data</h6>
                              <div class="row">
                                 <div class="col-md-4">
                                    <div class="mb-3">
                                       <label for="filter_batch" class="form-label fw-bold">Filter Batch</label>
                                       <select class="form-select" id="filter_batch" name="filter_batch">
                                          <option value="">Semua Batch</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="mb-3">
                                       <label for="filter_sesi" class="form-label fw-bold">Filter Sesi Ujian</label>
                                       <select class="form-select" id="filter_sesi" name="filter_sesi">
                                          <option value="">Semua Sesi</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="mb-3">
                                       <label for="filter_peserta" class="form-label fw-bold">Filter Peserta</label>
                                       <select class="form-select" id="filter_peserta" name="filter_peserta">
                                          <option value="">Semua Peserta</option>
                                          <option value="lulus">Lulus</option>
                                          <option value="tidak_lulus">Tidak Lulus</option>
                                       </select>
                                    </div>
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
                              Update Laporan
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
      const reportId = document.querySelector('[data-report-id]').getAttribute('data-report-id');

      // Load report data for editing
      async function loadReportData(id) {
         try {
            const response = await fetch(`/admin/reports/${id}`, {
               method: 'GET',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
               }
            });

            if (response.ok) {
               const result = await response.json();
               if (result.success) {
                  const report = result.data;

                  // Fill form fields
                  document.getElementById('judul_laporan').value = report.judul_laporan || '';
                  document.getElementById('deskripsi').value = report.deskripsi || '';
                  document.getElementById('tipe_laporan').value = report.tipe_laporan || '';
                  document.getElementById('periode_mulai').value = report.periode_mulai || '';
                  document.getElementById('periode_selesai').value = report.periode_selesai || '';
                  document.getElementById('format_laporan').value = report.format_laporan || '';
                  document.getElementById('level_detail').value = report.level_detail || 'lengkap';
                  document.getElementById('include_chart').checked = report.include_chart || false;
                  document.getElementById('include_statistik').checked = report.include_statistik || false;
                  document.getElementById('status').value = report.status || 'aktif';
                  document.getElementById('filter_batch').value = report.filter_batch || '';
                  document.getElementById('filter_sesi').value = report.filter_sesi || '';
                  document.getElementById('filter_peserta').value = report.filter_peserta || '';
               }
            }
         } catch (error) {
            console.error('Error loading report data:', error);
            alertSystem.error('Gagal memuat data', 'Terjadi kesalahan saat memuat data');
         }
      }

      // Load filter data
      async function loadFilterData() {
         try {
            // Load batches
            const batchResponse = await fetch('/admin/participants/batches', {
               method: 'GET',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
               }
            });

            if (batchResponse.ok) {
               const batchResult = await batchResponse.json();
               if (batchResult.success && batchResult.data) {
                  const batchSelect = document.getElementById('filter_batch');
                  batchResult.data.forEach(batch => {
                     const option = document.createElement('option');
                     option.value = batch.id;
                     option.textContent = batch.nama_batch;
                     batchSelect.appendChild(option);
                  });
               }
            }

            // Load sesi ujian
            const sesiUjianResponse = await fetch('/admin/sesi-ujian/data', {
               method: 'GET',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
               }
            });

            if (sesiUjianResponse.ok) {
               const sesiUjianResult = await sesiUjianResponse.json();
               if (sesiUjianResult.success && sesiUjianResult.data) {
                  const sesiUjianSelect = document.getElementById('filter_sesi');
                  sesiUjianResult.data.forEach(sesiUjian => {
                     const option = document.createElement('option');
                     option.value = sesiUjian.id;
                     option.textContent = sesiUjian.nama_ujian;
                     sesiUjianSelect.appendChild(option);
                  });
               }
            }
         } catch (error) {
            console.error('Error loading filter data:', error);
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
         const judulLaporan = form.querySelector('#judul_laporan').value.trim();
         const tipeLaporan = form.querySelector('#tipe_laporan').value;
         const formatLaporan = form.querySelector('#format_laporan').value;

         if (!judulLaporan) {
            alert('Judul Laporan harus diisi!');
            form.querySelector('#judul_laporan').focus();
            return;
         }

         if (!tipeLaporan) {
            alert('Tipe Laporan harus dipilih!');
            form.querySelector('#tipe_laporan').focus();
            return;
         }

         if (!formatLaporan) {
            alert('Format Laporan harus dipilih!');
            form.querySelector('#format_laporan').focus();
            return;
         }

         // Validasi periode
         const periodeMulai = form.querySelector('#periode_mulai').value;
         const periodeSelesai = form.querySelector('#periode_selesai').value;

         if (periodeMulai && periodeSelesai && new Date(periodeSelesai) < new Date(periodeMulai)) {
            alert('Periode Selesai harus setelah atau sama dengan Periode Mulai!');
            form.querySelector('#periode_selesai').focus();
            return;
         }

         console.log('Form validation passed');

         const loadingAlert = alertSystem.loading('Memperbarui laporan...');

         try {
            const formData = new FormData(event.target);

            const reportData = {
               judul_laporan: formData.get('judul_laporan'),
               deskripsi: formData.get('deskripsi'),
               tipe_laporan: formData.get('tipe_laporan'),
               periode_mulai: formData.get('periode_mulai'),
               periode_selesai: formData.get('periode_selesai'),
               format_laporan: formData.get('format_laporan'),
               level_detail: formData.get('level_detail'),
               include_chart: formData.get('include_chart') ? true : false,
               include_statistik: formData.get('include_statistik') ? true : false,
               status: formData.get('status'),
               filter_batch: formData.get('filter_batch'),
               filter_sesi: formData.get('filter_sesi'),
               filter_peserta: formData.get('filter_peserta')
            };

            console.log('Report Data to be sent:', reportData);

            const response = await fetch(`/admin/reports/${reportId}`, {
               method: 'PUT',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
               },
               body: JSON.stringify(reportData)
            });

            const result = await response.json();
            alertSystem.hide(loadingAlert);

            if (result.success) {
               alertSystem.updateSuccess('Laporan');

               // Redirect to index page
               window.location.href = '{{ route("admin.reports.index") }}';
            } else {
               alertSystem.error('Gagal menyimpan', result.message || 'Terjadi kesalahan');
            }
         } catch (error) {
            console.error('Error saving report:', error);
            alertSystem.hide(loadingAlert);
            alertSystem.error('Gagal menyimpan', 'Terjadi kesalahan jaringan: ' + error.message);
         }
      }

      // Initialize on page load
      document.addEventListener('DOMContentLoaded', function() {
         console.log('DOM Content Loaded');

         // Load report data if ID is provided
         if (reportId) {
            loadReportData(reportId);
         }

         loadFilterData();

         // Add form listeners
         const editForm = document.getElementById('editReportForm');

         if (editForm) {
            editForm.addEventListener('submit', handleEditForm);
         }

         // Add real-time validation for form fields
         const requiredFields = ['judul_laporan', 'tipe_laporan', 'format_laporan'];

         requiredFields.forEach(fieldName => {
            const field = document.getElementById(fieldName);
            if (field) {
               field.addEventListener('input', function() {
                  if (this.value.trim()) {
                     this.classList.remove('is-invalid');
                     this.classList.add('is-valid');
                  } else {
                     this.classList.remove('is-valid');
                     this.classList.add('is-invalid');
                  }
               });
            }
         });
      });
   </script>

</body>

</html>
