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
        Schema::create('t_surat_keluar', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('no_surat', 25)->unique();
            $table->uuid('id_bagian');
            $table->string('tujuan_surat', 200);
            $table->string('isi_singkat', 200);
            $table->string('jenis_surat', 100);
            $table->string('perihal_surat', 200);
            $table->date('tgl_surat');
            $table->date('tgl_terima');
            $table->date('tgl_arsip');
            $table->text('keterangan');
            $table->string('file_surat_keluar',200);

            $table->foreign('id_bagian')->references('id')->on('t_bagian');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_surat_keluar');
    }
};
