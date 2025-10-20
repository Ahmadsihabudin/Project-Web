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
      Schema::create('sesi_ujian', function (Blueprint $table) {
         $table->id('id_sesi');
         $table->unsignedBigInteger('id_ujian');
         $table->unsignedBigInteger('id_batch');
         $table->date('tanggal_mulai');
         $table->time('jam_mulai');
         $table->time('jam_selesai');
         $table->date('tanggal_selesai');
         $table->unsignedInteger('durasi_menit');
         $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
         $table->timestamp('created_at')->useCurrent();
         $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

         $table->index(['id_ujian']);
         $table->index(['id_batch']);
         $table->index(['status']);
         $table->index(['tanggal_mulai', 'tanggal_selesai']);
         $table->index(['status', 'tanggal_mulai']);
      });
   }

   /**
    * Reverse the migrations.
    */
   public function down(): void
   {
      Schema::dropIfExists('sesi_ujian');
   }
};
