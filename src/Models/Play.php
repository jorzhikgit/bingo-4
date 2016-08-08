<?php

namespace SedpMis\Bingo\Models;

class Play extends BaseModel
{
    const NUM_DELIM = ',';

    protected $fillable = ['numbers'];

    protected $appends = [];

    public function pattern()
    {
        return $this->hasOne(Pattern::class);
    }

    public function numbers()
    {
        if (!array_key_exists('numbers', $this->attributes) || strlen($this->attributes['numbers']) == 0) {
            return [];
        }

        return explode(static::NUM_DELIM, $this->attributes['numbers']);
    }

    public function getNumbersAttribute()
    {
        return $this->numbers();
    }

    public function addNumber($number)
    {
        $delim = strlen($this->attributes['numbers']) ? ',' : '';
        $this->attributes['numbers'] .= $delim.$number;

        return $this->numbers();
    }

    public function rawNumbers()
    {
        return $this->attributes['numbers'];
    }

    public function getNumberObjectsAttribute()
    {
        $numberObjects = [];

        foreach ($this->numbers() as $number) {
            $numberObjects[] = [
                'column'  => format_number_column($number),
                'number'  => $number
            ];
        };

        return $numberObjects;
    }
}