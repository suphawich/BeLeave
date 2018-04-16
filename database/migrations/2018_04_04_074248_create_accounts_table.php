<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('full_name');
            $table->string('avatar');
            $table->string('address');
            $table->enum('access_level', [
                'Guest', 'Subordinate', 'Supervisor', 'Administrator'
            ]);
            $table->string('tel');
            $table->string('company_name');
            $table->boolean('is_enabled');
            $table->string('token', 100);
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
        Schema::dropIfExists('accounts');
    }
}
