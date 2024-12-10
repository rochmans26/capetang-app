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
        Schema::create('pivot_transaksi_tukar_poin_item', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_transaksi')->nullable();
            $table->foreign('id_transaksi')
                ->references('id')
                ->on('transaksi_tukar_poin')
                ->onDelete('set null')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('id_item')->nullable();
            $table->foreign('id_item')
                ->references('id')
                ->on('item')
                ->onDelete('set null')
                ->onUpdate('cascade');
            $table->integer('jumlah_item');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivot_transaksi_tukar_poin_item');
    }
};
