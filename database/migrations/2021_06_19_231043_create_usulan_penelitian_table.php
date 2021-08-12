<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsulanPenelitianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usulan_penelitian', function (Blueprint $table) {
            $table->string('usulan_penelitian_id', 64)->primary()->unique();
            $table->string('usulan_penelitian_reviewer_id', 64)->nullable();
            $table->string('usulan_penelitian_reviewer_monev_id', 64)->nullable();
            $table->string('usulan_penelitian_judul');
            $table->boolean('usulan_penelitian_kategori'); //[Kompetitif Nasional / Desentralisasi]
            $table->bigInteger('usulan_penelitian_skema_id')->unsigned()->nullable();
            $table->bigInteger('usulan_penelitian_bidang_id')->unsigned()->nullable();
            $table->integer('usulan_penelitian_lama_kegiatan');
            $table->integer('usulan_penelitian_mahasiswa_terlibat');
            $table->year('usulan_penelitian_tahun');
            $table->boolean('usulan_penelitian_submit');
            $table->enum('usulan_penelitian_status', ['dikirim', 'diterima', 'ditolak', 'dinilai', 'pending', 'selesai']);
            $table->string('usulan_penelitian_unlock_pass')->nullable();
            // $table->text('usulan_penelitian_komentar')->nullable();

            $table->timestamps();

            $table->foreign('usulan_penelitian_skema_id')->references('skema_id')->on('skema_penelitian')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('usulan_penelitian_bidang_id')->references('bidang_id')->on('bidang_penelitian')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usulan_penelitian', function (Blueprint $table) {
            $table->dropForeign('usulan_penelitian_usulan_penelitian_skema_id_foreign');
            $table->dropForeign('usulan_penelitian_usulan_penelitian_bidang_id_foreign');
        });
        Schema::dropIfExists('usulan_penelitian');
    }
}
