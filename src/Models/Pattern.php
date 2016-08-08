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

    public function getRawPlots()
    {
        return $this->attributes['plots'];
    }

    public function plots()
    {
        return explode(static::PLOT_DELIM, $this->getRawPlots());
    }
}