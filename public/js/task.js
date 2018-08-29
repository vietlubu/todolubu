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
        $('#calendar').fullCalendar('rerenderEvents');

    });
}

function getFormData() {
    let values = {};
    $.each($('#frm-task').serializeArray(), function(i, field) {
        values[field.name] = field.value;
    });

    return values;

}

function validateForm(values) {
    return (values.name && values.starting_date);
}

function createTask() {
    values = getFormData();

    if(validateForm(values)){
        $.ajax({
            url: "/task/create",
            method: "POST",
            data: values
        }).done(function(data) {
            if (data.status == "success") {
                values['title'] = values['name'];
                values['start'] = values['starting_date'];
                values['end'] = values['ending_date'];

                delete(values['name']);
                delete(values['starting_date']);
                delete(values['ending_date']);

                $('#calendar').fullCalendar('renderEvent', values);

                $('#frm-task').find('input').val('');
                $('#frm-task').find('select').val(1);

            } else {
                alert("Cannot create!");
            }
        }).fail(function(data){
            alert("Cannot create!");
        });

    } else {
        alert("Input your fields");
    }


}