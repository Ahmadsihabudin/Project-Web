<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property int $id_peserta
 * @property int $nomor_urut
 * @property string $nama_peserta
 * @property string $kode_peserta
 * @property string $password_hash
 * @property string $asal_smk
 * @property string $jurusan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $last_login_at
 * @property int $login_attempts
 * @property \Illuminate\Support\Carbon|null $locked_until
 * @property string|null $remember_token
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\FaceLog> $faceLogs
 * @property-read int|null $face_logs_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Jawaban> $jawaban
 * @property-read int|null $jawaban_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Laporan> $laporan
 * @property-read int|null $laporan_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SoalRandomization> $soalRandomization
 * @property-read int|null $soal_randomization_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Peserta newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Peserta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Peserta query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Peserta whereAsalSmk($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Peserta whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Peserta whereIdPeserta($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Peserta whereJurusan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Peserta whereKodePeserta($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Peserta whereLastLoginAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Peserta whereLockedUntil($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Peserta whereLoginAttempts($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Peserta whereNamaPeserta($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Peserta whereNomorUrut($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Peserta wherePasswordHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Peserta whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Peserta whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Peserta extends Authenticatable
{
    use Notifiable;

    protected $table = 'peserta';
    protected $primaryKey = 'id_peserta';

    protected $fillable = [
        'nomor_urut',
        'nama_peserta',
        'kode_peserta',
        'password_hash',
        'asal_smk',
        'jurusan',
        'status',
        'last_login_at',
        'login_attempts',
        'locked_until',
        'remember_token'
    ];

    protected $hidden = [
        'password_hash',
        'remember_token'
    ];

    protected $casts = [
        'last_login_at' => 'datetime',
        'locked_until' => 'datetime',
        'login_attempts' => 'integer'
    ];

    /**
     * Get the password for the user.
     */
    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    /**
     * Relationship with jawaban
     */
    public function jawaban(): HasMany
    {
        return $this->hasMany(Jawaban::class, 'id_peserta', 'id_peserta');
    }

    /**
     * Relationship with laporan
     */
    public function laporan(): HasMany
    {
        return $this->hasMany(Laporan::class, 'id_peserta', 'id_peserta');
    }

    /**
     * Relationship with face_logs
     */
    public function faceLogs(): HasMany
    {
        return $this->hasMany(FaceLog::class, 'id_peserta', 'id_peserta');
    }

    /**
     * Relationship with soal_randomization
     */
    public function soalRandomization(): HasMany
    {
        return $this->hasMany(SoalRandomization::class, 'id_peserta', 'id_peserta');
    }

    /**
     * Check if account is locked
     */
    public function isLocked(): bool
    {
        return $this->login_attempts >= 5 &&
            $this->locked_until &&
            now()->lt($this->locked_until);
    }

    /**
     * Reset login attempts
     */
    public function resetLoginAttempts(): void
    {
        $this->update([
            'login_attempts' => 0,
            'locked_until' => null
        ]);
    }
}
