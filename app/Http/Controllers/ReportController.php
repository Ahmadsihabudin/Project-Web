<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
   /**
    * Display a listing of the resource.
    */
   public function index()
   {
      return view('admin.reports.index');
   }

   /**
    * Show the form for creating a new resource.
    */
   public function create()
   {
      return view('admin.reports.create');
   }

   /**
    * Store a newly created resource in storage.
    */
   public function store(Request $request)
   {
      try {
         $validator = Validator::make($request->all(), [
            'judul_laporan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tipe_laporan' => 'required|in:hasil_ujian,statistik_peserta,analisis_soal,laporan_kehadiran,laporan_umum',
            'periode_mulai' => 'nullable|date',
            'periode_selesai' => 'nullable|date|after_or_equal:periode_mulai',
            'format_laporan' => 'required|in:pdf,excel,csv,html',
            'level_detail' => 'required|in:ringkas,lengkap,detail',
            'include_chart' => 'boolean',
            'include_statistik' => 'boolean',
            'status' => 'required|in:draft,aktif,arsip',
            'filter_batch' => 'nullable|string',
            'filter_sesi' => 'nullable|string',
            'filter_peserta' => 'nullable|string'
         ]);

         if ($validator->fails()) {
            return response()->json([
               'success' => false,
               'message' => 'Validasi gagal',
               'errors' => $validator->errors()
            ], 422);
         }

         $report = Laporan::create($request->all());

         return response()->json([
            'success' => true,
            'message' => 'Laporan berhasil dibuat',
            'data' => $report
         ]);
      } catch (\Exception $e) {
         return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
         ], 500);
      }
   }

   /**
    * Display the specified resource.
    */
   public function show(string $id)
   {
      try {
         $report = Laporan::findOrFail($id);

         return response()->json([
            'success' => true,
            'data' => $report
         ]);
      } catch (\Exception $e) {
         return response()->json([
            'success' => false,
            'message' => 'Laporan tidak ditemukan'
         ], 404);
      }
   }

   /**
    * Show the form for editing the specified resource.
    */
   public function edit(string $id)
   {
      return view('admin.reports.edit', compact('id'));
   }

   /**
    * Update the specified resource in storage.
    */
   public function update(Request $request, string $id)
   {
      try {
         $report = Laporan::findOrFail($id);

         $validator = Validator::make($request->all(), [
            'judul_laporan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tipe_laporan' => 'required|in:hasil_ujian,statistik_peserta,analisis_soal,laporan_kehadiran,laporan_umum',
            'periode_mulai' => 'nullable|date',
            'periode_selesai' => 'nullable|date|after_or_equal:periode_mulai',
            'format_laporan' => 'required|in:pdf,excel,csv,html',
            'level_detail' => 'required|in:ringkas,lengkap,detail',
            'include_chart' => 'boolean',
            'include_statistik' => 'boolean',
            'status' => 'required|in:draft,aktif,arsip',
            'filter_batch' => 'nullable|string',
            'filter_sesi' => 'nullable|string',
            'filter_peserta' => 'nullable|string'
         ]);

         if ($validator->fails()) {
            return response()->json([
               'success' => false,
               'message' => 'Validasi gagal',
               'errors' => $validator->errors()
            ], 422);
         }

         $report->update($request->all());

         return response()->json([
            'success' => true,
            'message' => 'Laporan berhasil diperbarui',
            'data' => $report
         ]);
      } catch (\Exception $e) {
         return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
         ], 500);
      }
   }

   /**
    * Remove the specified resource from storage.
    */
   public function destroy(string $id)
   {
      try {
         $report = Laporan::findOrFail($id);
         $report->delete();

         return response()->json([
            'success' => true,
            'message' => 'Laporan berhasil dihapus'
         ]);
      } catch (\Exception $e) {
         return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
         ], 500);
      }
   }

   /**
    * Update the status of the specified resource.
    */
   public function updateStatus(Request $request, string $id)
   {
      try {
         $report = Laporan::findOrFail($id);

         $validator = Validator::make($request->all(), [
            'status' => 'required|in:draft,aktif,arsip'
         ]);

         if ($validator->fails()) {
            return response()->json([
               'success' => false,
               'message' => 'Validasi gagal',
               'errors' => $validator->errors()
            ], 422);
         }

         $report->update(['status' => $request->status]);

         return response()->json([
            'success' => true,
            'message' => 'Status laporan berhasil diperbarui',
            'data' => $report
         ]);
      } catch (\Exception $e) {
         return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
         ], 500);
      }
   }

   /**
    * Generate report
    */
   public function generate(Request $request, string $id)
   {
      try {
         $report = Laporan::findOrFail($id);
         $downloadUrl = '/reports/download/' . $id . '.' . $report->format_laporan;

         return response()->json([
            'success' => true,
            'message' => 'Laporan berhasil digenerate',
            'download_url' => $downloadUrl
         ]);
      } catch (\Exception $e) {
         return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
         ], 500);
      }
   }

   /**
    * Get data for DataTables
    */
   public function data()
   {
      try {
         $reports = Laporan::with('peserta')->get();

         $transformedReports = $reports->map(function ($report) {
            return [
               'id_laporan' => $report->id_laporan,
               'id_peserta' => $report->id_peserta,
               'nama_peserta' => $report->peserta ? $report->peserta->nama_peserta : 'Unknown',
               'total_score' => $report->total_score,
               'jumlah_benar' => $report->jumlah_benar,
               'jumlah_salah' => $report->jumlah_salah ?? 0,
               'waktu_pengerjaan' => $report->waktu_pengerjaan,
               'status_submit' => $report->status_submit,
               'created_at' => 'N/A',
               'updated_at' => 'N/A',
            ];
         });

         return response()->json([
            'success' => true,
            'data' => $transformedReports
         ]);
      } catch (\Exception $e) {
         return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
         ], 500);
      }
   }

   /**
    * Get statistics
    */
   public function stats()
   {
      try {
         $totalReports = Laporan::count();
         $completedReports = Laporan::where('status_submit', 'manual')->count();
         $averageScore = Laporan::avg('total_score') ?? 0;
         $averageTime = Laporan::avg('waktu_pengerjaan') ?? 0;
         $uniqueParticipants = Laporan::distinct('id_peserta')->count('id_peserta');

         return response()->json([
            'success' => true,
            'data' => [
               'total' => $totalReports,
               'completed' => $completedReports,
               'average_score' => round($averageScore, 1),
               'average_time' => round($averageTime, 1),
               'participants' => $uniqueParticipants
            ]
         ]);
      } catch (\Exception $e) {
         return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
         ], 500);
      }
   }

   /**
    * Bulk delete reports
    */
   public function bulkDelete(Request $request)
   {
      try {
         $validator = Validator::make($request->all(), [
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:laporan,id_laporan'
         ]);

         if ($validator->fails()) {
            return response()->json([
               'success' => false,
               'message' => 'Validasi gagal',
               'errors' => $validator->errors()
            ], 422);
         }

         $ids = $request->input('ids');
         $deletedCount = Laporan::whereIn('id_laporan', $ids)->delete();

         return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus',
            'deleted_count' => $deletedCount
         ]);
      } catch (\Exception $e) {
         return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
         ], 500);
      }
   }
}
