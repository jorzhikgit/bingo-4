<?php

namespace SedpMis\Bingo\Models;

class Pattern extends BaseModel
{
    protected $fillable = ['plots'];

    public function positions($column)
    {
        $plots = array_filter($this->attributes['plots'], function ($plot) use ($column) {
            return $plot[0] == $column;
        });

        return array_map(function ($plot) {
            return $plot[1];
        }, $plots);
    }
}