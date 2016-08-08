<?php

namespace SedpMis\Bingo\Models;

class Card extends Pattern
{
    const NUM_DELIM = ',';

    protected $fillable = ['b', 'i', 'n', 'g', 'o'];

    public static function columns()
    {
        return ['b', 'i', 'n', 'g', 'o'];
    }

    public function numbers($column)
    {
        return explode(static::NUM_DELIM, $this->attributes[$column]);
    }

    public function allNumbers()
    {
        $numbers = [];

        foreach (static::columns() as $column) {
            $numbers = array_merge($this->numbers($column));
        }

        return $numbers;
    }

    public function setColumn($column, $numbers)
    {
        $this->{$column} = join(static::NUM_DELIM, $numbers);
    }
}