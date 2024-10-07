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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->dateTime('tanggal_order');
            $table->dateTime('tanggal_bayar')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('alamat_id');
            $table->unsignedBigInteger('produk_id');
            $table->integer('qty');
            $table->integer('weight');
            $table->string('courier');
            $table->string('service');
            $table->integer('waktu_kirim');
            $table->integer('ongkos_kirim');
            $table->integer('harga_barang');
            $table->integer('total_harga');
            $table->enum('status_transaksi',['PESAN', 'TERBAYAR', 'SELESAI'])
            ->default('PESAN');
            $table->dateTime('tanggal_terima')->nullable();
            $table->integer('rating')->default(0);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('alamat_id')->references('id')->on('alamats')->onDelete('cascade');
            $table->foreign('produk_id')->references('id')->on('produks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
