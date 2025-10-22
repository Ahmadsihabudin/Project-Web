-- Database Update Script for Ujian Online System
-- This script updates data across all tables in the system
-- Generated on: 2025-01-20

-- ==============================================
-- 1. UPDATE ACTIVITY_LOGS TABLE
-- ==============================================

-- Update recent activity logs with more descriptive information
UPDATE activity_logs 
SET description = CONCAT('Updated: ', description),
    updated_at = NOW()
WHERE created_at >= '2025-10-20 00:00:00';

-- Add new activity log entries for system updates
INSERT INTO activity_logs (user_type, user_id, action, description, metadata, ip_address, user_agent, created_at, updated_at) VALUES
('admin', 1, 'system_update', 'Database update script executed', '{"script_version": "1.0", "tables_updated": 16}', '127.0.0.1', 'System Update Script', NOW(), NOW()),
('system', 0, 'maintenance', 'Scheduled database maintenance completed', '{"maintenance_type": "data_update", "duration_minutes": 5}', '127.0.0.1', 'Maintenance Script', NOW(), NOW());

-- ==============================================
-- 2. UPDATE BATCH TABLE
-- ==============================================

-- Update existing batch information
UPDATE batch 
SET keterangan = CONCAT('Updated: ', COALESCE(keterangan, 'No description available')),
    created_at = created_at
WHERE id_batch IN (1, 2);

-- Add new batch entries
INSERT INTO batch (nama_batch, keterangan, created_at) VALUES
('Batch 3', 'Updated batch for 2025 semester', NOW()),
('Batch 4', 'Special batch for advanced students', NOW());

-- ==============================================
-- 3. UPDATE CACHE TABLE (Clear old cache)
-- ==============================================

-- Clear expired cache entries
DELETE FROM cache WHERE expiration < UNIX_TIMESTAMP();

-- Clear cache locks
DELETE FROM cache_locks WHERE expiration < UNIX_TIMESTAMP();

-- ==============================================
-- 4. UPDATE EXAM_SCHEDULES TABLE
-- ==============================================

-- Update existing exam schedules
UPDATE exam_schedules 
SET deskripsi = CONCAT('Updated: ', COALESCE(deskripsi, 'No description')),
    updated_at = NOW()
WHERE id_schedule > 0;

-- Add new exam schedules
INSERT INTO exam_schedules (nama_ujian, deskripsi, id_batch, tanggal_ujian, jam_mulai, jam_selesai, durasi_menit, status, instruksi, max_attempts, randomize_questions, show_results_immediately, created_at, updated_at) VALUES
('Ujian Bahasa Indonesia', 'Ujian untuk batch 3', '3', '2025-11-01', '2025-11-01 08:00:00', '2025-11-01 10:00:00', 120, 'aktif', 'Kerjakan dengan jujur dan teliti', 2, 1, 1, NOW(), NOW()),
('Ujian IPA', 'Ujian untuk batch 4', '4', '2025-11-02', '2025-11-02 09:00:00', '2025-11-02 11:00:00', 120, 'aktif', 'Gunakan kalkulator jika diperlukan', 1, 0, 0, NOW(), NOW());

-- ==============================================
-- 5. UPDATE FACE_LOGS TABLE
-- ==============================================

-- Add sample face detection logs
INSERT INTO face_logs (id_peserta, jumlah_orang, peringatan_ke, detected_at, created_at, updated_at) VALUES
(1, 1, 0, NOW(), NOW(), NOW()),
(2, 1, 0, NOW(), NOW(), NOW()),
(1, 2, 1, DATE_SUB(NOW(), INTERVAL 1 HOUR), DATE_SUB(NOW(), INTERVAL 1 HOUR), DATE_SUB(NOW(), INTERVAL 1 HOUR));

-- ==============================================
-- 6. UPDATE FAILED_JOBS TABLE (Clean up)
-- ==============================================

-- Clean up old failed jobs (older than 30 days)
DELETE FROM failed_jobs WHERE failed_at < DATE_SUB(NOW(), INTERVAL 30 DAY);

-- ==============================================
-- 7. UPDATE JAWABAN TABLE
-- ==============================================

