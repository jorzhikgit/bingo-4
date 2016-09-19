<?php

namespace SedpMis\Bingo\Modules\Plays;

use Illuminate\Filesystem\Filesystem as File;
use SedpMis\Bingo\Models\NumberPicker;
use SedpMis\Bingo\Models\WinningPattern;
use SedpMis\Bingo\Models\Play;
use SedpMis\Bingo\Models\Card;
use SedpMis\Bingo\Models\Parish;
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
        $play = Play::with('pattern')->findOrFail($playId);

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

    public function getWinners($play)
    {
        $drawedNumbers = $play->numbers;
        sort($drawedNumbers);
        $compare = "'".join(',', $drawedNumbers)."'";

        $query = WinningPattern::where(DB::raw($compare), 'like', DB::raw('CONCAT("%", REPLACE(numbers, ",", "%"), "%")'))
            ->where('pattern_id', $play->pattern->id);

        $parish = Parish::active()->first();

        if ($parish && count($parish->cardRanges())) {
            $betweens = [];
            foreach ($parish->cardRanges() as $range) {
                if (count($range) > 1) {
                    $betweens[] = "id between {$range[0]} and {$range[1]}";
                }
            }
            $sql = '('.join(' or ', $betweens).')';
            $query->whereRaw($sql);
        }

        $cards = Card::find($query->lists('card_id'));

        return $cards->filter(function ($card) use ($play) {
            $card->setPlotsViaNumbers($play->numbers());
            return $play->pattern->isMatch($card);
        });
    }

    public function winners($id)
    {
        return [
            'winners' => $this->getWinners(Play::with('pattern')->findOrFail($id))->lists('id')
        ];
    }
}
