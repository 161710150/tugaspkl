<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePinjamkmblsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pinjamkmbls', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Nopjkb',10)->unique();
            $table->integer('id_agt')->unsigned();
            $table->integer('id_buku')->unsigned();
            $table->date('Tglpjm');
            $table->date('Tglharuskbl');
            $table->date('Tglkbl')->nullable();
            $table->double('Denda')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pinjamkmbls');
    }
}
