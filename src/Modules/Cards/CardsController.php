<?php

namespace SedpMis\Bingo\Modules\Cards;

use SedpMis\Bingo\Models\Card;

class CardsController extends \BaseController
{
    public function index()
    {
        return Card::paginate();
    }
}