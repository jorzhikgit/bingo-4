<?php

function number_column($number)
{
    if ($number <= 15) {
        return 'b';
    }

    if ($number <= 30) {
        return 'i';
    }

    if ($number <= 45) {
        return 'n';
    }

    if ($number <= 60) {
        return 'g';
    }

    return 'o';
}

function format_number_column($column)
{
    $column = is_numeric($column) ? number_column($column) : $column;

    $columns = [
        'b' => 'S',
        'i' => 'E',
        'n' => 'D',
        'g' => 'P',
        'o' => 'I'
    ];

    return $columns[$column];
}