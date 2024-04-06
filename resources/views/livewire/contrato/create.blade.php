@can('admin.users.index')
    <div class="card-body">
        <h4 class="card-title">Iniciar Nuevo Contrato</h4>
        <div class="form-body">
            <div class="row">
                <div class="col-md-6">
                    <div wire:ignore class="form-group">
                        <label>Seleccionar empresa</label><br>

                        <div class="col-sm-12">
                            <select wire:model="id_empresa"  class="form-control select2" id="select2">
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
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="start" class="col-sm-12 control-label">
                            Cantidad de Sucursales</label>
                        <div class="col-sm-12">
                            <input wire:model="cantidad_sucursales_contrato" type="number"
                                name="cantidad_sucursales_contrato" class="form-control">
                        </div>
                        @error('cantidad_sucursales_contrato')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="start" class="col-sm-12 control-label">Fecha
                            inicio de contrato</label>
                        <div class="col-sm-12">
                            <input wire:model="fecha_inicio_contrato" type="date" name="fecha_inicio_contrato"
                                class="form-control">
                        </div>
                        @error('fecha_inicio_contrato')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="start" class="col-sm-12 control-label">
                            Meses contrato</label>
                        <div class="col-sm-12">
                            <input wire:model="meses_contrato" type="number" name="meses_contrato" class="form-control">
                        </div>
                        @error('meses_contrato')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="start" class="col-sm-12 control-label">Fecha
                            fin de contrato</label>
                        <div class="col-sm-12">
                            <input wire:model="fecha_fin_contrato" type="date" name="fecha_fin_contrato"
                                class="form-control">
                        </div>
                        @error('fecha_fin_contrato')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="start" class="col-sm-12 control-label">
                            Monto Total</label>
                        <div class="col-sm-12">
                            <input wire:model="monto_total_contrato" type="number" name="monto_total_contrato"
                                class="form-control">
                        </div>
                        @error('monto_total_contrato')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for=""class="col-sm-12 control-label">Promocion de Contrato</label>

                        <div class="col-sm-12">
                            <select wire:model="id_promo" class="form-control" placeholder="">
                                <option value="">Seleccionar</option>
                                @foreach ($promos as $promo)
                                    <option value="{{ $promo->id_promo }}">{{ $promo->nombre_promo }} -
                                        {{ $promo->descripcion_promo }} ({{ $promo->precio_promo }})</option>
                                @endforeach
                            </select>
                        </div>
                        @error('promocion_contrato')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for=""class="col-sm-12 control-label">Estado de Contrato</label>

                        <div class="col-sm-12">
                            <select wire:model="estado_contrato" class="form-control" placeholder="">
                                <option value="">Seleccionar</option>
                                <option value="1">Contrato Inactivo</option>
                                <option value="2">Contrato Activo</option>
                                <option value="3">Contrato Espera de pago</option>
                                <option value="4">Contrato Finalizado</option>
                            </select>
                        </div>
                        @error('estado_contrato')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-12 control-label">PDF de Contrato</label>

                        <div class="col-sm-12">
                            <input wire:model="pdf_contrato_ruta_contrato" accept="pdf/*" type="file"
                                class="form-control" placeholder="">
                        </div>
                        @error('pdf_contrato_ruta_contrato')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="form-actions">
            <div class="text-right">
                <button wire:click="agregar" wire:loading.attr="disabled" class="btn btn-primary" type="button"> <i
                        class="fa fa-plus-circle"></i> <i wire:target="agregar"
                        wire:loading.class="fa fa-spinner fa-spin" aria-hidden="true"></i> Agregar Contrato</button>

                <button wire:click="default" wire:loading.attr="disabled" class="btn btn-secondary" type="button"> <i
                        wire:target="default" wire:loading.class="fa fa-spinner fa-spin"
                        aria-hidden="true"></i>Limpiar</button>

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

            window.addEventListener('data', event => {
                $('.select2').val(event.detail.id_empresa).trigger('change.select2');

                @this.set('id_empresa', event.detail.id_empresa);
            })
        </script>
    </div>
@endcan
