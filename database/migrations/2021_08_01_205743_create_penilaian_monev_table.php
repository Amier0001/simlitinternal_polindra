<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianMonevTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian_monev', function (Blueprint $table) {
            $table->bigIncrements('penilaian_monev_id');
            $table->string('penilaian_monev_penelitian_id', 64);

            $table->boolean('penilaian_monev_lock')->default(false);

            // $table->integer('penilaian_monev_urutan')->nullable();
            // $table->string('penilaian_monev_kriteria');

            $table->string('penilaian_monev_status_1')->nullable();
            $table->string('penilaian_monev_status_2')->nullable();
            $table->string('penilaian_monev_status_3')->nullable();
            $table->string('penilaian_monev_status_4')->nullable();
            $table->string('penilaian_monev_status_5')->nullable();
            $table->string('penilaian_monev_status_6')->nullable();
            $table->string('penilaian_monev_status_7')->nullable();
            $table->string('penilaian_monev_status_8')->nullable();
            $table->string('penilaian_monev_status_9')->nullable();

            $table->unsignedFloat('penilaian_monev_skor_1')->nullable();
            $table->unsignedFloat('penilaian_monev_skor_2')->nullable();
            $table->unsignedFloat('penilaian_monev_skor_3')->nullable();
            $table->unsignedFloat('penilaian_monev_skor_4')->nullable();
            $table->unsignedFloat('penilaian_monev_skor_5')->nullable();
            $table->unsignedFloat('penilaian_monev_skor_6')->nullable();
            $table->unsignedFloat('penilaian_monev_skor_7')->nullable();
            $table->unsignedFloat('penilaian_monev_skor_8')->nullable();
            $table->unsignedFloat('penilaian_monev_skor_9')->nullable();

            $table->unsignedFloat('penilaian_monev_nilai_1')->nullable();
            $table->unsignedFloat('penilaian_monev_nilai_2')->nullable();
            $table->unsignedFloat('penilaian_monev_nilai_3')->nullable();
            $table->unsignedFloat('penilaian_monev_nilai_4')->nullable();
            $table->unsignedFloat('penilaian_monev_nilai_5')->nullable();
            $table->unsignedFloat('penilaian_monev_nilai_6')->nullable();
            $table->unsignedFloat('penilaian_monev_nilai_7')->nullable();
            $table->unsignedFloat('penilaian_monev_nilai_8')->nullable();
            $table->unsignedFloat('penilaian_monev_nilai_9')->nullable();

            $table->text('penilaian_monev_komentar')->nullable();

            $table->timestamps();

            $table->foreign('penilaian_monev_penelitian_id')->references('usulan_penelitian_id')->on('usulan_penelitian')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penilaian_monev', function (Blueprint $table) {
            $table->dropForeign('penilaian_monev_penilaian_monev_penelitian_id_foreign');
        });
        Schema::dropIfExists('penilaian_monev');
    }
}
