<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SesiUjian extends Model
{
    use HasFactory;

    protected $table = 'sesi_ujian';
    protected $primaryKey = 'id_sesi';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'id_ujian',
        'id_batch',
        'mata_pelajaran',
        'deskripsi',
        'tanggal_mulai',
        'jam_mulai',
        'jam_selesai',
        'tanggal_selesai',
        'durasi_menit',
        'status',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date:Y-m-d',
        'tanggal_selesai' => 'date:Y-m-d',
        'jam_mulai' => 'string',
        'jam_selesai' => 'string',
    ];

    public function ujian(): BelongsTo
    {
        return $this->belongsTo(Ujian::class, 'id_ujian', 'id_ujian');
    }

    public function batch(): BelongsTo
    {
        return $this->belongsTo(Batch::class, 'id_batch', 'id_batch');
    }
}
