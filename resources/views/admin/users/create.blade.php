<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Tambah User - Ujian Online</title>
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
         background: #f8f9fa;
         color: #333;
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
                     <h4 class="mb-2"><i class="bi bi-person-plus me-2" style="color: #991B1B;"></i>Tambah User</h4>
                     <p class="mb-0">Tambah user baru untuk sistem</p>
                  </div>
                  <div class="col-md-4 text-end">
                     <a href="{{ route('admin.users.index') }}" class="btn btn-light">
                        <i class="bi bi-arrow-left me-1"></i>
                        Kembali
                     </a>
                  </div>
               </div>
            </div>

            <!-- Form -->
            <div class="card">
               <div class="card-body">
                  <form id="createUserForm">
                     <div class="row">
                        <!-- User Information -->
                        <div class="col-md-6">
                           <div class="form-section">
                              <h6 class="mb-3"><i class="bi bi-person me-2"></i>Informasi User</h6>
                              <div class="mb-3">
                                 <label for="name" class="form-label fw-bold">Nama Lengkap <span class="text-danger">*</span></label>
                                 <input type="text" class="form-control" id="name" name="name" required>
                              </div>
                              <div class="mb-3">
                                 <label for="email" class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                                 <input type="email" class="form-control" id="email" name="email" required>
                              </div>
                              <div class="mb-3">
                                 <label for="username" class="form-label fw-bold">Username <span class="text-danger">*</span></label>
                                 <input type="text" class="form-control" id="username" name="username" required>
                              </div>
                              <div class="mb-3">
                                 <label for="password" class="form-label fw-bold">Password <span class="text-danger">*</span></label>
                                 <input type="password" class="form-control" id="password" name="password" required>
                              </div>
                              <div class="mb-3">
                                 <label for="password_confirmation" class="form-label fw-bold">Konfirmasi Password <span class="text-danger">*</span></label>
                                 <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                              </div>
                           </div>
                        </div>

                        <!-- User Settings -->
                        <div class="col-md-6">
                           <div class="form-section">
                              <h6 class="mb-3"><i class="bi bi-gear me-2"></i>Pengaturan User</h6>
                              <div class="mb-3">
                                 <label for="role" class="form-label fw-bold">Role <span class="text-danger">*</span></label>
                                 <select class="form-select" id="role" name="role" required>
                                    <option value="">Pilih Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="staff">Staff</option>
                                    <option value="supervisor">Supervisor</option>
                                 </select>
                              </div>
                              <div class="mb-3">
                                 <label for="status" class="form-label fw-bold">Status</label>
                                 <select class="form-select" id="status" name="status">
                                    <option value="active" selected>Active</option>
                                    <option value="inactive">Inactive</option>
                                 </select>
                              </div>
                              <div class="mb-3">
                                 <label for="phone" class="form-label fw-bold">No. Handphone</label>
                                 <input type="text" class="form-control" id="phone" name="phone">
                              </div>
                              <div class="mb-3">
                                 <label for="address" class="form-label fw-bold">Alamat</label>
                                 <textarea class="form-control" id="address" name="address" rows="3"></textarea>
                              </div>
                              <div class="mb-3">
                                 <label for="notes" class="form-label fw-bold">Catatan</label>
                                 <textarea class="form-control" id="notes" name="notes" rows="2" placeholder="Catatan tambahan"></textarea>
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
                              <i class="bi bi-person-plus me-1"></i>
                              Tambah User
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
      async function handleCreateForm(event, createForm) {
         event.preventDefault();

         // Validasi form sebelum submit
         const form = event.target;
         if (!form.checkValidity()) {
            console.log('Form validation failed');
            form.reportValidity();
            return;
         }

         // Validasi manual untuk field yang diperlukan
         const name = form.querySelector('#name').value.trim();
         const email = form.querySelector('#email').value.trim();
         const username = form.querySelector('#username').value.trim();
         const password = form.querySelector('#password').value;
         const passwordConfirmation = form.querySelector('#password_confirmation').value;
         const role = form.querySelector('#role').value;

         if (!name) {
            alert('Nama harus diisi!');
            form.querySelector('#name').focus();
            return;
         }

         if (!email) {
            alert('Email harus diisi!');
            form.querySelector('#email').focus();
            return;
         }

         if (!username) {
            alert('Username harus diisi!');
            form.querySelector('#username').focus();
            return;
         }

         if (!password) {
            alert('Password harus diisi!');
            form.querySelector('#password').focus();
            return;
         }

         if (password !== passwordConfirmation) {
            alert('Konfirmasi password tidak sama!');
            form.querySelector('#password_confirmation').focus();
            return;
         }

         if (!role) {
            alert('Role harus dipilih!');
            form.querySelector('#role').focus();
            return;
         }

         console.log('Form validation passed');

         const loadingAlert = alertSystem.loading('Menambahkan user...');

         try {
            const formData = new FormData(event.target);

            const userData = {
               name: formData.get('name'),
               email: formData.get('email'),
               username: formData.get('username'),
               password: formData.get('password'),
               password_confirmation: formData.get('password_confirmation'),
               role: formData.get('role'),
               status: formData.get('status'),
               phone: formData.get('phone'),
               address: formData.get('address'),
               notes: formData.get('notes')
            };

            console.log('User Data to be sent:', userData);

            const response = await fetch('/admin/users', {
               method: 'POST',
               headers: {
                  'X-CSRF-TOKEN': csrfToken
               },
               body: formData
            });

            const result = await response.json();
            alertSystem.hide(loadingAlert);

            if (result.success) {
               alertSystem.createSuccess('User');

               // Redirect to index page
               window.location.href = '{{ route("admin.users.index") }}';
            } else {
               alertSystem.error('Gagal menyimpan', result.message || 'Terjadi kesalahan');
            }
         } catch (error) {
            console.error('Error saving user:', error);
            alertSystem.hide(loadingAlert);
            alertSystem.error('Gagal menyimpan', 'Terjadi kesalahan jaringan: ' + error.message);
         }
      }

      // Initialize on page load
      document.addEventListener('DOMContentLoaded', function() {
         console.log('DOM Content Loaded');

         // Add form listeners
         const createForm = document.getElementById('createUserForm');

         if (createForm) {
            createForm.addEventListener('submit', function(event) {
               handleCreateForm(event, createForm);
            });
         }

         // Add real-time validation for form fields
         const requiredFields = ['name', 'email', 'username', 'password', 'role'];

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

         // Email validation
         const emailField = document.getElementById('email');
         if (emailField) {
            emailField.addEventListener('blur', function() {
               const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
               if (this.value && !emailRegex.test(this.value)) {
                  this.classList.remove('is-valid');
                  this.classList.add('is-invalid');
               } else if (this.value) {
                  this.classList.remove('is-invalid');
                  this.classList.add('is-valid');
               }
            });
         }

         // Password confirmation validation
         const passwordField = document.getElementById('password');
         const passwordConfirmationField = document.getElementById('password_confirmation');

         if (passwordField && passwordConfirmationField) {
            passwordConfirmationField.addEventListener('input', function() {
               if (this.value && this.value === passwordField.value) {
                  this.classList.remove('is-invalid');
                  this.classList.add('is-valid');
               } else if (this.value) {
                  this.classList.remove('is-valid');
                  this.classList.add('is-invalid');
               }
            });
         }
      });
   </script>

</body>

</html>