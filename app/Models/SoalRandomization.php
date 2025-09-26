<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $id_ujian
 * @property int $id_peserta
 * @property array<array-key, mixed> $soal_order
 * @property array<array-key, mixed> $jawaban_order
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Peserta $peserta
 * @property-read \App\Models\Ujian $ujian
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SoalRandomization newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SoalRandomization newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SoalRandomization query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SoalRandomization whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SoalRandomization whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SoalRandomization whereIdPeserta($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SoalRandomization whereIdUjian($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SoalRandomization whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SoalRandomization whereJawabanOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SoalRandomization whereSoalOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SoalRandomization whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SoalRandomization extends Model
{
    protected $table = 'soal_randomization';

    protected $fillable = [
        'id_ujian',
        'id_peserta',
        'soal_order',
        'jawaban_order',
        'is_active'
    ];

    protected $casts = [
        'soal_order' => 'array',
        'jawaban_order' => 'array',
        'is_active' => 'boolean'
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

    /**
     * Generate random soal order
     */
    public static function generateSoalOrder($soalIds)
    {
        $shuffled = $soalIds;
        shuffle($shuffled);
        return $shuffled;
    }

    /**
     * Generate random jawaban order
     */
    public static function generateJawabanOrder()
    {
        $options = ['a', 'b', 'c', 'd'];
        shuffle($options);
        return $options;
    }

    /**
     * Get soal in randomized order
     */
    public function getRandomizedSoal()
    {
        if (!$this->soal_order) {
            return collect();
        }

        return Soal::whereIn('id_soal', $this->soal_order)
            ->orderByRaw('FIELD(id_soal, ' . implode(',', $this->soal_order) . ')')
            ->get();
    }

    /**
     * Get randomized options for a specific soal
     */
    public function getRandomizedOptions($soalId)
    {
        if (!$this->jawaban_order) {
            return ['a', 'b', 'c', 'd'];
        }

        return $this->jawaban_order;
    }

    /**
     * Create randomization for peserta
     */
    public static function createForPeserta($idUjian, $idPeserta, $soalIds)
    {
        return self::create([
            'id_ujian' => $idUjian,
            'id_peserta' => $idPeserta,
            'soal_order' => self::generateSoalOrder($soalIds),
            'jawaban_order' => self::generateJawabanOrder(),
            'is_active' => true
        ]);
    }
}
