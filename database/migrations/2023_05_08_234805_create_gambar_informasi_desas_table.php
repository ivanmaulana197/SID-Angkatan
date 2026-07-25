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
        Schema::create('gambar_informasi_desa', function (Blueprint $table) {
            $table->id();
            $table->text('path');
            $table->text('url');
            $table->foreignId('id_informasi_desa')->constrained('informasi_desa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gambar_informasi_desas');
    }
};
