<?php

namespace SedpMis\Bingo\Modules\Cards;

use SedpMis\Bingo\Models\Card as BaseCard;

class Card extends BaseCard
{
    public function getIdAttribute($id)
    {
        return num_zero_pad($id, 5);
    }

    public function getBAttribute()
    {
        return $this->numbers('b');
    }

    public function getIAttribute()
    {
        return $this->numbers('i');
    }

    public function getNAttribute()
    {
        return $this->numbers('n');
    }

    public function getGAttribute()
    {
        return $this->numbers('g');
    }

    public function getOAttribute()
    {
        return $this->numbers('o');
    }
}