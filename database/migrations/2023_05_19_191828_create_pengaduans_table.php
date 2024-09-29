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
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();
            $table->string('nomor');
            $table->string('kontak');
            $table->string('nama');
            $table->string('alamatTinggal');
            $table->text('deskripsi');
            $table->text('lokasi');
            $table->longText('gambar1')->nullable();
            $table->longText('gambar2')->nullable();
            $table->longText('gambar3')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduans');
    }
};
