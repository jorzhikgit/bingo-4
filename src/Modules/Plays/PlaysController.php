<?php

namespace SedpMis\Bingo\Modules\Plays;

use Illuminate\Filesystem\Filesystem as File;
use SedpMis\Bingo\Models\NumberPicker;
use SedpMis\Bingo\Models\Play;

class PlaysController extends \BaseController
{
    public function index()
    {
        $q = Play::with('pattern');

        if ($status = \Input::get('status')) {
            $q->where('status', $status);
        }

        return $q->paginate(\Input::get('per_page', 100));
    }

    public function show($id)
    {
        $play = Play::with('pattern')->findOrFail($id);

        $play->setAppends(['number_objects']);
        $play->setHidden(['numbers']);
        $play->pattern ? $play->pattern->setAppends(['max_numbers', 'selected_plots']) : null;

        return $play;
    }

    public function pickANumber($playId)
    {
        $play = Play::findOrFail($playId);

        $numbers = (new NumbersFactory)->make($play->pattern);

        $numbers = array_filter($numbers, function ($number) use ($play) {
            return !in_array($number, $play->numbers());
        });

        $numbers = array_values($numbers);

        if (count($numbers) == 0) {
            throw new \Exception("All numbers has been drawn!");
        }

        $picker = new NumberPicker($numbers);

        $number = $picker->pick();
        $play->addNumber($number);
        $play->save();

        return [
            'column' => format_number_column($number),
            'number' => $number
        ];
    }

    public function resetPlays()
    {
        (new File)->put(base_path('data_plays/'.date('Y-m-d_H-i-s').'.json'), Play::all()->toJson());
        Play::query()->update(['numbers' => '']);

        return 'Successfully Reset!';
    }
}