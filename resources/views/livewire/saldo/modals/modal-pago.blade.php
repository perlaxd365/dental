<div wire:ignore.self class="modal fade" id="modalPagos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><b>Pagos</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col-md-12 ">
                        <div class="form-row container">
                            @if (!$pago_completado_venta)
                                <div class="form-group col-md-6">
                                    <div>
                                        <label for="inputAddress">Nombre</label>
                                        <input wire:model="nombre_abono" type="text" class="form-control"
                                            id="inputAddress" placeholder="Ingresar nombres">
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
                                        <input disabled type="number" wire:model="monto_restante_venta"
                                            class="form-control">
                                        @error('monto_restante_venta')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @else
                                <div class="alert alert-success col-12" role="alert">
                                  <i class="fa fa-check"></i>  Pago Completado correctamente.
                                  </div>
                            @endif
                            <div class="form-group col-md-6">
                                <label for="inputAddress">Producto Entregado</label>
                                <div class="input-group">
                                    <label class="switch" style="size: 4cm">
                                        <input wire:model="producto_entregado_venta" type="checkbox" checked>
                                        <span class="slider round"></span>
                                    </label>
                                    @error('producto_entregado_venta')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-actions">
                            <div class="text-right">
                                @if (!$pago_completado_venta)
                                    <button wire:click="agregarPago" wire:loading.attr="disabled"
                                        class="btn btn-primary" type="button"> <i class="fa fa-plus"
                                            aria-hidden="true"></i> <i wire:target="agregarPago"
                                            wire:loading.class="fa fa-spinner fa-spin" aria-hidden="true">
                                        </i>
                                        Agregar Pago</button>
                                @endif
                                <button wire:click="closeModalPago" wire:loading.attr="disabled"
                                    class="btn btn-secondary" type="button"> <i wire:target="closeModalPago"
                                        wire:loading.class="fa fa-spinner fa-spin" aria-hidden="true"></i>Salir</button>

                            </div>
                        </div>
                        <hr>
                        <div class="container">
                            <label for=""><b>Detalle de pagos</b></label>
                        </div>

                        @if ($lista_detalle_pagos)
                            <div class="container table-responsive">
                                <table class="table table-sm table-stripped table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Item</th>
                                            <th>Nombre</th>
                                            <th>Tipo </th>
                                            <th>Fecha </th>
                                            <th>Monto</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($lista_detalle_pagos as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td style="width: 20px">{{ $item->nombre_abono }}</td>
                                                <td>{{ $item->tipo_pago_abono }}</td>
                                                <td>{{ DateUtil::getFechaSimple($item->created_at) }}</td>
                                                <td>S/ {{ $item->monto_abono }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.addEventListener('open-modal-pagos', event => {
        $('#modalPagos').modal('show');

    });
    window.addEventListener('close-modal-pagos', event => {
        $('#modalPagos').modal('hide');

    });
</script>
