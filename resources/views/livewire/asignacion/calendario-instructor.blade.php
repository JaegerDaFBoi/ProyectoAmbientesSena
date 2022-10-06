<div>
    <div wire:ignore>
        <div id="instructorCalendar">

        </div>
        <x-adminlte-modal id="modalMin" title="Información del evento" icon="fas fa-calendar-check" theme="orange">
            <div class="row">
                <div class="col-md-12">
                    <p><strong>Fecha del evento: </strong><span id="fechaevento"></span></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Hora de inicio</strong></p>
                    <p><span id="inicioevento"></span></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Hora de fin</strong></p>
                    <p><span id="finevento"></span></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p><strong>Ficha de formación # </strong><span id="fichaevento"></span></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p><strong>Programa de formación: </strong><span id="programaevento"></span></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p><strong>Instructor asignado: </strong><span id="instructorevento"></span></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p><strong>Ambiente asignado: </strong><span id="ambienteevento"></span></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p><strong>Competencia a desarrollar</strong></p>
                    <p><span id="competenciaevento"></span></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p><strong>Resultado de aprendizaje</strong></p>
                    <p><span id="resultadoevento"></span></p>
                </div>
            </div>
        </x-adminlte-modal>
    </div>

</div>

@push('js')
    <script>
        document.addEventListener('livewire:load', function() {
            var now = moment();
            var data = @this.events;
            var calendarEl = document.getElementById('instructorCalendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'es',
                headerToolbar: {
                    left: 'prev,next,today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,dayGridDay'
                },
                buttonText: {
                    today: 'Hoy',
                    month: 'Mes',
                    week: 'Semana',
                    day: 'Dia'
                },
                navLinks: true,
                events: JSON.parse(data),
                eventClick: function(info) {
                    let event = info.event.id;
                    var ruta = "/instructores/" + event + "/evento";
                    $.ajax({
                        url: ruta,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            console.log(data);
                            $('#modalMin').modal('show');
                            $('#fichaevento').text(data.ficha);
                            $('#programaevento').text(data.programa);
                            $('#instructorevento').text(data.instructor);
                            $('#competenciaevento').text(data.competencia);
                            $('#resultadoevento').text(data.resultado);
                            $('#ambienteevento').text(data.ambiente);
                            $('#inicioevento').text(data.inicioevento);
                            $('#finevento').text(data.finevento);
                            $('#fechaevento').text(data.fecha);
                        },
                        error: function(data) {
                            console.log(data)
                        }
                    });
                }
            });
            calendar.render();
        });
    </script>
@endpush
