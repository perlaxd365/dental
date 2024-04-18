<?php

namespace App\Mail;

use App\Models\Cita;
use App\Models\Empresa;
use App\Models\Receta;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Psy\Readline\Hoa\Console;

class RecetaMail extends Mailable
{
    use Queueable, SerializesModels;
    public $id_receta;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(int $id_receta)
    {
        //
        $this->id_receta = $id_receta;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        //traermos el correo de la empresa
        $empresa = Empresa::find(auth()->user()->id_empresa);
        dd($empresa->email_empresa);
        return new Envelope(
            from: $empresa->email_empresa,
            subject: 'Receta Médica - ' . $empresa->razon_social,
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {

        $data = Receta::join('pacientes', 'pacientes.id_paciente', 'recetas.id_paciente')->where('recetas.id_receta', $this->id_receta)->where('recetas.estado_rec', true)->first();

        $empresa = Empresa::find(auth()->user()->id_empresa);
        date_default_timezone_set('America/Lima');
        $date = Carbon::now();
        return new Content(
            view: 'livewire.receta.print.email',
            with: [
                'data' => $data,
                'date' => $date,
                'empresa' => $empresa
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
        $receta = Receta::find($this->id_receta);
        return [
            Attachment::fromData(fn () => Storage::disk('public')->get($receta->pdf_rec), 'RECETA_MEDICA.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
