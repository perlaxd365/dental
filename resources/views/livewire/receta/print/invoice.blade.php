<!DOCTYPE html>
<html lang="es-co">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Impresión de Receta #{{ $receta->id_receta }}</title>
    <link type="text/css" rel="stylesheet" href="{{ asset('dist/css/fotomultas.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/libs/bootstrap/dist/css/bootstrap.min.css') }}" />

</head>

<style>
    body {
        font-family: Arial, Helvetica, Verdana;
        font-size: 13px;
    }

    p {
        font-family: Georgia, Cambria, Times, "Times New Roman";
        font-size: 13px;
    }
</style>

<body>
    <div class="card">
        <div class="card-body">
            <table width="100%">
                <tbody>
                    <tr>
                        <td width="33%">
                            <ul class="list-unstyled">
                                <li class="text-muted">Empresa: <span
                                        style="color:#5d9fc5 ;">{{ $empresa->razon_social_empresa }}</span></li>
                                <li class="text-muted">Razón Social: {{ $empresa->razon_social_empresa }}</li>
                                <li class="text-muted">Ruc: {{ $empresa->ruc_empresa }}</li>
                                <li class="text-muted"><i class="fas fa-phone"></i>Dirección:
                                    {{ $empresa->direccion_empresa }}</li>
                            </ul>
                        </td>
                        <td style="text-align: center;" width="34%">

                            <img alt="Logo del organismo" src="{{ $empresa->logo_empresa }}" style="height: 150px;"
                                title="Logo del organismo">


                        </td>
                        <td style="text-align: center;" width="33%">

                            <b>FECHA: </b>
                            <br>{{ date('d-m-Y H:i ', strtotime($date)) }}

                            <h4>RECETA MÉDICA <br> N° 0000{{ $receta->id_receta }}
                            </h4>
                        </td>
                    </tr>
                </tbody>
            </table>
            <hr>
            <ul class="list-unstyled">
                <li class="text-muted">Paciente: <span style="color:#5d9fc5 ;">{{ $receta->nombres_paciente }}</span>
                </li>
            </ul>
            <p class="mb-0">Tabla de Medidas:</p>

            <div class="row my-2 mx-1 justify-content-center">
                <table class="table table-striped table-borderless">
                    <thead style="background-color:#84B0CA ;" class="text-white">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Esfera</th>
                            <th scope="col">Cilindro</th>
                            <th scope="col">Eje</th>
                            <th scope="col">Adición</th>
                            <th scope="col">Agudeza Visual</th>
                            <th scope="col">DP</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Ojo Derecho</th>
                            <td colspan="1">
                                {{ $receta->esfera_derecho }}
                            </td>
                            <td colspan="1">
                                {{ $receta->cilindro_derecho }}
                            </td>
                            <td colspan="1">
                                {{ $receta->eje_derecho }}
                            </td>
                            <td ROWSPAN=2>
                                {{ $receta->adicion_rec }}
                            </td>
                            <td colspan="1">
                                {{ $receta->agudeza_visual_derecho }}
                            </td>
                            <td colspan="1">
                                {{ $receta->dp_derecho }}
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Ojo Izquierdo</th>
                            <td>
                                {{ $receta->esfera_izquierdo }}
                            </td>
                            <td>
                                {{ $receta->cilindro_izquierdo }}
                            </td>
                            <td>
                                {{ $receta->eje_izquierdo }}
                            </td>
                            <td>
                                {{ $receta->agudeza_visual_izquierdo }}
                            </td>
                            <td>
                                {{ $receta->dp_izquierdo }}
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">ADD Cerca:</th>
                            <td COLSPAN=2>
                                {{ $receta->add_cerca_rec }}
                            </td>
                            <th scope="row">ADD Itermedia</th>
                            <td COLSPAN=3>
                                {{ $receta->add_intermedio_rec }}
                            </td>
                        </tr>
                    </tbody>
                </table>

                <hr>
                <table width="100%">
                    <tbody>
                        <tr>
                            <td width="15%">
                                <blockquote class="blockquote">
                                    <p class="mb-0">Se diagnostica al paciente:</p>
                                    <footer class="blockquote-footer"> <cite title="Source Title">Astigmatismo:</cite>
                                        {{ $receta->astigmatismo_rec ? 'SI' : 'NO' }}</footer>
                                    <footer class="blockquote-footer"> <cite title="Source Title">Hipermetropía:</cite>
                                        {{ $receta->hipermetropia_rec ? 'SI' : 'NO' }}</footer>
                                    <footer class="blockquote-footer"> <cite title="Source Title">Miopía:</cite>
                                        {{ $receta->miopia_rec ? 'SI' : 'NO' }}</footer>
                                    <footer class="blockquote-footer"> <cite title="Source Title">Presbicia:</cite>
                                        {{ $receta->presbicia_rec ? 'SI' : 'NO' }}</footer>
                                </blockquote>
                            </td>
                            <td width="15%">
                                <blockquote class="blockquote">
                                    <p></p>
                                    <footer class="blockquote-footer">Dip Lejos: <cite
                                            title="Source Title">{{ $receta->dip_lejos_rec }}</cite></footer>
                                    <footer class="blockquote-footer">Dip Cerca: <cite
                                            title="Source Title">{{ $receta->dip_cerca_rec }}</cite></footer>
                                    <footer class="blockquote-footer">Naso Pupilar: <cite
                                            title="Source Title">{{ $receta->naso_pupilar_od_rec }}</cite></footer>
                                    <footer class="blockquote-footer">OI: <cite
                                            title="Source Title">{{ $receta->oi_rec }}</cite></footer>
                                </blockquote>
                            </td>
                            @if ($receta->recomendacion_rec)
                                <td style="text-align: center;" width="70%">
                                    <blockquote class="blockquote">
                                        <p class="mb-0">Recomendación:</p>
                                        <footer class="blockquote-footer"> <cite
                                                title="Source Title">"{{ $receta->recomendacion_rec }}":</cite>
                                        </footer>
                                    </blockquote>
                                </td>
                            @endif

                        </tr>
                    </tbody>
                </table>

            </div>
            <hr>

        </div>
    </div>
</body>

</html>
