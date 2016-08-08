<?php

namespace SedpMis\Bingo\Modules\Patterns;

use SedpMis\Bingo\Models\Card;
use SedpMis\Bingo\Models\Pattern;

class PatternsController extends \BaseController
{
    public function show($id)
    {
        $pattern = Pattern::findOrFail($id);
        $plotter = new PatternPlotter;
        $pattern->selected_plots = $plotter->plot($pattern);

        return $pattern;
    }

    public function compare($patternId, $cardId)
    {
        $pattern = Pattern::with('play')->findOrFail($patternId);
        $card    = Card::findOrFail($cardId);

        $card->setPlotsViaNumbers($pattern->play->numbers());

        return [
            'pattern'       => $pattern->getAttributes(),
            'card'          => $card,
            'pattern_plots' => $patternPlots = (new PatternPlotter)->plot($pattern),
            'card_plots'    => $cardPlots = (new PatternPlotter)->compare($pattern, $card),
            'status'        => ($patternPlots == $cardPlots) ? 'Matched' : 'Mis-match'
        ];
    }
}