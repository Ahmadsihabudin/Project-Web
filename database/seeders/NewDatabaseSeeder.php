<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Batch;
use App\Models\Ujian;
use App\Models\SesiUjian;
use App\Models\Peserta;
use Carbon\Carbon;

class NewDatabaseSeeder extends Seeder
{
   /**
    * Run the database seeds.
    */
   public function run(): void
   {
      // Clear existing data
      SesiUjian::query()->delete();
      Peserta::query()->delete();
      Ujian::query()->delete();
      Batch::query()->delete();

      // 1. Create batches
      $batches = [
         [
            'nama_batch' => 'Batch 1',
            'keterangan' => 'Kelompok peserta angkatan 2024'
         ],
         [
            'nama_batch' => 'Batch 2',
            'keterangan' => 'Kelompok peserta angkatan 2025'
         ],
         [
            'nama_batch' => 'Batch 3',
            'keterangan' => 'Kelompok peserta khusus'
         ]
      ];

      foreach ($batches as $batchData) {
         Batch::create($batchData);
      }

      // 2. Create participants
      $pesertaData = [
         ['nama_peserta' => 'Ahmad Rizki', 'id_batch' => 1],
         ['nama_peserta' => 'Siti Nurhaliza', 'id_batch' => 1],
         ['nama_peserta' => 'Budi Santoso', 'id_batch' => 1],
         ['nama_peserta' => 'Dewi Sartika', 'id_batch' => 2],
         ['nama_peserta' => 'Eko Prasetyo', 'id_batch' => 2],
         ['nama_peserta' => 'Fina Amelia', 'id_batch' => 3],
      ];

      foreach ($pesertaData as $peserta) {
         Peserta::create($peserta);
      }

      // 3. Create ujian
      $ujianData = [
         [
            'nama_ujian' => 'Ujian Mid Semester',
            'mata_pelajaran' => 'Matematika',
            'deskripsi' => 'Ujian tengah semester mata pelajaran Matematika'
         ],
         [
            'nama_ujian' => 'Ujian Akhir Semester',
            'mata_pelajaran' => 'Matematika',
            'deskripsi' => 'Ujian akhir semester mata pelajaran Matematika'
         ],
         [
            'nama_ujian' => 'Ujian Remedial',
            'mata_pelajaran' => 'Matematika',
            'deskripsi' => 'Ujian remedial untuk peserta yang belum lulus'
         ],
         [
            'nama_ujian' => 'Ujian Harian',
            'mata_pelajaran' => 'Bahasa Indonesia',
            'deskripsi' => 'Ujian harian mata pelajaran Bahasa Indonesia'
         ]
      ];

      foreach ($ujianData as $ujian) {
         Ujian::create($ujian);
      }

      // 4. Create sesi ujian
      $sesiData = [
         [
            'id_ujian' => 1,
            'id_batch' => 1,
            'tanggal_mulai' => Carbon::now()->addDays(4)->toDateString(),
            'jam_mulai' => '08:00:00',
            'jam_selesai' => '10:00:00',
            'tanggal_selesai' => Carbon::now()->addDays(4)->toDateString(),
            'durasi_menit' => 120,
            'status' => 'aktif'
         ],
         [
            'id_ujian' => 1,
            'id_batch' => 2,
            'tanggal_mulai' => Carbon::now()->addDays(5)->toDateString(),
            'jam_mulai' => '09:00:00',
            'jam_selesai' => '11:00:00',
            'tanggal_selesai' => Carbon::now()->addDays(5)->toDateString(),
            'durasi_menit' => 120,
            'status' => 'aktif'
         ],
         [
            'id_ujian' => 2,
            'id_batch' => 1,
            'tanggal_mulai' => Carbon::now()->addDays(9)->toDateString(),
            'jam_mulai' => '08:00:00',
            'jam_selesai' => '10:00:00',
            'tanggal_selesai' => Carbon::now()->addDays(9)->toDateString(),
            'durasi_menit' => 120,
            'status' => 'aktif'
         ],
         [
            'id_ujian' => 3,
            'id_batch' => 1,
            'tanggal_mulai' => Carbon::now()->addDays(14)->toDateString(),
            'jam_mulai' => '13:00:00',
            'jam_selesai' => '15:00:00',
            'tanggal_selesai' => Carbon::now()->addDays(14)->toDateString(),
            'durasi_menit' => 120,
            'status' => 'nonaktif'
         ],
         [
            'id_ujian' => 4,
            'id_batch' => 3,
            'tanggal_mulai' => Carbon::now()->addDays(7)->toDateString(),
            'jam_mulai' => '10:00:00',
            'jam_selesai' => '11:00:00',
            'tanggal_selesai' => Carbon::now()->addDays(7)->toDateString(),
            'durasi_menit' => 60,
            'status' => 'aktif'
         ]
      ];

      foreach ($sesiData as $sesi) {
         SesiUjian::create($sesi);
      }

      $this->command->info('Database seeded successfully!');
      $this->command->info('Created:');
      $this->command->info('- ' . Batch::count() . ' batches');
      $this->command->info('- ' . Peserta::count() . ' participants');
      $this->command->info('- ' . Ujian::count() . ' exams');
      $this->command->info('- ' . SesiUjian::count() . ' exam sessions');
   }
}
