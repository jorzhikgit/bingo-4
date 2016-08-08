<?php

namespace SedpMis\Bingo\Models;

class Card extends Pattern
{
    const NUM_DELIM = ',';

    protected $fillable = ['b', 'i', 'n', 'g', 'o'];

    protected $plots;

    public static function columns()
    {
        return ['b', 'i', 'n', 'g', 'o'];
    }

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

    public function numbers($column)
    {
        return explode(static::NUM_DELIM, $this->attributes[$column]);
    }

    public function allNumbers()
    {
        $numbers = [];

        foreach (static::columns() as $column) {
            $numbers = array_merge($numbers, $this->numbers($column));
        }

        return $numbers;
    }

    public function setColumn($column, $numbers)
    {
        $this->{$column} = join(static::NUM_DELIM, $numbers);
    }

    public function getRawPlots()
    {
        return $this->plots;
    }

    public function setPlotsViaNumbers($numbers)
    {
        $plots = [];

        foreach ($numbers as $number) {
            $column = number_column($number);
            $flipped = array_flip($this->numbers($column));
            if (array_key_exists($number, $flipped)) {
                $plots[] = $column.$flipped[$number];
            }
        }

        $this->plots = join(',', $plots);

        return $plots;
    }
}