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
        Schema::create('permohonan_surat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_penduduk');
            $table->foreignId('id_jenis_surat');
            $table->text('keterangan');
            $table->enum('status',['Menunggu Verifikasi', 'Menunggu File Surat','Selesai','Gagal Terverifikasi']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonan_surats');
    }
};
