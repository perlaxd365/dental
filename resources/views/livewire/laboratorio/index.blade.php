<div>
    <div class="row">
        <div class="col-12">
            <div class="card">

                @include('livewire.laboratorio.' . $view)
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                @if ($table)
                    @include('livewire.laboratorio.table')
                @endif
            </div>
        </div>
    </div>

    <!--  Modal add paciente-->
    @include('livewire.cita.modals.modalAddPaciente')
</div>
