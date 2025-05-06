<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamanTable extends Migration
{
    public function up()
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_anggota'); 
            $table->date('tanggal_pinjam');
            $table->integer('jumlah_pinjam');
            $table->string('status');
            $table->timestamps();
            $table->foreign('id_anggota')->references('id')->on('anggota')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('peminjaman');
    }
}
