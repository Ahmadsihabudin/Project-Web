<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Peserta;
use App\Helpers\SecurityHelper;

class PesertaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pesertas = [
            [
                'kode_peserta' => 'RK78607462',
                'nama_peserta' => 'Ahmad Rizki',
                'email' => 'ahmad@example.com',
                'kode_akses' => SecurityHelper::hashPassword('123456'),
                'asal_smk' => 'SMK Negeri 1 Jakarta',
                'jurusan' => 'Teknik Komputer dan Jaringan',
                'status' => 'aktif',
                'batch' => 'Batch 1',
                'nomor_urut' => 1,
                'login_attempts' => 0,
                'locked_until' => null,
                'last_login_at' => null
            ],
            [
                'kode_peserta' => 'RK78607463',
                'nama_peserta' => 'Siti Nurhaliza',
                'email' => 'siti@example.com',
                'kode_akses' => SecurityHelper::hashPassword('123456'),
                'asal_smk' => 'SMK Negeri 2 Jakarta',
                'jurusan' => 'Rekayasa Perangkat Lunak',
                'status' => 'aktif',
                'batch' => 'Batch 1',
                'nomor_urut' => 2,
                'login_attempts' => 0,
                'locked_until' => null,
                'last_login_at' => null
            ],
            [
                'kode_peserta' => 'RK78607464',
                'nama_peserta' => 'Budi Santoso',
                'email' => 'budi@example.com',
                'kode_akses' => SecurityHelper::hashPassword('123456'),
                'asal_smk' => 'SMK Negeri 3 Jakarta',
                'jurusan' => 'Multimedia',
                'status' => 'aktif',
                'batch' => 'Batch 2',
                'nomor_urut' => 3,
                'login_attempts' => 0,
                'locked_until' => null,
                'last_login_at' => null
            ]
        ];

        foreach ($pesertas as $pesertaData) {
            Peserta::updateOrCreate(
                ['kode_peserta' => $pesertaData['kode_peserta']],
                $pesertaData
            );
        }
    }
}
