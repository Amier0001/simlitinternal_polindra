<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiodataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biodata', function (Blueprint $table) {
            $table->bigIncrements('biodata_id');
            $table->string('biodata_user_id', 64)->unique();
            $table->boolean('biodata_sex')->nullable();
            $table->string('biodata_institusi')->nullable();
            $table->string('biodata_jurusan')->nullable();
            $table->string('biodata_program_studi')->nullable();
            $table->string('biodata_jabatan')->nullable();
            $table->string('biodata_pendidikan')->nullable();
            $table->string('biodata_alamat')->nullable();
            $table->string('biodata_tempat_lahir')->nullable();
            $table->date('biodata_tanggal_lahir')->nullable();
            $table->string('biodata_no_ktp')->nullable();
            $table->string('biodata_no_hp')->nullable();
            $table->string('biodata_no_telp')->nullable();
            $table->string('biodata_web_personal')->nullable();
            $table->string('biodata_scopus_id')->nullable();
            $table->string('biodata_google_schoolar_id')->nullable();
            $table->timestamps();

            $table->foreign('biodata_user_id')->references('user_id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('biodata', function (Blueprint $table) {
            $table->dropForeign('biodata_biodata_user_id_foreign');
        });
        Schema::dropIfExists('biodata');
    }
}
