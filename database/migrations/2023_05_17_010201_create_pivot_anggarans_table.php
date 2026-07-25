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
        Schema::create('pivot_anggarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_anggaran_masuk')->constrained('anggaran_masuk');
            $table->foreignId('id_anggaran_keluar')->constrained('anggaran_keluar');
            $table->decimal('jumlah_anggaran',16,0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivot_anggarans');
    }
};
