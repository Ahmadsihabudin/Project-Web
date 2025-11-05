<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>@yield('title', 'Ujian Online')</title>
   <meta name="csrf-token" content="{{ csrf_token() }}">

   
   <link rel="icon" type="image/png" href="{{ asset('images/Favicon_akti.png') }}">

   
   @vite(['resources/css/app.css', 'resources/css/exam/style.css'])
   
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" />

   
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

   <style>
      /* Custom CSS for aesthetics */
      .sidebar {
         min-height: 100vh;
         background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
         transition: all 0.3s;
      }

      .sidebar .nav-link {
         color: rgba(255, 255, 255, 0.8);
         border-radius: 8px;
         margin: 2px 0;
         transition: all 0.3s;
      }

      .sidebar .nav-link:hover,
      .sidebar .nav-link.active {
         color: white;
         background-color: rgba(255, 255, 255, 0.1);
         transform: translateX(5px);
      }

      .main-content {
         background-color: #f8f9fa;
         min-height: 100vh;
      }

      .card {
         border: none;
         border-radius: 12px;
         box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
         transition: transform 0.2s, box-shadow 0.2s;
      }

      .card:hover {
         transform: translateY(-2px);
         box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
      }

      .stats-card {
         background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
         color: white;
      }

      .stats-card .card-body {
         padding: 1.5rem;
      }

      .btn-primary {
         background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
         border: none;
         border-radius: 8px;
      }

      .btn-primary:hover {
         background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
         transform: translateY(-1px);
      }

      .table th {
         background-color: #f8f9fa;
         border-top: none;
         font-weight: 600;
         color: #495057;
      }

      .badge {
         border-radius: 6px;
         padding: 0.5em 0.75em;
      }

      .exam-card {
         transition: all 0.3s;
         cursor: pointer;
      }

      .exam-card:hover {
         transform: translateY(-3px);
         box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
      }

      .participant-card {
         background: white;
         border-radius: 12px;
         padding: 1rem;
         box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
         transition: all 0.3s;
      }

      .participant-card:hover {
         transform: scale(1.02);
         box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
      }

      .webcam-thumbnail {
         width: 100%;
         height: 120px;
         background: linear-gradient(45deg, #f0f0f0, #e0e0e0);
         border-radius: 8px;
         display: flex;
         align-items: center;
         justify-content: center;
         color: #666;
         font-size: 0.9rem;
      }

      .timer {
         font-family: "Courier New", monospace;
         font-weight: bold;
         color: #dc3545;
      }

      .question-nav {
         position: sticky;
         top: 20px;
      }

      .question-item {
         width: 40px;
         height: 40px;
         border-radius: 50%;
         display: flex;
         align-items: center;
         justify-content: center;
         margin: 5px;
         cursor: pointer;
         transition: all 0.3s;
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

      .auto-save-indicator {
         position: fixed;
         top: 20px;
         right: 20px;
         z-index: 1050;
      }

      .fade-in {
         animation: fadeIn 0.5s ease-in;
      }

      @keyframes fadeIn {
         from {
            opacity: 0;
            transform: translateY(20px);
         }

         to {
            opacity: 1;
            transform: translateY(0);
         }
      }

      .wizard-step {
         display: none;
      }

      .wizard-step.active {
         display: block;
      }

      .progress-bar {
         background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      }

      /* Mobile responsive adjustments */
      @media (max-width: 768px) {
         .sidebar {
            position: fixed;
            top: 0;
            left: -250px;
            width: 250px;
            z-index: 1040;
            transition: left 0.3s;
         }

         .sidebar.show {
            left: 0;
         }

         .main-content {
            margin-left: 0;
         }
      }
   </style>

   @stack('styles')
</head>

<body>
   
   <div class="auto-save-indicator" id="autoSaveIndicator" style="display: none">
      <div class="alert alert-success alert-dismissible fade show" role="alert">
         <i class="bi bi-check-circle me-2"></i>
         <span id="autoSaveText">Auto-saved</span>
      </div>
   </div>

   <div class="container-fluid">
      <div class="row">
         @hasSection('sidebar')
         
         <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse" id="sidebar">
            @yield('sidebar')
         </nav>
         @endif

         
         <main class="@hasSection('sidebar') col-md-9 ms-sm-auto col-lg-10 @else col-12 @endif px-md-4 main-content">
            @hasSection('navbar')
            
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
               @yield('navbar')
            </div>
            @endif

            
            <div id="pageContent">
               @yield('content')
            </div>
         </main>
      </div>
   </div>

   @hasSection('footer')
   
   <footer class="bg-dark text-light py-4 mt-5">
      @yield('footer')
   </footer>
   @endif

   
   @vite(['resources/js/app.js'])

   @stack('scripts')
</body>

</html>