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
        Schema::create('anggota_lembaga', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_lembaga');
            $table->foreignId('id_penduduk');
            $table->string('foto')->nullable();
            $table->enum('jabatan',['KETUA','WAKIL KETUA', 'SEKERTARIS', 'BENDAHARA', 'ANGGOTA']);
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota_lembagas');
    }
};
