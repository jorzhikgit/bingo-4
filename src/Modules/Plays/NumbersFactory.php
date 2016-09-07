<?php

namespace SedpMis\Bingo\Modules\Plays;

class NumbersFactory
{
    public function make($pattern)
    {
        $numbers = [];

        foreach ($pattern->plotColumns() as $column) {
            $numbers = array_merge($numbers, column_numbers($column));
        }

        return $numbers;
    }
}
