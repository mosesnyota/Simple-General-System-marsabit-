<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('project_id');
            $table->string('project_name');
            $table->string('location');
            $table->Date('start_date');
            $table->Date('deadline');
            $table->Date('completed_on');
            $table->integer('sponsor_id');
            $table->integer('staff_id');
            $table->double('budget');
            $table->string('cur_status');
            $table->text('details');
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
        Schema::dropIfExists('projects');
    }
}
