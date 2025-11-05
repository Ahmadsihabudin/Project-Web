<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Logo & Tampilan - Ujian Online</title>
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
         height: 100%;
         width: 100%;
         opacity: 1;
      }

      .logo-preview {
         width: 200px;
         height: 200px;
         border: 2px dashed #dee2e6;
         border-radius: 0.5rem;
         display: flex;
         align-items: center;
         justify-content: center;
         background-color: #f8f9fa;
         margin-bottom: 1rem;
         overflow: hidden;
      }

      .logo-preview img {
         max-width: 100%;
         max-height: 100%;
         object-fit: contain;
      }

      .logo-preview-placeholder {
         text-align: center;
         color: #6c757d;
      }

      .logo-preview-placeholder i {
         font-size: 3rem;
         margin-bottom: 0.5rem;
      }

      .info-box {
         background-color: #e7f3ff;
         border-left: 4px solid #0d6efd;
         padding: 1rem;
         border-radius: 0.375rem;
         margin-bottom: 1.5rem;
      }

      .info-box p {
         margin: 0;
         color: #0c5460;
      }

      .preview-sidebar {
         background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
         color: white;
         padding: 1.5rem;
         border-radius: 0.5rem;
         margin-top: 1rem;
      }

      .preview-sidebar h4 {
         color: white;
         margin: 0;
         display: flex;
         align-items: center;
      }

      .preview-sidebar h4 img {
         width: 32px;
         height: 32px;
         margin-right: 0.5rem;
         object-fit: contain;
      }

      .btn-loading {
         position: relative;
         pointer-events: none;
      }

      .btn-loading::after {
         content: "";
         position: absolute;
         width: 16px;
         height: 16px;
         top: 50%;
         left: 50%;
         margin-left: -8px;
         margin-top: -8px;
         border: 2px solid #ffffff;
         border-radius: 50%;
         border-top-color: transparent;
         animation: spinner 0.6s linear infinite;
      }

      @keyframes spinner {
         to {
            transform: rotate(360deg);
         }
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
               <h2><i class="bi bi-palette me-2" style="color: #991B1B;"></i> Logo & Tampilan</h2>
               <p class="mb-0">Kelola logo dan nama aplikasi di sidebar</p>
            </div>

            <div class="info-box">
               <p><i class="bi bi-info-circle me-2"></i>
                  <strong>Penting:</strong> Logo akan ditampilkan di header sidebar. Format yang didukung: JPG, PNG, GIF. Ukuran maksimal: 2MB. Rekomendasi ukuran: 200x200px untuk tampilan optimal.
               </p>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <div class="card">
                     <div class="card-header">
                        <h6 class="m-0 font-weight-bold"><i class="bi bi-image me-2"></i>Logo Aplikasi</h6>
                     </div>
                     <div class="card-body">
                        <div class="logo-preview" id="logoPreview">
                           <div class="logo-preview-placeholder">
                              <i class="bi bi-image"></i>
                              <p class="mb-0">Preview Logo</p>
                           </div>
                        </div>
                        <div class="mb-3">
                           <label for="logoFile" class="form-label">Pilih Logo</label>
                           <input type="file" class="form-control" id="logoFile" accept="image/*" onchange="previewLogo(this)">
                           <small class="text-muted">Format: JPG, PNG, GIF. Maksimal 2MB</small>
                        </div>
                        <button type="button" class="theme-btn" onclick="uploadLogo()" id="btnUploadLogo">
                           <i class="bi bi-upload"></i>
                           Upload Logo
                        </button>
                        <button type="button" class="btn btn-secondary ms-2" onclick="resetLogo()" id="btnResetLogo">
                           <i class="bi bi-arrow-counterclockwise"></i>
                           Reset ke Default
                        </button>
                     </div>
                  </div>
               </div>

               <div class="col-md-6">
                  <div class="card">
                     <div class="card-header">
                        <h6 class="m-0 font-weight-bold"><i class="bi bi-type me-2"></i>Nama Aplikasi</h6>
                     </div>
                     <div class="card-body">
                        <div class="mb-3">
                           <label for="appName" class="form-label">Nama Aplikasi</label>
                           <input type="text" class="form-control" id="appName" placeholder="Contoh: Ujian Online" maxlength="50">
                           <small class="text-muted">Nama yang akan ditampilkan di header sidebar</small>
                        </div>
                        <button type="button" class="theme-btn" onclick="saveAppName()" id="btnSaveName">
                           <i class="bi bi-save"></i>
                           Simpan Nama
                        </button>
                     </div>
                  </div>

          
                  <div class="card">
                     <div class="card-header">
                        <h6 class="m-0 font-weight-bold"><i class="bi bi-eye me-2"></i>Preview Sidebar</h6>
                     </div>
                     <div class="card-body">
                        <div class="preview-sidebar">
                           <h4 id="previewAppName" style="display: flex; align-items: center; margin: 0;">
                              <span id="previewLogoContainer">
                                 <i class="bi bi-mortarboard me-2"></i>
                              </span>
                              <span id="previewNameText">Ujian Online</span>
                           </h4>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <script>
      if (typeof csrfToken === 'undefined') {
         var csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
      }

      let currentLogoPath = null;

      async function loadSettings() {
         try {
            const response = await fetch('/admin/settings/api/logo', {
               method: 'GET',
               headers: {
                  'X-CSRF-TOKEN': csrfToken,
                  'Accept': 'application/json'
               }
            });

            const data = await response.json();

            if (response.ok && data.success) {
               if (data.data.app_name) {
                  document.getElementById('appName').value = data.data.app_name;
                  document.getElementById('previewNameText').textContent = data.data.app_name;
               }

               if (data.data.logo_path) {
                  currentLogoPath = data.data.logo_path;
                  updateLogoPreview(data.data.logo_path);
               }
            }
         } catch (error) {
            console.error('Load settings error:', error);
         }
      }

      function previewLogo(input) {
         if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
               const preview = document.getElementById('logoPreview');
               preview.innerHTML = `<img src="${e.target.result}" alt="Logo Preview">`;
            };
            reader.readAsDataURL(input.files[0]);
         }
      }

      function updateLogoPreview(imagePath) {
         const preview = document.getElementById('logoPreview');
         const previewLogoContainer = document.getElementById('previewLogoContainer');
         
         if (imagePath) {
            const safeImagePath = String(imagePath || '').replace(/[<>'"]/g, '');
            
            preview.innerHTML = '';
            const previewImg = document.createElement('img');
            previewImg.src = safeImagePath;
            previewImg.alt = 'Logo';
            previewImg.onerror = function() {
               preview.innerHTML = '<div class="logo-preview-placeholder"><i class="bi bi-image"></i><p class="mb-0">Gagal memuat logo</p></div>';
            };
            preview.appendChild(previewImg);
            
            if (previewLogoContainer) {
               previewLogoContainer.innerHTML = '';
               
               const img = document.createElement('img');
               img.src = safeImagePath;
               img.alt = 'Logo';
               img.style.cssText = 'width: 32px; height: 32px; object-fit: contain; margin-right: 0.5rem;';
               img.onerror = function() {
                  previewLogoContainer.innerHTML = '<i class="bi bi-mortarboard me-2"></i>';
               };
               previewLogoContainer.appendChild(img);
            }
         } else {
            preview.innerHTML = '<div class="logo-preview-placeholder"><i class="bi bi-image"></i><p class="mb-0">Preview Logo</p></div>';
            if (previewLogoContainer) {
               previewLogoContainer.innerHTML = '<i class="bi bi-mortarboard me-2"></i>';
               const defaultIcon = previewLogoContainer.parentElement.querySelector('i.bi-mortarboard');
               if (defaultIcon) {
                  defaultIcon.style.display = 'inline';
               }
            }
         }
      }

      async function uploadLogo() {
         const logoFile = document.getElementById('logoFile');
         
         if (!logoFile.files || !logoFile.files[0]) {
            await Swal.fire({
               title: 'Peringatan!',
               text: 'Pilih file logo terlebih dahulu.',
               icon: 'warning',
               confirmButtonText: 'OK',
               confirmButtonColor: '#0d6efd'
            });
            return;
         }

         const file = logoFile.files[0];
         
         if (file.size > 2 * 1024 * 1024) {
            await Swal.fire({
               title: 'Peringatan!',
               text: 'Ukuran file terlalu besar. Maksimal 2MB.',
               icon: 'warning',
               confirmButtonText: 'OK',
               confirmButtonColor: '#0d6efd'
            });
            return;
         }

         if (!file.type.match('image.*')) {
            await Swal.fire({
               title: 'Peringatan!',
               text: 'Format file tidak valid. Hanya file gambar yang diperbolehkan.',
               icon: 'warning',
               confirmButtonText: 'OK',
               confirmButtonColor: '#0d6efd'
            });
            return;
         }

         const btnUpload = document.getElementById('btnUploadLogo');
         const originalText = btnUpload.innerHTML;
         btnUpload.classList.add('btn-loading');
         btnUpload.disabled = true;
         btnUpload.innerHTML = 'Mengupload...';

         try {
            const formData = new FormData();
            formData.append('logo', file);

            const response = await fetch('/admin/settings/api/logo', {
               method: 'POST',
               headers: {
                  'X-CSRF-TOKEN': csrfToken,
                  'Accept': 'application/json'
               },
               body: formData
            });

            const data = await response.json();

            if (response.ok && data.success) {
               currentLogoPath = data.data.logo_path;
               updateLogoPreview(data.data.logo_path);
               
               await Swal.fire({
                  title: 'Berhasil!',
                  text: 'Logo berhasil diupload. Halaman akan di-refresh...',
                  icon: 'success',
                  confirmButtonText: 'OK',
                  confirmButtonColor: '#0d6efd',
                  timer: 1500,
                  timerProgressBar: true
               });

               logoFile.value = '';
               window.location.href = window.location.href;
            } else {
               throw new Error(data.message || 'Gagal mengupload logo.');
            }
         } catch (error) {
            console.error('Upload logo error:', error);
            await Swal.fire({
               title: 'Gagal!',
               text: error.message || 'Terjadi kesalahan saat mengupload logo.',
               icon: 'error',
               confirmButtonText: 'Tutup',
               confirmButtonColor: '#dc3545'
            });
         } finally {
            btnUpload.classList.remove('btn-loading');
            btnUpload.disabled = false;
            btnUpload.innerHTML = originalText;
         }
      }

      async function resetLogo() {
         const confirmed = await Swal.fire({
            title: 'Reset Logo?',
            text: 'Apakah Anda yakin ingin mengembalikan logo ke default?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Reset',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d'
         });

         if (!confirmed.isConfirmed) return;

         try {
            const response = await fetch('/admin/settings/api/logo/reset', {
               method: 'POST',
               headers: {
                  'X-CSRF-TOKEN': csrfToken,
                  'Accept': 'application/json'
               }
            });

            const data = await response.json();

            if (response.ok && data.success) {
               currentLogoPath = null;
               updateLogoPreview(null);
               
               await Swal.fire({
                  title: 'Berhasil!',
                  text: 'Logo berhasil direset ke default.',
                  icon: 'success',
                  confirmButtonText: 'OK',
                  confirmButtonColor: '#0d6efd'
               });
            } else {
               throw new Error(data.message || 'Gagal mereset logo.');
            }
         } catch (error) {
            console.error('Reset logo error:', error);
            await Swal.fire({
               title: 'Gagal!',
               text: error.message || 'Terjadi kesalahan saat mereset logo.',
               icon: 'error',
               confirmButtonText: 'Tutup',
               confirmButtonColor: '#dc3545'
            });
         }
      }

      async function saveAppName() {
         const appName = document.getElementById('appName').value.trim();

         if (!appName) {
            await Swal.fire({
               title: 'Peringatan!',
               text: 'Nama aplikasi tidak boleh kosong.',
               icon: 'warning',
               confirmButtonText: 'OK',
               confirmButtonColor: '#0d6efd'
            });
            return;
         }

         const btnSave = document.getElementById('btnSaveName');
         const originalText = btnSave.innerHTML;
         btnSave.classList.add('btn-loading');
         btnSave.disabled = true;
         btnSave.innerHTML = 'Menyimpan...';

         try {
            const response = await fetch('/admin/settings/api/logo', {
               method: 'PUT',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken,
                  'Accept': 'application/json'
               },
               body: JSON.stringify({
                  app_name: appName
               })
            });

            const data = await response.json();

            if (response.ok && data.success) {
               document.getElementById('previewNameText').textContent = appName;
               
               await Swal.fire({
                  title: 'Berhasil!',
                  text: 'Nama aplikasi berhasil disimpan. Halaman akan di-refresh...',
                  icon: 'success',
                  confirmButtonText: 'OK',
                  confirmButtonColor: '#0d6efd',
                  timer: 1500,
                  timerProgressBar: true
               });

               window.location.href = window.location.href;
            } else {
               throw new Error(data.message || 'Gagal menyimpan nama aplikasi.');
            }
         } catch (error) {
            console.error('Save app name error:', error);
            await Swal.fire({
               title: 'Gagal!',
               text: error.message || 'Terjadi kesalahan saat menyimpan nama aplikasi.',
               icon: 'error',
               confirmButtonText: 'Tutup',
               confirmButtonColor: '#dc3545'
            });
         } finally {
            btnSave.classList.remove('btn-loading');
            btnSave.disabled = false;
            btnSave.innerHTML = originalText;
         }
      }

      document.getElementById('appName').addEventListener('input', function() {
         const value = this.value.trim();
         document.getElementById('previewNameText').textContent = value || 'Ujian Online';
      });

      document.addEventListener('DOMContentLoaded', function() {
         loadSettings();
      });
   </script>
</body>

</html>

