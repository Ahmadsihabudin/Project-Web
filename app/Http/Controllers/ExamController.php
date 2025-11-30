<?php

namespace App\Http\Controllers;

use App\Models\Ujian;
use App\Models\Soal;
use App\Models\Jawaban;
use App\Models\Peserta;
use App\Models\ActivityLog;
use App\Helpers\SecurityHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session; // PENTING: Tambahan ini

class ExamController extends Controller
{
   /**
    * Get exam data for candidate dashboard
    */
   public function getExamData(Request $request)
   {
      try {
         $pesertaId = session('user_id');
         $peserta = Peserta::find($pesertaId);

         if (!$peserta) {
            return response()->json([
               'success' => false,
               'message' => 'Data peserta tidak ditemukan'
            ], 404);
         }
         $exams = Ujian::where('status', 'aktif')
            ->whereHas('batch', function ($query) use ($peserta) {
               $query->where('nama_batch', $peserta->jurusan);
            })
            ->get();

         $formattedExams = [];
         foreach ($exams as $exam) {
            $existingAnswer = Jawaban::where('id_peserta', $pesertaId)
               ->where('id_ujian', $exam->id_ujian)
               ->first();

            $status = 'available';
            if ($existingAnswer) {
               $status = 'completed';
            }

            $formattedExams[] = [
               'id' => $exam->id_ujian,
               'title' => $exam->nama_ujian,
               'subject' => $exam->mata_pelajaran,
               'description' => $exam->deskripsi,
               'duration' => $exam->durasi,
               'status' => $status
            ];
         }

         return response()->json([
            'success' => true,
            'exams' => $formattedExams
         ]);
      } catch (\Exception $e) {
         return response()->json([
            'success' => false,
            'message' => 'Gagal memuat data ujian: ' . $e->getMessage()
         ], 500);
      }
   }

   /**
    * Get available exams for student
    */
   public function getAvailableExams(Request $request)
   {
      try {
         $pesertaId = session('user_id');
         $now = Carbon::now();
         $exams = Ujian::with(['soal'])
            ->where('status', 'aktif')
            ->where('tanggal_mulai', '<=', $now)
            ->where('tanggal_selesai', '>=', $now)
            ->get();

         $availableExams = [];

         foreach ($exams as $exam) {
            $existingAnswer = Jawaban::where('id_peserta', $pesertaId)
               ->where('id_ujian', $exam->id_ujian)
               ->first();

            $status = 'available';
            if ($existingAnswer) {
               $status = 'completed';
            }
            $startTime = Carbon::parse($exam->tanggal_mulai);
            $endTime = Carbon::parse($exam->tanggal_selesai);

            if ($now->lt($startTime)) {
               $status = 'upcoming';
            } elseif ($now->gt($endTime)) {
               $status = 'expired';
            }

            $availableExams[] = [
               'id' => $exam->id_ujian,
               'nama_ujian' => $exam->nama_ujian,
               'deskripsi' => $exam->deskripsi,
               'durasi' => $exam->durasi,
               'tanggal_mulai' => $exam->tanggal_mulai,
               'tanggal_selesai' => $exam->tanggal_selesai,
               'jumlah_soal' => $exam->soal->count(),
               'status' => $status
            ];
         }

         return response()->json([
            'success' => true,
            'data' => $availableExams
         ]);
      } catch (\Exception $e) {
         return response()->json([
            'success' => false,
            'message' => 'Gagal memuat daftar ujian: ' . $e->getMessage()
         ], 500);
      }
   }

   /**
    * Start exam for student
    */
   public function startExam(Request $request, $id)
   {
      // Logika di controller ini sudah digantikan oleh Student/ExamController.php

      try {
         $pesertaId = session('user_id');
         $exam = Ujian::with(['soal'])
            ->where('id_ujian', $id)
            ->where('status', 'aktif')
            ->first();

         if (!$exam) {
            return response()->json([
               'success' => false,
               'message' => 'Ujian tidak ditemukan atau tidak tersedia'
            ], 404);
         }
         $now = Carbon::now();
         $startTime = Carbon::parse($exam->tanggal_mulai);
         $endTime = Carbon::parse($exam->tanggal_selesai);

         if ($now->lt($startTime)) {
            return response()->json([
               'success' => false,
               'message' => 'Ujian belum dimulai'
            ], 400);
         }

         if ($now->gt($endTime)) {
            return response()->json([
               'success' => false,
               'message' => 'Ujian sudah berakhir'
            ], 400);
         }
         $existingAnswer = Jawaban::where('id_peserta', $pesertaId)
            ->where('id_ujian', $exam->id_ujian)
            ->first();

         if ($existingAnswer) {
            return response()->json([
               'success' => false,
               'message' => 'Anda sudah mengikuti ujian ini'
            ], 400);
         }
         $questions = $exam->soal->shuffle()->take($exam->jumlah_soal ?? $exam->soal->count());

         $formattedQuestions = [];
         foreach ($questions as $index => $soal) {
            $formattedQuestions[] = [
               'id' => $soal->id_soal,
               'pertanyaan' => $soal->pertanyaan,
               'options' => [
                  $soal->pilihan_a,
                  $soal->pilihan_b,
                  $soal->pilihan_c,
                  $soal->pilihan_d
               ],
               'jawaban_benar' => $soal->jawaban_benar
            ];
         }
         ActivityLog::create([
            'user_type' => 'peserta',
            'user_id' => $pesertaId,
            'action' => 'start_exam',
            'description' => "Started exam: {$exam->nama_ujian}",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'metadata' => SecurityHelper::getDeviceInfo($request->userAgent())
         ]);

         return response()->json([
            'success' => true,
            'data' => [
               'exam_id' => $exam->id_ujian,
               'nama_ujian' => $exam->nama_ujian,
               'duration' => $exam->durasi,
               'questions' => $formattedQuestions
            ]
         ]);
      } catch (\Exception $e) {
         return response()->json([
            'success' => false,
            'message' => 'Gagal memulai ujian: ' . $e->getMessage()
         ], 500);
      }
   }

