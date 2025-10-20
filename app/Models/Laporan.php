<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporan';
    protected $primaryKey = 'id_laporan';

    protected $fillable = [
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
     * Relationship with peserta
     */
    public function peserta()
    {
        return $this->belongsTo(Peserta::class, 'id_peserta', 'id_peserta');
    }

    /**
     * Scope for manual submit
     */
    public function scopeManual($query)
    {
        return $query->where('status_submit', 'manual');
    }

    /**
     * Scope for auto submit
     */
    public function scopeAutoSubmit($query)
    {
        return $query->where('status_submit', 'auto_submit');
    }

    /**
     * Scope for cheat detection
     */
    public function scopeCheat($query)
    {
        return $query->where('status_submit', 'cheat');
    }
}
