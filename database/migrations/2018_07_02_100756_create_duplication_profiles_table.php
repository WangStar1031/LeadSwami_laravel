<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDuplicationProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('duplication_profiles', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('UserId');
            $table->string('Name');
            $table->string('LastName');
            $table->string('Headline');
            $table->string('Location');
            $table->string('Url');
            $table->string('Email')->unique();
            $table->string('ImgUrl');
            $table->string('PhoneNumber');
            $table->string('LastJob');
            $table->string('Twitter');
            $table->string('Site');
            $table->string('Tag');
            $table->tinyInteger('ZapTag');
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
        Schema::table('duplication_profile', function (Blueprint $table) {
            //
        });
    }
}
