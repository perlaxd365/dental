<div class="card-body">
    <h4 class="card-title">Editar Datos de Empresa</h4>
    <div class="form-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nombre Comercial</label>
                    <input wire:model="nombre_comercial_empresa" type="text" class="form-control" placeholder="">

                    @error('nombre_comercial_empresa')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Razón Social</label>
                    <input wire:model="razon_social_empresa" type="text" class="form-control" placeholder="">

                    @error('razon_social_empresa')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>RUC</label>
                    <input wire:model="ruc_empresa" type="text" class="form-control" placeholder="">

                    @error('ruc_empresa')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Key Privado</label>
                    <textarea wire:model="key_empresa" type="textarea" class="form-control" placeholder=""></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Dirección</label>
                    <input wire:model="direccion_empresa" type="text" class="form-control" placeholder="">

                    @error('direccion_empresa')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Página WEB</label>
                    <input wire:model="pagina_empresa" type="text" class="form-control" placeholder="">

                    @error('pagina_empresa')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Email</label>
                    <input wire:model="email_empresa" type="text" class="form-control" placeholder="">

                    @error('email_empresa')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Email Personal</label>
                    <input wire:model="email_personal_empresa" type="text" class="form-control" placeholder="">

                    @error('email_personal_empresa')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Teléfono</label>
                    <input wire:model="telefono_empresa" type="text" class="form-control" placeholder="">

                    @error('telefono_empresa')
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
            <div class="col-md-6">




                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            @if ($logo_temporal)
                                <div class="card-body col-md-12">
                                    <img class="img-fluid rounded-start" src="{{ $logo_temporal }}" alt="">
                                </div>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Logo de empresa</h5>
                                <input wire:model="logo_empresa" accept="image/*" type="file" class="form-control"
                                    alt="Actualizar">
                                @error('logo_empresa')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </p>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <h4 class="card-title">Entorno del Sistema</h4>
    <div class="form-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>SOAP Tipo</label>
                    <select wire:model="tipo_soap_empresa" type="text" class="form-control" placeholder="">
                        <option value="Demo">Demo</option>
                        <option value="Produccion">Producción</option>
                    </select>

                    @error('tipo_soap_empresa')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>SOAP Envío</label>
                    <select wire:model="envio_soap_empresa" type="text" class="form-control" placeholder="">
                        <option value="Sin Soap">Sin Soap</option>
                        <option value="Sunat">Sunat</option>
                    </select>
                    @error('envio_soap_empresa')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="form-actions">
        <div class="text-right">
            <button wire:click="update" wire:loading.attr="disabled" class="btn btn-primary" type="button"> <i
                    class="fa fa-plus-circle"></i> <i wire:target="update" wire:loading.class="fa fa-spinner fa-spin"
                    aria-hidden="true"></i> Actualizar Empresa</button>

            <button wire:click="default" wire:loading.attr="disabled" class="btn btn-secondary" type="button"> <i
                    class=""></i> <i wire:target="default" wire:loading.class="fa fa-spinner fa-spin"
                    aria-hidden="true"></i>Cancelar </button>
        </div>
    </div>
</div>
