<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('UserId');
            $table->string('CompanyName');
            $table->string('TaxVatId');
            $table->string('Country');
            $table->string('ZipCode');
            $table->string('City');
            $table->string('State');
            $table->string('StripeCardNumber');
            $table->date('ExpirationDate');
            $table->string('StripeToken');
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
        Schema::dropIfExists('billing');
    }
}
