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
            $table->string('laporan_kemajuan_user_id', 64);
            $table->string('laporan_kemajuan_bidang');
            $table->string('laporan_kemajuan_judul');
            $table->year('laporan_kemajuan_tahun');
            $table->timestamps();

            $table->foreign('laporan_kemajuan_user_id')->references('user_id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
            $table->dropForeign('laporan_kemajuan_laporan_kemajuan_user_id_foreign');
        });
        Schema::dropIfExists('laporan_kemajuan');
    }
}
