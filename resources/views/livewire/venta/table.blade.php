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

</div>
<?php
        }
    ?>
