<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('user_id', 64)->primary()->unique();
            $table->string('user_email', 255);
            $table->string('user_nidn', 10)->nullable()->unique();
            $table->string('user_name', 255);
            $table->string('user_password', 255);
            $table->boolean('user_ban')->default(false);
            // $table->boolean('user_active')->default(true);

            $table->enum('user_role', ['pengusul', 'admin', 'reviewer']);

            $table->string('user_image', 255);

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
        Schema::dropIfExists('users');
    }
}
