<!DOCTYPE html>
<html lang="es-co">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Organismo - FM 1</title>
    <link type="text/css" rel="stylesheet" href="{{ asset('dist/css/fotomultas.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/libs/bootstrap/dist/css/bootstrap.min.css') }}" />

    <meta name="author" content="Andrés Herrera García">
    <meta name="description" content="PDF de una fotomulta">
    <meta name="keywords" content="fotomulta, comparendo">
</head>

@php
    $empresas = DB::select('select * from empresas where id_empresa = ' . auth()->user()->id_empresa);
    foreach ($empresas as $empresa) {
    }
@endphp

<body>
    <table width="100%">
        <tbody>
            <tr>
                <td width="33%">
                    <b>DIRECCIÓN: </b> <br>{{ $empresa->direccion_empresa }}
                    <br>
                    <b>RUC: </b> {{ $empresa->ruc_empresa }}
                    <br>
                    <b>RAZON SOCIAL: </b> {{ $empresa->razon_social_empresa }}
                </td>
                <td style="text-align: center;" width="34%">

                    <img alt="Logo del organismo" src="{{ $empresa->logo_empresa }}" style="height: 150px;"
                        title="Logo del organismo">

                </td>
                <td style="text-align: center;" width="33%">
                    
                    <b>FECHA: </b> <br>{{ date('d-m-Y H:i', strtotime($date)) }}
                    <h2>CITA MÉDICA N° {{ $data['nro_historia_clinica'] }}</h2>
                </td>
            </tr>
        </tbody>
    </table>
    <br>
    <table width="100%">
        <tbody>
            <tr>
                <td style="text-align: center;" width="100%">
                    <table class="bordered" style="width: 100%;">
                        <caption style="text-align: center; color: white; background: #6999FF"> DATOS DE CITA</caption>
                        <tbody>
                            <tr>
                                <td style="text-align: center;" width="50%">PACIENTE</td>
                                <td style="text-align: center;" width="50%">{{ $data['nombres_paciente'] }}</td>
                            </tr>
                            <tr>
                                <td style="text-align: center;" width="50%">DNI</td>
                                <td style="text-align: center;" width="50%">{{ $data['dni_paciente'] }}</td>
                            </tr>
                            <tr>
                                <td style="text-align: center;" width="50%">FECHA</td>
                                <td style="text-align: center;" width="50%">
                                    {{ date('d-m-Y', strtotime($data['fecha_inicio_cita'])) }}</td>
                            </tr>
                            <tr>
                                <td style="text-align: center;" width="50%">HORA</td>
                                <td style="text-align: center;" width="50%">
                                    {{ date('H:i', strtotime($data['fecha_inicio_cita'])) }}</td>
                            </tr>
                            <tr>
                                <td style="text-align: center;" width="50%">MOTIVO DE CITA</td>
                                <td style="text-align: center;" width="50%">{{ $data['motivo_cita'] }}</td>
                            </tr>
                            <tr>
                                <td style="text-align: center;" width="50%">DESCRIPCIÓN </td>
                                <td style="text-align: center;" width="50%">{{ $data['descripcion_cita'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

</body>

</html>
