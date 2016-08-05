<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
			$table->increments('id');
			$table->string('username', 30)->unique();
			$table->string('password', 64);
			$table->string('remember_token', 100);
			$table->string('display_name', 80);
			$table->boolean('status')->default(1);
			$table->boolean('change_password')->default(1);
			$table->tinyInteger('access_level')->default(1);
			$table->timestamps();
			
			$table->engine = 'InnoDb';
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
