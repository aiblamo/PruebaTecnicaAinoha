/* document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    
    
    
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: [
            // Aquí usamos JavaScript para generar dinámicamente el array de eventos
            @json($appointments)
                .map(appointment => ({
                    id: appointment.id,
                    title: `Pedir ${appointment.unidades_comprar} x ${appointment.product.name}`,
                    start: appointment.fecha_pedido,
                    // Puedes agregar más propiedades de eventos según tus necesidades
                }))
        ],
        dateClick: function(info) {
            // Obtener la fecha seleccionada en formato ISO
            var fechaSeleccionada = info.dateStr;
            console.log('Fecha seleccionada:', fechaSeleccionada); // Imprimir la fecha seleccionada en la consola

            // Redirigir a la página de creación con la fecha como parámetro
            window.location.href = '{{ route("appointments.create") }}?fecha_pedido=' + fechaSeleccionada;
        },
        eventClick: function(info) {
            var eventId = info.event.id;

            // Obtener la fecha seleccionada en formato ISO
            var fechaSeleccionada = info.event.startStr;

            // Obtener todos los datos del evento
            var eventData = info.event.extendedProps;

            // Convertir el objeto de evento en formato JSON
            var eventDataJSON = JSON.stringify(eventData);

            // Redireccionar a la URL del evento al hacer clic en él y pasar los datos como parámetro
            window.location.href = '{{ route("appointments.edit", ["appointment" => ":eventId"]) }}'.replace(':eventId', eventId) + '?fecha_pedido=' + fechaSeleccionada + '&eventData=' + encodeURIComponent(eventDataJSON);
        }
    });
    calendar.render();
});
 */
