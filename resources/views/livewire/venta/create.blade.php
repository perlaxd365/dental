<div class="container">
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="invoice-container">
                        <div class="invoice-header">
                            <!-- Row start -->
                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">

                                </div>
                            </div>
                            <!-- Row end -->
                            <!-- Row start -->
                            <div class="row gutters">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">

                                    <img src="{{ $empresa->logo_empresa }}" alt="user" class="rounded-circle"
                                        width="100" height="100" />
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 pt-2">
                                    <address class="text-right">
                                        {{ $empresa->razon_social_empresa }} <br>
                                        {{ $empresa->direccion_empresa }}<br>
                                        {{ $empresa->ruc_empresa }}.<br>
                                    </address>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="validationDefault01">
                                        Seleccionar Paciente&nbsp;
                                        <a data-toggle="modal" data-target=".bd-example-modal-lg"
                                            href="javascript:void(0)">[Agregar]</a>
                                    </label>
                                    <br>
                                    <div wire:ignore>
                                        <select wire:model="id_paciente" name="id_paciente"
                                            class="form-control select2" id="select2">
                                            <option value="">Seleccionar</option>
                                            @foreach ($pacientes as $paciente)
                                                <option value="{{ $paciente->id_paciente }}">
                                                    {{ $paciente->nombres_paciente }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('id_paciente')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="validationDefault01">
                                        Seleccionar Receta
                                    </label>
                                    <br>
                                    <div>
                                        <select wire:model="id_receta" class="form-control">
                                            <option value="">Sin Receta</option>
                                            @foreach ($recetas as $receta)
                                                <option value="{{ $receta->id_receta }}">
                                                    Dip Lejos: ({{ $receta->dip_lejos_rec }}) -
                                                    Dip Cerca: ({{ $receta->dip_cerca_rec }}) -
                                                    Naso Pupilar: ({{ $receta->naso_pupilar_od_rec }}) -
                                                    OI: ({{ $receta->oi_rec }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="inputZip3">Ingresar IGV</label>
                                    <input wire:model="igv_venta" type="number" class="form-control"
                                        id="inputZip3" placeholder="0">
                                </div>
                            </div>
                            
                            <!-- Row end -->
                        </div>
                        <div class="invoice-body">
                            <!-- Row start -->
                            <div class="row gutters">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table custom-table m-0 table-sm table-stripped">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Items</th>
                                                    <th>Unidad</th>
                                                    <th>Precio Unitario</th>
                                                    <th>Cantidad</th>
                                                    <th>Sub Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="6">
                                                        <br>
                                                        <button wire:click='showModalDetalle' type="button"
                                                            class="btn btn-outline-secondary btn-sm btn-block">
                                                            <i class="fa fa-plus"></i> Agregar Producto</button>
                                                        <br>
                                                    </td>
                                                </tr>
                                                @if ($lista_detalle)
                                                    @foreach ($lista_detalle as $key => $item)
                                                        <tr>
                                                            <td class="text-center">
                                                                <button
                                                                    wire:click='deleteProducto({{ $key }})'
                                                                    class="btn btn-outline-secondary btn-sm rounded-circle">
                                                                    <i class="fa fa-times" aria-hidden="true"></i>

                                                                </button>
                                                            </td>
                                                            <td>
                                                                {{ ParametroUtil::getParametro($item['id_tipo_producto'], 'NOMBRE_TIPO_PRODUCTO_VENTA') }}
                                                                <p class="m-0 text-muted">
                                                                    {{ $item['nombre_detalle'] }}
                                                                </p>
                                                            </td>
                                                            <td>
                                                                {{ $item['unidad_detalle'] }}</td>
                                                            <td>
                                                                S/ {{ $item['precio_unitario_detalle'] }}</td>
                                                            <td>
                                                                {{ $item['cantidad_detalle'] }}</td>
                                                            <td>
                                                                S/ {{ $item['precio_total_detalle'] }}</td>

                                                        </tr>
                                                    @endforeach

                                                @endif


                                                @if ($lista_detalle)
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td colspan="1">
                                                            <p>
                                                                Subtotal<br>
                                                                IGV<br>
                                                                Afectado<br>
                                                            </p>
                                                            <h5 class="text-success"><strong>Monto Total</strong></h5>
                                                        </td>
                                                        <td>
                                                            <p>
                                                                <b>S/ {{ $sub_total_venta }}</b><br>
                                                                <b> % &nbsp;{{ $igv_venta }}</b><br>
                                                                <b>S/ {{ $subtotal_afectado }}</b><br>
                                                            </p>
                                                            <h5 class="text-success"><strong>S/
                                                                    {{ $total_venta }}</strong></h5>
                                                        </td>
                                                    </tr>
                                                @endif

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Row end -->
                        </div>
                        <div class="invoice-footer">
                            Venta simple
                        </div>
                    </div>

                    @if ($lista_detalle)
                        <div class="custom-actions-btns mb-5">
                            <button wire:click="showModalFinalizarVenta" wire:loading.attr="disabled" class="btn btn-primary"
                                type="button"> <i class="fa fa-plus-circle"></i> <i wire:target="showModalFinalizarVenta"
                                    wire:loading.class="fa fa-spinner fa-spin" aria-hidden="true"></i>
                                Guardar Venta</button>

                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.addEventListener('livewire:load', event => {
        $(".select2").select2({
            width: '360px',
            height: '60px',
            class: 'form-control'
        });

        $(".select2").on('change', function() {
            @this.set('id_paciente', this.value);
        });
    })
    window.addEventListener('data', event => {

        var newOption = new Option(event.detail.nombres_paciente, event.detail.id_paciente, true, true);


        $('.select2').append(newOption).trigger('change'); //until this point, everything works

        @this.set('id_paciente', event.detail.id_paciente);


    })
</script>
