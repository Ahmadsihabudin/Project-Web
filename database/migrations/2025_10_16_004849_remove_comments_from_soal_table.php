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
            // Remove comments from table fields by modifying them
            $table->string('id_peserta')->nullable()->comment('')->change();
            $table->string('batch')->nullable()->comment('')->change();
            $table->string('opsi_e')->nullable()->comment('')->change();
            $table->string('opsi_f')->nullable()->comment('')->change();
            $table->text('umpan_balik')->nullable()->comment('')->change();
            $table->string('kategori')->nullable()->comment('')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('soal', function (Blueprint $table) {
            //
        });
    }
};
