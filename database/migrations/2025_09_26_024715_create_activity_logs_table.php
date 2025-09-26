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
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->string('user_type'); // 'admin' atau 'peserta'
            $table->unsignedBigInteger('user_id'); // ID dari users atau peserta
            $table->string('action'); // 'login', 'logout', 'start_exam', 'submit_answer', 'camera_warning', dll
            $table->text('description')->nullable();
            $table->json('metadata')->nullable(); // IP, browser, device info, dll
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->foreignId('id_ujian')->nullable()->constrained('ujian', 'id_ujian')->onDelete('set null');
            $table->timestamps();

            $table->index(['user_type', 'user_id']);
            $table->index(['action', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
