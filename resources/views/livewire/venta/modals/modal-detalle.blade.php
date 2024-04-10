<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

<div wire:ignore.self class="modal fade" id="modalDetalle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar un Ítem</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-row container">
                    <div class="form-group col-md-12">
                        <label for="inputZip3">Nombre de producto</label>
                        <input wire:model="nombre_detalle" type="text" autocomplete="on" 
                        class="form-control" id="inputZip3"
                            placeholder="Ingresar nombre de producto">
                        @error('nombre_detalle')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group col-md-12">
                        <label for="inputZip3">Tipo de producto</label>
                        <select wire:model="id_tipo_producto" name="id_tipo_producto" class="form-control">
                            <option value="">Seleccionar</option>
                            @foreach ($tipo_productos as $tipo_producto)
                                <option value="{{ $tipo_producto->id_tipo_producto }}">
                                    {{ $tipo_producto->nombre_tipo_producto }}</option>
                            @endforeach
                        </select>
                        @error('id_tipo_producto')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group col-md-12">
                        <label for="inputZip3">Unidad</label>
                        <select wire:model="unidad_detalle" name="unidad_detalle" class="form-control">
                            <option value="">Seleccionar Unidad</option>
                            <option value="Unidad">Unidad</option>
                        </select>
                        @error('unidad_detalle')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputZip3">Precio</label>
                        <input wire:model="precio_unitario_detalle" type="number" class="form-control" id="inputZip3"
                            placeholder="000.00">
                            @error('precio_unitario_detalle')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputZip3">Cantidad</label>
                        <input wire:model="cantidad_detalle" type="number" class="form-control" id="inputZip3"
                            placeholder="0">
                            @error('cantidad_detalle')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputZip3">Total</label>
                        <input wire:model="precio_total_detalle" type="number" class="form-control" id="inputZip3"
                            placeholder="000.00">
                            @error('precio_total_detalle')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="form-actions">
                    <div class="text-right">
                        <button wire:click="addListaDetalle" wire:loading.attr="disabled" class="btn btn-primary btn-sm"
                            type="button"> <i class="fa fa-plus" aria-hidden="true"></i> <i
                                wire:target="addListaDetalle" wire:loading.class="fa fa-spinner fa-spin"
                                aria-hidden="true">
                            </i> Agregar Producto</button>
                        <button wire:click="closeModalDetalle" wire:loading.attr="disabled"
                            class="btn btn-secondary btn-sm" type="button"> <i wire:target="closeModalDetalle"
                                wire:loading.class="fa fa-spinner fa-spin" aria-hidden="true"></i> Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.addEventListener('close-modal-venta', event => {
        $('#modalDetalle').modal('hide');

    });

    window.addEventListener('open-modal-venta', event => {
        $('#modalDetalle').modal('show');

    });
</script>
