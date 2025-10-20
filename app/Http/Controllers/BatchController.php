<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BatchController extends Controller
{
   /**
    * Get all batches for dropdowns
    */
   public function getAll()
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
    * Store a newly created batch
    */
   public function store(Request $request)
   {
      $validator = Validator::make($request->all(), [
         'nama_batch' => 'required|string|max:255|unique:batches,nama_batch',
         'deskripsi' => 'nullable|string'
      ]);

      if ($validator->fails()) {
         return response()->json([
            'success' => false,
            'message' => 'Validasi gagal',
            'errors' => $validator->errors()
         ], 400);
      }

      try {
         $batch = Batch::create([
            'nama_batch' => $request->nama_batch,
            'deskripsi' => $request->deskripsi
         ]);

         return response()->json([
            'success' => true,
            'message' => 'Batch berhasil ditambahkan',
            'data' => $batch
         ], 201);
      } catch (\Exception $e) {
         return response()->json([
            'success' => false,
            'message' => 'Gagal menambahkan batch: ' . $e->getMessage()
         ], 500);
      }
   }

   /**
    * Update the specified batch
    */
   public function update(Request $request, $id)
   {
      $validator = Validator::make($request->all(), [
         'nama_batch' => 'required|string|max:255|unique:batches,nama_batch,' . $id . ',id_batch',
         'deskripsi' => 'nullable|string'
      ]);

      if ($validator->fails()) {
         return response()->json([
            'success' => false,
            'message' => 'Validasi gagal',
            'errors' => $validator->errors()
         ], 400);
      }

      try {
         $batch = Batch::findOrFail($id);
         $batch->update([
            'nama_batch' => $request->nama_batch,
            'deskripsi' => $request->deskripsi
         ]);

         return response()->json([
            'success' => true,
            'message' => 'Batch berhasil diperbarui',
            'data' => $batch
         ]);
      } catch (\Exception $e) {
         return response()->json([
            'success' => false,
            'message' => 'Gagal memperbarui batch: ' . $e->getMessage()
         ], 500);
      }
   }

   /**
    * Remove the specified batch
    */
   public function destroy($id)
   {
      try {
         $batch = Batch::findOrFail($id);

         // Check if batch has participants or questions
         if ($batch->soal()->count() > 0 || $batch->ujian()->count() > 0) {
            return response()->json([
               'success' => false,
               'message' => 'Tidak dapat menghapus batch yang memiliki soal atau ujian'
            ], 400);
         }

         $batch->delete();

         return response()->json([
            'success' => true,
            'message' => 'Batch berhasil dihapus'
         ]);
      } catch (\Exception $e) {
         return response()->json([
            'success' => false,
            'message' => 'Gagal menghapus batch: ' . $e->getMessage()
         ], 500);
      }
   }
}
