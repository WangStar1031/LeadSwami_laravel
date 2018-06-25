<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillhistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billhistory', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('UserId');
            $table->date('BillDate');
            $table->string('Description');
            $table->double('Amount', 8, 2);
            $table->date('ExpDate');
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
        Schema::dropIfExists('billhistory');
    }
}
