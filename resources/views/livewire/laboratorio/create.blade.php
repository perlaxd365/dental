<div class="card-body">
    <h4 class="card-title">Agregar Trabajo de Laboratorio</h4>
    <div class="form-body">
        <div class="row">
            <div wire:ignore class="col-md-4  mb-2">
                <label for="title" class="col-sm-12 control-label" >
                    Seleccionar paciente&nbsp;
                    <a data-toggle="modal" data-target=".bd-example-modal-lg" href="javascript:void(0)">[Agregar]</a>
                </label>
                <div style="padding-left: 3%">
                    <select wire:model="id_paciente" name="id_paciente" class="form-control select2"  id="select2">
                        <option value="">Seleccionar</option>
                        @foreach ($pacientes as $paciente)
                            <option value="{{ $paciente->id_paciente }}">{{ $paciente->nombres_paciente }}</option>
                        @endforeach
                    </select>
                </div>
                
                @error('id_paciente')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
        <div class="col-md-4">
            <label for="fecha-registro">
                Fecha Registro
            </label>
            <input wire:model='fecha_registro' onkeydown="return false"  type="datetime-local" class="form-control" >
                
                @error('fecha_registro')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
        </div>
        <div class="col-md-4">
            <label for="fecha-registro">
                Fecha Recojo
            </label>
            <input wire:model='fecha_registro' onkeydown="return false"  type="datetime-local" class="form-control" >
                
                @error('fecha_registro')
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
