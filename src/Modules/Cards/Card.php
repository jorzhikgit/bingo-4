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
        return $this->arrayNumbers('b');
    }

    public function getIAttribute()
    {
        return $this->arrayNumbers('i');
    }

    public function getNAttribute()
    {
        return $this->arrayNumbers('n');
    }

    public function getGAttribute()
    {
        return $this->arrayNumbers('g');
    }

    public function getOAttribute()
    {
        return $this->arrayNumbers('o');
    }
}