<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Remove nilai_essay column from jawaban table
        Schema::table('jawaban', function (Blueprint $table) {
            if (Schema::hasColumn('jawaban', 'nilai_essay')) {
                $table->dropColumn('nilai_essay');
            }
        });

        // Update tipe_soal enum to remove 'essay'
        // First, we need to modify existing 'essay' records to 'pilihan_ganda'
        DB::table('soal')
            ->where('tipe_soal', 'essay')
            ->update(['tipe_soal' => 'pilihan_ganda']);

        // Then alter the enum column
        DB::statement("ALTER TABLE soal MODIFY COLUMN tipe_soal ENUM('pilihan_ganda', 'benar_salah') NOT NULL DEFAULT 'pilihan_ganda'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Add back nilai_essay column
        Schema::table('jawaban', function (Blueprint $table) {
            $table->decimal('nilai_essay', 5, 2)->nullable()->after('status');
        });

        // Add back 'essay' to enum
        DB::statement("ALTER TABLE soal MODIFY COLUMN tipe_soal ENUM('pilihan_ganda', 'essay', 'benar_salah') NOT NULL DEFAULT 'pilihan_ganda'");
    }
};
