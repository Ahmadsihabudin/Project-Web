<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ujian Selesai - Ujian Online</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
            min-height: 100vh;
            padding: 20px;
        }
        
        .completion-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            max-width: 800px;
            width: 100%;
            margin: 0 auto;
            position: relative;
            overflow: hidden;
        }
        
        .completion-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .success-icon {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            animation: bounceIn 0.8s ease-out;
        }
        
        .success-icon i {
            font-size: 3rem;
            color: white;
        }
        
        @keyframes bounceIn {
            0% {
                transform: scale(0.3);
                opacity: 0;
            }
            50% {
                transform: scale(1.05);
            }
            70% {
                transform: scale(0.9);
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }
        
        .completion-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 1rem;
            animation: fadeInUp 0.8s ease-out 0.2s both;
        }
        
        .completion-subtitle {
            font-size: 1.2rem;
            color: #7f8c8d;
            margin-bottom: 2rem;
            animation: fadeInUp 0.8s ease-out 0.4s both;
        }
        
        .completion-message {
            font-size: 1.1rem;
            color: #34495e;
            line-height: 1.6;
            margin-bottom: 2.5rem;
            animation: fadeInUp 0.8s ease-out 0.6s both;
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 10px;
            border-left: 4px solid #667eea;
        }
        
        .section-title {
            color: #667eea;
            font-weight: 600;
            font-size: 1.2rem;
        }
        
        .exam-details {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            animation: fadeInUp 0.8s ease-out 0.8s both;
        }
        
        .detail-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid #e9ecef;
        }
        
        .detail-item:last-child {
            border-bottom: none;
        }
        
        .detail-label {
            font-weight: 600;
            color: #495057;
        }
        
        .detail-value {
            font-weight: 500;
            color: #2c3e50;
        }
        
        .score-badge {
            background: linear-gradient(135deg, #4CAF50, #45a049);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-weight: 600;
            font-size: 1.1rem;
        }
        
        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            animation: fadeInUp 0.8s ease-out 1s both;
        }
        
        .btn-custom {
            padding: 0.75rem 2rem;
            border-radius: 25px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .btn-primary-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .btn-primary-custom:hover {
            background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
            color: white;
        }
        
        .btn-secondary-custom {
            background: #f8f9fa;
            color: #6c757d;
            border: 1px solid #dee2e6;
        }
        
        .btn-secondary-custom:hover {
            background: #d5dbdb;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            color: #2c3e50;
        }
        
        .footer-message {
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e9ecef;
            color: #7f8c8d;
            font-size: 0.9rem;
            animation: fadeInUp 0.8s ease-out 1.2s both;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .confetti {
            position: absolute;
            width: 8px;
            height: 8px;
            background: #667eea;
            animation: confetti-fall 2s ease-out forwards;
            opacity: 0;
            animation-iteration-count: 1; /* Hanya sekali */
        }
        
        .confetti:nth-child(odd) {
            background: #764ba2;
        }
        
        .confetti:nth-child(3n) {
            background: #f39c12;
        }
        
        .confetti:nth-child(4n) {
            background: #e74c3c;
        }
        
        @keyframes confetti-fall {
            0% {
                transform: translateY(-100vh) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(100vh) rotate(360deg);
                opacity: 0;
                visibility: hidden; /* Sembunyikan setelah animasi */
            }
        }
        
        @media (max-width: 768px) {
            .completion-container {
                padding: 2rem 1.5rem;
                margin: 1rem;
            }
            
            .completion-title {
                font-size: 2rem;
            }
            
            .completion-subtitle {
                font-size: 1rem;
            }
            
            .action-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .btn-custom {
                width: 100%;
                max-width: 300px;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="completion-container">
        <!-- Success Icon -->
        <div class="success-icon">
            <i class="bi bi-check-circle-fill"></i>
        </div>
        
        <!-- Title -->
        <h1 class="completion-title">Ujian Selesai!</h1>
        <p class="completion-subtitle">Terima kasih telah menyelesaikan ujian</p>
        
        <!-- Thank You Message -->
        <div class="completion-message">
            <h5 class="section-title mb-3">
                <i class="bi bi-heart me-2"></i>
                Terima Kasih
            </h5>
            <p class="mb-3">Terima kasih telah menyelesaikan ujian</p>
            <p class="mb-3"><strong>Selamat! Anda telah berhasil menyelesaikan ujian dengan baik. Dedikasi dan usaha Anda dalam mengerjakan setiap soal sangat dihargai.</strong></p>
            <p class="mb-0">Hasil ujian Anda telah tersimpan dan akan diproses oleh tim evaluator. Silakan tunggu informasi lebih lanjut mengenai hasil ujian.</p>
        </div>
        
        <!-- Action Buttons -->
        <div class="action-buttons">
            <button class="btn-custom btn-primary-custom" onclick="window.location.href='/student/information'">
                <i class="bi bi-house"></i>
                Kembali ke Beranda
            </button>
            <button class="btn-custom btn-secondary-custom" onclick="logout()">
                <i class="bi bi-box-arrow-right"></i>
                Keluar
            </button>
        </div>
        
        <!-- Footer Message -->
        <div class="footer-message">
            <p><i class="bi bi-info-circle me-1"></i> Jika Anda memiliki pertanyaan atau memerlukan bantuan, silakan hubungi administrator ujian.</p>
        </div>
    </div>
    
    <!-- Confetti Animation -->
    <div id="confetti-container"></div>
    
    <script>
        // Confetti animation - hanya sekali dan sebentar
        function createConfetti() {
            const colors = ['#667eea', '#764ba2', '#f39c12', '#e74c3c', '#2ecc71'];
            const confettiContainer = document.getElementById('confetti-container');
            
            // Hanya buat 20 confetti untuk efek yang lebih ringan
            for (let i = 0; i < 20; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.left = Math.random() * 100 + '%';
                confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.animationDelay = Math.random() * 0.5 + 's'; // Delay lebih pendek
                confetti.style.animationDuration = '2s'; // Durasi tetap 2 detik
                confettiContainer.appendChild(confetti);
                
                // Hapus confetti setelah animasi selesai
                setTimeout(() => {
                    if (confetti.parentNode) {
                        confetti.parentNode.removeChild(confetti);
                    }
                }, 2500); // Hapus setelah 2.5 detik
            }
        }
        
        // Logout function
        function logout() {
            if (confirm('Apakah Anda yakin ingin keluar?')) {
                // Clear session and redirect to login
                fetch('/logout', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => {
                    if (response.ok) {
                        window.location.href = '/login';
                    } else {
                        // Fallback: direct redirect
                        window.location.href = '/login';
                    }
                })
                .catch(error => {
                    console.error('Logout error:', error);
                    window.location.href = '/login';
                });
            }
        }
        
        // Start confetti animation on page load
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(createConfetti, 500);
        });
    </script>
</body>
</html>
