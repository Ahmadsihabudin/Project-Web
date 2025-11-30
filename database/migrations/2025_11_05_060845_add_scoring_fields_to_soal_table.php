<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('soal', function (Blueprint $table) {
            // Jenis penilaian: normal atau pengurangan poin
            if (!Schema::hasColumn('soal', 'jenis_penilaian')) {
                $table->enum('jenis_penilaian', ['normal', 'pengurangan_poin'])->default('normal')->after('poin')->comment('Jenis sistem penilaian: normal (tidak mengurangi poin) atau pengurangan_poin (mengurangi poin jika salah)');
            }

            // Poin saat jawaban benar (optional, jika NULL gunakan poin)
            if (!Schema::hasColumn('soal', 'poin_benar')) {
                $table->integer('poin_benar')->nullable()->after('jenis_penilaian')->comment('Poin yang didapat jika jawaban benar. Jika NULL, gunakan kolom poin');
            }

            // Poin saat jawaban salah (default 0 untuk normal, bisa negatif untuk pengurangan)
            if (!Schema::hasColumn('soal', 'poin_salah')) {
                $table->integer('poin_salah')->default(0)->after('poin_benar')->comment('Poin yang didapat jika jawaban salah. 0 untuk normal, negatif untuk pengurangan poin');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('soal', function (Blueprint $table) {
            $table->dropColumn(['jenis_penilaian', 'poin_benar', 'poin_salah']);
        });
    }
};
