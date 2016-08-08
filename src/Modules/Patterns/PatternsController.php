<?php

namespace SedpMis\Bingo\Modules\Patterns;

use SedpMis\Bingo\Models\Card;
use SedpMis\Bingo\Models\Pattern;

class PatternsController extends \BaseController
{
    public function show($id)
    {
        $pattern = Pattern::findOrFail($id);
        $pattern->setAppends(['selected_plots']);

        return $pattern;
    }

    public function compare($patternId, $cardId)
    {
        $pattern = Pattern::with('play')->findOrFail($patternId);
        $card    = Card::findOrFail($cardId);

        $card->setPlotsViaNumbers($pattern->play->numbers());

        $cardPlots = (new PatternPlotter)->compare($pattern, $card);

        return [
            'pattern'       => $pattern->getAttributes(),
            'card'          => $card,
            'pattern_plots' => $patternPlots = (new PatternPlotter)->plot($pattern),
            'card_plots'    => (new PatternPlotter)->plot($card),
            'status'        => ($patternPlots == $cardPlots) ? 'Match' : 'Mis-match'
        ];
    }
}