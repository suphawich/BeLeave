<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_settings', function (Blueprint $table) {
            $table->unsignedinteger('account_id');
            $table->boolean('is_r2sup')->default(false);
            $table->boolean('r2sup')->default(false);
            $table->timestamps();

            $table->primary('account_id');
            $table->foreign('account_id')->references('id')->on('accounts');
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
        Schema::table('account_settings', function(Blueprint $table) {
            $table->dropForeign(['account_id']);
        });
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('account_settings');
    }
}
