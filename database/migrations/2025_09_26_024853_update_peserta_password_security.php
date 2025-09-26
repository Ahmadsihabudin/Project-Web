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
        // Update peserta table - ganti password plain text dengan hash
        Schema::table('peserta', function (Blueprint $table) {
            $table->dropColumn('password');
        });

        Schema::table('peserta', function (Blueprint $table) {
            $table->string('password_hash')->after('kode_peserta');
            $table->timestamp('last_login_at')->nullable();
            $table->integer('login_attempts')->default(0);
            $table->timestamp('locked_until')->nullable();
            $table->string('remember_token')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peserta', function (Blueprint $table) {
            $table->dropColumn(['password_hash', 'last_login_at', 'login_attempts', 'locked_until', 'remember_token']);
        });

        Schema::table('peserta', function (Blueprint $table) {
            $table->string('password')->after('kode_peserta');
        });
    }
};
