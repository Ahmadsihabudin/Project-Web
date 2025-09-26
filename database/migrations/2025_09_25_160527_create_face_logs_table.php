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
        Schema::create('face_logs', function (Blueprint $table) {
            $table->id('id_face_log');
            $table->foreignId('id_peserta')->constrained('peserta', 'id_peserta')->onDelete('cascade');
            $table->foreignId('id_ujian')->constrained('ujian', 'id_ujian')->onDelete('cascade');
            $table->integer('jumlah_orang')->default(1);
            $table->integer('peringatan_ke')->default(0);
            $table->timestamp('detected_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('face_logs');
    }
};
