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
            $table->enum('payment_type', [
                'Bank', 'Credit Card', 'Paypal'
            ]);
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();

            $table->foreign('supervisor_id')->references('id')->on('accounts');
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
        });
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('transactions');
    }
}