   /**
    * Submit exam answers
    */
   public function submitExam(Request $request, $id)
   {
      $validator = Validator::make($request->all(), [
         'answers' => 'required|array'
      ]);

      if ($validator->fails()) {
         return response()->json([
            'success' => false,
            'message' => 'Data jawaban tidak valid'
         ], 400);
      }

      try {
         // --- RESET SESSION SETELAH SUBMIT ---
         session()->forget('is_face_verified_' . $id);
         // ------------------------------------

         $pesertaId = session('user_id');
         $answers = $request->answers;
         $exam = Ujian::with(['soal'])->findOrFail($id);
         $now = Carbon::now();
         $endTime = Carbon::parse($exam->tanggal_selesai);

         if ($now->gt($endTime)) {
            return response()->json([
               'success' => false,
               'message' => 'Waktu ujian sudah berakhir'
            ], 400);
         }
         $existingAnswer = Jawaban::where('id_peserta', $pesertaId)
            ->where('id_ujian', $exam->id_ujian)
            ->first();

         if ($existingAnswer) {
            return response()->json([
               'success' => false,
               'message' => 'Anda sudah mengirimkan jawaban untuk ujian ini'
            ], 400);
         }
         $totalQuestions = count($answers);
         $correctAnswers = 0;

         foreach ($answers as $questionIndex => $selectedOption) {
            $questionId = $exam->soal->skip($questionIndex)->first()->id_soal ?? null;

            if ($questionId) {
               $soal = Soal::find($questionId);
               if ($soal && $soal->jawaban_benar === $selectedOption) {
                  $correctAnswers++;
               }
               Jawaban::create([
                  'id_peserta' => $pesertaId,
                  'id_ujian' => $exam->id_ujian,
                  'id_soal' => $questionId,
                  'jawaban_peserta' => $selectedOption,
                  'waktu_jawab' => $now
               ]);
            }
         }

         $score = $totalQuestions > 0 ? ($correctAnswers / $totalQuestions) * 100 : 0;
         ActivityLog::create([
            'user_type' => 'peserta',
            'user_id' => $pesertaId,
            'action' => 'submit_exam',
            'description' => "Submitted exam: {$exam->nama_ujian} (Score: {$score}%)",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'metadata' => SecurityHelper::getDeviceInfo($request->userAgent())
         ]);

         return response()->json([
            'success' => true,
            'message' => 'Ujian berhasil diselesaikan',
            'data' => [
               'score' => round($score, 2),
               'correct_answers' => $correctAnswers,
               'total_questions' => $totalQuestions
            ]
         ]);
      } catch (\Exception $e) {
         return response()->json([
            'success' => false,
            'message' => 'Gagal menyelesaikan ujian: ' . $e->getMessage()
         ], 500);
      }
   }

   // ==================================================
   // === FUNGSI BARU: VERIFIKASI WAJAH (CHECK-IN) ===
   // ==================================================

   public function showVerificationPage(Request $request, $id_ujian)
   {
      $pesertaId = session('user_id');
      $peserta = Peserta::find($pesertaId);
      $ujian = Ujian::find($id_ujian);

      if (!$peserta || !$ujian) {
         return redirect('/dashboard')->with('error', 'Data peserta/ujian tidak ditemukan.');
      }

      // Pastikan kolom 'foto' ada di tabel peserta
      if (empty($peserta->foto)) {
         return redirect('/dashboard')->with('error', 'Foto profil belum ada. Hubungi admin.');
      }

      return view('students.verify', [
         'peserta' => $peserta,
         'ujian' => $ujian,
         'id_ujian' => $id_ujian
      ]);
   }

   public function markAsVerified(Request $request)
   {
      $validator = Validator::make($request->all(), [
         'id_ujian' => 'required|numeric'
      ]);

      if ($validator->fails()) {
         return response()->json(['success' => false, 'message' => 'ID Ujian Error.'], 400);
      }

      $id_ujian = $request->input('id_ujian');

      // Simpan Session (Izin Masuk)
      session(['is_face_verified_' . $id_ujian => true]);

      return response()->json([
         'success' => true,
         'message' => 'Verifikasi berhasil.'
      ]);
   }
}