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
            $table->bigIncrements('id_usulan_pengabdian');
            $table->unsignedBigInteger('id_skema_pengabdian');
            $table->string('id_ketua', 64);
            $table->string('judul', 255);
            $table->year('tahun_usulan');
            $table->integer('lama_kegiatan')->nullable();
            $table->bigInteger('total_biaya')->nullable();
            $table->integer('target_capaian')->nullable();
            $table->string('file_proposal', 255)->nullable();
            $table->string('file_pendukung', 255)->nullable();
            $table->enum('status_usulan', ['dikirim', 'diterima', 'ditolak']);
            $table->enum('rekomendasi', ['dikirim', 'diterima', 'ditolak']);
            $table->boolean('status_penilaian');
            $table->timestamps();

            $table->foreign('id_skema_pengabdian')->references('id_skema_pengabdian')->on('skema_pengabdian')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usulan_pengabdian', function (Blueprint $table) {
            $table->dropForeign('usulan_pengabdian_id_usulan_pengabdian_foreign');
        });
        Schema::dropIfExists('usulan_pengabdian');
    }
}
