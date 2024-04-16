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
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->increments('id_kegiatan');
            $table->string('biro', 50);
            $table->string('bagian', 50);
            $table->string('program', 50);
            $table->string('kode_mak', 50);
            $table->string('kegiatan_mak', 200);
            $table->integer('ta');
            $table->string('nama_kegiatan', 200);
            $table->string('no_und', 50);
            $table->date('tanggal');
            $table->string('lokasi', 50);
            $table->time('waktu');
            $table->string('maksud', 50);
            $table->string('nama_narsum', 50);
            $table->tinyInteger('jml_jam');
            $table->string('golongan', 50);
            $table->string('eselon', 50);
            $table->integer('pajak');
            $table->string('f_und', 200);
            $table->string('f_lapkeg', 200);
            $table->string('f_st', 200);
            $table->integer('status_input');
            $table->integer('status_trf');
            $table->integer('status_verif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatans');
    }
};
