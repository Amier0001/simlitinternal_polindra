<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doc_template', function (Blueprint $table) {
            $table->bigIncrements('doc_template_id');
            $table->string('doc_template_label');
            $table->string('doc_template_original_name', 255)->nullable();
            $table->string('doc_template_hash_name', 255)->nullable();
            $table->string('doc_template_base_name', 255)->nullable();
            $table->string('doc_template_size', 255)->nullable();
            $table->string('doc_template_extension', 50)->nullable();
            $table->date('doc_template_date')->nullable();
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
        Schema::dropIfExists('doc_template');
    }
}
