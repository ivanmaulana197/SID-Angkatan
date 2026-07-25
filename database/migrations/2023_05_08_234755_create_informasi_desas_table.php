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
        Schema::create('informasi_desa', function (Blueprint $table) {
            $table->id();
            $table->string('judul')->unique();
            $table->string('slug')->unique();
            $table->foreignId('id_user')->constrained('users');
            $table->foreignId('id_kategori')->constrained('kategori_informasi_desa');
            $table->longText('isi_informasi_desa');
            $table->enum('status', ['PUBLISHED', 'DRAFT', 'ARCHIVED'])->default('DRAFT');
            $table->integer('like')->default(0);
            $table->integer('diakses')->default(0);
            //multiple image
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informasi_desas');
    }
};
