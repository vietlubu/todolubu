function loadCalendar() {
    $.ajax({
        url: "/task",
    }).done(function(data) {

        for(var index in data) {
            data[index]['title'] = data[index]['name'];
            data[index]['start'] = data[index]['starting_date'];
            data[index]['end'] = data[index]['ending_date'];

            delete(data[index]['name']);
            delete(data[index]['starting_date']);
            delete(data[index]['ending_date']);
        }

        console.log(data);


        $('#calendar').fullCalendar('removeEvents');
        $('#calendar').fullCalendar('addEventSource', data);
        $('#calendar').fullCalendar('rerenderEvents' );

    });
}