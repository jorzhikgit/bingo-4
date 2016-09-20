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
        sort($numbers);

        $compare = "'".join(',', $numbers)."'";

        $query = WinningPattern::where(DB::raw($compare), 'like', DB::raw('CONCAT("%", REPLACE(numbers, ",", "%"), "%")'))
            ->where('pattern_id', $patternId);

        $this->queryCardRanges($query);

        return $cards = Card::find($query->lists('card_id'));
    }

    protected function queryCardRanges($query)
    {
        $parish = Parish::active()->first();

        if ($parish && count($parish->cardRanges())) {
            $betweens = [];
            foreach ($parish->cardRanges() as $range) {
                if (count($range) > 1) {
                    $betweens[] = "card_id between {$range[0]} and {$range[0]}";
                }
            }
            $sql = '('.join(' or ', $betweens).')';
            $query->whereRaw($sql);
        }

        return $query;
    }
}