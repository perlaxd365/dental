<?php

namespace App\Console\Commands;

use App\Mail\AvisoPagoInterno;
use App\Mail\AvisoPagoInternoMail;
use App\Mail\PagoMail;
use App\Mail\RecetaMail;
use App\Models\Contrato;
use App\Models\DetallePago;
use App\Models\Empresa;
use Carbon\Carbon;
use ContratoUtil;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class PagoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:pago';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $contratos = Contrato::all();
        foreach ($contratos as $value) {
            # code...
            if ($value->fecha_fin_contrato < now()) {
                # code...
                Contrato::find($value->id_contrato)->update([
                    'estado_contrato' => config('constants.ESTADO_CONTRATO_FINALIZADO')
                ]);
                ContratoUtil::suspenderUsuarios($value->id_empresa);
            }
        }


        $detallePagos = DetallePago::all();

        foreach ($detallePagos as $value) {
            # code...
            $fecha_fin_cuota = new Carbon($value->fecha_fin_detalle);
            if (
                $fecha_fin_cuota->subDays(1) < now()
                && $value->estado_detalle == config('constants.ESTADO_DETALLE_PAGO_INCOMPLETO')
                && !$value->notificacion_detalle
            ) {
                # code...
                $contrato = Contrato::join("pagos", "pagos.id_pago", "contratos.id_pago")
                    ->where("pagos.id_pago", $value->id_pago)->first();
                $empresa = Empresa::find($value->id_empresa);
                DetallePago::find($value->id_detalle_pago)->update([
                    'fecha_notificacion_detalle' => now(),
                    'notificacion_detalle' => true
                ]);
                Mail::to($empresa->email_personal_empresa)->send(new PagoMail($empresa->id_empresa, $contrato->id_contrato, $value->id_detalle_pago));
                Mail::to(config('constants.CORREO_NOTIFICACION_PAGO'))->send(new AvisoPagoInternoMail($empresa->id_empresa, $contrato->id_contrato, $value->id_detalle_pago));
            }
        }
    }
}
