<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ujian;
use App\Models\Batch;
use Carbon\Carbon;

class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get or create a batch
        $batch = Batch::first();
        if (!$batch) {
            $batch = Batch::create([
                'nama_batch' => 'Batch 2025',
                'deskripsi' => 'Batch ujian tahun 2025',
                'tanggal_mulai' => Carbon::now()->subDays(30),
                'tanggal_selesai' => Carbon::now()->addDays(30),
                'status' => 'aktif'
            ]);
        }

        // Create sample exams
        $exams = [
            [
                'id_batch' => $batch->id_batch,
                'nama_ujian' => 'Ujian Matematika Dasar',
                'mata_pelajaran' => 'matematika',
                'deskripsi' => 'Ujian matematika dasar untuk tingkat SMA',
                'tanggal_mulai' => Carbon::now()->subDays(1),
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '10:00:00',
                'tanggal_selesai' => Carbon::now()->addDays(7),
                'durasi_menit' => 120,
                'durasi' => 120,
                'status' => 'aktif'
            ],
            [
                'id_batch' => $batch->id_batch,
                'nama_ujian' => 'Ujian Bahasa Indonesia',
                'mata_pelajaran' => 'bahasa',
                'deskripsi' => 'Ujian bahasa Indonesia untuk tingkat SMA',
                'tanggal_mulai' => Carbon::now()->subDays(1),
                'jam_mulai' => '10:30:00',
                'jam_selesai' => '12:30:00',
                'tanggal_selesai' => Carbon::now()->addDays(7),
                'durasi_menit' => 120,
                'durasi' => 120,
                'status' => 'aktif'
            ],
            [
                'id_batch' => $batch->id_batch,
                'nama_ujian' => 'Ujian Fisika',
                'mata_pelajaran' => 'fisika',
                'deskripsi' => 'Ujian fisika untuk tingkat SMA',
                'tanggal_mulai' => Carbon::now()->subDays(1),
                'jam_mulai' => '13:00:00',
                'jam_selesai' => '15:00:00',
                'tanggal_selesai' => Carbon::now()->addDays(7),
                'durasi_menit' => 120,
                'durasi' => 120,
                'status' => 'aktif'
            ],
            [
                'id_batch' => $batch->id_batch,
                'nama_ujian' => 'Ujian Kimia',
                'mata_pelajaran' => 'kimia',
                'deskripsi' => 'Ujian kimia untuk tingkat SMA',
                'tanggal_mulai' => Carbon::now()->subDays(1),
                'jam_mulai' => '15:30:00',
                'jam_selesai' => '17:30:00',
                'tanggal_selesai' => Carbon::now()->addDays(7),
                'durasi_menit' => 120,
                'durasi' => 120,
                'status' => 'aktif'
            ]
        ];

        foreach ($exams as $examData) {
            Ujian::updateOrCreate(
                ['nama_ujian' => $examData['nama_ujian']],
                $examData
            );
        }
    }
}
