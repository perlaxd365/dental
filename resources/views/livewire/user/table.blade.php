<div class="card-body">
    <div class="card-header">
        <h3>
            Listado de Usuarios
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
        <table class="table no-wrap v-middle mb-0  table-bordered table-sm table-striped">
            <thead>
                <tr class="border-0">
                    <th class="border-0 font-14 font-weight-medium text-muted">
                        Usuario
                    </th>
                    <th class="border-0 font-14 font-weight-medium text-muted px-2">
                        Email
                    </th>
                    <th class="border-0 font-14 font-weight-medium text-muted px-2">
                        dni
                    </th>
                    <th class="border-0 font-14 font-weight-medium text-muted">
                        Ultima actualización
                    </th>
                    <th class="border-0 font-14 font-weight-medium text-muted">
                        Estado
                    </th>
                    @can('admin.users.index')
                        <th class="border-0 font-14 font-weight-medium text-muted text-center">
                            Acción
                        </th>
                    @endcan
                </tr>
            </thead>
            <tbody>

                @if ($lista->count())
                    @foreach ($lista as $usuario)
                        <tr>
                            <td class="border-top-0 px-2 py-4">
                                <div class="d-flex no-block align-items-center">
                                    <div class="mr-3">
                                        <img src="{{ $usuario->logo_empresa }}" alt="user" class="rounded-circle"
                                            width="45" height="45" />
                                    </div>
                                    <div class="">
                                        <h5 class="text-dark mb-0 font-16 font-weight-medium">
                                            {{ $usuario->name }}
                                        </h5>
                                        <span class="text-muted font-14 ">
                                            {{ $usuario->dni }} <br>
                                            {{ $usuario->razon_social_empresa }}
                                            <i class="fa fa-circle  
                                                @php if($usuario->empresa_estado==true)
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
                                <b>{{ $usuario->nombre_tipo_usuario }}</b>
                            </td>
                            <td class="border-top-0 text-muted px-2 py-4 font-14">{{ $usuario->email }}</td>
                            <td class="border-top-0 text-muted px-2 py-4 font-14">{{ $usuario->updated_at }}</td>
                            <td class="border-top-0 text-center px-2 py-4">
                                <i class="fa fa-circle  
                                @php if($usuario->user_estado==true)
                                    {
                                        echo 'text-success';
                                    }else{
                                        
                                        echo 'text-danger';
                                    } @endphp font-12"
                                    data-toggle="tooltip" data-placement="top" title="In Testing"></i>
                            </td>
                            @can('admin.users.index')
                                <td>
                                    <div class="d-flex align-items-center mb-4 text-center">
                                        <div class="ml-auto">
                                            <div class="btn-group mr-2" role="group" aria-label="First group">
                                                <button title="Editar" type="button" wire:click='edit({{ $usuario->id }})'
                                                    class="btn btn-secondary"><i class="ti-pencil"></i></button>
                                                @if ($usuario->user_estado)
                                                    <button wire:click='delete({{ $usuario->id }})' title="Eliminar"
                                                        type="button" class="btn btn-secondary"><i
                                                            class="ti-trash"></i></button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            @endcan
                        </tr>
                    @endforeach

                    <div class="card-footer text-right">
                        {{ $lista->links() }}
                    </div>
                @else
                    <div class="card-body">
                        <strong>No se encontraron resultados</strong>
                    </div>
                @endif
            </tbody>
        </table>
    </div>
</div>
