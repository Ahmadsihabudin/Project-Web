<?php

namespace App\Http\Controllers;

use App\Models\Ujian;
use App\Models\Peserta;
use App\Models\Jawaban;
use App\Models\Soal;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
   /**
    * Get dashboard statistics
    */
   public function getStats()
   {
      try {
         // Get total ujian
         $totalUjian = Ujian::count();

         // Get total peserta aktif
         $pesertaAktif = Peserta::count();

         // Get ujian hari ini (ujian yang dibuat hari ini)
         $ujianHariIni = Ujian::whereDate('tanggal_mulai', Carbon::today())->count();

         // Get ujian selesai (ujian yang sudah selesai)
         // Since ujian table doesn't have status column, we'll use a different approach
         $ujianSelesai = 0; // No status column available

         // Get additional stats
         $totalSoal = Soal::count();
         $totalJawaban = Jawaban::count();

         // Get peserta yang sedang ujian (peserta yang ada jawaban hari ini)
         $pesertaSedangUjian = Jawaban::whereDate('tanggal_jawab', Carbon::today())
            ->distinct('id_peserta')
            ->count('id_peserta');

         // Get peserta selesai ujian (peserta yang sudah ada jawaban)
         $pesertaSelesaiUjian = Jawaban::distinct('id_peserta')
            ->count('id_peserta');

         $stats = [
            'total_ujian' => $totalUjian,
            'peserta_aktif' => $pesertaAktif,
            'ujian_hari_ini' => $ujianHariIni,
            'ujian_selesai' => $ujianSelesai,
            'total_soal' => $totalSoal,
            'total_jawaban' => $totalJawaban,
            'peserta_sedang_ujian' => $pesertaSedangUjian,
            'peserta_selesai_ujian' => $pesertaSelesaiUjian
         ];

         return response()->json([
            'success' => true,
            'data' => $stats
         ]);
      } catch (\Exception $e) {
         return response()->json([
            'success' => false,
            'message' => 'Gagal memuat data dashboard: ' . $e->getMessage(),
            'data' => [
               'total_ujian' => 0,
               'peserta_aktif' => 0,
               'ujian_hari_ini' => 0,
               'ujian_selesai' => 0,
               'total_soal' => 0,
               'total_jawaban' => 0,
               'peserta_sedang_ujian' => 0,
               'peserta_selesai_ujian' => 0
            ]
         ], 500);
      }
   }
}
