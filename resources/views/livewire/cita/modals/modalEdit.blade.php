<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-horizontal" method="POST" name="updateCita" id="updateCita" >
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Modificar Cita</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <div class="col-sm-10">
                           <h3> <a href="#" class="text-decoration-none"><u>CESAR BACA GAMARRA</u></h3>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-sm-2 control-label">Titulo</label>
                        <div class="col-sm-10">
                            <input type="text" name="title" class="form-control" id="title"
                                placeholder="Titulo">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="descripcion_cita" class="col-sm-2 control-label">Descripción</label>
                        <div class="col-sm-10">
                            <input type="text" name="descripcion_cita" class="form-control" id="descripcion_cita"
                                placeholder="Desripción de Cita">
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
                        <label for="fecha_inicio_cita" class="col-sm-12 control-label">Fecha
                            Inicial</label>
                        <div class="col-sm-10">
                            <input onkeydown="return false" type="datetime-local" name="fecha_inicio_cita"
                                class="form-control" id="fecha_inicio_cita">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fecha_fin_cita" class="col-sm-12 control-label">Fecha
                            Final</label>
                        <div class="col-sm-10">
                            <input onkeydown="return false" type="datetime-local" name="fecha_fin_cita"
                                class="form-control" id="fecha_fin_cita">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                                <label class="text-danger"><input type="checkbox" name="delete"> Eliminar
                                    Evento</label>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="id" class="form-control" id="id">


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
