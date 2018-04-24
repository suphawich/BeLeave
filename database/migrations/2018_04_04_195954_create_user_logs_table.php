<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedinteger('user_id');
            $table->enum('action_type', [
                'Login', 'Logout'
            ]);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::table('user_logs', function(Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('user_logs');
    }
}
