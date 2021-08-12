<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMitraFileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mitra_file', function (Blueprint $table) {
            $table->bigIncrements('mitra_file_id');
            $table->string('mitra_file_mitra_sasaran_id', 64);
            $table->string('mitra_sasaran_file_original_name', 255);
            $table->string('mitra_sasaran_file_hash_name', 255);
            $table->string('mitra_sasaran_file_base_name', 255);
            $table->string('mitra_sasaran_file_file_size', 255);
            $table->string('mitra_sasaran_file_extension', 50);

             $table->timestamps();

            $table->foreign('mitra_file_mitra_sasaran_id')->references('usulan_penelitian_id')->on('usulan_penelitian')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mitra_file', function (Blueprint $table) {
            $table->dropForeign('mitra_file_mitra_file_mitra_sasaran_id_foreign');
        });
        Schema::dropIfExists('mitra_file');
    }
}
