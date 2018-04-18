<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupervisorDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supervisor_details', function (Blueprint $table) {
            $table->unsignedinteger('supervisor_id');
            $table->integer('subordinate_amount');
            $table->integer('subordinate_capacity');
            $table->string('link_create_subordinate');
            $table->boolean('is_api');
            $table->boolean('is_line_noti');
            $table->timestamps();

            $table->primary('supervisor_id');
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
        Schema::table('supervisor_details', function(Blueprint $table) {
            $table->dropForeign(['supervisor_id']);
        });
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('supervisor_details');
    }
}
