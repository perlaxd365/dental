
@can('admin.users.index')
<div class="card-body">
    <h4 class="card-title">Agregar Usuario al Sistema</h4>
    <div class="form-body">
        <div class="row">
            <div class="col-md-6">
                <div wire:ignore class="form-group">
                    <label>Seleccionar empresa</label>
                    <select wire:model="id_empresa" class="form-control select2" id="select2">
                        <option value="">Seleccionar</option>
                        @foreach ($empresas as $empresa)
                            <option value="{{ $empresa->id_empresa }}">{{ $empresa->razon_social_empresa }}</option>
                        @endforeach
                    </select>
                </div>
                @error('id_empresa')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Tipo Usuario</label>
                    <select wire:model="id_tipo_usuario" class="form-control">
                        <option value="">Seleccionar</option>
                        @foreach ($tipos_usuario as $tipos)
                            <option value="{{ $tipos->id_tipo_usuario }}">{{ $tipos->nombre_tipo_usuario }}</option>
                        @endforeach
                    </select>

                    @error('id_tipo_usuario')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nombres Completos</label>
                    <input wire:model="name" type="text" class="form-control" placeholder="">

                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>DNI </label>
                    <input maxlength="8" wire:model="dni" type="text" class="form-control" placeholder="">

                    @error('dni')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Email</label>
                    <input wire:model="email" type="email" class="form-control" placeholder="">

                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Contraseña</label>
                    <input wire:model="password" type="text" class="form-control" placeholder="">

                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="form-actions">
        <div class="text-right">
            @can('admin.users.index')
                <button wire:click="agregar" wire:loading.attr="disabled" class="btn btn-primary" type="button"> <i
                        class="fa fa-plus-circle"></i> <i wire:target="agregar" wire:loading.class="fa fa-spinner fa-spin"
                        aria-hidden="true"></i> Agregar Usuario</button>

                <button wire:click="default" wire:loading.attr="disabled" class="btn btn-secondary" type="button"> <i
                        wire:target="default" wire:loading.class="fa fa-spinner fa-spin"
                        aria-hidden="true"></i>Limpiar</button>
            @endcan
        </div>
    </div>
    <script>
        window.addEventListener('livewire:load', event => {
            $(".select2").select2({
                width: '500px',
                height: '60px',
                class: 'form-control'
            });
            $(".select2").on('change', function() {
                @this.set('id_empresa', this.value);
            });
        })
        window.addEventListener('clear', event => {
            $('.select2').val(null).trigger('change.select2');
        })

        window.addEventListener('datos', event => {
            $('.select2').val(event.detail.id_empresa).trigger('change.select2');

            @this.set('id_empresa', event.detail.id_empresa);
        })
    </script>
</div>
@endcan