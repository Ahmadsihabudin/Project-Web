<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Soal;
use App\Http\Controllers\SesiUjianController;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class QuestionImportController extends Controller
{
    /**
     * Download template Excel untuk import soal
     */
    public function downloadTemplate()
    {
        try {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $headers = [
                'A1' => 'Batch',
                'B1' => 'Poin *',
                'C1' => 'Durasi Soal (Menit) *',
                'D1' => 'Pertanyaan *',
                'E1' => 'Mata Pelajaran *',
                'F1' => 'Umpan Balik',
                'G1' => 'Tipe Soal *',
                'H1' => 'Opsi A',
                'I1' => 'Opsi B',
                'J1' => 'Opsi C',
                'K1' => 'Opsi D',
                'L1' => 'Opsi E',
                'M1' => 'Opsi F',
                'N1' => 'Jawaban Benar *'
            ];

            foreach ($headers as $cell => $value) {
                $sheet->setCellValue($cell, $value);
            }
            $sampleData = [
                ['Batch 1', 10, 5, 'Apa ibukota Indonesia?', 'Geografi', 'Ibukota Indonesia adalah Jakarta', 'pilihan_ganda', 'Jakarta', 'Bandung', 'Surabaya', 'Medan', 'Semarang', 'Yogyakarta', 'a'],
                ['Batch 1', 10, 3, '2 + 2 = ?', 'Matematika', 'Hasil penjumlahan 2 + 2 adalah 4', 'pilihan_ganda', '3', '4', '5', '6', '', '', 'b'],
                ['Batch 1', 5, 2, 'Siapa presiden Indonesia?', 'Pendidikan Kewarganegaraan', 'Presiden Indonesia saat ini adalah Joko Widodo', 'pilihan_ganda', 'Joko Widodo', 'Prabowo Subianto', 'Megawati', 'Susilo Bambang Yudhoyono', '', '', 'a']
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
            $sheet->getColumnDimension('A')->setWidth(15);
            $sheet->getColumnDimension('B')->setWidth(10);
            $sheet->getColumnDimension('C')->setWidth(20);
            $sheet->getColumnDimension('D')->setWidth(50);
            $sheet->getColumnDimension('E')->setWidth(20);
            $sheet->getColumnDimension('F')->setWidth(40);
            $sheet->getColumnDimension('G')->setWidth(15);
            $sheet->getColumnDimension('H')->setWidth(30);
            $sheet->getColumnDimension('I')->setWidth(30);
            $sheet->getColumnDimension('J')->setWidth(30);
            $sheet->getColumnDimension('K')->setWidth(30);
            $sheet->getColumnDimension('L')->setWidth(30);
            $sheet->getColumnDimension('M')->setWidth(30);
            $sheet->getColumnDimension('N')->setWidth(15);
            $headerStyle = [
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'E3F2FD']
                ]
            ];
            $sheet->getStyle('A1:N1')->applyFromArray($headerStyle);
            $sheet->setCellValue('A' . ($row + 1), 'CATATAN:');
            $sheet->setCellValue('A' . ($row + 2), '- Field yang ditandai dengan * adalah WAJIB diisi: Poin *, Durasi Soal (Menit) *, Pertanyaan *, Mata Pelajaran *, Tipe Soal *, Jawaban Benar *');
            $sheet->setCellValue('A' . ($row + 3), '- Pertanyaan tidak boleh sama (duplikasi)');
            $sheet->setCellValue('A' . ($row + 4), '- Sistem akan mengecek duplikasi dalam file dan database');
            $sheet->setCellValue('A' . ($row + 5), '- Contoh duplikasi: "Siapa presiden Indonesia?" muncul 2 kali');

            $writer = new Xlsx($spreadsheet);

            $filename = 'Template_Import_Soal_' . date('Y-m-d_H-i-s') . '.xlsx';

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
     * Import soal dari Excel
     */
    public function import(Request $request)
    {
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

            $spreadsheet = IOFactory::load($file->getPathname());
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
            $processedQuestions = [];
            // Track batch dan mata pelajaran yang terpengaruh untuk update durasi sesi ujian
            $affectedBatchMataPelajaran = [];

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
                        'batch' => $row[0] ?? '',
                        'poin' => $row[1] ?? '',
                        'durasi_soal' => $row[2] ?? '',
                        'pertanyaan' => $row[3] ?? '',
                        'mata_pelajaran' => $row[4] ?? '',
                        'umpan_balik' => $row[5] ?? '',
                        'tipe_soal' => $row[6] ?? '',
                        'opsi_a' => $row[7] ?? '',
                        'opsi_b' => $row[8] ?? '',
                        'opsi_c' => $row[9] ?? '',
                        'opsi_d' => $row[10] ?? '',
                        'opsi_e' => $row[11] ?? '',
                        'opsi_f' => $row[12] ?? '',
                        'jawaban_benar' => $row[13] ?? ''
                    ];
                    $hasMinimalData = !empty(trim($rowData['pertanyaan'])) ||
                        !empty(trim($rowData['mata_pelajaran'])) ||
                        !empty(trim($rowData['tipe_soal']));

                    if (!$hasMinimalData) {
                        continue;
                    }

                    if (empty(trim($rowData['pertanyaan']))) {
                        $errors[] = [
                            'row' => $rowNumber,
                            'data' => $rowData,
                            'errors' => ['Pertanyaan harus diisi']
                        ];
                        continue;
                    }

                    if (empty(trim($rowData['mata_pelajaran']))) {
                        $errors[] = [
                            'row' => $rowNumber,
                            'data' => $rowData,
                            'errors' => ['Mata Pelajaran harus diisi']
                        ];
                        continue;
                    }

                    if (empty(trim($rowData['tipe_soal']))) {
                        $errors[] = [
                            'row' => $rowNumber,
                            'data' => $rowData,
                            'errors' => ['Tipe Soal harus diisi']
                        ];
                        continue;
                    }

                    if (!in_array($rowData['tipe_soal'], ['pilihan_ganda', 'benar_salah'])) {
                        $errors[] = [
                            'row' => $rowNumber,
                            'data' => $rowData,
                            'errors' => ['Tipe Soal harus: pilihan_ganda atau benar_salah']
                        ];
                        continue;
                    }

                    if (empty(trim($rowData['poin'])) || !is_numeric(trim($rowData['poin'])) || trim($rowData['poin']) < 1) {
                        $errors[] = [
                            'row' => $rowNumber,
                            'data' => $rowData,
                            'errors' => ['Poin harus diisi dan minimal 1']
                        ];
                        continue;
                    }

                    if (empty(trim($rowData['durasi_soal'])) || !is_numeric(trim($rowData['durasi_soal'])) || trim($rowData['durasi_soal']) < 1) {
                        $errors[] = [
                            'row' => $rowNumber,
                            'data' => $rowData,
                            'errors' => ['Durasi Soal (Menit) harus diisi dan minimal 1']
                        ];
                        continue;
                    }

                    if (empty(trim($rowData['jawaban_benar']))) {
                        $errors[] = [
                            'row' => $rowNumber,
                            'data' => $rowData,
                            'errors' => ['Jawaban Benar harus diisi']
                        ];
                        continue;
                    }
                    $pertanyaanKey = strtolower(trim($rowData['pertanyaan']));
                    if (in_array($pertanyaanKey, $processedQuestions)) {
                        $errors[] = [
                            'row' => $rowNumber,
                            'data' => $rowData,
                            'errors' => ['Pertanyaan sudah ada dalam file yang sama (duplikasi)']
                        ];
                        continue;
                    }
                    $existingQuestion = Soal::whereRaw('LOWER(TRIM(pertanyaan)) = ?', [$pertanyaanKey])->first();
                    if ($existingQuestion) {
                        $errors[] = [
                            'row' => $rowNumber,
                            'data' => $rowData,
                            'errors' => ['Pertanyaan sudah ada di database']
                        ];
                        continue;
                    }
                    if ($rowData['tipe_soal'] === 'pilihan_ganda') {
                        if (
                            empty($rowData['opsi_a']) || empty($rowData['opsi_b']) ||
                            empty($rowData['opsi_c']) || empty($rowData['opsi_d'])
                        ) {
                            $errors[] = [
                                'row' => $rowNumber,
                                'data' => $rowData,
                                'errors' => ['Untuk pilihan ganda, Opsi A, B, C, D harus diisi']
                            ];
                            continue;
                        }

                        if (!in_array($rowData['jawaban_benar'], ['a', 'b', 'c', 'd', 'e', 'f'])) {
                            $errors[] = [
                                'row' => $rowNumber,
                                'data' => $rowData,
                                'errors' => ['Jawaban Benar untuk pilihan ganda harus: a, b, c, d, e, atau f']
                            ];
                            continue;
                        }
                    }
                    $soalData = [
                        'batch' => $rowData['batch'] ?: null,
                        'pertanyaan' => $rowData['pertanyaan'],
                        'mata_pelajaran' => $rowData['mata_pelajaran'],
                        'tipe_soal' => $rowData['tipe_soal'],
                        'poin' => (int)$rowData['poin'],
                        'durasi_soal' => (int)$rowData['durasi_soal'],
                        'jawaban_benar' => $rowData['jawaban_benar'],
                        'umpan_balik' => $rowData['umpan_balik'] ?: null,
                        'opsi_a' => $rowData['opsi_a'] ?: '',
                        'opsi_b' => $rowData['opsi_b'] ?: '',
                        'opsi_c' => $rowData['opsi_c'] ?: '',
                        'opsi_d' => $rowData['opsi_d'] ?: '',
                        'opsi_e' => $rowData['opsi_e'] ?: '',
                        'opsi_f' => $rowData['opsi_f'] ?: ''
                    ];

                    Soal::create($soalData);
                    $successCount++;
                    $processedQuestions[] = $pertanyaanKey;
                    
                    // Track batch dan mata pelajaran untuk update durasi sesi ujian
                    $batchKey = $rowData['batch'] ? trim($rowData['batch']) : '';
                    $mataPelajaranKey = trim($rowData['mata_pelajaran']);
                    if ($batchKey && $mataPelajaranKey) {
                        $key = strtolower($batchKey) . '|' . strtolower($mataPelajaranKey);
                        if (!isset($affectedBatchMataPelajaran[$key])) {
                            $affectedBatchMataPelajaran[$key] = [
                                'batch' => $batchKey,
                                'mata_pelajaran' => $mataPelajaranKey
                            ];
                        }
                    }
                } catch (\Exception $e) {
                    $errors[] = [
                        'row' => $rowNumber,
                        'data' => $rowData ?? [],
                        'errors' => ['Terjadi kesalahan: ' . $e->getMessage()]
                    ];
                }
            }

            if (!empty($errors)) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'Import gagal. Terdapat ' . count($errors) . ' baris dengan kesalahan.',
                    'errors' => $errors
                ], 422);
            }

            DB::commit();

            // Update durasi sesi ujian untuk semua batch dan mata pelajaran yang terpengaruh
            foreach ($affectedBatchMataPelajaran as $item) {
                SesiUjianController::updateDurasiSesiUjian($item['batch'], $item['mata_pelajaran']);
            }
            
            // Update semua durasi untuk memastikan konsistensi
            SesiUjianController::updateAllDurasiSesiUjian();

            return response()->json([
                'success' => true,
                'message' => "Import berhasil! {$successCount} soal berhasil diimpor.",
                'data' => [
                    'success_count' => $successCount,
                    'total_rows' => count($dataRows)
                ]
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
