<?php

namespace SedpMis\Bingo\Modules\Plays;

use Illuminate\Filesystem\Filesystem as File;
use SedpMis\Bingo\Models\NumberPicker;
use SedpMis\Bingo\Models\WinningPattern;
use SedpMis\Bingo\Models\Play;
use Config;
use DB;

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

    public function winners($id)
    {
        $play = Play::with('pattern')->findOrFail($id);
        $drawedNumbers = $play->numbers;
        sort($drawedNumbers);
        $compare = "'".join(',', $drawedNumbers)."'";

        $query = WinningPattern::where(DB::raw($compare), 'like', DB::raw('CONCAT("%", REPLACE(numbers, ",", "%"), "%")'))
            ->where('pattern_id', $play->pattern->id);

        $startCardId = Config::get('bingo.start_card_id');
        $endCardId   = Config::get('bingo.end_card_id');

        if (!is_null($startCardId) && !is_null($endCardId)) {
            $query->whereBetween('card_id', [$startCardId, $endCardId]);
        }

        return [
            'winners' => $query->lists('card_id')
        ];
    }
}
