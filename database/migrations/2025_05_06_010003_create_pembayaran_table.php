<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaranTable extends Migration
{
    public function up()
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_peminjaman'); // Foreign key dari tabel peminjaman
            $table->integer('jumlah_pembayaran');
            $table->date('tanggal_bayar');
            $table->timestamps();

            // Menambahkan foreign key constraint
            $table->foreign('id_peminjaman')->references('id')->on('peminjaman')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pembayaran');
    }
}
