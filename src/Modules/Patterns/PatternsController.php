<?php

namespace SedpMis\Bingo\Modules\Patterns;

use SedpMis\Bingo\Models\Card;

class PatternsController extends \BaseController
{
    public function show($id)
    {
        $pattern = Pattern::findOrFail($id);
        $plotter = new PatternPlotter;
        $pattern->plots_binary = $plotter->plot($pattern);

        return $pattern;
    }

    public function compare($patternId, $cardId)
    {
        $pattern = Pattern::findOrFail($patternId);
        $card    = Card::findOrFail($cardId);

        return [$pattern, $card];
    }
}