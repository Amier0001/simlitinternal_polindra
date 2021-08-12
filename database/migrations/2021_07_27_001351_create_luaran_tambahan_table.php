<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLuaranTambahanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('luaran_tambahan', function (Blueprint $table) {
            $table->bigIncrements('ususlan_file_id');
            $table->string('usulan_luaran_tambahan_penelitian_id', 64);
            $table->string('usulan_luaran_tambahan_penelitian_file_original_name', 255);
            $table->string('usulan_luaran_tambahan_penelitian_file_hash_name', 255);
            $table->string('usulan_luaran_tambahan_penelitian_file_base_name', 255);
            $table->string('usulan_luaran_tambahan_penelitian_file_file_size', 255);
            $table->string('usulan_luaran_tambahan_penelitian_file_extension', 50);

             $table->timestamps();

             $table->foreign('usulan_luaran_tambahan_penelitian_id')->references('usulan_penelitian_id')->on('usulan_penelitian')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('luaran_tambahan', function (Blueprint $table) {
            $table->dropForeign('luaran_wajib_usulan_luaran_penelitian_id_foreign');
        });
        Schema::dropIfExists('luaran_tambahan');
    }
}
