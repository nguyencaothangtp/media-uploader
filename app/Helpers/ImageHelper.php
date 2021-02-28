<?php

namespace App\Helpers;

use FFMpeg\Coordinate\TimeCode;
use FFMpeg\FFMpeg;
use FFMpeg\FFProbe;

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

    static function generateThumbnail($path, $thumbnailName)
    {
        $ffprobe = FFProbe::create();
        $duration = $ffprobe
            ->format($path)
            ->get('duration');

        $ffmpeg = FFMpeg::create();
        $video = $ffmpeg->open($path);

        $thumbPath = $thumbnailName . '.jpg';
        $video->frame(TimeCode::fromSeconds(floor($duration / 2)))->save($thumbPath);

        return $thumbPath;
    }
}
