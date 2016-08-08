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

        foreach ($pattern->plots() as $plot) {
            $plots[$plot[0]][$plot[1]] = 1;
        }

        return $plots;
    }

    public function compare($pattern, $card)
    {
        $patternPlots = (new static)->plot($pattern);
        $cardPlots = (new static)->plot($card);

        foreach (Card::columns() as $column) {
            for ($i = 0; $i < 5; $i++) {
                if ($cardPlots[$column][$i] == 1 && $patternPlots[$column][$i]) {
                    $cardPlots[$column][$i] = 1;
                } else {
                    $cardPlots[$column][$i] = 0;
                }
            }
        }

        return $cardPlots;
    }
}