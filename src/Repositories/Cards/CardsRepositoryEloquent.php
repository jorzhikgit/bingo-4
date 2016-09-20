<?php

namespace SedpMis\Bingo\Repositories\Cards;

use SedpMis\Bingo\Models\Parish;
use SedpMis\Bingo\Models\WinningPattern;
use SedpMis\Bingo\Models\Card;
use Illuminate\Support\Facades\DB;

class CardsRepositoryEloquent implements CardsRepositoryInterface
{
    public function getPossibleWinningCards($patternId, array $drawedNumbers)
    {
        sort($drawedNumbers);

        $compare = "'".join(',', $drawedNumbers)."'";

        $query = WinningPattern::where(DB::raw($compare), 'like', DB::raw('CONCAT("%", REPLACE(numbers, ",", "%"), "%")'))
            ->where('pattern_id', $patternId);

        $parish = Parish::active()->first();

        if ($parish && count($parish->cardRanges())) {
            $betweens = [];
            foreach ($parish->cardRanges() as $range) {
                if (count($range) > 1) {
                    $betweens[] = "id between {$range[0]} and {$range[1]}";
                }
            }
            $sql = '('.join(' or ', $betweens).')';
            $query->whereRaw($sql);
        }

        return $cards = Card::find($query->lists('card_id'));
    }
}