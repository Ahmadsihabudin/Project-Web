<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Batch extends Model
{
    use HasFactory;

    protected $table = 'batch';
    protected $primaryKey = 'id_batch';
    public $timestamps = false;

    protected $fillable = [
        'nama_batch',
        'keterangan'
    ];

    protected $casts = [
        'created_at' => 'datetime'
    ];

    /**
     * Get the peserta for the batch.
     */
    public function peserta(): HasMany
    {
        return $this->hasMany(Peserta::class, 'batch', 'nama_batch');
    }

    /**
     * Get the sesi ujian for the batch.
     */
    public function sesiUjian(): HasMany
    {
        return $this->hasMany(SesiUjian::class, 'id_batch', 'id_batch');
    }

    /**
     * Scope untuk batch yang memiliki peserta
     */
    public function scopeWithPeserta($query)
    {
        return $query->whereHas('peserta');
    }

    /**
     * Get jumlah peserta dalam batch
     */
    public function getJumlahPesertaAttribute()
    {
        return $this->peserta()->count();
    }
}
