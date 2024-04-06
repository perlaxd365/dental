<div class="card-body">
    <div class="card-header">
        <h3>
            Lista de contratos
        </h3>
        @can('admin.users.index')
            <div class="input-group col-md-12">
                <input wire:model='search' type="text" class="form-control" placeholder="Buscar"
                    aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <i wire:target="search" wire:loading.class="fa fa-spinner fa-spin" aria-hidden="true"></i>
                </div>
            </div>
        @endcan
        <br>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="start" class="col-sm-12 control-label">Fecha
                        inicio de contrato</label>
                    <div class="col-sm-10">
                        <input wire:model="fecha_inicio_contrato_search" type="date"
                            name="fecha_inicio_contrato_search" class="form-control">
                    </div>
                    @error('fecha_inicio_contrato_search')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="input-group-append col-md-1">
                <i wire:target="fecha_inicio_contrato_search" wire:loading.class="fa fa-spinner fa-spin"
                    aria-hidden="true"></i>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label for="start" class="col-sm-12 control-label">Fecha
                        fin de contrato</label>
                    <div class="col-sm-10">
                        <input wire:model="fecha_fin_contrato_search" type="date" name="fecha_fin_contrato_search"
                            class="form-control">
                    </div>
                    @error('fecha_fin_contrato_search')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="input-group-append col-md-1">
                <i wire:target="fecha_fin_contrato_search" wire:loading.class="fa fa-spinner fa-spin"
                    aria-hidden="true"></i>
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
                            Promoción
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
                            <td class="border-top-0 text-muted px-2 py-4 font-14">
                                <b>{{ $datos->promocion_contrato }}</b>
                            </td>
                            <td class="border-top-0 text-muted px-2 py-4 font-14">
                                {{ DateUtil::getFecha($carbon::parse($datos->fecha_inicio_contrato)) }}
                            </td>
                            <td class="border-top-0 text-muted px-2 py-4 font-14">
                                {{ DateUtil::getFecha($carbon::parse($datos->fecha_fin_contrato)) }}</td>
                            <td class="border-top-0 text-muted px-2 py-4 font-14">
                                @switch($datos->estado_contrato)
                                    @case(config('constants.ESTADO_CONTRATO_INACTIVO'))
                                        <?php $color = 'text-danger'; ?>
                                    @break

                                    @case(config('constants.ESTADO_CONTRATO_ACTIVO'))
                                        <?php $color = 'text-success'; ?>
                                    @break

                                    @case(config('constants.ESTADO_CONTRATO_ESPERA_PAGO'))
                                        <?php $color = 'text-warning'; ?>
                                    @break

                                    @case(config('constants.ESTADO_CONTRATO_FINALIZADO'))
                                        <?php $color = 'text-secondary'; ?>
                                    @break

                                    @default
                                @endswitch

                                <i class="fa fa-circle {{ $color }} font-12" data-toggle="tooltip"
                                    data-placement="top" title="In Testing"></i>
                                <b>{{ ParametroUtil::getParametro($datos->estado_contrato, 'ESTADO_CONTRATO') }}</b>
                            </td>

                            <td class="border-top-0 text-muted px-2 py-4 font-14 text-center">
                                <div class="col text-center">
                                    <div class="ml-auto">
                                        <div class="btn-group mr-4" role="group" aria-label="First group">
                                            <a class="btn btn-outline-danger" target="_blank"
                                                href="{{ $datos->pdf_contrato_ruta_contrato }}"><i
                                                    class="fa fa-download"></i>
                                            </a>
                                            @can('admin.users.index')
                                                <button title="Editar" wire:click='edit({{ $datos->id_contrato }})'
                                                    type="button" class="btn btn-outline-info"><i
                                                        class="ti-pencil"></i></button>
                                                <button wire:click='showPago({{ $datos->id_contrato }})' title="Pagos"
                                                    type="button" class="btn btn-outline-dark"><i
                                                        class="ti-money"></i></button>
                                                <button wire:click='delete({{ $datos->id_contrato }})' title="Eliminar"
                                                    type="button" class="btn btn-outline-secondary"><i
                                                        class="ti-trash"></i></button>
                                            @endcan
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
