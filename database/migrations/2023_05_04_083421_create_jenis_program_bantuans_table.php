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
        Schema::create('jenis_program_bantuan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_sasaran_program');
            $table->string('nama_program');
            $table->text('keterangan');
            $table->foreignId('id_asal_dana');
            $table->date('mulai');
            $table->date('berakhir');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_program_bantuans');
    }
};
