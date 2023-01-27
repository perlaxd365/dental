<div class="card-body">
    <h4 class="card-title">Editar Usuario</h4>
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
                    <label>Nueva Contraseña</label>
                    <input wire:model="password" type="text" class="form-control" placeholder="">

                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Estado</label>
                    <select wire:model="estado" type="select" class="form-control">
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    @can('admin.users.index')
        <div class="form-actions">
            <div class="text-right">
                <button wire:click="update" wire:loading.attr="disabled" class="btn btn-primary" type="button"> <i
                        class="fa fa-refresh"></i> <i wire:target="update" wire:loading.class="fa fa-spinner fa-spin"
                        aria-hidden="true"></i> Actualizar Usuario</button>

                <button wire:click="default" wire:loading.attr="disabled" class="btn btn-secondary" type="button"> <i
                        wire:target="default" wire:loading.class="fa fa-spinner fa-spin"
                        aria-hidden="true"></i>Cancelar</button>
            </div>
        </div>
    @endcan
</div>
