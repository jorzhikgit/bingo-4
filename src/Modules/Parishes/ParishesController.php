<?php

namespace SedpMis\Bingo\Modules\Parishes;

use SedpMis\Bingo\Models\Parish;
use Illuminate\Http\Response;
use Input;
use DB;

class ParishesController extends \BaseController
{
    public function index()
    {
        return Parish::all();
    }

    public function update($id)
    {
        DB::table('parishes')->update(['is_active' => 0]);
        $parish = Parish::findOrFail($id);

        $parish->is_active = Input::get('is_active');
        $parish->save();

        return new Response('', Response::HTTP_NO_CONTENT);
    }

    public function active()
    {
        return Parish::where('is_active', 1)->first();
    }
}