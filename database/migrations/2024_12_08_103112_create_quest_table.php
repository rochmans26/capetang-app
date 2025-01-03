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
        Schema::create('quest', function (Blueprint $table) {
            $table->id();
            $table->string('nama_quest');
            $table->string('deskripsi')->nullable();
            $table->dateTime('waktu_mulai');
            $table->dateTime('waktu_berakhir');
            $table->string('point')->nullable();
            $table->string('gambar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quest');
    }
};
