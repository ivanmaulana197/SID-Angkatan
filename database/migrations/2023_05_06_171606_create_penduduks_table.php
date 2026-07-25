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
        Schema::create('penduduk', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('NIK')->unique();
            $table->foreignId('id_kk')->nullable();
            //kk level masih belum tau

            $table->enum('jenisKelamin',['Laki-laki', 'Perempuan']);
            $table->string('tempatLahir');
            $table->date('tanggalLahir');
            $table->foreignId('id_agama')->constrained('agama');

            $table->foreignId('id_pendidikan_kk')->constrained('pendidikan_kk');
            $table->foreignId('id_sedang_pendidikan')->constrained('pendidikan');
            $table->foreignId('id_pekerjaan')->constrained('pekerjaan');
            $table->foreignId('id_status_kawin')->constrained('status_kawin');
            $table->enum('kewarganegaraan',['WNI', 'WNA', 'DUA KEWARGANEGARAAN']);
            
            $table->string('nik_ayah')->nullable();
            $table->string('nama_ayah')->nullable();
            $table->string('nik_ibu')->nullable();
            $table->string('nama_ibu')->nullable();
            
            
            $table->string('foto');
            $table->foreignId('id_golongan_darah')->constrained('golongan_darah');

            $table->enum('statusPenduduk',['Tetap', 'Tidak Tetap']);
            $table->string('alamat_sebelumnya')->nullable();
            $table->string('alamat_sekarang');
            $table->foreignId('id_dusun');
            $table->foreignId('id_rw');
            $table->foreignId('id_rt');
            $table->foreignId('id_usia');
            
            $table->foreignId('id_kondisi')->constrained('penduduk_kondisi'); //di sid status dasar
            
            $table->enum('hamil',['HAMIL', 'Tidak HAMIL'])->nullable();
            $table->foreignId('id_cacat')->constrained('kecacatan');
            $table->foreignId('id_penyakit')->constrained('penyakit');

            $table->string('no_akta_kelahiran')->nullable();
            $table->string('no_akta_perkawinan')->nullable();
            // $table->date('tanggal_perkawinan')->nullable();
            $table->string('no_akta_perceraian')->nullable();
            // $table->date('tanggal_perceraian')->nullable();
            $table->foreignId('created_by');

            $table->foreignId('id_hubungan')->constrained('penduduk_hubungan');
            $table->foreignId('id_asuransi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penduduks');
    }
};
