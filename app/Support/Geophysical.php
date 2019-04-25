<?php

namespace App\Support;

class Geophysical
{
    public static function getDistance(float $lat1, float $lon1, float $lat2, float $lon2, string $unit = 'km') {
        if (($lat1 === $lat2) && ($lon1 === $lon2)) {
            return 0;
        } else {
            $theta = $lon1 - $lon2;
            $dist  = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist  = acos($dist);
            $dist  = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit  = strtolower($unit);

            if ($unit === "km") {
                return round($miles * 1.609344, 3);
            } else if ($unit === "m") {
                return ($miles * 0.8684);
            } else {
                return $miles;
            }
        }
    }
}