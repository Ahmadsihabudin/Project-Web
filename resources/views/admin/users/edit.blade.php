<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Edit User - Ujian Online</title>
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
         <div class="p-4" data-user-id="{{ $user->id ?? '' }}">
            <!-- Page Header -->
            <div class="page-header">
               <div class="row align-items-center">
                  <div class="col-md-8">
                     <h4 class="mb-2"><i class="bi bi-pencil-square me-2" style="color: #991B1B;"></i>Edit User</h4>
                     <p class="mb-0">Ubah informasi user</p>
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
                  <form id="editUserForm">
                     <div class="row">
                        <!-- User Information -->
                        <div class="col-md-6">
                           <div class="form-section">
                              <h6 class="mb-3"><i class="bi bi-person me-2"></i>Informasi User</h6>
                              <div class="mb-3">
                                 <label for="name" class="form-label fw-bold">Nama Lengkap <span class="text-danger">*</span></label>
                                 <input type="text" class="form-control" id="name" name="name" value="{{ $user->name ?? '' }}" required>
                              </div>
                              <div class="mb-3">
                                 <label for="email" class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                                 <input type="email" class="form-control" id="email" name="email" value="{{ $user->email ?? '' }}" required>
                              </div>
                              <div class="mb-3">
                                 <label for="password" class="form-label fw-bold">Password Baru</label>
                                 <input type="password" class="form-control" id="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah">
                              </div>
                              <div class="mb-3">
                                 <label for="password_confirmation" class="form-label fw-bold">Konfirmasi Password Baru</label>
                                 <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Kosongkan jika tidak ingin mengubah">
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
                                    <option value="admin" {{ ($user->role ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="staff" {{ ($user->role ?? '') == 'staff' ? 'selected' : '' }}>Staff</option>
                                 </select>
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
                              Update User
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
      const userId = document.querySelector('[data-user-id]').getAttribute('data-user-id');

      // Data sudah di-load dari controller, tidak perlu fetch lagi

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
         const name = form.querySelector('#name').value.trim();
         const email = form.querySelector('#email').value.trim();
         const password = form.querySelector('#password').value;
         const passwordConfirmation = form.querySelector('#password_confirmation').value;
         const role = form.querySelector('#role').value;

         if (!name) {
            await Swal.fire({
               icon: 'warning',
               title: 'Validasi Gagal',
               text: 'Nama harus diisi!',
               confirmButtonText: 'OK',
               confirmButtonColor: '#991B1B'
            });
            form.querySelector('#name').focus();
            return;
         }

         if (!email) {
            await Swal.fire({
               icon: 'warning',
               title: 'Validasi Gagal',
               text: 'Email harus diisi!',
               confirmButtonText: 'OK',
               confirmButtonColor: '#991B1B'
            });
            form.querySelector('#email').focus();
            return;
         }


         if (!role) {
            await Swal.fire({
               icon: 'warning',
               title: 'Validasi Gagal',
               text: 'Role harus dipilih!',
               confirmButtonText: 'OK',
               confirmButtonColor: '#991B1B'
            });
            form.querySelector('#role').focus();
            return;
         }

         // Validasi password jika diisi
         if (password && password !== passwordConfirmation) {
            await Swal.fire({
               icon: 'warning',
               title: 'Validasi Gagal',
               text: 'Konfirmasi password tidak sama!',
               confirmButtonText: 'OK',
               confirmButtonColor: '#991B1B'
            });
            form.querySelector('#password_confirmation').focus();
            return;
         }

         console.log('Form validation passed');

         const loadingAlert = alertSystem.loading('Memperbarui user...');

         try {
            const formData = new FormData(event.target);

            const userData = {
               name: formData.get('name'),
               email: formData.get('email'),
               role: formData.get('role')
            };

            // Only include password if provided
            if (password) {
               userData.password = password;
               userData.password_confirmation = passwordConfirmation;
            }

            console.log('User Data to be sent:', userData);

            const response = await fetch(`/admin/users/${userId}`, {
               method: 'PUT',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
               },
               body: JSON.stringify(userData)
            });

            const result = await response.json();
            alertSystem.hide(loadingAlert);

            if (result.success) {
               alertSystem.updateSuccess('User');

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

         // Data sudah di-load dari controller

         // Add form listeners
         const editForm = document.getElementById('editUserForm');

         if (editForm) {
            editForm.addEventListener('submit', handleEditForm);
         }

         // Add real-time validation for form fields
         const requiredFields = ['name', 'email', 'role'];

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