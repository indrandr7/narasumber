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
        Schema::create('narsums', function (Blueprint $table) {
            $table->id('id_narsum');
            $table->string('nama_narsum', 50);
            $table->string('no_tlp', 20);
            $table->string('nip', 20);
            $table->string('jabatan', 50);
            $table->string('status', 50);
            $table->string('email', 50);
            $table->string('nama_bank', 50);
            $table->string('nama_rek', 50);
            $table->string('no_rek', 50);
            $table->string('npwp', 50);
            $table->string('upload_npwp', 200);
            $table->string('golongan', 50);
            $table->string('unit_kerja', 100);
            $table->string('alamat_unit', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('narsums');
    }
};
