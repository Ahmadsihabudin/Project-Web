<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Edit Soal - Ujian Online</title>
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
         <div class="p-4" data-question-id="{{ $id ?? '' }}">
            <!-- Page Header -->
            <div class="page-header">
               <div class="row align-items-center">
                  <div class="col-md-8">
                     <h4 class="mb-2"><i class="bi bi-pencil-square me-2" style="color: #991B1B;"></i>Edit Soal</h4>
                     <p class="mb-0">Ubah informasi soal</p>
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
                  <form id="editQuestionForm">
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
                              <div class="mb-3">
                                 <label for="tipe_soal" class="form-label fw-bold">Tipe Soal <span class="text-danger">*</span></label>
                                 <select class="form-select" id="tipe_soal" name="tipe_soal" required>
                                    <option value="">Pilih Tipe Soal</option>
                                    <option value="pilihan_ganda">Pilihan Ganda</option>
                                    <option value="essay">Essay</option>
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
                                 <input type="number" class="form-control" id="poin" name="poin" min="1" max="100" required>
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

                              <!-- Jawaban Benar untuk Essay dan Benar/Salah -->
                              <div class="row mb-3" id="jawabanEssay" style="display: none;">
                                 <div class="col-md-12">
                                    <label for="jawaban_benar_essay" class="form-label fw-bold">Jawaban Benar <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="jawaban_benar_essay" id="jawaban_benar_essay" rows="3" placeholder="Masukkan jawaban yang benar..."></textarea>
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
                              Update Soal
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
      const questionId = document.querySelector('[data-question-id]').getAttribute('data-question-id');
      let answerOptionCount = 0;



      // Helper function untuk tipe soal
      function getTipeSoalText(tipe) {
         const tipeMap = {
            'pilihan_ganda': 'Pilihan Ganda',
            'essay': 'Essay',
            'benar_salah': 'Benar/Salah'
         };
         return tipeMap[tipe] || tipe || 'Pilihan Ganda';
      }

      // Load question data for editing
      async function loadQuestionData(id) {
         try {
            const response = await fetch(`/admin/questions/${id}`, {
               method: 'GET',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
               }
            });

            if (response.ok) {
               const result = await response.json();
               if (result.success) {
                  const question = result.data;

                  // Fill form fields
                  document.getElementById('batch').value = question.batch || '';
                  document.getElementById('mata_pelajaran').value = question.mata_pelajaran || '';
                  document.getElementById('pertanyaan').value = question.pertanyaan || '';
                  document.getElementById('tipe_soal').value = question.tipe_soal || '';
                  document.getElementById('poin').value = question.poin || '';
                  document.getElementById('umpan_balik').value = question.umpan_balik || '';

                  // Generate answer options if it's multiple choice
                  if (question.tipe_soal === 'pilihan_ganda') {
                     generateAnswerOptions();

                     // Load existing answer options
                     document.getElementById('opsi_a').value = question.opsi_a || '';
                     document.getElementById('opsi_b').value = question.opsi_b || '';
                     document.getElementById('opsi_c').value = question.opsi_c || '';
                     document.getElementById('opsi_d').value = question.opsi_d || '';
                     document.getElementById('opsi_e').value = question.opsi_e || '';
                     document.getElementById('opsi_f').value = question.opsi_f || '';

                     // Set correct answer
                     if (question.jawaban_benar) {
                        const correctRadio = document.getElementById(`jawaban_${question.jawaban_benar}`);
                        if (correctRadio) correctRadio.checked = true;
                     }
                  } else if (question.tipe_soal === 'essay' || question.tipe_soal === 'benar_salah') {
                     document.getElementById('jawaban_benar_essay').value = question.jawaban_benar || '';
                  }
               }
            }
         } catch (error) {
            console.error('Error loading question data:', error);
            alertSystem.error('Gagal memuat data', 'Terjadi kesalahan saat memuat data');
         }
      }

      // Generate answer options for multiple choice
      function generateAnswerOptions() {
         const tipeSoal = document.getElementById('tipe_soal').value;
         const answerOptionsSection = document.getElementById('answerOptionsSection');
         const jawabanPilihanGanda = document.getElementById('jawabanPilihanGanda');
         const jawabanEssay = document.getElementById('jawabanEssay');

         if (tipeSoal === 'pilihan_ganda') {
            answerOptionsSection.style.display = 'block';
            jawabanPilihanGanda.style.display = 'block';
            jawabanEssay.style.display = 'none';
         } else if (tipeSoal === 'essay') {
            answerOptionsSection.style.display = 'none';
            jawabanPilihanGanda.style.display = 'none';
            jawabanEssay.style.display = 'block';
         } else {
            answerOptionsSection.style.display = 'none';
            jawabanPilihanGanda.style.display = 'none';
            jawabanEssay.style.display = 'none';
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
         const pertanyaan = form.querySelector('#pertanyaan').value.trim();
         const mataPelajaran = form.querySelector('#mata_pelajaran').value.trim();
         const tipeSoal = form.querySelector('#tipe_soal').value;
         const poin = form.querySelector('#poin').value;

         if (!pertanyaan) {
            alert('Pertanyaan harus diisi!');
            form.querySelector('#pertanyaan').focus();
            return;
         }

         if (!mataPelajaran) {
            alert('Mata Pelajaran harus diisi!');
            form.querySelector('#mata_pelajaran').focus();
            return;
         }

         if (!tipeSoal) {
            alert('Tipe Soal harus dipilih!');
            form.querySelector('#tipe_soal').focus();
            return;
         }

         if (!poin || poin < 1) {
            alert('Poin harus diisi dan minimal 1!');
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
               alert('Semua opsi jawaban (A, B, C, D) harus diisi!');
               return;
            }

            if (!jawabanBenar) {
               alert('Pilih jawaban yang benar (A, B, C, D, E, atau F)!');
               return;
            }
         }

         // Validasi untuk essay
         if (tipeSoal === 'essay') {
            const jawabanBenarEssay = form.querySelector('#jawaban_benar_essay').value.trim();

            if (!jawabanBenarEssay) {
               alert('Jawaban benar harus diisi!');
               return;
            }
         }

         console.log('Form validation passed');

         const loadingAlert = alertSystem.loading('Memperbarui soal...');

         try {
            const formData = new FormData(event.target);

            const questionData = {
               batch: formData.get('batch') || null,
               pertanyaan: formData.get('pertanyaan'),
               mata_pelajaran: formData.get('mata_pelajaran'),
               tipe_soal: formData.get('tipe_soal'),
               poin: parseInt(formData.get('poin')) || 1,
               umpan_balik: formData.get('umpan_balik') || null
            };

            // Handle jawaban benar berdasarkan tipe soal
            if (tipeSoal === 'pilihan_ganda') {
               questionData.jawaban_benar = formData.get('jawaban_benar');
               questionData.opsi_a = formData.get('opsi_a') || '';
               questionData.opsi_b = formData.get('opsi_b') || '';
               questionData.opsi_c = formData.get('opsi_c') || '';
               questionData.opsi_d = formData.get('opsi_d') || '';
               questionData.opsi_e = formData.get('opsi_e') || '';
               questionData.opsi_f = formData.get('opsi_f') || '';
            } else if (tipeSoal === 'essay') {
               questionData.jawaban_benar = formData.get('jawaban_benar_essay');
               questionData.opsi_a = '';
               questionData.opsi_b = '';
               questionData.opsi_c = '';
               questionData.opsi_d = '';
               questionData.opsi_e = '';
               questionData.opsi_f = '';
            }

            console.log('Question Data to be sent:', questionData);

            const response = await fetch(`/admin/questions/${questionId}`, {
               method: 'PUT',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
               },
               body: JSON.stringify(questionData)
            });

            const result = await response.json();
            alertSystem.hide(loadingAlert);

            if (result.success) {
               alertSystem.updateSuccess('Soal');

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

         // Load question data if ID is provided
         if (questionId) {
            loadQuestionData(questionId);
         }

         // Add form listeners
         const editForm = document.getElementById('editQuestionForm');
         const tipeSoalSelect = document.getElementById('tipe_soal');

         if (editForm) {
            editForm.addEventListener('submit', handleEditForm);
         }

         if (tipeSoalSelect) {
            tipeSoalSelect.addEventListener('change', generateAnswerOptions);
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