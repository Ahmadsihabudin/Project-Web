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
        Schema::table('sesi_ujian', function (Blueprint $table) {
            if (!Schema::hasColumn('sesi_ujian', 'hide_nomor_urut')) {
                $table->boolean('hide_nomor_urut')->default(false)->after('status');
            }
            if (!Schema::hasColumn('sesi_ujian', 'hide_poin')) {
                $table->boolean('hide_poin')->default(false)->after('hide_nomor_urut');
            }
            if (!Schema::hasColumn('sesi_ujian', 'hide_mata_pelajaran')) {
                $table->boolean('hide_mata_pelajaran')->default(false)->after('hide_poin');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sesi_ujian', function (Blueprint $table) {
            if (Schema::hasColumn('sesi_ujian', 'hide_mata_pelajaran')) {
                $table->dropColumn('hide_mata_pelajaran');
            }
            if (Schema::hasColumn('sesi_ujian', 'hide_poin')) {
                $table->dropColumn('hide_poin');
            }
            if (Schema::hasColumn('sesi_ujian', 'hide_nomor_urut')) {
                $table->dropColumn('hide_nomor_urut');
            }
        });
    }
};
