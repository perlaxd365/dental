<?php

use App\Models\Parametro;

class ParametroUtil
{
    public static function getParametro($valor, $parametro)
    {
        return  Parametro::select('*')
        ->where('parametro', $parametro)
        ->where('valor', $valor)
        ->where('estado', true)->first()["parametro_nombre"];
    }

    public static function getParametroList($parametro)
    {
        return Parametro::select('*')
            ->where('parametro', $parametro)
            ->where('estado', true);
    }
}
