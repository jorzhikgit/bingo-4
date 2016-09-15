<?php

namespace SedpMis\Bingo\Models;

class WinningPattern extends BaseModel
{
    protected $fillable = ['card_id', 'pattern_id', 'numbers'];
}
