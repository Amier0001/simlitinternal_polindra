<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsulanPengabdianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usulan_pengabdian', function (Blueprint $table) {
            $table->bigIncrements('pengabdian_id');
            $table->string('pengabdian_judul');
            $table->string('pengabdian_skema');
            $table->string('pengabdian_bidang');
            $table->bigInteger('pengabdian_lama_kegiatan')->unsigned();
            $table->integer('pengabdian_mahasiswa_terlibat')->unsigned();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usulan_pengabdian');
    }
}
