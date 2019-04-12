$(function(){
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
    $.ajax({
        method:'GET',
        url:'/users/timesheet/get',
        dataType: 'json',
        success:function(data){
            $('#calendar').fullCalendar({
                eventLimitText:'Plus',
                customButtons: {
                    printTimesheet: {
                        text: "Timesheet",
                        click: function() {
                            var getMonthSelected = moment($("#calendar").fullCalendar('getDate'))
                                .format('YYYY-MM');
                            window.location.href = "/timesheet/invoiceTimesheet/"+getMonthSelected
                        }
                    },
                    printPlaning : {
                        text: "Planning",
                        click: function() {
                            var getMonthSelected = moment($("#calendar").fullCalendar('getDate'))
                                .format('YYYY-MM');
                            window.location.href = "/timesheet/invoicePlaning/"+getMonthSelected
                        }
                    }
                },
                header: {
                    left: 'prev,next today printTimesheet printPlaning ',
                    center: 'title',
                    right: 'month,listMonth'
                },
                /*dayClick: function( date, allDay, jsEvent, view ) {
                    var myDate = new Date();

                    //How many days to add from today?
                    var daysToAdd = 2;

                    myDate.setDate(myDate.getDate() + daysToAdd);

                    if (date < myDate) {
                        //TRUE Clicked date smaller than today + daysToadd
                        alert("You cannot book on this day!");
                        alert("You cannot book on this day!");
                    }
                    else
                    {
                        //FLASE Clicked date larger than today + daysToadd
                        alert("Excellent choice! We can book today..");
                    }


                    },*/
                viewRender: function(date, cell){

                },
                allDaySlot:false,
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
                droppable: true, // this allows things to be dropped onto the calendar !!!
                eventSources: [
                    {
                        url: '/jourschomes/gets',
                        type: 'GET',
                        error: function(re) {

                        },
                        className:'tyu',
                        success: function(e) {
                            $.each(e,function(key,result){
                                var start_res = moment(result.start);
                                var end_res = moment(result.end);
                                 while( start_res.format('YYYY-MM-DD') != end_res.format('YYYY-MM-DD') ){
                                     var dataToFind = start_res.format('YYYY-MM-DD');
                                     $("td[data-date='"+dataToFind+"']").addClass('jour_ferie');
                                     start_res.add(1, 'd');
                                 }
                            })
                        },textColor:'#fff',className :"yw"
                    }

                ],
                select: function(start, end) {
                    var date_ = moment(new Date()).format('Y-MM');
                    var start_ = moment(start).format('Y-MM');
                    if(moment(new Date()).format('DD') <= 5){
                         date_ = moment(new Date()).subtract(1,'months').startOf('month').format('Y-MM-DD');
                         start_ = moment(start).format('Y-MM-DD');

                    }
                    if (date_ <= start_) {
                        $('.title-modal-event').html('Ajouter une Tâche');
                        $('#my-event').modal({
                            backdrop: 'static'
                        });
                        var form = $("<form></form>");
                        form.append("<div class='row'></div>");
                        form.append("<div class='errorsmsg'></div>");
                        form.find(".row")
                            .append("" +
                                "<div class='col-md-6'>" +
                                "<div class='form-group'><label class='control-label'>Clients/Projets</label>" +
                                "<select name='client_id' id='client_id' class='form-control'>" +
                                "<option value='0'>Choisir un Client/Projet</option>" +
                                "</select> " +
                                "</div>" +
                                "</div>"
                            )
                            .append("" +
                                "<div class='col-md-6'>" +
                                "<div class='form-group'><label class='control-label'>Missions</label>" +
                                "<select name='mission_id' id='mission_id' class='form-control'>" +
                                "<option value='0'>Choisir une mission</option>" +
                                "</select> " +
                                "</div>" +
                                "</div>"
                            )
                            .append("" +
                                "<div class='col-md-6'>" +
                                "<div class='form-group'><label class='control-label'>Temps réalisé</label>" +
                                "<input type='text' class='form-control' placeholder='Nombre d&#039;heurs' name='budget_temps' disabled='disabled' />" +
                                "</div>" +
                                "</div>"
                            )
                            .append("" +
                                "<div class='col-md-6'>" +
                                "<div class='form-group'>" +
                                "<label class='control-label'>Statut</label>" +
                                "<div class='radio-list'>" +
                                "<label class='radio-inline p-0'>" +
                                "<div class='radio radio-info'>" +
                                "<input type='radio' name='realisee' id='radio1' value='1'>" +
                                "<label for='radio1'>Réalisé</label>" +
                                "</div>" +
                                "</label>" +
                                "<label class='radio-inline'>" +
                                "<div class='radio radio-info'>" +
                                "<input type='radio' name='realisee' id='radio0' value='0' checked='checked'>" +
                                "<label for='radio0'>Non Réalisé</label>" +
                                "</div>" +
                                "</label>" +
                                "</div>" +
                                "</div>" +
                                "</div>"
                            )
                            .append("" +
                                "<div class='col-md-4'>" +
                                "<div class='form-group'><label class='control-label'>Frais de déplacement</label>" +
                                "<input type='text' class='form-control' placeholder='DH' name='frais_dep' disabled='disabled'/>" +
                                "</div>" +
                                "</div>"
                            ).append("" +
                            "<div class='col-md-4'>" +
                            "<div class='form-group'><label class='control-label'>Frais de restauration</label>" +
                            "<input type='text' class='form-control' placeholder='DH' name='frais_resto' disabled='disabled'/>" +
                            "</div>" +
                            "</div>"
                        ).append("" +
                            "<div class='col-md-4'>" +
                            "<div class='form-group'><label class='control-label'>Frais d\'hébergement</label>" +
                            "<input type='text' class='form-control' placeholder='DH' name='frais_heber' disabled='disabled'/>" +
                            "</div>" +
                            "</div>"
                        )
                            .append("" +
                                "<div class='col-md-4'>" +
                                "<div class='form-group'><label class='control-label'>Autres Frais</label>" +
                                "<input type='text' class='form-control' placeholder='DH' name='frais_autre' disabled='disabled'/>" +
                                "</div>" +
                                "</div>"
                            ).append("" +
                            "<div class='col-md-4'>" +
                            "<div class='form-group'><label class='control-label'>Désignation</label>" +
                            "<textarea type='text' class='form-control' placeholder='Désignation' name='desc_frais_autre' disabled='disabled'/></textarea>" +
                            "</div>" +
                            "</div>"
                        ).append("" +
                            "<div class='col-md-12'>" +
                            "<div class='form-group'><label class='control-label'>Commentaire</label>" +
                            "<textarea type='text' class='form-control' placeholder='Commentaire' name='commentaire'/></textarea>" +
                            "</div>" +
                            "</div>"
                        );

                        $('#my-event').find('.delete-event').hide().end().find('.save-event').show().end().find('.modal-body').empty().prepend(form).end().find('.save-event').unbind('click').click(function () {
                            form.submit();
                        });
                        $('#my-event').find('form').on('submit', function () {
                            var client_id = form.find("select[name='client_id'] option:checked").val();
                            var mission_id = form.find("select[name='mission_id'] option:checked").val();
                            var budget_temps = form.find("input[name='budget_temps']").val();
                            var realisee = form.find("input:radio[name='realisee']:checked").val();
                            var frais_dep = form.find("input[name='frais_dep']").val();
                            var frais_resto = form.find("input[name='frais_resto']").val();
                            var frais_heber = form.find("input[name='frais_heber']").val();
                            var frais_autre = form.find("input[name='frais_autre']").val();
                            var desc_frais_autre = form.find("textarea[name='desc_frais_autre']").val();
                            var commentaire = form.find("textarea[name='commentaire']").val();
                            var eventData;
                            var id;

                            eventData = {
                                start: moment(start).format('Y-MM-DD'),
                                end: moment(end).format('Y-MM-DD'),
                                client_id: client_id,
                                mission_id: mission_id,
                                budget_temps: budget_temps,
                                realisee: realisee,
                                frais_dep: frais_dep,
                                frais_resto: frais_resto,
                                frais_heber: frais_heber,
                                frais_autre: frais_autre,
                                desc_frais_autre: desc_frais_autre,
                                commentaire: commentaire,

                            };
                            if (client_id !== '0' && mission_id !== '0'  && realisee ) {
                                if(realisee == 1 && (!budget_temps || budget_temps == '') ){
                                        form.find("input[name='budget_temps']").parent('.form-group').addClass('has-error');
                                }else{
                                    if(frais_autre !== '' && desc_frais_autre == '' ){
                                        form.find("textarea[name='desc_frais_autre']").parent('.form-group').addClass('has-error')
                                    }else{
                                        $.ajax({
                                            method: 'POST',
                                            url: '/users/timesheet/insert',
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            },
                                            data: eventData,
                                            beforeSend: function () {
                                                $('.save-event').attr('disabled',true);
                                                $('#loading').show();
                                            },
                                            success: function (data) {
                                                eventData.id = data.id;
                                                eventData.title = form.find("select[name='client_id'] option:checked").text();
                                                eventData.color = data.color;
                                                $('#calendar').fullCalendar('renderEvent', eventData, true);
                                                $('#loading').hide();
                                                $('#my-event').modal('hide');
                                                $('.save-event').attr('disabled',false);

                                            },
                                            error: function (e) {
                                                $('.errorsmsg').html('<span class=" alert alert-danger col-sm-12">' + e.responseJSON.message + '</span>')
                                                $('.save-event').attr('disabled',false);
                                                $('#loading').hide();
                                            }

                                        });

                                    }
                                }
                            }
                            else {
                                if (!client_id || client_id == '0') {
                                    form.find("select[name=client_id]").parent('.form-group').addClass('has-error');
                                }
                                if (!mission_id || mission_id == '0') {
                                    form.find("select[name=mission_id]").parent('.form-group').addClass('has-error');
                                }
                                if (!realisee || realisee == 'undefined') {
                                    form.find(".radio-list").parent('.form-group').addClass('has-error');
                                }
                                $('.errorsmsg').html('<span class=" alert alert-danger col-sm-12">Veuillez renseigner les champs obligatoires</span>')
                            }
                            return false;

                        });
                        $('#calendar').fullCalendar('unselect');
                        $.each(data.clients, function (key, value) {
                            $('#client_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                        $.each(data.missions, function (key, value) {
                            $('#mission_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                        $("input:radio[name='realisee']").on('change', function () {
                            if ($(this).val() === '1') {
                                $("input[name='budget_temps'],input[name='frais_dep'],input[name='frais_resto']" +
                                    ",input[name='frais_heber'],input[name='frais_autre']" +
                                    ",textarea[name='desc_frais_autre']").attr("disabled", false);
                            }
                            else if ($(this).val() === '0') {
                                $("input[name='budget_temps'],input[name='frais_dep'],input[name='frais_resto']" +
                                    ",input[name='frais_heber'],input[name='frais_autre']" +
                                    ",textarea[name='desc_frais_autre']").attr("disabled", true);
                            }
                        });

                    }else{
                        $('#calendar').fullCalendar('unselect');
                        alert("Vous ne pouvez pas sélectionner une date inférieur à le mois en cours")
                    }
                },
                eventResize:function(event){

                },
                eventDrop:function(event){

                },
                eventClick:function(calEvent) {

                    var budget_temps_ = calEvent.budget_temps === null  ? '' : calEvent.budget_temps;
                    var frais_dep_ = calEvent.frais_dep === null ? '' : calEvent.frais_dep;
                    var frais_resto_ = calEvent.frais_resto === null ? '' : calEvent.frais_resto;
                    var frais_heber_ = calEvent.frais_heber === null ? '' : calEvent.frais_heber;
                    var frais_autre_ = calEvent.frais_autre === null ? '' : calEvent.frais_autre;
                    var desc_frais_autre_ = calEvent.desc_frais_autre === null ? '' : calEvent.desc_frais_autre;
                    var commentaire_ = calEvent.commentaire === 'undefined' || calEvent.commentaire === null || typeof(calEvent.commentaire) === 'undefined' ? '' : calEvent.commentaire;

                    $('.title-modal-event').html('Timesheet détaillé');
                    var form = $("<form></form>");
                    form.append("<div class='row'></div>");
                    form.append("<div class='errorsmsg'></div>");
                    form.find(".row")
                        .append("" +
                            "<div class='col-md-6'>" +
                            "<div class='form-group'><label class='control-label'>Clients/Projets</label>" +
                            "<select name='client_id' id='client_id' class='form-control'>" +
                            "<option value='0'>Choisir un Client/Projet</option>" +
                            "</select> " +
                            "</div>" +
                            "</div>"
                        )
                        .append("" +
                            "<div class='col-md-6 aftr'>" +
                            "<div class='form-group'><label class='control-label'>Missions</label>" +
                            "<select name='mission_id' id='mission_id' class='form-control'>" +
                            "<option value='0'>Choisir une mission</option>" +
                            "</select> " +
                            "</div>" +
                            "</div>"
                        )
                        .append("" +
                            "<div class='col-md-6'>" +
                            "<div class='form-group'><label class='control-label'>Temps réalisé</label>" +
                            "<input value='" + budget_temps_ + "' type='text' class='form-control' placeholder='Nombre d&#039;heurs' name='budget_temps'/>" +
                            "</div>" +
                            "</div>"
                        )
                        .append("" +
                            "<div class='col-md-6'>" +
                            "<div class='form-group'>" +
                            "<label class='control-label'>Statut</label>" +
                            "<div class='radio-list'>" +
                            "<label class='radio-inline p-0'>" +
                            "<div class='radio radio-info'>" +
                            "<input type='radio' name='realisee' id='radio1' value='1' >" +
                            "<label for='radio1'>Réalisé</label>" +
                            "</div>" +
                            "</label>" +
                            "<label class='radio-inline'>" +
                            "<div class='radio radio-info'>" +
                            "<input type='radio' name='realisee' id='radio0' value='0' >" +
                            "<label for='radio0'>Non Réalisé</label>" +
                            "</div>" +
                            "</label>" +
                            "</div>" +
                            "</div>" +
                            "</div>"
                        )
                        .append("" +
                            "<div class='col-md-4'>" +
                            "<div class='form-group'><label class='control-label'>Frais de déplacement</label>" +
                            "<input value='" + frais_dep_ + "' type='text' class='form-control' placeholder='DH' name='frais_dep'/>" +
                            "</div>" +
                            "</div>"
                        ).append("" +
                        "<div class='col-md-4'>" +
                        "<div class='form-group'><label class='control-label'>Frais de restauration</label>" +
                        "<input value='" + frais_resto_ + "' type='text' class='form-control' placeholder='DH' name='frais_resto'/>" +
                        "</div>" +
                        "</div>"
                    ).append("" +
                        "<div class='col-md-4'>" +
                        "<div class='form-group'><label class='control-label'>Frais d\'hébergement</label>" +
                        "<input value='" + frais_heber_ + "' type='text' class='form-control' placeholder='DH' name='frais_heber'/>" +
                        "</div>" +
                        "</div>"
                    )
                        .append("" +
                            "<div class='col-md-4'>" +
                            "<div class='form-group'><label class='control-label'>Autres Frais</label>" +
                            "<input value='" + frais_autre_ + "' type='text' class='form-control' placeholder='DH' name='frais_autre'/>" +
                            "</div>" +
                            "</div>"
                        ).append("" +
                        "<div class='col-md-4'>" +
                        "<div class='form-group'><label class='control-label'>Désignation</label>" +
                        "<textarea type='text' class='form-control' placeholder='Désignation' name='desc_frais_autre'>" + desc_frais_autre_ + "</textarea>" +
                        "</div>" +
                        "</div>"
                    )
                        .append("" +
                        "<div class='col-md-12'>" +
                        "<div class='form-group'><label class='control-label'>Commentaire</label>" +
                        "<textarea type='text' class='form-control' placeholder='Commentaire' name='commentaire' >" + commentaire_ + "</textarea>" +
                        "</div>" +
                        "</div>"
                    );


                    $('#my-event').modal({
                        backdrop: 'static'
                    });

                    var thisMonthYear = moment(new Date()).format('Y-MM');
                    var missionMonthYear = moment(calEvent.start).format('Y-MM');
                    var thisDate = moment(new Date()).format('Y-MM-DD');
                    var missionEndDate = moment(calEvent.start).endOf('month').add(5,'days').format('Y-MM-DD');

                    if(thisMonthYear > missionMonthYear && thisDate > missionEndDate ){
                        $('#my-event').find('.delete-event').hide().end().find('.save-event').hide().end()
                            .find('.modal-body').empty().prepend(form).end();
                        $('input,select,textarea').attr("disabled", true);
                    }
                    else{
                        $('#my-event').find('.delete-event').show().end().find('.modal-body').empty().prepend(form).end().find('.delete-event').unbind('click').click(function () {
                            if (confirm("Voulez-vous vraiment supprimer cette tâche !!")) {
                                $.ajax({
                                    method: 'DELETE',
                                    url: '/users/timesheet/delete',
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
                                            $('.alerts-timesheet').html('<div class="alert alert-warning" role="alert">la tâche a été supprimé avec succès</div>')
                                        }
                                    },
                                    error: function (error) {
                                        $('#my-event').modal('hide');
                                        window.location.href = '/';
                                    }

                                });
                            }
                            return false;
                        });
                        $('#my-event').find('.save-event').show().end().find('.modal-body').empty().prepend(form).end().find('.save-event').unbind('click').click(function () {
                            form.submit();
                        });
                        $('#my-event').find('form').on('submit', function () {
                            var client_id = form.find("select[name='client_id'] option:checked").val();
                            var mission_id = form.find("select[name='mission_id'] option:checked").val();
                            var budget_temps = form.find("input[name='budget_temps']").val();
                            var realisee = form.find("input:radio[name='realisee']:checked").val();
                            var frais_dep = form.find("input[name='frais_dep']").val();
                            var frais_resto = form.find("input[name='frais_resto']").val();
                            var frais_heber = form.find("input[name='frais_heber']").val();
                            var frais_autre = form.find("input[name='frais_autre']").val();
                            var desc_frais_autre = form.find("textarea[name='desc_frais_autre']").val();
                            var commentaire = form.find("textarea[name='commentaire']").val();
                            var updatedData;
                            updatedData = {
                                id: calEvent.id,
                                client_id: client_id,
                                mission_id: mission_id,
                                budget_temps: budget_temps,
                                realisee: realisee,
                                frais_dep: frais_dep,
                                frais_resto: frais_resto,
                                frais_heber: frais_heber,
                                frais_autre: frais_autre,
                                desc_frais_autre: desc_frais_autre,
                                commentaire: commentaire,
                                "_method": 'PUT',
                                "_token": $('meta[name="csrf-token"]').attr('content')
                            }
                            if (client_id !== '0' && mission_id !== '0' && realisee) {
                                if(realisee == 1 && (!budget_temps || budget_temps == '')){
                                    form.find("input[name='budget_temps']").parent('.form-group').addClass('has-error');
                                }else{
                                    if(frais_autre !== '' && desc_frais_autre == '' ){
                                        form.find("textarea[name='desc_frais_autre']").parent('.form-group').addClass('has-error')
                                    }else{
                                        $.ajax({
                                            method: 'PUT',
                                            url: '/users/timesheet/update',
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            },
                                            data: updatedData,
                                            beforeSend: function () {
                                                $('.loading').show();
                                            },
                                            success: function (data) {
                                                calEvent.client_id = data.client_id;
                                                calEvent.mission_id = data.mission_id;
                                                calEvent.budget_temps = data.budget_temps;
                                                calEvent.realisee = data.realisee;
                                                calEvent.frais_dep = data.frais_dep;
                                                calEvent.frais_resto = data.frais_resto;
                                                calEvent.frais_heber = data.frais_heber;
                                                calEvent.frais_autre = data.frais_autre;
                                                calEvent.desc_frais_autre = data.desc_frais_autre;
                                                calEvent.commentaire = data.commentaire;
                                                calEvent.title = form.find("select[name='client_id'] option:checked").text();
                                                calEvent.color = data.color;
                                                $('#calendar').fullCalendar('updateEvent', calEvent);
                                                $('#my-event').modal('hide');
                                                $('.alerts-timesheet').html('<div class="alert alert-warning" role="alert">Votre modification a bien été sauvegardé</div>')

                                            }, error: function (error) {
                                                $('.errorsmsg').html('<span class=" alert alert-danger col-sm-12">' + error.responseJSON.message + '</span>')
                                            }
                                        });
                                        $('.loading').hide();
                                    }

                                }

                            }
                            else {
                                if (!client_id || client_id == '0') {
                                    form.find("select[name=client_id]").parent('.form-group').addClass('has-error');
                                }
                                if (!mission_id || mission_id == '0') {
                                    form.find("select[name=mission_id]").parent('.form-group').addClass('has-error');
                                }
                                if (!realisee || realisee == 'undefined') {
                                    form.find(".radio-list").parent('.form-group').addClass('has-error');
                                }
                                if (!budget_temps || budget_temps == '') {
                                    form.find("input[name=budget_temps]").parent('.form-group').addClass('has-error');
                                }
                                $('.errorsmsg').html('<span class=" alert alert-danger col-sm-12">Veuillez renseigner les champs obligatoires</span>')
                            }
                            return false;
                        });
                    }
                    $.each(data.missions, function (key, value) {
                        var selectedMission = value.id == calEvent.mission_id ? 'selected' : '';
                        $("select[name='mission_id']").append('<option value="' + value.id + '" ' + selectedMission + ' >' + value.name + '</option>');
                    });
                    $.each(data.clients, function (key, value) {
                        var selectedClient = value.id == calEvent.client_id ? 'selected' : '';
                        $("select[name='client_id']").append('<option value="' + value.id + '"  ' + selectedClient + '  >' + value.name + '</option>');
                    });
                    if (calEvent.realisee == 1) {
                        $('#radio1').attr('checked', true);
                    } else if (calEvent.realisee == 0) {
                        $('#radio0').attr('checked', true);
                        $("input[name='budget_temps'],input[name='frais_dep'],input[name='frais_resto']" +
                            ",input[name='frais_heber'],input[name='frais_autre']" +
                            ",textarea[name='desc_frais_autre']").attr("disabled", true);
                    }
                    $("input:radio[name='realisee']").on('change', function () {
                        if ($(this).val() == 1) {
                            $("input[name='budget_temps'],input[name='frais_dep'],input[name='frais_resto']" +
                                ",input[name='frais_heber'],input[name='frais_autre']" +
                                ",textarea[name='desc_frais_autre']").attr("disabled", false);
                        } else if ($(this).val() == 0) {
                            $("input[name='budget_temps'],input[name='frais_dep'],input[name='frais_resto']" +
                                ",input[name='frais_heber'],input[name='frais_autre']" +
                                ",textarea[name='desc_frais_autre']").attr("disabled", true);
                        }
                    })
                    if(calEvent.is_planing == 1){
                        $('.title-modal-event').html('Planning Détaillé');
                        $('.delete-event').hide();
                        var budget_temps_estimer_ = calEvent.budget_temps_estimer === null ? '' : calEvent.budget_temps_estimer;
                        var commentaire_admin_ = calEvent.commentaire_admin === null ? '' : calEvent.commentaire_admin;
                        form.find(".aftr").after(
                                "<div class='col-md-6'>" +
                                "<div class='form-group'><label class='control-label'>Budget temps estimé</label>" +
                                "<input value='" + budget_temps_estimer_ + "' type='text' class='form-control disabled' placeholder='Nombre d&#039;heurs'/>" +
                                "</div>" +
                                "</div>"+
                                "<div class='col-md-6'>" +
                                "<div class='form-group'>" +
                                "<div class='checkbox checkbox-success disabled_checkbox'>" +
                                "<input type='checkbox' class='' id='checkbox_urgance' value='1'/>" +
                                "<label for='checkbox_urgance'>Urgent</label>" +
                                "</div>" +
                                "</div>" +
                                "</div>"+
                                "<div class='col-md-12'>" +
                                "<div class='form-group'><label class='control-label'>Commentaire administrateur</label>" +
                                "<textarea type='text' class='form-control disabled' placeholder='Commentaire administrateur'>" + commentaire_admin_ + "</textarea>" +
                                "</div>" +
                                "</div>"
                        )
                        $("select[name='client_id'],select[name='mission_id']").attr('disabled',true);
                        calEvent.urgence === 1 ? $("#checkbox_urgance").attr('checked',true) : '';
                    }
                },
                events: data.timesheets
            });
        },
        error:function(){

        }
    })
});