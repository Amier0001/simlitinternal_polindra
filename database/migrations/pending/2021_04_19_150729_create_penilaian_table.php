<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian', function (Blueprint $table) {
            $table->bigIncrements('id_penilaian');
            $table->string('id_reviewer', 64);
            $table->unsignedBigInteger('id_usulan_pengabdian');
            $table->string('file_penilaian', 255);
            $table->float('nilai_1')->nullable();
            $table->float('nilai_2')->nullable();
            $table->float('nilai_3')->nullable();
            $table->float('nilai_4')->nullable();
            $table->float('nilai_5')->nullable();
            $table->text('komentar')->nullable();
            $table->text('alasan_penolakan')->nullable();

            $table->timestamps();

            $table->foreign('id_reviewer')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_usulan_pengabdian')->references('id_usulan_pengabdian')->on('usulan_pengabdian')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penilaian', function (Blueprint $table) {
            $table->dropForeign('penilaian_id_reviewer_foreign');
            $table->dropForeign('penilaian_id_usulan_pengabdian_foreign');
        });
        Schema::dropIfExists('penilaian');
    }
}
