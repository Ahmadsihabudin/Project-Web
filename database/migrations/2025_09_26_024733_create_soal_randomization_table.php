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
        Schema::create('soal_randomization', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_ujian')->constrained('ujian', 'id_ujian')->onDelete('cascade');
            $table->foreignId('id_peserta')->constrained('peserta', 'id_peserta')->onDelete('cascade');
            $table->json('soal_order'); // Urutan soal yang sudah diacak [1,5,3,2,4]
            $table->json('jawaban_order'); // Urutan jawaban yang sudah diacak per soal
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(['id_ujian', 'id_peserta']);
            $table->index(['id_ujian', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soal_randomization');
    }
};
