<?php

namespace SedpMis\Bingo\Lib;

class Perm
{
    protected $perms = [];

    public function permutate($items, $perms = array( ))
    {
        if (empty($items)) { 
            $this->perms[] = $perms;
            // print join(' ', $perms) . "\n";
        }  else {
            for ($i = count($items) - 1; $i >= 0; --$i) {
                $newitems = $items;
                $newperms = $perms;
                list($foo) = array_splice($newitems, $i, 1);
                array_unshift($newperms, $foo);
                $this->permutate($newitems, $newperms);
            }
        }

        return $this->perms;
    }

    public static function permutations($elements, $r)
    {
        $combs = get_combinations($elements, $r);

        $perms = [];

        foreach ($combs as $comb) {
            $perms = array_merge($perms, (new static)->permutate($comb));
        }

        return $perms;
    }

    public static function writeFormat($perms)
    {
        $perms = array_map(function ($perm) {
            return join(' ', $perm);
        }, $perms);

        return join("\n", $perms);
    }
}

// To generate permutations in a file:
// file_put_contents(base_path('perms.txt'), Perm::writeFormat(Perm::permutations(range(1, 15), 5)));
