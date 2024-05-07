<?php

namespace App\Http\Livewire\Receta;

use App\Mail\CitaMail;
use App\Mail\RecetaMail;
use App\Models\Empresa;
use App\Models\OjoDerecho;
use App\Models\OjoIzquierdo;
use App\Models\Paciente;
use App\Models\Receta;
use App\Models\TipoUsuario;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\ValidationException;
use PersonaUtil;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    public $search;
    public $show;
    public $table;
    public $pacientes = [];
    public $view = "create";
    //DATOS DE RECETA
    public $id_paciente, $id_receta, $astigmatismo_rec, $hipermetropia_rec, $miopia_rec,
        $presbicia_rec, $adicion_rec, $dip_lejos_rec, $dip_cerca_rec, $add_cerca_rec, $add_intermedio_rec, $naso_pupilar_od_rec, $oi_rec,
        $recomendacion_rec, $estado_rec;

    //DATOS DE OJO DERECHO
    public $id_ojo_derecho, $esfera_derecho, $cilindro_derecho, $eje_derecho, $agudeza_visual_derecho, $dp_derecho, $estado_derecho;

    //DATOS DE OJO IZQUIERDO
    public $id_ojo_izquierdo, $esfera_izquierdo, $cilindro_izquierdo, $eje_izquierdo, $agudeza_visual_izquierdo, $dp_izquierdo, $estado_izquierdo;

    //agregar paciente
    public
        $idpaciente,
        $dni_paciente,
        $nombres_paciente,
        $direccion_paciente,
        $estado_civil_paciente,
        $sexo_paciente,
        $fecha_nacimiento_paciente,
        $edad_paciente,
        $telefono_paciente,
        $mayor_edad_paciente,
        $grado_instruccion_paciente,
        $ocupacion_paciente,
        $dni_acompaniante_paciente,
        $nombres_acompaniante_paciente,
        $email_paciente,
        $pais_paciente,
        $departamento_paciente,
        $provincia_paciente,
        $distrito_paciente;

    public $permiso;

    public $correo_receta_send;

    public function mount()
    {
        $this->pacientes = Paciente::where('estado', true)
            ->where('id_empresa', auth()->user()->id_empresa)->get();
        $this->show = 6;
        $this->table = true;
        $this->mayor_edad_paciente = true;
    }
    public function render()
    {
        $lista_receta = Receta::select('*', 'recetas.created_at as fecha_receta')
            ->join('ojo_derechos', 'recetas.id_ojo_derecho', 'ojo_derechos.id_ojo_derecho')
            ->join('ojo_izquierdos', 'recetas.id_ojo_izquierdo', 'ojo_izquierdos.id_ojo_izquierdo')
            ->join('pacientes', 'recetas.id_paciente', 'pacientes.id_paciente')
            ->join('empresas', 'empresas.id_empresa', 'recetas.id_empresa')
            ->where('recetas.estado_rec', true)
            ->orderby('recetas.created_at', 'desc');

        //verificamos el permiso si es admin para listar
        $this->permiso = TipoUsuario::find(auth()->user()->id_tipo_usuario);
        if ($this->permiso->nombre_tipo_usuario != 'Administrador') {
            $lista_receta->where('empresas.id_empresa', auth()->user()->id_empresa);
        }
        $lista_receta->where(function ($query) {
            return $query
                ->orwhere('nombres_paciente', 'LIKE', '%' . $this->search . '%')
                ->orwhere('dni_paciente', 'LIKE', '%' . $this->search . '%');
        });
        $lista =  $lista_receta->paginate($this->show);
        return view('livewire.receta.index', compact('lista'));
    }

    public function buscarDNI()
    {
        $data_dni = PersonaUtil::getDni($this->dni_paciente);

        if ($data_dni["error"]) {
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'error', 'title' => $data_dni["error"], 'message' => 'Error']
            );
        } else {
            $datos = json_decode($data_dni["response"], true);
            if ($datos != null) {
                $nombres =  $datos["nombres"] . " " . $datos["apellidoPaterno"] . " " . $datos["apellidoMaterno"];
                $this->dispatchBrowserEvent(
                    'alert',
                    ['type' => 'success', 'title' => $nombres, 'message' => 'Exito']
                );
                $this->nombres_paciente = $nombres;
            } else {
                $this->dispatchBrowserEvent(
                    'alert',
                    ['type' => 'error', 'title' => 'No se encontraron resultados ', 'message' => 'Error']
                );
            }
        }
    }
    public function agregarPaciente()
    {
        $verificar_paciente = Paciente::where('dni_paciente', $this->dni_paciente)->where('id_empresa', auth()->user()->id_empresa)->first();
        if ($verificar_paciente) {
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'error', 'title' => 'El paciente ya se encuentra registrado', 'message' => 'Error']
            );
            throw ValidationException::withMessages(['dni_paciente' => 'Dni ya se encuentra agregado.']);
        }
        $messages = [
            'dni_paciente.required' => 'Por favor introduce el dni del paciente',
            'nombres_paciente.required' => 'Por favor introducir nombres del paciente',
        ];

        $rules = [

            'dni_paciente' => 'required',
            'nombres_paciente' => 'required',

        ];
        $this->validate($rules, $messages);

        $paciente = Paciente::create([
            'dni_paciente' => $this->dni_paciente,
            'nombres_paciente'  => $this->nombres_paciente,
            'direccion_paciente'  => $this->direccion_paciente,
            'estado_civil_paciente'  => $this->estado_civil_paciente,
            'sexo_paciente'  => $this->sexo_paciente,
            'fecha_nacimiento_paciente'  => $this->fecha_nacimiento_paciente,
            'edad_paciente'  => $this->edad_paciente,
            'telefono_paciente'  => $this->telefono_paciente,
            'mayor_edad_paciente'  => $this->mayor_edad_paciente,
            'grado_instruccion_paciente'  => $this->grado_instruccion_paciente,
            'ocupacion_paciente'  => $this->ocupacion_paciente,
            'dni_acompaniante_paciente'  => $this->dni_acompaniante_paciente,
            'nombres_acompaniante_paciente'  => $this->nombres_acompaniante_paciente,
            'email_paciente'  => $this->email_paciente,
            'pais_paciente'  => $this->pais_paciente,
            'departamento_paciente'  => $this->departamento_paciente,
            'provincia_paciente'  => $this->provincia_paciente,
            'distrito_paciente'  => $this->distrito_paciente,
            'estado'  => true,
            'id_empresa' => auth()->user()->id_empresa

        ]);

        // show alert
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success', 'title' => 'Se guardó al paciente correctamente', 'message' => 'Exito']
        );
        // show alert
        $this->dispatchBrowserEvent(
            'close-modal-paciente',
            []
        );

        // show alert
        $this->dispatchBrowserEvent(
            'data',
            ['id_paciente' => $paciente->id_paciente, 'nombres_paciente' => $paciente->nombres_paciente]
        );

        $this->defaultPaciente();
    }
    public function defaultPaciente()
    {
        $this->dni_paciente = "";
        $this->nombres_paciente = "";
        $this->direccion_paciente = "";
        $this->estado_civil_paciente = "";
        $this->sexo_paciente = "";
        $this->fecha_nacimiento_paciente = "";
        $this->edad_paciente = "";
        $this->telefono_paciente = "";
        $this->mayor_edad_paciente = true;
        $this->grado_instruccion_paciente = "";
        $this->ocupacion_paciente = "";
        $this->dni_acompaniante_paciente = "";
        $this->nombres_acompaniante_paciente = "";
        $this->email_paciente = "";
        $this->pais_paciente = "";
        $this->departamento_paciente = "";
        $this->provincia_paciente = "";
        $this->distrito_paciente = "";
    }

    public function agregar()
    {

        $messages = [
            'id_paciente.required' => 'Por favor seleccionar un paciente por favor',
            'esfera_derecho.required' => 'Por favor ingresar el valor de la Esfera',
            'cilindro_derecho.required' => 'Por favor ingresar el valor de Cilindro',
            'eje_derecho.required' => 'Por favor ingresar el valor dl Eje',
            'esfera_izquierdo.required' => 'Por favor ingresar el valor de la Esfera',
            'cilindro_izquierdo.required' => 'Por favor ingresar el valor de Cilindro',
            'eje_izquierdo.required' => 'Por favor ingresar el valor dl Eje',
        ];

        $rules = [
            'id_paciente' => 'required',
            'esfera_derecho' => 'required',
            'cilindro_derecho' => 'required',
            'eje_derecho' => 'required',
            'esfera_izquierdo' => 'required',
            'cilindro_izquierdo' => 'required',
            'eje_izquierdo' => 'required',
        ];
        $this->validate($rules, $messages);

        $ojo_derecho_create =  OjoDerecho::create([
            'esfera_derecho' => $this->esfera_derecho,
            'cilindro_derecho' => $this->cilindro_derecho,
            'eje_derecho' => $this->eje_derecho,
            'agudeza_visual_derecho' => $this->agudeza_visual_derecho,
            'dp_derecho' => $this->dp_derecho,
            'estado_derecho' => true,
            'id_empresa' => auth()->user()->id_empresa,
        ]);

        if (!$ojo_derecho_create) {
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'error', 'title' => 'Faltan llenar campos en el ojo derecho', 'message' => 'Error']
            );
        }

        $ojo_izquierdo_create =  OjoIzquierdo::create([
            'esfera_izquierdo' => $this->esfera_izquierdo,
            'cilindro_izquierdo' => $this->cilindro_izquierdo,
            'eje_izquierdo' => $this->eje_izquierdo,
            'agudeza_visual_izquierdo' => $this->agudeza_visual_izquierdo,
            'dp_izquierdo' => $this->dp_izquierdo,
            'estado_izquierdo' => true,
            'id_empresa' => auth()->user()->id_empresa,
        ]);

        if (!$ojo_izquierdo_create) {
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'error', 'title' => 'Faltan llenar campos en el ojo izquierdo', 'message' => 'Error']
            );
        }


        $receta_create =  Receta::create([
            'id_paciente'           => $this->id_paciente,
            'id_ojo_derecho'        => $ojo_izquierdo_create->id_ojo_izquierdo,
            'id_ojo_izquierdo'      => $ojo_derecho_create->id_ojo_derecho,
            'astigmatismo_rec'      => ($this->astigmatismo_rec) ? $this->astigmatismo_rec : 0,
            'hipermetropia_rec'     => ($this->hipermetropia_rec) ? $this->hipermetropia_rec : 0,
            'miopia_rec'            => ($this->miopia_rec) ? $this->miopia_rec : 0,
            'presbicia_rec'         => ($this->presbicia_rec) ? $this->presbicia_rec : 0,
            'adicion_rec'           => $this->adicion_rec,
            'dip_lejos_rec'         => $this->dip_lejos_rec,
            'dip_cerca_rec'         => $this->dip_cerca_rec,
            'add_cerca_rec'         => $this->add_cerca_rec,
            'add_intermedio_rec'    => $this->add_intermedio_rec,
            'naso_pupilar_od_rec'   => $this->naso_pupilar_od_rec,
            'oi_rec'                => $this->oi_rec,
            'recomendacion_rec'     => $this->recomendacion_rec,
            'estado_rec'            => true,
            'id_empresa'            => auth()->user()->id_empresa,
        ]);

        if (!$receta_create) {
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'error', 'title' => 'Faltan llenar campos de la receta', 'message' => 'Error']
            );
        }

        // show alert
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success', 'title' => 'Se guardó la receta correctamente', 'message' => 'Exito']
        );
        $this->default();
    }


    public function default()
    {
        $this->id_paciente              = '';
        $this->esfera_derecho           = '';
        $this->cilindro_derecho         = '';
        $this->eje_derecho              = '';
        $this->agudeza_visual_derecho   = '';
        $this->dp_derecho               = '';
        $this->esfera_izquierdo         = '';
        $this->cilindro_izquierdo       = '';
        $this->eje_izquierdo            = '';
        $this->agudeza_visual_izquierdo = '';
        $this->dp_izquierdo             = '';
        $this->id_paciente              = '';
        $this->astigmatismo_rec         = '';
        $this->hipermetropia_rec        = '';
        $this->miopia_rec               = '';
        $this->presbicia_rec            = '';
        $this->adicion_rec              = '';
        $this->dip_lejos_rec            = '';
        $this->dip_cerca_rec            = '';
        $this->add_cerca_rec            = '';
        $this->add_intermedio_rec       = '';
        $this->naso_pupilar_od_rec      = '';
        $this->oi_rec                   = '';
        $this->recomendacion_rec        = '';
        $this->view                     = 'create';
        $this->table                    = true;
    }


    public function edit($id)
    {
        $this->view = "edit";
        $this->table = false;
        $receta = Receta::find($id);
        //ids
        $this->id_receta                = $id;
        $this->id_ojo_derecho           = $receta->id_ojo_derecho;
        $this->id_ojo_izquierdo         = $receta->id_ojo_izquierdo;
        //buscamos ojo derecho
        $ojo_derecho                    = OjoDerecho::find($receta->id_ojo_derecho);
        $this->esfera_derecho           = $ojo_derecho->esfera_derecho;
        $this->cilindro_derecho         = $ojo_derecho->cilindro_derecho;
        $this->eje_derecho              = $ojo_derecho->eje_derecho;
        $this->agudeza_visual_derecho   = $ojo_derecho->agudeza_visual_derecho;
        $this->dp_derecho               = $ojo_derecho->dp_derecho;
        //buscamos ojo izquierdo
        $ojo_izquierdo                  = OjoIzquierdo::find($receta->id_ojo_izquierdo);
        $this->esfera_izquierdo         = $ojo_izquierdo->esfera_izquierdo;
        $this->cilindro_izquierdo       = $ojo_izquierdo->cilindro_izquierdo;
        $this->agudeza_visual_izquierdo = $ojo_izquierdo->agudeza_visual_izquierdo;
        $this->eje_izquierdo            = $ojo_izquierdo->eje_izquierdo;
        $this->dp_izquierdo             = $ojo_izquierdo->dp_izquierdo;

        $this->id_paciente              = $receta->id_paciente;
        $paciente                       = Paciente::find($receta->id_paciente);
        $this->nombres_paciente         = $paciente->nombres_paciente;
        $this->astigmatismo_rec         = $receta->astigmatismo_rec;
        $this->hipermetropia_rec        = $receta->hipermetropia_rec;
        $this->miopia_rec               = $receta->miopia_rec;
        $this->presbicia_rec            = $receta->presbicia_rec;
        $this->adicion_rec              = $receta->adicion_rec;
        $this->dip_lejos_rec            = $receta->dip_lejos_rec;
        $this->dip_cerca_rec            = $receta->dip_cerca_rec;
        $this->add_cerca_rec            = $receta->add_cerca_rec;
        $this->add_intermedio_rec       = $receta->add_intermedio_rec;
        $this->naso_pupilar_od_rec      = $receta->naso_pupilar_od_rec;
        $this->oi_rec                   = $receta->oi_rec;
        $this->recomendacion_rec        = $receta->recomendacion_rec;

        $this->resetErrorBag();
        $this->resetValidation();
        // show paciente
        $this->dispatchBrowserEvent(
            'data',
            ['id_paciente' => $paciente->id_paciente, 'nombres_paciente' => $paciente->nombres_paciente]
        );
    }

    public function update()
    {

        $messages = [
            'id_paciente.required' => 'Por favor seleccionar un paciente por favor',
            'esfera_derecho.required' => 'Por favor ingresar el valor de la Esfera',
            'cilindro_derecho.required' => 'Por favor ingresar el valor de Cilindro',
            'eje_derecho.required' => 'Por favor ingresar el valor dl Eje',
            'esfera_izquierdo.required' => 'Por favor ingresar el valor de la Esfera',
            'cilindro_izquierdo.required' => 'Por favor ingresar el valor de Cilindro',
            'eje_izquierdo.required' => 'Por favor ingresar el valor dl Eje',
        ];

        $rules = [
            'id_paciente' => 'required',
            'esfera_derecho' => 'required',
            'cilindro_derecho' => 'required',
            'eje_derecho' => 'required',
            'esfera_izquierdo' => 'required',
            'cilindro_izquierdo' => 'required',
            'eje_izquierdo' => 'required',
        ];
        $this->validate($rules, $messages);

        $ojo_derecho_update = OjoDerecho::find($this->id_ojo_derecho);
        $ojo_derecho_update->update([
            'esfera_derecho' => $this->esfera_derecho,
            'cilindro_derecho' => $this->cilindro_derecho,
            'eje_derecho' => $this->eje_derecho,
            'agudeza_visual_derecho' => $this->agudeza_visual_derecho,
            'dp_derecho' => $this->dp_derecho,
            'estado_derecho' => true,
            'id_empresa' => auth()->user()->id_empresa,
        ]);

        if (!$ojo_derecho_update) {
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'error', 'title' => 'Faltan llenar campos en el ojo derecho', 'message' => 'Error']
            );
        }

        $ojo_izquierdo_update = OjoIzquierdo::find($this->id_ojo_izquierdo);
        $ojo_izquierdo_update->update([
            'esfera_izquierdo' => $this->esfera_izquierdo,
            'cilindro_izquierdo' => $this->cilindro_izquierdo,
            'eje_izquierdo' => $this->eje_izquierdo,
            'agudeza_visual_izquierdo' => $this->agudeza_visual_izquierdo,
            'dp_izquierdo' => $this->dp_izquierdo,
            'estado_izquierdo' => true,
            'id_empresa' => auth()->user()->id_empresa,
        ]);

        if (!$ojo_izquierdo_update) {
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'error', 'title' => 'Faltan llenar campos en el ojo izquierdo', 'message' => 'Error']
            );
        }


        $receta_update = Receta::find($this->id_receta);
        $receta_update->update([
            'id_paciente'           => $this->id_paciente,
            'astigmatismo_rec'      => ($this->astigmatismo_rec) ? $this->astigmatismo_rec : 0,
            'hipermetropia_rec'     => ($this->hipermetropia_rec) ? $this->hipermetropia_rec : 0,
            'miopia_rec'            => ($this->miopia_rec) ? $this->miopia_rec : 0,
            'presbicia_rec'         => ($this->presbicia_rec) ? $this->presbicia_rec : 0,
            'adicion_rec'           => $this->adicion_rec,
            'dip_lejos_rec'         => $this->dip_lejos_rec,
            'dip_cerca_rec'         => $this->dip_cerca_rec,
            'add_cerca_rec'         => $this->add_cerca_rec,
            'add_intermedio_rec'    => $this->add_intermedio_rec,
            'naso_pupilar_od_rec'   => $this->naso_pupilar_od_rec,
            'oi_rec'                => $this->oi_rec,
            'recomendacion_rec'     => $this->recomendacion_rec,
            'estado_rec'            => true,
        ]);

        if (!$receta_update) {
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'error', 'title' => 'Faltan llenar campos de la receta', 'message' => 'Error']
            );
        }

        // show alert
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success', 'title' => 'Se actualizó la receta correctamente', 'message' => 'Exito']
        );
        $this->default();
    }


    public function delete($id)
    {
        $receta = Receta::find($id);
        $receta->update([
            'estado_rec' => false
        ]);
        // show alert
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'warning', 'title' => 'Se eliminó la receta correctamente ', 'message' => 'Exito']
        );
    }

    public function printReceta($id_receta)
    {

        $receta = Receta::select('*', 'recetas.created_at as fecha_receta')
            ->join('ojo_derechos', 'recetas.id_ojo_derecho', 'ojo_derechos.id_ojo_derecho')
            ->join('ojo_izquierdos', 'recetas.id_ojo_izquierdo', 'ojo_izquierdos.id_ojo_izquierdo')
            ->join('pacientes', 'recetas.id_paciente', 'pacientes.id_paciente')
            ->join('empresas', 'empresas.id_empresa', 'recetas.id_empresa')
            ->where('recetas.estado_rec', true)
            ->where('recetas.id_receta', $id_receta)
            ->first();



        $empresa = Empresa::find(auth()->user()->id_empresa);
        date_default_timezone_set('America/Lima');
        $date = Carbon::now();

        $pdfContent = Pdf::loadView('livewire.receta.print.invoice',  compact('receta', 'date', 'empresa'))
            ->setPaper('a4', 'landscape')->output();
        return $pdf = response()->streamDownload(
            fn () => print($pdfContent),
            "receta_" . $receta->dni_paciente . ".pdf"
        );
    }

    public function showModalEmail($id_receta)
    {
        $this->id_receta = $id_receta;
        $receta = Receta::select('*', 'recetas.created_at as fecha_receta')
            ->join('ojo_derechos', 'recetas.id_ojo_derecho', 'ojo_derechos.id_ojo_derecho')
            ->join('ojo_izquierdos', 'recetas.id_ojo_izquierdo', 'ojo_izquierdos.id_ojo_izquierdo')
            ->join('pacientes', 'recetas.id_paciente', 'pacientes.id_paciente')
            ->join('empresas', 'empresas.id_empresa', 'recetas.id_empresa')
            ->where('recetas.estado_rec', true)
            ->where('recetas.id_receta', $this->id_receta)
            ->first();
        $this->correo_receta_send = $receta->email_paciente;
        // show alert
        $this->dispatchBrowserEvent(
            'open-modal-email',
            []
        );
    }

    public function closeModalEmail()
    {
        $this->correo_receta_send = '';
        // show alert
        $this->dispatchBrowserEvent(
            'close-modal-email',
            []
        );
    }


    public function sendEmailReceta()
    {
        $receta = Receta::select('*', 'recetas.created_at as fecha_receta')
            ->join('ojo_derechos', 'recetas.id_ojo_derecho', 'ojo_derechos.id_ojo_derecho')
            ->join('ojo_izquierdos', 'recetas.id_ojo_izquierdo', 'ojo_izquierdos.id_ojo_izquierdo')
            ->join('pacientes', 'recetas.id_paciente', 'pacientes.id_paciente')
            ->join('empresas', 'empresas.id_empresa', 'recetas.id_empresa')
            ->where('recetas.estado_rec', true)
            ->where('recetas.id_receta', $this->id_receta)
            ->first();

        $empresa = Empresa::find(auth()->user()->id_empresa);
        date_default_timezone_set('America/Lima');
        $date = Carbon::now();
        $pdfContent = Pdf::loadView('livewire.receta.print.invoice',  compact('receta', 'date', 'empresa'))
            ->setPaper('a4', 'landscape')
            ->output();

        $path = "recetas/" . $receta->id_empresa . "/" . $receta->dni_paciente . '_' . time() . '.pdf';
        Storage::disk('public')->put($path, $pdfContent);
        $receta_up = Receta::find($this->id_receta);
        $receta_up->update([
            "pdf_rec" => $path
        ]);
        if (!$this->correo_receta_send) {
            # code...
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'error', 'title' => 'Por favor ingresar un correo para enviar la receta.', 'message' => 'Error']
            );
            throw ValidationException::withMessages(['correo_receta_send' => 'Dni ya se encuentra agregado.']);
        }
        Mail::to($this->correo_receta_send)->send(new RecetaMail($receta->id_receta));
        $this->closeModalEmail();
        // show alert
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success', 'title' => 'Se envíó a correo correctamente', 'message' => 'Exito']
        );
    }
}
