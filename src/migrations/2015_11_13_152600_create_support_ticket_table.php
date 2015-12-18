<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupportTicketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_ticket', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subject');
			$table->text('message');
			$table->integer('user_id')->unsigned();
            $table->enum("status", array('pending','waiting_reply','solved'))->default('pending');
			$table->string('attached');
			$table->dateTime('last_activity');
            $table->timestamps();
			
			$table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('support_ticket');
    }
}
