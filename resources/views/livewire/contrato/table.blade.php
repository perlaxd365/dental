
<div class="card-body">
    <div class="card-header">
        <h3>
            Lista de contratos
        </h3>
        <div class="input-group col-md-4">
            <input wire:model='search' type="text" class="form-control" placeholder="Buscar"
                aria-label="Recipient's username" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <i wire:target="search" wire:loading.class="fa fa-spinner fa-spin" aria-hidden="true"></i>
            </div>
        </div>
    </div>

    @if ($lista->count())
        <div wire:target="search" class="table-responsive">
            <table class="table no-wrap v-middle mb-0 table-bordered table-sm table-striped">
                <thead>
                    <tr class="border-0">
                        <th class="border-0 font-14 font-weight-medium text-muted">
                            Empresa
                        </th>
                        <th class="border-0 font-14 font-weight-medium text-muted px-2">
                            Fecha de inicio de contrato
                        </th>
                        <th class="border-0 font-14 font-weight-medium text-muted px-2">
                            Fecha fin de contrato
                        </th>
                        <th class="border-0 font-14 font-weight-medium text-muted px-2">
                            Estado
                        </th>
                        <th class="border-0 font-14 font-weight-medium text-muted px-2">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($lista as $datos)
                        <tr>
                            <td class="border-top-0 px-2 py-4">
                                <div class="d-flex no-block align-items-center">
                                    <div class="mr-3">
                                        <img src="{{ $datos->logo_empresa }}" alt="user" class="rounded-circle"
                                            width="45" height="45" />
                                    </div>
                                    <div class="">
                                        <h5 class="text-dark mb-0 font-16 font-weight-medium">
                                            {{ $datos->nombre_comercial_empresa }}
                                        </h5>
                                        <span class="text-muted font-14">
                                            {{ $datos->telefono_empresa }}
                                        </span><br>
                                        <span class="text-muted font-14">
                                            {{ $datos->email_empresa }}
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td class="border-top-0 text-muted px-2 py-4 font-14">{{ DateUtil::getFecha($carbon::parse($datos->fecha_inicio_contrato)) }}</td>
                            <td class="border-top-0 text-muted px-2 py-4 font-14">{{ DateUtil::getFecha($carbon::parse($datos->fecha_fin_contrato)) }}</td>
                            <td class="border-top-0 text-muted px-2 py-4 font-14"><b>{{ ParametroUtil::getParametro($datos->estado_contrato, 'ESTADO_CONTRATO')}}</b></td>

                            <td class="border-top-0 text-muted px-2 py-4 font-14 text-center">
                                <div class="col text-center">
                                    <div class="ml-auto">
                                        <div class="btn-group mr-4" role="group" aria-label="First group">
                                            <button title="Editar" wire:click='edit({{ $datos->id_contrato }})'
                                                type="button" class="btn btn-outline-primary "><i
                                                    class="ti-pencil"></i></button>
                                            <button wire:click='delete({{ $datos->id_contrato }})' title="Eliminar"
                                                type="button" class="btn btn-outline-danger "><i
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
            </table>
        @else
            <div class="card-body">
                <strong>No se encontraron resultados</strong>
            </div>
    @endif
</div>