-- Add sample answers for existing questions
INSERT INTO jawaban (id_peserta, id_soal, jawaban_dipilih, status, nilai_essay, created_at, updated_at) VALUES
(1, 1, 'a', 'benar', NULL, NOW(), NOW()),
(1, 3, 'd', 'benar', NULL, NOW(), NOW()),
(1, 4, 'a', 'benar', NULL, NOW(), NOW()),
(1, 10, 'a', 'benar', NULL, NOW(), NOW()),
(1, 11, 'b', 'benar', NULL, NOW(), NOW()),
(2, 1, 'a', 'benar', NULL, NOW(), NOW()),
(2, 3, 'd', 'benar', NULL, NOW(), NOW()),
(2, 4, 'a', 'benar', NULL, NOW(), NOW()),
(2, 10, 'a', 'benar', NULL, NOW(), NOW()),
(2, 11, 'b', 'benar', NULL, NOW(), NOW());

-- Add essay answers
INSERT INTO jawaban (id_peserta, id_soal, jawaban_dipilih, status, nilai_essay, created_at, updated_at) VALUES
(1, 12, 'Fotosintesis adalah proses dimana tumbuhan menggunakan cahaya matahari, air, dan karbon dioksida untuk membuat glukosa dan oksigen.', 'benar', 15.00, NOW(), NOW()),
(1, 13, 'Windows memiliki kelebihan: user-friendly, kompatibilitas software tinggi, dukungan hardware luas. Kekurangan: rentan virus, lisensi berbayar, resource usage tinggi.', 'benar', 14.50, NOW(), NOW()),
(2, 12, 'Fotosintesis adalah proses pembuatan makanan oleh tumbuhan menggunakan cahaya matahari.', 'benar', 12.00, NOW(), NOW()),
(2, 13, 'Windows mudah digunakan tapi sering terkena virus.', 'benar', 10.00, NOW(), NOW());

-- ==============================================
-- 8. UPDATE JOBS TABLE (Clean up)
-- ==============================================

-- Clean up old completed jobs
DELETE FROM jobs WHERE created_at < UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 7 DAY));

-- ==============================================
-- 9. UPDATE JOB_BATCHES TABLE (Clean up)
-- ==============================================

-- Clean up old job batches
DELETE FROM job_batches WHERE created_at < UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 7 DAY));

-- ==============================================
-- 10. UPDATE LAPORAN TABLE
-- ==============================================

-- Add sample reports for participants
INSERT INTO laporan (id_peserta, total_score, jumlah_benar, waktu_pengerjaan, status_submit, created_at, updated_at) VALUES
(1, 85.50, 4, 45, 'manual', NOW(), NOW()),
(2, 78.00, 3, 50, 'auto_submit', NOW(), NOW());

-- ==============================================
-- 11. UPDATE MIGRATIONS TABLE
-- ==============================================

-- Add a new migration record for this update
INSERT INTO migrations (migration, batch) VALUES
('2025_01_20_000000_database_data_update', 17);

-- ==============================================
-- 12. UPDATE PESERTA TABLE
-- ==============================================

-- Update existing participants with new information
UPDATE peserta 
SET 
    nama_peserta = CONCAT('Updated - ', nama_peserta),
    email = CONCAT('updated_', email),
    asal_smk = CONCAT('Updated ', asal_smk),
    jurusan = CONCAT('Updated ', jurusan),
    updated_at = NOW()
WHERE id_peserta IN (1, 2);

-- Add new participants
INSERT INTO peserta (nomor_urut, nama_peserta, email, kode_peserta, kode_akses, asal_smk, jurusan, batch, status, created_at, updated_at) VALUES
(3, 'Ahmad Rizki', 'ahmad.rizki@email.com', 'RK00003', '123456', 'SMK Negeri 1', 'Teknik Komputer', 'Batch 3', 'aktif', NOW(), NOW()),
(4, 'Siti Nurhaliza', 'siti.nurhaliza@email.com', 'RK00004', '123456', 'SMK Negeri 2', 'Multimedia', 'Batch 4', 'aktif', NOW(), NOW()),
(5, 'Budi Santoso', 'budi.santoso@email.com', 'RK00005', '123456', 'SMK Swasta 1', 'Teknik Informatika', 'Batch 3', 'aktif', NOW(), NOW());

-- ==============================================
-- 13. UPDATE SESI_UJIAN TABLE
-- ==============================================

-- Update existing exam sessions
UPDATE sesi_ujian 
SET 
    deskripsi = CONCAT('Updated: ', COALESCE(deskripsi, 'No description')),
    updated_at = NOW()
