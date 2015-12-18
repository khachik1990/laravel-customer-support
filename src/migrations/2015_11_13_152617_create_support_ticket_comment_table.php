<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupportTicketCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_ticket_comment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('support_ticket_id')->unsigned();
            $table->integer('parent_id')->unsigned()->nullable();
			$table->integer('user_id')->unsigned();
            $table->text('comment');
			$table->string('attached');
            $table->timestamps();
			
			$table->foreign('support_ticket_id')->references('id')->on('support_ticket')->onUpdate('cascade');
			$table->foreign('parent_id')->references('id')->on('support_ticket_comment')->onUpdate('cascade');
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
         Schema::drop('support_ticket_comment');
    }
}
