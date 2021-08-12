<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tema', function (Blueprint $table) {
            $table->bigIncrements('id_tema');
            $table->unsignedBigInteger('id_bidang');
            $table->string('nama_tema', 255);

            $table->timestamps();

            $table->foreign('id_bidang')->references('id_bidang')->on('bidang')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tema', function (Blueprint $table) {
            $table->dropForeign('tema_id_bidang_foreign');
        });
        Schema::dropIfExists('tema');
    }
}
