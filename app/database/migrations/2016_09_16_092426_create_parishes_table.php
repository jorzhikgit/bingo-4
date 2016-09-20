<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateParishesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('parishes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('branch');
			$table->enum('category', ['big', 'small'])->comment('Big or small parish.');
			$table->date('date');
			$table->smallInteger('no_of_members')->unsigned();
			$table->smallInteger('additional_members')->unsigned();
			$table->string('card_ranges')->comment('Format: start_1-end_1,start_2-end_2,...');
			$table->boolean('is_active')->default(0);
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
		Schema::drop('parishes');
	}

}
