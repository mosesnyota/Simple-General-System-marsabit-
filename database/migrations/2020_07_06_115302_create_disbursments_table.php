<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisbursmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disbursments', function (Blueprint $table) {
            $table->increments('disbursment_id');
            $table->integer('votehead_id');
            $table->integer('project_id');
            $table->string('reference');
            $table->double('disbursment_amount');
            $table->date('disbursment_date');
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
        Schema::dropIfExists('disbursments');
    }
}
