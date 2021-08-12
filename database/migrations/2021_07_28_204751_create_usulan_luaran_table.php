<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsulanLuaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usulan_luaran', function (Blueprint $table) {
            $table->bigIncrements('usulan_luaran_id');
            $table->string('usulan_luaran_penelitian_id', 64);
            $table->enum('usulan_luaran_penelitian_tipe', ['wajib', 'tambahan']);
            $table->string('usulan_luaran_penelitian_tahun');
            $table->string('usulan_luaran_penelitian_kategori');
            $table->string('usulan_luaran_penelitian_jenis');
            $table->string('usulan_luaran_penelitian_status');
            $table->string('usulan_luaran_penelitian_rencana');
            $table->timestamps();

            $table->foreign('usulan_luaran_penelitian_id')->references('usulan_penelitian_id')->on('usulan_penelitian')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usulan_luaran', function (Blueprint $table) {
            $table->dropForeign('usulan_luaran_usulan_luaran_penelitian_id_foreign');
        });
        Schema::dropIfExists('usulan_luaran');
    }
}