WHERE id_sesi > 0;

-- Add new exam sessions
INSERT INTO sesi_ujian (id_ujian, id_batch, mata_pelajaran, deskripsi, tanggal_mulai, jam_mulai, jam_selesai, tanggal_selesai, durasi_menit, status, created_at, updated_at) VALUES
(1, 3, 'Bahasa Indonesia', 'Sesi ujian bahasa Indonesia untuk batch 3', '2025-11-01', '08:00:00', '10:00:00', '2025-11-01', 120, 'aktif', NOW(), NOW()),
(2, 4, 'IPA', 'Sesi ujian IPA untuk batch 4', '2025-11-02', '09:00:00', '11:00:00', '2025-11-02', 120, 'aktif', NOW(), NOW());

-- ==============================================
-- 14. UPDATE SESSIONS TABLE (Clean up)
-- ==============================================

-- Clean up expired sessions (older than 24 hours)
DELETE FROM sessions WHERE last_activity < UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 24 HOUR));

-- ==============================================
-- 15. UPDATE SETTINGS TABLE
-- ==============================================

-- Add system settings
INSERT INTO settings (key, value, description, category, type, is_public, is_encrypted, validation_rules, default_value, created_at, updated_at) VALUES
('system_name', 'Ujian Online System v2.0', 'Nama sistem ujian online', 'general', 'string', 1, 0, 'required|string|max:255', 'Ujian Online System', NOW(), NOW()),
('max_exam_duration', '120', 'Durasi maksimal ujian dalam menit', 'exam', 'integer', 0, 0, 'required|integer|min:30|max:300', '120', NOW(), NOW()),
('enable_face_detection', 'true', 'Aktifkan deteksi wajah', 'security', 'boolean', 0, 0, 'required|boolean', 'true', NOW(), NOW()),
('auto_submit_enabled', 'true', 'Aktifkan submit otomatis', 'exam', 'boolean', 0, 0, 'required|boolean', 'true', NOW(), NOW()),
('notification_email', 'admin@ujianonline.com', 'Email untuk notifikasi', 'notification', 'string', 0, 0, 'required|email', 'admin@ujianonline.com', NOW(), NOW());

-- ==============================================
-- 16. UPDATE SOAL TABLE
-- ==============================================

-- Update existing questions
UPDATE soal 
SET 
    pertanyaan = CONCAT('Updated: ', pertanyaan),
    umpan_balik = CONCAT('Updated feedback: ', COALESCE(umpan_balik, 'No feedback')),
    updated_at = NOW()
WHERE id_soal IN (1, 3, 4, 10, 11, 12, 13, 14);

-- Add new questions
INSERT INTO soal (batch, pertanyaan, mata_pelajaran, level_kesulitan, tipe_soal, opsi_a, opsi_b, opsi_c, opsi_d, opsi_e, opsi_f, jawaban_benar, umpan_balik, poin, created_at, updated_at) VALUES
('Batch 3', 'Apa yang dimaksud dengan algoritma?', 'Teknik Informatika', 'sedang', 'pilihan_ganda', 'Langkah-langkah sistematis untuk menyelesaikan masalah', 'Program komputer', 'Bahasa pemrograman', 'Database', '', '', 'a', 'Algoritma adalah langkah-langkah sistematis untuk menyelesaikan masalah', 10, NOW(), NOW()),
('Batch 3', 'Sebutkan 3 jenis struktur data', 'Teknik Informatika', 'sulit', 'essay', '', '', '', '', '', '', 'Array, Linked List, Stack, Queue, Tree, Graph', 'Struktur data adalah cara menyimpan dan mengorganisir data', 15, NOW(), NOW()),
('Batch 4', 'Apa fungsi dari CSS?', 'Web Development', 'mudah', 'pilihan_ganda', 'Mengatur tampilan halaman web', 'Membuat halaman web interaktif', 'Menyimpan data', 'Menjalankan server', '', '', 'a', 'CSS digunakan untuk mengatur tampilan dan styling halaman web', 5, NOW(), NOW()),
('Batch 4', 'Jelaskan perbedaan antara HTML dan CSS', 'Web Development', 'sedang', 'essay', '', '', '', '', '', '', 'HTML untuk struktur konten, CSS untuk styling dan tampilan', 'HTML membuat struktur, CSS membuat tampilan', 12, NOW(), NOW());

