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
        Schema::table('peserta', function (Blueprint $table) {
            // Add session tracking columns
            if (!Schema::hasColumn('peserta', 'current_session_id')) {
                $table->string('current_session_id', 255)->nullable();
            }
            if (!Schema::hasColumn('peserta', 'is_logged_in')) {
                $table->boolean('is_logged_in')->default(false);
            }
            if (!Schema::hasColumn('peserta', 'last_activity_at')) {
                $table->timestamp('last_activity_at')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peserta', function (Blueprint $table) {
            $table->dropColumn(['current_session_id', 'is_logged_in', 'last_activity_at']);
        });
    }
};
