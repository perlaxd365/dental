<?php 
        if ($permiso->nombre_tipo_usuario = 'Doctor') {
          
?>

<div class="card-body">
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
    <div class="card-header">
        <h3>
            Lista de ventas
        </h3>
        <div class="input-group col-md-4">
            <input wire:model='search' type="text" class="form-control" placeholder="Buscar"
                aria-label="Recipient's username" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <i wire:target="search" wire:loading.class="fa fa-spinner fa-spin" aria-hidden="true"></i>
            </div>
        </div>
        <div class="row pt-2">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="start" class="col-sm-12 control-label">Fecha
                        inicio de venta</label>
                    <div class="col-sm-10">
                        <input wire:model="fecha_inicio_venta_search" type="date" class="form-control">
                    </div>
                </div>
            </div>
            <div class="input-group-append col-md-1">
                <i wire:target="fecha_inicio_venta_search" wire:loading.class="fa fa-spinner fa-spin"
                    aria-hidden="true"></i>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label for="start" class="col-sm-12 control-label">Fecha
                        fin de venta</label>
                    <div class="col-sm-10">
                        <input wire:model="fecha_fin_venta_search" type="date" class="form-control">
                    </div>
                </div>
            </div>
            <div class="input-group-append col-md-1">
                <i wire:target="fecha_fin_venta_search" wire:loading.class="fa fa-spinner fa-spin"
                    aria-hidden="true"></i>
            </div>
        </div>
    </div>
    @if ($lista->count())
        <card class="card-body table-responsive">
            <table wire:target="search" class="table no-wrap v-middle mb-0 table-bordered table-sm table-striped">
                <thead>
                    <tr class="border-0">
                        <th class="border-0 font-14 font-weight-medium text-muted">
                            Paciente
                        </th>
                        <th class="border-0 font-14 font-weight-medium text-muted px-2">
                            Productos
                        </th>
                        <th class="border-0 font-14 font-weight-medium text-muted px-2">
                            Fecha de venta
                        </th>
                        <th class="border-0 font-14 font-weight-medium text-muted px-2">
                            Monto Total
                        </th>
                        <th class="border-0 font-14 font-weight-medium text-muted px-2">
                            Monto Abonado
                        </th>
                        <th class="border-0 font-14 font-weight-medium text-muted px-2">
                            Monto Restante
                        </th>
                        <th class="border-0 font-14 font-weight-medium text-muted px-2">
                            Producto entregado
                        </th>
                        <th class="border-0 font-14 font-weight-medium text-muted px-2">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($lista as $venta)
                        <tr>
                            <td class="border-top-0 px-2 py-2">
                                <div class="d-flex no-block align-items-center">
                                    <div class="">
                                        <div class="mr-3">
                                           

                                                @if ($venta->pago_completado_venta)
                                                <i class="fa fa-check text-success"  aria-hidden="true"></i>
                                                @else
                                                <i class="fa fa-clock text-warning"  aria-hidden="true"></i>
                                                @endif

                                        </div>
                                    </div>
                                    <div class="">
                                        <h6>
                                            <span class="text-muted font-1">
                                                {{ $venta->dni_paciente }}
                                                <i class="fa fa-circle font-10 
                                                <?php
                                                if ($venta->pago_completado_venta) {
                                                    echo 'text-success';
                                                } else {
                                                    echo 'text-warning';
                                                }
                                                ?>
                                                "
                                                    data-toggle="tooltip" data-placement="top" title="In Testing"></i>
                                            </span>
                                        </h6>
                                        <h5 class="text-dark mb-0 font-10 font-weight-medium">
                                            {{ $venta->nombres_paciente }}
                                        </h5>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <select class="form-control form-control-sm" style="width: 230px" id="">
                                    @foreach ($this->listaDetalle($venta->id_venta) as $item)
                                        <option value="" selected>{{ $item->nombre_detalle }} (S/
                                            {{ $item->precio_unitario_detalle }} x {{ $item->cantidad_detalle }}) = S/
                                            {{ $item->precio_total_detalle }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                {{ DateUtil::getFechaSimple($venta->fecha_venta) }} -
                                {{ DateUtil::getHora($venta->fecha_venta) }}
                            </td>
                            <td>
                                S/ {{ $venta->total_venta }}
                            </td>
                            <td>
                                S/ {{ $venta->monto_abonado_venta }}
                            </td>
                            <td>
                                S/ {{ $venta->monto_restante_venta }}
                            </td>
                            <td>
                                @if ($venta->producto_entregado_venta)
                                    <span class="badge badge-pill badge-success"><b>Entregado</b></span>
                                @else
                                    <span class="badge badge-pill badge-warning"><b>A la espera</b></span>
                                @endif
                            </td>

                            <td class="text-center">
                                <button wire:click='open_modal_pago({{ $venta->id_venta }})'
                                    class="btn btn-outline-secondary btn-sm rounded-circle" title="Agregar pago">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </button>
                                <button wire:click='open_modal_saldo({{ $venta->id_venta }})'
                                    class="btn btn-outline-secondary btn-sm rounded-circle">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach

                    <div class="card-footer text-right">
                        {{ $lista->links() }}
                    </div>
                </tbody>
            </table>
        </card>
    @else
        <div class="card-body">
            <strong>No se encontraron resultados</strong>
        </div>
    @endif


    @include('livewire.saldo.modals.modal-saldo')
    @include('livewire.saldo.modals.modal-pago')
</div>

<?php
        }
    ?>
