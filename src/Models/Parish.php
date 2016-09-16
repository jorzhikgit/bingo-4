<?php

namespace SedpMis\Bingo\Models;

class Parish extends BaseModel
{
	protected $fillable = ['name', 'branch_no', 'card_ranges', 'card_ranges'];

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
}