<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogbookBerkasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logbook_berkas', function (Blueprint $table) {
            $table->bigIncrements('logbook_berkas_id');
            $table->string('logbook_berkas_penelitian_id', 64);
            $table->date('logbook_berkas_date');
            $table->string('logbook_berkas_keterangan');
            $table->string('logbook_berkas_original_name', 255);
            $table->string('logbook_berkas_hash_name', 255);
            $table->string('logbook_berkas_base_name', 255);
            $table->string('logbook_berkas_file_size', 255);
            $table->string('logbook_berkas_extension', 50);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logbook_berkas');
    }
}
