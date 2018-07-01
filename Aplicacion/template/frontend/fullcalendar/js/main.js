
$(function(){

    var base_url='http://localhost/MEPPP/Aplicacion/'; // Here i define the base_url

    // Fullcalendar
    $('#calendar').fullCalendar({
            monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
            dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
            dayNamesShort: ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'],

            header: {
            left: 'prev, next, today',
            center: 'title',
            right: 'month, basicDay'
        },
        // Get all events stored in database
        eventLimit: true, // allow "more" link when too many events
        ignoreTimezone: false,
        events: base_url+'Campania/getEvents',
        selectable: true,
        allDay:true,
        selectHelper: true,
        editable: false, // Make the event resizable true        
        
           eventClick: function(calEvent, jsEvent, view) {

            currentEvent = calEvent;
            
            $("#titleModal").text(calEvent.title);
            $("#publico").text("Público: "+calEvent.publico);
            $("#lugar").text("Lugar: "+calEvent.lugar);
            $("#hora").text("Hora: "+calEvent.hora);
        
            //var evento = load(base_url+'Campania/getEvent');
            //alert("hola "+evento);
            modal.open();

        },   

    });

});
