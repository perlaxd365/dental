<div class="card-body">
    <div class="card-header">
        <h3>
            Listado de Empresas
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
        <table class="table no-wrap v-middle mb-0">
            <thead>
                <tr class="border-0">
                    <th class="border-0 font-14 font-weight-medium text-muted">
                        Empresa
                    </th>
                    <th class="border-0 font-14 font-weight-medium text-muted px-2">
                        Ruc
                    </th>
                    <th class="border-0 font-14 font-weight-medium text-muted px-2">
                        SOAP
                    </th>
                    <th class="border-0 font-14 font-weight-medium text-muted">
                        Ultima actualización
                    </th>
                    <th class="border-0 font-14 font-weight-medium text-muted">
                        Estado
                    </th>
                    <th class="border-0 font-14 font-weight-medium text-muted text-center">
                        Acción
                    </th>
                </tr>
            </thead>
            <tbody>

                @if ($lista_empresas->count())
                    @foreach ($lista_empresas as $empresa)
                        <tr>
                            <td class="border-top-0 px-2 py-4">
                                <div class="d-flex no-block align-items-center">
                                    <div class="mr-3">
                                        <img src="{{ asset( $empresa->logo_empresa) }}" alt="user" class="rounded-circle"
                                            width="45" height="45" />
                                    </div>
                                    <div class="">
                                        <h5 class="text-dark mb-0 font-16 font-weight-medium">
                                            {{ $empresa->nombre_comercial_empresa }}
                                        </h5>
                                        <span class="text-muted font-14">
                                            {{ $empresa->razon_social_empresa }}
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td class="border-top-0 text-muted px-2 py-4 font-14">{{ $empresa->ruc_empresa }}</td>
                            <td class="border-top-0 text-muted px-2 py-4 font-14">{{ $empresa->tipo_soap_empresa }}</td>
                            <td class="border-top-0 text-muted px-2 py-4 font-14">{{ $empresa->updated_at }}</td>
                            <td class="border-top-0 text-center px-2 py-4">
                                <i class="fa fa-circle  
                                @php if($empresa->estado==true)
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
                                            <button title="Editar" type="button"
                                                wire:click='edit({{ $empresa->id_empresa }})'
                                                class="btn btn-secondary"><i class="ti-pencil"></i></button>
                                            @if ($empresa->estado)
                                                <button wire:click='eliminar({{ $empresa->id_empresa }})'
                                                    title="Eliminar" type="button" class="btn btn-secondary"><i
                                                        class="ti-trash"></i></button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    <div class="card-footer mx-auto">
                        {{ $lista_empresas->links() }}
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
