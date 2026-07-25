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
        Schema::create('penduduk_kartu_keluarga', function (Blueprint $table) {
            $table->id();
            $table->string('no_kk')->unique();
            $table->foreignId('id_penduduk')->nullable(); //nomor nik kepala keluarga
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penduduk_kartu_keluargas');
    }
};
