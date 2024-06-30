<?php

namespace Core;

class Validator
{
    public static function string(string $value, int $min = 1, $max = INF) : bool
    {
        $value = trim($value);

        return strlen($value) >= $min && strlen($value) <= $max;
    }

    
    public static function email(string $value) : bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    public static function greaterThan(int $number, int $compare) : bool
    {
        return $number > $compare;
    }
}