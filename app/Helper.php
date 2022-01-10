<?php

namespace App;

class Helper
{
    public static function getCurrentDate()
    {
        $dateMin = date("Y-m-d 00:00:00");
        $dateMax = date("Y-m-d 23:59:59");
        if (request()->input("dateMin") && request()->input("dateMin")) {
            $dateMin = strval(request()->input("dateMin")) . " 00:00:00";
            $dateMax = strval(request()->input("dateMax")) . " 23:59:59";
        }

        return [$dateMin, $dateMax];
    }
}