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
         <div class="p-4" data-user-id="{{ $id ?? '' }}">
            <!-- Page Header -->
            <div class="page-header">
               <div class="row align-items-center">
                  <div class="col-md-8">
                     <h4 class="mb-2"><i class="bi bi-pencil-square me-2"></i>Edit User</h4>
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
                                    <option value="admin">Admin</option>
                                    <option value="staff">Staff</option>
                                    <option value="supervisor">Supervisor</option>
                                 </select>
                              </div>
                              <div class="mb-3">
                                 <label for="status" class="form-label fw-bold">Status</label>
                                 <select class="form-select" id="status" name="status">
                                    <option value="aktif">Aktif</option>
                                    <option value="tidak_aktif">Tidak Aktif</option>
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
                           <button type="button" class="btn btn-secondary me-2" onclick="window.history.back()">
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

      // Load user data for editing
      async function loadUserData(id) {
         try {
            const response = await fetch(`/admin/users/${id}`, {
               method: 'GET',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
               }
            });

            if (response.ok) {
               const result = await response.json();
               if (result.success) {
                  const user = result.data;

                  // Fill form fields
                  document.getElementById('name').value = user.name || '';
                  document.getElementById('email').value = user.email || '';
                  document.getElementById('username').value = user.username || '';
                  document.getElementById('role').value = user.role || '';
                  document.getElementById('status').value = user.status || 'aktif';
                  document.getElementById('phone').value = user.phone || '';
                  document.getElementById('address').value = user.address || '';
                  document.getElementById('notes').value = user.notes || '';
               }
            }
         } catch (error) {
            console.error('Error loading user data:', error);
            alertSystem.error('Gagal memuat data', 'Terjadi kesalahan saat memuat data');
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

         if (!role) {
            alert('Role harus dipilih!');
            form.querySelector('#role').focus();
            return;
         }

         // Validasi password jika diisi
         if (password && password !== passwordConfirmation) {
            alert('Konfirmasi password tidak sama!');
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
               username: formData.get('username'),
               role: formData.get('role'),
               status: formData.get('status'),
               phone: formData.get('phone'),
               address: formData.get('address'),
               notes: formData.get('notes')
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

         // Load user data if ID is provided
         if (userId) {
            loadUserData(userId);
         }

         // Add form listeners
         const editForm = document.getElementById('editUserForm');

         if (editForm) {
            editForm.addEventListener('submit', handleEditForm);
         }

         // Add real-time validation for form fields
         const requiredFields = ['name', 'email', 'username', 'role'];

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
