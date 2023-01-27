<div class="card-body">
    <h4 class="card-title">Agregar Producto de Laboratorio</h4>
    <div class="form-body">
        <div class="row">
            <div class="col-md-6">
                <label for="fecha-registro">
                    Nombre de Producto
                </label>
                <input wire:model='nombre_producto_lab' type="text" class="form-control">

                @error('nombre_producto_lab')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

        </div>
    </div>
    <div class="form-actions">
        <div class="text-right">
            @can('admin.users.index')
                <button wire:click="agregar" wire:loading.attr="disabled" class="btn btn-primary" type="button"> <i
                        class="fa fa-plus-circle"></i> <i wire:target="agregar" wire:loading.class="fa fa-spinner fa-spin"
                        aria-hidden="true"></i> Agregar Producto</button>

                <button wire:click="default" wire:loading.attr="disabled" class="btn btn-secondary" type="button"> <i
                        wire:target="default" wire:loading.class="fa fa-spinner fa-spin"
                        aria-hidden="true"></i>Limpiar</button>
            @endcan
        </div>
    </div>
</div>
