<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->bigIncrements('file_id');
            // $table->unsignedBigInteger('content_file_content_id');
            $table->string('file_original_name', 255);
            $table->string('file_hash_name', 255);
            $table->string('file_base_name', 255);
            $table->string('file_extension', 50);

            $table->timestamps();

            // $table->foreign('content_file_content_id')->references('content_id')->on('contents')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
