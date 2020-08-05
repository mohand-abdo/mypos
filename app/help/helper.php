<?php

use Illuminate\Support\Facades\Request;



function status()
{
    return [
        '0' => __('dashboard.active'),
        '1' => __('dashboard.inactive')
    ];
}

function intWithStyle($n)
{
    if ($n < 1000) return $n;
    $suffix = ['', 'k', 'M', 'G', 'T', 'P', 'E', 'Z', 'Y'];
    $power = floor(log($n, 1000));
    return round($n / (1000 ** $power), 1, PHP_ROUND_HALF_EVEN) . $suffix[$power];
};

function isActive($url)
{
    if (Request::routeIs($url)) {
        return 'active';
    } else {
        return '';
    }
}
