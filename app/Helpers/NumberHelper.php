<?php

namespace App\Helpers;

abstract class NumberHelper
{
    public static function toFloat($number) {
        if (strpos($number, '.') !== false) {
            return $number;
        }
        return $number . '.0';
    }
}
