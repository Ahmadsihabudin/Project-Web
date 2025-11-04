<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Edit Peserta - Ujian Online</title>
   <meta name="csrf-token" content="{{ csrf_token() }}">

   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   <!-- Bootstrap Icons -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
   <!-- Bootstrap JS -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

   <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
   @include('layouts.alert-system')
   <script src="{{ asset('js/indonesia-regions.js') }}"></script>
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
         <div class="p-4" data-participant-id="{{ $id ?? '' }}">
            <!-- Page Header -->
            <div class="page-header">
               <div class="row align-items-center">
                  <div class="col-md-8">
                     <h4 class="mb-2"><i class="bi bi-pencil-square me-2" style="color: #991B1B;"></i>Edit Peserta</h4>
                     <p class="mb-0">Ubah informasi peserta</p>
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
                  <form id="editParticipantForm">
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
                              <div class="mb-3">
                                 <label for="kode_peserta" class="form-label fw-bold">Kode Peserta <span class="text-danger">*</span></label>
                                 <input type="text" class="form-control" id="kode_peserta" name="kode_peserta" required readonly>
                              </div>
                              <div class="mb-3">
                                 <label for="no_hp" class="form-label fw-bold">No HP</label>
                                 <input type="tel" class="form-control" id="no_hp" name="no_hp" placeholder="Contoh: 081234567890" maxlength="15" pattern="[0-9]*" inputmode="numeric">
                                 <small class="form-text text-muted">Hanya angka, maksimal 15 digit</small>
                              </div>
                              <div class="mb-3">
                                 <label for="nik" class="form-label fw-bold">NIK</label>
                                 <input type="text" class="form-control" id="nik" name="nik" placeholder="Nomor Induk Kependudukan" maxlength="16" pattern="[0-9]*" inputmode="numeric">
                                 <small class="form-text text-muted">Hanya angka, 16 digit</small>
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
                              <div class="mb-3">
                                 <label for="status" class="form-label fw-bold">Status <span class="text-danger">*</span></label>
                                 <select class="form-select" id="status" name="status" required>
                                    <option value="aktif">Aktif</option>
                                    <option value="tidak_aktif">Tidak Aktif</option>
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
                                       <label for="provinsi" class="form-label fw-bold">Provinsi</label>
                                       <select class="form-select" id="provinsi" name="provinsi">
                                          <option value="">Pilih Provinsi</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="mb-3">
                                       <label for="kota_kabupaten" class="form-label fw-bold">Kota/Kabupaten</label>
                                       <select class="form-select" id="kota_kabupaten" name="kota_kabupaten" disabled>
                                          <option value="">Pilih Provinsi terlebih dahulu</option>
                                       </select>
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
                              Update Peserta
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
      const participantId = document.querySelector('[data-participant-id]').getAttribute('data-participant-id');

      // Load participant data for editing
      async function loadParticipantData(id) {
         try {
            const response = await fetch(`/admin/participants/${id}`, {
               method: 'GET',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
               }
            });

            if (response.ok) {
               const result = await response.json();
               if (result.success) {
                  const participant = result.data;

                  // Fill form fields
                  document.getElementById('nama').value = participant.nama_peserta || '';
                  document.getElementById('email').value = participant.email || '';
                  document.getElementById('kode_peserta').value = participant.kode_peserta || '';
                  document.getElementById('kode_akses').value = participant.kode_akses || '';
                  document.getElementById('asal_smk').value = participant.asal_smk || '';
                  document.getElementById('jurusan').value = participant.jurusan || '';
                  document.getElementById('batch').value = participant.batch || '';
                  document.getElementById('status').value = participant.status || 'aktif';
                  document.getElementById('no_hp').value = participant.no_hp || '';
                  document.getElementById('nik').value = participant.nik || '';
                  
                  // Set provinsi dan kabupaten
                  const provinsiSelect = document.getElementById('provinsi');
                  const kotaKabupatenSelect = document.getElementById('kota_kabupaten');
                  
                  if (participant.provinsi && provinsiSelect) {
                     provinsiSelect.value = participant.provinsi;
                     // Trigger change untuk load kabupaten
                     provinsiSelect.dispatchEvent(new Event('change'));
                     
                     // Set kabupaten setelah dropdown di-populate
                     setTimeout(() => {
                        if (participant.kota_kabupaten && kotaKabupatenSelect) {
                           kotaKabupatenSelect.value = participant.kota_kabupaten;
                        }
                     }, 100);
                  }
               }
            }
         } catch (error) {
            console.error('Error loading participant data:', error);
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
         const nama = form.querySelector('#nama').value.trim();
         const email = form.querySelector('#email').value.trim();
         const kodeAkses = form.querySelector('#kode_akses').value.trim();
         const asalSmk = form.querySelector('#asal_smk').value.trim();
         const batch = form.querySelector('#batch').value.trim();

         if (!nama) {
            await Swal.fire({
               icon: 'warning',
               title: 'Validasi Gagal',
               text: 'Nama harus diisi!',
               confirmButtonText: 'OK',
               confirmButtonColor: '#991B1B'
            });
            form.querySelector('#nama').focus();
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

         if (!kodeAkses) {
            await Swal.fire({
               icon: 'warning',
               title: 'Validasi Gagal',
               text: 'Kode Akses harus diisi!',
               confirmButtonText: 'OK',
               confirmButtonColor: '#991B1B'
            });
            form.querySelector('#kode_akses').focus();
            return;
         }

         if (!asalSmk) {
            await Swal.fire({
               icon: 'warning',
               title: 'Validasi Gagal',
               text: 'Asal SMK harus diisi!',
               confirmButtonText: 'OK',
               confirmButtonColor: '#991B1B'
            });
            form.querySelector('#asal_smk').focus();
            return;
         }

         if (!batch) {
            await Swal.fire({
               icon: 'warning',
               title: 'Validasi Gagal',
               text: 'Batch harus diisi!',
               confirmButtonText: 'OK',
               confirmButtonColor: '#991B1B'
            });
            form.querySelector('#batch').focus();
            return;
         }

         console.log('Form validation passed');

         const loadingAlert = alertSystem.loading('Memperbarui peserta...');

         try {
            const formData = new FormData(event.target);

            const participantData = {
               nama: formData.get('nama'),
               email: formData.get('email'),
               kode_akses: formData.get('kode_akses'),
               asal_smk: formData.get('asal_smk'),
               jurusan: formData.get('jurusan'),
               batch: formData.get('batch'),
               kode_peserta: formData.get('kode_peserta') || '',
               status: formData.get('status') || 'aktif',
               no_hp: formData.get('no_hp'),
               nik: formData.get('nik'),
               kota_kabupaten: formData.get('kota_kabupaten'),
               provinsi: formData.get('provinsi')
            };

            console.log('Participant Data to be sent:', participantData);

            const response = await fetch(`/admin/participants/${participantId}`, {
               method: 'PUT',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
               },
               body: JSON.stringify(participantData)
            });

            const result = await response.json();
            alertSystem.hide(loadingAlert);

            if (result.success) {
               alertSystem.updateSuccess('Peserta');
               
               // Show SweetAlert success
               await Swal.fire({
                  icon: 'success',
                  title: 'Berhasil!',
                  html: `Peserta berhasil diperbarui!<br><br><strong>Kode Peserta: ${result.data.kode_peserta}</strong><br><br>Data telah disimpan.`,
                  confirmButtonText: 'OK',
                  confirmButtonColor: '#991B1B'
               });

               // Redirect to index page
               window.location.href = '{{ route("admin.participants.index") }}';
            } else {
               // Show validation errors or error message
               let errorMessage = result.message || 'Terjadi kesalahan';
               if (result.errors) {
                  const errorList = Object.values(result.errors).flat().join('<br>');
                  errorMessage = errorList || errorMessage;
               }
               
               await Swal.fire({
                  icon: 'error',
                  title: 'Gagal Menyimpan',
                  html: errorMessage,
                  confirmButtonText: 'OK',
                  confirmButtonColor: '#991B1B'
               });
            }
         } catch (error) {
            console.error('Error saving participant:', error);
            alertSystem.hide(loadingAlert);
            await Swal.fire({
               icon: 'error',
               title: 'Gagal Menyimpan',
               text: 'Terjadi kesalahan jaringan: ' + error.message,
               confirmButtonText: 'OK',
               confirmButtonColor: '#991B1B'
            });
         }
      }

      // Initialize on page load
      document.addEventListener('DOMContentLoaded', function() {
         console.log('DOM Content Loaded');

         // Load participant data if ID is provided
         if (participantId) {
            loadParticipantData(participantId);
         }

         // Add form listeners
         const editForm = document.getElementById('editParticipantForm');

         if (editForm) {
            editForm.addEventListener('submit', handleEditForm);
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

         // Validasi No HP - hanya angka
         const noHpField = document.getElementById('no_hp');
         if (noHpField) {
            noHpField.addEventListener('input', function() {
               this.value = this.value.replace(/[^0-9]/g, '');
               if (this.value.length > 15) {
                  this.value = this.value.substring(0, 15);
               }
            });
         }

         // Validasi NIK - hanya angka, 16 digit
         const nikField = document.getElementById('nik');
         if (nikField) {
            nikField.addEventListener('input', function() {
               this.value = this.value.replace(/[^0-9]/g, '');
               if (this.value.length > 16) {
                  this.value = this.value.substring(0, 16);
               }
            });
         }

         // Populate Provinsi dropdown
         const provinsiSelect = document.getElementById('provinsi');
         if (provinsiSelect && typeof provincesIndonesia !== 'undefined') {
            provincesIndonesia.forEach(province => {
               const option = document.createElement('option');
               option.value = province.name;
               option.textContent = province.name;
               provinsiSelect.appendChild(option);
            });
         }

         // Handle Provinsi change - update Kabupaten/Kota
         if (provinsiSelect) {
            provinsiSelect.addEventListener('change', function() {
               const kotaKabupatenSelect = document.getElementById('kota_kabupaten');
               if (kotaKabupatenSelect && typeof regenciesIndonesia !== 'undefined') {
                  kotaKabupatenSelect.innerHTML = '<option value="">Pilih Kota/Kabupaten</option>';
                  
                  if (this.value) {
                     // Find province ID
                     const selectedProvince = provincesIndonesia.find(p => p.name === this.value);
                     if (selectedProvince) {
                        const regencies = getRegenciesByProvince(selectedProvince.id);
                        if (regencies.length > 0) {
                           kotaKabupatenSelect.disabled = false;
                           regencies.forEach(regency => {
                              const option = document.createElement('option');
                              option.value = regency;
                              option.textContent = regency;
                              kotaKabupatenSelect.appendChild(option);
                           });
                        } else {
                           kotaKabupatenSelect.disabled = false;
                           const option = document.createElement('option');
                           option.value = '';
                           option.textContent = 'Data kabupaten belum tersedia';
                           kotaKabupatenSelect.appendChild(option);
                        }
                     } else {
                        kotaKabupatenSelect.disabled = true;
                        kotaKabupatenSelect.innerHTML = '<option value="">Pilih Provinsi terlebih dahulu</option>';
                     }
                  } else {
                     kotaKabupatenSelect.disabled = true;
                     kotaKabupatenSelect.innerHTML = '<option value="">Pilih Provinsi terlebih dahulu</option>';
                  }
               }
            });
         }
      });
   </script>

</body>

</html>