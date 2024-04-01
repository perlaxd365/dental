<?php

use Carbon\Carbon;

class DateUtil
{
    public static function getFechaCompleta($fecha)
    {
        $fecha->setLocale('es');
        return $fecha->isoFormat('dddd D \d\e MMMM \d\e\l Y H:mm A');
    }

    public static function getFecha($fecha)
    {
        $fecha->setLocale('es');
        return $fecha->isoFormat('dddd D \d\e MMMM \d\e\l Y');
    }
    
    public static function getHora($fecha)
    {
        $fecha->setLocale('es');
        return $fecha->isoFormat('H:m A');
    }
}
 