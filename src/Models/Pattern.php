<?php

namespace SedpMis\Bingo\Models;

class Pattern extends BaseModel
{
    protected $fillable = ['plots'];

    public function __construct($positions)
    {
        $this->positions = $positions;
    }

    public function positions($key)
    {
        return $this->positions[$key];
    }
}