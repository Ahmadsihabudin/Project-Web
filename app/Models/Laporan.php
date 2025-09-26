<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id_laporan
 * @property int $id_ujian
 * @property int $id_peserta
 * @property numeric $total_score
 * @property int $jumlah_benar
 * @property int $waktu_pengerjaan
 * @property string $status_submit
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Peserta $peserta
 * @property-read \App\Models\Ujian $ujian
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laporan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laporan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laporan query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laporan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laporan whereIdLaporan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laporan whereIdPeserta($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laporan whereIdUjian($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laporan whereJumlahBenar($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laporan whereStatusSubmit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laporan whereTotalScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laporan whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laporan whereWaktuPengerjaan($value)
 * @mixin \Eloquent
 */
class Laporan extends Model
{
    protected $table = 'laporan';
    protected $primaryKey = 'id_laporan';

    protected $fillable = [
        'id_ujian',
        'id_peserta',
        'total_score',
        'jumlah_benar',
        'waktu_pengerjaan',
        'status_submit'
    ];

    protected $casts = [
        'total_score' => 'decimal:2',
        'jumlah_benar' => 'integer',
        'waktu_pengerjaan' => 'integer'
    ];

    /**
     * Relationship with ujian
     */
    public function ujian(): BelongsTo
    {
        return $this->belongsTo(Ujian::class, 'id_ujian', 'id_ujian');
    }

    /**
     * Relationship with peserta
     */
    public function peserta(): BelongsTo
    {
        return $this->belongsTo(Peserta::class, 'id_peserta', 'id_peserta');
    }
}
