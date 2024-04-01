<div class="card-body">
    <h4 class="card-title">Actualizar Datos de Paciente</h4>
    <div class="form-body">
        <style>
            .switch {
                position: relative;
                display: inline-block;
                width: 50px;
                height: 28px;
            }

            .switch input {
                opacity: 0;
                width: 0;
                height: 0;
            }

            .slider {
                position: absolute;
                cursor: pointer;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: #ccc;
                -webkit-transition: .4s;
                transition: .4s;
            }

            .slider:before {
                position: absolute;
                content: "";
                height: 20px;
                width: 20px;
                left: 4px;
                bottom: 4px;
                background-color: white;
                -webkit-transition: .4s;
                transition: .4s;
            }

            input:checked+.slider {
                background-color: #14DB00;
            }

            input:focus+.slider {
                box-shadow: 0 0 1px #14DB00;
            }

            input:checked+.slider:before {
                -webkit-transform: translateX(26px);
                -ms-transform: translateX(26px);
                transform: translateX(26px);
            }

            /* Rounded sliders */
            .slider.round {
                border-radius: 34px;
            }

            .slider.round:before {
                border-radius: 50%;
            }
        </style>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputZip3">DNI</label>
                    <div class="input-group">
                        <input type="text" wire:model='dni_paciente' class="form-control" placeholder="Buscar por DNI"
                            aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <div class="input-group-append">

                            <button wire:click="buscarDNI" wire:loading.attr="disabled" class="btn btn-primary"
                                type="button"> <i class="fa fa-search"></i> <i wire:target="buscarDNI"
                                    wire:loading.class="fa fa-spinner fa-spin" aria-hidden="true"></i>
                            </button>

                        </div>
                    </div>
                    @error('dni_paciente')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                </div>
                <div class="form-group col-md-6">
                    <label for="inputAddress">Nombres y Apellidos</label>
                    <input type="text" wire:model="nombres_paciente" class="form-control" id="inputAddress"
                        placeholder="Ingresar nombres">

                    @error('nombres_paciente')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputZip3">Email</label>
                    <input wire:model="email_paciente" type="text" class="form-control" id="inputZip3"
                        placeholder="Ingresar email">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputCity2">Teléfono</label>
                    <input wire:model="telefono_paciente" type="text" placeholder="Ingresar teléfono"
                        class="form-control" id="inputCity2">
                </div>
            </div>

            <div class="form-group">
                <label for="inputAddress">Dirección</label>
                <input wire:model="direccion_paciente"re type="text" class="form-control" id="inputAddress"
                    placeholder="Ingresar dirección">
                @error('direccion_paciente')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputCity">Estado Civil</label>
                    <input wire:model="estado_civil_paciente" placeholder="Ingresar Estado Civil" type="text"
                        class="form-control" id="inputCity">
                    @error('estado_civil_paciente')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="inputZip">Sexo</label>
                    <input wire:model="sexo_paciente" type="text" placeholder="Ingresar género" class="form-control"
                        id="inputZip">
                    @error('sexo_paciente')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="inputZip1">Fecha de Nacimiento</label>
                    <input wire:model="fecha_nacimiento_paciente" type="text"
                        placeholder="Ingresar fecha de nacimiento" class="form-control" id="inputZip1">
                    @error('fecha_nacimiento_paciente')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputZip3">Edad</label>
                    <input wire:model="edad_paciente" type="text" placeholder="Ingresar edad" class="form-control"
                        id="inputZip3">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputZip3">Pais</label>
                    <input wire:model="pais_paciente" type="text" class="form-control" id="inputZip3">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputZip4">Mayor de edad</label><br>
                    <label class="switch" style="size: 4cm">
                        <input wire:model="mayor_edad_paciente" type="checkbox" checked>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputCity2">Grado de Instrucción</label>
                    <select class="form-control" wire:model="grado_instruccion_paciente">
                        <option value="">Seleccionar</option>
                        <option value="Libre">Libre</option>
                        <option value="Estudios Finalizados">Estudios Finalizados</option>
                        <option value="Bachiller">Bachiller</option>
                        <option value="Titulado">Titulado</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputZip3">Ocupación</label>
                    <input wire:model="ocupacion_paciente" placeholder="Ingresar Ocupación" type="text"
                        class="form-control" id="inputZip3">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputZip4">Estado</label><br>
                    <label class="switch" style="size: 4cm">
                        <input wire:model="estado" type="checkbox" checked>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
        </div>
    </div>
    <h4 class="card-title">Agregar Datos de Acompañante <b>Opcional</b></h4>
    <div class="form-body">
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputZip3">DNI de acompañante</label>
                    <input wire:model="dni_acompaniante_paciente" placeholder="Ingresar el dni del acompañante"
                        type="text" class="form-control" id="inputZip3">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputCity2">Nombres y Apellidos de acompañante</label>
                    <input wire:model="nombres_acompaniante_paciente" placeholder="Ingresar nombres del acompañantes"
                        type="text" class="form-control" id="inputCity2">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputCity2">Departamento</label>
                    <input wire:model="departamento_paciente" type="text" placeholder="Ingresar departamento"
                        class="form-control" id="inputCity2">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputZip3">Provincia</label>
                    <input wire:model="provincia_paciente" type="text" placeholder="Ingresar provincia"
                        class="form-control" id="inputZip3">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputZip3">Distrito</label>
                    <input wire:model="distrito_paciente" type="text" placeholder="Ingresar distrito"
                        class="form-control" id="inputZip3">
                </div>
            </div>
        </div>
    </div>
    <div class="form-actions">
        <div class="text-right">
            <button wire:click="update" wire:loading.attr="disabled" class="btn btn-primary" type="button"> <i
                    class="fa fa-edit"></i> <i wire:target="update" wire:loading.class="fa fa-spinner fa-spin"
                    aria-hidden="true"></i> Actualizar Paciente</button>

            <button wire:click="default" wire:loading.attr="disabled" class="btn btn-secondary" type="button"> <i
                    wire:target="default" wire:loading.class="fa fa-spinner fa-spin"
                    aria-hidden="true"></i>Cancelar</button>
        </div>
    </div>
</div>
