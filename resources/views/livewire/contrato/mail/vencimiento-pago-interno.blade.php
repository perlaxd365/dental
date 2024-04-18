<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"> <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldn't be necessary -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name="x-apple-disable-message-reformatting"> <!-- Disable auto-scale in iOS 10 Mail entirely -->
    <title></title> <!-- The title tag shows in email notifications, like Android 4.4. -->


    <style>
        /* What it does: Remove spaces around the email design added by some email clients. */
        /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
        html,
        body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
        }

        /* What it does: Stops email clients resizing small text. */
        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        /* What it does: Centers email on Android 4.4 */
        div[style*="margin: 16px 0"] {
            margin: 0 !important;
        }

        /* What it does: Stops Outlook from adding extra spacing to tables. */
        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }

        /* What it does: Fixes webkit padding issue. Fix for Yahoo mail table alignment bug. Applies table-layout to the first 2 tables then removes for anything nested deeper. */
        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }

        table table table {
            table-layout: auto;
        }

        /* What it does: Uses a better rendering method when resizing images in IE. */
        img {
            -ms-interpolation-mode: bicubic;
        }

        /* What it does: A work-around for iOS meddling in triggered links. */
        *[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
        }

        /* What it does: A work-around for Gmail meddling in triggered links. */
        .x-gmail-data-detectors,
        .x-gmail-data-detectors *,
        .aBn {
            border-bottom: 0 !important;
            cursor: default !important;
        }

        /* What it does: Prevents Gmail from displaying an download button on large, non-linked images. */
        .a6S {
            display: none !important;
            opacity: 0.01 !important;
        }

        /* If the above doesn't work, add a .g-img class to any image in question. */
        img.g-img+div {
            display: none !important;
        }

        /* What it does: Prevents underlining the button text in Windows 10 */
        .button-link {
            text-decoration: none !important;
        }

        /* What it does: Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89  */
        /* Create one of these media queries for each additional viewport size you'd like to fix */
        /* Thanks to Eric Lepetit (@ericlepetitsf) for help troubleshooting */
        @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {

            /* iPhone 6 and 6+ */
            .email-container {
                min-width: 375px !important;
            }
        }
    </style>


    <style>
        /* What it does: Hover styles for buttons */
        .button-td,
        .button-a {
            transition: all 100ms ease-in;
        }

        .button-td:hover,
        .button-a:hover {
            background: #EE433C !important;
            border-color: #EE433C !important;
        }

        /* Media Queries */
        @media screen and (max-width: 600px) {

            /* What it does: Adjust typography on small screens to improve readability */

            .email-container {
                margin: auto !important;
                max-width: 100% !important;
                font-size: 1em !important;
                font-size: 100% !important;
            }

            .email-container p {
                line-height: 22px !important;
            }

            .icon {
                padding-top: 20px !important;
                padding-bottom: 10px !important;
            }

            .social {
                max-width: 100% !important;
                margin: auto !important;
                font-size: 100% !important;
                text-align: center !important;
            }

            .x-gmail-data-detectors {
                text-align: center !important;
                width: 100% !important;
                margin: auto !important;
                font-size: 90% !important;
                backgroun-color: #eff3fc !important;
            }

            .data-client {
                padding-left: 1em !important;
                padding-right: 1em !important;
                font-size: 1em !important;
            }

        }
    </style>

</head>

