<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Ujian - Ujian Online</title>
   <meta name="csrf-token" content="{{ csrf_token() }}">

   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   <!-- Bootstrap Icons -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

   <style>
      .exam-body {
         background-color: #f8f9fa;
      }

      .exam-timer-bar {
         background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
         color: white;
         padding: 1rem 0;
         box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      }

      .exam-container {
         padding-top: 2rem;
      }

      .question-sidebar {
         background: white;
         border-radius: 12px;
         padding: 1.5rem;
         box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
         height: fit-content;
         position: sticky;
         top: 2rem;
      }

      .question-grid {
         display: grid;
         grid-template-columns: repeat(5, 1fr);
         gap: 0.5rem;
         margin-bottom: 1rem;
      }

      .question-item {
         width: 40px;
         height: 40px;
         border-radius: 50%;
         display: flex;
         align-items: center;
         justify-content: center;
         margin: 0 auto;
         cursor: pointer;
         transition: all 0.3s;
         font-weight: bold;
         font-size: 0.9rem;
      }

      .question-item:hover {
         background-color: rgba(0, 123, 255, 0.1);
         transform: scale(1.05);
      }

      .question-item.active {
         background-color: #007bff;
         color: white;
         transform: scale(1.1);
      }

      .question-item.answered {
         background-color: #28a745;
         color: white;
      }

      .question-item.current {
         background-color: #007bff;
         color: white;
      }

      .question-item.unanswered {
         background-color: #e9ecef;
         color: #6c757d;
      }

      .exam-timer {
         font-family: "Courier New", monospace;
         font-weight: bold;
         color: #dc3545;
         animation: pulse 1s infinite;
      }

      @keyframes pulse {

         0%,
         100% {
            opacity: 1;
         }

         50% {
            opacity: 0.7;
         }
      }

      .question-card {
         background: white;
         border-radius: 12px;
         padding: 2rem;
         box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
         margin-bottom: 2rem;
      }

      .option-item {
         padding: 1rem;
         border: 2px solid #e9ecef;
         border-radius: 8px;
         margin-bottom: 0.5rem;
         cursor: pointer;
         transition: all 0.3s;
      }

      .option-item:hover {
         border-color: #007bff;
         background-color: rgba(0, 123, 255, 0.05);
      }

      .option-item.selected {
         border-color: #007bff;
         background-color: rgba(0, 123, 255, 0.1);
      }
   </style>
</head>

<body class="exam-body">
   <!-- Timer Bar -->
   <div class="exam-timer-bar">
      <div class="container">
         <div class="row align-items-center">
            <div class="col-md-6">
               <h5 class="mb-0">Ujian Matematika Dasar</h5>
            </div>
            <div class="col-md-6 text-end">
               <div class="exam-timer">
                  <i class="bi bi-clock me-2"></i>
                  <span id="timer">01:30:00</span>
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="container exam-container">
      <div class="row">
         <!-- Question Sidebar -->
         <div class="col-md-3">
            <div class="question-sidebar">
               <h6 class="mb-3">Navigasi Soal</h6>
               <div class="question-grid">
                  <div class="question-item current">1</div>
                  <div class="question-item answered">2</div>
                  <div class="question-item unanswered">3</div>
                  <div class="question-item unanswered">4</div>
                  <div class="question-item unanswered">5</div>
                  <div class="question-item unanswered">6</div>
                  <div class="question-item unanswered">7</div>
                  <div class="question-item unanswered">8</div>
                  <div class="question-item unanswered">9</div>
                  <div class="question-item unanswered">10</div>
               </div>

               <div class="legend">
                  <div class="legend-item">
                     <div class="legend-color answered"></div>
                     <small>Dijawab</small>
                  </div>
                  <div class="legend-item">
                     <div class="legend-color current"></div>
                     <small>Saat ini</small>
                  </div>
                  <div class="legend-item">
                     <div class="legend-color unanswered"></div>
                     <small>Belum dijawab</small>
                  </div>
               </div>
            </div>
         </div>

         <!-- Question Content -->
         <div class="col-md-9">
            <div class="question-card">
               <div class="d-flex justify-content-between align-items-center mb-4">
                  <h5>Soal 1 dari 10</h5>
                  <span class="badge bg-primary">Matematika</span>
               </div>

               <div class="question-content mb-4">
                  <p class="lead">Berapakah hasil dari 15 + 27?</p>
               </div>

               <div class="options">
                  <div class="option-item" onclick="selectOption(this)">
                     <div class="form-check">
                        <input class="form-check-input" type="radio" name="answer" value="A" id="optionA">
                        <label class="form-check-label" for="optionA">
                           A. 40
                        </label>
                     </div>
                  </div>
                  <div class="option-item" onclick="selectOption(this)">
                     <div class="form-check">
                        <input class="form-check-input" type="radio" name="answer" value="B" id="optionB">
                        <label class="form-check-label" for="optionB">
                           B. 42
                        </label>
                     </div>
                  </div>
                  <div class="option-item" onclick="selectOption(this)">
                     <div class="form-check">
                        <input class="form-check-input" type="radio" name="answer" value="C" id="optionC">
                        <label class="form-check-label" for="optionC">
                           C. 32
                        </label>
                     </div>
                  </div>
                  <div class="option-item" onclick="selectOption(this)">
                     <div class="form-check">
                        <input class="form-check-input" type="radio" name="answer" value="D" id="optionD">
                        <label class="form-check-label" for="optionD">
                           D. 52
                        </label>
                     </div>
                  </div>
               </div>

               <div class="d-flex justify-content-between mt-4">
                  <button class="btn btn-outline-secondary" onclick="previousQuestion()">
                     <i class="bi bi-chevron-left me-1"></i>
                     Sebelumnya
                  </button>
                  <button class="btn btn-primary" onclick="nextQuestion()">
                     Selanjutnya
                     <i class="bi bi-chevron-right ms-1"></i>
                  </button>
               </div>
            </div>

            <div class="text-center">
               <button class="btn btn-success btn-lg" onclick="submitExam()">
                  <i class="bi bi-check-circle me-2"></i>
                  Selesai Ujian
               </button>
            </div>
         </div>
      </div>
   </div>

   <!-- Bootstrap JS -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

   <script>
      // CSRF Token
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

      // Timer functionality
      let timeLeft = 90 * 60; // 90 minutes in seconds

      function updateTimer() {
         const hours = Math.floor(timeLeft / 3600);
         const minutes = Math.floor((timeLeft % 3600) / 60);
         const seconds = timeLeft % 60;

         document.getElementById('timer').textContent =
            `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

         if (timeLeft > 0) {
            timeLeft--;
         } else {
            alert('Waktu ujian telah habis!');
            submitExam();
         }
      }

      // Update timer every second
      setInterval(updateTimer, 1000);

      // Option selection
      function selectOption(element) {
         // Remove selected class from all options
         document.querySelectorAll('.option-item').forEach(item => {
            item.classList.remove('selected');
         });

         // Add selected class to clicked option
         element.classList.add('selected');

         // Check the radio button
         const radio = element.querySelector('input[type="radio"]');
         radio.checked = true;
      }

      // Navigation functions
      function previousQuestion() {
         // Implementation for previous question
         console.log('Previous question');
      }

      function nextQuestion() {
         // Implementation for next question
         console.log('Next question');
      }

      function submitExam() {
         if (confirm('Apakah Anda yakin ingin menyelesaikan ujian?')) {
            // Implementation for exam submission
            console.log('Exam submitted');
         }
      }
   </script>
</body>

</html>