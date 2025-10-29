<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id_soal
 * @property int $id_batch
 * @property string $pertanyaan
 * @property string $opsi_a
 * @property string $opsi_b
 * @property string $opsi_c
 * @property string $opsi_d
 * @property string $jawaban_benar
 * @property int $poin
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Batch $batch
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Jawaban> $jawaban
 * @property-read int|null $jawaban_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Soal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Soal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Soal query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Soal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Soal whereIdBatch($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Soal whereIdSoal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Soal whereJawabanBenar($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Soal whereOpsiA($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Soal whereOpsiB($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Soal whereOpsiC($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Soal whereOpsiD($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Soal wherePertanyaan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Soal wherePoin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Soal whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Soal extends Model
{
    protected $table = 'soal';
    protected $primaryKey = 'id_soal';
    public $timestamps = false;
    protected $fillable = [
        'batch',
        'pertanyaan',
        'mata_pelajaran',
        'level_kesulitan',
        'tipe_soal',
        'opsi_a',
        'opsi_b',
        'opsi_c',
        'opsi_d',
        'opsi_e',
        'opsi_f',
        'jawaban_benar',
        'umpan_balik',
        'poin'
    ];

    protected $casts = [
        'poin' => 'integer'
    ];

    /**
     * Relationship with batch (using batch string field)
     */
    public function batch(): BelongsTo
    {
        return $this->belongsTo(Batch::class, 'batch', 'nama_batch');
    }

    /**
     * Relationship with jawaban
     */
    public function jawaban(): HasMany
    {
        return $this->hasMany(Jawaban::class, 'id_soal', 'id_soal');
    }

    /**
     * Relationship with ujian
     */
    public function ujian(): BelongsTo
    {
        return $this->belongsTo(Ujian::class, 'id_ujian', 'id_ujian');
    }
}
