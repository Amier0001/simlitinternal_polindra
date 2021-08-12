<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prodi', function (Blueprint $table) {
            $table->bigIncrements('prodi_id');
            $table->unsignedBigInteger('prodi_jurusan_id');
            $table->string('prodi_nama', 255);

            $table->timestamps();

            $table->foreign('prodi_jurusan_id')->references('jurusan_id')->on('jurusan')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prodi', function (Blueprint $table) {
            $table->dropForeign('prodi_prodi_jurusan_id_foreign');
        });
        Schema::dropIfExists('prodi');
    }
}
