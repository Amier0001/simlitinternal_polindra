<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokumenUsulanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumen_usulan', function (Blueprint $table) {
            $table->bigIncrements('dokumen_usulan_id');
            $table->string('dokumen_usulan_penelitian_id', 64);
            $table->string('dokumen_usulan_original_name', 255);
            $table->string('dokumen_usulan_hash_name', 255);
            $table->string('dokumen_usulan_base_name', 255);
            $table->string('dokumen_usulan_file_size', 255);
            $table->string('dokumen_usulan_extension', 50);

            $table->timestamps();

            $table->foreign('dokumen_usulan_penelitian_id')->references('usulan_penelitian_id')->on('usulan_penelitian')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dokumen_usulan', function (Blueprint $table) {
            $table->dropForeign('dokumen_usulan_dokumen_usulan_penelitian_id_foreign');
        });
        Schema::dropIfExists('dokumen_usulan');
    }
}
