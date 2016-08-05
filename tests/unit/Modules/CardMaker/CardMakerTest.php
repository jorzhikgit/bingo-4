<?php

use SedpMis\Bingo\Modules\CardMaker\CardMaker;
use SedpMis\Bingo\Modules\CardMaker\PermRepository;

class CardMakerTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        ini_set('memory_limit', -1);
    }

    public function maker()
    {
        return new CardMaker(new PermRepository);
    }

    public function testMake()
    {
        $cards = $this->maker()->make(5);

        $this->assertEquals(5, $cards->count());

        foreach ($cards as $card) {
            $this->assertEquals(0, $card->numbers('n')[2]);
        }
    }
}