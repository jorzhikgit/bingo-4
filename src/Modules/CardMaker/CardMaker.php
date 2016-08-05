<?php

namespace SedpMis\Bingo\Modules\CardMaker;

use SedpMis\Bingo\Models\Card;

class CardMaker
{
    protected $perm;

    public function __construct(PermRepository $perm)
    {
        $this->perm = $perm;
    }

    public function make($n, $spaces = ['n2'])
    {
        $cards = collection();
        $perms = [];

        $spaces = is_array($spaces) ? $spaces : [$spaces];

        foreach (Card::columns() as $column) {
            $perms[$column] = $this->perm->permutations($column, $n);
        }

        for ($count = 0; $count < $n; $count++) {
            $card = new Card;
            foreach ($perms as $column => $numbers) {
                $numbers = $numbers[$count];
                
                // Replace the space positions by zeros
                foreach ($spaces as $spacePos) {
                    if ($spacePos && $column == $spacePos[0]) {
                        $numbers[$spacePos[1]] = 0;
                    }
                }
                
                $card->setColumn($column, $numbers);
            }

            $cards[] = $card;
        }

        return $cards;
    }
}