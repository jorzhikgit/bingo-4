<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWinningPatternsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('winning_patterns', function(Blueprint $table)
		{
			$table->increments('id');
			Fk::make($table)->add('pattern_id');
			Fk::make($table)->add('card_id');
			$table->char('numbers', 255);
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
		Schema::drop('winning_patterns');
	}

}
