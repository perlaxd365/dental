<?php

namespace App\Http\Livewire\Historia;

use App\Models\DetalleVenta;
use App\Models\Empresa;
use App\Models\Paciente;
use App\Models\Receta;
use App\Models\Venta;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Index extends Component
{

    use WithPagination;
    protected $paginationTheme = "bootstrap";
    public $pacientes = [];
    public $recetas = [];
    public $ventas = [];
    public $id_paciente;
    public $view = "create";

    //datos de paciente
    public $nombres_paciente,
        $dni_paciente,
        $email_paciente,
        $telefono_paciente;

    public function render()
    {
        return view('livewire.historia.index');
    }

    public function mount()
    {
        $this->pacientes = Paciente::where('estado', true)
            ->where('id_empresa', auth()->user()->id_empresa)->get();
    }

    public function updatingIdPaciente($id_paciente)
    {
        //datos de paciente
        $paciente = Paciente::find($id_paciente);
        $this->nombres_paciente = $paciente->nombres_paciente;
        $this->dni_paciente = $paciente->dni_paciente;
        $this->email_paciente = $paciente->email_paciente;
        $this->telefono_paciente = $paciente->telefono_paciente;

        //datos de ventas
        $this->ventas = Venta::where('id_paciente', $id_paciente)->get();
        //datos de recetas
        $this->recetas = Receta::where('id_paciente', $id_paciente)->get();
    }

    public function listaDetalle($id_venta)
    {
        return DetalleVenta::where("id_venta", $id_venta)->where("estado", true)->get();
    }

    public function print($id_venta)
    {
        $venta = Venta::find($id_venta);
        $data_venta = [
            'id_venta'  => $id_venta,
            'sub_total_venta' => $venta->sub_total_venta,
            'igv_venta' => $venta->igv_venta,
            'total_venta' => $venta->total_venta,
            'fecha_venta' => $venta->created_at
        ];
        $data_detalle_venta = [];

        $detalle = DetalleVenta::where('id_venta', $id_venta)->get();
        foreach ($detalle as $key => $detalle_venta) {
            # code...

            array_push(
                $data_detalle_venta,
                array(
                    'id_tipo_producto' => $detalle_venta->id_tipo_producto,
                    'nombre_detalle' => $detalle_venta->nombre_detalle,
                    'cantidad_detalle' => $detalle_venta->cantidad_detalle,
                    'unidad_detalle' => $detalle_venta->unidad_detalle,
                    'precio_unitario_detalle' => $detalle_venta->precio_unitario_detalle,
                    'precio_total_detalle' => $detalle_venta->precio_total_detalle,
                    'precio_total_detalle' => $detalle_venta->precio_total_detalle,
                )
            );
        }
        $empresa = Empresa::find(auth()->user()->id_empresa);
        $paciente = Paciente::find($venta->id_paciente);
        date_default_timezone_set('America/Lima');
        $date = Carbon::now();
        $customPaper = array(0, 0, 204, 650);
        $writer = base64_encode(QrCode::format('svg')->size(70)->generate($empresa->pagina_empresa));
        $pdfContent = Pdf::loadView('livewire.venta.print.invoice',  compact('date', 'empresa', 'data_venta', 'data_detalle_venta', 'writer', 'paciente'))
            ->setPaper($customPaper)->output();
        return response()->streamDownload(
            fn () => print($pdfContent),
            "venta_" .  time() . ".pdf"
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

}
