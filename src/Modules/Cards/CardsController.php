<?php

namespace SedpMis\Bingo\Modules\Cards;

class CardsController extends \BaseController
{
    public function index()
    {
        return Card::paginate();
    }
}