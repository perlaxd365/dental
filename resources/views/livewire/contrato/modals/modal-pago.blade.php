<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

<div wire:ignore.self class="modal fade" id="modalPago" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"> <b>Pagos</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;
                    </span>
                </button>
            </div>
            <div class="container">
                <ul class="nav nav-tabs">
                    @foreach ($cuotas as $cuota)
                        <li class="nav-item">
                            <a wire:click='cuotaChange({{ $cuota->numero_cuota_detalle }},{{ $cuota->id_detalle_pago }})'
                                class="nav-link text-dark <?php if ($cuota->numero_cuota_detalle == $numero_cuota_detalle) {
                                    echo 'active';
                                } else {
                                    echo '';
                                } ?>" href="javascript:void()">Cuota
                                {{ $cuota->numero_cuota_detalle }}

                                @if ($cuota->estado_detalle == config('constants.ESTADO_DETALLE_PAGO_COMPLETADO'))
                                    <i class="fa fa-check-circle text-success" aria-hidden="true"></i>
                                @else
                                    <i class="fa fa-times-circle text-danger" aria-hidden="true"></i>
                                @endif
                            </a>
                        </li>
                    @endforeach
                </ul>

            </div>
            @if ($showPago)
                <div class="modal-body">
                    @if ($notificacion_detalle)
                        <div class="alert alert-success" role="alert">
                            <i class="fa fa-check-circle text-success" aria-hidden="true"></i>
                            Se notificó correctamente el {{ $fecha_notificacion_detalle }}
                        </div>
                    @endif

                    <div class="alert alert-warning" role="alert">
                        <i class="fa fa-clock text-dark" aria-hidden="true"></i>
                        Límite de pago: {{ $fecha_fin_detalle }}
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-sm-12 control-label">Nombres Completos</label>
                        <div class="col-sm-12">
                            <input type="text" wire:model="nombre_completo_detalle" class="form-control"
                                id="title" placeholder="Por favor ingresar nombre completos">
                        </div>
                        @error('nombre_completo_detalle')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title" class="col-sm-12 control-label">Medio de Pago</label>
                                <div class="col-sm-12">
                                    <select wire:model="id_tipo_pago" class="form-control" placeholder="">
                                        <option value="">Seleccionar</option>
                                        @foreach ($tipos_pagos as $tipo_pago)
                                            <option value="{{ $tipo_pago->id_tipo_pago }}">
                                                {{ $tipo_pago->nombre_tipo_pago }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('id_tipo_pago')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title" class="col-sm-12 control-label">Monto Total</label>
                                <div class="col-sm-12">
                                    <input type="number" wire:model="monto_detalle" class="form-control" id="title"
                                        placeholder="000.00">

                                    @error('monto_detalle')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title" class="col-sm-12 control-label">Moneda</label>
                                <div class="col-sm-12">
                                    <select wire:model="moneda_detalle" class="form-control" placeholder="">
                                        <option value="">Seleccionar</option>
                                        <option value="1">Soles</option>
                                        <option value="2">Dolares</option>
                                    </select>
                                </div>
                                @error('moneda_detalle')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        @if ($showTipoCambio)
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title" class="col-sm-12 control-label">Tipo de cambio</label>
                                    <div class="col-sm-12">
                                        <input type="number" wire:model='tipo_cambio_detalle'
                                            name="tipo_cambio_detalle" class="form-control" id="title"
                                            placeholder="000.00">
                                    </div>
                                    @error('tipo_cambio_detalle')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        @endif
                        @if ($showTelefono)
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title" class="col-sm-12 control-label">Número de Teléfono </label>
                                    <div class="col-sm-12">
                                        <input type="text" wire:model="numero_telefono_detalle" class="form-control"
                                            id="title" placeholder="900 000 000">
                                    </div>
                                    @error('numero_telefono_detalle')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        @endif
                        @if ($showOperacion)
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title" class="col-sm-12 control-label">Número de Operación</label>
                                    <div class="col-sm-12">
                                        <input type="text" wire:model="numero_operacion_detalle"
                                            class="form-control" id="title" placeholder="00000000">
                                    </div>
                                    @error('numero_operacion_detalle')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        @endif
                        @if ($showTransferencia)
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title" class="col-sm-12 control-label">Número de
                                        Transferencia</label>
                                    <div class="col-sm-12">
                                        <input type="text" wire:model="numero_transferencia_detalle"
                                            class="form-control" id="title" placeholder="000-000000-00">
                                    </div>
                                    @error('numero_transferencia_detalle')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        @endif

                    </div>

                    <div class="form-group">
                        <div class="form-group">
                            <label for="title" class="col-sm-12 control-label">Estado de pago</label>
                            <div class="col-sm-12">

                                <select wire:model="estado_detalle" class="form-control" placeholder="">
                                    <option value="">Seleccionar</option>
                                    <option value="1">Pago Completado</option>
                                    <option value="2">Falta de Pago</option>
                                </select>
                            </div>
                            @error('estado_detalle')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-sm-12 control-label">Adjunto de pago</label>
                        <div class="col-sm-12">
                            <input type="file" wire:model="adjunto_detalle" class="form-control" id="title"
                                placeholder="Ingresar adjunto">
                        </div>
                        @if ($adjunto_detalle)
                            <div class="container">
                                <a class="form-control"
                                    onclick="window.open('{{ $adjunto_detalle }}', 'hello', 'width=400,height=400')">
                                    <u><i class="fa fa-eye text-primary"></i> Ver adjunto</u>
                                </a>
                            </div>
                        @endif
                        @error('adjunto_detalle')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>




                    <div class="form-group">
                        <label for="title" class="col-sm-12 control-label">Observaciones</label>
                        <div class="col-sm-12">
                            <textarea type="text" rows="2" wire:model="observaciones_detalle" class="form-control" id="title"
                                placeholder="Ingresar observaciones">
                        </textarea>
                        </div>
                        @error('observaciones_detalle')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            @endif
            <div class="modal-footer">
                <div class="form-actions">
                    <div class="text-right">
                        @if ($showPago)
                            @if ($estado_detalle == config('constants.ESTADO_DETALLE_PAGO_INCOMPLETO'))
                                <button wire:click="updateDetalle" wire:loading.attr="disabled"
                                    class="btn btn-primary" type="button"> <i class="fa fa-edit"></i> <i
                                        wire:target="updateDetalle" wire:loading.class="fa fa-spinner fa-spin"
                                        aria-hidden="true"></i>
                                    Actualizar</button>
                            @else
                                <button wire:click="updateDetalle" wire:loading.attr="disabled"
                                    class="btn btn-primary" type="button"> <i class="fa fa-plus-circle"></i> <i
                                        wire:target="updateDetalle" wire:loading.class="fa fa-spinner fa-spin"
                                        aria-hidden="true">
                                    </i>
                                    Guardar</button>
                            @endif
                        @endif
                        <button wire:click="closeModal" wire:loading.attr="disabled" class="btn btn-secondary"
                            type="button"> <i wire:target="closeModal" wire:loading.class="fa fa-spinner fa-spin"
                                aria-hidden="true"></i>Salir</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.addEventListener('close-modal-pago', event => {
        $('#modalPago').modal('hide');

    });

    window.addEventListener('open-modal-pago', event => {
        $('#modalPago').modal('show');

    });
</script>
