<?php

namespace SedpMis\Bingo\Models;

use SedpMis\Bingo\Modules\Patterns\PatternPlotter;

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
        if (!array_key_exists('plots', $this->attributes) || strlen($this->attributes['plots']) == 0) {
            return;
        }

        return $this->attributes['plots'];
    }

    public function plotCount($column = null)
    {
        
    }

    public function getPlotCountAttribute($value='')
    {
        
    }

    public function plots()
    {
        if (!$rawPlots = $this->getRawPlots()) {
            return [];
        }

        return explode(static::PLOT_DELIM, $rawPlots);
    }

    public function getSelectedPlotsAttribute()
    {
        return (new PatternPlotter)->plot($this);
    }

    public function plotColumns()
    {
        $columns = [];

        foreach ($this->plots() as $plot) {
            $columns[$plot[0]] = 1;
        }

        return array_keys($columns);
    }

    public function getMaxNumbersAttribute()
    {
        return count($this->plotColumns()) * 15;
    }
}