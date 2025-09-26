<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Peserta;
use App\Models\Batch;
use App\Models\Soal;
use App\Models\Ujian;
use App\Helpers\SecurityHelper;

class SecurityTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User (if not exists)
        User::firstOrCreate(
            ['email' => 'admin@ujian.com'],
            [
                'nama' => 'Admin Ujian Online',
                'password' => SecurityHelper::hashPassword('admin123'),
                'role' => 'admin',
                'email_verified_at' => now()
            ]
        );

        // Create Test Batch (if not exists)
        $batch = Batch::firstOrCreate(
            ['nama_batch' => 'Ujian Semester Genap 2024'],
            ['deskripsi' => 'Ujian online untuk mata pelajaran Teknologi Informasi']
        );

        // Create Test Soal
        $soalData = [
            [
                'pertanyaan' => 'Apa yang dimaksud dengan HTML?',
                'opsi_a' => 'HyperText Markup Language',
                'opsi_b' => 'High Tech Modern Language',
                'opsi_c' => 'Home Tool Markup Language',
                'opsi_d' => 'Hyperlink and Text Markup Language',
                'jawaban_benar' => 'a',
                'poin' => 10
            ],
            [
                'pertanyaan' => 'Fungsi utama dari CSS adalah?',
                'opsi_a' => 'Membuat database',
                'opsi_b' => 'Menghias tampilan website',
                'opsi_c' => 'Membuat server',
                'opsi_d' => 'Mengelola data',
                'jawaban_benar' => 'b',
                'poin' => 10
            ],
            [
                'pertanyaan' => 'Apa kepanjangan dari PHP?',
                'opsi_a' => 'Personal Home Page',
                'opsi_b' => 'PHP: Hypertext Preprocessor',
                'opsi_c' => 'Private Home Protocol',
                'opsi_d' => 'Public Home Page',
                'jawaban_benar' => 'b',
                'poin' => 15
            ],
            [
                'pertanyaan' => 'Database yang paling populer untuk web adalah?',
                'opsi_a' => 'Oracle',
                'opsi_b' => 'MySQL',
                'opsi_c' => 'PostgreSQL',
                'opsi_d' => 'SQLite',
                'jawaban_benar' => 'b',
                'poin' => 10
            ],
            [
                'pertanyaan' => 'Framework PHP yang paling populer adalah?',
                'opsi_a' => 'CodeIgniter',
                'opsi_b' => 'Laravel',
                'opsi_c' => 'Symfony',
                'opsi_d' => 'Zend',
                'jawaban_benar' => 'b',
                'poin' => 15
            ]
        ];

        $soalIds = [];
        foreach ($soalData as $soal) {
            $soal['id_batch'] = $batch->id_batch;
            $createdSoal = Soal::create($soal);
            $soalIds[] = $createdSoal->id_soal;
        }

        // Create Test Ujian
        $ujian = Ujian::create([
            'id_batch' => $batch->id_batch,
            'tanggal_mulai' => now()->addDay()->toDateString(),
            'jam_mulai' => '08:00:00',
            'jam_selesai' => '10:00:00',
            'durasi_menit' => 120,
            'status' => 'aktif'
        ]);

        // Create Test Peserta dengan kode aman
        $pesertaData = [
            [
                'nomor_urut' => 1,
                'nama_peserta' => 'Ahmad Rizki',
                'kode_peserta' => SecurityHelper::generateSecureCode('P', 8),
                'password_hash' => SecurityHelper::hashPassword('peserta123'),
                'asal_smk' => 'SMK Negeri 1 Jakarta',
                'jurusan' => 'Teknik Komputer dan Jaringan'
            ],
            [
                'nomor_urut' => 2,
                'nama_peserta' => 'Siti Nurhaliza',
                'kode_peserta' => SecurityHelper::generateSecureCode('P', 8),
                'password_hash' => SecurityHelper::hashPassword('peserta123'),
                'asal_smk' => 'SMK Negeri 2 Bandung',
                'jurusan' => 'Rekayasa Perangkat Lunak'
            ],
            [
                'nomor_urut' => 3,
                'nama_peserta' => 'Budi Santoso',
                'kode_peserta' => SecurityHelper::generateSecureCode('P', 8),
                'password_hash' => SecurityHelper::hashPassword('peserta123'),
                'asal_smk' => 'SMK Negeri 3 Surabaya',
                'jurusan' => 'Multimedia'
            ]
        ];

        foreach ($pesertaData as $peserta) {
            Peserta::create($peserta);
        }

        $this->command->info('Security Test Data Created Successfully!');
        $this->command->info('Admin: admin@ujian.com / admin123');
        $this->command->info('Peserta: Check database for generated codes');
    }
}
