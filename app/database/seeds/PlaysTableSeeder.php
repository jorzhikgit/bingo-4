<?php

use SedpMis\Bingo\Models\Play;

class PlaysTableSeeder extends Seeder {

	public function run()
	{
		Play::unguard();

		foreach(range(1, count((new PatternsTableSeeder)->patterns())) as $i => $index)
		{
			Play::create([
				'id'      => $i+1,
                'status'  => 'o',
                'numbers' => ''
			]);
		}
	}

}