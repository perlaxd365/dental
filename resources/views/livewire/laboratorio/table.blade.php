
    <div class="card-body">
        <div class="card-header">
            <h3>
                Listado de Trabajos de Laboratorio
            </h3>
            <div class="input-group col-4">
                <input wire:model='search' type="text" class="form-control" placeholder="Buscar"
                    aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <i wire:target="search" wire:loading.class="fa fa-spinner fa-spin" aria-hidden="true"></i>
                </div>
            </div>
        </div>
        <div wire:target="search" class="table-responsive">
            <table class="table no-wrap mb-0">
                @if ($lista->count())
                <thead>
                    <tr class="border-0">
                        <th class="border-0 font-14 font-weight-medium text-muted">
                            Paciente
                        </th>
                        <th class="border-0 font-14 font-weight-medium text-muted">
                            Fecha de Registro
                        </th>
                        <th class="border-0 font-14 font-weight-medium text-muted">
                            Fecha de Recojo
                        </th>
                        <th class="border-0 font-14 font-weight-medium text-muted px-2">
                            Producto de Laboratorio
                        </th>
                        <th class="border-0 font-14 font-weight-medium text-muted px-2">
                            Doctor
                        </th>
                        <th class="border-0 font-14 font-weight-medium text-muted text-center">
                            Cantidad
                        </th>
                        <th class="border-0 font-14 font-weight-medium text-muted text-center">
                            Costo
                        </th>
                        <th class="border-0 font-14 font-weight-medium text-muted">
                            Estado
                        </th>
                        <th class="border-0 font-14 font-weight-medium text-muted">
                            Observaciones
                        </th>
                        <th class="border-0 font-14 font-weight-medium text-muted text-center">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($lista as $laboratorios)
                        <tr>
                            <td class="border-top-0 px-2 py-4">
                                <div class="d-flex no-block align-items-center">
                                    <div class="mr-3">
                                        <img src="https://thumbs.dreamstime.com/z/laboratorio-dental-logo-icon-design-126492630.jpg"
                                            alt="user" class="rounded-circle" width="45" height="45" />
                                    </div>
                                    <div class="">
                                        <h5 class="text-dark mb-0 font-16 font-weight-medium">
                                            {{ $laboratorios->dni_paciente }}
                                        </h5>
                                        <span class="text-muted font-14 ">
                                            {{ $laboratorios->nombres_paciente }}
                                            <i class="fa fa-circle  
                                                @php if($laboratorios->estado==true)
                                                    {
                                                        echo 'text-success';
                                                    }else{
                                                        
                                                        echo 'text-danger';
                                                    } @endphp font-12"
                                                data-toggle="tooltip" data-placement="top" title="In Testing"></i>
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td class="border-top-0 text-muted px-2 py-4 font-14">
                                {{ $laboratorios->fecha_registro_lab }}</td>
                            <td class="border-top-0 text-muted px-2 py-4 font-14">{{ $laboratorios->fecha_recojo_lab }}
                            </td>
                            <td class="border-top-0 text-muted px-2 py-4 font-14">
                                {{ $laboratorios->nombre_producto_lab }}</td>
                            <td class="border-top-0 text-muted px-2 py-4 font-14">{{ $laboratorios->name }}</td>
                            <td class="border-top-0 text-muted px-2 py-4 font-14">{{ $laboratorios->cantidad_lab }}</td>
                            <td class="border-top-0 text-muted px-2 py-4 font-14">S/ {{ $laboratorios->costo_lab }}</td>
                            <td class="border-top-0 text-muted px-2 py-4 font-14">{{ $laboratorios->estado_lab }}</td>
                            <td class="border-top-0 text-muted px-2 py-4 font-14">{{ $laboratorios->observaciones_lab }}
                            </td>

                            <td>
                                <div class="d-flex align-items-center mb-4 text-center">
                                    <div class="ml-auto">
                                        <div class="btn-group mr-2" role="group" aria-label="First group">
                                            <button title="Editar" type="button"
                                                wire:click='edit({{ $laboratorios->id_laboratorio }})'
                                                class="btn btn-secondary"><i class="ti-pencil"></i></button>
                                            <button wire:click='delete({{ $laboratorios->id_laboratorio }})'
                                                title="Eliminar" type="button" class="btn btn-secondary"><i
                                                    class="ti-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    <div class="card-footer text-right">
                        {{ $lista->links() }}
                    </div>
                </tbody>
                @else
                    <div class="card-body">
                        <strong>No se encontraron resultados</strong>
                    </div>
                @endif
            </table>
        </div>
    </div>
