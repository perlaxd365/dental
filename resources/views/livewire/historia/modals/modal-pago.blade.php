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
                            @else
                                <div class="alert alert-success col-12" role="alert">
                                  <i class="fa fa-check"></i>  Pago Completado correctamente.
                                  </div>
                            @endif
                            <div class="form-group col-md-6">
                                <label for="inputAddress">Monto total:</label>
                                <div class="input-group">
                                    <label style="size: 4cm">
                                        <input class="form-control" disabled wire:model="total_venta"  >
                                       
                                    </label>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputAddress">Producto Entregado</label>
                                <div class="input-group">
                                    <label class="switch" style="size: 4cm">
                                        <input disabled wire:model="producto_entregado_venta" type="checkbox" checked>
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
