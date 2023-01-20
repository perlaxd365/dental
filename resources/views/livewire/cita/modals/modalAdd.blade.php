<div wire:ignore.self class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-calendar "></i> Agregar Cita</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">
                <div wire:ignore class="form-group" style="padding-left: 10px">
                    <label for="title" class="col-sm-12 control-label">
                        Seleccionar paciente&nbsp;
                        <a data-toggle="modal" data-target=".bd-example-modal-lg"
                            href="javascript:void(0)">[Agregar]</a></label>
                    <select wire:model="id_paciente" class="form-control select2" id="select2">
                        <option value="">Seleccionar</option>
                        @foreach ($pacientes as $paciente)
                            <option value="{{ $paciente->id_paciente }}">{{ $paciente->nombres_paciente }}</option>
                        @endforeach
                    </select>
                    @error('id_paciente')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">Motivo</label>
                    <div class="col-sm-10">
                        <input type="text" wire:model='motivo_cita' name="title" class="form-control"
                            id="title" placeholder="Titulo de la cita">
                    </div>
                    @error('motivo_cita')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">Descripcion</label>
                    <div class="col-sm-10">
                        <input type="text" wire:model='descripcion_cita' name="title" class="form-control"
                            id="title" placeholder="Descripción de la cita">
                    </div>
                    @error('motivo_cita')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="color" class="col-sm-2 control-label">Color</label>
                    <div class="col-sm-10">
                        <select wire:model='color_cita' name="color" class="form-control" id="color">
                            <option value="">Seleccionar</option>
                            <option style="color:#0071c5;" value="#0071c5">&#9724; Azul
                                oscuro</option>
                            <option style="color:#40E0D0;" value="#40E0D0">&#9724;
                                Turquesa</option>
                            <option style="color:#008000;" value="#008000">&#9724; Verde
                            </option>
                            <option style="color:#FFD700;" value="#FFD700">&#9724;
                                Amarillo</option>
                            <option style="color:#FF8C00;" value="#FF8C00">&#9724; Naranja
                            </option>
                            <option style="color:#FF0000;" value="#FF0000">&#9724; Rojo
                            </option>
                            <option style="color:#000;" value="#000">&#9724; Negro
                            </option>

                        </select>
                    </div>
                    @error('color_cita')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="start" class="col-sm-2 control-label">Fecha
                        Inicial</label>
                    <div class="col-sm-10">
                        <input wire:model='fecha_inicio_cita' onkeydown="return false" type="datetime-local"
                            name="start" class="form-control" id="start">

                    </div>
                    @error('fecha_inicio_cita')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="end" class="col-sm-2 control-label">Fecha
                        Final</label>
                    <div class="col-sm-10" >
                        <input  wire:model='fecha_fin_cita' onkeydown="return false" type="datetime-local" name="end"
                            class="form-control" id="end">
                    </div>
                    @error('fecha_fin_cita')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button wire:click="agregarCita" wire:loading.attr="disabled" class="btn btn-primary"
                    type="button">
                    <i class="fa fa-plus-circle"></i> <i wire:target="agregarCita"
                        wire:loading.class="fa fa-spinner fa-spin" aria-hidden="true"></i>
                    Guardar Cita</button>
            </div>
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
    <script>
        window.addEventListener('update-calendar', event => {
            let calendarEl = document.getElementById('calendar');
            calendar = new FullCalendar.Calendar(calendarEl, {});
            calendar.refetchEvents();
        })
    </script>
</div>
