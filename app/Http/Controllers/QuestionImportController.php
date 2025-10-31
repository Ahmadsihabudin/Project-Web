<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Soal;
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
                'B1' => 'Poin',
                'C1' => 'Pertanyaan',
                'D1' => 'Mata Pelajaran',
                'E1' => 'Umpan Balik',
                'F1' => 'Tipe Soal',
                'G1' => 'Opsi A',
                'H1' => 'Opsi B',
                'I1' => 'Opsi C',
                'J1' => 'Opsi D',
                'K1' => 'Opsi E',
                'L1' => 'Opsi F',
                'M1' => 'Jawaban Benar'
            ];

            foreach ($headers as $cell => $value) {
                $sheet->setCellValue($cell, $value);
            }
            $sampleData = [
                ['Batch 1', 10, 'Apa ibukota Indonesia?', 'Geografi', 'Ibukota Indonesia adalah Jakarta', 'pilihan_ganda', 'Jakarta', 'Bandung', 'Surabaya', 'Medan', 'Semarang', 'Yogyakarta', 'a'],
                ['Batch 1', 10, '2 + 2 = ?', 'Matematika', 'Hasil penjumlahan 2 + 2 adalah 4', 'pilihan_ganda', '3', '4', '5', '6', '', '', 'b'],
                ['Batch 2', 15, 'Jelaskan proses fotosintesis', 'Biologi', 'Fotosintesis adalah proses pembuatan makanan oleh tumbuhan', 'essay', '', '', '', '', '', '', 'Fotosintesis adalah proses dimana tumbuhan menggunakan cahaya matahari, air, dan karbon dioksida untuk membuat glukosa dan oksigen.'],
                ['Batch 2', 15, 'Jelaskan kelebihan dan kekurangan sistem operasi Windows', 'Teknologi Informasi', 'Windows memiliki kelebihan user-friendly tetapi rentan virus', 'essay', '', '', '', '', '', '', 'Windows memiliki kelebihan: user-friendly, kompatibilitas software tinggi, dukungan hardware luas. Kekurangan: rentan virus, lisensi berbayar, resource usage tinggi.'],
                ['Batch 1', 5, 'Siapa presiden Indonesia?', 'Pendidikan Kewarganegaraan', 'Presiden Indonesia saat ini adalah Joko Widodo', 'pilihan_ganda', 'Joko Widodo', 'Prabowo Subianto', 'Megawati', 'Susilo Bambang Yudhoyono', '', '', 'a']
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
            $sheet->getColumnDimension('C')->setWidth(50);
            $sheet->getColumnDimension('D')->setWidth(20);
            $sheet->getColumnDimension('E')->setWidth(40);
            $sheet->getColumnDimension('F')->setWidth(15);
            $sheet->getColumnDimension('G')->setWidth(30);
            $sheet->getColumnDimension('H')->setWidth(30);
            $sheet->getColumnDimension('I')->setWidth(30);
            $sheet->getColumnDimension('J')->setWidth(30);
            $sheet->getColumnDimension('K')->setWidth(30);
            $sheet->getColumnDimension('L')->setWidth(30);
            $sheet->getColumnDimension('M')->setWidth(15);
            $headerStyle = [
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'E3F2FD']
                ]
            ];
            $sheet->getStyle('A1:M1')->applyFromArray($headerStyle);
            $sheet->setCellValue('A' . ($row + 1), 'CATATAN:');
            $sheet->setCellValue('A' . ($row + 2), '- Pertanyaan tidak boleh sama (duplikasi)');
            $sheet->setCellValue('A' . ($row + 3), '- Sistem akan mengecek duplikasi dalam file dan database');
            $sheet->setCellValue('A' . ($row + 4), '- Contoh duplikasi: "Siapa presiden Indonesia?" muncul 2 kali');

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
                        'pertanyaan' => $row[2] ?? '',
                        'mata_pelajaran' => $row[3] ?? '',
                        'umpan_balik' => $row[4] ?? '',
                        'tipe_soal' => $row[5] ?? '',
                        'opsi_a' => $row[6] ?? '',
                        'opsi_b' => $row[7] ?? '',
                        'opsi_c' => $row[8] ?? '',
                        'opsi_d' => $row[9] ?? '',
                        'opsi_e' => $row[10] ?? '',
                        'opsi_f' => $row[11] ?? '',
                        'jawaban_benar' => $row[12] ?? ''
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

                    if (!in_array($rowData['tipe_soal'], ['pilihan_ganda', 'essay'])) {
                        $errors[] = [
                            'row' => $rowNumber,
                            'data' => $rowData,
                            'errors' => ['Tipe Soal harus: pilihan_ganda atau essay']
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
