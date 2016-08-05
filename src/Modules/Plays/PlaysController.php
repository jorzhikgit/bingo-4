<?php

namespace SedpMis\Bingo\Modules\Plays;

use SedpMis\Bingo\Models\Play;

class PlaysController extends \BaseController
{
    public function index()
    {
        $q = Play::query();

        if ($status = \Input::get('status')) {
            $q->where('status', $status);
        }


        return $q->paginate();
    }

    public function show($id)
    {
        $play = Play::findOrFail($id);

        $play->setAppends(['number_objects']);
        $play->setHidden(['numbers']);

        return $play;
    }
}