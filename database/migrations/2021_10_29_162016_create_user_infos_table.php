<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_infos', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('name');
            $table->dateTime('dob');
            $table->integer('yob');
            $table->integer('mob');
            $table->string('phone');
            $table->string('ip');
            $table->string('country');
            $table->timestamps();

            $table->index(['dob', 'yob', 'mob']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_infos');
    }
}
