<div class="card-body">
    <h4 class="card-title">Agregar Trabajo de Laboratorio</h4>
    <div class="form-body">
        <div class="row">
            <div class="col-md-4  mb-2 form-group">
                <label for="title" class="col-sm-12 control-label">
                    Seleccionar paciente&nbsp;
                    <a data-toggle="modal" data-target=".bd-example-modal-lg" href="javascript:void(0)">[Agregar]</a>
                </label>
                <div wire:ignore style="padding-left: 3%">
                    <select wire:model="id_paciente" name="id_paciente" class="form-control select2" id="select2">
                        <option value="">Seleccionar</option>
                        @foreach ($pacientes as $paciente)
                            <option value="{{ $paciente->id_paciente }}">{{ $paciente->nombres_paciente }}</option>
                        @endforeach
                    </select>
                </div>
                @error('id_paciente')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-4 form-group">
                <label for="fecha-registro">
                    Fecha Registro
                </label>
                <input wire:model='fecha_registro_lab' onkeydown="return false" type="datetime-local"
                    class="form-control">

                @error('fecha_registro_lab')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-4 form-group">
                <label for="fecha-registro">
                    Fecha Recojo
                </label>
                <input wire:model='fecha_recojo_lab' onkeydown="return false" type="datetime-local"
                    class="form-control">

                @error('fecha_recojo_lab')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-4 form-group">
                <label>
                    Productos de Laboratorio
                </label>
                <select class="form-control" wire:model='id_producto_lab'>
                    <option value="">Seleccionar</option>
                    @if ($productos_lab->count())
                        @foreach ($productos_lab as $productos)
                            <option value="{{ $productos->id_producto_lab }}">{{ $productos->nombre_producto_lab }}
                            </option>
                        @endforeach
                    @endif
                </select>
                @error('id_producto_lab')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-4 form-group">
                <label for="fecha-registro">
                    Cantidad
                </label>
                <input wire:model='cantidad_lab' type="number" class="form-control">

                @error('cantidad_lab')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-4 form-group">
                <label for="fecha-registro">
                    Costo
                </label>
                <input wire:model='costo_lab' type="number" class="form-control">

                @error('costo_lab')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-4 form-group">
                <label for="area">
                    Area
                </label>
                <select wire:model='area_lab' class="form-control">
                    <option value="">Seleccionar</option>
                    <option value="Area Principal">Area Principal</option>
                </select>
                @error('area_lab')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-4 form-group">
                <label for="fecha-registro">
                    Responsable
                </label>
                <select class="form-control" wire:model='id_doctor'>
                    <option value="">Seleccionar</option>
                    @if ($doctores->count())
                        @foreach ($doctores as $doctor)
                            <option value="{{ $doctor->id }}">{{ $doctor->name }}
                            </option>
                        @endforeach
                    @endif
                </select>
                @error('id_doctor')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-4 form-group">
                <label for="">
                    Estado
                </label>
                <select wire:model='estado_lab' class="form-control">
                    <option value="">Seleccionar</option>
                    <option value="Registrado">Registrado</option>
                    <option value="Enviado">Enviado</option>
                    <option value="En Proceso">En Proceso</option>
                    <option value="Terminado">Terminado</option>
                    <option value="Por Corregir">Por Corregir</option>
                    <option value="Corregido">Corregido</option>
                    <option value="En reparación">En reparación</option>
                </select>
                @error('estado_lab')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-12">
                <label for="">
                    Observaciones
                </label>
                <textarea wire:model='observaciones_lab' class="form-control" cols="30" rows="3"></textarea>

                @error('observaciones_lab')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
    <br>
    <div class="form-actions">
        <div class="text-right">
            <button wire:click="agregar" wire:loading.attr="disabled" class="btn btn-primary" type="button"> <i
                    class="fa fa-plus-circle"></i> <i wire:target="agregar" wire:loading.class="fa fa-spinner fa-spin"
                    aria-hidden="true"></i> Agregar Trabajo de Laboratorio</button>

            <button wire:click="default" wire:loading.attr="disabled" class="btn btn-secondary" type="button"> <i
                    wire:target="default" wire:loading.class="fa fa-spinner fa-spin"
                    aria-hidden="true"></i>Limpiar</button>
        </div>
    </div>


    </html>
    <script>
        window.addEventListener('livewire:load', event => {
            $(".select2").select2({
                width: '360px',
                height: '60px',
                class: 'form-control'
            });

            $(".select2").on('change', function() {
                @this.set('id_paciente', this.value);
            });
        })
        window.addEventListener('data', event => {

            var newOption = new Option(event.detail.nombres_paciente, event.detail.id_paciente, true, true);


            $('.select2').append(newOption).trigger('change'); //until this point, everything works

            @this.set('id_paciente', event.detail.id_paciente);


        })
    </script>
</div>
