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
            if (!Schema::hasColumn('soal', 'durasi_soal')) {
                $table->integer('durasi_soal')->nullable()->after('poin')->comment('Durasi dalam menit untuk mengerjakan soal ini');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('soal', function (Blueprint $table) {
            if (Schema::hasColumn('soal', 'durasi_soal')) {
                $table->dropColumn('durasi_soal');
            }
        });
    }
};
