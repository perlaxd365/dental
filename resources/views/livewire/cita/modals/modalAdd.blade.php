<div wire:ignore.self class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Agregar Evento</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">
                <div wire:ignore class="form-group">
                    <label for="title" class="col-sm-10 control-label">
                        Seleccionar paciente&nbsp;
                        <a data-toggle="modal" data-target=".bd-example-modal-lg"
                            href="javascript:void(0)">[Agregar]</a></label>

                    <select wire:model="id_paciente" class="form-control select2" id="select2">
                        <option value="">Seleccionar</option>
                        @foreach ($pacientes as $paciente)
                            <option value="{{ $paciente->id_paciente }}">{{ $paciente->nombres_paciente }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">Titulo</label>
                    <div class="col-sm-10">
                        <input type="text" name="title" class="form-control" id="title" placeholder="Titulo">
                    </div>
                </div>
                <div class="form-group">
                    <label for="color" class="col-sm-2 control-label">Color</label>
                    <div class="col-sm-10">
                        <select name="color" class="form-control" id="color">
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
                </div>
                <div class="form-group">
                    <label for="start" class="col-sm-2 control-label">Fecha
                        Inicial</label>
                    <div class="col-sm-10">
                        <input type="datetime-local" name="start" class="form-control" id="start">

                    </div>
                </div>
                <div class="form-group">
                    <label for="end" class="col-sm-2 control-label">Fecha
                        Final</label>
                    <div class="col-sm-10">
                        <input type="datetime-local" name="end" class="form-control" id="end">
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('livewire:load', event => {
            $(".select2").select2({
                width: '390px',
                height: '60px',
                class: 'form-control'
            });
            $(".select2").on('change', function() {
                @this.set('id_paciente', this.value);
            });
        })
        window.addEventListener('data', event => {


            $(".select2").select2("destroy");
            // possible loop
            $(".select2").append("<option value='" + event.detail.id_paciente + "'>'" + event.detail
                .nombres_paciente + "'</option>");
        })
    </script>
</div>
