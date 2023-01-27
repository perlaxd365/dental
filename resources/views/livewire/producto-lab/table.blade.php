@can('admin.users.index')
    <div class="card-body">
        <div class="card-header">
            <h3>
                Productos de laboratorio
            </h3>
            <div class="input-group col-4">
                <input wire:model='search' type="text" class="form-control" placeholder="Buscar"
                    aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <i wire:target="search" wire:loading.class="fa fa-spinner fa-spin" aria-hidden="true"></i>
                </div>
            </div>
        </div>
        
        @if ($lista->count())
        <div wire:target="search" class="table-responsive">
            <table class="table no-wrap v-middle mb-0">
                <thead>
                    <tr class="border-0">
                        <th class="border-0 font-14 font-weight-medium text-muted">
                            Empresa
                        </th>
                        <th class="border-0 font-14 font-weight-medium text-muted px-2">
                            Producto
                        </th>
                        <th class="border-0 font-14 font-weight-medium text-muted px-2">
                            Estado
                        </th>
                    </tr>
                </thead>
                <tbody>

                        @foreach ($lista as $productos)
                            <tr>
                                <td class="border-top-0 px-2 py-4">
                                    <div class="d-flex no-block align-items-center">
                                        <div class="mr-3">
                                            <img src="{{ $productos->logo_empresa }}" alt="user" class="rounded-circle"
                                                width="45" height="45" />
                                        </div>
                                        <div class="">
                                            <h5 class="text-dark mb-0 font-16 font-weight-medium">
                                                {{ $productos->nombre_comercial_empresa }}
                                            </h5>
                                            <span class="text-muted font-14 ">
                                                {{ $productos->razon_social_empresa }}
                                                <i class="fa fa-circle  
                                                @php if($productos->estado==true)
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
                                
                                <td class="border-top-0 text-muted px-2 py-4 font-14">{{ $productos->nombre_producto_lab }}</td>
                               
                                <td class="border-top-0 text-center px-2 py-4">
                                    <i class="fa fa-circle  
                                @php if($productos->estado_producto_lab==true)
                                    {
                                        echo 'text-success';
                                    }else{
                                        
                                        echo 'text-danger';
                                    } @endphp font-12"
                                        data-toggle="tooltip" data-placement="top" title="In Testing"></i>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center mb-4 text-center">
                                        <div class="ml-auto">
                                            <div class="btn-group mr-2" role="group" aria-label="First group">
                                                <button title="Editar" type="button" wire:click='edit({{ $productos->id_producto_lab }})'
                                                    class="btn btn-secondary"><i class="ti-pencil"></i></button>
                                                @if ($productos->estado_producto_lab)
                                                    <button wire:click='delete({{ $productos->id_producto_lab }})' title="Eliminar"
                                                        type="button" class="btn btn-secondary"><i
                                                            class="ti-trash"></i></button>
                                                @endif
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
    </div>
@endcan
