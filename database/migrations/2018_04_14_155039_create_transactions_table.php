<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedinteger('supervisor_id');
            $table->unsignedinteger('plan_id');
            $table->enum('payment_type', [
                'Credit Card', 'Paypal'
            ]);
            $table->timestamps();

            $table->foreign('supervisor_id')->references('id')->on('users');
            $table->foreign('plan_id')->references('id')->on('plans');
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
        Schema::table('transactions', function(Blueprint $table) {
            $table->dropForeign(['supervisor_id']);
            $table->dropForeign(['plan_id']);
        });
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('transactions');
    }
}
