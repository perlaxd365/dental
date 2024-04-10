<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

<div wire:ignore.self class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><b>Confirmar eliminación</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <div class="alert alert-danger" role="alert">
                            <i class="fa fa-info-circle"></i>
                            Estás seguro de eliminar la venta:
                        </div>
                        <label for="">Paciente</label>

                        <input type="input" class="form-control" disabled wire:model='paciente_delete'>
                        <br>
                        @if ($detalle_delete)

                            <div class="container">
                                <table class="table table-sm table-stripped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($detalle_delete as $key => $item)
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
                                            <td>Total:</td>
                                            <td><b>{{ $total_delete }}</b></td>
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
                        <button wire:click="delete_detalle_venta" wire:loading.attr="disabled" class="btn btn-danger"
                            type="button"> <i class="fa fa-trash" aria-hidden="true"></i> <i
                                wire:target="delete_detalle_venta" wire:loading.class="fa fa-spinner fa-spin"
                                aria-hidden="true">
                            </i>
                            Eliminar</button>
                        <button wire:click="close_modal_delete" wire:loading.attr="disabled" class="btn btn-secondary"
                            type="button"> <i wire:target="close_modal_delete" wire:loading.class="fa fa-spinner fa-spin"
                                aria-hidden="true"></i>Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.addEventListener('close-modal-delete', event => {
        $('#modalDelete').modal('hide');

    });

    window.addEventListener('open-modal-delete', event => {
        $('#modalDelete').modal('show');

    });
</script>
