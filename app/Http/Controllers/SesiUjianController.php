<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\SesiUjian;
use App\Models\Batch;
use App\Models\Peserta;
use App\Models\Soal;
use Carbon\Carbon;

class SesiUjianController extends Controller
{

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
         $sesiUjian = SesiUjian::with(['ujian', 'batch'])
            ->select('id_sesi', 'id_ujian', 'id_batch', 'mata_pelajaran', 'deskripsi', 'tanggal_mulai', 'jam_mulai', 'jam_selesai', 'tanggal_selesai', 'durasi_menit', 'status')
            ->orderBy('tanggal_mulai', 'desc')
            ->orderBy('jam_mulai', 'desc')
            ->get();
         $batchNames = \DB::table('batch')
            ->pluck('nama_batch', 'id_batch')
            ->toArray();
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
               $waktuMulai = null;
               $waktuSelesai = null;
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
                  'mata_pelajaran' => $sesiUjianItem->mata_pelajaran ?? '',
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
                  'created_at' => 'N/A',
                  'updated_at' => 'N/A'
               ];
            } catch (\Exception $e) {
               \Log::error('Error transforming sesi ujian data:', [
                  'sesi_ujian_id' => $sesiUjianItem->id_sesi,
                  'error' => $e->getMessage()
               ]);

               return [
                  'id' => $sesiUjianItem->id_sesi,
                  'nama_ujian' => 'Error loading data',
                  'mata_pelajaran' => $sesiUjianItem->mata_pelajaran ?? '',
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
                  'created_at' => 'N/A',
                  'updated_at' => 'N/A'
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
         $today = Carbon::today();
         $now = Carbon::now();
         $total = SesiUjian::count();
         $completed = SesiUjian::where(function ($query) use ($today) {
            $query->where('status', 'nonaktif')
               ->orWhere(function ($q) use ($today) {
                  $q->whereNotNull('tanggal_selesai')
                     ->where('tanggal_selesai', '<', $today);
               });
         })->count();
         $currentTime = $now->format('H:i:s');
         $scheduled = SesiUjian::where('status', 'aktif')
            ->where(function ($query) use ($today, $currentTime) {
               $query->where('tanggal_mulai', '>', $today)
                  ->orWhere(function ($q) use ($today, $currentTime) {
                     $q->whereDate('tanggal_mulai', $today)
                        ->where('jam_mulai', '>', $currentTime);
                  });
            })
            ->count();
         $currentTime = $now->format('H:i:s');
         $active = SesiUjian::where('status', 'aktif')
            ->where(function ($query) use ($today, $currentTime) {
               $query->where(function ($q) use ($today, $currentTime) {
                  $q->where('tanggal_mulai', '<', $today)
                     ->orWhere(function ($sq) use ($currentTime) {
                        $sq->whereDate('tanggal_mulai', Carbon::today())
                           ->where('jam_mulai', '<=', $currentTime);
                     });
               })
                  ->where(function ($q) use ($today, $currentTime) {
                     $q->whereNull('tanggal_selesai')
                        ->orWhere('tanggal_selesai', '>', $today)
                        ->orWhere(function ($sq) use ($currentTime) {
                           $sq->whereDate('tanggal_selesai', Carbon::today())
                              ->where('jam_selesai', '>=', $currentTime);
                        });
                  });
            })
            ->count();

         \Log::info('SesiUjian stats calculated:', [
            'total' => $total,
            'active' => $active,
            'scheduled' => $scheduled,
            'completed' => $completed
         ]);

         return response()->json([
            'success' => true,
            'data' => [
               'total' => $total,
               'active' => $active,
               'scheduled' => $scheduled,
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
         \Log::info('SesiUjian Store Request Data:', $request->all());

         $validator = Validator::make($request->all(), [
            'deskripsi' => 'nullable|string',
            'mata_pelajaran' => 'required|array|min:1',
            'mata_pelajaran.*' => 'string|max:255',
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
         $tanggalMulai = date('Y-m-d', strtotime($request->tanggal_mulai));
         $jamMulai = date('H:i:s', strtotime($request->tanggal_mulai));
         $tanggalSelesai = date('Y-m-d', strtotime($request->tanggal_selesai));
         $jamSelesai = date('H:i:s', strtotime($request->tanggal_selesai));
         \Log::info('Parsed datetime values:', [
            'tanggal_mulai' => $tanggalMulai,
            'jam_mulai' => $jamMulai,
            'tanggal_selesai' => $tanggalSelesai,
            'jam_selesai' => $jamSelesai
         ]);
         $mataPelajaranString = implode(', ', $request->mata_pelajaran);
         $namaUjian = 'Ujian ' . $mataPelajaranString;
         $ujian = \App\Models\Ujian::firstOrCreate(
            ['nama_ujian' => $namaUjian],
            [
               'mata_pelajaran' => $mataPelajaranString,
               'deskripsi' => '',
            ]
         );

         // Calculate durasi_menit automatically if not provided
         $durasiMenit = $request->durasi_menit;
         if (!$durasiMenit) {
            // Calculate from soal durasi_soal
            $batch = Batch::find($request->id_batch);
            if ($batch) {
               $soalQuery = Soal::whereRaw('LOWER(TRIM(batch)) = ?', [strtolower(trim($batch->nama_batch))]);
               if (!empty($request->mata_pelajaran)) {
                  $soalQuery->where(function ($query) use ($request) {
                     $first = true;
                     foreach ($request->mata_pelajaran as $mp) {
                        $mpNormalized = strtolower(trim($mp));
                        if ($first) {
                           $query->whereRaw('LOWER(TRIM(mata_pelajaran)) = ?', [$mpNormalized]);
                           $first = false;
                        } else {
                           $query->orWhereRaw('LOWER(TRIM(mata_pelajaran)) = ?', [$mpNormalized]);
                        }
                     }
                  });
               }
               $soal = $soalQuery->get();
               $durasiMenit = $soal->sum('durasi_soal');
            }
         }

         $sesiUjian = SesiUjian::create([
            'id_ujian' => $ujian->id_ujian,
            'id_batch' => $request->id_batch,
            'mata_pelajaran' => $mataPelajaranString,
            'deskripsi' => $request->deskripsi ?? '',
            'tanggal_mulai' => $tanggalMulai,
            'tanggal_selesai' => $tanggalSelesai,
            'jam_mulai' => $jamMulai,
            'jam_selesai' => $jamSelesai,
            'durasi_menit' => $durasiMenit,
            'status' => 'aktif',
            'hide_nomor_urut' => $request->has('hide_nomor_urut') ? (bool)$request->hide_nomor_urut : false,
            'hide_poin' => $request->has('hide_poin') ? (bool)$request->hide_poin : false,
            'hide_mata_pelajaran' => $request->has('hide_mata_pelajaran') ? (bool)$request->hide_mata_pelajaran : false,
         ]);


         DB::commit();

         return response()->json([
            'success' => true,
            'message' => 'Sesi ujian berhasil dibuat untuk ' . count($request->mata_pelajaran) . ' mata pelajaran',
            'data' => $sesiUjian
         ]);
      } catch (\Exception $e) {
         DB::rollBack();
         \Log::error('Error creating sesi ujian:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString(),
            'request_data' => $request->all()
         ]);

         return response()->json([
            'success' => false,
            'message' => 'Gagal membuat sesi ujian: ' . $e->getMessage(),
            'error_details' => config('app.debug') ? $e->getMessage() : 'Terjadi kesalahan internal'
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
            'hide_nomor_urut' => (bool)$sesiUjian->hide_nomor_urut,
            'hide_poin' => (bool)$sesiUjian->hide_poin,
            'hide_mata_pelajaran' => (bool)$sesiUjian->hide_mata_pelajaran,
            'created_at' => 'N/A',
            'updated_at' => 'N/A'
         ];
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
         \Log::info('SesiUjian Update Request Data:', $request->all());

         $sesiUjian = SesiUjian::findOrFail($id);

         $validator = Validator::make($request->all(), [
            'deskripsi' => 'nullable|string',
            'mata_pelajaran' => 'required|array|min:1',
            'mata_pelajaran.*' => 'string|max:255',
            'tanggal_mulai' => 'required|string',
            'tanggal_selesai' => 'required|string',
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
         \Log::info('DateTime parsing - Raw values:', [
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'tanggal_mulai_type' => gettype($request->tanggal_mulai),
            'tanggal_selesai_type' => gettype($request->tanggal_selesai)
         ]);
         if (empty($request->tanggal_mulai) || empty($request->tanggal_selesai)) {
            throw new \Exception('Tanggal mulai atau tanggal selesai tidak boleh kosong');
         }

         $tanggalMulai = date('Y-m-d', strtotime($request->tanggal_mulai));
         $jamMulai = date('H:i:s', strtotime($request->tanggal_mulai));
         $tanggalSelesai = date('Y-m-d', strtotime($request->tanggal_selesai));
         $jamSelesai = date('H:i:s', strtotime($request->tanggal_selesai));

         \Log::info('DateTime parsing - Parsed values:', [
            'tanggal_mulai' => $tanggalMulai,
            'jam_mulai' => $jamMulai,
            'tanggal_selesai' => $tanggalSelesai,
            'jam_selesai' => $jamSelesai
         ]);

         DB::beginTransaction();
         \Log::info('Mata pelajaran data type:', ['type' => gettype($request->mata_pelajaran), 'value' => $request->mata_pelajaran]);

         $mataPelajaranString = is_array($request->mata_pelajaran)
            ? implode(', ', $request->mata_pelajaran)
            : $request->mata_pelajaran;

         \Log::info('Mata pelajaran string:', ['string' => $mataPelajaranString]);
         $namaUjian = 'Ujian ' . $mataPelajaranString;
         try {
            \Log::info('Creating/updating ujian with data:', [
               'nama_ujian' => $namaUjian,
               'mata_pelajaran' => $mataPelajaranString
            ]);

            $ujian = \App\Models\Ujian::firstOrCreate(
               ['nama_ujian' => $namaUjian],
               [
                  'mata_pelajaran' => $mataPelajaranString,
                  'deskripsi' => '',
               ]
            );

            \Log::info('Ujian created/updated successfully:', ['ujian_id' => $ujian->id_ujian]);
         } catch (\Exception $e) {
            \Log::error('Error creating/updating ujian:', [
               'error' => $e->getMessage(),
               'nama_ujian' => $namaUjian,
               'mata_pelajaran' => $mataPelajaranString
            ]);
            throw $e;
         }

         try {
            \Log::info('Updating sesi ujian with data:', [
               'id_ujian' => $ujian->id_ujian,
               'id_batch' => $request->id_batch,
               'mata_pelajaran' => $mataPelajaranString,
               'tanggal_mulai' => $tanggalMulai,
               'tanggal_selesai' => $tanggalSelesai
            ]);

            // Calculate durasi_menit automatically if not provided
            $durasiMenit = $request->durasi_menit;
            if (!$durasiMenit) {
               // Calculate from soal durasi_soal
               $batch = Batch::find($request->id_batch);
               if ($batch) {
                  $soalQuery = Soal::whereRaw('LOWER(TRIM(batch)) = ?', [strtolower(trim($batch->nama_batch))]);
                  if (!empty($request->mata_pelajaran)) {
                     $soalQuery->where(function ($query) use ($request) {
                        $first = true;
                        foreach ($request->mata_pelajaran as $mp) {
                           $mpNormalized = strtolower(trim($mp));
                           if ($first) {
                              $query->whereRaw('LOWER(TRIM(mata_pelajaran)) = ?', [$mpNormalized]);
                              $first = false;
                           } else {
                              $query->orWhereRaw('LOWER(TRIM(mata_pelajaran)) = ?', [$mpNormalized]);
                           }
                        }
                     });
                  }
                  $soal = $soalQuery->get();
                  $durasiMenit = $soal->sum('durasi_soal');
               }
            }

            $sesiUjian->update([
               'id_ujian' => $ujian->id_ujian,
               'id_batch' => $request->id_batch,
               'mata_pelajaran' => $mataPelajaranString,
               'hide_nomor_urut' => $request->has('hide_nomor_urut') ? (bool)$request->hide_nomor_urut : false,
               'hide_poin' => $request->has('hide_poin') ? (bool)$request->hide_poin : false,
               'hide_mata_pelajaran' => $request->has('hide_mata_pelajaran') ? (bool)$request->hide_mata_pelajaran : false,
               'deskripsi' => $request->deskripsi ?? '',
               'tanggal_mulai' => $tanggalMulai,
               'tanggal_selesai' => $tanggalSelesai,
               'jam_mulai' => $jamMulai,
               'jam_selesai' => $jamSelesai,
               'durasi_menit' => $durasiMenit,
            ]);

            \Log::info('Sesi ujian updated successfully');
         } catch (\Exception $e) {
            \Log::error('Error updating sesi ujian:', [
               'error' => $e->getMessage(),
               'sesi_ujian_id' => $sesiUjian->id_sesi
            ]);
            throw $e;
         }
         \Log::info('SesiUjian Updated Data:', [
            'id' => $sesiUjian->id_sesi,
            'jam_mulai' => $sesiUjian->jam_mulai,
            'jam_selesai' => $sesiUjian->jam_selesai,
            'updated_at' => 'N/A'
         ]);

         DB::commit();

         return response()->json([
            'success' => true,
            'message' => 'Sesi ujian berhasil diperbarui',
            'data' => $sesiUjian
         ]);
      } catch (\Exception $e) {
         DB::rollBack();
         \Log::error('Error updating sesi ujian:', [
            'id' => $id,
            'request_data' => $request->all(),
            'error_message' => $e->getMessage(),
            'error_file' => $e->getFile(),
            'error_line' => $e->getLine(),
            'error_trace' => $e->getTraceAsString()
         ]);
         if (strpos($e->getMessage(), 'Undefined array key') !== false) {
            \Log::error('UNDEFINED ARRAY KEY ERROR DETECTED:', [
               'message' => $e->getMessage(),
               'file' => $e->getFile(),
               'line' => $e->getLine(),
               'request_mata_pelajaran' => $request->mata_pelajaran ?? 'NOT_SET',
               'request_mata_pelajaran_type' => gettype($request->mata_pelajaran ?? 'NOT_SET')
            ]);
         }

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
      \Log::info('Destroy method called:', ['id' => $id]);

      try {
         $sesiUjian = SesiUjian::findOrFail($id);
         \Log::info('SesiUjian found:', ['id' => $sesiUjian->id_sesi, 'mata_pelajaran' => $sesiUjian->mata_pelajaran]);

         DB::beginTransaction();
         $sesiUjian->delete();
         \Log::info('SesiUjian deleted successfully:', ['id' => $id]);

         DB::commit();

         return response()->json([
            'success' => true,
            'message' => 'Sesi ujian berhasil dihapus'
         ]);
      } catch (\Exception $e) {
         DB::rollBack();
         \Log::error('Error deleting sesi ujian:', [
            'id' => $id,
            'error' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine()
         ]);
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
            ->orderBy('id_soal', 'desc')
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
         $batches = \DB::table('peserta')
            ->select('batch')
            ->whereNotNull('batch')
            ->where('batch', '!=', '')
            ->distinct()
            ->orderBy('batch')
            ->get()
            ->map(function ($item, $index) {
               return [
                  'id' => $index + 1,
                  'batch_name' => $item->batch,
                  'nama_batch' => $item->batch,
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
