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
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'jam_mulai' => 'datetime:H:i',
        'jam_selesai' => 'datetime:H:i',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
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
