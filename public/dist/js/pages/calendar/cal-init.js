! function ($) {

    var CalendarApp = function () {
        this.$body = $("body")
        this.$calendar = $('#calendar'),
            this.$event = ('#calendar-events div.calendar-events'),
            this.$categoryForm = $('#add-new-event form'),
            this.$extEvents = $('#calendar-events'),
            this.$modal = $('#my-event'),
            this.$saveCategoryBtn = $('.save-category'),
            this.$calendarObj = null
    };


    /* on drop */
    CalendarApp.prototype.onDrop = function (eventObj, date) {
        var $this = this;
        // retrieve the dropped element's stored Event Object
        var originalEventObject = eventObj.data('eventObject');
        var $categoryClass = eventObj.attr('data-class');
        // we need to copy it, so that multiple events don't have a reference to the same object
        var copiedEventObject = $.extend({}, originalEventObject);
        // assign it the date that was reported
        copiedEventObject.start = date;
        if ($categoryClass)
            copiedEventObject['className'] = [$categoryClass];
        // render the event on the calendar
        $this.$calendar.fullCalendar('renderEvent', copiedEventObject, true);
        // is the "remove after drop" checkbox checked?
        if ($('#drop-remove').is(':checked')) {
            // if so, remove the element from the "Draggable Events" list
            eventObj.remove();
        }
    },
        CalendarApp.prototype.enableDrag = function () {
            //init events
            
        }
    /* Initializing */
    CalendarApp.prototype.init = function () {
        this.enableDrag();
        /*  Initialize the calendar  */
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
        var form = '';
        var today = new Date($.now());


        var $this = this;
        let id_empresa = $("#id_empresa").val();
        $this.$calendarObj = $this.$calendar.fullCalendar({
            slotDuration: '01:00:00',
            /* If we want to split day time each 15minutes */
            minTime: '08:00:00',
            maxTime: '25:00:00',
            defaultView: 'month',
            handleWindowResize: true,

            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            locale: 'es',
            events: "/calendar/" + id_empresa,
            data: {
                title: title,
                start: start,
                end: end,
                type: 'add'
            },
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar !!!
            eventLimit: true, // allow "more" link when too many events
            selectable: true,
            drop: function (date) { $this.onDrop($(this), date); },
            select: function (start, end, allDay) { $this.onSelect(start, end, allDay); },
            eventClick: function (calEvent, jsEvent, view) { $this.onEventClick(calEvent, jsEvent, view); }
            ,
            select: function (start, end) {

                $('.select2').val(null).trigger('change.select2');
                $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
                $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
                $('#ModalAdd').modal('show');
            },
            eventRender: function (event, element) {
                element.bind('click', function () {

                    $('#ModalEdit').modal('show');

                    var formData = new FormData();
                    //formData.append("dato", "valor");
                    formData.append("id_cita", event.id);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: "listCita",
                        type: "post",
                        dataType: "json",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        beforeSend: function (data) {

                        },
                        success: function (data) {
                            $('#ModalEdit #nombre_paciente').html(data[0]["nombres_paciente"]);
                            $('#ModalEdit #id').val(data[0]["id_cita"]);
                            $('#ModalEdit #title_update').val(data[0]["motivo_cita"]);
                            $('#ModalEdit #color_update').val(data[0]["color_cita"]);
                            $('#ModalEdit #descripcion_cita_update').val(data[0]["descripcion_cita"]);
                            $('#ModalEdit #fecha_inicio_cita_update').val(data[0]["fecha_inicio_cita"]);
                            $('#ModalEdit #fecha_fin_cita_update').val(data[0]["fecha_fin_cita"]);
                        }
                    })

                });
            },
            eventDrop: function (event, delta, revertFunc) { // si changement de position

                edit(event);

            },
            eventResize: function (event, dayDelta, minuteDelta, revertFunc) { // si changement de longueur

                edit(event);

            },
        });

    },

        //init CalendarApp
        $.CalendarApp = new CalendarApp, $.CalendarApp.Constructor = CalendarApp

}(window.jQuery),
    function edit(event) {
        start = event.start.format('YYYY-MM-DD HH:mm:ss');
        if (event.end) {
            end = event.end.format('YYYY-MM-DD HH:mm:ss');
        } else {
            end = start;
        }

        id = event.id;

        Event = [];
        Event[0] = id;
        Event[1] = start;
        Event[2] = end;

        $.ajax({
            url: 'editEventDate.php',
            type: "POST",
            data: { Event: Event },
            success: function (rep) {
                if (rep == 'OK') {
                    alert('Evento se ha guardado correctamente');
                } else {
                    alert('No se pudo guardar. Inténtalo de nuevo.');
                }
            }
        });
    }

//initializing CalendarApp
$(window).on('load', function () {

    $.CalendarApp.init()
});