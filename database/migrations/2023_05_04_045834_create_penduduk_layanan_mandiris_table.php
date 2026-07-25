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
        Schema::create('penduduk_layanan_mandiri', function (Blueprint $table) {
            $table->id();
            $table->integer('pin');
            $table->foreignId('id_penduduk');
            $table->dateTime('terakhir_login')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penduduk_layanan_mandiris');
    }
};
