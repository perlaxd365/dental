<?php

namespace App\Mail;

use App\Models\Cita;
use App\Models\Contrato;
use App\Models\DetallePago;
use App\Models\Empresa;
use App\Models\Receta;
use Carbon\Carbon;
use DateUtil;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Psy\Readline\Hoa\Console;

class AvisoPagoInternoMail extends Mailable
{
    use Queueable, SerializesModels;
    public $id_empresa;
    public $id_contrato;
    public $id_detalle_pago;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(int $id_empresa, int $id_contrato, int $id_detalle_pago)
    {
        //
        $this->id_empresa = $id_empresa;
        $this->id_contrato = $id_contrato;
        $this->id_detalle_pago = $id_detalle_pago;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        //traermos el correo de la empresa
        $empresa = Empresa::find($this->id_empresa);
        return new Envelope(
            from: config('constants.CORREO_NOTIFICACION_PAGO'),
            subject: 'VENCIMIENTO DE PAGO - '. $empresa->nombre_comercial_empresa,
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        $empresa = Empresa::find($this->id_empresa);
        $empresa_admin = Empresa::find(config('constants.EMPRESA_ADMIN'));
        $contrato = Contrato::find($this->id_contrato);
        $detalle_pago = DetallePago::find($this->id_detalle_pago);
        date_default_timezone_set('America/Lima');
        $date = Carbon::now();
        $fechas = [
            "fin_contrato" => DateUtil::getFecha($date::parse($contrato->fecha_fin_contrato)),
            "fin_cuota" => DateUtil::getFecha($date::parse($detalle_pago->fecha_fin_detalle)),

        ];
        return new Content(
            view: 'livewire.contrato.mail.vencimiento-pago-interno',
            with: [
                'date' => $date,
                'empresa' => $empresa,
                'contrato' => $contrato,
                'fechas' => $fechas,
                'empresa_admin' => $empresa_admin
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        /*  $receta = Receta::find($this->id_receta);
        return [
            Attachment::fromData(fn () => Storage::disk('public')->get($receta->pdf_rec), 'RECETA_MEDICA.pdf')
                ->withMime('application/pdf'),
        ]; */
    }
}
