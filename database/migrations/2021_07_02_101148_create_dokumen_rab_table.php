<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokumenRabTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumen_rab', function (Blueprint $table) {
            $table->bigIncrements('dokumen_rab_id');
            $table->string('dokumen_rab_penelitian_id', 64);
            $table->string('dokumen_rab_original_name', 255);
            $table->string('dokumen_rab_hash_name', 255);
            $table->string('dokumen_rab_base_name', 255);
            $table->string('dokumen_rab_file_size', 255);
            $table->string('dokumen_rab_extension', 50);

            $table->timestamps();

            $table->foreign('dokumen_rab_penelitian_id')->references('usulan_penelitian_id')->on('usulan_penelitian')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dokumen_rab', function (Blueprint $table) {
            $table->dropForeign('dokumen_rab_dokumen_rab_penelitian_id_foreign');
        });
        Schema::dropIfExists('dokumen_rab');
    }
}
