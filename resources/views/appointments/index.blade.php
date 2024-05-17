@extends('layouts.app')

@section('content')

    <!-- Encabezado -->
    <x-slot name="header">
        <div class="container-fluid bg-light py-3">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col">
                        <h2 class="font-weight-bold text-dark">Citas</h2>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <!-- Contenido del calendario -->
    <div class="container my-4">
        <div id='calendar'></div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
    

    <script>

        
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: [
                    @foreach ($appointments as $appointment)
                        {
                            id: {{ $appointment->id }},
                            title: 'Pedir {{ $appointment->unidades_comprar }} x {{ $appointment->product->name }}',
                            start: '{{ $appointment->fecha_pedido }}',
                            // Puedes agregar más propiedades de eventos según tus necesidades
                        },
                    @endforeach
                ],
                dateClick: function(info) {
                    var today = new Date();
                    var fechaSeleccionada = new Date(info.dateStr);
                  

                    if (fechaSeleccionada < today) {
                        alert('No puedes seleccionar fechas pasadas.');
                    } else {
                        window.location.href = '{{ route("appointments.create") }}?fecha_pedido=' + info.dateStr;
                    }
                },
                eventClick: function(info) {
                    var eventId = info.event.id;
                    var fechaSeleccionada = info.event.startStr;
                    var eventData = info.event.extendedProps;
                    var eventDataJSON = JSON.stringify(eventData);
                    window.location.href = '{{ route("appointments.edit", ["appointment" => ":eventId"]) }}'.replace(':eventId', eventId) + '?fecha_pedido=' + fechaSeleccionada + '&eventData=' + encodeURIComponent(eventDataJSON);
                }
            });
            calendar.render();
        });
    </script>

@endsection
