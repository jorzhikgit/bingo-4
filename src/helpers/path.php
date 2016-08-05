<?php

if (!function_exists('src_path')) {
    function src_path($str = null)
    {
        return base_path('src/'.$str);
    }
}