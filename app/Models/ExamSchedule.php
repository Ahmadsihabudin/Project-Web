<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ExamSchedule extends Model
{
    use HasFactory;

    protected $table = 'exam_schedules';
    protected $primaryKey = 'id_schedule';

    protected $fillable = [
        'nama_ujian',
        'deskripsi',
        'id_batch',
        'tanggal_ujian',
        'jam_mulai',
        'jam_selesai',
        'durasi_menit',
        'status',
        'soal_ids',
        'instruksi',
        'max_attempts',
        'randomize_questions',
        'show_results_immediately'
    ];

    protected $casts = [
        'tanggal_ujian' => 'date',
        'jam_mulai' => 'datetime:H:i',
        'jam_selesai' => 'datetime:H:i',
        'soal_ids' => 'array',
        'randomize_questions' => 'boolean',
        'show_results_immediately' => 'boolean'
    ];

    /**
     * Get the batch that owns the exam schedule.
     */
    public function batch(): BelongsTo
    {
        return $this->belongsTo(Batch::class, 'id_batch', 'id_batch');
    }

    /**
     * Get the questions for the exam schedule.
     */
    public function soal(): BelongsToMany
    {
        return $this->belongsToMany(Soal::class, 'exam_schedule_soal', 'id_schedule', 'id_soal')
            ->withPivot('urutan')
            ->withTimestamps();
    }

    /**
     * Get soal by IDs stored in soal_ids JSON field
     */
    public function getSoalByIds()
    {
        if (!$this->soal_ids) {
            return collect();
        }

        return Soal::whereIn('id_soal', $this->soal_ids)->get();
    }

    /**
     * Scope for active schedules
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'aktif');
    }

    /**
     * Scope for upcoming schedules
     */
    public function scopeUpcoming($query)
    {
        return $query->where('tanggal_ujian', '>=', now()->toDateString())
            ->where('status', 'aktif');
    }

    /**
     * Scope for today's schedules
     */
    public function scopeToday($query)
    {
        return $query->where('tanggal_ujian', now()->toDateString());
    }

    /**
     * Check if exam is currently running
     */
    public function isRunning()
    {
        $now = now();
        $startTime = $this->tanggal_ujian->setTimeFromTimeString($this->jam_mulai);
        $endTime = $this->tanggal_ujian->setTimeFromTimeString($this->jam_selesai);

        return $now->between($startTime, $endTime) && $this->status === 'aktif';
    }

    /**
     * Check if exam has ended
     */
    public function hasEnded()
    {
        $now = now();
        $endTime = $this->tanggal_ujian->setTimeFromTimeString($this->jam_selesai);

        return $now->gt($endTime) || $this->status === 'selesai';
    }

    /**
     * Get formatted duration
     */
    public function getFormattedDurationAttribute()
    {
        $hours = floor($this->durasi_menit / 60);
        $minutes = $this->durasi_menit % 60;

        if ($hours > 0) {
            return $hours . ' jam ' . $minutes . ' menit';
        }

        return $minutes . ' menit';
    }

    /**
     * Get exam date and time formatted
     */
    public function getFormattedDateTimeAttribute()
    {
        return $this->tanggal_ujian->format('d/m/Y') . ' ' .
            $this->jam_mulai . ' - ' . $this->jam_selesai;
    }
}
