<div>
    <div class="row">
        <div class="col-12">
            <div class="card">

                @include('livewire.producto-lab.' . $view)
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                @if ($table)
                    @include('livewire.producto-lab.table')
                @endif
            </div>
        </div>
    </div>

</div>
