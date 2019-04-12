$(function(){
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
    $.ajax({
        method:'GET',
        url:'/jourschomes/get',
        dataType: 'json',
        success:function(data){
            $('#calendar').fullCalendar({
                eventLimitText:'Plus',
                header: {
                    left: 'prev,next today printButton',
                    center: 'title',
                    right: 'month,listMonth'
                },
                allDaySlot:false,
                hiddenDays : ['2018-11-30 00:00:00','2018-12-20 00:00:00'],
                buttonText:{'month':'mois','listMonth':'liste'},
                defaultDate: $.now(),
                navLinks: false, // can click day/week names to navigate views
                businessHours: true, // display business hours
                editable: false,
                selectable:true,
                selectHelper:true,
                locale: 'fr',
                firstDay: 1,
                eventLimit: true, // allow "more" link when too many events
                slotDuration: '00:15:00', //If we want to split day time each 15minutes
                minTime: '08:00:00',
                maxTime: '19:00:00',
                defaultView: 'month',
                handleWindowResize: true,
                height: $(window).height(),
                displayEventTime: false,
                droppable: true, // this allows tmaihings to be dropped onto the calendar !!!
                select: function(start,end) {

                        $('.title-modal-event').html('Ajouter un Jour chomé');
                        $('#my-event').modal({
                            backdrop: 'static'
                        });
                        var form = $("<form></form>");
                        form.append("<div class='row'></div>");
                        form.append("<div class='errorsmsg'></div>");
                        form.find(".row")
                            .append("" +
                                "<div class='col-md-12'>" +
                                "<div class='form-group'><label class='control-label'>Titre</label>" +
                                "<input type='text' class='form-control' placeholder='Titre' name='title'/>" +
                                "</div>" +
                                "</div>"
                            ).append("" +
                                    "<div class='col-md-12 jcc'>" +
                                        "<div class='form-group'><label class='control-label'>Couleur</label>" +
                                            "<select name='color' class='selectpicker' data-style='form-control'>"+
                                                "<option value='#2cabe3'>Primaire</option>"+
                                                "<option value='#20f14f'>Vert</option>"+
                                                "<option value='#5e6cce'>Violette</option>"+
                                                "<option value='#dcac18'>orange</option>"+
                                                "<option value='#f13333'>Rouge</option>"+
                                            "</select>"+
                                        "</div>" +
                                    "</div>"
                                );
                        $('#my-event').find('.delete-event').hide().end().find('.save-event').show().end().find('.modal-body').empty().prepend(form).end().find('.save-event').unbind('click').click(function () {
                            form.submit();
                        });
                        $('#my-event').find('form').on('submit', function () {
                            var title = form.find("input[name='title']").val();
                            var color = form.find("select[name='color'] option:checked").val();
                            var eventData;
                            var id;
                            eventData = {
                                start: moment(start).format('Y-MM-DD'),
                                end: moment(end).format('Y-MM-DD'),
                                title:title,
                                color:color
                            };
                            if (title && title !== '0') {
                                $.ajax({
                                    method: 'POST',
                                    url: '/jourschomes/insert',
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    data: eventData,
                                    beforeSend: function () {
                                        $('#loading').show();
                                    },
                                    success: function (data) {
                                        eventData.id = data.id;
                                        $('#calendar').fullCalendar('renderEvent', eventData, true);
                                        $('#my-event').modal('hide');
                                    }, error: function (e) {
                                        $('.errorsmsg').html('<span class=" alert alert-danger col-sm-12">' + e.responseJSON.message + '</span>')
                                    }
                                });
                                $('#loading').hide();
                            }
                            else {
                                form.find("input[name=title]").parent('.form-group').addClass('has-error');
                                $('.errorsmsg').html('<span class=" alert alert-danger col-sm-12">Vous devez donner les champs obligatoires</span>')
                            }
                            return false;
                        });
                        $('#calendar').fullCalendar('unselect');

                },
                eventClick:function(calEvent) {
                    $('.title-modal-event').html('Modifier ce Jour chomé');
                    var title_ = calEvent.title === 'undefined' || calEvent.title === null ?  '' : calEvent.title;
                    var form = $("<form></form>");
                    form.append("<div class='row'></div>");
                    form.append("<div class='errorsmsg'></div>");
                    form.find(".row")
                        .append("" +
                            "<div class='col-md-12'>" +
                            "<div class='form-group'><label class='control-label'>Titre</label>" +
                            "<input type='text' class='form-control' value='"+title_+"' placeholder='Titre' name='title' />" +
                            "</div>" +
                            "</div>"
                        ).append("" +
                        "<div class='col-md-12 jcc'>" +
                        "<div class='form-group'><label class='control-label'>Couleur</label>" +
                        "<select name='color' class='selectpicker' data-style='form-control'>"+
                        "<option value='#2cabe3'>Primaire</option>"+
                        "<option value='#20f14f'>Vert</option>"+
                        "<option value='#5e6cce'>Violette</option>"+
                        "<option value='#dcac18'>orange</option>"+
                        "<option value='#f13333'>Rouge</option>"+
                        "</select>"+
                        "</div>" +
                        "</div>"
                    );
                    $('#my-event').modal({
                        backdrop: 'static'
                    });


                    $('#my-event').find('.delete-event').show().end().find('.modal-body').empty().prepend(form).end().find('.delete-event').unbind('click').click(function () {
                        if (confirm("Are you sure?")) {
                        $.ajax({
                            method: 'DELETE',
                            url: '/jourschomes/delete',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                id: calEvent.id,
                                "_method": 'DELETE',
                                "_token": $('meta[name="csrf-token"]').attr('content')
                            },
                            beforeSend: function () {
                                $('.loading').show();
                            },
                            success: function (data) {
                                if (data === 'success') {
                                    $('#calendar').fullCalendar('removeEvents', function (ev) {
                                        return (ev._id == calEvent.id);
                                    });
                                    $('#my-event').modal('hide');
                                    $('.alerts-timesheet').html('<div class="alert alert-warning" role="alert">Vous avez supprimer un jours chomé</div>')
                                }
                            },
                            error: function (error) {
                                console.log(error)
                            }

                        });
                        $('.loading').hide();}
                    });
                    $('#my-event').find('.save-event').show().end().find('.modal-body').empty().prepend(form).end().find('.save-event').unbind('click').click(function () {
                        form.submit();
                    });
                    $('#my-event').find('form').on('submit', function () {
                        var title = form.find("input[name='title']").val();
                        var color = form.find("select[name='color'] option:checked").val();
                        var updateData;
                        updateData = {
                            id:calEvent.id,
                            title: title,
                            color: color,
                            "_method": 'PUT',
                            "_token": $('meta[name="csrf-token"]').attr('content')
                        };
                        if (title && title !== '0') {
                            $.ajax({
                                method: 'PUT',
                                url: '/jourschomes/update',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: updateData,
                                beforeSend: function () {
                                    $('#loading').show();
                                },
                                success: function (data) {
                                    calEvent.id = data.id;
                                    calEvent.color = data.color;
                                    calEvent.title =data.title;
                                    $('#calendar').fullCalendar('renderEvent', calEvent, true);
                                    $('#my-event').modal('hide');
                                },
                                error: function (e) {
                                    $('.errorsmsg').html('<span class=" alert alert-danger col-sm-12">' + e.responseJSON.message + '</span>')
                                }
                            });
                            $('#loading').hide();
                        }
                        else {
                            form.find("input[name=title]").parent('.form-group').addClass('has-error');
                            $('.errorsmsg').html('<span class=" alert alert-danger col-sm-12">Vous devez donner les champs obligatoires</span>')
                        }
                        return false;
                    });


                    $("select[name='color'] option").each(function(key)
                    {
                        if($(this).val() == calEvent.color){
                            $(this).attr('selected',true)
                        }
                        console.log();
                    });
                },
                events:data.jourschomes
            });
        },
    })


});