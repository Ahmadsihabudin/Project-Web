<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Info Ujian - Ujian Online</title>
   <meta name="csrf-token" content="{{ csrf_token() }}">

   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

   <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
   @include('layouts.alert-system')
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

   <link rel="icon" type="image/png" href="{{ asset('images/Favicon_akti.png') }}">

   <style>
      .page-header {
         background: #f8f9fa;
         color: #333;
         border-radius: 10px;
         padding: 1.5rem;
         margin-bottom: 2rem;
      }

      .card {
         border: none;
         box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
         border-radius: 0.5rem;
         margin-bottom: 1.5rem;
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

      .form-label {
         font-weight: 600;
         color: #495057;
         margin-bottom: 0.5rem;
      }

      .form-control:focus {
         border-color: #991B1B;
         box-shadow: 0 0 0 0.2rem rgba(153, 27, 27, 0.25);
      }

      .theme-btn {
         padding: 0.5rem 1rem;
         border: 2px solid #74292a;
         color: #292929;
         text-transform: capitalize;
         font-weight: 400;
         border-radius: 0.375rem;
         transition: 0.4s cubic-bezier(0, 0, 1, 1);
         position: relative;
         z-index: 1;
         background: white;
         font-size: 0.875rem;
      }

      .theme-btn i {
         margin-left: 7px;
      }

      .theme-btn:hover {
         color: #fff;
         border-color: white;
      }

      .theme-btn::before {
         position: absolute;
         z-index: -1;
         content: "";
         background-color: #74292a;
         height: 0%;
         width: 0%;
         top: 50%;
         left: 50%;
         transform: translate(-50%, -50%);
         opacity: 0;
         transition: 0.4s cubic-bezier(0, 0, 1, 1);
         border-radius: 0.375rem;
      }

      .theme-btn:hover::before {
         opacity: 1;
         width: 98%;
         height: 96%;
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
      @include('layouts.sidebar')

      <div class="main-content">
         @include('layouts.navbar')

         <div class="p-4">
            <div class="page-header">
               <h2><i class="bi bi-info-circle me-2" style="color: #991B1B;"></i> Info Ujian</h2>
               <p class="mb-0">Kelola informasi dan peringatan yang ditampilkan kepada peserta sebelum memulai ujian</p>
            </div>
            <div class="card">
               <div class="card-header">
                  <h6 class="m-0 font-weight-bold">
                     <i class="bi bi-exclamation-triangle me-2"></i>
                     Peringatan Penting
                  </h6>
               </div>
               <div class="card-body">
                  <form id="infoUjianForm">
                     <div class="mb-3">
                        <label for="warning_waktu" class="form-label">
                           <i class="bi bi-clock me-1"></i>Waktu Terbatas
                        </label>
                        <textarea class="form-control" id="warning_waktu" rows="3" placeholder="Masukkan teks peringatan waktu terbatas"></textarea>
                        <small class="form-text text-muted">Teks yang akan ditampilkan untuk peringatan waktu terbatas</small>
                     </div>

                     <div class="mb-3">
                        <label for="warning_integritas" class="form-label">
                           <i class="bi bi-shield-exclamation me-1"></i>Integritas Ujian
                        </label>
                        <textarea class="form-control" id="warning_integritas" rows="3" placeholder="Masukkan teks peringatan integritas ujian"></textarea>
                        <small class="form-text text-muted">Teks yang akan ditampilkan untuk peringatan integritas ujian</small>
                     </div>

                     <div class="mb-3">
                        <label for="warning_navigasi" class="form-label">
                           <i class="bi bi-arrow-left-right me-1"></i>Navigasi Terbatas
                        </label>
                        <textarea class="form-control" id="warning_navigasi" rows="3" placeholder="Masukkan teks peringatan navigasi terbatas"></textarea>
                        <small class="form-text text-muted">Teks yang akan ditampilkan untuk peringatan navigasi terbatas</small>
                     </div>

                     <div class="mb-3">
                        <label for="warning_konfirmasi" class="form-label">
                           <i class="bi bi-check-circle me-1"></i>Konfirmasi Jawaban
                        </label>
                        <textarea class="form-control" id="warning_konfirmasi" rows="3" placeholder="Masukkan teks peringatan konfirmasi jawaban"></textarea>
                        <small class="form-text text-muted">Teks yang akan ditampilkan untuk peringatan konfirmasi jawaban</small>
                     </div>

                     <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-secondary" onclick="resetForm()">
                           <i class="bi bi-arrow-counterclockwise me-1"></i>Reset
                        </button>
                        <button type="button" class="theme-btn" onclick="saveInfoUjian()">
                           <i class="bi bi-save me-1"></i>Simpan Perubahan
                        </button>
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

      async function loadInfoUjian() {
         try {
            const response = await fetch('/admin/settings/api/info-ujian', {
               method: 'GET',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
               },
               credentials: 'same-origin'
            });

            if (response.ok) {
               const result = await response.json();
               if (result.success && result.data) {
                  const data = result.data;
                  document.getElementById('warning_waktu').value = data.warning_waktu || '';
                  document.getElementById('warning_integritas').value = data.warning_integritas || '';
                  document.getElementById('warning_navigasi').value = data.warning_navigasi || '';
                  document.getElementById('warning_konfirmasi').value = data.warning_konfirmasi || '';
               } else {
                  console.error('Failed to load info ujian:', result.message);
               }
            } else {
               console.error('HTTP error loading info ujian:', response.status);
            }
         } catch (error) {
            console.error('Error loading info ujian:', error);
         }
      }

      async function saveInfoUjian() {
         const data = {
            warning_waktu: document.getElementById('warning_waktu').value,
            warning_integritas: document.getElementById('warning_integritas').value,
            warning_navigasi: document.getElementById('warning_navigasi').value,
            warning_konfirmasi: document.getElementById('warning_konfirmasi').value
         };

         try {
            const response = await fetch('/admin/settings/api/info-ujian', {
               method: 'POST',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
               },
               body: JSON.stringify(data),
               credentials: 'same-origin'
            });

            const result = await response.json();
            if (result.success) {
               await Swal.fire({
                  title: 'Berhasil',
                  text: 'Info ujian berhasil diperbarui',
                  icon: 'success',
                  confirmButtonText: 'OK',
                  confirmButtonColor: '#0d6efd'
               });
            } else {
               Swal.fire({
                  title: 'Gagal',
                  text: result.message || 'Terjadi kesalahan saat menyimpan',
                  icon: 'error',
                  confirmButtonText: 'OK'
               });
            }
         } catch (error) {
            console.error('Error saving info ujian:', error);
            Swal.fire({
               title: 'Gagal',
               text: 'Terjadi kesalahan jaringan',
               icon: 'error',
               confirmButtonText: 'OK'
            });
         }
      }

      function resetForm() {
         if (confirm('Apakah Anda yakin ingin mereset form? Perubahan yang belum disimpan akan hilang.')) {
            loadInfoUjian();
         }
      }

      document.addEventListener('DOMContentLoaded', function() {
         loadInfoUjian();
      });
   </script>

   @include('layouts.logout-script')

</body>

</html>

