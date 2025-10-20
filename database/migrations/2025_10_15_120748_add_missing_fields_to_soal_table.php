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
            // Add missing fields only if they don't exist
            if (!Schema::hasColumn('soal', 'kategori')) {
                $table->string('kategori')->nullable()->after('mata_pelajaran');
            }
            if (!Schema::hasColumn('soal', 'opsi_e')) {
                $table->string('opsi_e')->nullable()->after('opsi_d');
            }
            if (!Schema::hasColumn('soal', 'opsi_f')) {
                $table->string('opsi_f')->nullable()->after('opsi_e');
            }
            if (!Schema::hasColumn('soal', 'umpan_balik')) {
                $table->text('umpan_balik')->nullable()->after('jawaban_benar');
            }
            if (!Schema::hasColumn('soal', 'id_peserta')) {
                $table->string('id_peserta')->nullable()->after('id_ujian');
            }
            if (!Schema::hasColumn('soal', 'batch')) {
                $table->string('batch')->nullable()->after('id_peserta');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('soal', function (Blueprint $table) {
            $table->dropColumn(['kategori', 'opsi_e', 'opsi_f', 'umpan_balik', 'id_peserta', 'batch']);
            $table->enum('jawaban_benar', ['a', 'b', 'c', 'd'])->change();
        });
    }
};
