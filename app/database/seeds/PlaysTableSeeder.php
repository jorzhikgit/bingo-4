<?php

use SedpMis\Bingo\Models\Play;

class PlaysTableSeeder extends Seeder {

	public function run()
	{
		foreach(range(1, count((new PatternsTableSeeder)->patterns())) as $index)
		{
			Play::create([
                'status' => 'o',
                'numbers' => ''
			]);
		}
	}

}