<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanKemajuanFileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_kemajuan_file', function (Blueprint $table) {
            $table->bigIncrements('laporan_kemajuan_file_id');
            $table->unsignedBigInteger('laporan_kemajuan_id');
            $table->string('laporan_kemajuna_file_original_name', 255);
            $table->string('laporan_kemajuan_file_hash_name', 255);
            $table->string('laporan_kemajuan_file_base_name', 255);
            $table->string('laporan_kemajuan_file_extension', 50);

            $table->timestamps();

            $table->foreign('laporan_kemajuan_id')->references('laporan_kemajuan_id')->on('laporan_kemajuan')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('laporan_kemajuan_file', function (Blueprint $table) {
            $table->dropForeign('laporan_kemajuan_file_laporan_kemajuan_id_foreign');
        });
        Schema::dropIfExists('laporan_kemajuan_file');
    }
}
