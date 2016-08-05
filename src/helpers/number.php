<?php

function number_column($number)
{
    if ($number <= 15) {
        return 'S';
    }

    if ($number <= 30) {
        return 'E';
    }

    if ($number <= 45) {
        return 'D';
    }

    if ($number <= 60) {
        return 'P';
    }

    return 'I';
}