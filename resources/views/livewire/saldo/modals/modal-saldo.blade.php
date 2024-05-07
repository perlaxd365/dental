<div wire:ignore.self  class="modal fade"  id="modalSaldos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><b>Detalle de venta</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col-md-12 ">
                        @if ($lista_detalle)
                            <div class="container">
                                <table class="table table-sm table-stripped table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Item</th>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($lista_detalle as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $item->nombre_detalle }}</td>
                                                <td>{{ $item->cantidad_detalle }}</td>
                                                <td>{{ $item->precio_total_detalle }}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td> </td>
                                            <td> </td>
                                            <td>Subtotal:</td>
                                            <td>{{ $subtotal_delete }}</td>
                                        </tr>
                                        @if ($igv_delete)
                                            <tr>
                                                <td> </td>
                                                <td> </td>
                                                <td>IGV:</td>
                                                <td>{{ $igv_delete }}</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td> </td>
                                            <td> </td>
                                            <td><b class="text-success">Total:</b></td>
                                            <td><b class="text-success">{{ $total_delete }}</b></td>
                                        </tr>
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
                        <button wire:click="closeModalSaldo" wire:loading.attr="disabled" class="btn btn-secondary"
                            type="button"> <i wire:target="closeModalSaldo" wire:loading.class="fa fa-spinner fa-spin"
                                aria-hidden="true"></i>Salir</button>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    window.addEventListener('open-modal-saldo', event => {
        $('#modalSaldos').modal('show');

    });
    window.addEventListener('close-modal-saldo', event => {
        $('#modalSaldos').modal('hide');

    });
</script>