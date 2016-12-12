<?php

use SedpMis\Bingo\Models\Pattern;
use SedpMis\Bingo\Models\Play;

class PatternsTableSeeder extends Seeder
{
    public function patterns()
    {
        $patterns = [
            [
                'name' => 'D Bingo',
                'plots' => [
                    'b' => '',
                    'i' => '*',
                    'n' => '04',
                    'g' => '123',
                    'o' => '',
                ]
            ],[
                'name' => 'C Bingo',
                'plots' => [
                    'b' => '',
                    'i' => '123',
                    'n' => '04',
                    'g' => '04',
                    'o' => '',
                ]
            ],[
                'name' => 'O Bingo',
                'plots' => [
                    'b' => '',
                    'i' => '123',
                    'n' => '04',
                    'g' => '123',
                    'o' => '',
                ]
            ],[
                'name' => 'L Bingo',
                'plots' => [
                    'b' => '',
                    'i' => '*',
                    'n' => '4',
                    'g' => '4',
                    'o' => '',
                ]
            ],[
                'name' => 'V Bingo',
                'plots' => [
                    'b' => '012',
                    'i' => '3',
                    'n' => '4',
                    'g' => '3',
                    'o' => '012',
                ]
            ],[
                'name' => 'Small V Bingo',
                'plots' => [
                    'b' => '',
                    'i' => '123',
                    'n' => '4',
                    'g' => '123',
                    'o' => '',
                ]
            ],[
                'name' => 'Blackout',
                'plots' => [
                    'b' => '*',
                    'i' => '*',
                    'n' => '*',
                    'g' => '*',
                    'o' => '*',
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
            
            if ($indexStr === '01234' && $column === 'n') {
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
