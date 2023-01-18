<div>
    <div class="row">
        <div class="col-12">
            <div class="card">

                @include('livewire.empresa.' . $view)
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                @if ($table)
                    @include('livewire.empresa.table')
                @endif
            </div>
        </div>
    </div>

</div>
