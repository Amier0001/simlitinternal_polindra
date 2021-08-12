<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJenisLuaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenis_luaran', function (Blueprint $table) {
           $table->bigIncrements('jenis_luaran_id');
            $table->unsignedBigInteger('jenis_luaran_kategori_id');

            $table->string('jenis_luaran_label');

            $table->timestamps();

            $table->foreign('jenis_luaran_kategori_id')->references('kategori_luaran_id')->on('kategori_luaran')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jenis_luaran', function (Blueprint $table) {
            $table->dropForeign('jenis_luaran_jenis_luaran_kategori_id_foreign');
        });
        Schema::dropIfExists('jenis_luaran');
    }
}
