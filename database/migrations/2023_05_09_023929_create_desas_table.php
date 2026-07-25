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
        Schema::create('desa', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('kode')->nullable();
            $table->string('telp');
            $table->string('kecamatan');
            $table->string('kabupaten');
            $table->string('provinsi');
            $table->text('alamat');
            $table->text('logo');
            $table->text('lokasi_desa');
            $table->text('lokasi_kantor_desa');
            $table->foreignId('id_kepala_desa')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desas');
    }
};
