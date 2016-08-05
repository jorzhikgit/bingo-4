<?php

namespace SedpMis\Bingo\Models;

class Card extends BaseModel
{
    public static function columns()
    {
        return ['b', 'i', 'n', 'g', 'o'];
    }

    public function numbers($column)
    {
        return $this->arrayNumbers($column);
    }

    public function arrayNumbers($column)
    {
        return explode(' ', $this->{$column});
    }

    public function allNumbers()
    {
        $numbers = [];

        foreach (static::columns() as $column) {
            $numbers = array_merge($this->arrayNumbers($column));
        }

        return $numbers;
    }

    public function setColumn($column, $numbers)
    {
        $this->{$column} = join(' ', $numbers);
    }
}