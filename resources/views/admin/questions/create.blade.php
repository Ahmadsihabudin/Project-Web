<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Tambah Soal - Ujian Online</title>
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

      .answer-option {
         border: 1px solid #dee2e6;
         border-radius: 8px;
         padding: 1rem;
         margin-bottom: 1rem;
         background: white;
      }

      .answer-option.correct {
         border-color: #28a745;
         background-color: #f8fff9;
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
                     <h4 class="mb-2"><i class="bi bi-plus-circle me-2" style="color: #991B1B;"></i>Tambah Soal</h4>
                     <p class="mb-0">Tambah soal baru untuk ujian online</p>
                  </div>
                  <div class="col-md-4 text-end">
                     <a href="{{ route('admin.questions.index') }}" class="btn btn-light">
                        <i class="bi bi-arrow-left me-1"></i>
                        Kembali
                     </a>
                  </div>
               </div>
            </div>

            <!-- Form -->
            <div class="card">
               <div class="card-body">
                  <form id="createQuestionForm">
                     <div class="row">
                        <!-- Left Column -->
                        <div class="col-md-6">
                           <div class="form-section">
                              <h6 class="mb-3"><i class="bi bi-question-circle me-2"></i>Informasi Soal</h6>
                              <div class="mb-3">
                                 <label for="batch" class="form-label fw-bold">Batch</label>
                                 <select class="form-select" id="batch" name="batch">
                                    <option value="">Pilih Batch</option>
                                    @for ($i = 1; $i <= 20; $i++)
                                       <option value="Batch {{ $i }}">Batch {{ $i }}</option>
                                       @endfor
                                 </select>
                              </div>
                              <div class="mb-3">
                                 <label for="mata_pelajaran" class="form-label fw-bold">Mata Pelajaran <span class="text-danger">*</span></label>
                                 <input type="text" class="form-control" id="mata_pelajaran" name="mata_pelajaran" required placeholder="Masukkan mata pelajaran...">
                              </div>
                              <div class="mb-3">
                                 <label for="pertanyaan" class="form-label fw-bold">Pertanyaan <span class="text-danger">*</span></label>
                                 <textarea class="form-control" id="pertanyaan" name="pertanyaan" rows="4" required placeholder="Masukkan pertanyaan..."></textarea>
                              </div>
                              <div class="mb-3" id="gambarContainer" style="display: none;">
                                 <label for="gambar" class="form-label fw-bold">Gambar Soal</label>
                                 <input type="file" class="form-control" id="gambar" name="gambar" accept="image/jpeg,image/jpg,image/png,image/gif">
                                 <small class="form-text text-muted">Format: JPG, PNG, GIF. Maksimal 2MB</small>
                                 <div id="gambarPreview" class="mt-2" style="display: none;">
                                    <img id="gambarPreviewImg" src="" alt="Preview" class="img-thumbnail" style="max-width: 300px; max-height: 300px;">
                                 </div>
                              </div>
                              <div class="mb-3">
                                 <label for="tipe_soal" class="form-label fw-bold">Tipe Soal <span class="text-danger">*</span></label>
                                 <select class="form-select" id="tipe_soal" name="tipe_soal" required>
                                    <option value="">Pilih Tipe Soal</option>
                                    <option value="pilihan_ganda">Pilihan Ganda</option>
                                 </select>
                              </div>
                           </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-md-6">
                           <div class="form-section">
                              <h6 class="mb-3"><i class="bi bi-gear me-2"></i>Pengaturan</h6>
                              <div class="mb-3">
                                 <label for="poin" class="form-label fw-bold">Poin <span class="text-danger">*</span></label>
                                 <input type="number" class="form-control" id="poin" name="poin" min="1" max="100" value="10" required>
                              </div>
                              <div class="mb-3">
                                 <label for="durasi_soal" class="form-label fw-bold">Durasi Soal (Menit)</label>
                                 <input type="number" class="form-control" id="durasi_soal" name="durasi_soal" min="1" placeholder="Contoh: 5" value="">
                                 <div class="form-text">Waktu maksimal untuk mengerjakan soal ini (dalam menit). Kosongkan jika tidak ada batas waktu.</div>
                              </div>
                              <div class="mb-3">
                                 <label for="umpan_balik" class="form-label fw-bold">Umpan Balik</label>
                                 <textarea class="form-control" id="umpan_balik" name="umpan_balik" rows="3" placeholder="Masukkan umpan balik untuk soal ini (opsional)..."></textarea>
                                 <div class="form-text">Umpan balik akan ditampilkan kepada peserta setelah menjawab soal ini.</div>
                              </div>
                           </div>
                        </div>
                     </div>

                     <!-- Answer Options (for multiple choice) -->
                     <div class="row" id="answerOptionsSection" style="display: none;">
                        <div class="col-12">
                           <div class="form-section">
                              <h6 class="mb-3"><i class="bi bi-list-ul me-2"></i>Pilihan Jawaban</h6>

                              <div class="row mb-3">
                                 <div class="col-md-1">
                                    <label class="form-label fw-bold">A.</label>
                                 </div>
                                 <div class="col-md-11">
                                    <input type="text" class="form-control" name="opsi_a" id="opsi_a" placeholder="Masukkan Jawaban A...">
                                 </div>
                              </div>

                              <div class="row mb-3">
                                 <div class="col-md-1">
                                    <label class="form-label fw-bold">B.</label>
                                 </div>
                                 <div class="col-md-11">
                                    <input type="text" class="form-control" name="opsi_b" id="opsi_b" placeholder="Masukkan Jawaban B...">
                                 </div>
                              </div>

                              <div class="row mb-3">
                                 <div class="col-md-1">
                                    <label class="form-label fw-bold">C.</label>
                                 </div>
                                 <div class="col-md-11">
                                    <input type="text" class="form-control" name="opsi_c" id="opsi_c" placeholder="Masukkan Jawaban C...">
                                 </div>
                              </div>

                              <div class="row mb-3">
                                 <div class="col-md-1">
                                    <label class="form-label fw-bold">D.</label>
                                 </div>
                                 <div class="col-md-11">
                                    <input type="text" class="form-control" name="opsi_d" id="opsi_d" placeholder="Masukkan Jawaban D...">
                                 </div>
                              </div>

                              <div class="row mb-3">
                                 <div class="col-md-1">
                                    <label class="form-label fw-bold">E.</label>
                                 </div>
                                 <div class="col-md-11">
                                    <input type="text" class="form-control" name="opsi_e" id="opsi_e" placeholder="Masukkan Jawaban E...">
                                 </div>
                              </div>

                              <div class="row mb-3">
                                 <div class="col-md-1">
                                    <label class="form-label fw-bold">F.</label>
                                 </div>
                                 <div class="col-md-11">
                                    <input type="text" class="form-control" name="opsi_f" id="opsi_f" placeholder="Masukkan Jawaban F...">
                                 </div>
                              </div>

                              <!-- Jawaban Benar untuk Pilihan Ganda -->
                              <div class="row mb-3" id="jawabanPilihanGanda">
                                 <div class="col-md-12">
                                    <label class="form-label fw-bold">Jawaban Benar <span class="text-danger">*</span></label>
                                    <div class="row">
                                       <div class="col-md-2">
                                          <div class="form-check">
                                             <input class="form-check-input" type="radio" name="jawaban_benar" id="jawaban_a" value="a">
                                             <label class="form-check-label" for="jawaban_a">A</label>
                                          </div>
                                       </div>
                                       <div class="col-md-2">
                                          <div class="form-check">
                                             <input class="form-check-input" type="radio" name="jawaban_benar" id="jawaban_b" value="b">
                                             <label class="form-check-label" for="jawaban_b">B</label>
                                          </div>
                                       </div>
                                       <div class="col-md-2">
                                          <div class="form-check">
                                             <input class="form-check-input" type="radio" name="jawaban_benar" id="jawaban_c" value="c">
                                             <label class="form-check-label" for="jawaban_c">C</label>
                                          </div>
                                       </div>
                                       <div class="col-md-2">
                                          <div class="form-check">
                                             <input class="form-check-input" type="radio" name="jawaban_benar" id="jawaban_d" value="d">
                                             <label class="form-check-label" for="jawaban_d">D</label>
                                          </div>
                                       </div>
                                       <div class="col-md-2">
                                          <div class="form-check">
                                             <input class="form-check-input" type="radio" name="jawaban_benar" id="jawaban_e" value="e">
                                             <label class="form-check-label" for="jawaban_e">E</label>
                                          </div>
                                       </div>
                                       <div class="col-md-2">
                                          <div class="form-check">
                                             <input class="form-check-input" type="radio" name="jawaban_benar" id="jawaban_f" value="f">
                                             <label class="form-check-label" for="jawaban_f">F</label>
                                          </div>
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
                           <button type="submit" class="btn btn-success theme-btn">
                              <i class="bi bi-plus-circle me-1"></i>
                              Tambah Soal
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
      let answerOptionCount = 0;



      // Generate answer options for multiple choice
      function generateAnswerOptions() {
         const tipeSoal = document.getElementById('tipe_soal').value;
         const answerOptionsSection = document.getElementById('answerOptionsSection');
         const jawabanPilihanGanda = document.getElementById('jawabanPilihanGanda');

         if (tipeSoal === 'pilihan_ganda') {
            answerOptionsSection.style.display = 'block';
            jawabanPilihanGanda.style.display = 'block';
         } else {
            answerOptionsSection.style.display = 'none';
            jawabanPilihanGanda.style.display = 'none';
         }
      }


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
         const pertanyaan = form.querySelector('#pertanyaan').value.trim();
         const mataPelajaran = form.querySelector('#mata_pelajaran').value.trim();
         const tipeSoal = form.querySelector('#tipe_soal').value;
         const poin = form.querySelector('#poin').value;

         if (!pertanyaan) {
            await Swal.fire({
               icon: 'warning',
               title: 'Validasi Gagal',
               text: 'Pertanyaan harus diisi!',
               confirmButtonText: 'OK',
               confirmButtonColor: '#991B1B'
            });
            form.querySelector('#pertanyaan').focus();
            return;
         }

         if (!mataPelajaran) {
            await Swal.fire({
               icon: 'warning',
               title: 'Validasi Gagal',
               text: 'Mata Pelajaran harus diisi!',
               confirmButtonText: 'OK',
               confirmButtonColor: '#991B1B'
            });
            form.querySelector('#mata_pelajaran').focus();
            return;
         }

         if (!tipeSoal) {
            await Swal.fire({
               icon: 'warning',
               title: 'Validasi Gagal',
               text: 'Tipe Soal harus dipilih!',
               confirmButtonText: 'OK',
               confirmButtonColor: '#991B1B'
            });
            form.querySelector('#tipe_soal').focus();
            return;
         }

         if (!poin || poin < 1) {
            await Swal.fire({
               icon: 'warning',
               title: 'Validasi Gagal',
               text: 'Poin harus diisi dan minimal 1!',
               confirmButtonText: 'OK',
               confirmButtonColor: '#991B1B'
            });
            form.querySelector('#poin').focus();
            return;
         }


         // Validasi untuk pilihan ganda
         if (tipeSoal === 'pilihan_ganda') {
            const opsiA = form.querySelector('#opsi_a').value.trim();
            const opsiB = form.querySelector('#opsi_b').value.trim();
            const opsiC = form.querySelector('#opsi_c').value.trim();
            const opsiD = form.querySelector('#opsi_d').value.trim();
            const jawabanBenar = form.querySelector('input[name="jawaban_benar"]:checked');

            if (!opsiA || !opsiB || !opsiC || !opsiD) {
               await Swal.fire({
                  icon: 'warning',
                  title: 'Validasi Gagal',
                  text: 'Semua opsi jawaban (A, B, C, D) harus diisi!',
                  confirmButtonText: 'OK',
                  confirmButtonColor: '#991B1B'
               });
               return;
            }

            if (!jawabanBenar) {
               await Swal.fire({
                  icon: 'warning',
                  title: 'Validasi Gagal',
                  text: 'Pilih jawaban yang benar (A, B, C, atau D)!',
                  confirmButtonText: 'OK',
                  confirmButtonColor: '#991B1B'
               });
               return;
            }
         }


         console.log('Form validation passed');

         const loadingAlert = alertSystem.loading('Menambahkan soal...');

         try {
            const formData = new FormData(event.target);

            // Add image if exists
            const gambarInput = document.getElementById('gambar');
            if (gambarInput && gambarInput.files.length > 0) {
               formData.append('gambar', gambarInput.files[0]);
            }

            // Ensure durasi_soal is included
            const durasiSoal = document.getElementById('durasi_soal').value;
            if (durasiSoal) {
               formData.append('durasi_soal', durasiSoal);
            }

            console.log('Form Data to be sent:', formData);

            const response = await fetch('/admin/questions', {
               method: 'POST',
               headers: {
                  'X-CSRF-TOKEN': csrfToken
               },
               body: formData
            });

            const result = await response.json();
            alertSystem.hide(loadingAlert);

            if (result.success) {
               alertSystem.createSuccess('Soal');

               // Redirect to index page
               window.location.href = '{{ route("admin.questions.index") }}';
            } else {
               alertSystem.error('Gagal menyimpan', result.message || 'Terjadi kesalahan');
            }
         } catch (error) {
            console.error('Error saving question:', error);
            alertSystem.hide(loadingAlert);
            alertSystem.error('Gagal menyimpan', 'Terjadi kesalahan jaringan: ' + error.message);
         }
      }

      // Initialize on page load
      document.addEventListener('DOMContentLoaded', function() {
         console.log('DOM Content Loaded');

         // Load data

         // Add form listeners
         const createForm = document.getElementById('createQuestionForm');
         const tipeSoalSelect = document.getElementById('tipe_soal');

         if (createForm) {
            createForm.addEventListener('submit', handleCreateForm);
         }

         const gambarContainer = document.getElementById('gambarContainer');
         const gambarInput = document.getElementById('gambar');
         const gambarPreview = document.getElementById('gambarPreview');
         const gambarPreviewImg = document.getElementById('gambarPreviewImg');

         if (tipeSoalSelect) {
            tipeSoalSelect.addEventListener('change', function() {
               generateAnswerOptions();
               // Show/hide gambar field based on tipe soal
               if (gambarContainer) {
                  if (this.value === 'pilihan_ganda') {
                     gambarContainer.style.display = 'block';
                  } else {
                     gambarContainer.style.display = 'none';
                     if (gambarInput) gambarInput.value = '';
                     if (gambarPreview) gambarPreview.style.display = 'none';
                  }
               }
            });
         }

         // Preview gambar when file is selected
         if (gambarInput && gambarPreview && gambarPreviewImg) {
            gambarInput.addEventListener('change', function(e) {
               const file = e.target.files[0];
               if (file) {
                  const reader = new FileReader();
                  reader.onload = function(e) {
                     gambarPreviewImg.src = e.target.result;
                     gambarPreview.style.display = 'block';
                  };
                  reader.readAsDataURL(file);
               } else {
                  gambarPreview.style.display = 'none';
               }
            });
         }

         // Add real-time validation for form fields
         const requiredFields = ['pertanyaan', 'tipe_soal', 'poin'];

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