<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id_batch
 * @property string $nama_batch
 * @property string|null $deskripsi
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Soal> $soal
 * @property-read int|null $soal_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Ujian> $ujian
 * @property-read int|null $ujian_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Batch newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Batch newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Batch query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Batch whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Batch whereDeskripsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Batch whereIdBatch($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Batch whereNamaBatch($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Batch whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Batch extends Model
{
    protected $table = 'batches';
    protected $primaryKey = 'id_batch';

    protected $fillable = [
        'nama_batch',
        'deskripsi'
    ];

    /**
     * Relationship with soal
     */
    public function soal(): HasMany
    {
        return $this->hasMany(Soal::class, 'id_batch', 'id_batch');
    }

    /**
     * Relationship with ujian
     */
    public function ujian(): HasMany
    {
        return $this->hasMany(Ujian::class, 'id_batch', 'id_batch');
    }
}
