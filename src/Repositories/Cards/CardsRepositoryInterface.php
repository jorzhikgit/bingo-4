<?php

namespace SedpMis\Bingo\Repositories\Cards;

interface CardsRepositoryInterface
{
    public function getPossibleWinningCards($patternId, array $numbers);
}