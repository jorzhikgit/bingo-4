<?php

class DatabaseSeeder extends Seeder {

	private $tables = [
		'users',
		'plays',
		'patterns',
		'parishes',
	];

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->seed();
	}

	private function seed()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');

		foreach ($this->tables as $table) {
			DB::table($table)->truncate();
			$this->call(studly_case($table) . 'TableSeeder');
		}

		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}
}