<body width="100%" bgcolor="#222222" style="margin: 0; mso-line-height-rule: exactly;">
    <center style="width: 100%; background: #EFF3FC; text-align: left;">

        <!-- Visually Hidden Preheader Text : BEGIN -->
        <div
            style="display:none;font-size:1px;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;mso-hide:all;font-family: Open Sans, Roboto, Helvetina Neue, sans-serif;">
            (Optional) This text will appear in the inbox preview, but not the email body.
        </div>
        <!-- Visually Hidden Preheader Text : END -->

        <!--
            Set the email width. Defined in two places:
            1. max-width for all clients except Desktop Windows Outlook, allowing the email to squish on narrow but never go wider than 600px.
            2. MSO tags for Desktop Windows Outlook enforce a 600px width.
        -->
        <div style="max-width: 600px; margin: auto; width:100%;" class="email-container">
            <!--[if mso]>
            <table role="presentation" aria-hidden="true" cellspacing="0" cellpadding="0" border="0" width="600" align="center">
            <tr>
            <td>
            <![endif]-->

            <!-- Email Header : BEGIN -->
            <table role="presentation" aria-hidden="true" cellspacing="0" cellpadding="0" border="0" align="center"
                width="111px" style="max-width: 600px;">
                <tr>
                    <td style="padding: 30px 0; align: center;">
                        <img src="{{url('/' . $empresa_admin->logo_empresa) }}"  aria-hidden="true" width="111"
                            height="35" alt="alt_text" border="0" style="height: auto; background: "#";
                            font-family: Open Sans, Roboto, Helvetina Neue, sans-serif; font-size: 15px; line-height:
                            20px; color: #555555; min-width: 111px; max-width:111px;">
                    </td>
                </tr>

            </table>
            <!-- Email Header : END -->

            <!-- Email Body : BEGIN -->
            <table role="presentation" aria-hidden="true" cellspacing="0" cellpadding="0" border="0" align="center"
                width="100%" style="max-width: 600px;">


                <!-- 1 Column Text + Button : BEGIN -->
                
                <tr>
                    <td bgcolor="#FFFFFF" align="center" height="100%" valign="top" width="100%">

                        <table role="presentation" aria-hidden="true" border="0" cellpadding="0" cellspacing="0"
                            align="center" width="100%" style="max-width:600px;">

                            <tr>
                                <td align="center" valign="top" width="100%">
                                    <table role="presentation" aria-hidden="true" cellspacing="0" cellpadding="0"
                                        border="0" width="100%" style="font-size: 14px;text-align: left;">
                                        <tr>

                                            <td class="icon"style="text-align: center; padding: 30px;">
                                                <img src="{{url('/' . $empresa_admin->logo_empresa) }}"  aria-hidden="true"
                                                    width="140" height="auto" alt="alt_text" border="0"
                                                    align="center"
                                                    style="width: 100%; max-width: 140px; background: #; font-family: Open Sans, Roboto, Helvetina Neue, sans-serif; font-size: 15px; line-height: 20px; color: #555555;">
                                            </td>
                                        </tr>
                                        <tr>

                                            <table role="presentation" aria-hidden="true" cellspacing="0"
                                                cellpadding="0" border="0" width="100%">
                                                <tr>
                                                    <td
                                                        style="padding-left: 0px; font-family: Open Sans, Roboto, Helvetina Neue, sans-serif; font-size: 15px; line-height: 0px; color: #555555;">
                                                        <h1
                                                            style="margin: 0 0 10px 0; font-family: Open Sans, Roboto, Helvetina Neue, sans-serif; font-size: 32px; line-height: 42px; color: #333333; font-weight: 600; text-align:center; opacity:0.95">
                                                            Suscripción por vencer&nbsp;</h1>
                                                        <p
                                                            style="margin: 0; text-align:center; font-size: 16px; opacity: 0.9; line-height: 1.5; padding-left: 20px; padding-right: 20px; padding-bottom: 20px;">
                                                            Recordarte que <b>{{$empresa->nombre_comercial_empresa}}</b><br> 
                                                            tiene un pago pendiente el día de <b>Mañana</b>, verifica si ya realizó algún pago&nbsp;
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td style="font-family: Open Sans, Roboto, Helvetina Neue, sans-serif; font-size: 1em; width: 100%; opacity:0.75; line-height:2em; padding-left: 4em; padding-right: 4em ; padding-bottom: 2em;"
                                                        class="data-client">
                                                        <p
                                                            style="border: 1px solid white;background-color: white ;border-radius: 2px 2px 0 0;margin:0 !important; padding: 1em; text-transform: uppercase; letter-spacing: 1px; font-size: 0.8em; font-weight: 600; opacity: 0.9">
                                                            Información de tu cuenta:</p>
                                                        <p
                                                            style="border: 0px solid #EFF3FC;background-color: #EFF3FC ;border-radius: 2px 2px 0 0;margin:0 !important; padding: 1em; opacity: 0.9">
                                                            <b>Empresa:</b> {{$empresa->razon_social_empresa}}</p>
                                                        <p
                                                            style="border: 1px solid #EFF3FC;background-color: white ;border-radius: 2px 2px 0 0;margin:0 !important; padding: 1em; opacity: 0.9">
                                                            <b>Email:</b> {{$empresa->email_empresa}}</p>
                                                        <p
                                                            style="border: 0px solid #EFF3FC;background-color: #EFF3FC ;border-radius: 2px 2px 0 0;margin:0 !important; padding: 1em; opacity: 0.9">
                                                            <b>Plan Actual:</b> Suscripción de {{$contrato->meses_contrato}} meses, expira el
                                                            <b>{{ $fechas["fin_contrato"]}}</b></p>
                                                        <p
                                                            style="border: 1px solid #EFF3FC;background-color: white ;border-radius: 2px 2px 0 0;margin:0 !important; padding: 1em; opacity: 0.9">
                                                            <b>Cuota Mensual:</b> <b style="color: red">Vence el {{$fechas["fin_cuota"]}} </b> </p>
                                                    </td>
                                                </tr>

                                            </table>

                                        </tr>
                                    </table>
                                </td>
                            </tr>

                        </table>
                        <!-- Email Body : END -->



                        <!-- Email Footer : BEGIN -->
                        <table role="presentation" aria-hidden="true" cellspacing="0" cellpadding="0"
                            border="0" align="center" width="100%"
                            style="max-width: 680px; background-color: #EFF3FC">
                            <tr>
                                <td style="padding: 30px 0px 20px 0px;width: 100%;font-size: 0.85em; font-family: Open Sans, Roboto, Helvetina Neue, sans-serif; text-align: center; color: #353535;"
                                    class="x-gmail-data-detectors">
                                    <!-- <webversion style="color:#353535; text-decoration:underline; font-weight: bold;">View as a Web Page</webversion>
                        <br><br> -->
                                    Enviado por el equipo de <b>SOPORTE | <a href="http://www.fanatiz.com"
                                            style="color: #3CA2FF; line-height:1.5em">www.fanatiz.com<a>
                                                <br>
                                                <!-- <unsubscribe style="color: #353535; text-decoration:underline;">Eliminar Suscripción</unsubscribe> -->


                                </td>

                            </tr>

                            <tr>
                                <!-- redes sociales -->
                                <td class="social"
                                    style="background-color: #EFF3FC; padding-bottom: 20px; text-align: center; width:100%">

                                    <img width="35" height="35" src="https://k61.kn3.net/A/4/9/C/2/2/A13.png">
                                    <img width="35" height="35" src="https://k61.kn3.net/7/A/A/0/E/C/BB2.png">

                                </td>
                            </tr>



                        </table>
                        <!-- Email Footer : END -->


                        <!--[if mso]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </div>
    </center>
</body>

</html>
