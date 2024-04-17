<?php 
        if ($permiso->nombre_tipo_usuario = 'Doctor') {
          
?>
<div class="card-body">
    <div class="card-header">
        <h3>
            Lista de recetas
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
                            Paciente
                        </th>
                        <th class="border-0 font-14 font-weight-medium text-muted px-2">
                            Fecha
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
                                        <img src="images/paciente.png" alt="user" class="rounded-circle"
                                            width="45" height="45" />
                                    </div>
                                    <div class="">
                                        <h5 class="text-dark mb-0 font-16 font-weight-medium">
                                            {{ $datos->dni_paciente }}
                                        </h5>
                                        <span class="text-muted font-14 ">
                                            {{ $datos->nombres_paciente }}
                                            <i class="fa fa-circle font-12 @php if($datos->estado==true)
                                                    {
                                                        echo 'text-success';
                                                    }else{
                                                        
                                                        echo 'text-danger';
                                                    } @endphp "
                                                data-toggle="tooltip" data-placement="top" title="In Testing"></i>
                                        </span>
                                    </div>
                                </div>
                            </td>

                            <td class="border-top-0 text-muted px-2 py-4 font-14">{{ DateUtil::getFechaSimple($datos->fecha_receta)}} - {{DateUtil::getHora($datos->fecha_receta) }}</td>

                            <td class="border-top-0 text-muted px-2 py-4 font-14 text-center">
                                <div class="col text-center">
                                    <div class="ml-auto">
                                        <div class="btn-group mr-4" role="group" aria-label="First group">
                                            <button title="Descargar" wire:click='printReceta({{ $datos->id_receta }})'
                                                type="button" class="btn btn-outline-secondary "><i
                                                    class="ti-download"></i></button>
                                            <button title="Enviar por correo"
                                                wire:click='showModalEmail({{ $datos->id_receta }})' type="button"
                                                class="btn btn-outline-secondary "><i class="ti-email"></i></button>
                                            <button title="Editar" wire:click='edit({{ $datos->id_receta }})'
                                                type="button" class="btn btn-outline-secondary "><i
                                                    class="ti-pencil"></i></button>
                                            <button wire:click='delete({{ $datos->id_receta }})' title="Eliminar"
                                                type="button" class="btn btn-outline-secondary "><i
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
<?php
        }
    ?>
