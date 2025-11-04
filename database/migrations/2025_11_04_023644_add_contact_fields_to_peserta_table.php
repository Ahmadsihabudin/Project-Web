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
            if (!Schema::hasColumn('peserta', 'no_hp')) {
                $table->string('no_hp', 20)->nullable()->after('email');
            }
            if (!Schema::hasColumn('peserta', 'nik')) {
                $table->string('nik', 16)->nullable()->after('no_hp');
            }
            if (!Schema::hasColumn('peserta', 'kota_kabupaten')) {
                $table->string('kota_kabupaten', 100)->nullable()->after('jurusan');
            }
            if (!Schema::hasColumn('peserta', 'provinsi')) {
                $table->string('provinsi', 100)->nullable()->after('kota_kabupaten');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peserta', function (Blueprint $table) {
            if (Schema::hasColumn('peserta', 'provinsi')) {
                $table->dropColumn('provinsi');
            }
            if (Schema::hasColumn('peserta', 'kota_kabupaten')) {
                $table->dropColumn('kota_kabupaten');
            }
            if (Schema::hasColumn('peserta', 'nik')) {
                $table->dropColumn('nik');
            }
            if (Schema::hasColumn('peserta', 'no_hp')) {
                $table->dropColumn('no_hp');
            }
        });
    }
};
