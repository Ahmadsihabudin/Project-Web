<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Hapus kolom dari tabel users
        if (Schema::hasTable('users')) {
            $columnsToDrop = [];
            if (Schema::hasColumn('users', 'login_attempts')) $columnsToDrop[] = 'login_attempts';
            if (Schema::hasColumn('users', 'remember_token')) $columnsToDrop[] = 'remember_token';
            if (Schema::hasColumn('users', 'created_at')) $columnsToDrop[] = 'created_at';
            if (Schema::hasColumn('users', 'updated_at')) $columnsToDrop[] = 'updated_at';

            if (!empty($columnsToDrop)) {
                Schema::table('users', function (Blueprint $table) use ($columnsToDrop) {
                    $table->dropColumn($columnsToDrop);
                });
            }
        }

        // Hapus kolom dari tabel peserta
        if (Schema::hasTable('peserta')) {
            $columnsToDrop = [];
            if (Schema::hasColumn('peserta', 'login_attempts')) $columnsToDrop[] = 'login_attempts';
            if (Schema::hasColumn('peserta', 'remember_token')) $columnsToDrop[] = 'remember_token';
            if (Schema::hasColumn('peserta', 'created_at')) $columnsToDrop[] = 'created_at';
            if (Schema::hasColumn('peserta', 'updated_at')) $columnsToDrop[] = 'updated_at';

            if (!empty($columnsToDrop)) {
                Schema::table('peserta', function (Blueprint $table) use ($columnsToDrop) {
                    $table->dropColumn($columnsToDrop);
                });
            }
        }

        // Hapus kolom dari tabel soal
        if (Schema::hasTable('soal')) {
            $columnsToDrop = [];
            if (Schema::hasColumn('soal', 'login_attempts')) $columnsToDrop[] = 'login_attempts';
            if (Schema::hasColumn('soal', 'remember_token')) $columnsToDrop[] = 'remember_token';
            if (Schema::hasColumn('soal', 'created_at')) $columnsToDrop[] = 'created_at';
            if (Schema::hasColumn('soal', 'updated_at')) $columnsToDrop[] = 'updated_at';

            if (!empty($columnsToDrop)) {
                Schema::table('soal', function (Blueprint $table) use ($columnsToDrop) {
                    $table->dropColumn($columnsToDrop);
                });
            }
        }

        // Hapus kolom dari tabel jawaban
        if (Schema::hasTable('jawaban')) {
            $columnsToDrop = [];
            if (Schema::hasColumn('jawaban', 'login_attempts')) $columnsToDrop[] = 'login_attempts';
            if (Schema::hasColumn('jawaban', 'remember_token')) $columnsToDrop[] = 'remember_token';
            if (Schema::hasColumn('jawaban', 'created_at')) $columnsToDrop[] = 'created_at';
            if (Schema::hasColumn('jawaban', 'updated_at')) $columnsToDrop[] = 'updated_at';

            if (!empty($columnsToDrop)) {
                Schema::table('jawaban', function (Blueprint $table) use ($columnsToDrop) {
                    $table->dropColumn($columnsToDrop);
                });
            }
        }

        // Hapus kolom dari tabel laporan
        if (Schema::hasTable('laporan')) {
            $columnsToDrop = [];
            if (Schema::hasColumn('laporan', 'login_attempts')) $columnsToDrop[] = 'login_attempts';
            if (Schema::hasColumn('laporan', 'remember_token')) $columnsToDrop[] = 'remember_token';
            if (Schema::hasColumn('laporan', 'created_at')) $columnsToDrop[] = 'created_at';
            if (Schema::hasColumn('laporan', 'updated_at')) $columnsToDrop[] = 'updated_at';

            if (!empty($columnsToDrop)) {
                Schema::table('laporan', function (Blueprint $table) use ($columnsToDrop) {
                    $table->dropColumn($columnsToDrop);
                });
            }
        }

        // Hapus kolom dari tabel sesi_ujian
        if (Schema::hasTable('sesi_ujian')) {
            $columnsToDrop = [];
            if (Schema::hasColumn('sesi_ujian', 'login_attempts')) $columnsToDrop[] = 'login_attempts';
            if (Schema::hasColumn('sesi_ujian', 'remember_token')) $columnsToDrop[] = 'remember_token';
            if (Schema::hasColumn('sesi_ujian', 'created_at')) $columnsToDrop[] = 'created_at';
            if (Schema::hasColumn('sesi_ujian', 'updated_at')) $columnsToDrop[] = 'updated_at';

            if (!empty($columnsToDrop)) {
                Schema::table('sesi_ujian', function (Blueprint $table) use ($columnsToDrop) {
                    $table->dropColumn($columnsToDrop);
                });
            }
        }

        // Hapus kolom dari tabel batch
        if (Schema::hasTable('batch')) {
            $columnsToDrop = [];
            if (Schema::hasColumn('batch', 'login_attempts')) $columnsToDrop[] = 'login_attempts';
            if (Schema::hasColumn('batch', 'remember_token')) $columnsToDrop[] = 'remember_token';
            if (Schema::hasColumn('batch', 'created_at')) $columnsToDrop[] = 'created_at';
            if (Schema::hasColumn('batch', 'updated_at')) $columnsToDrop[] = 'updated_at';

            if (!empty($columnsToDrop)) {
                Schema::table('batch', function (Blueprint $table) use ($columnsToDrop) {
                    $table->dropColumn($columnsToDrop);
                });
            }
        }

        // Hapus kolom dari tabel ujian
        if (Schema::hasTable('ujian')) {
            $columnsToDrop = [];
            if (Schema::hasColumn('ujian', 'login_attempts')) $columnsToDrop[] = 'login_attempts';
            if (Schema::hasColumn('ujian', 'remember_token')) $columnsToDrop[] = 'remember_token';
            if (Schema::hasColumn('ujian', 'created_at')) $columnsToDrop[] = 'created_at';
            if (Schema::hasColumn('ujian', 'updated_at')) $columnsToDrop[] = 'updated_at';

            if (!empty($columnsToDrop)) {
                Schema::table('ujian', function (Blueprint $table) use ($columnsToDrop) {
                    $table->dropColumn($columnsToDrop);
                });
            }
        }

        // Hapus kolom dari tabel settings
        if (Schema::hasTable('settings')) {
            $columnsToDrop = [];
            if (Schema::hasColumn('settings', 'login_attempts')) $columnsToDrop[] = 'login_attempts';
            if (Schema::hasColumn('settings', 'remember_token')) $columnsToDrop[] = 'remember_token';
            if (Schema::hasColumn('settings', 'created_at')) $columnsToDrop[] = 'created_at';
            if (Schema::hasColumn('settings', 'updated_at')) $columnsToDrop[] = 'updated_at';

            if (!empty($columnsToDrop)) {
                Schema::table('settings', function (Blueprint $table) use ($columnsToDrop) {
                    $table->dropColumn($columnsToDrop);
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('all_tables', function (Blueprint $table) {
            //
        });
    }
};
