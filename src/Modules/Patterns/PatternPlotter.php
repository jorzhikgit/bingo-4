<?php

namespace SedpMis\Bingo\Modules\Patterns;

use SedpMis\Bingo\Models\Card;

class PatternPlotter
{
    protected $plots = [];

    public function __construct()
    {
        foreach (Card::columns() as $column) {
            $this->plots[$column] = [0, 0, 0, 0, 0];
        }
    }

    public function plot($pattern)
    {
        $plots = $this->plots;

        foreach ($pattern->arrayPlots() as $plot) {
            $plots[$plot[0]][$plot[1]] = 1;
        }

        return $plots;
    }

    public function compare($pattern, $card)
    {
        
    }
}