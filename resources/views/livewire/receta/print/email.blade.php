<!DOCTYPE html>
<html lang="es-co">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Receta #{{ $data['id_receta'] }}</title>
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
<link type="text/css" rel="stylesheet" href="{{ asset('assets/libs/bootstrap/dist/css/bootstrap.min.css') }}" />

<body>
    <div style="overflow-x:auto;">

        <table role="presentation"
            style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
            <tr>
                <td align="center" style="padding:0;">
                    <table role="presentation"
                        style="border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
                        <tr>
                            <td align="center" style="padding:30px 0 30px 0;background:#6999FF;">
                                <img src="https://cdn4.iconfinder.com/data/icons/social-media-logos-6/512/112-gmail_email_mail-512.png"
                                    alt="" width="50" style="height:auto;display:block;" />
                                <p
                                    style="margin:0;font-size:16px;line-height:16px;font-family:Arial,sans-serif;color:#ffffff;">
                                    {{ $empresa->razon_social_empresa }} <?= date('Y') ?><br />
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:36px 30px 42px 30px;">
                                <table role="presentation"
                                    style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                    <tr>
                                        <td style="padding:0 0 36px 0;color:#153643;">
                                            <h1 style="font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;">
                                                RECETA ELECTRÓNICA</h1>


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

                                                            <img alt="Logo del organismo"
                                                            src="{{ url('/' . $empresa->logo_empresa) }}"
                                                                style="height: 150px;" title="Logo del organismo">

                                                        </td>
                                                        <td style="text-align: center;" width="33%">

                                                            <b>FECHA: </b>
                                                            <br>{{ date('d-m-Y H:i ', strtotime($date)) }}

                                                            <h4>RECETA MÉDICA <br> N° 0000{{ $data['id_receta'] }}
                                                            </h4>
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
                                                                <caption
                                                                    style="text-align: center; color: white; background: #6999FF">
                                                                    <b> DATOS DE PACIENTE</b>
                                                                </caption>
                                                                <tbody>
                                                                    <tr>
                                                                        <td style="text-align: center;" width="50%">
                                                                            <b>PACIENTE:</b>
                                                                        </td>
                                                                        <td style="text-align: center;" width="50%">
                                                                            {{ $data['nombres_paciente'] }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="text-align: center;" width="50%">
                                                                            <b>DNI:</b>
                                                                        </td>
                                                                        <td style="text-align: center;" width="50%">
                                                                            {{ $data['dni_paciente'] }}</td>
                                                                    </tr>

                                                                </tbody>
                                                            </table>
                                                            <hr>

                                                        </td>
                                                    </tr>

                                                    <tr style="padding:36px 30px 42px 30px;">
                                                        <table role="presentation"
                                                            style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                                            <tr>
                                                                <td style="padding:0 0 36px 0;color:#153643;">
                                                                    <br>
                                                                    <br>
                                                                    Gracias por visitar a
                                                                    <b>{{ $empresa->razon_social_empresa }}</b>, favor
                                                                    de descargar el archivo adjunto al correo.
                                                                    Para cualquier consulta puedes llamar al
                                                                    <b>{{ $empresa->telefono_empresa }}</b>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="padding:30px;background:#ee4c50;">
                                            <table role="presentation"
                                                style="width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Arial,sans-serif;">
                                                <tr>
                                                    <td style="padding:0;width:50%;" align="left">
                                                        <p
                                                            style="margin:0;font-size:14px;line-height:16px;font-family:Arial,sans-serif;color:#ffffff;">
                                                            &reg; Raul Baca Systems © <?= date('Y') ?><br />
                                                        </p>
                                                    </td>
                                                    <td style="padding:0;width:50%;" align="right">
                                                        <table role="presentation"
                                                            style="border-collapse:collapse;border:0;border-spacing:0;">
                                                            <tr>
                                                                <td style="padding:0 0 0 10px;width:38px;">
                                                                    <a href="http://www.twitter.com/"
                                                                        style="color:#ffffff;"><img
                                                                            src="https://assets.codepen.io/210284/tw_1.png"
                                                                            alt="Twitter" width="38"
                                                                            style="height:auto;display:block;border:0;" /></a>
                                                                </td>
                                                                <td style="padding:0 0 0 10px;width:38px;">
                                                                    <a href="http://www.facebook.com/"
                                                                        style="color:#ffffff;"><img
                                                                            src="https://assets.codepen.io/210284/fb_1.png"
                                                                            alt="Facebook" width="38"
                                                                            style="height:auto;display:block;border:0;" /></a>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>

</body>

</html>
