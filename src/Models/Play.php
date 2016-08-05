<?php

namespace SedpMis\Bingo\Models;

class Play extends BaseModel
{
    const DRAW_NUM_DELIM = ',';

    protected $fillable = ['numbers'];

    protected $appends = [];

    public function arrayNumbers()
    {
        if (!array_key_exists('numbers', $this->attributes) || strlen($this->attributes['numbers']) == 0) {
            return [];
        }

        return explode(static::DRAW_NUM_DELIM, $this->attributes['numbers']);
    }

    public function getNumbersAttribute()
    {
        return $this->arrayNumbers();
    }

    public function addNumber($number)
    {
        $delim = strlen($this->attributes['numbers']) ? ',' : '';
        $this->attributes['numbers'] .= $delim.$number;

        return $this->arrayNumbers();
    }

    public function rawNumbers()
    {
        return $this->attributes['numbers'];
    }

    public function getNumberObjectsAttribute()
    {
        $numberObjects = [];

        foreach ($this->arrayNumbers() as $number) {
            $numberObjects[] = [
                'column'  => $this->columnLabel($number),
                'number'  => $number
            ];
        };

        return $numberObjects;
    }

    public function columnLabel($number)
    {
        if ($number <= 15) {
            return 'S';
        }

        if ($number <= 30) {
            return 'E';
        }

        if ($number <= 45) {
            return 'D';
        }

        if ($number <= 60) {
            return 'P';
        }

        return 'I';
    }
}