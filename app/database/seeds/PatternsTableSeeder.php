<?php

use SedpMis\Bingo\Models\Pattern;
use SedpMis\Bingo\Models\Play;

class PatternsTableSeeder extends Seeder
{
    public function patterns()
    {
        $patterns = [
            [
                'name' => 'S Bingo',
                'plots' => [
                    'b' => '',
                    'i' => '0124',
                    'n' => '04',
                    'g' => '0234',
                    'o' => ''
                ]
            ],[
                'name' => 'E Bingo',
                'plots' => [
                    'b' => '',
                    'i' => '*',
                    'n' => '04',
                    'g' => '024',
                    'o' => ''
                ]
            ],[
                'name' => 'D Bingo',
                'plots' => [
                    'b' => '',
                    'i' => '*',
                    'n' => '04',
                    'g' => '123',
                    'o' => ''
                ]
            ],[
                'name' => 'P Bingo',
                'plots' => [
                    'b' => '',
                    'i' => '*',
                    'n' => '03',
                    'g' => '12',
                    'o' => ''
                ]
            ],[
                'name' => 'L Bingo',
                'plots' => [
                    'b' => '',
                    'i' => '*',
                    'n' => '4',
                    'g' => '4',
                    'o' => ''
                ]
            ],[
                'name' => 'S & E Bingo',
                'plots' => [
                    'b' => '*',
                    'i' => '*',
                    'n' => '',
                    'g' => '',
                    'o' => ''
                ]
            ],[
                'name' => 'S & D Bingo',
                'plots' => [
                    'b' => '*',
                    'i' => '',
                    'n' => '*',
                    'g' => '',
                    'o' => ''
                ]
            ],[
                'name' => 'S & P Bingo',
                'plots' => [
                    'b' => '*',
                    'i' => '',
                    'n' => '',
                    'g' => '*',
                    'o' => ''
                ]
            ],[
                'name' => 'S-I or Railroad Bingo',
                'plots' => [
                    'b' => '*',
                    'i' => '',
                    'n' => '',
                    'g' => '',
                    'o' => '*'
                ]
            ],[
                'name' => 'Horizontal Line at the Center',
                'plots' => [
                    'b' => '2',
                    'i' => '2',
                    'n' => '',
                    'g' => '2',
                    'o' => '2'
                ]
            ],[
                'name' => 'Arrow Bingo',
                'plots' => [
                    'b' => '012',
                    'i' => '01',
                    'n' => '0',
                    'g' => '3',
                    'o' => '4'
                ]
            ],[
                'name' => 'Cross Bingo',
                'plots' => [
                    'b' => '2',
                    'i' => '2',
                    'n' => '0134',
                    'g' => '2',
                    'o' => '2'
                ]
            ],[
                'name' => 'C Bingo',
                'plots' => [
                    'b' => '123',
                    'i' => '04',
                    'n' => '04',
                    'g' => '04',
                    'o' => '04'
                ]
            ],[
                'name' => 'O Bingo',
                'plots' => [
                    'b' => '123',
                    'i' => '04',
                    'n' => '04',
                    'g' => '04',
                    'o' => '123'
                ]
            ],[
                'name' => 'Outside Square Bingo',
                'plots' => [
                    'b' => '123',
                    'i' => '*',
                    'n' => '*',
                    'g' => '*',
                    'o' => '123'
                ]
            ],[
                'name' => 'Big Square Bingo',
                'plots' => [
                    'b' => '*',
                    'i' => '04',
                    'n' => '04',
                    'g' => '04',
                    'o' => '*'
                ]
            ],[
                'name' => 'Center Square Bingo',
                'plots' => [
                    'b' => '',
                    'i' => '123',
                    'n' => '13',
                    'g' => '123',
                    'o' => ''
                ]
            ],[
                'name' => 'X Bingo',
                'plots' => [
                    'b' => '04',
                    'i' => '13',
                    'n' => '',
                    'g' => '13',
                    'o' => '04'
                ]
            ],[
                'name' => 'Y Bingo',
                'plots' => [
                    'b' => '0',
                    'i' => '1',
                    'n' => '34',
                    'g' => '1',
                    'o' => '0'
                ]
            ],[
                'name' => 'Horizontal Line at the Bottom',
                'plots' => [
                    'b' => '4',
                    'i' => '4',
                    'n' => '4',
                    'g' => '4',
                    'o' => '4'
                ]
            ],[
                'name' => 'Block of 8 Bingo',
                'plots' => [
                    'b' => '34',
                    'i' => '34',
                    'n' => '34',
                    'g' => '34',
                    'o' => ''
                ]
            ],[
                'name' => 'Block of 10 Bingo',
                'plots' => [
                    'b' => '*',
                    'i' => '*',
                    'n' => '',
                    'g' => '',
                    'o' => ''
                ]
            ],[
                'name' => '2 Square of 4 Bingo',
                'plots' => [
                    'b' => '01',
                    'i' => '01',
                    'n' => '',
                    'g' => '34',
                    'o' => '34'
                ]
            ],[
                'name' => 'U Bingo',
                'plots' => [
                    'b' => '0123',
                    'i' => '4',
                    'n' => '4',
                    'g' => '4',
                    'o' => '0123'
                ]
            ],
        ];

        return $patterns;
    }


	public function run()
	{
        if (Play::count() == 0) {
            $this->call('PlaysTableSeeder');
        }

        Pattern::unguard();
        Pattern::truncate();

		foreach($this->patterns() as $i => $pattern)
		{
            $pattern['id']      = $i+1;
            $pattern['play_id'] = $i+1;
            $pattern['plots']   = $this->parsePlots($pattern['plots']);

			Pattern::create($pattern);
		}
	}

    protected function parsePlots($inputPlots)
    {
        $plots = [];
        foreach ($inputPlots as $column => $indexStr) {
            if (strlen($indexStr) == 0) {
                continue;
            }

            if ($indexStr === '*') {
                $indexStr = '01234';
            } 
            elseif ($indexStr === '*' && $column === 'n') {
                $indexStr = '0134';
            }

            foreach (str_split($indexStr) as $index) {
                if (is_numeric($index)) {
                    $plots[] = $column.$index;
                }
            }
        }

        return join(',', $plots);
    }
}
