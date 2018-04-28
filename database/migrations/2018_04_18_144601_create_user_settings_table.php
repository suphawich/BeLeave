<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_settings', function (Blueprint $table) {
            $table->unsignedinteger('user_id');
            $table->boolean('is_r2sup')->default(false);
            $table->boolean('r2sup')->default(false);
            $table->timestamps();

            $table->primary('user_id');
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
        Schema::table('user_settings', function(Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('user_settings');
    }
}
