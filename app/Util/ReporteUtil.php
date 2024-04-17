<?php

use App\Models\Cita;
use App\Models\Contrato;
use App\Models\DetallePago;
use App\Models\Paciente;
use App\Models\Receta;
use App\Models\User;
use App\Models\Venta;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReporteUtil
{
    public static function totalVentas($id_empresa)
    {
        $inicioMes = Carbon::now()->startOfMonth();
        $ventas = Venta::where('id_empresa', $id_empresa)
            ->where('estado', true)
            ->where('created_at', '>=',  $inicioMes)
            ->get();
        $total = 0;
        foreach ($ventas as $key => $value) {
            # code...
            $total = $total + $value->total_venta;
        }
        return $total;
    }

    public static function totalPacientes($id_empresa)
    {
        $inicioMes = Carbon::now()->startOfMonth();
        $ventas = Paciente::where('id_empresa', $id_empresa)
            ->where('created_at', '>=',  $inicioMes)
            ->where('estado', true)
            ->get();
        $total = 0;
        foreach ($ventas as $key => $value) {
            # code...
            $total++;
        }
        return $total;
    }
    public static function totalCitas($id_empresa)
    {
        $inicioMes = Carbon::now()->startOfMonth()->format('Y-m-d');
        $ventas = Cita::where('id_empresa', $id_empresa)
            ->where('fecha_inicio_cita', '>=',  $inicioMes)
            ->where('estado', true)
            ->get();
        $total = 0;
        foreach ($ventas as $key => $value) {
            # code...
            $total++;
        }
        return $total;
    }
    public static function totalContratos($id_empresa)
    {
        $inicioMes = Carbon::now()->startOfMonth();
        $ventas = Contrato::where('id_empresa', $id_empresa)
            ->where('created_at', '>=',  $inicioMes)
            ->where('estado', true)
            ->get();
        $total = 0;
        foreach ($ventas as $key => $value) {
            # code...
            $total++;
        }
        return $total;
    }
    public static function totalRecetas($id_empresa)
    {
        $inicioMes = Carbon::now()->startOfMonth();
        $ventas = Receta::where('id_empresa', $id_empresa)
            ->where('created_at', '>=',  $inicioMes)
            ->where('estado_rec', true)
            ->get();
        $total = 0;
        foreach ($ventas as $key => $value) {
            # code...
            $total++;
        }
        return $total;
    }
    public static function totalCuotas($id_empresa)
    {

        $ventas = DetallePago::where('contratos.id_empresa', $id_empresa)
            ->join('pagos', 'pagos.id_pago', 'detalle_pagos.id_pago')
            ->join('contratos', 'contratos.id_pago', 'pagos.id_pago')
            ->where('contratos.estado_contrato', config('constants.ESTADO_CONTRATO_ACTIVO'))
            ->where('detalle_pagos.estado', true)
            ->get();
        $total = 0;
        foreach ($ventas as $key => $value) {
            # code...
            $total++;
        }
        return $total;
    }

    public static function pacientesMesPasado($id_empresa)
    {
        $mesPasado = Carbon::now()->startOfMonth()->subMonths(1);
        $mesActual = Carbon::now()->startOfMonth();
        $pacientes = Paciente::where('id_empresa', $id_empresa)
            ->where('created_at', '>=',  $mesPasado)
            ->where('created_at', '<=',  $mesActual)
            ->where('estado', true)
            ->get();
        $total_mes_anterior = 0;
        foreach ($pacientes as $key => $value) {
            # code...
            $total_mes_anterior++;
        }
        $total_actual = self::totalPacientes($id_empresa);
        $sub = $total_mes_anterior - $total_actual;
        if ($sub && $total_mes_anterior) {
            # code...
            $pre = abs($sub) / abs($total_mes_anterior);
            $total = abs($pre) * 100;

            return (int)$total;
        } else {
            return 0;
        }
    }

    public static function getCuotaActual($id_empresa)
    {
        $detalle = DetallePago::join('contratos', 'contratos.id_pago', 'detalle_pagos.id_pago')
            ->where('contratos.estado_contrato', config('constants.ESTADO_CONTRATO_ACTIVO'))
            ->where('detalle_pagos.estado_detalle', config('constants.ESTADO_DETALLE_PAGO_INCOMPLETO'))
            ->where('contratos.id_empresa', $id_empresa)
            ->where('detalle_pagos.estado', true)
            ->first();

        return $detalle;
    }

    public static function getVentasAnuales($id_empresa)
    {
        DB::statement("SET lc_time_names = 'es_PE'");
        return DB::select(
            '
            SELECT MONTHNAME(v.created_at) AS Mes,
                SUM(v.total_venta) AS Total
            FROM ventas v
            WHERE v.id_empresa = ' . auth()->user()->id_empresa . ' 
            AND YEAR(v.created_at) = ' . date('Y') . '
            GROUP BY Mes
            ORDER BY Mes ASC ;'
        );
    }
}
