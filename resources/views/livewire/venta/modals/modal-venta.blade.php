<div wire:ignore.self class="modal fade" id="modalFinalizarVenta" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Finalizar Venta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-row">

                    <div class="form-group col-md-12">
                        <label for="">Paciente</label>
                        <input type="input" class="form-control" disabled wire:model='paciente_fin_venta'>
                    </div>


                    <div class="form-group col-md-6">
                        <label for="inputZip4">¿Se entrega el producto?</label><br>
                        <label class="switch" style="size: 4cm">
                            <input wire:model="producto_entregado_venta" type="checkbox" checked>
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputZip4">¿Se completó el pago?</label><br>
                        <label class="switch" style="size: 4cm">
                            <input wire:model="pago_completado_venta" type="checkbox" checked>
                            <span class="slider round"></span>
                        </label>
                    </div>
                    @if ($show_abono)
                        <div class="form-group col-md-6">
                            <div>
                                <label for="inputAddress">Nombre</label>
                                <input wire:model="nombre_abono" type="text" class="form-control" id="inputAddress"
                                    placeholder="Ingresar nombres">
                                @error('nombre_abono')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="title" class=" control-label">Tipo de Pago</label>

                            <select wire:model="tipo_pago_abono" class="form-control" placeholder="">
                                <option value="">Seleccionar</option>
                                @foreach ($tipos_pagos as $tipo_pago)
                                    <option value="{{ $tipo_pago->nombre_tipo_pago }}">
                                        {{ $tipo_pago->nombre_tipo_pago }}
                                    </option>
                                @endforeach
                            </select>

                            @error('tipo_pago_abono')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputAddress">Monto Abonado</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">S/</span>
                                </div>
                                <input type="number" wire:model="monto_abono" class="form-control">
                                @error('monto_abono')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputAddress">Restante</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">S/</span>
                                </div>
                                <input disabled type="number" wire:model="monto_restante_venta" class="form-control">
                                @error('monto_restante_venta')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    @endif


                    <div class="form-group col-md-12">
                        <br>
                        @if ($lista_detalle)

                            <div class="container">
                                <table class="table custom-table m-0 table-sm table-stripped">

                                    <thead class="thead-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Items</th>
                                            <th>Unidad</th>
                                            <th>Precio</th>
                                            <th>Cantidad</th>
                                            <th>Sub</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($lista_detalle)
                                            @foreach ($lista_detalle as $key => $item)
                                                <tr>
                                                    <td class="text-center">
                                                        {{ $key + 1 }}
                                                    </td>
                                                    <td>
                                                        <p class="h6"> {{ $item['nombre_detalle'] }}
                                                            ({{ ParametroUtil::getParametro($item['id_tipo_producto'], 'NOMBRE_TIPO_PRODUCTO_VENTA') }})
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <p class="h6"> {{ $item['unidad_detalle'] }}</p>
                                                    </td>
                                                    <td>
                                                        <p class="h6"> S/{{ $item['precio_unitario_detalle'] }}</p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p class="h6"> {{ $item['cantidad_detalle'] }}
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <p class="h6"> S/{{ $item['precio_total_detalle'] }}</p>
                                                    </td>

                                                </tr>
                                            @endforeach
                                            @if ($lista_detalle)
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td colspan="1">
                                                        <h5 class="text-success"><strong><b>Monto Total</b></strong>
                                                        </h5>
                                                    </td>
                                                    <td>
                                                        <h5 class="text-success"><strong><b>S/
                                                                    {{ $total_venta }}</b></strong></h5>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endif



                                    </tbody>
                                </table>
                            </div>

                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="form-actions">
                    <div class="text-right">
                        <button wire:click="store" wire:loading.attr="disabled" class="btn btn-primary" type="button">
                            <i class="fa fa-plus-circle"></i> <i wire:target="showModalFinalizarVenta"
                                wire:loading.class="fa fa-spinner fa-spin" aria-hidden="true"></i>
                            Guardar Venta</button>

                        <button wire:click="store_print" wire:loading.attr="disabled" class="btn btn-secondary"
                            type="button"><i class="fa fa-print"></i> <i wire:target="store_print"
                                wire:loading.class="fa fa-spinner fa-spin" aria-hidden="true"></i> Guardar e
                            imprimir</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.addEventListener('close-modal-finalizar-venta', event => {
        $('#modalFinalizarVenta').modal('hide');

    });

    window.addEventListener('open-modal-finalizar-venta', event => {
        $('#modalFinalizarVenta').modal('show');

    });
</script>
