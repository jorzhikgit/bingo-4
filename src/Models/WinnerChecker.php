<?php

namespace SedpMis\Bingo\Models;

class WinnerChecker
{
    protected $numbers = [];

    public function __construct($numbers)
    {
        $this->numbers = $numbers;
    }

    public function numbersCalled($numbers)
    {
        return count(array_diff($numbers, $this->numbers)) > 0;
    }

    public function isMatch($pattern, $card)
    {
        foreach (Card::columns() as $column) {
            // Get all card numbers base from pattern's column positions
            // and check if those numbers are really called.
            $numbersInColumnPattern = array_only($card->numbers($column), $pattern->positions($column));

            if (!$this->numbersCalled($numbersInColumnPattern)) {
                return false;
            }
        }

        return true;
    }
}
