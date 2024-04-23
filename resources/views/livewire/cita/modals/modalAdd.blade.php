<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

<div wire:ignore.self class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-calendar "></i> Agregar Cita</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>

            </div>

            <form name="formCita" id="formCita" enctype="multipart/form-data">
                <input type="hidden" id="_token" value="{{ csrf_token() }}">
                {!! csrf_field() !!}
                @csrf
                <div class="modal-body">
                    <div wire:ignore class="form-group" style="padding-left: 10px">
                        <label for="title" class="col-sm-12 control-label">
                            Seleccionar paciente&nbsp;
                            <a data-toggle="modal" data-target=".bd-example-modal-lg"
                                href="javascript:void(0)">[Agregar]</a></label>
                        <select wire:model="id_paciente" name="id_paciente" class="form-control select2" id="select2">
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
                        <label for="title" class="col-sm-12 control-label">Título</label>
                        <div class="col-sm-10">
                            <input type="text" name="motivo_cita" class="form-control" id="title"
                                placeholder="Titulo de la cita">
                        </div>
                        @error('motivo_cita')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="desc" class="col-sm-2 control-label">Descripción</label>
                        <div class="col-sm-10">
                            <input type="text" autocomplete="off" name="descripcion_cita" class="form-control" id="desc"
                                placeholder="Descripción de la cita">
                        </div>
                        @error('motivo_cita')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="color" class="col-sm-2 control-label">Color</label>
                        <div class="col-sm-10">
                            <select name="color_cita" class="form-control" id="color">
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
                        <label for="start" class="col-sm-12 control-label">Fecha
                            Inicial</label>
                        <div class="col-sm-10">
                            <input onkeydown="return false" type="datetime-local" name="fecha_inicio_cita"
                                class="form-control" id="start">

                        </div>
                        @error('fecha_inicio_cita')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="end" class="col-sm-12 control-label">Fecha
                            Final</label>
                        <div class="col-sm-10">
                            <input onkeydown="return false" type="datetime-local" name="fecha_fin_cita"
                                class="form-control" id="end">
                        </div>
                        @error('fecha_fin_cita')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="alert alert-danger" style="display:none"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                        @can('admin.doctors.index')
                            <button id="enviarCita" class="btn btn-primary" type="submit">
                                <i class="fa fa-plus-circle"></i>

                                Guardar Cita
                            </button>
                        @endcan
                        @can('admin.users.index')
                            <button id="enviarCita" class="btn btn-primary" type="submit">
                                <i class="fa fa-plus-circle"></i>

                                Guardar Cita
                            </button>
                        @endcan
                    </div>
                </div>
            </form>
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
        $("#formCita").on("submit", function(e) {
            // Cancelamos el evento si se requiere 
            e.preventDefault();

            // Obtenemos los datos del formulario 
            var f = $(this);
            var _token = $('input#_token').val();
            var formData = new FormData(document.getElementById("formCita"));
            //formData.append("dato", "valor");
            formData.append("_token", _token);
            formData.append("fecha_inicio_cita", moment($("#start").val()).format('YYYY-MM-DD HH:mm:ss'));
            formData.append("fecha_fin_cita", moment($("#end").val()).format('YYYY-MM-DD HH:mm:ss'));
            // Enviamos los datos al archivo PHP que procesará el envio de los datos a un determinado correo 

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                    url: "storeCita",
                    type: "post",
                    dataType: "json",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function(data) {
                        $('#enviarCita').html(
                            '<i id="loading" class="fa fa-spinner fa-spin" aria-hidden="true"></i>'
                        );

                        $('#enviarCita').prop('disabled', true);
                    },
                    success: function(data) {
/* 
                        var title = $('#title').val();
                        var startTime = $('#start').val();
                        var endTime = $('#end').val();
                        var color = $('#color').val();

                        $("#calendar").fullCalendar('renderEvent', {
                                title: title,
                                description: 123,
                                start: startTime,
                                end: endTime,
                            },
                            true);
                        $('#ModalAdd').modal('hide');
                        toastr.options.positionClass = 'toast-bottom-right';
                        toastr.success('Exito', 'Se creó la cita correcta.') */
                        
                location.reload();
                    }
                })

                // Cuando el formulario es enviado, mostramos un mensaje en la vista HTML 
                // En el archivo enviarcorreo.php devuelvo el valor '1' el cual es procesado con jQuery Ajax 
                // y significa que el mensaje se envio satisfactoriamente. 
                .done(function(res) {


                    $('#ModalAdd').modal('hide');
                    //$("#formCita").trigger("reset");

                })

                // Mensaje de error al enviar el formulario 
                .fail(function(xhr) {
                    var jsonData = xhr.responseJSON;
                    var msg = jsonData.errors;
                    console.log(msg);
                    $.each(msg, function(key, value) {
                        toastr.options.positionClass = 'toast-bottom-right';
                        toastr.error('error', value)
                    });
                    $("i").remove("#loading");
                    $("#enviarCita").prop('disabled', false);
                    $('#enviarCita').html(
                        'Guardar Cita'
                    );
                });

        });
    </script>
</div>
