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
        Schema::table('soal', function (Blueprint $table) {
            $table->string('mata_pelajaran')->nullable()->after('pertanyaan');
            $table->enum('level_kesulitan', ['mudah', 'sedang', 'sulit'])->default('sedang')->after('mata_pelajaran');
            $table->enum('tipe_soal', ['pilihan_ganda', 'benar_salah'])->default('pilihan_ganda')->after('level_kesulitan');
            $table->enum('status', ['aktif', 'tidak_aktif'])->default('aktif')->after('poin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('soal', function (Blueprint $table) {
            $table->dropColumn(['mata_pelajaran', 'level_kesulitan', 'tipe_soal', 'status']);
        });
    }
};
