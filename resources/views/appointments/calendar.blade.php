<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario</title>
    <link href="{{ asset('fullcalendar/main.css') }}" rel="stylesheet">
    <script src="{{ asset('fullcalendar/main.js') }}"></script>
</head>
<body>
    <div id="calendar"></div>
    <a href="{{ route('appointments.create') }}" class="btn btn-primary">Agregar Cita</a>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: "{{ route('appointments.index') }}"
            });
            calendar.render();
        });
    </script>
</body>
</html>