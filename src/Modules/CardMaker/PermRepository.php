<?php

namespace SedpMis\Bingo\Modules\CardMaker;

use Illuminate\Filesystem\Filesystem as File;

class PermRepository
{
    protected $files = [
        'b' => '01-15_b.txt',
        'i' => '16-30_i.txt',
        'n' => '31-45_n.txt',
        'g' => '46-60_g.txt',
        'o' => '61-75_o.txt',
    ];

    public function permutations($column, $n)
    {
        $strContents = (new File)->get($this->file($column));

        $lines = explode("\n", $strContents);

        $perms = array_map(function ($line) {
            return explode(' ', $line);
        }, $lines);

        shuffle($perms);

        array_splice($perms, $n);

        return $perms;
    }

    protected function file($column)
    {
        return src_path('perms/'.$this->files[$column]);
    }
}