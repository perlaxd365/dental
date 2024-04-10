<?php 
        if ($permiso->nombre_tipo_usuario = 'Doctor') {
          
?>
<div class="card-body">
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
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($lista as $venta)
                        <tr>
                            <td class="border-top-0 px-2 py-2">
                                <div class="d-flex no-block align-items-center">
                                    <div class="mr-3">
                                        <i  class="fa fa-shopping-cart"></i>
                                    </div>
                                    <div class="">
                                        <h5 class="text-dark mb-0 font-12 font-weight-medium">
                                            {{$venta->dni_paciente}}
                                        </h5>
                                        <span class="text-muted font-1">
                                            {{$venta->nombres_paciente}}
                                            <i class="fa fa-circle font-12 text-success" data-toggle="tooltip"
                                                data-placement="top" title="In Testing"></i>
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <select class="form-control form-control-sm"  id="">
                                    @foreach ($this->listaDetalle($venta->id_venta) as $item)
                                        <option value="" selected>{{$item->nombre_detalle}} (S/ {{$item->precio_unitario_detalle}} x {{$item->cantidad_detalle}}) = S/ {{$item->precio_total_detalle}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>{{DateUtil::getFecha($venta->created_at)}} - {{DateUtil::getHora($venta->created_at)}}</td>
                            <td class="text-center">
                                <button  wire:click='delete_venta({{$item->id_venta}})'
                                class="btn btn-outline-secondary btn-sm rounded-circle">
                                <i class="fa fa-times" aria-hidden="true"></i></button></td>
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
</div>
<?php
        }
    ?>
