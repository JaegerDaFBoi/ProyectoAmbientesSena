<div>
    <div wire:ignore>
        <div id="fichaCalendar">

        </div>
    </div>
</div>

@push('js')
    <script>
        document.addEventListener('livewire:load', function() {
            var now = moment();
            var data = @this.events;
            var calendarEl = document.getElementById('fichaCalendar');
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
                events: JSON.parse(data)
            });
            calendar.render();
        });
    </script>
@endpush
