<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id_jawaban
 * @property int $id_ujian
 * @property int $id_peserta
 * @property int $id_soal
 * @property string|null $jawaban_dipilih
 * @property string $status
 * @property numeric|null $nilai_essay
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Peserta $peserta
 * @property-read \App\Models\Soal $soal
 * @property-read \App\Models\Ujian $ujian
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Jawaban newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Jawaban newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Jawaban query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Jawaban whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Jawaban whereIdJawaban($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Jawaban whereIdPeserta($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Jawaban whereIdSoal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Jawaban whereIdUjian($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Jawaban whereJawabanDipilih($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Jawaban whereNilaiEssay($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Jawaban whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Jawaban whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Jawaban extends Model
{
    protected $table = 'jawaban';
    protected $primaryKey = 'id_jawaban';

    protected $fillable = [
        'id_peserta',
        'id_soal',
        'jawaban_dipilih',
        'status',
        'nilai_essay'
    ];

    protected $casts = [
        'nilai_essay' => 'decimal:2'
    ];


    /**
     * Relationship with peserta
     */
    public function peserta(): BelongsTo
    {
        return $this->belongsTo(Peserta::class, 'id_peserta', 'id_peserta');
    }

    /**
     * Relationship with soal
     */
    public function soal(): BelongsTo
    {
        return $this->belongsTo(Soal::class, 'id_soal', 'id_soal');
    }
}
