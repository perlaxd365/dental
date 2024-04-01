<div>
    <div class="row">
        <div class="col-12">
            <div class="card">

                @include('livewire.paciente.' . $view)
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                @if ($table)
                    @include('livewire.paciente.table')
                @endif
            </div>
        </div>
    </div>

</div>
