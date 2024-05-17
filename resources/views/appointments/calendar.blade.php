<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario</title>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>

    <!-- FullCalendar JavaScript -->
    <script src="{{ asset('fullcalendar/main.js') }}"></script>
</head>
<body>
    <!-- Contenedor del calendario -->
    <div class="container my-4">
        <div id="calendar"></div>
    </div>

    <!-- Botón para agregar cita -->
    <div class="container mb-4">
        <a href="{{ route('appointments.create') }}" class="btn btn-primary">Agregar Cita</a>
    </div>

    <!-- FullCalendar JavaScript -->
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

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
