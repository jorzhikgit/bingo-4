<?php

use SedpMis\Bingo\Models\Play;

class PlaysControllerTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        Artisan::call('migrate:refresh');
        $this->seed();
    }

    public function testPickANumber()
    {
        $play = Play::first();
        $this->assertEquals(1, $play->id);

        foreach (range(1, 3) as $count) {
            $this->refreshApplication();

            $response = $this->call('POST', "plays/{$play->id}/pick_a_number");

            $this->assertEquals(['column', 'number'], array_keys($response->getOriginalContent()));

            $play = Play::first();

            $this->assertEquals($count, count($play->numbers()));
        }
    }
}