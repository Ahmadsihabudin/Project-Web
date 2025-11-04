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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'last_login_at')) {
                $table->timestamp('last_login_at')->nullable()->after('remember_token');
            }
        });
        
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'login_attempts')) {
                $afterColumn = Schema::hasColumn('users', 'last_login_at') ? 'last_login_at' : 'remember_token';
                $table->unsignedInteger('login_attempts')->default(0)->after($afterColumn);
            }
        });
        
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'locked_until')) {
                $afterColumn = Schema::hasColumn('users', 'login_attempts') ? 'login_attempts' : (Schema::hasColumn('users', 'last_login_at') ? 'last_login_at' : 'remember_token');
                $table->timestamp('locked_until')->nullable()->after($afterColumn);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'locked_until')) {
                $table->dropColumn('locked_until');
            }
            if (Schema::hasColumn('users', 'login_attempts')) {
                $table->dropColumn('login_attempts');
            }
            if (Schema::hasColumn('users', 'last_login_at')) {
                $table->dropColumn('last_login_at');
            }
        });
    }
};
