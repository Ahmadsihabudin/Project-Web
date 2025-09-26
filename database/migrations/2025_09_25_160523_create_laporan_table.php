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
        Schema::create('laporan', function (Blueprint $table) {
            $table->id('id_laporan');
            $table->foreignId('id_ujian')->constrained('ujian', 'id_ujian')->onDelete('cascade');
            $table->foreignId('id_peserta')->constrained('peserta', 'id_peserta')->onDelete('cascade');
            $table->decimal('total_score', 5, 2)->default(0);
            $table->integer('jumlah_benar')->default(0);
            $table->integer('waktu_pengerjaan')->default(0); // dalam menit
            $table->enum('status_submit', ['manual', 'cheat', 'auto_submit'])->default('manual');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};
