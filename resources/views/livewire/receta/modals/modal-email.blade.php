<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

<div wire:ignore.self class="modal fade" id="modalEmail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Enviar receta por Correo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <div class="alert alert-warning" role="alert">
                           <i class="fa fa-info-circle"></i> Por favor verificar el correo para enviar la receta 
                        </div>
                        <label for="inputZip3">Email</label>
                        <input wire:model="correo_receta_send" type="text" class="form-control" id="inputZip3"
                            placeholder="Ingresar email">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="form-actions">
                    <div class="text-right">
                        <button wire:click="sendEmailReceta" wire:loading.attr="disabled" class="btn btn-primary"
                            type="button"> <i class="fa fa-paper-plane" aria-hidden="true"></i><i wire:target="sendEmailReceta"
                                wire:loading.class="fa fa-spinner fa-spin" aria-hidden="true">
                            </i>
                            Enviar receta</button>
                        <button wire:click="closeModalEmail" wire:loading.attr="disabled" class="btn btn-secondary"
                            type="button"> <i wire:target="closeModalEmail" wire:loading.class="fa fa-spinner fa-spin"
                                aria-hidden="true"></i>Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.addEventListener('close-modal-email', event => {
        $('#modalEmail').modal('hide');

    });

    window.addEventListener('open-modal-email', event => {
        $('#modalEmail').modal('show');

    });
</script>
