<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Soal;
use App\Models\Batch;
use App\Models\Ujian;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get or create batch
        $batch = Batch::first();
        if (!$batch) {
            $batch = Batch::create([
                'nama_batch' => 'Batch 1',
                'deskripsi' => 'Batch ujian tahun 2025',
                'tanggal_mulai' => now()->subDays(30),
                'tanggal_selesai' => now()->addDays(30),
                'status' => 'aktif'
            ]);
        }

        // Get or create ujian
        $ujian = Ujian::first();
        if (!$ujian) {
            $ujian = Ujian::create([
                'id_batch' => $batch->id_batch,
                'nama_ujian' => 'Ujian Matematika Dasar',
                'mata_pelajaran' => 'matematika',
                'deskripsi' => 'Ujian matematika dasar untuk tingkat SMA',
                'tanggal_mulai' => now()->subDays(1),
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '10:00:00',
                'tanggal_selesai' => now()->addDays(7),
                'durasi_menit' => 120,
                'durasi' => 120,
                'status' => 'aktif'
            ]);
        }

        $questions = [
            // Mudah
            [
                'id_batch' => $batch->id_batch,
                'id_ujian' => $ujian->id_ujian,
                'pertanyaan' => 'Berapakah hasil dari 2 + 2?',
                'mata_pelajaran' => 'Matematika',
                'level_kesulitan' => 'mudah',
                'tipe_soal' => 'pilihan_ganda',
                'opsi_a' => '3',
                'opsi_b' => '4',
                'opsi_c' => '5',
                'opsi_d' => '6',
                'jawaban_benar' => 'B',
                'poin' => 1,
                'status' => 'aktif'
            ],
            [
                'id_batch' => $batch->id_batch,
                'id_ujian' => $ujian->id_ujian,
                'pertanyaan' => 'Apa ibu kota Indonesia?',
                'mata_pelajaran' => 'Geografi',
                'level_kesulitan' => 'mudah',
                'tipe_soal' => 'pilihan_ganda',
                'opsi_a' => 'Surabaya',
                'opsi_b' => 'Jakarta',
                'opsi_c' => 'Bandung',
                'opsi_d' => 'Medan',
                'jawaban_benar' => 'B',
                'poin' => 1,
                'status' => 'aktif'
            ],
            [
                'id_batch' => $batch->id_batch,
                'id_ujian' => $ujian->id_ujian,
                'pertanyaan' => 'Siapa presiden pertama Indonesia?',
                'mata_pelajaran' => 'Sejarah',
                'level_kesulitan' => 'mudah',
                'tipe_soal' => 'pilihan_ganda',
                'opsi_a' => 'Soeharto',
                'opsi_b' => 'Soekarno',
                'opsi_c' => 'Habibie',
                'opsi_d' => 'Megawati',
                'jawaban_benar' => 'B',
                'poin' => 1,
                'status' => 'aktif'
            ],
            // Sedang
            [
                'id_batch' => $batch->id_batch,
                'id_ujian' => $ujian->id_ujian,
                'pertanyaan' => 'Hitunglah nilai dari integral ∫(2x + 3)dx',
                'mata_pelajaran' => 'Matematika',
                'level_kesulitan' => 'sedang',
                'tipe_soal' => 'pilihan_ganda',
                'opsi_a' => 'x² + 3x + C',
                'opsi_b' => '2x² + 3x + C',
                'opsi_c' => 'x² + 6x + C',
                'opsi_d' => '2x² + 6x + C',
                'jawaban_benar' => 'A',
                'poin' => 2,
                'status' => 'aktif'
            ],
            [
                'id_batch' => $batch->id_batch,
                'id_ujian' => $ujian->id_ujian,
                'pertanyaan' => 'Apa rumus kimia untuk asam sulfat?',
                'mata_pelajaran' => 'Kimia',
                'level_kesulitan' => 'sedang',
                'tipe_soal' => 'pilihan_ganda',
                'opsi_a' => 'H2SO4',
                'opsi_b' => 'HCl',
                'opsi_c' => 'HNO3',
                'opsi_d' => 'H3PO4',
                'jawaban_benar' => 'A',
                'poin' => 2,
                'status' => 'aktif'
            ],
            [
                'id_batch' => $batch->id_batch,
                'id_ujian' => $ujian->id_ujian,
                'pertanyaan' => 'Jelaskan proses fotosintesis pada tumbuhan',
                'mata_pelajaran' => 'Biologi',
                'level_kesulitan' => 'sedang',
                'tipe_soal' => 'essay',
                'opsi_a' => '',
                'opsi_b' => '',
                'opsi_c' => '',
                'opsi_d' => '',
                'jawaban_benar' => 'Proses pembuatan makanan oleh tumbuhan',
                'poin' => 3,
                'status' => 'aktif'
            ],
            // Sulit
            [
                'id_batch' => $batch->id_batch,
                'id_ujian' => $ujian->id_ujian,
                'pertanyaan' => 'Hitunglah limit lim(x→0) (sin x)/x',
                'mata_pelajaran' => 'Matematika',
                'level_kesulitan' => 'sulit',
                'tipe_soal' => 'pilihan_ganda',
                'opsi_a' => '0',
                'opsi_b' => '1',
                'opsi_c' => '∞',
                'opsi_d' => 'Tidak ada',
                'jawaban_benar' => 'B',
                'poin' => 5,
                'status' => 'aktif'
            ],
            [
                'id_batch' => $batch->id_batch,
                'id_ujian' => $ujian->id_ujian,
                'pertanyaan' => 'Apa yang dimaksud dengan relativitas khusus Einstein?',
                'mata_pelajaran' => 'Fisika',
                'level_kesulitan' => 'sulit',
                'tipe_soal' => 'essay',
                'opsi_a' => '',
                'opsi_b' => '',
                'opsi_c' => '',
                'opsi_d' => '',
                'jawaban_benar' => 'Teori relativitas khusus Einstein',
                'poin' => 5,
                'status' => 'aktif'
            ],
            [
                'id_batch' => $batch->id_batch,
                'id_ujian' => $ujian->id_ujian,
                'pertanyaan' => 'Selesaikan persamaan diferensial dy/dx = 2xy',
                'mata_pelajaran' => 'Matematika',
                'level_kesulitan' => 'sulit',
                'tipe_soal' => 'pilihan_ganda',
                'opsi_a' => 'y = Ce^(x²)',
                'opsi_b' => 'y = Ce^(2x)',
                'opsi_c' => 'y = Cx²',
                'opsi_d' => 'y = C/x',
                'jawaban_benar' => 'A',
                'poin' => 5,
                'status' => 'aktif'
            ]
        ];

        foreach ($questions as $questionData) {
            Soal::updateOrCreate(
                ['pertanyaan' => $questionData['pertanyaan']],
                $questionData
            );
        }
    }
}
