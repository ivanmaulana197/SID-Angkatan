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
        Schema::create('syarat_surat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_jenis_surat')->constrained('jenis_surat');
            $table->foreignId('id_jenis_dokumen')->constrained('jenis_dokumen');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('syarat_surats');
    }
};
