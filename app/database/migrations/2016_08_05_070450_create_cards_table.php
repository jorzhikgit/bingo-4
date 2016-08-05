<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCardsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cards', function(Blueprint $table)
		{
			$table->increments('id');
			$table->char('b', 20)->comment('Comma separated numbers');
			$table->char('i', 20)->comment('Comma separated numbers');
			$table->char('n', 20)->comment('Comma separated numbers');
			$table->char('g', 20)->comment('Comma separated numbers');
			$table->char('o', 20)->comment('Comma separated numbers');
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
		Schema::drop('cards');
	}

}
