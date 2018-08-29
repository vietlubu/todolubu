<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css">
    <link rel="stylesheet" media='print' href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.print.css">


    <title>Todolubu</title>
</head>
<body>
    <div class="container">
        <h1>Todolubu</h1>
        <div id="task" class="col-md-4">
            <form class="form-horizontal" name="task" id="frm-task">
                <div class="form-group">
                    <input type="text" class="form-control" id="name" placeholder="Task" name="name" required>
                </div>
                <div class="form-group">
                    <input type="datetime" class="form-control datepicker" id="starting_date" name="starting_date" placeholder="Starting date" required>
                </div>
                <div class="form-group">
                    <input type="datetime" class="form-control datepicker" id="ending_date" name="ending_date" placeholder="Ending date">
                </div>
                <div class="form-group">
                    <select name="status" id="status" class="form-control">
                        <option value="1">Planning</option>
                        <option value="2">Doing</option>
                        <option value="3">Complete</option>
                    </select>
                </div>
                <div class="form-group">
                    <button id="btn-add" type="button" class="btn btn-primary">Add task</button>
                    <button id="btn-update" type="button" class="btn btn-warning" style="display: none;">Update task</button>
                    <button id="btn-delete" type="button" class="btn btn-danger" style="display: none;">Delete task</button>
                    <button id="btn-addnew" type="button" class="btn" style="display: none;">Add new</button>
                </div>
            </form>
        </div>

        <div id="calendar" class="col-md-8" ></div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
    <script src="/js/task.js"></script>

    <script>
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd'
        });

        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,basicWeek,basicDay'
            },
            navLinks: true, // can click day/week names to navigate views
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            events: [],
            eventClick: function(calEvent, jsEvent, view) {
                reloadForm(calEvent);
            },
            eventDrop: function(event, delta, revertFunc, jsEvent, ui, view) {
                reloadForm(event);
                updateTask();
            }
        });

        loadCalendar();

        $('#btn-add').on('click', function (e) {
            createTask();
        });

        $('#btn-update').on('click', function (e) {
            updateTask();
        });

        $('#btn-delete').on('click', function (e) {
            deleteTask();
        });

        $('#btn-addnew').on('click', function (e) {
            $('#frm-task').find('input').val('');
            $('#frm-task').find('select').val(1);
            $('#btn-add').show();
            $('#btn-update').hide();
            $('#btn-delete').hide();
            $(this).hide();
            $('#name').focus();
        });

    </script>


</body>
</html>