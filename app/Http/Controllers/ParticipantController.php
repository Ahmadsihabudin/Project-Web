<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Batch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

/**
 * ParticipantController
 * 
 * Controller untuk mengelola data peserta ujian termasuk CRUD operations,
 * import/export Excel, dan statistik peserta.
 * 
 * @package App\Http\Controllers
 * @author System Administrator
 * @version 1.0.0
 * @since 2025-10-29
 */
class ParticipantController extends Controller
{
   /**
    * Get all batches for dropdown selection
    * 
    * @return \Illuminate\Http\JsonResponse
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
         $participants = Peserta::select('id_peserta', 'nama_peserta', 'email', 'kode_peserta', 'asal_smk', 'jurusan', 'batch', 'status')
            ->orderBy('id_peserta', 'desc')
            ->get();
         $transformedParticipants = $participants->map(function ($participant) {
            return [
               'id' => $participant->id_peserta,
               'nama' => $participant->nama_peserta,
               'email' => $participant->email,
               'kode_peserta' => $participant->kode_peserta,
               'kode_akses' => '****',
               'batch' => $participant->batch ?? 'Belum ditentukan',
               'status' => $participant->status ?? 'aktif',
               'nilai' => null,
               'avatar' => strtoupper(substr($participant->nama_peserta, 0, 1)),
               'asal_smk' => $participant->asal_smk,
               'jurusan' => $participant->jurusan,
               'created_at' => 'N/A'
            ];
         });
         $stats = [
            'total' => $transformedParticipants->count(),
            'aktif' => $transformedParticipants->where('status', 'aktif')->count(),
            'berlangsung' => 0,
            'selesai' => 0,
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
    * Get participant statistics
    */
   public function stats()
   {
      try {
         $stats = [
            'total' => Peserta::count(),
            'schools' => Peserta::distinct('asal_smk')->count('asal_smk'),
            'majors' => Peserta::distinct('jurusan')->count('jurusan'),
            'batches' => Peserta::distinct('batch')->count('batch'),
            'active' => Peserta::where('status', 'aktif')->count(),
            'inactive' => Peserta::where('status', 'tidak_aktif')->count()
         ];

         return response()->json([
            'success' => true,
            'data' => $stats
         ]);
      } catch (\Exception $e) {
         return response()->json([
            'success' => false,
            'message' => 'Gagal memuat statistik peserta: ' . $e->getMessage()
         ], 500);
      }
   }

