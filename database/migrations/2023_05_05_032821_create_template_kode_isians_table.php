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
        Schema::create('template_kode_isian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_template_kategori_kode_isian');
            $table->string('nama');
            $table->string('isian');
            //datanya nanti ditambahkan di controller dengan parsing parameter value yang diperlukan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('template_kode_isians');
    }
};
