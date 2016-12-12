<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use SedpMis\Bingo\Models\Parish;

class ParishesTableSeeder extends Seeder
{
    public function run()
    {
        foreach ($this->parishes() as $parish) {
            Parish::create($parish);
        }
    }

    public function parishes()
    {
        return [
            [
                'name'               => 'DCOLV',
                'branch'             => 'DCOLV',
                'date'               => '2016-12-25',
                'no_of_members'      => '0',
                'additional_members' => '0',
                'card_ranges'        => '1-100000',
                'is_active'          => 1
            ],
        ];
    }
}
