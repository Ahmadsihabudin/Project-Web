@extends('layouts.student-navbar')

@section('title', 'Verifikasi Wajah')

@section('content')
<!-- Tambahkan tag meta CSRF yang hilang -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
   body {
        background: #f4f6f9;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .verify-container {
        max-width: 600px;
        margin: 40px auto;
        padding: 2rem;
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        text-align: center;
    }
    .verify-container h2 {
        font-weight: 700;
        color: #333;
        margin-bottom: 0.5rem;
    }
    .verify-container p {
        color: #666;
        margin-bottom: 1.5rem;
    }
    #video {
        width: 100%;
        height: auto;
        aspect-ratio: 4 / 3;
        background: #000;
        border-radius: 10px;
        object-fit: cover;
        border: 3px solid #eee;
    }
    #status {
        font-weight: bold;
        margin: 1.5rem 0;
        font-size: 1.1rem;
        transition: color 0.3s;
    }
    #status.error { color: #dc3545; }
    #status.success { color: #198754; }

    #btn-verify {
        background: linear-gradient(135deg, #991B1B, #B91C1C);
        color: white;
        padding: 12px 25px;
        border: none;
        border-radius: 50px;
        cursor: pointer;
        font-size: 1rem;
        font-weight: bold;
        width: 100%;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(153, 27, 27, 0.3);
    }
    #btn-verify:disabled {
        background: #6c757d;
        cursor: not-allowed;
        box-shadow: none;
    }
    #btn-verify:not(:disabled):hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(153, 27, 27, 0.4);
    }
    .alert-error {
        background-color: #f8d7da;
        color: #721c24;
        padding: 1rem;
        border: 1px solid #f5c6cb;
        border-radius: 8px;
        margin-bottom: 1.5rem;
    }
</style>

<div class="verify-container">
    @if(session('error'))
        <div class="alert-error">{{ session('error') }}</div>
    @endif

    <h2>Verifikasi Wajah</h2>
    <p>Ujian: <strong>{{ optional($sesiUjian->ujian)->nama_ujian ?? 'Ujian ' . $sesiUjian->mata_pelajaran }}</strong></p>

    <img id="ref-img" src="{{ asset('storage/' . $peserta->foto) }}" style="display: none;" crossorigin="anonymous">

    <video id="video" autoplay muted></video>
    <div id="status">Memuat sistem...</div>
    <button id="btn-verify" disabled>
        <i class="bi bi-camera-video me-2"></i>
        Ambil Foto & Verifikasi
    </button>
</div>

<script src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js"></script>

<script>
    const video = document.getElementById('video');
    const btnVerify = document.getElementById('btn-verify');
    const statusText = document.getElementById('status');
    const refImg = document.getElementById('ref-img');
    const ID_SESI_UJIAN = {{ $id_sesi }};
    
    const MODEL_URL = "https://cdn.jsdelivr.net/gh/justadudewhohacks/face-api.js@0.22.2/weights";
    let faceMatcher = null;

    // 1. LOAD MODEL
    Promise.all([
        faceapi.nets.tinyFaceDetector.loadFromUri(MODEL_URL),
        faceapi.nets.faceLandmark68Net.loadFromUri(MODEL_URL),
        faceapi.nets.faceRecognitionNet.loadFromUri(MODEL_URL),
    ]).then(initSystem);

    async function initSystem() {
        statusText.innerText = "Memproses data wajah...";
        try {
            await refImg.decode();
            const refDetection = await faceapi.detectSingleFace(refImg, new faceapi.TinyFaceDetectorOptions())
                .withFaceLandmarks().withFaceDescriptor();
            
            if (!refDetection) {
                statusText.innerText = "ERROR: Foto profil database tidak jelas.";
                statusText.className = "error";
                return;
            }
            faceMatcher = new faceapi.FaceMatcher(refDetection);
            startVideo();
        } catch (e) {
            console.error(e);
            statusText.innerText = "Gagal memuat foto profil (Cek path storage).";
            statusText.className = "error";
        }
    }

    async function startVideo() {
        try {
            const stream = await navigator.mediaDevices.getUserMedia({ video: {} });
            video.srcObject = stream;
            statusText.innerText = "Siap. Klik tombol di bawah.";
            btnVerify.disabled = false;
        } catch (err) {
            statusText.innerText = "Kamera error!";
        }
    }

    // 2. PROSES VERIFIKASI
    btnVerify.addEventListener('click', async () => {
        statusText.innerText = "Menganalisis...";
        btnVerify.disabled = true;

        const detection = await faceapi.detectSingleFace(video, new faceapi.TinyFaceDetectorOptions())
            .withFaceLandmarks().withFaceDescriptor();

        if (!detection) {
            statusText.innerText = "Wajah tidak terlihat.";
            btnVerify.disabled = false;
            return;
        }

        const match = faceMatcher.findBestMatch(detection.descriptor);
        
        if (match.label === 'unknown') {
            statusText.innerText = "GAGAL: Wajah tidak cocok!";
            statusText.className = "error";
            btnVerify.disabled = false;
        } else {
            statusText.innerText = "BERHASIL! Mengalihkan...";
            statusText.className = "success";
            laporKeServer();
        }
    });

    function laporKeServer() {
        fetch("{{ route('student.exam.verify.success') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ id_sesi: ID_SESI_UJIAN })
        }).then(res => res.json()).then(data => {
            if(data.success) {
                window.location.href = "{{ route('student.exam.info-warning', ['id' => $id_sesi]) }}"; 
            }
        }).catch(error => {
            console.error('Error:', error);
            statusText.innerText = "Error: Gagal menghubungi server. Cek koneksi.";
            statusText.className = "error";
        });
    }
</script>

@endsection