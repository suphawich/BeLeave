<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedinteger('supervisor_id');
            $table->unsignedinteger('subordinate_id');
            $table->timestamps();

            $table->foreign('supervisor_id')->references('id')->on('users');
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
        Schema::table('departments', function(Blueprint $table) {
            $table->dropForeign(['supervisor_id']);
            $table->dropForeign(['subordinate_id']);
        });
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('departments');
    }
}
