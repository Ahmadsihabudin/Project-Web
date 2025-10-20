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

         // Here you would implement the actual report generation logic
         // For now, we'll just return a success response
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
         $reports = Laporan::all();

         $transformedReports = $reports->map(function ($report) {
            return [
               'id' => $report->id_laporan,
               'judul_laporan' => 'Laporan ' . $report->id_laporan,
               'deskripsi' => 'Laporan hasil ujian',
               'tipe_laporan' => 'hasil_ujian',
               'periode_mulai' => $report->created_at->format('Y-m-d'),
               'periode_selesai' => $report->created_at->format('Y-m-d'),
               'format_laporan' => 'pdf',
               'level_detail' => 'lengkap',
               'include_chart' => true,
               'include_statistik' => true,
               'status' => 'aktif',
               'filter_batch' => null,
               'filter_sesi' => null,
               'filter_peserta' => $report->id_peserta,
               'created_at' => $report->created_at,
               'updated_at' => $report->updated_at
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
         $activeReports = $totalReports; // All reports are considered active
         $draftReports = 0;
         $archivedReports = 0;

         // Count by status_submit
         $byType = Laporan::select('status_submit', DB::raw('count(*) as total'))
            ->groupBy('status_submit')
            ->get();

         return response()->json([
            'success' => true,
            'data' => [
               'total' => $totalReports,
               'active' => $activeReports,
               'draft' => $draftReports,
               'archived' => $archivedReports,
               'by_type' => $byType
            ]
         ]);
      } catch (\Exception $e) {
         return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
         ], 500);
      }
   }
}
