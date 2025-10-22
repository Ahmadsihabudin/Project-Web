<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id_ujian
 * @property int $id_batch
 * @property \Illuminate\Support\Carbon $tanggal_mulai
 * @property \Illuminate\Support\Carbon $jam_mulai
 * @property \Illuminate\Support\Carbon $jam_selesai
 * @property int $durasi_menit
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Batch $batch
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\FaceLog> $faceLogs
 * @property-read int|null $face_logs_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Jawaban> $jawaban
 * @property-read int|null $jawaban_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Laporan> $laporan
 * @property-read int|null $laporan_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SoalRandomization> $soalRandomization
 * @property-read int|null $soal_randomization_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ujian newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ujian newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ujian query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ujian whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ujian whereDurasiMenit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ujian whereIdBatch($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ujian whereIdUjian($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ujian whereJamMulai($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ujian whereJamSelesai($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ujian whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ujian whereTanggalMulai($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ujian whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Ujian extends Model
{
    protected $table = 'ujian';
    protected $primaryKey = 'id_ujian';
    
    // Disable timestamps since table only has created_at
    public $timestamps = false;
    
    // Manually set created_at
    protected $dates = ['created_at'];

    protected $fillable = [
        'id_batch',
        'nama_ujian',
        'mata_pelajaran',
        'deskripsi',
        'tanggal_mulai',
        'jam_mulai',
        'jam_selesai',
        'tanggal_selesai',
        'durasi_menit',
        'durasi',
        'status',
        'created_at'
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'durasi_menit' => 'integer',
        'durasi' => 'integer'
    ];

    /**
     * Relationship with batch
     */
    public function batch(): BelongsTo
    {
        return $this->belongsTo(Batch::class, 'id_batch', 'id_batch');
    }

    /**
     * Relationship with jawaban
     */
    public function jawaban(): HasMany
    {
        return $this->hasMany(Jawaban::class, 'id_ujian', 'id_ujian');
    }

    /**
     * Relationship with laporan
     */
    public function laporan(): HasMany
    {
        return $this->hasMany(Laporan::class, 'id_ujian', 'id_ujian');
    }

    /**
     * Relationship with face_logs
     */
    public function faceLogs(): HasMany
    {
        return $this->hasMany(FaceLog::class, 'id_ujian', 'id_ujian');
    }

    /**
     * Relationship with soal_randomization
     */
    public function soalRandomization(): HasMany
    {
        return $this->hasMany(SoalRandomization::class, 'id_ujian', 'id_ujian');
    }

    /**
     * Relationship with soal
     */
    public function soal(): HasMany
    {
        return $this->hasMany(Soal::class, 'id_ujian', 'id_ujian');
    }
}
