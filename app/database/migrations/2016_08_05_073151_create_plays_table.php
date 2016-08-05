<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlaysTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('plays', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('numbers')->default('')->comment('Picked or drawn numbers. Comma separated numbers');
			$table->enum('status', ['o', 'c'])->default('o')->comment('Open, Closed');
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
		Schema::drop('plays');
	}

}
