<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusLuaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_luaran', function (Blueprint $table) {
            $table->bigIncrements('status_luaran_id');
            $table->unsignedBigInteger('status_luaran_kategori_id');

            $table->string('status_luaran_label');

            $table->timestamps();

            $table->foreign('status_luaran_kategori_id')->references('kategori_luaran_id')->on('kategori_luaran')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('status_luaran', function (Blueprint $table) {
            $table->dropForeign('status_luaran_status_luaran_kategori_id_foreign');
        });
        Schema::dropIfExists('status_luaran');
    }
}
