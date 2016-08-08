<?php

namespace SedpMis\Bingo\Models;

class Pattern extends BaseModel
{
    protected $fillable = ['plots'];

    const PLOT_DELIM = ',';

    public function play()
    {
        return $this->belongsTo(Play::class);
    }

    public function positions($column)
    {
        $plots = array_filter($this->attributes['plots'], function ($plot) use ($column) {
            return $plot[0] == $column;
        });

        return array_map(function ($plot) {
            return $plot[1];
        }, $plots);
    }

    public function plots()
    {
        return explode(static::PLOT_DELIM, $this->attributes['plots']);
    }
}