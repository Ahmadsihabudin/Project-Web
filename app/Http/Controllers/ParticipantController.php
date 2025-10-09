<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ParticipantController extends Controller
{
   /**
    * Display a listing of participants with statistics
    */
   public function index()
   {
      try {
         $participants = Peserta::select('id_peserta', 'nama_peserta', 'kode_peserta', 'asal_smk', 'jurusan', 'created_at')
            ->orderBy('created_at', 'desc')
            ->get();

         // Transform data to match frontend expectations
         $transformedParticipants = $participants->map(function ($participant) {
            return [
               'id' => $participant->id_peserta,
               'nama' => $participant->nama_peserta,
               'email' => $participant->kode_peserta . '@peserta.com', // Generate email from kode_peserta
               'kode_peserta' => $participant->kode_peserta,
               'kode_akses' => '****', // Masked password for security
               'ujian' => $participant->jurusan ?? 'Belum ditentukan',
               'status' => 'aktif', // Default status since it's not in the current schema
               'nilai' => null, // Will be calculated from jawaban table if needed
               'avatar' => strtoupper(substr($participant->nama_peserta, 0, 1)),
               'asal_smk' => $participant->asal_smk,
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
         'nama' => 'required|string|max:255',
         'email' => 'required|email',
         'kode_peserta' => 'required|string|max:50',
         'kode_akses' => 'required|string|min:6',
         'ujian' => 'required|string',
         'status' => 'required|in:aktif,tidak_aktif,berlangsung,selesai'
      ]);

      if ($validator->fails()) {
         return response()->json([
            'success' => false,
            'message' => 'Validasi gagal',
            'errors' => $validator->errors()
         ], 400);
      }

      try {
         $participant = Peserta::create([
            'nama_peserta' => $request->nama,
            'kode_peserta' => $request->kode_peserta,
            'password_hash' => Hash::make($request->kode_akses),
            'asal_smk' => $request->asal_smk ?? 'SMK Default',
            'jurusan' => $request->ujian,
            'status' => $request->status,
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
         'nama' => 'required|string|max:255',
         'email' => 'required|email',
         'kode_peserta' => 'required|string|max:50',
         'kode_akses' => 'nullable|string|min:6',
         'ujian' => 'required|string',
         'status' => 'required|in:aktif,tidak_aktif,berlangsung,selesai'
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

         $updateData = [
            'nama_peserta' => $request->nama,
            'kode_peserta' => $request->kode_peserta,
            'jurusan' => $request->ujian,
            'status' => $request->status,
         ];

         // Only update password if provided
         if ($request->filled('kode_akses')) {
            $updateData['password_hash'] = Hash::make($request->kode_akses);
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
