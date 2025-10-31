<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('peserta', function (Blueprint $table) {
            if (!Schema::hasColumn('peserta', 'login_attempts')) {
                $table->integer('login_attempts')->default(0)->after('updated_at');
            }
            if (!Schema::hasColumn('peserta', 'locked_until')) {
                $table->timestamp('locked_until')->nullable()->after('login_attempts');
            }
            if (!Schema::hasColumn('peserta', 'current_session_id')) {
                $table->string('current_session_id', 255)->nullable()->after('locked_until');
            }
            if (!Schema::hasColumn('peserta', 'is_logged_in')) {
                $table->boolean('is_logged_in')->default(false)->after('current_session_id');
            }
            if (!Schema::hasColumn('peserta', 'last_activity_at')) {
                $table->timestamp('last_activity_at')->nullable()->after('is_logged_in');
            }
            if (!Schema::hasColumn('peserta', 'last_login_at')) {
                $table->timestamp('last_login_at')->nullable()->after('last_activity_at');
            }
            if (!Schema::hasColumn('peserta', 'remember_token')) {
                $table->string('remember_token', 100)->nullable()->after('last_login_at');
            }
        });
    }

    public function down(): void
    {
        Schema::table('peserta', function (Blueprint $table) {
            if (Schema::hasColumn('peserta', 'remember_token')) {
                $table->dropColumn('remember_token');
            }
            if (Schema::hasColumn('peserta', 'last_login_at')) {
                $table->dropColumn('last_login_at');
            }
            if (Schema::hasColumn('peserta', 'last_activity_at')) {
                $table->dropColumn('last_activity_at');
            }
            if (Schema::hasColumn('peserta', 'is_logged_in')) {
                $table->dropColumn('is_logged_in');
            }
            if (Schema::hasColumn('peserta', 'current_session_id')) {
                $table->dropColumn('current_session_id');
            }
            if (Schema::hasColumn('peserta', 'locked_until')) {
                $table->dropColumn('locked_until');
            }
            if (Schema::hasColumn('peserta', 'login_attempts')) {
                $table->dropColumn('login_attempts');
            }
        });
    }
};


