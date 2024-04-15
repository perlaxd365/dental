<div>
    {{-- Stop trying to control. --}}
    
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Perfil de Empresa</h4>
            <div class="form-body">
                <div class="row">
                    
                    <div class="col-md-6 col-sm-6">
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row">
                                <div class="col-md-4">
                                    @if ($empresa->logo_empresa)
                                        <div class="card-body col-md-12">
                                            <img class="img-fluid rounded-start" src="{{ $empresa->logo_empresa }}" alt="">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nombre Comercial</label>
                            <input value="{{$empresa->nombre_comercial_empresa}}" readonly type="text" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Razón Social</label>
                            <input value="{{$empresa->razon_social_empresa}}" readonly type="text" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>RUC</label>
                            <input value="{{$empresa->ruc_empresa}}" readonly type="text" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Key Privado</label>
                            <textarea value="{{$empresa->key_empresa}}" readonly type="textarea" class="form-control" placeholder=""></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Dirección</label>
                            <input value="{{$empresa->direccion_empresa}}" readonly type="text" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Página WEB</label>
                            <input value="{{$empresa->pagina_empresa}}" readonly  type="text" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input value="{{$empresa->email_empresa}}" readonly type="text" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Teléfono</label>
                            <input value="{{$empresa->telefono_empresa}}" readonly  type="text" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Estado</label>
                            <select value="{{$empresa->estado_empresa}}" readonly disabled type="select" class="form-control">
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
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
                            <select value="{{$empresa->tipo_soap_empresa}}" disabled readonly type="text" class="form-control" placeholder="">
                                <option value="Demo">Demo</option>
                                <option value="Produccion">Producción</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>SOAP Envío</label>
                            <select value="{{$empresa->envio_soap_empresa}}" disabled readonly type="text" class="form-control" placeholder="">
                                <option value="Sin Soap">Sin Soap</option> 
                                <option value="Sunat">Sunat</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    
</div>
