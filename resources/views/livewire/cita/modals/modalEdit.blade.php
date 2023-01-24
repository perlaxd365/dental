<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<div wire:ignore.self class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-horizontal" name="updateCita" id="updateCita">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Modificar Cita</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <div class="col-sm-10">
                            <h3> <a href="#" class="text-decoration-none"><u id="nombre_paciente"></u></h3>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-sm-2 control-label">Título</label>
                        <div class="col-sm-10">
                            <input type="text" name="title_update" class="form-control" id="title_update"
                                placeholder="Titulo">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="descripcion_cita_update" class="col-sm-2 control-label">Descripción</label>
                        <div class="col-sm-10">
                            <input type="text" name="descripcion_cita_update" class="form-control"
                                id="descripcion_cita_update" placeholder="Desripción de Cita">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="color" class="col-sm-2 control-label">Color</label>
                        <div class="col-sm-10">
                            <select name="color_update" class="form-control" id="color_update">
                                <option value="">Seleccionar</option>
                                <option style="color:#0071c5;" value="#0071c5">&#9724; Azul
                                    oscuro</option>
                                <option style="color:#40E0D0;" value="#40E0D0">&#9724;
                                    Turquesa</option>
                                <option style="color:#008000;" value="#008000">&#9724; Verde
                                </option>
                                <option style="color:#FFD700;" value="#FFD700">&#9724;
                                    Amarillo</option>
                                <option style="color:#FF8C00;" value="#FF8C00">&#9724;
                                    Naranja</option>
                                <option style="color:#FF0000;" value="#FF0000">&#9724; Rojo
                                </option>
                                <option style="color:#000;" value="#000">&#9724; Negro
                                </option>

                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fecha_inicio_cita_update" class="col-sm-12 control-label">Fecha
                            Inicial</label>
                        <div class="col-sm-10">
                            <input onkeydown="return false" type="datetime-local" name="fecha_inicio_cita_update"
                                class="form-control" id="fecha_inicio_cita_update">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fecha_fin_cita_update" class="col-sm-12 control-label">Fecha
                            Final</label>
                        <div class="col-sm-10">
                            <input onkeydown="return false" type="datetime-local" name="fecha_fin_cita_update"
                                class="form-control" id="fecha_fin_cita_update">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <label class="text-danger">
                                <input type="checkbox" id="delete" name="delete">
                                Eliminar
                                Evento
                            </label>

                        </div>
                    </div>

                    <input hidden name="id" class="form-control" id="id">


                </div>
                <div class="modal-footer">
                    <button id="btn-print-cita" type="button" class="btn btn-danger"><i class="fas fa-print"></i>
                        Imprimir</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                            class="fas fa-window-close"></i> Cerrar</button>
                    <button type="submit" id="btn-update-cita" class="btn btn-primary"><i
                            class="fas fa-sync-alt"></i> Actualizar Cita</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script></script>

<script>
    //print cita
    $("#btn-print-cita").on("click", function(e) {
        let id_cita = $("#id").val();
        window.open("/printCita/"+id_cita, "Diseño Web", "width=800, height=500")
    });

    //actualizar cita
    $("#updateCita").on("submit", function(e) {
        // Cancelamos el evento si se requiere 
        e.preventDefault();

        // Obtenemos los datos del formulario 
        var f = $(this);
        var _token = $('input#_token').val();
        var formData = new FormData(document.getElementById("updateCita"));
        //formData.append("dato", "valor");
        formData.append("_token", _token);
        formData.append("fecha_inicio_cita_update", moment($("#fecha_inicio_cita_update").val()).format(
            'YYYY-MM-DD HH:mm:ss'));
        formData.append("fecha_fin_cita_update", moment($("#fecha_fin_cita_update").val()).format(
            'YYYY-MM-DD HH:mm:ss'));
        // Enviamos los datos al archivo PHP que procesará el envio de los datos a un determinado correo 

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
                url: "updateCita",
                type: "post",
                dataType: "json",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function(data) {
                    $('#btn-update-cita').html(
                        '<i id="loading" class="fa fa-spinner fa-spin" aria-hidden="true"></i>'
                    );

                    $('#btn-update-cita').prop('disabled', true);
                },
                success: function(data) {

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
                    $('#ModalEdit').modal('hide');
                    toastr.options.positionClass = 'toast-bottom-right';
                    toastr.success('Exito', 'Se creó la cita correcta.')
                }
            })

            // Cuando el formulario es enviado, mostramos un mensaje en la vista HTML 
            // En el archivo enviarcorreo.php devuelvo el valor '1' el cual es procesado con jQuery Ajax 
            // y significa que el mensaje se envio satisfactoriamente. 
            .done(function(res) {

                $('#ModalEdit').modal('hide');
                $("#updateCita").trigger("reset");
                $("i").remove("#loading");
                $("#btn-update-cita").prop('disabled', false);
                $('#btn-update-cita').html(
                    'Actualizar Cita'
                );
                location.reload();

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
                $("#btn-update-cita").prop('disabled', false);
                $('#btn-update-cita').html(
                    'Actualizar Cita'
                );
            });

    });
</script>
