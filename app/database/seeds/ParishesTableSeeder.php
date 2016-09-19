<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

use SedpMis\Bingo\Models\Parish;

class ParishesTableSeeder extends Seeder
{
	public function run()
	{
		$fake = Faker::create();

		foreach(range(1, 10) as $index)
		{
			Parish::create([
                'name'        => join(' ', $fake->words()),
                'branch_no'   => $fake->randomNumber(),
                'card_ranges' => join(' ', $fake->words())
			]);
		}
	}

}