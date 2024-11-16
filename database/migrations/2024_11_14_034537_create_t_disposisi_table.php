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
        Schema::create('t_disposisi', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_bagian');
            $table->string('isi_disposisi', 200);
            $table->string('sifat', 100);
            $table->set('sifat', ['rahasia','penting','biasa']);
            $table->text('catatan');
            $table->uuid('id_surat_masuk');

            $table->foreign('id_bagian')->references('id')->on('t_bagian');
            $table->foreign('id_surat_masuk')->references('id')->on('t_surat_masuk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_disposisi');
    }
};
