<?php

namespace SedpMis\Bingo\Models;

class NumberPicker
{
    protected $numbers = [];

    public function __construct($numbers)
    {
        $this->numbers = $numbers;
    }

    public function numbers()
    {
        return $this->numbers;
    }

    public function pick($count = 1)
    {
        $indexes = array_rand($this->numbers, $count);
        $indexes = is_array($indexes) ? $indexes : [$indexes];

        $numbers = [];

        foreach ($indexes as $index) {
            $numbers = array_merge($numbers, array_splice($this->numbers, $index, 1));
        }

        return $count == 1 ? head($numbers) : $numbers;
    }
}