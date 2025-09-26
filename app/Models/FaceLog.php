<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id_face_log
 * @property int $id_peserta
 * @property int $id_ujian
 * @property int $jumlah_orang
 * @property int $peringatan_ke
 * @property \Illuminate\Support\Carbon $detected_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Peserta $peserta
 * @property-read \App\Models\Ujian $ujian
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FaceLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FaceLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FaceLog query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FaceLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FaceLog whereDetectedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FaceLog whereIdFaceLog($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FaceLog whereIdPeserta($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FaceLog whereIdUjian($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FaceLog whereJumlahOrang($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FaceLog wherePeringatanKe($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FaceLog whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class FaceLog extends Model
{
    protected $table = 'face_logs';
    protected $primaryKey = 'id_face_log';

    protected $fillable = [
        'id_peserta',
        'id_ujian',
        'jumlah_orang',
        'peringatan_ke',
        'detected_at'
    ];

    protected $casts = [
        'jumlah_orang' => 'integer',
        'peringatan_ke' => 'integer',
        'detected_at' => 'datetime'
    ];

    /**
     * Relationship with peserta
     */
    public function peserta(): BelongsTo
    {
        return $this->belongsTo(Peserta::class, 'id_peserta', 'id_peserta');
    }

    /**
     * Relationship with ujian
     */
    public function ujian(): BelongsTo
    {
        return $this->belongsTo(Ujian::class, 'id_ujian', 'id_ujian');
    }
}
