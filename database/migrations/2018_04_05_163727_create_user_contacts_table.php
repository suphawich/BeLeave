<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_contacts', function (Blueprint $table) {
            $table->unsignedinteger('user_id');
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('line_id')->nullable();
            $table->string('whatapp_id')->nullable();
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
        Schema::table('user_contacts', function(Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('user_contacts');
    }
}
