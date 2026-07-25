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
        Schema::create('penduduk_dokumen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_penduduk');
            $table->foreignId('id_jenis_dokumen');
            $table->string('nama');
            $table->text('file');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penduduk_dokumens');
    }
};
