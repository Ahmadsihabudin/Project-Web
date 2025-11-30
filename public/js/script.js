// ==========================================================
// 1. PERSIAPAN VARIABEL
// ==========================================================
const video = document.getElementById("video");
const alertOverlay = document.getElementById("fullscreen-alert");
const alertText = document.getElementById("fullscreen-alert-text");

// Ambil elemen gambar referensi (foto asli siswa)
const refImg = document.getElementById("ref-img");
const MODEL_URL = "https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/weights";

// Variabel untuk menyimpan "Sidik Wajah" asli siswa
let faceMatcher = null;

// ==========================================================
// 2. MEMUAT SEMUA MODEL AI YANG DIPERLUKAN
// ==========================================================
Promise.all([
    faceapi.nets.tinyFaceDetector.loadFromUri(MODEL_URL),
    faceapi.nets.faceLandmark68Net.loadFromUri(MODEL_URL),
    faceapi.nets.faceRecognitionNet.loadFromUri(MODEL_URL), // Untuk mengenali wajah
]).then(startSystem);

// ==========================================================
// 3. FUNGSI UTAMA: MEMPROSES REFERENSI DULU, BARU KAMERA
// ==========================================================
async function startSystem() {
    if (!refImg) {
        console.error(
            "Elemen 'ref-img' tidak ditemukan. Pemantauan Joki tidak dapat dimulai."
        );
        setWarning(
            "ERROR SISTEM: Foto referensi peserta tidak ditemukan di halaman."
        );
        return;
    }

    try {
        // A. PROSES FOTO ASLI SISWA
        // Ekstrak "Descriptor" (Sidik Wajah) dari foto referensi
        await refImg.decode(); // Pastikan gambar sudah dimuat
        const refDetection = await faceapi
            .detectSingleFace(refImg, new faceapi.TinyFaceDetectorOptions())
            .withFaceLandmarks()
            .withFaceDescriptor();

        if (!refDetection) {
            setWarning(
                "ERROR SISTEM: Wajah di foto profil tidak terdeteksi! Hubungi admin."
            );
            return;
        }

        // B. SIMPAN SIDIK WAJAH KE DALAM 'FaceMatcher'
        faceMatcher = new faceapi.FaceMatcher(refDetection);

        // C. BARU NYALAKAN KAMERA
        startVideo();
    } catch (err) {
        console.error(err);
        setWarning("Gagal memproses foto referensi. Cek console browser."); 
    }
}

async function startVideo() {
    try {
        const stream = await navigator.mediaDevices.getUserMedia({ video: {} });
        video.srcObject = stream;
    } catch (err) {
        console.error("Error starting video stream:", err);
        setWarning("ERROR: Kamera mati! Harap izinkan akses kamera.");
    }
}

// ==========================================================
// 4. LOGIKA PEMANTAUAN BERKELANJUTAN (REAL-TIME)
// ==========================================================
video.addEventListener("play", () => {
    setInterval(async () => {
        // Jika faceMatcher belum siap, jangan lakukan apa-apa
        if (!faceMatcher) return;

        // Deteksi SEMUA wajah di kamera
        const detections = await faceapi
            .detectAllFaces(video, new faceapi.TinyFaceDetectorOptions())
            .withFaceLandmarks()
            .withFaceDescriptors();

        // --- PRIORITAS 1: CEK JUMLAH WAJAH ---
        if (detections.length === 0) {
            setWarning("WAJAH HILANG! Harap kembali ke depan kamera.");
            return;
        }
        if (detections.length > 1) {
            setWarning("PELANGGARAN: Terdeteksi lebih dari satu orang!");
            return;
        }

        const singleDetection = detections[0];

        // --- PRIORITAS 2: CEK KECOCOKAN WAJAH (DETEKSI JOKI) ---
        const bestMatch = faceMatcher.findBestMatch(singleDetection.descriptor);
        if (bestMatch.label === "unknown") {
            setWarning(
                "PELANGGARAN BERAT: Wajah Tidak Cocok! (Terdeteksi Joki)"
            );
            return; // Prioritaskan error ini, jangan cek pose
        }

        // --- PRIORITAS 3: CEK POSE KEPALA (MENOLEH) ---
        // Hanya dijalankan jika wajah cocok
        checkHeadPose(singleDetection.landmarks);
    }, 500); // Interval pengecekan setiap setengah detik
});

// ==========================================================
// 5. FUNGSI UNTUK CEK POSE KEPALA
// ==========================================================
function checkHeadPose(landmarks) {
    const nose = landmarks.getNose()[3];
    const leftCheek = landmarks.getJawOutline()[0];
    const rightCheek = landmarks.getJawOutline()[16];

    const distLeft = Math.abs(nose.x - leftCheek.x);
    const distRight = Math.abs(nose.x - rightCheek.x);
    const ratio = distLeft / distRight;

    const thresholdKiri = 0.7;
    const thresholdKanan = 1.3;

    if (ratio > thresholdKanan) {
        setWarning("PELANGGARAN: Jangan menoleh ke KIRI!");
    } else if (ratio < thresholdKiri) {
        setWarning("PELANGGARAN: Jangan menoleh ke KANAN!");
    } else {
        setWarning(""); // Aman
    }
}

// ==========================================================
// 6. FUNGSI UNTUK MENGONTROL TAMPILAN ALERT
// ==========================================================
function setWarning(message) {
    if (message) {
        alertText.innerText = message;
        alertOverlay.style.display = "flex";
    } else {
        alertText.innerText = "";
        alertOverlay.style.display = "none";
    }
}
