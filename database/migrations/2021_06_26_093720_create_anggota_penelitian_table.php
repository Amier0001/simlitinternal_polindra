<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggotaPenelitianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggota_penelitian', function (Blueprint $table) {
            $table->bigIncrements('anggota_penelitian_id');
            $table->string('anggota_penelitian_user_id', 64);
            $table->string('anggota_penelitian_penelitian_id', 64);
            $table->enum('anggota_penelitian_role', ['ketua', 'anggota']);
            $table->unsignedInteger('anggota_penelitian_role_position');
            $table->text('anggota_penelitian_tugas')->nullable();

            $table->timestamps();

            $table->foreign('anggota_penelitian_user_id')->references('user_id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('anggota_penelitian_penelitian_id')->references('usulan_penelitian_id')->on('usulan_penelitian')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('anggota_penelitian', function (Blueprint $table) {
            $table->dropForeign('anggota_penelitian_anggota_penelitian_user_id_foreign');
            $table->dropForeign('anggota_penelitian_anggota_penelitian_penelitian_id_foreign');
        });
        Schema::dropIfExists('anggota_penelitian');
    }
}
