// Action functions

function loadCalendar() {
    $.ajax({
        url: "/task",
    }).done(function(data) {

        for(var index in data) {
            data[index]['title'] = data[index]['name'];
            data[index]['start'] = data[index]['starting_date'];
            data[index]['end'] = data[index]['ending_date'];
            data[index]['backgroundColor'] = getBackgoundColor(data[index]['status']);

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

function createTask() {
    values = getFormData();

    if(validateForm(values)){
        $.ajax({
            url: "/task/create",
            method: "POST",
            data: values
        }).done(function(data) {
            if (data.status == "success") {
                addEvent(values);
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


function updateTask() {
    values = getFormData();

    if(validateForm(values)){
        $.ajax({
            url: "/task/update",
            method: "POST",
            data: values
        }).done(function(data) {
            if (data.status == "success") {
                addEvent(values);
            } else {
                alert("Cannot update!");
            }
        }).fail(function(data){
            alert("Cannot update!");
        });

    } else {
        alert("Input your fields");
    }

}




// Common function
function addEvent(values) {
    values['title'] = values['name'];
    values['start'] = values['starting_date'];
    values['end'] = values['ending_date'];
    values['backgroundColor'] = getBackgoundColor(values['status']);

    delete(values['name']);
    delete(values['starting_date']);
    delete(values['ending_date']);

    if (values.id) {
        $("#calendar").fullCalendar('removeEvents', values.id);
    } else {
        $('#frm-task').find('input').val('');
        $('#frm-task').find('select').val(1);
    }
    $('#calendar').fullCalendar('renderEvent', values);
}

function reloadForm(event) {
    // Load input fields
    $('#frm-task').find('input[name="name"]').val(event.title);

    start = moment(event.start).format("YYYY-MM-DD").toString();
    if (start != "Invalid date") {
        $('#frm-task').find('input[name="starting_date"]').val(start);
    }

    end = moment(event.end).format("YYYY-MM-DD").toString();
    if (end != "Invalid date") {
        $('#frm-task').find('input[name="ending_date"]').val(end);
    }

    $('#frm-task').find('input[name="status"]').val(event.status);

    // Enable Update button
    $('#btn-add').hide();
    $('#btn-update').show();
    $('#btn-addnew').show();

    // Add input id hidden
    $('input[name="id"').remove();
    $('#frm-task').append('<input type="hidden" name="id" value="' + event.id + '">');
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

function getBackgoundColor(status) {
    if (status == 2) {
        return "#ffbe76";
    }
    if (status == 3) {
        return "#badc58";
    }
    return "";
}
