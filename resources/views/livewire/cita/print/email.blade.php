<!DOCTYPE html>
<html lang="es-co">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Impresión de Cita #{{ $data['nro_historia_clinica'] }}</title>
    <link type="text/css" rel="stylesheet" href="{{ asset('dist/css/fotomultas.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/libs/bootstrap/dist/css/bootstrap.min.css') }}" />

</head>

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
                    
                    <b>FECHA: </b> <br>{{ date('d-m-Y H:i ', strtotime($date)) }}
                    
                    <h4>CITA MÉDICA <br> N° {{ $data['nro_historia_clinica'] }}</h4>
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
                        <caption style="text-align: center; color: white; background: #6999FF"><b> DATOS DE CITA</b></caption>
                        <tbody>
                            <tr>
                                <td style="text-align: center;" width="50%"><b>PACIENTE:</b></td>
                                <td style="text-align: center;" width="50%">{{ $data['nombres_paciente'] }}</td>
                            </tr>
                            <tr>
                                <td style="text-align: center;" width="50%"><b>DNI:</b></td>
                                <td style="text-align: center;" width="50%">{{ $data['dni_paciente'] }}</td>
                            </tr>
                            <tr>
                                <td style="text-align: center;" width="50%"><b>FECHA</b></td>
                                <td style="text-align: center;" width="50%">
                                    {{ date('d-m-Y', strtotime($data['fecha_inicio_cita'])) }}</td>
                            </tr>
                            <tr>
                                <td style="text-align: center;" width="50%"><b>HORA:</b></td>
                                <td style="text-align: center;" width="50%">
                                    {{ date("g:i a",strtotime($data['fecha_inicio_cita']));  }}</td>
                            </tr>
                            <tr>
                                <td style="text-align: center;" width="50%"><b>MOTIVO DE CITA:</b></td>
                                <td style="text-align: center;" width="50%">{{ $data['motivo_cita'] }}</td>
                            </tr>
                            <tr>
                                <td style="text-align: center;" width="50%"><b>DESCRIPCIÓN:</b> </td>
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
