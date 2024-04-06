<?php

use App\Models\Contrato;
use App\Models\User;

class ContratoUtil
{
    public static function getContrato($id_empresa)
    {
        return Contrato::select('*')
            ->where('id_empresa', $id_empresa)
            ->where('estado_contrato', config('constants.ESTADO_CONTRATO_ACTIVO'))
            ->where('estado', true)
            ->where(function ($query) {
                return $query
                    ->orwhere('id_promo',  config('constants.PROMOCION_SISTEMA_OPTICA'))
                    ->orwhere('id_promo',  config('constants.PROMOCION_SISTEMA_OPTICA_MAS_FACTURACION'));
            })
            ->first();
    }

    public static function activarUsuarios($id_empresa)
    {
       
        User::where('id_empresa', $id_empresa)->update(['estado' => true]);
    }

    public static function suspenderUsuarios($id_empresa)
    {
       
        User::where('id_empresa', $id_empresa)->update(['estado' => false]);
    }
    public static function updateContrato($id_contrato, $estado)
    {
        $contrato = Contrato::find($id_contrato);
        $contrato->update([
            "estado_contrato" => $estado
        ]);
        return $contrato;
    }
}
