<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('Id');
            $table->string('Name');
            $table->string('SurName');
            $table->string('Email')->unique();
            $table->string('Password');
            $table->string('AccessTocken');
            $table->string('Industry');
            $table->string('Headline');
            $table->string('Location');
            $table->string('ProfilePicUrl');
            $table->string('PublicUri');
            $table->string('ConnectionCount');
            $table->string('Position');
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
