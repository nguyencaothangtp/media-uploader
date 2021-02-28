<?php

namespace App\Helpers;

class ImageHelper
{
    static function calculateRatio($width, $height)
    {
        $gcd = function ($width, $height) use (&$gcd) {
            return ($width % $height) ? $gcd($height, $width % $height) : $height;
        };
        $g = $gcd($width, $height);
        return $width / $g . ':' . $height / $g;
    }
}
