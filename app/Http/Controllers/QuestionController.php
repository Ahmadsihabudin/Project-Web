<?php

namespace App\Http\Controllers;

use App\Models\Soal;
use App\Models\Ujian;
use App\Models\Batch;
use App\Http\Controllers\SesiUjianController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class QuestionController extends Controller
{
   /**
    * Get all batches for dropdown
    */
   public function getBatches()
   {
      try {
         $batches = Batch::orderBy('nama_batch', 'asc')->get();

         return response()->json([
            'success' => true,
            'data' => $batches
         ]);
      } catch (\Exception $e) {
         return response()->json([
            'success' => false,
            'message' => 'Gagal memuat data batch: ' . $e->getMessage()
         ], 500);
      }
   }

   /**
    * Display a listing of questions
    */
   public function index()
   {
      return view('exam.questions');
   }

   /**
    * Get questions data for API
    */
   public function data(Request $request)
   {
      try {
         $questions = Soal::with(['batch'])
            ->orderBy('id_soal', 'desc')
            ->get();
         $transformedQuestions = $questions->map(function ($question) {
            return [
               'id' => $question->id_soal,
               'pertanyaan' => $question->pertanyaan,
               'mata_pelajaran' => $question->mata_pelajaran ?? 'Matematika',
               'tipe_soal' => $question->tipe_soal ?? 'pilihan_ganda',
               'opsi_a' => $question->opsi_a ?? '',
               'opsi_b' => $question->opsi_b ?? '',
               'opsi_c' => $question->opsi_c ?? '',
               'opsi_d' => $question->opsi_d ?? '',
               'opsi_e' => $question->opsi_e ?? '',
               'opsi_f' => $question->opsi_f ?? '',
               'jawaban_benar' => $question->jawaban_benar ?? '',
               'poin' => $question->poin ?? 1,
               'durasi_soal' => $question->durasi_soal ?? null,
               'gambar' => $question->gambar ?? null,
               'umpan_balik' => $question->umpan_balik ?? null,
               'jenis_penilaian' => $question->jenis_penilaian ?? 'normal',
               'poin_benar' => $question->poin_benar ?? null,
               'poin_salah' => $question->poin_salah ?? 0,
               'id_batch' => $question->batch,
               'id_ujian' => null,
               'ujian' => 'Tidak ada ujian',
               'batch' => $question->batch ?: 'Tidak ada batch',
               'created_at' => 'N/A',
               'updated_at' => 'N/A'
            ];
         });
         $stats = [
            'total' => $questions->count(),
            'aktif' => $questions->count(), 
            'tidak_aktif' => 0
         ];

         return response()->json([
            'success' => true,
            'data' => $transformedQuestions,
            'stats' => $stats
         ]);
      } catch (\Exception $e) {
         return response()->json([
            'success' => false,
            'message' => 'Gagal memuat data soal: ' . $e->getMessage()
         ], 500);
      }
   }

   /**
    * Store a newly created question
    */
   public function store(Request $request)
   {
      $validator = Validator::make($request->all(), [
         'pertanyaan' => 'required|string|max:1000',
         'mata_pelajaran' => 'required|string|max:100',
         'tipe_soal' => 'required|in:pilihan_ganda,benar_salah',
         'poin' => 'required|integer|min:1|max:100',
         'batch' => 'required|string|max:255',
         'gambar' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
         'durasi_soal' => 'required|integer|min:1',
         'jenis_penilaian' => 'required|in:normal,pengurangan_poin',
         'poin_benar' => 'nullable|integer|min:1',
         'poin_salah' => 'required|integer',
      ], [
         'durasi_soal.required' => 'Durasi Soal (Menit) harus diisi',
         'durasi_soal.integer' => 'Durasi Soal harus berupa angka',
         'durasi_soal.min' => 'Durasi Soal minimal 1 menit',
         'jenis_penilaian.required' => 'Jenis penilaian harus dipilih',
         'jenis_penilaian.in' => 'Jenis penilaian harus normal atau pengurangan_poin',
         'poin_salah.required' => 'Poin salah harus diisi',
         'poin_salah.integer' => 'Poin salah harus berupa angka',
      ]);

      // Validasi custom untuk poin_salah berdasarkan jenis_penilaian
      if ($request->jenis_penilaian === 'pengurangan_poin') {
         if ($request->poin_salah >= 0) {
            return response()->json([
               'success' => false,
               'message' => 'Validasi gagal',
               'errors' => ['poin_salah' => ['Jika menggunakan pengurangan poin, poin salah harus negatif (contoh: -5, -10)']]
            ], 400);
         }
      } else {
         // Normal: poin_salah harus 0
         if ($request->poin_salah != 0) {
            $request->merge(['poin_salah' => 0]);
         }
      }

      if ($validator->fails()) {
         return response()->json([
            'success' => false,
            'message' => 'Validasi gagal',
            'errors' => $validator->errors()
         ], 400);
      }

      try {
         $defaultBatch = \App\Models\Batch::first();
         $defaultUjian = \App\Models\Ujian::first();

         if (!$defaultBatch) {
            $defaultBatch = \App\Models\Batch::create([
               'nama_batch' => 'Batch Default',
               'deskripsi' => 'Batch default untuk soal',
               'tanggal_mulai' => now(),
               'tanggal_selesai' => now()->addYears(1),
               'status' => 'aktif'
            ]);
         }

         if (!$defaultUjian) {
            $defaultUjian = \App\Models\Ujian::create([
               'id_batch' => $defaultBatch->id_batch,
               'nama_ujian' => 'Ujian Default',
               'mata_pelajaran' => 'Umum',
               'deskripsi' => 'Ujian default untuk soal',
               'tanggal_mulai' => now(),
               'jam_mulai' => '08:00:00',
               'jam_selesai' => '10:00:00',
               'tanggal_selesai' => now()->addDays(7),
               'durasi_menit' => 60,
               'durasi' => 60,
               'status' => 'aktif'
            ]);
         }
       
         $batchName = $request->batch ?? $request->id_batch ?? 'Batch Default';

         // Handle image upload
         $gambarPath = null;
         if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $gambarName = time() . '_' . uniqid() . '.' . $gambar->getClientOriginalExtension();
            $gambar->move(public_path('storage/soal_images'), $gambarName);
            $gambarPath = 'storage/soal_images/' . $gambarName;
         }

         $question = Soal::create([
            'pertanyaan' => $request->pertanyaan,
            'gambar' => $gambarPath,
            'mata_pelajaran' => $request->mata_pelajaran,
            'tipe_soal' => $request->tipe_soal,
            'opsi_a' => $request->opsi_a ?? '',
            'opsi_b' => $request->opsi_b ?? '',
            'opsi_c' => $request->opsi_c ?? '',
            'opsi_d' => $request->opsi_d ?? '',
            'opsi_e' => $request->opsi_e ?? '',
            'opsi_f' => $request->opsi_f ?? '',
            'jawaban_benar' => $request->jawaban_benar ?? '',
            'umpan_balik' => $request->umpan_balik ?? '',
            'level_kesulitan' => $request->level_kesulitan ?? 'sedang',
            'poin' => $request->poin ?? 1,
            'durasi_soal' => $request->durasi_soal ?? null,
            'batch' => $batchName,
            'jenis_penilaian' => $request->jenis_penilaian ?? 'normal',
            'poin_benar' => $request->poin_benar ? (int)$request->poin_benar : null,
            'poin_salah' => (int)($request->poin_salah ?? 0)
         ]);

         // Auto-update durasi sesi ujian yang menggunakan batch dan mata pelajaran ini
         SesiUjianController::updateDurasiSesiUjian($batchName, $request->mata_pelajaran);
         
         // Update semua durasi untuk memastikan konsistensi
         SesiUjianController::updateAllDurasiSesiUjian();

         return response()->json([
            'success' => true,
            'message' => 'Soal berhasil ditambahkan',
            'data' => $question
         ]);
      } catch (\Exception $e) {
         return response()->json([
            'success' => false,
            'message' => 'Gagal menambahkan soal: ' . $e->getMessage()
         ], 500);
      }
   }

   /**
    * Display the specified question
    */
   public function show($id)
   {
      try {
         $question = Soal::with(['ujian', 'batch'])->findOrFail($id);

         return response()->json([
            'success' => true,
            'data' => $question
         ]);
      } catch (\Exception $e) {
         return response()->json([
            'success' => false,
            'message' => 'Soal tidak ditemukan'
         ], 404);
      }
   }

   /**
    * Update the specified question
    */
   public function update(Request $request, $id)
   {
      $validator = Validator::make($request->all(), [
         'pertanyaan' => 'required|string|max:1000',
         'mata_pelajaran' => 'required|string|max:100',
         'tipe_soal' => 'required|in:pilihan_ganda,benar_salah',
         'poin' => 'required|integer|min:1|max:100',
         'batch' => 'nullable|string|max:255',
         'gambar' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
         'durasi_soal' => 'required|integer|min:1',
         'jenis_penilaian' => 'required|in:normal,pengurangan_poin',
         'poin_benar' => 'nullable|integer|min:1',
         'poin_salah' => 'required|integer',
      ], [
         'pertanyaan.required' => 'Pertanyaan harus diisi',
         'pertanyaan.max' => 'Pertanyaan maksimal 1000 karakter',
         'mata_pelajaran.required' => 'Mata pelajaran harus diisi',
         'mata_pelajaran.max' => 'Mata pelajaran maksimal 100 karakter',
         'tipe_soal.required' => 'Tipe soal harus dipilih',
         'tipe_soal.in' => 'Tipe soal harus salah satu dari: pilihan_ganda, benar_salah',
         'poin.required' => 'Poin harus diisi',
         'poin.integer' => 'Poin harus berupa angka',
         'poin.min' => 'Poin minimal 1',
         'poin.max' => 'Poin maksimal 100',
         'batch.max' => 'Batch maksimal 255 karakter',
         'gambar.image' => 'File harus berupa gambar',
         'gambar.mimes' => 'Format gambar harus jpeg, jpg, png, atau gif',
         'gambar.max' => 'Ukuran gambar maksimal 2MB',
         'durasi_soal.required' => 'Durasi Soal (Menit) harus diisi',
         'durasi_soal.integer' => 'Durasi Soal harus berupa angka',
         'durasi_soal.min' => 'Durasi Soal minimal 1 menit',
         'jenis_penilaian.required' => 'Jenis penilaian harus dipilih',
         'jenis_penilaian.in' => 'Jenis penilaian harus normal atau pengurangan_poin',
         'poin_salah.required' => 'Poin salah harus diisi',
         'poin_salah.integer' => 'Poin salah harus berupa angka',
         'poin_salah.max' => 'Poin salah maksimal 0 (tidak boleh positif)'
      ]);

      // Validasi custom untuk poin_salah berdasarkan jenis_penilaian
      if ($request->jenis_penilaian === 'pengurangan_poin') {
         if ($request->poin_salah >= 0) {
            return response()->json([
               'success' => false,
               'message' => 'Validasi gagal',
               'errors' => ['poin_salah' => ['Jika menggunakan pengurangan poin, poin salah harus negatif (contoh: -5, -10)']]
            ], 400);
         }
      } else {
         // Normal: poin_salah harus 0
         if ($request->poin_salah != 0) {
            $request->merge(['poin_salah' => 0]);
         }
      }

      if ($validator->fails()) {
         return response()->json([
            'success' => false,
            'message' => 'Validasi gagal',
            'errors' => $validator->errors()
         ], 400);
      }

      try {
         $question = Soal::findOrFail($id);

         $batchName = $request->batch ?? $request->id_batch ?? $question->batch ?? 'Batch Default';

         // Handle image upload
         $gambarPath = $question->gambar; // Keep existing image by default
         if ($request->hasFile('gambar')) {
            // Delete old image if exists
            if ($question->gambar && file_exists(public_path($question->gambar))) {
               unlink(public_path($question->gambar));
            }
            
            $gambar = $request->file('gambar');
            $gambarName = time() . '_' . uniqid() . '.' . $gambar->getClientOriginalExtension();
            $gambar->move(public_path('storage/soal_images'), $gambarName);
            $gambarPath = 'storage/soal_images/' . $gambarName;
         } elseif ($request->has('hapus_gambar') && $request->hapus_gambar == '1') {
            // Delete image if user wants to remove it
            if ($question->gambar && file_exists(public_path($question->gambar))) {
               unlink(public_path($question->gambar));
            }
            $gambarPath = null;
         }

         // Simpan batch lama untuk update durasi sesi ujian lama jika batch berubah
         $oldBatchName = $question->batch;
         $oldMataPelajaran = $question->mata_pelajaran;

         $question->update([
            'pertanyaan' => $request->pertanyaan,
            'gambar' => $gambarPath,
            'mata_pelajaran' => $request->mata_pelajaran,
            'tipe_soal' => $request->tipe_soal,
            'opsi_a' => $request->opsi_a ?? '',
            'opsi_b' => $request->opsi_b ?? '',
            'opsi_c' => $request->opsi_c ?? '',
            'opsi_d' => $request->opsi_d ?? '',
            'opsi_e' => $request->opsi_e ?? '',
            'opsi_f' => $request->opsi_f ?? '',
            'jawaban_benar' => $request->jawaban_benar ?? '',
            'umpan_balik' => $request->umpan_balik ?? '',
            'level_kesulitan' => $request->level_kesulitan ?? $question->level_kesulitan ?? 'sedang',
            'poin' => $request->poin ?? $question->poin ?? 1,
            'durasi_soal' => $request->has('durasi_soal') && $request->durasi_soal ? (int)$request->durasi_soal : null,
            'batch' => $batchName,
            'jenis_penilaian' => $request->jenis_penilaian ?? $question->jenis_penilaian ?? 'normal',
            'poin_benar' => $request->poin_benar ? (int)$request->poin_benar : null,
            'poin_salah' => (int)($request->poin_salah ?? $question->poin_salah ?? 0)
         ]);

         // Auto-update durasi sesi ujian yang menggunakan batch dan mata pelajaran baru
         SesiUjianController::updateDurasiSesiUjian($batchName, $request->mata_pelajaran);
         
         // Jika batch atau mata pelajaran berubah, update juga sesi ujian lama
         if ($oldBatchName !== $batchName || $oldMataPelajaran !== $request->mata_pelajaran) {
            SesiUjianController::updateDurasiSesiUjian($oldBatchName, $oldMataPelajaran);
         }
         
         // Update semua durasi untuk memastikan konsistensi
         SesiUjianController::updateAllDurasiSesiUjian();

         return response()->json([
            'success' => true,
            'message' => 'Soal berhasil diperbarui',
            'data' => $question
         ]);
      } catch (\Exception $e) {
         return response()->json([
            'success' => false,
            'message' => 'Gagal memperbarui soal: ' . $e->getMessage()
         ], 500);
      }
   }

   /**
    * Remove the specified question
    */
   public function destroy($id)
   {
      try {
         $question = Soal::findOrFail($id);
         
         // Simpan batch dan mata pelajaran sebelum menghapus untuk update durasi sesi ujian
         $batchName = $question->batch;
         $mataPelajaran = $question->mata_pelajaran;
         
         // Hapus gambar jika ada
         if ($question->gambar && file_exists(public_path($question->gambar))) {
            unlink(public_path($question->gambar));
         }
         
         $question->delete();

         // Auto-update durasi sesi ujian yang menggunakan batch dan mata pelajaran ini
         SesiUjianController::updateDurasiSesiUjian($batchName, $mataPelajaran);
         
         // Update semua durasi untuk memastikan konsistensi
         SesiUjianController::updateAllDurasiSesiUjian();

         return response()->json([
            'success' => true,
            'message' => 'Soal berhasil dihapus'
         ]);
      } catch (\Exception $e) {
         return response()->json([
            'success' => false,
            'message' => 'Gagal menghapus soal: ' . $e->getMessage()
         ], 500);
      }
   }

   /**
    * Get statistics for dashboard
    */
   public function getStats()
   {
      try {
         $total = Soal::count();

        
         $aktif = $total;

        
         $byCategory = Soal::select('mata_pelajaran')
            ->distinct()
            ->whereNotNull('mata_pelajaran')
            ->where('mata_pelajaran', '!=', '')
            ->get()
            ->pluck('mata_pelajaran')
            ->unique()
            ->values()
            ->toArray();

  
         $byDifficulty = Soal::select('level_kesulitan')
            ->distinct()
            ->whereNotNull('level_kesulitan')
            ->where('level_kesulitan', '!=', '')
            ->get()
            ->pluck('level_kesulitan')
            ->unique()
            ->values()
            ->toArray();

         return response()->json([
            'success' => true,
            'data' => [
               'total' => $total,
               'active' => $aktif,
               'by_category' => $byCategory,
               'by_difficulty' => $byDifficulty
            ]
         ]);
      } catch (\Exception $e) {
         \Log::error('Error in getStats: ' . $e->getMessage(), [
            'trace' => $e->getTraceAsString()
         ]);
         return response()->json([
            'success' => false,
            'message' => 'Gagal memuat statistik: ' . $e->getMessage()
         ], 500);
      }
   }
}
