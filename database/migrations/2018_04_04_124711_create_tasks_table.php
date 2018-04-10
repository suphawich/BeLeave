<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('task');
            $table->string('substitute_task');
            $table->boolean('can_leave');
            $table->boolean('is_left');
            $table->unsignedinteger('leave_id')->nullable();
            $table->timestamps();

            $table->foreign('leave_id')->references('id')->on('leaves');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::enableForeignKeyConstraints();
        Schema::table('tasks', function(Blueprint $table) {
            $table->dropForeign(['leave_id']);
        });
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('tasks');
    }
}
