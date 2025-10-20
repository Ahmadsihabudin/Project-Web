<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Batch;

class BatchSeeder extends Seeder
{
   /**
    * Run the database seeds.
    */
   public function run(): void
   {
      $batches = [
         [
            'nama_batch' => 'Batch 1',
            'keterangan' => 'Batch ujian pertama untuk semester genap 2025',
            'created_at' => now()
         ],
         [
            'nama_batch' => 'Batch 2',
            'keterangan' => 'Batch ujian kedua untuk semester genap 2025',
            'created_at' => now()
         ],
         [
            'nama_batch' => 'Batch 3',
            'keterangan' => 'Batch ujian ketiga untuk semester genap 2025',
            'created_at' => now()
         ]
      ];

      foreach ($batches as $batchData) {
         Batch::updateOrCreate(
            ['nama_batch' => $batchData['nama_batch']],
            $batchData
         );
      }
   }
}
