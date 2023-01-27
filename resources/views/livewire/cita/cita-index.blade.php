<div>
    <style>
        @media print {
            .visible-print {
                display: inherit !important;
            }

            .hidden-print {
                display: none !important;
            }
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="">
                    <div class="row">

                        <input type="text" hidden id="id_empresa" value="{{ auth()->user()->id_empresa }}">
                        <div wire:ignore class="col-lg-12">
                            <div class="card-body b-l calender-sidebar">
                                <button class="printBtn hidden-print float-center mb-12 btn btn-outline-danger"><i class="fa fa-print"></i> Print</button>
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
