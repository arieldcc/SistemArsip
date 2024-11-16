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
        Schema::create('t_surat_masuk', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('no_surat', 25)->unique();
            $table->string('asal_surat', 100);
            $table->text('isi_singkat');
            $table->string('jenis_surat', 100);
            $table->string('perihal_surat', 200);
            $table->date('tgl_surat');
            $table->date('tgl_terima');
            $table->date('tgl_arsip');
            $table->set('status_disposisi', ['y','t']);
            $table->text('keterangan');
            $table->string('file_surat_masuk',200);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_surat_masuk');
    }
};
