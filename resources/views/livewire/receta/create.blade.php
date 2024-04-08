<div class="card-body">
    <h4 class="card-title">Agregar Receta</h4>
    <br>
    <div class="form-body">
        <div class="form-row">
            <div class="col-md-12 mb-3">
                <label for="validationDefault01">
                    Seleccionar paciente&nbsp;
                    <a data-toggle="modal" data-target=".bd-example-modal-lg" href="javascript:void(0)">[Agregar]</a>
                </label>
                <br>
                <div wire:ignore>
                    <select wire:model="id_paciente" name="id_paciente" class="form-control select2" id="select2">
                        <option value="">Seleccionar</option>
                        @foreach ($pacientes as $paciente)
                            <option value="{{ $paciente->id_paciente }}">{{ $paciente->nombres_paciente }}</option>
                        @endforeach
                    </select>
                </div>
                @error('id_paciente')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-3 mb-3">
                <label for="validationDefault01">Dip Lejos</label>
                <input wire:model='dip_lejos_rec' type="text" class="form-control" placeholder="0.00 mm">
                @error('dip_lejos_rec')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-3 mb-3">
                <label for="validationDefault01">Dip Cerca</label>
                <input wire:model='dip_cerca_rec' type="text" class="form-control" placeholder="0.00 mm">
                @error('dip_cerca_rec')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-3  mb-3">
                <label for="validationDefault01">Naso Pupilar</label>
                <input wire:model='naso_pupilar_od_rec' type="text" class="form-control"
                    placeholder="Ingresar Naso Pupilar">
                @error('naso_pupilar_od_rec')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-3  mb-3">
                <label for="validationDefault01">OI</label>
                <input wire:model='oi_rec' type="text" class="form-control" placeholder="Ingresar OI">
                @error('oi_rec')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-12">
                <label for="fecha-registro">
                    <b>Diagnóstico</b>
                </label>
                <br>
                <br>
                <div class="form-check form-check-inline col-md-2">
                </div>
                <div class="form-check form-check-inline col-md-2">
                    <label for="fecha-registro">
                        Astigmatismo
                    </label>&nbsp;
                    <label class="switch" style="size: 4cm">
                        <input wire:model="astigmatismo_rec" type="checkbox" checked>
                        <span class="slider round"></span>
                    </label>

                    @error('astigmatismo_rec')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-check form-check-inline col-md-2">
                    <label for="fecha-registro">
                        Hipermetropía
                    </label>&nbsp;
                    <label class="switch" style="size: 4cm">
                        <input wire:model="hipermetropia_rec" type="checkbox" checked>
                        <span class="slider round"></span>
                    </label>
                    @error('hipermetropia_rec')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-check form-check-inline col-md-2">
                    <label for="fecha-registro">
                        Miopía
                    </label>&nbsp;
                    <label class="switch" style="size: 4cm">
                        <input wire:model="miopia_rec" type="checkbox" checked>
                        <span class="slider round"></span>
                    </label>
                    @error('miopia_rec')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-check form-check-inline col-md-2">
                    <label for="fecha-registro">
                        Presbicia
                    </label>&nbsp;
                    <label class="switch" style="size: 4cm">
                        <input wire:model="presbicia_rec" type="checkbox" checked>
                        <span class="slider round"></span>
                    </label>

                    @error('presbicia_rec')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <br>
                <label for="fecha-registro">
                    <b>Recomendación</b>
                </label>
                <br>
                <textarea wire:model='recomendacion_rec' type="text" rows="4" class="form-control" placeholder="Ingresar recomendación"></textarea>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <br>
                <label for="fecha-registro">
                    <b> Ingresar Medidas</b>
                </label>
                <br>
                <table class="table table-responsive">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Esfera</th>
                            <th scope="col">Cilindro</th>
                            <th scope="col">Eje</th>
                            <th scope="col">Adición</th>
                            <th scope="col">Agudeza Visual</th>
                            <th scope="col">DP</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Ojo Derecho</th>
                            <td colspan="1"><input wire:model='esfera_derecho' type="text" class="form-control"
                                    placeholder="0.00">
                                    @error('esfera_derecho')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </td>
                            <td colspan="1"><input wire:model='cilindro_derecho' type="text"
                                    class="form-control" placeholder="0.00">
                                    @error('cilindro_derecho')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </td>
                            <td colspan="1"><input wire:model='eje_derecho' type="text"
                                    class="form-control col-md-12" placeholder="0.00">
                                    @error('eje_derecho')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </td>
                            <td ROWSPAN=2>
                                <textarea rows="4" wire:model='adicion_rec' type="text" class="form-control" placeholder="0.00"></textarea>
                            </td>
                            <td colspan="1"><input wire:model='agudeza_visual_derecho' type="text"
                                    class="form-control" placeholder="0.00"></td>
                            <td colspan="1"><input wire:model='dp_derecho' type="text"
                                    class="form-control  col-md-12" placeholder="0.00">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Ojo Izquierdo</th>
                            <td><input wire:model='esfera_izquierdo' type="text" class="form-control"
                                    placeholder="0.00">
                                    @error('esfera_izquierdo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </td>
                            <td><input wire:model='cilindro_izquierdo' type="text" class="form-control"
                                    placeholder="0.00">
                                    @error('cilindro_izquierdo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                            <td><input wire:model='eje_izquierdo' type="text" class="form-control"
                                    placeholder="0.00">
                                    @error('eje_izquierdo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </td>
                            <td><input wire:model='agudeza_visual_izquierdo' type="text" class="form-control"
                                    placeholder="0.00"></td>
                            <td><input wire:model='dp_izquierdo' type="text" class="form-control col-md-12"
                                    placeholder="0.00">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">ADD Cerca:</th>
                            <td COLSPAN=2><input wire:model='add_cerca_rec' type="text" class="form-control"
                                    placeholder="+ 0.00">
                            </td>
                            <th scope="row">ADD Itermedia</th>
                            <td COLSPAN=2><input wire:model='add_intermedio_rec' type="text" class="form-control"
                                    placeholder="+ 0.00">
                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr>
            </div>
        </div>
    </div>
    <br>
    <div class="form-actions">
        <div class="text-right">
            <button wire:click="agregar" wire:loading.attr="disabled" class="btn btn-primary" type="button"> <i
                    class="fa fa-plus-circle"></i> <i wire:target="agregar"
                    wire:loading.class="fa fa-spinner fa-spin" aria-hidden="true"></i> Agregar receta</button>

            <button wire:click="default" wire:loading.attr="disabled" class="btn btn-secondary" type="button"> <i
                    wire:target="default" wire:loading.class="fa fa-spinner fa-spin"
                    aria-hidden="true"></i>Limpiar</button>

        </div>
    </div>

    <script>
        window.addEventListener('livewire:load', event => {
            $(".select2").select2({
                width: '360px',
                height: '60px',
                class: 'form-control'
            });

            $(".select2").on('change', function() {
                @this.set('id_paciente', this.value);
            });
        })
        window.addEventListener('data', event => {

            var newOption = new Option(event.detail.nombres_paciente, event.detail.id_paciente, true, true);


            $('.select2').append(newOption).trigger('change'); //until this point, everything works

            @this.set('id_paciente', event.detail.id_paciente);


        })
        
    </script>
</div>
