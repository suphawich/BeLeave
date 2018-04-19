<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaves', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedinteger('subordinate_id');
            $table->text('description');
            $table->unsignedinteger('substitute_id')->nullable();
            $table->enum('leave_type', [
                'Vacation', 'Personal Errand', 'Sick'
            ]);
            $table->boolean('is_enabled')->default(true);
            $table->boolean('is_approved')->default(false);
            $table->timestamp('depart_at')->nullable();
            $table->timestamp('arrive_at')->nullable();
            $table->timestamps();

            $table->foreign('subordinate_id')->references('id')->on('accounts');
            $table->foreign('substitute_id')->references('id')->on('accounts');
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
        Schema::table('leaves', function(Blueprint $table) {
            $table->dropForeign(['subordinate_id']);
            $table->dropForeign(['substitute_id']);
        });
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('leaves');
    }
}