-- ==============================================
-- 17. UPDATE UJIAN TABLE
-- ==============================================

-- Update existing exams
UPDATE ujian 
SET 
    deskripsi = CONCAT('Updated: ', COALESCE(deskripsi, 'No description')),
    created_at = created_at
WHERE id_ujian > 0;

-- Add new exams
INSERT INTO ujian (nama_ujian, mata_pelajaran, deskripsi, created_at) VALUES
('Ujian Bahasa Indonesia', 'Bahasa Indonesia', 'Ujian bahasa Indonesia untuk tingkat menengah', NOW()),
('Ujian IPA', 'Ilmu Pengetahuan Alam', 'Ujian IPA mencakup fisika, kimia, dan biologi', NOW()),
('Ujian Teknik Informatika', 'Teknik Informatika', 'Ujian untuk mahasiswa teknik informatika', NOW()),
('Ujian Web Development', 'Web Development', 'Ujian pengembangan web modern', NOW());

-- ==============================================
-- 18. UPDATE USERS TABLE
-- ==============================================

-- Update existing users
UPDATE users 
SET 
    name = CONCAT('Updated - ', name),
    updated_at = NOW()
WHERE id IN (1, 4);

-- Add new staff users
INSERT INTO users (name, email, email_verified_at, password, role, created_at, updated_at) VALUES
('Guru Matematika', 'guru.matematika@ujianonline.com', NOW(), '$2y$12$kvFYIv.vVY8SeJhMHShqSumhYSbwLMvqSfmR/QnJzK25TanJtM5i2', 'staff', NOW(), NOW()),
('Guru IPA', 'guru.ipa@ujianonline.com', NOW(), '$2y$12$kvFYIv.vVY8SeJhMHShqSumhYSbwLMvqSfmR/QnJzK25TanJtM5i2', 'staff', NOW(), NOW()),
('Guru Bahasa Indonesia', 'guru.bahasa.indonesia@ujianonline.com', NOW(), '$2y$12$kvFYIv.vVY8SeJhMHShqSumhYSbwLMvqSfmR/QnJzK25TanJtM5i2', 'staff', NOW(), NOW());

-- ==============================================
-- FINAL UPDATES
-- ==============================================

-- Update all updated_at timestamps to current time for recently modified records
UPDATE activity_logs SET updated_at = NOW() WHERE created_at >= '2025-10-20 00:00:00';
UPDATE batch SET created_at = NOW() WHERE id_batch IN (3, 4);
UPDATE exam_schedules SET updated_at = NOW() WHERE id_schedule > 2;
UPDATE sesi_ujian SET updated_at = NOW() WHERE id_sesi > 2;
UPDATE peserta SET updated_at = NOW() WHERE id_peserta > 2;
UPDATE soal SET updated_at = NOW() WHERE id_soal > 14;
UPDATE ujian SET created_at = NOW() WHERE id_ujian > 2;
UPDATE users SET updated_at = NOW() WHERE id > 4;

-- ==============================================
-- VERIFICATION QUERIES
-- ==============================================

-- Display summary of updates
SELECT 'ACTIVITY_LOGS' as table_name, COUNT(*) as total_records FROM activity_logs
UNION ALL
SELECT 'BATCH', COUNT(*) FROM batch
UNION ALL
SELECT 'EXAM_SCHEDULES', COUNT(*) FROM exam_schedules
UNION ALL
SELECT 'FACE_LOGS', COUNT(*) FROM face_logs
UNION ALL
SELECT 'JAWABAN', COUNT(*) FROM jawaban
UNION ALL
SELECT 'LAPORAN', COUNT(*) FROM laporan
UNION ALL
SELECT 'PESERTA', COUNT(*) FROM peserta
UNION ALL
SELECT 'SESI_UJIAN', COUNT(*) FROM sesi_ujian
UNION ALL
SELECT 'SETTINGS', COUNT(*) FROM settings
UNION ALL
SELECT 'SOAL', COUNT(*) FROM soal
UNION ALL
SELECT 'UJIAN', COUNT(*) FROM ujian
UNION ALL
SELECT 'USERS', COUNT(*) FROM users;

-- ==============================================
-- END OF UPDATE SCRIPT
-- ==============================================

-- Display completion message
SELECT 'Database update completed successfully!' as status, NOW() as completed_at;
