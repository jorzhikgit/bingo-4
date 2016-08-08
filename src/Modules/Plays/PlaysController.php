<?php

namespace SedpMis\Bingo\Modules\Plays;

use SedpMis\Bingo\Models\NumberPicker;
use SedpMis\Bingo\Models\Play;

class PlaysController extends \BaseController
{
    public function index()
    {
        $q = Play::query();

        if ($status = \Input::get('status')) {
            $q->where('status', $status);
        }

        return $q->paginate(\Input::get('per_page', 15));
    }

    public function show($id)
    {
        $play = Play::findOrFail($id);

        $play->setAppends(['number_objects']);
        $play->setHidden(['numbers']);

        return $play;
    }

    public function pickANumber($playId)
    {
        $play = Play::findOrFail($playId);
        $numbers = range(1, 75);

        $numbers = array_filter($numbers, function ($number) use ($play) {
            return !in_array($number, $play->numbers());
        });

        $numbers = array_values($numbers);

        $picker = new NumberPicker($numbers);

        $number = $picker->pick();
        $play->addNumber($number);
        $play->save();

        return [
            'column' => format_number_column($number),
            'number' => $number
        ];
    }
}