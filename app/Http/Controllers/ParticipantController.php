<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Batch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ParticipantController extends Controller
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
    * Display a listing of participants with statistics
    */
   public function index()
   {
      try {
         $participants = Peserta::select('id_peserta', 'nama_peserta', 'email', 'kode_peserta', 'asal_smk', 'jurusan', 'batch', 'status', 'created_at')
            ->orderBy('created_at', 'desc')
            ->get();

         // Transform data to match frontend expectations
         $transformedParticipants = $participants->map(function ($participant) {
            return [
               'id' => $participant->id_peserta,
               'nama' => $participant->nama_peserta,
               'email' => $participant->email, // Use actual email from database
               'kode_peserta' => $participant->kode_peserta,
               'kode_akses' => '****', // Masked password for security
               'batch' => $participant->batch ?? 'Belum ditentukan', // Use actual batch from database
               'status' => $participant->status ?? 'aktif', // Use actual status from database
               'nilai' => null, // Will be calculated from jawaban table if needed
               'avatar' => strtoupper(substr($participant->nama_peserta, 0, 1)),
               'asal_smk' => $participant->asal_smk,
               'jurusan' => $participant->jurusan,
               'created_at' => $participant->created_at
            ];
         });

         // Calculate statistics
         $stats = [
            'total' => $transformedParticipants->count(),
            'aktif' => $transformedParticipants->where('status', 'aktif')->count(),
            'berlangsung' => 0, // Will be calculated from ujian status if needed
            'selesai' => 0, // Will be calculated from jawaban table if needed
         ];

         return response()->json([
            'success' => true,
            'data' => $transformedParticipants,
            'stats' => $stats
         ]);
      } catch (\Exception $e) {
         return response()->json([
            'success' => false,
            'message' => 'Gagal memuat data peserta: ' . $e->getMessage()
         ], 500);
      }
   }

   /**
    * Get participant data for API
    */
   public function data()
   {
      return $this->index();
   }

   /**
    * Store a newly created participant
    */
   public function store(Request $request)
   {
      $validator = Validator::make($request->all(), [
         'nama' => 'required|string|max:255|min:1',
         'email' => 'nullable|email|max:255', // Email optional for peserta yaa
         'kode_peserta' => 'required|string|max:255|min:1|unique:peserta,kode_peserta',
         'kode_akses' => 'required|string|min:3|max:255',
         'batch' => 'required|string|max:255|min:1',
         'status' => 'required|in:aktif,tidak_aktif|string',
         'asal_smk' => 'nullable|string|max:255',
         'jurusan' => 'nullable|string|max:255'
      ]);

      if ($validator->fails()) {
         return response()->json([
            'success' => false,
            'message' => 'Validasi gagal',
            'errors' => $validator->errors(),
            'debug' => $request->all()
         ], 400);
      }

      try {
         // Get next nomor_urut
         $nextNomor = (Peserta::max('nomor_urut') ?? 0) + 1;

         // Create or find batch
         $batch = Batch::firstOrCreate(
            ['nama_batch' => $request->batch],
            [
               'keterangan' => 'Batch untuk ' . $request->batch,
               'created_at' => now()
            ]
         );

         $participant = Peserta::create([
            'nomor_urut' => $nextNomor,
            'nama_peserta' => $request->nama,
            'kode_peserta' => $request->kode_peserta,
            'kode_akses' => $request->kode_akses, // Store as plain text, not hashed
            'asal_smk' => $request->asal_smk ?: 'SMK Default',
            'jurusan' => $request->jurusan ?: $request->batch, // Use jurusan field if provided
            'batch' => $request->batch,
            'status' => $request->status,
            'email' => $request->email ?: null, // Will be null if not provided
            'last_login_at' => null,
            'login_attempts' => 0,
            'locked_until' => null,
            'remember_token' => null
         ]);

         return response()->json([
            'success' => true,
            'message' => 'Peserta berhasil ditambahkan',
            'data' => $participant
         ]);
      } catch (\Exception $e) {
         return response()->json([
            'success' => false,
            'message' => 'Gagal menambahkan peserta: ' . $e->getMessage()
         ], 500);
      }
   }

   /**
    * Display the specified participant
    */
   public function show($id)
   {
      try {
         $participant = Peserta::findOrFail($id);
         return response()->json([
            'success' => true,
            'data' => $participant
         ]);
      } catch (\Exception $e) {
         return response()->json([
            'success' => false,
            'message' => 'Peserta tidak ditemukan'
         ], 404);
      }
   }

   /**
    * Update the specified participant
    */
   public function update(Request $request, $id)
   {
      $validator = Validator::make($request->all(), [
         'nama' => 'required|string|max:255|min:1',
         'email' => 'nullable|email|max:255', // Email optional for peserta yaa cuy
         'asal_smk' => 'nullable|string|max:255',
         'jurusan' => 'nullable|string|max:255',
         'kode_peserta' => 'required|string|max:255|min:1|unique:peserta,kode_peserta,' . $id . ',id_peserta',
         'kode_akses' => 'nullable|string|min:3|max:255',
         'batch' => 'required|string|max:255|min:1',
         'status' => 'required|in:aktif,tidak_aktif|string'
      ]);

      if ($validator->fails()) {
         return response()->json([
            'success' => false,
            'message' => 'Validasi gagal',
            'errors' => $validator->errors()
         ], 400);
      }

      try {
         $participant = Peserta::findOrFail($id);

         // Create or find batch
         $batch = Batch::firstOrCreate(
            ['nama_batch' => $request->batch],
            [
               'keterangan' => 'Batch untuk ' . $request->batch,
               'created_at' => now()
            ]
         );

         $updateData = [
            'nama_peserta' => $request->nama,
            'kode_peserta' => $request->kode_peserta,
            'asal_smk' => $request->asal_smk ?: 'SMK Default',
            'jurusan' => $request->jurusan ?: $request->batch, // Use jurusan field if provided
            'batch' => $request->batch,
            'status' => $request->status,
            'email' => $request->email, // Will be null if not provided
         ];

         // Only update password if provided
         if ($request->filled('kode_akses')) {
            $updateData['kode_akses'] = $request->kode_akses; // Store as plain text
         }

         $participant->update($updateData);

         return response()->json([
            'success' => true,
            'message' => 'Peserta berhasil diperbarui',
            'data' => $participant
         ]);
      } catch (\Exception $e) {
         return response()->json([
            'success' => false,
            'message' => 'Gagal memperbarui peserta: ' . $e->getMessage()
         ], 500);
      }
   }

   /**
    * Remove the specified participant
    */
   public function destroy($id)
   {
      try {
         $participant = Peserta::findOrFail($id);
         $participant->delete();

         return response()->json([
            'success' => true,
            'message' => 'Peserta berhasil dihapus'
         ]);
      } catch (\Exception $e) {
         return response()->json([
            'success' => false,
            'message' => 'Gagal menghapus peserta: ' . $e->getMessage()
         ], 500);
      }
   }
}