   /**
    * Store a newly created participant
    */
   public function store(Request $request)
   {
      $key = 'participant_creation_' . $request->ip();
      if (\Cache::has($key)) {
         return response()->json([
            'success' => false,
            'message' => 'Terlalu banyak permintaan. Silakan coba lagi dalam beberapa menit.'
         ], 429);
      }
      \Cache::put($key, true, 60);
      \Log::info('Participant creation request:', [
         'ip' => $request->ip(),
         'user_agent' => $request->userAgent(),
         'timestamp' => now()
      ]);

      $validator = Validator::make($request->all(), [
         'nama' => 'required|string|max:255|min:2',
         'email' => 'required|email|max:255|unique:peserta,email',
         'kode_akses' => 'required|string|min:3|max:255',
         'kode_peserta' => 'required|string|min:3|max:255|unique:peserta,kode_peserta',
         'batch' => 'required|string|max:255|min:1',
         'asal_smk' => 'required|string|max:255',
         'jurusan' => 'nullable|string|max:255'
      ], [
         'nama.required' => 'Nama lengkap harus diisi',
         'nama.min' => 'Nama minimal 2 karakter',
         'kode_peserta.required' => 'Kode peserta harus diisi',
         'kode_peserta.min' => 'Kode peserta minimal 3 karakter',
         'kode_peserta.unique' => 'Kode peserta sudah digunakan',
         'kode_akses.required' => 'Kode akses harus diisi',
         'kode_akses.min' => 'Kode akses minimal 3 karakter',
         'batch.required' => 'Batch harus diisi',
         'asal_smk.required' => 'Asal SMK harus diisi',
         'email.required' => 'Email harus diisi',
         'email.unique' => 'Email sudah digunakan oleh peserta lain',
         'email.email' => 'Format email tidak valid'
      ]);

      if ($validator->fails()) {
         \Log::error('Participant validation failed:', [
            'errors' => $validator->errors(),
            'request_data' => $request->all()
         ]);

         return response()->json([
            'success' => false,
            'message' => 'Validasi gagal',
            'errors' => $validator->errors(),
            'debug' => $request->all()
         ], 400);
      }

      try {
         $kodePeserta = $request->kode_peserta;
         $nextNomor = (Peserta::max('nomor_urut') ?? 0) + 1;
         $batch = Batch::firstOrCreate(
            ['nama_batch' => $request->batch],
            [
               'keterangan' => 'Batch untuk ' . $request->batch
            ]
         );

         $participant = Peserta::create([
            'nomor_urut' => $nextNomor,
            'nama_peserta' => $request->nama,
            'kode_peserta' => $kodePeserta,
            'kode_akses' => $request->kode_akses,
            'asal_smk' => $request->asal_smk,
            'jurusan' => $request->jurusan ?: $request->batch,
            'batch' => $request->batch,
            'status' => 'aktif',
            'email' => $request->email
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
         'nama' => 'required|string|max:255|min:2',
         'email' => 'required|email|max:255|unique:peserta,email,' . $id . ',id_peserta',
         'asal_smk' => 'required|string|max:255',
         'jurusan' => 'nullable|string|max:255',
         'kode_peserta' => 'required|string|max:255|min:3|unique:peserta,kode_peserta,' . $id . ',id_peserta',
         'kode_akses' => 'nullable|string|min:3|max:255',
         'batch' => 'required|string|max:255|min:1',
         'status' => 'required|in:aktif,tidak_aktif,berlangsung,selesai|string'
      ], [
         'nama.required' => 'Nama lengkap harus diisi',
         'nama.min' => 'Nama minimal 2 karakter',
         'kode_peserta.required' => 'Kode peserta harus diisi',
         'kode_peserta.min' => 'Kode peserta minimal 3 karakter',
         'kode_peserta.unique' => 'Kode peserta sudah digunakan',
         'kode_akses.min' => 'Kode akses minimal 3 karakter',
         'batch.required' => 'Batch harus diisi',
         'asal_smk.required' => 'Asal SMK harus diisi',
         'email.required' => 'Email harus diisi',
         'email.unique' => 'Email sudah digunakan oleh peserta lain',
         'email.email' => 'Format email tidak valid',
         'status.required' => 'Status harus diisi',
         'status.in' => 'Status harus salah satu dari: aktif, tidak_aktif, berlangsung, selesai'
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
         $batch = Batch::firstOrCreate(
            ['nama_batch' => $request->batch],
            [
               'keterangan' => 'Batch untuk ' . $request->batch
            ]
         );

         $updateData = [
            'nama_peserta' => $request->nama,
            'kode_peserta' => $request->kode_peserta,
            'asal_smk' => $request->asal_smk ?: 'SMK Default',
            'jurusan' => $request->jurusan ?: $request->batch,
            'batch' => $request->batch,
            'status' => $request->status,
            'email' => $request->email
         ];
         if ($request->filled('kode_akses')) {
            $updateData['kode_akses'] = $request->kode_akses;
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

   /**
    * Download template Excel untuk import peserta
    */
   public function downloadTemplate()
   {
      try {
         $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
         $sheet = $spreadsheet->getActiveSheet();
         $headers = [
            'A1' => 'Nama',
            'B1' => 'Email',
            'C1' => 'Kode Peserta',
            'D1' => 'Kode Akses',
            'E1' => 'Batch',
            'F1' => 'Asal SMK',
            'G1' => 'Jurusan'
         ];

         foreach ($headers as $cell => $value) {
            $sheet->setCellValue($cell, $value);
         }
         $timestamp = date('YmdHis');
         $sampleData = [
            ['Ahmad Rizki Pratama', 'ahmad.rizki@smkn1.sch.id', 'RK' . $timestamp . '001', 'password123', 'Batch 1', 'SMK Negeri 1 Jakarta', 'Teknik Komputer dan Jaringan'],
            ['Siti Nurhaliza', 'siti.nurhaliza@smkn2.sch.id', 'RK' . $timestamp . '002', 'password123', 'Batch 1', 'SMK Negeri 2 Bandung', 'Rekayasa Perangkat Lunak'],
            ['Budi Santoso', 'budi.santoso@smkn3.sch.id', 'RK' . $timestamp . '003', 'password123', 'Batch 2', 'SMK Negeri 3 Surabaya', 'Teknik Informatika'],
            ['Dewi Kartika Sari', 'dewi.kartika@smkn4.sch.id', 'RK' . $timestamp . '004', 'password123', 'Batch 2', 'SMK Negeri 4 Yogyakarta', 'Multimedia'],
            ['Eko Prasetyo', 'eko.prasetyo@smkn5.sch.id', 'RK' . $timestamp . '005', 'password123', 'Batch 3', 'SMK Negeri 5 Semarang', 'Teknik Elektronika']
         ];

         $row = 2;
         foreach ($sampleData as $data) {
            $col = 'A';
            foreach ($data as $value) {
               $sheet->setCellValue($col . $row, $value);
               $col++;
            }
            $row++;
         }
         $sheet->getColumnDimension('A')->setWidth(25);
         $sheet->getColumnDimension('B')->setWidth(30);
         $sheet->getColumnDimension('C')->setWidth(15);
         $sheet->getColumnDimension('D')->setWidth(15);
         $sheet->getColumnDimension('E')->setWidth(12);
         $sheet->getColumnDimension('F')->setWidth(25);
         $sheet->getColumnDimension('G')->setWidth(30);
         $headerStyle = [
            'font' => [
               'bold' => true,
               'color' => ['rgb' => 'FFFFFF']
            ],
            'fill' => [
               'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
               'startColor' => ['rgb' => '2E7D32']
            ],
            'borders' => [
               'allBorders' => [
                  'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                  'color' => ['rgb' => '000000']
               ]
            ],
            'alignment' => [
               'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
               'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ]
         ];
         $sheet->getStyle('A1:G1')->applyFromArray($headerStyle);
         $dataStyle = [
            'borders' => [
               'allBorders' => [
                  'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                  'color' => ['rgb' => 'CCCCCC']
               ]
            ],
            'alignment' => [
               'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ]
         ];
         $sheet->getStyle('A2:G' . ($row - 1))->applyFromArray($dataStyle);
         $instructionRow = $row + 1;
         $sheet->setCellValue('A' . $instructionRow, 'PANDUAN PENGGUNAAN:');
         $sheet->getStyle('A' . $instructionRow)->getFont()->setBold(true);

         $instructions = [
            '1. Isi data peserta sesuai format di atas',
            '2. Nama: Nama lengkap peserta',
            '3. Email: Email valid peserta (opsional)',
            '4. Kode Peserta: Kode unik peserta (minimal 6 karakter)',
            '5. Kode Akses: Password untuk login peserta',
            '6. Batch: Nama batch peserta',
            '7. Asal SMK: Nama sekolah asal peserta',
            '8. Jurusan: Jurusan peserta di SMK'
         ];

         $instructionStartRow = $instructionRow + 1;
         foreach ($instructions as $index => $instruction) {
            $sheet->setCellValue('A' . ($instructionStartRow + $index), $instruction);
         }
         foreach (range(1, $instructionStartRow + count($instructions)) as $rowIndex) {
            $sheet->getRowDimension($rowIndex)->setRowHeight(-1);
         }

         $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

         $filename = 'Template_Import_Peserta_' . date('Y-m-d_H-i-s') . '.xlsx';

         header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
         header('Content-Disposition: attachment; filename="' . $filename . '"');
         header('Cache-Control: max-age=0');

         $writer->save('php://output');
         exit;
      } catch (\Exception $e) {
         return response()->json([
            'success' => false,
            'message' => 'Gagal membuat template: ' . $e->getMessage()
         ], 500);
      }
   }

   /**
    * Clear test data untuk testing import
    */
   public function clearTestData()
   {
      try {
         $deletedCount = Peserta::whereIn('kode_peserta', ['RK001', 'RK002', 'RK003', 'RK004', 'RK005'])->delete();

         return response()->json([
            'success' => true,
            'message' => "Berhasil menghapus {$deletedCount} data test",
            'deleted_count' => $deletedCount
         ]);
      } catch (\Exception $e) {
         return response()->json([
            'success' => false,
            'message' => 'Gagal menghapus data test: ' . $e->getMessage()
         ], 500);
      }
   }

   /**
    * Import peserta dari Excel
    */
   public function import(Request $request)
   {
      $key = 'participant_import_' . $request->ip();
      if (\Cache::has($key)) {
         return response()->json([
            'success' => false,
            'message' => 'Terlalu banyak permintaan import. Silakan coba lagi dalam beberapa menit.'
         ], 429);
      }
      \Cache::put($key, true, 300);
      \Log::info('Participant import request:', [
         'ip' => $request->ip(),
         'user_agent' => $request->userAgent(),
         'file_size' => $request->file('file') ? $request->file('file')->getSize() : 0,
         'timestamp' => now()
      ]);

      try {
         $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:xlsx,xls,csv|max:10240'
         ]);

         if ($validator->fails()) {
            return response()->json([
               'success' => false,
               'message' => 'File tidak valid. Pastikan file berformat Excel (.xlsx, .xls) atau CSV (.csv) dan ukuran maksimal 10MB.',
               'errors' => $validator->errors()
            ], 422);
         }

         $file = $request->file('file');
         $allowedMimes = [
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/vnd.ms-excel',
            'text/csv',
            'application/csv'
         ];

         if (!in_array($file->getMimeType(), $allowedMimes)) {
            return response()->json([
               'success' => false,
               'message' => 'File tidak valid. Pastikan file berformat Excel (.xlsx, .xls) atau CSV (.csv) dan ukuran maksimal 10MB.'
            ], 422);
         }

         $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file->getPathname());
         $worksheet = $spreadsheet->getActiveSheet();
         $rows = $worksheet->toArray();

         if (count($rows) < 2) {
            return response()->json([
               'success' => false,
               'message' => 'File kosong atau tidak memiliki data.'
            ], 422);
         }
         $dataRows = array_slice($rows, 1);
         $errors = [];
         $successCount = 0;
         $skipErrors = $request->input('skip_errors', false);

         DB::beginTransaction();

         foreach ($dataRows as $index => $row) {
            $rowNumber = $index + 2; 
            $isEmptyRow = true;
            for ($i = 0; $i < count($row); $i++) {
               if (!empty(trim($row[$i] ?? ''))) {
                  $isEmptyRow = false;
                  break;
               }
            }

            if ($isEmptyRow) {
               continue;
            }

            try {
               $rowData = [
                  'nama' => $row[0] ?? '',
                  'email' => $row[1] ?? '',
                  'kode_peserta' => $row[2] ?? '',
                  'kode_akses' => $row[3] ?? '',
                  'batch' => $row[4] ?? '',
                  'asal_smk' => $row[5] ?? '',
                  'jurusan' => $row[6] ?? ''
               ];
               \Log::info('Processing row ' . $rowNumber . ':', [
                  'raw_row' => $row,
                  'processed_data' => $rowData
               ]);
               if (empty(trim($rowData['nama']))) {
                  \Log::warning('Row ' . $rowNumber . ' failed validation: Nama kosong');
                  $errors[] = [
                     'row' => $rowNumber,
                     'data' => $rowData,
                     'errors' => ['Nama harus diisi']
                  ];
                  if (!$skipErrors) continue;
               }

               if (empty(trim($rowData['kode_peserta']))) {
                  \Log::warning('Row ' . $rowNumber . ' failed validation: Kode Peserta kosong');
                  $errors[] = [
                     'row' => $rowNumber,
                     'data' => $rowData,
                     'errors' => ['Kode Peserta harus diisi']
                  ];
                  if (!$skipErrors) continue;
               }

               if (empty(trim($rowData['kode_akses']))) {
                  \Log::warning('Row ' . $rowNumber . ' failed validation: Kode Akses kosong');
                  $errors[] = [
                     'row' => $rowNumber,
                     'data' => $rowData,
                     'errors' => ['Kode Akses harus diisi']
                  ];
                  if (!$skipErrors) continue;
               }

               if (empty(trim($rowData['batch']))) {
                  \Log::warning('Row ' . $rowNumber . ' failed validation: Batch kosong');
                  $errors[] = [
                     'row' => $rowNumber,
                     'data' => $rowData,
                     'errors' => ['Batch harus diisi']
                  ];
                  if (!$skipErrors) continue;
               }
               $existingParticipant = Peserta::where('kode_peserta', $rowData['kode_peserta'])->first();
               if ($existingParticipant) {
                  \Log::warning('Row ' . $rowNumber . ' failed validation: Kode Peserta duplikasi - ' . $rowData['kode_peserta']);
                  $errors[] = [
                     'row' => $rowNumber,
                     'data' => $rowData,
                     'errors' => ['Kode Peserta sudah ada di database']
                  ];
                  if (!$skipErrors) continue;
               }
               if (!empty($rowData['email']) && !filter_var($rowData['email'], FILTER_VALIDATE_EMAIL)) {
                  \Log::warning('Row ' . $rowNumber . ' failed validation: Format email tidak valid - ' . $rowData['email']);
                  $errors[] = [
                     'row' => $rowNumber,
                     'data' => $rowData,
                     'errors' => ['Format email tidak valid']
                  ];
                  if (!$skipErrors) continue;
               }
               $batch = Batch::firstOrCreate(
                  ['nama_batch' => $rowData['batch']],
                  ['keterangan' => 'Batch untuk ' . $rowData['batch']]
               );
               $nextNomor = (Peserta::max('nomor_urut') ?? 0) + 1;
               $participantData = [
                  'nomor_urut' => $nextNomor,
                  'nama_peserta' => $rowData['nama'],
                  'kode_peserta' => $rowData['kode_peserta'],
                  'kode_akses' => $rowData['kode_akses'],
                  'asal_smk' => $rowData['asal_smk'] ?: 'SMK Default',
                  'jurusan' => $rowData['jurusan'] ?: $rowData['batch'],
                  'batch' => $rowData['batch'],
                  'status' => 'aktif',
                  'email' => $rowData['email'] ?: null
               ];

               Peserta::create($participantData);
               $successCount++;
               \Log::info('Row ' . $rowNumber . ' imported successfully: ' . $rowData['nama']);
            } catch (\Exception $e) {
               \Log::error('Row ' . $rowNumber . ' failed with exception: ' . $e->getMessage());
               $errors[] = [
                  'row' => $rowNumber,
                  'data' => $rowData ?? [],
                  'errors' => ['Terjadi kesalahan: ' . $e->getMessage()]
               ];
               if (!$skipErrors) continue;
            }
         }

         \Log::info('Import completed:', [
            'total_rows' => count($dataRows),
            'success_count' => $successCount,
            'error_count' => count($errors),
            'skip_errors' => $skipErrors
         ]);

         if (!empty($errors) && !$skipErrors) {
            DB::rollBack();
            \Log::warning('Import failed due to errors:', ['errors' => $errors]);
            return response()->json([
               'success' => false,
               'message' => 'Import gagal. Terdapat ' . count($errors) . ' baris dengan kesalahan.',
               'errors' => $errors
            ], 422);
         }

         DB::commit();

         \Log::info('Import successful:', [
            'imported' => $successCount,
            'errors' => $errors
         ]);

         return response()->json([
            'success' => true,
            'message' => "Import berhasil! {$successCount} peserta berhasil diimpor.",
            'imported' => $successCount,
            'errors' => $errors
         ]);
      } catch (\Exception $e) {
         DB::rollBack();
         return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
         ], 500);
      }
   }
}
