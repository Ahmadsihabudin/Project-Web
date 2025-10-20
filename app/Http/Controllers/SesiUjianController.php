<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\SesiUjian;
use App\Models\Batch;
use App\Models\Peserta;
use App\Models\Soal;

class SesiUjianController extends Controller
{
   /**
    * Display a listing of sesi ujian
    */
   public function index()
   {
      return view('admin.sesi-ujian.index');
   }


   public function create()
   {
      return view('admin.sesi-ujian.create');
   }

   /**
    * Display the specified sesi ujian
    */
   public function show($id)
   {
      // Redirect to index since show view was removed
      return redirect()->route('admin.sesi-ujian.index');
   }

   /**
    * Show the form for editing the specified sesi ujian
    */
   public function edit($id)
   {
      return view('admin.sesi-ujian.edit', compact('id'));
   }

   /**
    * Get sesi ujian data for AJAX
    */
   public function data(Request $request)
   {
      try {
         \Log::info('Loading sesi ujian data...');
         $sesiUjian = SesiUjian::with(['ujian', 'batch'])
            ->select('id_sesi', 'id_ujian', 'id_batch', 'mata_pelajaran', 'deskripsi', 'tanggal_mulai', 'jam_mulai', 'jam_selesai', 'tanggal_selesai', 'durasi_menit', 'status', 'created_at', 'updated_at')
            ->orderBy('tanggal_mulai', 'desc')
            ->orderBy('jam_mulai', 'desc')
            ->get();

         \Log::info('Found sesi ujian:', ['count' => $sesiUjian->count()]);

         // Get batch names from database
         $batchNames = \DB::table('batch')
            ->pluck('nama_batch', 'id_batch')
            ->toArray();

         // Get participant counts for each batch
         // Map batch names to participant counts
         $participantCounts = [];
         $batchParticipants = \DB::table('peserta')
            ->select('batch', \DB::raw('COUNT(*) as count'))
            ->whereNotNull('batch')
            ->where('batch', '!=', '')
            ->groupBy('batch')
            ->get();

         foreach ($batchParticipants as $item) {
            $participantCounts[$item->batch] = $item->count;
         }

         $transformedSesiUjian = $sesiUjian->map(function ($sesiUjianItem) use ($batchNames, $participantCounts) {
            try {
               // Combine date and time for datetime-local display
               // Format waktu dengan benar
               $waktuMulai = null;
               $waktuSelesai = null;

               // Format waktu dengan benar - hanya gabungkan jika kedua field ada
               if ($sesiUjianItem->tanggal_mulai && $sesiUjianItem->jam_mulai) {
                  $waktuMulai = $sesiUjianItem->tanggal_mulai . ' ' . $sesiUjianItem->jam_mulai;
               } else if ($sesiUjianItem->tanggal_mulai) {
                  $waktuMulai = $sesiUjianItem->tanggal_mulai;
               }

               if ($sesiUjianItem->tanggal_selesai && $sesiUjianItem->jam_selesai) {
                  $waktuSelesai = $sesiUjianItem->tanggal_selesai . ' ' . $sesiUjianItem->jam_selesai;
               } else if ($sesiUjianItem->tanggal_selesai) {
                  $waktuSelesai = $sesiUjianItem->tanggal_selesai;
               }

               $batchName = 'Unknown Batch';
               $participantCount = 0;

               // Handle batch relationship safely
               if ($sesiUjianItem->batch && $sesiUjianItem->batch->nama_batch) {
                  $batchName = $sesiUjianItem->batch->nama_batch;
                  $participantCount = $participantCounts[$sesiUjianItem->batch->nama_batch] ?? 0;
               } else {
                  $batchName = 'Batch ' . $sesiUjianItem->id_batch;
                  $participantCount = 0;
               }


               return [
                  'id' => $sesiUjianItem->id_sesi,
                  'nama_ujian' => $sesiUjianItem->ujian ? $sesiUjianItem->ujian->nama_ujian : 'Nama Ujian',
                  'deskripsi' => $sesiUjianItem->deskripsi ?? '',
                  'tanggal_mulai' => $sesiUjianItem->tanggal_mulai ? date('Y-m-d', strtotime($sesiUjianItem->tanggal_mulai)) : null,
                  'tanggal_selesai' => $sesiUjianItem->tanggal_selesai ? date('Y-m-d', strtotime($sesiUjianItem->tanggal_selesai)) : null,
                  'jam_mulai' => $sesiUjianItem->jam_mulai ? date('H:i:s', strtotime($sesiUjianItem->jam_mulai)) : null,
                  'jam_selesai' => $sesiUjianItem->jam_selesai ? date('H:i:s', strtotime($sesiUjianItem->jam_selesai)) : null,
                  'waktu_mulai' => $waktuMulai,
                  'waktu_selesai' => $waktuSelesai,
                  'durasi_menit' => $sesiUjianItem->durasi_menit,
                  'status' => $sesiUjianItem->status,
                  'id_batch' => $sesiUjianItem->id_batch,
                  'batch_name' => $batchName,
                  'participant_count' => $participantCount,
                  'created_at' => $sesiUjianItem->created_at,
                  'updated_at' => $sesiUjianItem->updated_at
               ];
            } catch (\Exception $e) {
               \Log::error('Error transforming sesi ujian data:', [
                  'sesi_ujian_id' => $sesiUjianItem->id_sesi,
                  'error' => $e->getMessage()
               ]);

               return [
                  'id' => $sesiUjianItem->id_sesi,
                  'nama_ujian' => 'Error loading data',
                  'deskripsi' => '',
                  'tanggal_mulai' => $sesiUjianItem->tanggal_mulai,
                  'tanggal_selesai' => $sesiUjianItem->tanggal_selesai,
                  'jam_mulai' => $sesiUjianItem->jam_mulai,
                  'jam_selesai' => $sesiUjianItem->jam_selesai,
                  'waktu_mulai' => null,
                  'waktu_selesai' => null,
                  'durasi_menit' => $sesiUjianItem->durasi_menit,
                  'status' => $sesiUjianItem->status,
                  'id_batch' => $sesiUjianItem->id_batch,
                  'batch_name' => 'Error',
                  'participant_count' => 0,
                  'created_at' => $sesiUjianItem->created_at,
                  'updated_at' => $sesiUjianItem->updated_at
               ];
            }
         });

         \Log::info('Returning transformed sesi ujian:', ['count' => $transformedSesiUjian->count()]);

         return response()->json([
            'success' => true,
            'data' => $transformedSesiUjian
         ]);
      } catch (\Exception $e) {
         \Log::error('Error in SesiUjianController@data:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString()
         ]);

         return response()->json([
            'success' => false,
            'message' => 'Gagal memuat data sesi ujian: ' . $e->getMessage()
         ], 500);
      }
   }

   /**
    * Get sesi ujian statistics
    */
   public function stats()
   {
      try {
         $total = SesiUjian::count();
         $active = SesiUjian::where('status', 'aktif')->count();
         $upcoming = SesiUjian::where('status', 'aktif')
            ->where('tanggal_mulai', '>=', now()->toDateString())
            ->count();
         $completed = SesiUjian::where('status', 'nonaktif')->count();

         return response()->json([
            'success' => true,
            'data' => [
               'total' => $total,
               'active' => $active,
               'upcoming' => $upcoming,
               'completed' => $completed
            ]
         ]);
      } catch (\Exception $e) {
         \Log::error('Error in SesiUjianController@stats:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString()
         ]);

         return response()->json([
            'success' => false,
            'message' => 'Gagal memuat statistik: ' . $e->getMessage()
         ], 500);
      }
   }

   /**
    * Store a newly created sesi ujian
    */
   public function store(Request $request)
   {
      try {
         // Debug log untuk melihat data yang diterima
         \Log::info('SesiUjian Store Request Data:', $request->all());

         $validator = Validator::make($request->all(), [
            'deskripsi' => 'nullable|string',
            'mata_pelajaran' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'id_batch' => 'required|integer',
            'durasi_menit' => 'nullable|integer|min:1',
         ]);

         if ($validator->fails()) {
            \Log::error('Validation failed in store:', $validator->errors()->toArray());
            return response()->json([
               'success' => false,
               'message' => 'Validasi gagal',
               'errors' => $validator->errors()
            ], 422);
         }

         DB::beginTransaction();

         // Parse datetime-local format
         $tanggalMulai = date('Y-m-d', strtotime($request->tanggal_mulai));
         $jamMulai = date('H:i:s', strtotime($request->tanggal_mulai));
         $tanggalSelesai = date('Y-m-d', strtotime($request->tanggal_selesai));
         $jamSelesai = date('H:i:s', strtotime($request->tanggal_selesai));

         // Create or get ujian first
         $ujian = \App\Models\Ujian::firstOrCreate(
            ['mata_pelajaran' => $request->mata_pelajaran],
            [
               'nama_ujian' => 'Ujian ' . $request->mata_pelajaran,
               'deskripsi' => '', // Deskripsi sekarang di sesi_ujian
            ]
         );

         $sesiUjian = SesiUjian::create([
            'id_ujian' => $ujian->id_ujian,
            'id_batch' => $request->id_batch,
            'mata_pelajaran' => $request->mata_pelajaran,
            'deskripsi' => $request->deskripsi ?? '',
            'tanggal_mulai' => $tanggalMulai,
            'tanggal_selesai' => $tanggalSelesai,
            'jam_mulai' => $jamMulai,
            'jam_selesai' => $jamSelesai,
            'durasi_menit' => $request->durasi_menit,
            'status' => 'aktif',
         ]);


         DB::commit();

         return response()->json([
            'success' => true,
            'message' => 'Sesi ujian berhasil dibuat',
            'data' => $sesiUjian
         ]);
      } catch (\Exception $e) {
         DB::rollBack();
         return response()->json([
            'success' => false,
            'message' => 'Gagal membuat sesi ujian: ' . $e->getMessage()
         ], 500);
      }
   }

   /**
    * Get sesi ujian data for AJAX
    */
   public function getSesiUjianData($id)
   {
      try {
         $sesiUjian = SesiUjian::with(['ujian', 'batch'])->findOrFail($id);

         // Format data untuk edit form
         $sesiUjianData = [
            'id' => $sesiUjian->id_sesi,
            'deskripsi' => $sesiUjian->deskripsi ?? '',
            'mata_pelajaran' => $sesiUjian->mata_pelajaran,
            'tanggal_mulai' => $sesiUjian->tanggal_mulai ? date('Y-m-d', strtotime($sesiUjian->tanggal_mulai)) : null,
            'tanggal_selesai' => $sesiUjian->tanggal_selesai ? date('Y-m-d', strtotime($sesiUjian->tanggal_selesai)) : null,
            'jam_mulai' => $sesiUjian->jam_mulai ? date('H:i:s', strtotime($sesiUjian->jam_mulai)) : null,
            'jam_selesai' => $sesiUjian->jam_selesai ? date('H:i:s', strtotime($sesiUjian->jam_selesai)) : null,
            'durasi_menit' => $sesiUjian->durasi_menit,
            'status' => $sesiUjian->status,
            'id_batch' => $sesiUjian->id_batch,
            'created_at' => $sesiUjian->created_at,
            'updated_at' => $sesiUjian->updated_at
         ];

         // Debug log untuk melihat data yang dikirim
         \Log::info('SesiUjian Show Data:', [
            'id' => $sesiUjianData['id'],
            'deskripsi' => $sesiUjianData['deskripsi'],
            'mata_pelajaran' => $sesiUjianData['mata_pelajaran'],
            'tanggal_mulai' => $sesiUjianData['tanggal_mulai'],
            'jam_mulai' => $sesiUjianData['jam_mulai'],
            'tanggal_selesai' => $sesiUjianData['tanggal_selesai'],
            'jam_selesai' => $sesiUjianData['jam_selesai'],
            'id_batch' => $sesiUjianData['id_batch']
         ]);

         return response()->json([
            'success' => true,
            'data' => $sesiUjianData
         ]);
      } catch (\Exception $e) {
         return response()->json([
            'success' => false,
            'message' => 'Sesi ujian tidak ditemukan'
         ], 404);
      }
   }

   /**
    * Update the specified sesi ujian
    */
   public function update(Request $request, $id)
   {
      try {
         // Debug log untuk melihat data yang diterima
         \Log::info('SesiUjian Update Request Data:', $request->all());

         $sesiUjian = SesiUjian::findOrFail($id);

         $validator = Validator::make($request->all(), [
            'deskripsi' => 'nullable|string',
            'mata_pelajaran' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'id_batch' => 'required|integer',
            'durasi_menit' => 'nullable|integer|min:1',
         ]);

         if ($validator->fails()) {
            return response()->json([
               'success' => false,
               'message' => 'Validasi gagal',
               'errors' => $validator->errors()
            ], 422);
         }

         // Parse datetime-local format
         $tanggalMulai = date('Y-m-d', strtotime($request->tanggal_mulai));
         $jamMulai = date('H:i:s', strtotime($request->tanggal_mulai));
         $tanggalSelesai = date('Y-m-d', strtotime($request->tanggal_selesai));
         $jamSelesai = date('H:i:s', strtotime($request->tanggal_selesai));

         DB::beginTransaction();

         // Update or create ujian
         $ujian = \App\Models\Ujian::firstOrCreate(
            ['mata_pelajaran' => $request->mata_pelajaran],
            [
               'nama_ujian' => 'Ujian ' . $request->mata_pelajaran,
               'deskripsi' => '', // Deskripsi sekarang di sesi_ujian
            ]
         );

         $sesiUjian->update([
            'id_ujian' => $ujian->id_ujian,
            'id_batch' => $request->id_batch,
            'mata_pelajaran' => $request->mata_pelajaran,
            'deskripsi' => $request->deskripsi ?? '',
            'tanggal_mulai' => $tanggalMulai,
            'tanggal_selesai' => $tanggalSelesai,
            'jam_mulai' => $jamMulai,
            'jam_selesai' => $jamSelesai,
            'durasi_menit' => $request->durasi_menit,
         ]);

         // Debug log untuk melihat data yang tersimpan
         \Log::info('SesiUjian Updated Data:', [
            'id' => $sesiUjian->id_sesi,
            'jam_mulai' => $sesiUjian->jam_mulai,
            'jam_selesai' => $sesiUjian->jam_selesai,
            'updated_at' => $sesiUjian->updated_at
         ]);

         DB::commit();

         return response()->json([
            'success' => true,
            'message' => 'Sesi ujian berhasil diperbarui',
            'data' => $sesiUjian
         ]);
      } catch (\Exception $e) {
         DB::rollBack();
         return response()->json([
            'success' => false,
            'message' => 'Gagal memperbarui sesi ujian: ' . $e->getMessage()
         ], 500);
      }
   }

   /**
    * Remove the specified sesi ujian
    */
   public function destroy($id)
   {
      try {
         $sesiUjian = SesiUjian::findOrFail($id);

         DB::beginTransaction();

         // Delete sesi ujian
         $sesiUjian->delete();

         DB::commit();

         return response()->json([
            'success' => true,
            'message' => 'Sesi ujian berhasil dihapus'
         ]);
      } catch (\Exception $e) {
         DB::rollBack();
         return response()->json([
            'success' => false,
            'message' => 'Gagal menghapus sesi ujian: ' . $e->getMessage()
         ], 500);
      }
   }

   /**
    * Update sesi ujian status
    */
   public function updateStatus(Request $request, $id)
   {
      try {
         $sesiUjian = SesiUjian::findOrFail($id);

         $validator = Validator::make($request->all(), [
            'status' => 'required|in:aktif,nonaktif'
         ]);

         if ($validator->fails()) {
            return response()->json([
               'success' => false,
               'message' => 'Status tidak valid'
            ], 422);
         }

         $sesiUjian->update(['status' => $request->status]);

         return response()->json([
            'success' => true,
            'message' => 'Status sesi ujian berhasil diperbarui',
            'data' => $sesiUjian
         ]);
      } catch (\Exception $e) {
         return response()->json([
            'success' => false,
            'message' => 'Gagal memperbarui status: ' . $e->getMessage()
         ], 500);
      }
   }

   /**
    * Get available questions for sesi ujian
    */
   public function getAvailableQuestions()
   {
      try {
         $questions = Soal::where('status', 'aktif')
            ->orderBy('mata_pelajaran')
            ->orderBy('created_at', 'desc')
            ->get();

         return response()->json([
            'success' => true,
            'data' => $questions
         ]);
      } catch (\Exception $e) {
         return response()->json([
            'success' => false,
            'message' => 'Gagal memuat soal: ' . $e->getMessage()
         ], 500);
      }
   }

   /**
    * Get mata pelajaran from soal table
    */
   public function getMataPelajaran()
   {
      try {
         $mataPelajaran = Soal::getMataPelajaran();

         return response()->json([
            'success' => true,
            'data' => $mataPelajaran
         ]);
      } catch (\Exception $e) {
         \Log::error('Error getting mata pelajaran: ' . $e->getMessage());
         return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan saat mengambil data mata pelajaran'
         ], 500);
      }
   }

   /**
    * Get available batches from peserta table
    */
   public function getAvailableBatches()
   {
      try {
         // Query batch yang memiliki peserta berdasarkan string batch di tabel peserta
         $batches = \DB::table('peserta')
            ->select('batch')
            ->whereNotNull('batch')
            ->where('batch', '!=', '')
            ->distinct()
            ->orderBy('batch')
            ->get()
            ->map(function ($item, $index) {
               return [
                  'id' => $index + 1, // Generate sequential ID
                  'batch_name' => $item->batch, // Store original batch name
                  'nama_batch' => $item->batch, // Display name
                  'keterangan' => 'Batch dari data peserta'
               ];
            });

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
}
