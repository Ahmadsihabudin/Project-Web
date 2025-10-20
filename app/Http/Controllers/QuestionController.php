<?php

namespace App\Http\Controllers;

use App\Models\Soal;
use App\Models\Ujian;
use App\Models\Batch;
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
            ->orderBy('created_at', 'desc')
            ->get();

         // Transform data for frontend
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
               'jawaban_benar' => $question->jawaban_benar ?? '',
               'poin' => $question->poin ?? 1,
               'status' => $question->status ?? 'aktif',
               'id_batch' => $question->batch, // Use batch string field
               'id_ujian' => null, // No longer available
               'ujian' => 'Tidak ada ujian', // No longer available
               'batch' => $question->batch ?: 'Tidak ada batch', // Use batch string field directly
               'created_at' => $question->created_at ? $question->created_at->format('d/m/Y H:i') : '-',
               'updated_at' => $question->updated_at ? $question->updated_at->format('d/m/Y H:i') : '-'
            ];
         });

         // Calculate statistics
         $stats = [
            'total' => $questions->count(),
            'aktif' => $questions->where('status', 'aktif')->count(),
            'tidak_aktif' => $questions->where('status', 'tidak_aktif')->count()
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
         'tipe_soal' => 'required|in:pilihan_ganda,essay,benar_salah',
         'poin' => 'required|integer|min:1|max:100',
         'status' => 'required|in:aktif,tidak_aktif',
         'id_ujian' => 'nullable|exists:ujian,id_ujian',
         'id_batch' => 'required|string|max:255',
         'durasi_menit' => 'required|integer|min:1|max:300'
      ]);

      if ($validator->fails()) {
         return response()->json([
            'success' => false,
            'message' => 'Validasi gagal',
            'errors' => $validator->errors()
         ], 400);
      }

      try {
         // Get default batch and ujian if not provided
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

         // Create or find batch
         $batch = Batch::firstOrCreate(
            ['nama_batch' => $request->id_batch],
            [
               'deskripsi' => 'Batch untuk ' . $request->id_batch,
               'created_at' => now(),
               'updated_at' => now()
            ]
         );

         $question = Soal::create([
            'pertanyaan' => $request->pertanyaan,
            'mata_pelajaran' => $request->mata_pelajaran,
            'tipe_soal' => $request->tipe_soal,
            'opsi_a' => $request->opsi_a ?? '',
            'opsi_b' => $request->opsi_b ?? '',
            'opsi_c' => $request->opsi_c ?? '',
            'opsi_d' => $request->opsi_d ?? '',
            'jawaban_benar' => $request->jawaban_benar ?? '',
            'poin' => $request->poin,
            'status' => $request->status,
            'id_ujian' => $request->id_ujian ?? $defaultUjian->id_ujian,
            'id_batch' => $batch->id_batch,
            'durasi_menit' => $request->durasi_menit
         ]);

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
         'tipe_soal' => 'required|in:pilihan_ganda,essay,benar_salah',
         'poin' => 'required|integer|min:1|max:100',
         'status' => 'required|in:aktif,tidak_aktif',
         'id_ujian' => 'nullable|exists:ujian,id_ujian',
         'id_batch' => 'required|string|max:255',
         'durasi_menit' => 'required|integer|min:1|max:300'
      ]);

      if ($validator->fails()) {
         return response()->json([
            'success' => false,
            'message' => 'Validasi gagal',
            'errors' => $validator->errors()
         ], 400);
      }

      try {
         $question = Soal::findOrFail($id);

         // Get default ujian if not provided
         $defaultUjian = \App\Models\Ujian::first();

         // Create or find batch
         $batch = Batch::firstOrCreate(
            ['nama_batch' => $request->id_batch],
            [
               'deskripsi' => 'Batch untuk ' . $request->id_batch,
               'created_at' => now(),
               'updated_at' => now()
            ]
         );

         $question->update([
            'pertanyaan' => $request->pertanyaan,
            'mata_pelajaran' => $request->mata_pelajaran,
            'tipe_soal' => $request->tipe_soal,
            'opsi_a' => $request->opsi_a ?? '',
            'opsi_b' => $request->opsi_b ?? '',
            'opsi_c' => $request->opsi_c ?? '',
            'opsi_d' => $request->opsi_d ?? '',
            'jawaban_benar' => $request->jawaban_benar ?? '',
            'poin' => $request->poin,
            'status' => $request->status,
            'id_ujian' => $request->id_ujian ?? $defaultUjian->id_ujian,
            'id_batch' => $batch->id_batch,
            'durasi_menit' => $request->durasi_menit
         ]);

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
         $question->delete();

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
         $aktif = Soal::where('status', 'aktif')->count();

         return response()->json([
            'success' => true,
            'stats' => [
               'total' => $total,
               'aktif' => $aktif
            ]
         ]);
      } catch (\Exception $e) {
         return response()->json([
            'success' => false,
            'message' => 'Gagal memuat statistik: ' . $e->getMessage()
         ], 500);
      }
   }
}
