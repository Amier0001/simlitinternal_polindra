<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMitraSasaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mitra_sasaran', function (Blueprint $table) {
            $table->bigIncrements('mitra_sasaran_id');
            $table->string('mitra_sasaran_penelitian_id', 64);
            $table->enum('mitra_sasaran_tipe_mitra', ['kelompok_masyarakat', 'umkm']);
            $table->string('mitra_sasaran_jenis_mitra');
            $table->string('mitra_sasaran_nama_pimpinan_mitra');
            $table->string('mitra_sasaran_jabatan_pimpinan_mitra');
            $table->string('mitra_sasaran_nama_mitra');
            $table->string('mitra_sasaran_alamat_mitra');
            $table->string('mitra_sasaran_provinsi_mitra');
            $table->string('mitra_sasaran_kota_mitra');
            $table->string('mitra_sasaran_kecamatan_mitra');
            $table->string('mitra_sasaran_desa_mitra');
            $table->string('mitra_sasaran_jarak_mitra');
            $table->text('mitra_sasaran_bidang_masalah_mitra');
            $table->string('mitra_sasaran_kontribusi_pendanaan_mitra')->nullable();

            $table->timestamps();

            $table->foreign('mitra_sasaran_penelitian_id')->references('usulan_penelitian_id')->on('usulan_penelitian')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mitra_sasaran', function (Blueprint $table) {
            $table->dropForeign('mitra_sasaran_mitra_sasaran_penelitian_id_foreign');
        });
        Schema::dropIfExists('mitra_sasaran');
    }
}
