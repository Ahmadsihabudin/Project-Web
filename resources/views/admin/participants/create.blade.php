<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Tambah Peserta - Ujian Online</title>
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

      /* Ensure all form fields are visible */
      .form-control,
      .form-select {
         display: block !important;
         visibility: visible !important;
         opacity: 1 !important;
      }

      /* Ensure form sections are visible */
      .form-section {
         display: block !important;
         visibility: visible !important;
         opacity: 1 !important;
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
                     <h4 class="mb-2"><i class="bi bi-person-plus me-2" style="color: #991B1B;"></i>Tambah Peserta</h4>
                     <p class="mb-0">Tambah peserta baru untuk ujian online</p>
                  </div>
                  <div class="col-md-4 text-end">
                     <a href="{{ route('admin.participants.index') }}" class="btn btn-light">
                        <i class="bi bi-arrow-left me-1"></i>
                        Kembali
                     </a>
                  </div>
               </div>
            </div>

            <!-- Form -->
            <div class="card">
               <div class="card-body">
                  <form id="createParticipantForm">
                     <div class="row">
                        <!-- Personal Information -->
                        <div class="col-md-6">
                           <div class="form-section">
                              <h6 class="mb-3"><i class="bi bi-person me-2"></i>Informasi Pribadi</h6>
                              <div class="mb-3">
                                 <label for="nama" class="form-label fw-bold">Nama Lengkap <span class="text-danger">*</span></label>
                                 <input type="text" class="form-control" id="nama" name="nama" required>
                              </div>
                              <div class="mb-3">
                                 <label for="email" class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                                 <input type="email" class="form-control" id="email" name="email" required>
                              </div>
                           </div>
                        </div>

                        <!-- Academic Information -->
                        <div class="col-md-6">
                           <div class="form-section">
                              <h6 class="mb-3"><i class="bi bi-mortarboard me-2"></i>Informasi Akademik</h6>
                              <div class="mb-3">
                                 <label for="jurusan" class="form-label fw-bold">Jurusan/Program Studi</label>
                                 <input type="text" class="form-control" id="jurusan" name="jurusan">
                              </div>
                              <div class="mb-3">
                                 <label for="batch" class="form-label fw-bold">Batch <span class="text-danger">*</span></label>
                                 <select class="form-select" id="batch" name="batch" required>
                                    <option value="">Pilih Batch</option>
                                    <option value="Batch 1">Batch 1</option>
                                    <option value="Batch 2">Batch 2</option>
                                    <option value="Batch 3">Batch 3</option>
                                    <option value="Batch 4">Batch 4</option>
                                    <option value="Batch 5">Batch 5</option>
                                    <option value="Batch 6">Batch 6</option>
                                    <option value="Batch 7">Batch 7</option>
                                    <option value="Batch 8">Batch 8</option>
                                    <option value="Batch 9">Batch 9</option>
                                    <option value="Batch 10">Batch 10</option>
                                    <option value="Batch 11">Batch 11</option>
                                    <option value="Batch 12">Batch 12</option>
                                    <option value="Batch 13">Batch 13</option>
                                    <option value="Batch 14">Batch 14</option>
                                    <option value="Batch 15">Batch 15</option>
                                    <option value="Batch 16">Batch 16</option>
                                    <option value="Batch 17">Batch 17</option>
                                    <option value="Batch 18">Batch 18</option>
                                    <option value="Batch 19">Batch 19</option>
                                    <option value="Batch 20">Batch 20</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                     </div>

                     <!-- Additional Information -->
                     <div class="row">
                        <div class="col-12">
                           <div class="form-section">
                              <h6 class="mb-3"><i class="bi bi-gear me-2"></i>Informasi Tambahan</h6>
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="mb-3">
                                       <label for="kode_akses" class="form-label fw-bold">Kode Akses <span class="text-danger">*</span></label>
                                       <input type="text" class="form-control" id="kode_akses" name="kode_akses" required placeholder="Kode untuk login peserta">
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="mb-3">
                                       <label for="asal_smk" class="form-label fw-bold">Asal SMK <span class="text-danger">*</span></label>
                                       <input type="text" class="form-control" id="asal_smk" name="asal_smk" required placeholder="Nama sekolah asal">
                                    </div>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="mb-3">
                                       <label for="kode_peserta" class="form-label fw-bold">Kode Peserta <span class="text-danger">*</span></label>
                                       <input type="text" class="form-control" id="kode_peserta" name="kode_peserta" required placeholder="Contoh: RK000001">
                                       <small class="form-text text-muted">Format: RK + 6 digit angka</small>
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
                           <button type="submit" class="btn btn-success theme-btn">
                              <i class="bi bi-person-plus me-1"></i>
                              Tambah Peserta
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
         const nama = form.querySelector('#nama').value.trim();
         const email = form.querySelector('#email').value.trim();
         const kodeAkses = form.querySelector('#kode_akses').value.trim();
         const asalSmk = form.querySelector('#asal_smk').value.trim();
         const kodePeserta = form.querySelector('#kode_peserta').value.trim();
         const batch = form.querySelector('#batch').value.trim();

         if (!nama) {
            alert('Nama harus diisi!');
            form.querySelector('#nama').focus();
            return;
         }

         if (!email) {
            alert('Email harus diisi!');
            form.querySelector('#email').focus();
            return;
         }

         if (!kodeAkses) {
            alert('Kode Akses harus diisi!');
            form.querySelector('#kode_akses').focus();
            return;
         }

         if (!asalSmk) {
            alert('Asal SMK harus diisi!');
            form.querySelector('#asal_smk').focus();
            return;
         }

         if (!kodePeserta) {
            alert('Kode Peserta harus diisi!');
            form.querySelector('#kode_peserta').focus();
            return;
         }

         if (!batch) {
            alert('Batch harus diisi!');
            form.querySelector('#batch').focus();
            return;
         }

         console.log('Form validation passed');

         const loadingAlert = alertSystem.loading('Menambahkan peserta...');

         try {
            const formData = new FormData(event.target);

            // Debug: Log all form data
            console.log('All form data:');
            for (let [key, value] of formData.entries()) {
               console.log(`  ${key}: ${value}`);
            }

            const participantData = {
               nama: formData.get('nama'),
               email: formData.get('email'),
               kode_akses: formData.get('kode_akses'),
               asal_smk: formData.get('asal_smk'),
               kode_peserta: formData.get('kode_peserta'),
               jurusan: formData.get('jurusan'),
               batch: formData.get('batch')
               // Note: kode_peserta is now user input, not auto-generated
            };

            console.log('Participant Data to be sent:', participantData);

            const response = await fetch('/admin/participants', {
               method: 'POST',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
               },
               body: JSON.stringify(participantData)
            });

            const result = await response.json();
            alertSystem.hide(loadingAlert);

            if (result.success) {
               // Show success message with user input kode peserta
               const kodePeserta = result.data.kode_peserta;
               alertSystem.createSuccess('Peserta');

               // Show kode peserta
               alert(`Peserta berhasil ditambahkan!\n\nKode Peserta: ${kodePeserta}\n\nData telah disimpan.`);

               // Redirect to index page
               setTimeout(() => {
                  window.location.href = '{{ route("admin.participants.index") }}';
               }, 2000);
            } else {
               alertSystem.error('Gagal menyimpan', result.message || 'Terjadi kesalahan');
            }
         } catch (error) {
            console.error('Error saving participant:', error);
            alertSystem.hide(loadingAlert);
            alertSystem.error('Gagal menyimpan', 'Terjadi kesalahan jaringan: ' + error.message);
         }
      }

      // Initialize on page load
      document.addEventListener('DOMContentLoaded', function() {
         console.log('DOM Content Loaded');

         // Add form listeners
         const createForm = document.getElementById('createParticipantForm');

         if (createForm) {
            createForm.addEventListener('submit', handleCreateForm);
         }

         // Add real-time validation for form fields
         const requiredFields = ['nama', 'email', 'kode_akses', 'asal_smk', 'batch'];

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
      });
   </script>

</body>

</html>