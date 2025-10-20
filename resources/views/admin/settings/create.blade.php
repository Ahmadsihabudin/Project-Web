<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Tambah Pengaturan - Ujian Online</title>
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
         <div class="p-4">
            <!-- Page Header -->
            <div class="page-header">
               <div class="row align-items-center">
                  <div class="col-md-8">
                     <h4 class="mb-2"><i class="bi bi-gear me-2"></i>Tambah Pengaturan</h4>
                     <p class="mb-0">Tambah pengaturan baru untuk sistem</p>
                  </div>
                  <div class="col-md-4 text-end">
                     <a href="{{ route('admin.settings.index') }}" class="btn btn-light">
                        <i class="bi bi-arrow-left me-1"></i>
                        Kembali
                     </a>
                  </div>
               </div>
            </div>

            <!-- Form -->
            <div class="card">
               <div class="card-body">
                  <form id="createSettingForm">
                     <div class="row">
                        <!-- Setting Information -->
                        <div class="col-md-6">
                           <div class="form-section">
                              <h6 class="mb-3"><i class="bi bi-gear me-2"></i>Informasi Pengaturan</h6>
                              <div class="mb-3">
                                 <label for="key" class="form-label fw-bold">Key <span class="text-danger">*</span></label>
                                 <input type="text" class="form-control" id="key" name="key" required placeholder="contoh: app_name, max_attempts">
                              </div>
                              <div class="mb-3">
                                 <label for="value" class="form-label fw-bold">Value <span class="text-danger">*</span></label>
                                 <textarea class="form-control" id="value" name="value" rows="3" required placeholder="Nilai pengaturan..."></textarea>
                              </div>
                              <div class="mb-3">
                                 <label for="description" class="form-label fw-bold">Deskripsi</label>
                                 <textarea class="form-control" id="description" name="description" rows="2" placeholder="Deskripsi pengaturan..."></textarea>
                              </div>
                              <div class="mb-3">
                                 <label for="category" class="form-label fw-bold">Kategori <span class="text-danger">*</span></label>
                                 <select class="form-select" id="category" name="category" required>
                                    <option value="">Pilih Kategori</option>
                                    <option value="general">Umum</option>
                                    <option value="exam">Ujian</option>
                                    <option value="security">Keamanan</option>
                                    <option value="notification">Notifikasi</option>
                                    <option value="email">Email</option>
                                    <option value="system">Sistem</option>
                                 </select>
                              </div>
                           </div>
                        </div>

                        <!-- Setting Configuration -->
                        <div class="col-md-6">
                           <div class="form-section">
                              <h6 class="mb-3"><i class="bi bi-sliders me-2"></i>Konfigurasi</h6>
                              <div class="mb-3">
                                 <label for="type" class="form-label fw-bold">Tipe Data <span class="text-danger">*</span></label>
                                 <select class="form-select" id="type" name="type" required>
                                    <option value="">Pilih Tipe</option>
                                    <option value="string">String</option>
                                    <option value="integer">Integer</option>
                                    <option value="boolean">Boolean</option>
                                    <option value="json">JSON</option>
                                    <option value="array">Array</option>
                                 </select>
                              </div>
                              <div class="mb-3">
                                 <label for="is_public" class="form-label fw-bold">Public Setting</label>
                                 <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="is_public" name="is_public">
                                    <label class="form-check-label" for="is_public">
                                       Dapat diakses oleh frontend
                                    </label>
                                 </div>
                              </div>
                              <div class="mb-3">
                                 <label for="is_encrypted" class="form-label fw-bold">Encrypted</label>
                                 <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="is_encrypted" name="is_encrypted">
                                    <label class="form-check-label" for="is_encrypted">
                                       Enkripsi nilai pengaturan
                                    </label>
                                 </div>
                              </div>
                              <div class="mb-3">
                                 <label for="validation_rules" class="form-label fw-bold">Validation Rules</label>
                                 <input type="text" class="form-control" id="validation_rules" name="validation_rules" placeholder="required|min:1|max:100">
                              </div>
                              <div class="mb-3">
                                 <label for="default_value" class="form-label fw-bold">Default Value</label>
                                 <input type="text" class="form-control" id="default_value" name="default_value" placeholder="Nilai default">
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
                              <i class="bi bi-gear me-1"></i>
                              Tambah Pengaturan
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

      // Handle form submission
      async function handleCreateForm(event) {
         event.preventDefault();

         // Validasi form sebelum submit
         const form = event.target;
         if (!form.checkValidity()) {
            console.log('Form validation failed');
            form.reportValidity();
            return;
         }

         // Validasi manual untuk field yang diperlukan
         const key = form.querySelector('#key').value.trim();
         const value = form.querySelector('#value').value.trim();
         const category = form.querySelector('#category').value;
         const type = form.querySelector('#type').value;

         if (!key) {
            alert('Key harus diisi!');
            form.querySelector('#key').focus();
            return;
         }

         if (!value) {
            alert('Value harus diisi!');
            form.querySelector('#value').focus();
            return;
         }

         if (!category) {
            alert('Kategori harus dipilih!');
            form.querySelector('#category').focus();
            return;
         }

         if (!type) {
            alert('Tipe Data harus dipilih!');
            form.querySelector('#type').focus();
            return;
         }

         // Validasi format value berdasarkan type
         if (type === 'integer') {
            if (isNaN(value)) {
               alert('Value harus berupa angka untuk tipe integer!');
               form.querySelector('#value').focus();
               return;
            }
         } else if (type === 'boolean') {
            if (!['true', 'false', '1', '0'].includes(value.toLowerCase())) {
               alert('Value harus berupa true/false untuk tipe boolean!');
               form.querySelector('#value').focus();
               return;
            }
         } else if (type === 'json') {
            try {
               JSON.parse(value);
            } catch (e) {
               alert('Value harus berupa JSON yang valid!');
               form.querySelector('#value').focus();
               return;
            }
         }

         console.log('Form validation passed');

         const loadingAlert = alertSystem.loading('Menambahkan pengaturan...');

         try {
            const formData = new FormData(event.target);

            const settingData = {
               key: formData.get('key'),
               value: formData.get('value'),
               description: formData.get('description'),
               category: formData.get('category'),
               type: formData.get('type'),
               is_public: formData.get('is_public') ? true : false,
               is_encrypted: formData.get('is_encrypted') ? true : false,
               validation_rules: formData.get('validation_rules'),
               default_value: formData.get('default_value')
            };

            console.log('Setting Data to be sent:', settingData);

            const response = await fetch('/admin/settings', {
               method: 'POST',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
               },
               body: JSON.stringify(settingData)
            });

            const result = await response.json();
            alertSystem.hide(loadingAlert);

            if (result.success) {
               alertSystem.createSuccess('Pengaturan');

               // Redirect to index page
               window.location.href = '{{ route("admin.settings.index") }}';
            } else {
               alertSystem.error('Gagal menyimpan', result.message || 'Terjadi kesalahan');
            }
         } catch (error) {
            console.error('Error saving setting:', error);
            alertSystem.hide(loadingAlert);
            alertSystem.error('Gagal menyimpan', 'Terjadi kesalahan jaringan: ' + error.message);
         }
      }

      // Initialize on page load
      document.addEventListener('DOMContentLoaded', function() {
         console.log('DOM Content Loaded');

         // Add form listeners
         const createForm = document.getElementById('createSettingForm');

         if (createForm) {
            createForm.addEventListener('submit', handleCreateForm);
         }

         // Add real-time validation for form fields
         const requiredFields = ['key', 'value', 'category', 'type'];

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

         // Key validation (should be lowercase with underscores)
         const keyField = document.getElementById('key');
         if (keyField) {
            keyField.addEventListener('input', function() {
               const keyRegex = /^[a-z][a-z0-9_]*$/;
               if (this.value && !keyRegex.test(this.value)) {
                  this.classList.remove('is-valid');
                  this.classList.add('is-invalid');
               } else if (this.value) {
                  this.classList.remove('is-invalid');
                  this.classList.add('is-valid');
               }
            });
         }
      });
   </script>

</body>

</html>
