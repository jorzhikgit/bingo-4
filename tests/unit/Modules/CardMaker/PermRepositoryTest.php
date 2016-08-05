<?php

use SedpMis\Bingo\Modules\CardMaker\PermRepository;

class PermRepositoryTest extends TestCase
{
    public function repo()
    {
        return new PermRepository;
    }

    public function testPermutations()
    {
        $perms = $this->repo()->permutations('b', 15);

        $this->assertEquals(15, count($perms));
    }
}