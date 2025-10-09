<style>
   .sidebar {
      position: fixed;
      top: 0;
      left: 0;
      height: 100vh;
      width: 250px;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      z-index: 1000;
      overflow-y: auto;
   }

   .sidebar .nav-link {
      color: rgba(255, 255, 255, 0.9);
      padding: 14px 20px;
      margin: 2px 8px;
      transition: all 0.3s ease;
      font-weight: 500;
      font-size: 16px;
      display: flex;
      align-items: center;
      position: relative;
      border-radius: 8px;
      overflow: hidden;
      letter-spacing: 0.2px;
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      text-decoration: none;
      border: 2px solid transparent;
   }

   .sidebar .nav-link::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 8px;
      opacity: 0;
      transform: scale(0.95);
      transition: all 0.3s ease;
      z-index: -1;
   }

   .sidebar .nav-link::after {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(255, 255, 255, 0.15);
      border-radius: 8px;
      opacity: 0;
      transform: scale(0.9);
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      z-index: -1;
   }

   /* Background hover effect */
   .sidebar .nav-link:hover::before {
      opacity: 1;
      transform: scale(1);
   }

   .sidebar .nav-link:hover::after {
      opacity: 1;
      transform: scale(1);
   }


   .sidebar .nav-link:hover {
      color: white;
      transform: translateX(6px);
      font-weight: 600;
      background: transparent;
   }

   .sidebar .nav-link.active {
      color: white;
      font-weight: 600;
      transform: translateX(4px);
      background: transparent;
   }

   .sidebar .nav-link.active::before {
      opacity: 1;
      transform: scale(1);
   }

   .sidebar .nav-link.active::after {
      opacity: 1;
      transform: scale(1);
   }

   .sidebar .nav-link i {
      margin-right: 12px;
      font-size: 1.2em;
      transition: all 0.3s ease;
      width: 20px;
      text-align: center;
      opacity: 0.9;
   }

   .sidebar .nav-link:hover i {
      opacity: 1;
      transform: scale(1.05);
   }

   .sidebar h4 {
      color: white;
      font-weight: 600;
      font-size: 19px;
      margin-bottom: 24px;
      padding: 0 20px;
      letter-spacing: 0.3px;
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
   }

   .sidebar h6 {
      color: rgba(255, 255, 255, 0.8);
      font-weight: 500;
      font-size: 16px;
      margin-bottom: 18px;
      padding: 0 20px;
      letter-spacing: 0.2px;
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
   }

   .main-content {
      margin-left: 250px;
      background-color: #f8f9fa;
      min-height: 100vh;
      width: calc(100% - 250px);
      transition: margin-left 0.3s ease;
   }

   .stats-card {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      border: none;
   }

   .btn-primary {
      background-color: #667eea;
      border-color: #667eea;
   }

   .btn-primary:hover {
      background-color: #5a6fd8;
      border-color: #5a6fd8;
   }

   .btn-success {
      background-color: #28a745;
      border-color: #28a745;
   }

   .btn-success:hover {
      background-color: #218838;
      border-color: #1e7e34;
   }

   .table th {
      background-color: #667eea;
      color: white;
      border: none;
   }

   .modal-header {
      background-color: #667eea;
      color: white;
   }

   .form-control:focus {
      border-color: #667eea;
      box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
   }

   .navbar-brand {
      color: #667eea !important;
      font-weight: bold;
   }

   .exam-card {
      transition: all 0.3s ease;
      cursor: pointer;
   }

   .exam-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
   }

   /* Scrollbar styling for sidebar */
   .sidebar::-webkit-scrollbar {
      width: 6px;
   }

   .sidebar::-webkit-scrollbar-track {
      background: rgba(255, 255, 255, 0.1);
   }

   .sidebar::-webkit-scrollbar-thumb {
      background: rgba(255, 255, 255, 0.3);
      border-radius: 3px;
   }

   .sidebar::-webkit-scrollbar-thumb:hover {
      background: rgba(255, 255, 255, 0.5);
   }

   /* Additional hover effects */
   .sidebar .nav-link:active {
      transform: translateX(4px);
      border-color: rgba(255, 255, 255, 0.9);
   }

   /* Focus states for accessibility */
   .sidebar .nav-link:focus {
      outline: 2px solid rgba(255, 255, 255, 0.4);
      outline-offset: 2px;
   }

   /* Responsive Design */
   @media (max-width: 768px) {
      .sidebar {
         width: 100%;
         height: auto;
         position: relative;
         z-index: auto;
         box-shadow: none;
      }

      .main-content {
         margin-left: 0;
         width: 100%;
      }

      .sidebar .nav-link:hover {
         transform: translateX(0);
      }

      .sidebar .nav-link.active {
         transform: translateX(0);
      }
   }
</style>