<?php

namespace App\Mail;

use App\Models\Cita;
use App\Models\Empresa;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Psy\Readline\Hoa\Console;

class CitaMail extends Mailable
{
    use Queueable, SerializesModels;
    public $id_cita;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(int $id_cita)
    {
        //
        $this->id_cita = $id_cita;
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
        return new Envelope(
            from: $empresa->email_empresa,
            subject: 'Citación correo',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        
        $data = Cita::join('pacientes', 'pacientes.id_paciente', 'citas.id_paciente')->where('citas.id_cita', $this->id_cita)->where('citas.estado', true)->first();

        $empresa = Empresa::find(auth()->user()->id_empresa);
        date_default_timezone_set('America/Lima');
        $date = Carbon::now();
        return new Content(
            view: 'livewire.cita.print.email',
            with:[
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
        return [];
    }
}
