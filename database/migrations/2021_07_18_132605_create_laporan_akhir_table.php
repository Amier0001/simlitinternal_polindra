<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanAkhirTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_akhir', function (Blueprint $table) {
            $table->bigIncrements('laporan_akhir_id');
            $table->string('laporan_akhir_penelitian_id', 64);
            $table->date('laporan_akhir_date');
            $table->string('laporan_akhir_original_name', 255);
            $table->string('laporan_akhir_hash_name', 255);
            $table->string('laporan_akhir_base_name', 255);
            $table->string('laporan_akhir_file_size', 255);
            $table->string('laporan_akhir_extension', 50);

            $table->timestamps();

            $table->foreign('laporan_akhir_penelitian_id')->references('usulan_penelitian_id')->on('usulan_penelitian')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('laporan_akhir', function (Blueprint $table) {
            $table->dropForeign('laporan_akhir_laporan_akhir_penelitian_id_foreign');
        });
        Schema::dropIfExists('laporan_akhir');
    }
}
