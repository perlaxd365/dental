<div>
    <div class="card-group row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body table-responsive" id="line-chart">
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="validationDefault01">
                                Buscar Paciente&nbsp;
                            </label>
                            <br>
                            <div wire:ignore>
                                <select wire:model="id_paciente" name="id_paciente" class="form-control select2"
                                    id="select2">
                                    <option value="">Seleccionar</option>
                                    @foreach ($pacientes as $paciente)
                                        <option value="{{ $paciente->id_paciente }}">{{ $paciente->nombres_paciente }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-body table-responsive" id="line-chart">
                    <h4 class="card-title text-dark text-muted">Datos Personales</h4>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Nombres</label>
                        <div class="col-sm-9">
                            <input type="text" disabled wire:model="nombres_paciente" class="form-control"
                                id="inputPassword">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-3 col-form-label">DNI</label>
                        <div class="col-sm-9">
                            <input type="text" disabled wire:model="dni_paciente" class="form-control"
                                id="inputPassword">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-3 col-form-label">EMAIL</label>
                        <div class="col-sm-9">
                            <input type="text" disabled wire:model="email_paciente" class="form-control"
                                id="inputPassword">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-3 col-form-label">TELÉFONO</label>
                        <div class="col-sm-9">
                            <input type="text" disabled wire:model="telefono_paciente" class="form-control"
                                id="inputPassword">
                        </div>
                    </div>
                    <ul class="list-inline text-center mt-5 mb-2">
                        <li class="list-inline-item text-muted font-italic">Datos más relevantes.</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-body table-responsive" id="line-chart">
                    <h4 class="card-title text-dark text-muted">Historia de Ventas</h4>
                    <table class="table table-sm">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Producto</th>
                                <th scope="col">fecha</th>
                                <th scope="col">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ventas as $key => $venta)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>

                                    <td>
                                        <select class="form-control form-control-sm" id="">
                                            @foreach ($this->listaDetalle($venta->id_venta) as $item)
                                                <option value="" selected>{{ $item->nombre_detalle }} (S/
                                                    {{ $item->precio_unitario_detalle }} x
                                                    {{ $item->cantidad_detalle }}) = S/
                                                    {{ $item->precio_total_detalle }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>{{ DateUtil::getFechaSimple($venta->created_at) }}</td>
                                    <td class="text-center">

                                        <button wire:click='print({{ $venta->id_venta }})'
                                            class="btn btn-outline-secondary btn-sm rounded-circle">
                                            <i class="fa fa-print" aria-hidden="true"></i></button>

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <ul class="list-inline text-center mt-5 mb-2">
                        <li class="list-inline-item text-muted font-italic">Citas generales del paciente</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-body table-responsive" id="line-chart">
                    <h4 class="card-title text-dark text-muted">Historia de Recetas</h4>
                    <table class="table table-sm">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recetas as $key => $receta)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>

                                    <td>Receta realizada el : {{ DateUtil::getFechaSimple($receta->fecha_receta)}} - {{DateUtil::getHora($receta->fecha_receta) }}</td>
                                    <td class=" text-center">
                                        <button title="Descargar" wire:click='printReceta({{ $receta->id_receta }})'
                                            class="btn btn-outline-secondary btn-sm rounded-circle">
                                            <i class="fa fa-print" aria-hidden="true"></i></button>

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <ul class="list-inline text-center mt-5 mb-2">
                        <li class="list-inline-item text-muted font-italic">Citas generales del paciente</li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-body table-responsive" id="line-chart">
                    <h4 class="card-title text-dark text-muted">Historia de Citas</h4>
                    <div class="mt-4 activity">
                        <div class="d-flex align-items-start border-left-line pb-1">
                            <div>
                                <a wire:ignore class="btn btn-info btn-circle mb-2 btn-item">
                                    <i data-feather="shopping-cart" class="text-white"></i>
                                </a>
                            </div>
                            <div class="ml-3 mt-2">
                                <h5 class="text-dark font-weight-medium mb-2">New Product Sold!</h5>
                                <p class="font-14 mb-2 text-muted">John Musa just purchased Cannon 5M
                                    Camera.
                                </p>
                                <span class="font-weight-light font-14 text-muted">10 Minutes Ago</span>
                            </div>

                        </div>
                    </div>
                    <ul class="list-inline text-center mt-5 mb-2">
                        <li class="list-inline-item text-muted font-italic">Ventas de todos los meses</li>
                    </ul>
                </div>
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
</div>
