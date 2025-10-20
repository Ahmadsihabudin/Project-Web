<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ExamSchedule;
use App\Models\Batch;
use App\Models\Soal;
use Carbon\Carbon;

class SessionSeeder extends Seeder
{
   /**
    * Run the database seeds.
    */
   public function run(): void
   {
      // Get existing batches
      $batches = Batch::all();

      if ($batches->isEmpty()) {
         $this->command->info('No batches found. Please run BatchSeeder first.');
         return;
      }

      // Get existing questions
      $questions = Soal::where('status', 'aktif')->get();

      if ($questions->isEmpty()) {
         $this->command->info('No active questions found. Please run QuestionSeeder first.');
         return;
      }

      // Create sample exam schedules
      $sesiUjianList = [
         [
            'nama_ujian' => 'Ujian Matematika Dasar',
            'deskripsi' => 'Ujian untuk menguji kemampuan matematika dasar siswa',
            'id_batch' => $batches->first()->id_batch,
            'tanggal_ujian' => Carbon::tomorrow(),
            'jam_mulai' => '08:00:00',
            'jam_selesai' => '10:00:00',
            'durasi_menit' => 120,
            'status' => 'aktif',
            'soal_ids' => $questions->take(5)->pluck('id_soal')->toArray(),
            'instruksi' => 'Kerjakan soal dengan teliti. Dilarang menggunakan kalkulator.',
            'max_attempts' => 1,
            'randomize_questions' => true,
            'show_results_immediately' => true,
         ],
         [
            'nama_ujian' => 'Ujian Bahasa Indonesia',
            'deskripsi' => 'Ujian untuk menguji kemampuan berbahasa Indonesia',
            'id_batch' => $batches->skip(1)->first()->id_batch ?? $batches->first()->id_batch,
            'tanggal_ujian' => Carbon::tomorrow()->addDay(),
            'jam_mulai' => '09:00:00',
            'jam_selesai' => '11:00:00',
            'durasi_menit' => 120,
            'status' => 'aktif',
            'soal_ids' => $questions->skip(2)->take(4)->pluck('id_soal')->toArray(),
            'instruksi' => 'Bacalah soal dengan cermat sebelum menjawab.',
            'max_attempts' => 2,
            'randomize_questions' => false,
            'show_results_immediately' => true,
         ],
         [
            'nama_ujian' => 'Ujian IPA Terpadu',
            'deskripsi' => 'Ujian gabungan Fisika, Kimia, dan Biologi',
            'id_batch' => $batches->last()->id_batch,
            'tanggal_ujian' => Carbon::yesterday(),
            'jam_mulai' => '13:00:00',
            'jam_selesai' => '15:00:00',
            'durasi_menit' => 120,
            'status' => 'selesai',
            'soal_ids' => $questions->take(6)->pluck('id_soal')->toArray(),
            'instruksi' => 'Ujian telah selesai. Hasil akan diumumkan besok.',
            'max_attempts' => 1,
            'randomize_questions' => true,
            'show_results_immediately' => false,
         ],
      ];

      foreach ($sesiUjianList as $sesiUjianData) {
         $sesiUjian = ExamSchedule::create($sesiUjianData);

         // Attach questions to sesi ujian
         if (!empty($sesiUjianData['soal_ids'])) {
            $sesiUjian->soal()->attach($sesiUjianData['soal_ids']);
         }

         $this->command->info("Created sesi ujian: {$sesiUjian->nama_ujian}");
      }

      $this->command->info('SessionSeeder completed successfully!');
   }
}
