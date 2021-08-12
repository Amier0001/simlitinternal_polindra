<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCapaianKegiatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('capaian_kegiatan', function (Blueprint $table) {
            $table->bigIncrements('capaian_kegiatan_id');
            $table->unsignedBigInteger('capaian_kegiatan_monev_id');

            // Capaian Kegiatan
            $table->string('mitra_kegiatan')->nullable();
            $table->text('jumlah_mitra')->nullable();
            $table->text('pendidikan_mitra')->nullable();
            $table->string('persoalan_mitra')->nullable();
            $table->string('status_sosial_mitra')->nullable();

            // Lokasi
            $table->string('jarak_lokasi_mitra')->nullable();
            $table->string('sarana_transportasi')->nullable();
            $table->string('sarana_komunikasi')->nullable();

            // Identitas
            // Tim Penelitian Masyarakat
            $table->string('jumlah_dosen')->nullable();
            $table->string('jumlah_mahasiswa')->nullable();
            $table->text('gelar_akademik_tim')->nullable();
            $table->text('gender')->nullable();
            // Aktivitas penelitian masyarakat
            $table->string('metode_pelaksanaan_kegiatan')->nullable();
            $table->string('waktu_efektif_pelaksanaan_kegiatan')->nullable();
            // Evaluasi Kegiatan
            $table->string('keberhasilan')->nullable();
            // Indikator Keberhasilan
            $table->string('keberlanjutan_kegiatan_mitra')->nullable();
            $table->text('kapasitas_produksi')->nullable();
            $table->text('omzet_perbulan')->nullable();
            $table->string('persoalan_masyarakat_mitra')->nullable();

            // Biaya Program
            $table->string('biaya_pnbp')->nullable();
            $table->string('biaya_sumber_lain')->nullable();

            // Likuiditas Dana Program
            $table->text('tahapan_pencairan_dana')->nullable();
            $table->text('jumlah_dana')->nullable();

            // Kontribusi Mitra
            $table->string('peran_serta_mitra')->nullable();
            $table->string('kontribusi_pendanaan')->nullable();
            $table->string('peranan_mitra')->nullable();

            // Keberlanjutan
            $table->string('alasan_kelanjutan_kegiatan')->nullable();

            // Usul penyempurnaan program Penelitian Masyarakat
            $table->string('model_usulan_kegiatan')->nullable();
            $table->string('anggaran_biaya')->nullable();
            $table->string('lain_lain')->nullable();

            // Dokumentasi (Foto kegiatan dan Produk)
            $table->string('kegiatan_yang_dinilai')->nullable();
            $table->string('potret_permasalahan')->nullable();

            // Luaran program Penelitian Masyarakat berupa
            $table->string('jasa')->nullable();
            $table->string('metode')->nullable();
            $table->string('produk')->nullable();
            $table->string('paten')->nullable();
            $table->string('publikasi_artikel')->nullable();
            $table->string('publikasi_media_massa')->nullable();

            $table->timestamps();

            $table->foreign('capaian_kegiatan_monev_id')->references('penilaian_monev_id')->on('penilaian_monev')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('capaian_kegiatan', function (Blueprint $table) {
            $table->dropForeign('capaian_kegiatan_capaian_kegiatan_penelitian_id_foreign');
        });
        Schema::dropIfExists('capaian_kegiatan');
    }
}
