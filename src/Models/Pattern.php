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
        if (!array_key_exists('plots', $this->attributes) || strlen($this->attributes['plots']) == 0) {
            return [];
        }

        return explode(static::PLOT_DELIM, $this->getRawPlots());
    }
}