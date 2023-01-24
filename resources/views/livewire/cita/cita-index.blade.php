<div>

    <link href="assets/libs/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet" />
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="">
                    <div class="row">

                        <input type="text" hidden id="id_empresa" value="{{ auth()->user()->id_empresa }}">
                        <div wire:ignore class="col-lg-12">
                            <div class="card-body b-l calender-sidebar">
                                <div id="calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  Modal add cita -->
    @include('livewire.cita.modals.modalAdd')

    <!--  Modal edit cita -->
    @include('livewire.cita.modals.modalEdit')

    <!--  Modal add paciente-->
    @include('livewire.cita.modals.modalAddPaciente')
</div>
