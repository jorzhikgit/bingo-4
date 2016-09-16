<?php

namespace SedpMis\Bingo\Models;

class Parish extends BaseModel
{
	protected $fillable = ['name', 'branch_no', 'card_ranges', 'card_ranges'];

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function cardRanges()
    {
        if (!array_key_exists('card_ranges', $this->attributes)) {
            return [];
        }

        $strRanges = explode(',', $this->attributes['card_ranges']);
        $ranges  = [];

        foreach ($strRanges as $strRange) {
            $ranges[] = array_map(function ($id) { return (int) $id;}, explode('-', $strRange));
        }

        return $ranges;
    }
}