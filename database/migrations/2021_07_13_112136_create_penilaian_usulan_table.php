<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianUsulanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian_usulan', function (Blueprint $table) {
            $table->bigIncrements('penilaian_usulan_id');
            $table->string('penilaian_usulan_penelitian_id', 64);
            $table->boolean('penilaian_usulan_lock')->default(false);
            $table->text('penilaian_usulan_komentar')->nullable();
            $table->integer('penilaian_usulan_nilai_1');
            $table->integer('penilaian_usulan_nilai_2');
            $table->integer('penilaian_usulan_nilai_3');
            $table->integer('penilaian_usulan_nilai_4');
            $table->integer('penilaian_usulan_nilai_5');
            $table->integer('penilaian_usulan_nilai_6');
            $table->timestamps();

            $table->foreign('penilaian_usulan_penelitian_id')->references('usulan_penelitian_id')->on('usulan_penelitian')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penilaian_usulan', function (Blueprint $table) {
            $table->dropForeign('penilaian_usulan_penilaian_usulan_penelitian_id_foreign');
        });
        Schema::dropIfExists('penilaian_usulan');
    }
}
