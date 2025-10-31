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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 100vh;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }

        /* Animated background particles */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="20" cy="20" r="2" fill="rgba(255,255,255,0.1)"><animate attributeName="cy" values="20;80;20" dur="3s" repeatCount="indefinite"/></circle><circle cx="80" cy="40" r="2" fill="rgba(255,255,255,0.1)"><animate attributeName="cy" values="40;10;40" dur="4s" repeatCount="indefinite"/></circle></svg>');
            animation: float 20s ease-in-out infinite;
            z-index: 0;
            pointer-events: none;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }

        .completion-container {
            padding: 4rem 3rem;
            max-width: 900px;
            width: 100%;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .success-icon {
            width: 200px;
            height: 200px;
            margin: 0 auto 3rem;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: bounceIn 1s ease-out;
        }

        .cartoon-celebration {
            position: relative;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .party-face {
            font-size: 6rem;
            animation: partyBounce 1.5s ease-in-out infinite, partyRotate 3s ease-in-out infinite;
            position: relative;
            z-index: 2;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.2));
        }

        @keyframes partyBounce {

            0%,
            100% {
                transform: translateY(0) scale(1);
            }

            50% {
                transform: translateY(-20px) scale(1.1);
            }
        }

        @keyframes partyRotate {

            0%,
            100% {
                transform: rotate(0deg);
            }

            25% {
                transform: rotate(-10deg);
            }

            75% {
                transform: rotate(10deg);
            }
        }

        .party-emoji {
            position: absolute;
            font-size: 2rem;
            animation: floatAround 3s ease-in-out infinite;
            opacity: 0.9;
        }

        .party-emoji-1 {
            top: -20px;
            left: 50%;
            animation-delay: 0s;
            animation: floatUp 2s ease-out infinite;
        }

        .party-emoji-2 {
            top: 50%;
            right: -30px;
            animation-delay: 0.5s;
            animation: floatRight 2.5s ease-out infinite;
        }

        .party-emoji-3 {
            bottom: -20px;
            left: 30%;
            animation-delay: 1s;
            animation: floatDown 2s ease-out infinite;
        }

        .party-emoji-4 {
            top: 20%;
            left: -30px;
            animation-delay: 1.5s;
            animation: floatLeft 2.5s ease-out infinite;
        }

        @keyframes floatUp {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 0;
            }

            50% {
                opacity: 1;
            }

            100% {
                transform: translateY(-60px) rotate(360deg);
                opacity: 0;
            }
        }

        @keyframes floatRight {
            0% {
                transform: translateX(0) rotate(0deg);
                opacity: 0;
            }

            50% {
                opacity: 1;
            }

            100% {
                transform: translateX(60px) rotate(-360deg);
                opacity: 0;
            }
        }

        @keyframes floatDown {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 0;
            }

            50% {
                opacity: 1;
            }

            100% {
                transform: translateY(60px) rotate(360deg);
                opacity: 0;
            }
        }

        @keyframes floatLeft {
            0% {
                transform: translateX(0) rotate(0deg);
                opacity: 0;
            }

            50% {
                opacity: 1;
            }

            100% {
                transform: translateX(-60px) rotate(-360deg);
                opacity: 0;
            }
        }

        @keyframes floatAround {

            0%,
            100% {
                transform: translate(0, 0) rotate(0deg);
            }

            25% {
                transform: translate(20px, -20px) rotate(90deg);
            }

            50% {
                transform: translate(-20px, -20px) rotate(180deg);
            }

            75% {
                transform: translate(-20px, 20px) rotate(270deg);
            }
        }

        .success-icon::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(153, 27, 27, 0.2) 0%, transparent 70%);
            animation: ripple 2s ease-out infinite;
            z-index: 0;
        }

        @keyframes ripple {
            0% {
                transform: scale(1);
                opacity: 0.8;
            }

            100% {
                transform: scale(1.5);
                opacity: 0;
            }
        }


        @keyframes bounceIn {
            0% {
                transform: scale(0.3);
                opacity: 0;
            }

            50% {
                transform: scale(1.1);
            }

            70% {
                transform: scale(0.95);
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .completion-title {
            font-size: 3.5rem;
            font-weight: 900;
            color: #991B1B;
            margin-bottom: 1rem;
            animation: fadeInUp 0.8s ease-out 0.2s both;
            text-align: center;
            text-shadow: 0 2px 10px rgba(153, 27, 27, 0.2);
            letter-spacing: -1px;
        }

        .completion-subtitle {
            font-size: 1.5rem;
            color: #666;
            margin-bottom: 3rem;
            animation: fadeInUp 0.8s ease-out 0.4s both;
            text-align: center;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .completion-message {
            font-size: 1.2rem;
            color: #333;
            line-height: 1.8;
            margin-bottom: 3rem;
            animation: fadeInUp 0.8s ease-out 0.6s both;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            padding: 2rem;
            border-radius: 20px;
            border: 2px solid rgba(153, 27, 27, 0.2);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .completion-message::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            animation: shimmer 3s ease-in-out infinite;
        }

        @keyframes shimmer {
            0% {
                left: -100%;
            }

            100% {
                left: 100%;
            }
        }

        .section-title {
            background: linear-gradient(135deg, #991B1B 0%, #B91C1C 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
        }

        .section-title i {
            -webkit-text-fill-color: #991B1B;
            margin-right: 0.75rem;
            font-size: 1.8rem;
        }

        .action-buttons {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            flex-wrap: wrap;
            animation: fadeInUp 0.8s ease-out 1s both;
            margin-top: 3rem;
        }

        .btn-custom {
            padding: 1rem 2.5rem;
            border-radius: 50px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.1rem;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .btn-custom::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn-custom:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, #991B1B 0%, #B91C1C 50%, #DC2626 100%);
            color: white;
            position: relative;
            z-index: 1;
        }

        .btn-primary-custom:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 15px 40px rgba(153, 27, 27, 0.5), 0 0 60px rgba(185, 28, 28, 0.4);
            color: white;
        }

        .btn-primary-custom i {
            transition: transform 0.3s ease;
        }

        .btn-primary-custom:hover i {
            transform: translateX(5px);
        }

        .footer-message {
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 2px solid rgba(153, 27, 27, 0.2);
            color: #666;
            font-size: 1rem;
            animation: fadeInUp 0.8s ease-out 1.2s both;
            text-align: center;
            font-weight: 500;
        }

        .footer-message i {
            color: #991B1B;
            font-size: 1.2rem;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .confetti {
            position: fixed;
            width: 12px;
            height: 12px;
            background: #991B1B;
            animation: confetti-fall 3s ease-out forwards;
            opacity: 0;
            border-radius: 50%;
            z-index: 1000;
        }

        .confetti:nth-child(odd) {
            background: #B91C1C;
        }

        .confetti:nth-child(3n) {
            background: #DC2626;
        }

        .confetti:nth-child(4n) {
            background: #f39c12;
        }

        .confetti:nth-child(5n) {
            background: #e74c3c;
        }

        @keyframes confetti-fall {
            0% {
                transform: translateY(-100vh) rotate(0deg) scale(1);
                opacity: 1;
            }

            100% {
                transform: translateY(100vh) rotate(720deg) scale(0.5);
                opacity: 0;
            }
        }

        /* Floating elements */
        .floating-elements {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: 0;
        }

        .floating-circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: floatCircle 15s ease-in-out infinite;
        }

        .floating-circle:nth-child(1) {
            width: 200px;
            height: 200px;
            top: -50px;
            right: -50px;
            animation-delay: 0s;
        }

        .floating-circle:nth-child(2) {
            width: 150px;
            height: 150px;
            bottom: -30px;
            left: -30px;
            animation-delay: 2s;
        }

        .floating-circle:nth-child(3) {
            width: 100px;
            height: 100px;
            top: 50%;
            right: 10%;
            animation-delay: 4s;
        }

        @keyframes floatCircle {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
                opacity: 0.3;
            }

            50% {
                transform: translate(30px, -30px) scale(1.2);
                opacity: 0.5;
            }
        }

        @media (max-width: 768px) {
            .completion-container {
                padding: 3rem 2rem;
                margin: 1rem;
            }

            .completion-title {
                font-size: 2.5rem;
            }

            .completion-subtitle {
                font-size: 1.2rem;
            }

            .completion-message {
                padding: 2rem 1.5rem;
                font-size: 1.1rem;
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

            .success-icon {
                width: 120px;
                height: 120px;
            }

            .success-icon i {
                font-size: 3rem;
            }
        }
    </style>
</head>

<body>
    <!-- Floating Background Elements -->
    <div class="floating-elements">
        <div class="floating-circle"></div>
        <div class="floating-circle"></div>
        <div class="floating-circle"></div>
    </div>

    <div class="completion-container">
        <!-- Success Icon - Cartoon Animation -->
        <div class="success-icon">
            <div class="cartoon-celebration">
                <div class="party-face">🎉</div>
                <div class="party-emoji party-emoji-1">⭐</div>
                <div class="party-emoji party-emoji-2">✨</div>
                <div class="party-emoji party-emoji-3">🎊</div>
                <div class="party-emoji party-emoji-4">🎈</div>
            </div>
        </div>

        <!-- Title -->
        <h1 class="completion-title">🎉 Ujian Selesai! 🎉</h1>
        <p class="completion-subtitle">Selamat anda telah mengerjakan ujian online dengan baik dan jujur</p>

        <!-- Thank You Message -->
        <div class="completion-message">
            <p class="mb-0" style="font-size: 1.5rem; font-weight: 700; color: #991B1B; text-align: center;">
                ✨ Terima kasih telah menyelesaikan ujian! ✨
            </p>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <button class="btn-custom btn-primary-custom" onclick="logout()">
                <i class="bi bi-box-arrow-right"></i>
                Keluar
            </button>
        </div>

        <!-- Footer Message -->
        <div class="footer-message">
            <p><i class="bi bi-info-circle me-1"></i> Hasil ujian akan segera diproses</p>
        </div>
    </div>

   
    <div id="confetti-container"></div>

    <script>
     
        function createConfetti() {
            const colors = ['#991B1B', '#B91C1C', '#DC2626', '#f39c12', '#e74c3c', '#2ecc71'];
            const confettiContainer = document.getElementById('confetti-container');

          
            for (let i = 0; i < 50; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.left = Math.random() * 100 + '%';
                confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.animationDelay = Math.random() * 2 + 's';
                confetti.style.animationDuration = (Math.random() * 2 + 2) + 's';
                confettiContainer.appendChild(confetti);

              
                setTimeout(() => {
                    if (confetti.parentNode) {
                        confetti.parentNode.removeChild(confetti);
                    }
                }, 5000);
            }
        }

       
        function logout() {
            if (confirm('Apakah Anda yakin ingin keluar?')) {
                
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
                          
                            window.location.href = '/login';
                        }
                    })
                    .catch(error => {
                        console.error('Logout error:', error);
                        window.location.href = '/login';
                    });
            }
        }

    
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(createConfetti, 500);
        });
    </script>
</body>

</html>