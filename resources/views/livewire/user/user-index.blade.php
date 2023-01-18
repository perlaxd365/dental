<div>
    <div class="row">
        <div class="col-12">
            <div class="card">

                @include('livewire.user.' . $view)
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                @if ($table)
                    @include('livewire.user.table')
                @endif
            </div>
        </div>
    </div>

</div>
