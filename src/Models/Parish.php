<?php

namespace SedpMis\Bingo\Models;

class Parish extends BaseModel
{
	protected $fillable = ['name', 'branch', 'category', 'date', 'is_active', 'card_ranges'];

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function cardRanges()
    {
        if (!array_key_exists('card_ranges', $this->attributes) || empty($this->attributes['card_ranges'])) {
            return [];
        }

        $strRanges = explode(',', $this->attributes['card_ranges']);
        $ranges  = [];

        foreach ($strRanges as $strRange) {
            $ranges[] = array_map(function ($id) { return (int) $id;}, explode('-', $strRange));
        }

        return array_filter($ranges, function ($range) {
            return count($range) > 1;
        });
    }
}