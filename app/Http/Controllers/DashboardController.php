<?php

namespace App\Http\Controllers;

use App\Models\Ujian;
use App\Models\SesiUjian;
use App\Models\Peserta;
use App\Models\Jawaban;
use App\Models\Soal;
use App\Models\Batch;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{

   public function getStats()
   {
      try {
         $today = Carbon::today();
         $now = Carbon::now();
         $totalUjian = SesiUjian::count();
         $pesertaAktif = Peserta::count();
         $ujianSelesai = SesiUjian::where(function ($query) use ($today) {
            $query->where('status', 'nonaktif')
               ->orWhere(function ($q) use ($today) {
                  $q->whereNotNull('tanggal_selesai')
                     ->where('tanggal_selesai', '<', $today);
               });
         })->count();
         $ujianTerjadwal = SesiUjian::where('status', 'aktif')
            ->where(function ($query) use ($today, $now) {
               $query->where('tanggal_mulai', '>', $today)
                  ->orWhere(function ($q) use ($today, $now) {
                     $q->whereDate('tanggal_mulai', $today)
                        ->whereTime('jam_mulai', '>', $now->format('H:i:s'));
                  });
            })
            ->count();
         $ujianAktif = SesiUjian::where('status', 'aktif')
            ->where(function ($query) use ($today, $now) {
               $query->where(function ($q) use ($today, $now) {
                  $q->where('tanggal_mulai', '<', $today)
                     ->orWhere(function ($sq) use ($now) {
                        $sq->whereDate('tanggal_mulai', Carbon::today())
                           ->whereTime('jam_mulai', '<=', $now->format('H:i:s'));
                     });
               })
                  ->where(function ($q) use ($today, $now) {
                     $q->whereNull('tanggal_selesai')
                        ->orWhere('tanggal_selesai', '>', $today)
                        ->orWhere(function ($sq) use ($now) {
                           $sq->whereDate('tanggal_selesai', Carbon::today())
                              ->whereTime('jam_selesai', '>=', $now->format('H:i:s'));
                        });
                  });
            })
            ->count();
         $ujianHariIni = SesiUjian::whereDate('tanggal_mulai', Carbon::today())->count();
         $totalSoal = Soal::count();
         $totalJawaban = Jawaban::count();
         $pesertaSedangUjian = Jawaban::distinct('id_peserta')
            ->count('id_peserta');
         $pesertaSelesaiUjian = Jawaban::distinct('id_peserta')
            ->count('id_peserta');
         try {
            $ujianTerbaru = SesiUjian::with(['batch', 'ujian'])
               ->orderBy('tanggal_mulai', 'desc')
               ->orderBy('jam_mulai', 'desc')
               ->limit(5)
               ->get()
               ->map(function ($sesi) {
                  try {
                     $batchName = $sesi->batch ? $sesi->batch->nama_batch : null;
                     $pesertaCount = 0;

                     if ($batchName) {
                        $pesertaCount = Jawaban::whereHas('soal', function ($query) use ($batchName) {
                           $query->where('batch', $batchName);
                        })
                           ->distinct('id_peserta')
                           ->count('id_peserta');
                     }
                     $namaUjian = 'Ujian #' . $sesi->id_sesi;
                     if ($sesi->ujian && isset($sesi->ujian->nama_ujian)) {
                        $namaUjian = $sesi->ujian->nama_ujian;
                     } elseif ($sesi->mata_pelajaran) {
                        $namaUjian = 'Ujian ' . $sesi->mata_pelajaran;
                     }

                     return [
                        'id_sesi' => $sesi->id_sesi,
                        'nama_ujian' => $namaUjian,
                        'mata_pelajaran' => $sesi->mata_pelajaran ?? '-',
                        'tanggal_mulai' => $sesi->tanggal_mulai ? Carbon::parse($sesi->tanggal_mulai)->format('d/m/Y') : '-',
                        'jam_mulai' => $sesi->jam_mulai ? $sesi->jam_mulai : '-',
                        'tanggal_selesai' => $sesi->tanggal_selesai ? Carbon::parse($sesi->tanggal_selesai)->format('d/m/Y') : '-',
                        'jam_selesai' => $sesi->jam_selesai ? $sesi->jam_selesai : '-',
                        'durasi' => $sesi->durasi_menit ? $sesi->durasi_menit . ' menit' : '-',
                        'peserta' => $pesertaCount,
                        'status' => $sesi->status ?? 'aktif',
                        'batch' => $sesi->batch ? $sesi->batch->nama_batch : '-'
                     ];
                  } catch (\Exception $e) {
                     \Log::error('Error mapping sesi ujian: ' . $e->getMessage());
                     return null;
                  }
               })
               ->filter(); 

         } catch (\Exception $e) {
            \Log::error('Error getting ujian terbaru: ' . $e->getMessage());
            $ujianTerbaru = collect([]);
         }
         $ujianTerbaruArray = is_object($ujianTerbaru) && method_exists($ujianTerbaru, 'values')
            ? $ujianTerbaru->values()->all()
            : (array) $ujianTerbaru;

         $stats = [
            'total_ujian' => $totalUjian,
            'peserta_aktif' => $pesertaAktif,
            'ujian_hari_ini' => $ujianHariIni,
            'ujian_selesai' => $ujianSelesai,
            'ujian_aktif' => $ujianAktif,
            'ujian_terjadwal' => $ujianTerjadwal,
            'total_soal' => $totalSoal,
            'total_jawaban' => $totalJawaban,
            'peserta_sedang_ujian' => $pesertaSedangUjian,
            'peserta_selesai_ujian' => $pesertaSelesaiUjian,
            'ujian_terbaru' => $ujianTerbaruArray
         ];

         return response()->json([
            'success' => true,
            'data' => $stats
         ]);
      } catch (\Exception $e) {
         \Log::error('Dashboard error: ' . $e->getMessage(), [
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString()
         ]);

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
