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
        Schema::create('jawaban', function (Blueprint $table) {
            $table->id('id_jawaban');
            $table->foreignId('id_ujian')->constrained('ujian', 'id_ujian')->onDelete('cascade');
            $table->foreignId('id_peserta')->constrained('peserta', 'id_peserta')->onDelete('cascade');
            $table->foreignId('id_soal')->constrained('soal', 'id_soal')->onDelete('cascade');
            $table->string('jawaban_dipilih')->nullable();
            $table->enum('status', ['benar', 'salah', 'pending'])->default('pending');
            $table->decimal('nilai_essay', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawaban');
    }
};
