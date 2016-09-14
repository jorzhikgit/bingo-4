<?php

use SedpMis\Bingo\Models\Pattern;
use SedpMis\Bingo\Models\Play;
use SedpMis\Bingo\Models\Card;

class PatternsControllerTest/* extends TestCase*/
{
    public function setUp()
    {
        parent::setUp();

        Artisan::call('migrate:refresh');

        Card::create([
            'b' => '1,2,3,4,5', 
            'i' => '16,17,0,18,19', 
            'n' => '32,33,34,35,36', 
            'g' => '46,47,48,49,50', 
            'o' => '65,66,67,68,69,70'
        ]);

        $play = Play::create(['numbers' => '1,5,65', 'status' => 'o']);

        $play->pattern()->save(new Pattern(['name' => 'Four Corners', 'b0,b4,o0,o4']));
    }

    public function testCompareWithSomeUnselected()
    {
        $pattern = Pattern::with('play')->first();

        $this->call('GET', 'patterns/1/compare/1');
    }
}