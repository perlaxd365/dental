
@can('admin.users.index')
<div class="card-body">
    <h4 class="card-title">Agregar Datos de Empresa</h4>
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
                    <label>Email Empresa</label>
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
                    <label>Logo</label>
                    <input wire:model="logo_empresa" accept="image/*" type="file" class="form-control"
                        placeholder="">
                    @error('logo_empresa')
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
        </div>
    </div>
    <h4 class="card-title">Entorno del Sistema</h4>
    <div class="form-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="select_tipo_soap">SOAP Tipo</label>
                    <select wire:model="tipo_soap_empresa" id="select_tipo_soap"  class="form-control" placeholder="">
                        <option  value="">Seleccionar</option>
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
                    <select wire:model="envio_soap_empresa"  class="form-control" placeholder="">
                        <option selected value="">Seleccionar</option>
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
            <button wire:click="agregar" wire:loading.attr="disabled" class="btn btn-primary" type="button"> <i
                    class="fa fa-plus-circle"></i> <i wire:target="agregar" wire:loading.class="fa fa-spinner fa-spin"
                    aria-hidden="true"></i> Agregar Empresa</button>

            <button wire:click="default" wire:loading.attr="disabled" class="btn btn-secondary" type="button"> <i wire:target="default" wire:loading.class="fa fa-spinner fa-spin"
                    aria-hidden="true"></i>Limpiar </button>
        </div>
    </div>
</div>
@endcan