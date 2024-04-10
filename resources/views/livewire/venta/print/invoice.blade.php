<style>
    #invoice-POS {
        box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
        margin: 0 auto;
        margin-left: -20px;
        width: 58mm;
        background: #FFF;


        ::selection {
            background: #f31544;
            color: #FFF;
        }

        ::moz-selection {
            background: #f31544;
            color: #FFF;
        }

        h1 {
            font-size: 1.9em;
            color: #222;
        }

        h2 {
            font-size: .9em;
            color: #222;
            font-size: 1.2em;
            font-weight: 300;
            line-height: 2em;
        }

        h3 {
            font-size: 1.2em;
            font-weight: 300;
            line-height: 2em;
        }

        p {
            font-size: .8em;
            color: #666;
            line-height: 1.2em;
        }

        #top,
        #mid,
        #bot {
            /* Targets all id with 'col-' */
            border-bottom: 1px solid #EEE;
        }

        #top {
            min-height: 50px;
            margin-top: -35px;
        }

        #mid {
            min-height: 40px;
            margin-top: -30px;
        }

        #bot {
            min-height: 50px;
        }


        .info {
            display: block;
            //float:left;
            margin-left: 0;
        }

        .title {
            float: right;
        }

        .title p {
            text-align: right;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            //padding: 5px 0 5px 15px;
            //border: 1px solid #EEE
        }

        .tabletitle {
            //padding: 5px;
            font-size: .5em;
            background: #EEE;
        }

        .service {
            border-bottom: 1px solid #EEE;

        }

        .item {
            width: 35mm;
        }

        .Cant {
            width: 7mm;
        }

        .itemtext {
            font-size: .7em;
        }

        #legalcopy {
            margin-top: 5mm;
            width: 58mm;
        }

        #text-qrcode {
            font-size: .6em;
        }



    }
</style>

<div id="invoice-POS">

    <center id="top">
        <img src="{{ $empresa->logo_empresa }}" alt="user" class="rounded-circle" width="70" height="70" />

        <h2>Ticket de Venta N°0000{{ $data_venta['id_venta'] }}</h2>

    </center><!--End InvoiceTop-->

    <div id="mid">
        <div class="info">
            <h3></h3>
            <p>
                Razon Social : {{ $empresa->razon_social_empresa }}</br>
                Dirección : {{ $empresa->direccion_empresa }}</br>
                RUC : {{ $empresa->ruc_empresa }}</br>
            </p>
        </div>
    </div>
    <div id="mid">
        <div class="info">
            <h3></h3>
            <p>
                Nombres : {{ $paciente->nombres_paciente }}</br>
                DNI : {{ $paciente->dni_paciente }}</br>
            </p>
        </div>
    </div>
    <div id="bot">

        <div id="table">
            <table>
                <tr class="tabletitle">
                    <td class="item">
                        <h2>Item</h2>
                    </td>
                    <td class="Cant">
                        <h2>Cant</h2>
                    </td>
                    <td class="Rate">
                        <h2>Sub Total</h2>
                    </td>
                </tr>
                @foreach ($data_detalle_venta as $item)
                    <tr class="service">
                        <td class="tableitem">
                            <p class="itemtext">{{ $item['nombre_detalle'] }}</p>
                        </td>
                        <td class="tableitem">
                            <p class="itemtext">{{ $item['cantidad_detalle'] }}</p>
                        </td>
                        <td class="tableitem">
                            <p class="itemtext">S/ {{ $item['precio_total_detalle'] }}</p>
                        </td>
                    </tr>
                @endforeach


                <tr class="tabletitle">
                    <td></td>
                    <td class="Rate">
                        <h2>SUB</h2>
                    </td>
                    <td class="payment">
                        <h2>S/ {{ $data_venta['sub_total_venta'] }}</h2>
                    </td>
                </tr>


                <tr class="tabletitle">
                    <td></td>
                    <td class="Rate">
                        <h2>IGV</h2>
                    </td>
                    <td class="payment">
                        <h2>% {{( $data_venta['igv_venta'])? $data_venta['igv_venta']:'0.00' }}</h2>
                    </td>
                </tr>

                <tr class="tabletitle">
                    <td></td>
                    <td class="Rate">
                        <h2>TOTAL</h2>
                    </td>
                    <td class="payment">
                        <h2>S/ {{ $data_venta['total_venta'] }}</h2>
                    </td>
                </tr>

            </table>
        </div><!--End Table-->

        <div id="legalcopy">
            <p class="legal"><strong>Gracias por tu compra!</strong>  {{ $empresa->nombre_comercial_empresa }} te
                agradece la preferencia,
                .
            </p>
        </div>
        <center>

            <img src="data:image/png;base64,{{ $writer }} width='20' height='20'">
            <div id="legalcopy">
                <p id="text-qrcode">
                    Visítanos en <strong>{{ $empresa->pagina_empresa }}</strong> o 
                    Escríbenos al <strong>{{$empresa->email_empresa}}</strong>
                </p>
            </div>
        </center>

    </div><!--End InvoiceBot-->
</div><!--End Invoice-->
