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

function column_numbers($column)
{
    $column = strtolower($column);

    if ($column === 'b') {
        return range(1, 15);
    }

    if ($column === 'i') {
        return range(16, 30);
    }

    if ($column === 'n') {
        return range(31, 45);
    }

    if ($column === 'g') {
        return range(46, 60);
    }

    if ($column === 'o') {
        return range(61, 75);
    }
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