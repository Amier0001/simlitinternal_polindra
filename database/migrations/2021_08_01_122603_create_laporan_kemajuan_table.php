<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanKemajuanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_kemajuan', function (Blueprint $table) {
            $table->bigIncrements('laporan_kemajuan_id');
            $table->string('laporan_kemajuan_penelitian_id', 64);
            $table->date('laporan_kemajuan_date');
            $table->enum('laporan_kemajuan_tipe', ['kemajuan', 'keuangan']);
            $table->string('laporan_kemajuan_original_name', 255);
            $table->string('laporan_kemajuan_hash_name', 255);
            $table->string('laporan_kemajuan_base_name', 255);
            $table->string('laporan_kemajuan_file_size', 255);
            $table->string('laporan_kemajuan_extension', 50);

            $table->timestamps();

            $table->foreign('laporan_kemajuan_penelitian_id')->references('usulan_penelitian_id')->on('usulan_penelitian')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('laporan_kemajuan', function (Blueprint $table) {
            $table->dropForeign('laporan_kemajuan_laporan_kemajuan_penelitian_id_foreign');
        });
        Schema::dropIfExists('laporan_kemajuan');
    }
}