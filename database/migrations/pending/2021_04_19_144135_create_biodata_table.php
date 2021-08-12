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
            $table->bigIncrements('id_biodata');
            $table->string('id_user', 64);
            $table->boolean('jenis_kelamin');
            $table->string('perguruan_tinggi', 255);
            $table->string('program_studi', 255);
            $table->string('jabatan', 255);
            $table->string('tempat_lahir', 255);
            $table->date('tanggal_lahir');
            $table->string('no_telp', 50)->nullable();
            $table->string('web_personal', 255)->nullable();
            $table->text('alamat');
            $table->string('foto', 255);

            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
            $table->dropForeign('biodata_id_user_foreign');
        });
        Schema::dropIfExists('biodata');
    }
}
