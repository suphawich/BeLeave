<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('full_name');
            $table->string('avatar')->default('/images/profiles/user.png');
            $table->string('address')->nullable();
            $table->enum('access_level', [
                'Guest', 'Subordinate', 'Supervisor', 'Manager','Administrator'
            ]);
            $table->string('tel');
            $table->string('company_name');
            $table->boolean('is_enabled')->default(true);
            $table->string('token', 100);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
