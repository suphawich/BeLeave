<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupervisorPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supervisor_plans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedinteger('supervisor_id');
            $table->string('plan');
            $table->dateTime('exprie_plan');
            $table->timestamps();

            $table->foreign('supervisor_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supervisor_plans');
    }
}
