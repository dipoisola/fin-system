<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transactions', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('sender')->nullable();
            $table->integer('receiver_id')->unsigned();
            $table->string('receiver_name')->nullable();
            $table->integer('amount')->unsigned();
            $table->string('bank_name')->nullable();
            $table->integer('acc_no')->unsigned();
            $table->integer('transaction_type')->unsigned();
			$table->timestamps();
			
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('transactions');
	}

}
