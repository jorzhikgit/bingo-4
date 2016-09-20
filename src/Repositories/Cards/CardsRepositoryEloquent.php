<?php

namespace SedpMis\Bingo\Repositories\Cards;

use SedpMis\Bingo\Models\Parish;
use SedpMis\Bingo\Models\WinningPattern;
use SedpMis\Bingo\Models\Card;
use Illuminate\Support\Facades\DB;

class CardsRepositoryEloquent implements CardsRepositoryInterface
{
    public function getPossibleWinningCards($patternId, array $numbers)
    {
        $query = Card::query();

        foreach ($numbers as $number) {
            $query->orWhere(number_column($number), 'like', "%{$number}%");
        }

        $this->queryCardRanges($query);

        return $query->get();
    }

    protected function queryCardRanges($query)
    {
        $parish = Parish::active()->first();

        if ($parish && count($parish->cardRanges())) {
            $betweens = [];
            foreach ($parish->cardRanges() as $range) {
                if (count($range) > 1) {
                    $betweens[] = "id between {$range[0]} and {$range[0]}";
                }
            }
            $sql = '('.join(' or ', $betweens).')';
            $query->whereRaw($sql);
        }

        return $query;
    }
}