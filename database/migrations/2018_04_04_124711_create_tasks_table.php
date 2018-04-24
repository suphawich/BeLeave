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
            $table->unsignedinteger('subordinate_id');
            $table->string('task');
            $table->timestamps();

            $table->foreign('subordinate_id')->references('id')->on('users');
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
            $table->dropForeign(['subordinate_id']);
        });
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('tasks');
    }
}
