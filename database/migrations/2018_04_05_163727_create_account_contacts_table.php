<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_contacts', function (Blueprint $table) {
            $table->unsignedinteger('account_id');
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('line_id')->nullable();
            $table->string('whatapp_id')->nullable();
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
        Schema::table('account_contacts', function(Blueprint $table) {
            $table->dropForeign(['account_id']);
        });
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('account_contacts');
    }
}
