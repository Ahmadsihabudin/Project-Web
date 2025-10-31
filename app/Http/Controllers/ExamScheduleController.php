<?php

namespace App\Http\Controllers;

use App\Models\ExamSchedule;
use App\Models\Soal;
use App\Models\Batch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ExamScheduleController extends Controller
{
    
    public function index()
    {
        return view('exam.schedules');
    }

    /**
     * Get all exam schedules data for API.
     */
    public function data(Request $request)
    {
        try {
            $query = ExamSchedule::with(['batch', 'soal']);
            if ($request->has('search') && $request->search != '') {
                $query->where('nama_ujian', 'like', '%' . $request->search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
            }

            if ($request->has('status') && $request->status != '') {
                $query->where('status', $request->status);
            }

            if ($request->has('batch') && $request->batch != '') {
                $query->where('id_batch', $request->batch);
            }

            $schedules = $query->orderBy('tanggal_ujian', 'desc')
                ->orderBy('jam_mulai', 'desc')
                ->get();
            $transformedSchedules = $schedules->map(function ($schedule) {
                $soalCount = $schedule->soal_ids ? count($schedule->soal_ids) : 0;

                return [
                    'id' => $schedule->id_schedule,
                    'nama_ujian' => $schedule->nama_ujian,
                    'deskripsi' => $schedule->deskripsi,
                    'batch' => $schedule->batch ? $schedule->batch->nama_batch : 'Tidak ada batch',
                    'tanggal_ujian' => $schedule->tanggal_ujian->format('d/m/Y'),
                    'jam_mulai' => $schedule->jam_mulai,
                    'jam_selesai' => $schedule->jam_selesai,
                    'durasi_menit' => $schedule->durasi_menit,
                    'formatted_duration' => $schedule->formatted_duration,
                    'formatted_datetime' => $schedule->formatted_datetime,
                    'status' => $schedule->status,
                    'soal_count' => $soalCount,
                    'max_attempts' => $schedule->max_attempts,
                    'randomize_questions' => $schedule->randomize_questions,
                    'show_results_immediately' => $schedule->show_results_immediately,
                    'is_running' => $schedule->isRunning(),
                    'has_ended' => $schedule->hasEnded(),
                    'created_at' => $schedule->created_at ? $schedule->created_at->format('d/m/Y H:i') : '-',
                    'updated_at' => $schedule->updated_at ? $schedule->updated_at->format('d/m/Y H:i') : '-'
                ];
            });
            $stats = [
                'total' => $schedules->count(),
                'aktif' => $schedules->where('status', 'aktif')->count(),
                'berlangsung' => $schedules->where('status', 'berlangsung')->count(),
                'selesai' => $schedules->where('status', 'selesai')->count(),
                'upcoming' => $schedules->where('tanggal_ujian', '>=', now()->toDateString())->count()
            ];

            return response()->json([
                'success' => true,
                'data' => $transformedSchedules,
                'stats' => $stats
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat data jadwal ujian: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get statistics for dashboard
     */
    public function getStats()
    {
        try {
            $total = ExamSchedule::count();
            $aktif = ExamSchedule::where('status', 'aktif')->count();
            $berlangsung = ExamSchedule::where('status', 'berlangsung')->count();
            $selesai = ExamSchedule::where('status', 'selesai')->count();
            $upcoming = ExamSchedule::where('tanggal_ujian', '>=', now()->toDateString())->count();

            return response()->json([
                'success' => true,
                'stats' => [
                    'total' => $total,
                    'aktif' => $aktif,
                    'berlangsung' => $berlangsung,
                    'selesai' => $selesai,
                    'upcoming' => $upcoming
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat statistik: ' . $e->getMessage()
            ], 500);
        }
    }

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
     * Get all available questions for selection
     */
    public function getAvailableQuestions()
    {
        try {
            $questions = Soal::where('status', 'aktif')
                ->orderBy('mata_pelajaran', 'asc')
                ->orderBy('created_at', 'desc')
                ->get();

            $transformedQuestions = $questions->map(function ($question) {
                return [
                    'id' => $question->id_soal,
                    'pertanyaan' => $question->pertanyaan,
                    'mata_pelajaran' => $question->mata_pelajaran,
                    'tipe_soal' => $question->tipe_soal,
                    'poin' => $question->poin,
                    'batch' => $question->batch ? $question->batch->nama_batch : 'Tidak ada batch'
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $transformedQuestions
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat data soal: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created exam schedule.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_ujian' => 'required|string|max:255|min:1',
            'deskripsi' => 'nullable|string|max:1000',
            'id_batch' => 'required|exists:batches,id_batch',
            'tanggal_ujian' => 'required|date|after_or_equal:today',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'durasi_menit' => 'required|integer|min:1|max:480',  
            'status' => 'required|in:aktif,tidak_aktif',
            'soal_ids' => 'required|array|min:1',
            'soal_ids.*' => 'exists:soal,id_soal',
            'instruksi' => 'nullable|string|max:2000',
            'max_attempts' => 'required|integer|min:1|max:10',
            'randomize_questions' => 'boolean',
            'show_results_immediately' => 'boolean'
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
            $startTime = Carbon::createFromFormat('H:i', $request->jam_mulai);
            $endTime = Carbon::createFromFormat('H:i', $request->jam_selesai);

            if ($endTime->lte($startTime)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Jam selesai harus setelah jam mulai'
                ], 400);
            }
            $calculatedDuration = $startTime->diffInMinutes($endTime);
            $duration = $request->durasi_menit;
            if ($calculatedDuration > 0 && $calculatedDuration != $duration) {
                $duration = $calculatedDuration;
            }

            $schedule = ExamSchedule::create([
                'nama_ujian' => $request->nama_ujian,
                'deskripsi' => $request->deskripsi,
                'id_batch' => $request->id_batch,
                'tanggal_ujian' => $request->tanggal_ujian,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
                'durasi_menit' => $duration,
                'status' => $request->status,
                'soal_ids' => $request->soal_ids,
                'instruksi' => $request->instruksi,
                'max_attempts' => $request->max_attempts,
                'randomize_questions' => $request->randomize_questions ?? false,
                'show_results_immediately' => $request->show_results_immediately ?? true
            ]);
            if ($request->soal_ids) {
                $syncData = [];
                foreach ($request->soal_ids as $index => $soalId) {
                    $syncData[$soalId] = ['urutan' => $index + 1];
                }
                $schedule->soal()->sync($syncData);
            }

            return response()->json([
                'success' => true,
                'message' => 'Jadwal ujian berhasil ditambahkan',
                'data' => $schedule
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan jadwal ujian: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified exam schedule.
     */
    public function show($id)
    {
        try {
            $schedule = ExamSchedule::with(['batch', 'soal'])->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $schedule
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Jadwal ujian tidak ditemukan: ' . $e->getMessage()
            ], 404);
        }
    }

    /**
     * Update the specified exam schedule.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_ujian' => 'required|string|max:255|min:1',
            'deskripsi' => 'nullable|string|max:1000',
            'id_batch' => 'required|exists:batches,id_batch',
            'tanggal_ujian' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'durasi_menit' => 'required|integer|min:1|max:480',
            'status' => 'required|in:aktif,tidak_aktif,berlangsung,selesai',
            'soal_ids' => 'required|array|min:1',
            'soal_ids.*' => 'exists:soal,id_soal',
            'instruksi' => 'nullable|string|max:2000',
            'max_attempts' => 'required|integer|min:1|max:10',
            'randomize_questions' => 'boolean',
            'show_results_immediately' => 'boolean'
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
            $schedule = ExamSchedule::findOrFail($id);
            $startTime = Carbon::createFromFormat('H:i', $request->jam_mulai);
            $endTime = Carbon::createFromFormat('H:i', $request->jam_selesai);

            if ($endTime->lte($startTime)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Jam selesai harus setelah jam mulai'
                ], 400);
            }
            $calculatedDuration = $startTime->diffInMinutes($endTime);
            $duration = $request->durasi_menit;
            if ($calculatedDuration > 0 && $calculatedDuration != $duration) {
                $duration = $calculatedDuration;
            }

            $schedule->update([
                'nama_ujian' => $request->nama_ujian,
                'deskripsi' => $request->deskripsi,
                'id_batch' => $request->id_batch,
                'tanggal_ujian' => $request->tanggal_ujian,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
                'durasi_menit' => $duration,
                'status' => $request->status,
                'soal_ids' => $request->soal_ids,
                'instruksi' => $request->instruksi,
                'max_attempts' => $request->max_attempts,
                'randomize_questions' => $request->randomize_questions ?? false,
                'show_results_immediately' => $request->show_results_immediately ?? true
            ]);
            if ($request->soal_ids) {
                $syncData = [];
                foreach ($request->soal_ids as $index => $soalId) {
                    $syncData[$soalId] = ['urutan' => $index + 1];
                }
                $schedule->soal()->sync($syncData);
            }

            return response()->json([
                'success' => true,
                'message' => 'Jadwal ujian berhasil diperbarui',
                'data' => $schedule
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui jadwal ujian: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified exam schedule.
     */
    public function destroy($id)
    {
        try {
            $schedule = ExamSchedule::findOrFail($id);
            $schedule->delete();

            return response()->json([
                'success' => true,
                'message' => 'Jadwal ujian berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus jadwal ujian: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update exam schedule status
     */
    public function updateStatus(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
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
            $schedule = ExamSchedule::findOrFail($id);
            $schedule->update(['status' => $request->status]);

            return response()->json([
                'success' => true,
                'message' => 'Status jadwal ujian berhasil diperbarui',
                'data' => $schedule
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui status: ' . $e->getMessage()
            ], 500);
        }
    }
}
