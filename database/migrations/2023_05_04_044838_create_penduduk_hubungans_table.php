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
        Schema::create('penduduk_hubungan', function (Blueprint $table) {
            //hubungan keluarga seperti: kepala keluarga, suami, istri, dll
            $table->id();
            $table->string('nama');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penduduk_hubungans');
    }
};
