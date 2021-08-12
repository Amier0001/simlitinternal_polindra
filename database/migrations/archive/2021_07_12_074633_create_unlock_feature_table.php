<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnlockFeatureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unlock_feature', function (Blueprint $table) {
            $table->bigIncrements('unlock_feature_id');
            $table->string('unlock_feature_name');
            $table->year('unlock_feature_start_year')->nullable();
            $table->year('unlock_feature_end_year')->nullable();
            $table->dateTime('unlock_feature_start_time')->nullable();
            $table->dateTime('unlock_feature_end_time')->nullable();
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
        Schema::dropIfExists('unlock_feature');
    }
}
