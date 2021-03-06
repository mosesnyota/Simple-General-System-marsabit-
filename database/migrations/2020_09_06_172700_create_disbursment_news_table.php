<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisbursmentNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disbursment_news', function (Blueprint $table) {
            $table->increments('disbursment_id');
            $table->integer('votehead_id');
            $table->integer('project_id');
            $table->string('voucherno')->nullable();
            $table->date('voucherdate');
            $table->string('chequeno')->nullable();
            $table->string('narration');
            $table->string('paid_to');
            $table->double('debit')->default("0");
            $table->double('credit')->default("0");
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
        Schema::dropIfExists('disbursment_news');
    }
}
