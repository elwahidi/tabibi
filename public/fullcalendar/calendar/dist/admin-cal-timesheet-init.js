$(function(){
    var userid = $('#userid').text();
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
    $.ajax({
        method:'GET',
        url:'/admin/timesheet/get/'+userid,
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
                            window.location.href = "/admin/timesheet/invoiceTimesheet/"+userid+'/'+getMonthSelected
                        }
                    },
                    printPlaning : {
                        text: "Planning",
                        click: function() {
                            var getMonthSelected = moment($("#calendar").fullCalendar('getDate'))
                                .format('YYYY-MM');
                            window.location.href = "/admin/timesheet/invoicePlaning/"+userid+'/'+getMonthSelected
                        }
                    }
                },
                header: {
                    left: 'prev,next today printTimesheet printPlaning',
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
                select: function(start,end) {
                    $('.save-event').attr('disabled',false);
                    if (moment(new Date()).format('Y-MM') <= moment(start).format('Y-MM')) {
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
                                "<option value='0'>Choisir un Client</option>" +
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
                                "<div class='form-group'><label class='control-label'>Budget temps estimé</label>" +
                                "<input type='text' class='form-control' placeholder='Nombre d&#039;heurs' name='budget_temps_estimer'/>" +
                                "</div>" +
                                "</div>"
                            )
                            .append("" +
                                "<div class='col-md-6'>" +
                                "<div class='form-group'>" +
                                    "<div class='checkbox checkbox-success '>" +
                                        "<input type='checkbox' name='urgence' id='checkbox_urgance' value='1'/>" +
                                        "<label for='checkbox_urgance'>Urgent</label>" +
                                    "</div>" +
                                "</div>" +
                                "</div>"
                            )
                            .append("" +
                                "<div class='col-md-12'>" +
                                "<div class='form-group'><label class='control-label'>Commentaire administrateur</label>" +
                                "<textarea type='text' class='form-control' placeholder='Commentaire administrateur' name='commentaire_admin'/></textarea>" +
                                "</div>" +
                                "</div>"
                            ).append("" +
                                "<div class='col-md-12 msg'>" +
                                "</div>"
                            );

                        $('#my-event').find('.delete-event').hide().end().find('.notify-event').hide().end().find('.save-event').show().end().find('.modal-body').empty().prepend(form).end().find('.save-event').unbind('click').click(function () {
                            form.submit();
                        });
                        $('#my-event').find('form').on('submit', function (eventt) {

                            var client_id = form.find("select[name='client_id'] option:checked").val();
                            var mission_id = form.find("select[name='mission_id'] option:checked").val();
                            var budget_temps_estimer = form.find("input[name='budget_temps_estimer']").val();
                            var urgence = form.find("input[name='urgence']:checked").val();
                            var commentaire_admin = form.find("textarea[name='commentaire_admin']").val();
                            var eventData;
                            var id;

                            eventData = {
                                start: moment(start).format('Y-MM-DD'),
                                end: moment(end).format('Y-MM-DD'),
                                client_id: client_id,
                                mission_id: mission_id,
                                budget_temps_estimer: budget_temps_estimer,
                                urgence: urgence ? urgence : null,
                                commentaire_admin: commentaire_admin,
                                user_id: $('#userid').text()
                            };

                            if (client_id !== '0' && mission_id !== '0' && budget_temps_estimer !== '') {
                                $.ajax({
                                    method: 'POST',
                                    url: '/admin/timesheet/insert',
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    data: eventData,
                                    beforeSend: function () {
                                        $('#loading').show();
                                        $('.save-event').attr('disabled',true);
                                    },
                                    success: function (data) {
                                        eventData.id = data.id;
                                        eventData.title = form.find("select[name='client_id'] option:checked").text();
                                        eventData.color = data.color;
                                        eventData.is_planing = 1;
                                        $('#calendar').fullCalendar('renderEvent', eventData, true);
                                        $('.msg').html("<div class='alert alert-success p-5'>Le planning a été ajouter avec success</div>")
                                        $('#my-event').find('.notify-event').show().end().find('.modal-body').empty().prepend(form).end().find('.notify-event').unbind('click').click(function () {
                                            if (confirm("Voulez-vous vraiment notifier cet utilisateur ? ")) {
                                                $.ajax({
                                                    method: 'POST',
                                                    url: '/users/timesheet/notify',
                                                    headers: {
                                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                    },
                                                    data: {
                                                        id: eventData.id,

                                                    },
                                                    beforeSend: function () {
                                                        $('.loading').show();
                                                    },
                                                    success: function (data) {

                                                        if (data == 'success') {
                                                            $('#my-event').modal('hide');
                                                            $('.alerts-timesheet').html('<div class="alert alert-success" role="alert">Cet utilisateur a été notifié</div>')
                                                        }else{
                                                            $('#my-event').modal('hide');
                                                            $('.alerts-timesheet').html('<div class="alert alert-danger" role="alert">Il y a un bug dans le serveur</div>')
                                                        }
                                                    },
                                                    error: function (error) {
                                                        $('.alerts-timesheet').html('<div class="alert alert-danger" role="alert">Il y a un bug dans le serveur</div>')
                                                    }

                                                });
                                                $('.loading').hide();}
                                        });
                                        $('#my-event').find('.delete-event').show().end().find('.modal-body').empty().prepend(form).end().find('.delete-event').unbind('click').click(function () {
                                            if (confirm("Voulez-vous vraiment supprimer cette tâche !!")) {
                                                $.ajax({
                                                    method: 'DELETE',
                                                    url: '/users/timesheet/delete',
                                                    headers: {
                                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                    },
                                                    data: {
                                                        id: eventData.id,
                                                        "_method": 'DELETE',
                                                        "_token": $('meta[name="csrf-token"]').attr('content')
                                                    },
                                                    beforeSend: function () {
                                                        $('.loading').show();
                                                    },
                                                    success: function (data) {
                                                        if (data === 'success') {
                                                            $('#calendar').fullCalendar('removeEvents', function (ev) {
                                                                return (ev._id == eventData.id);
                                                            });
                                                            $('#my-event').modal('hide');
                                                            $('.alerts-timesheet').html('<div class="alert alert-warning" role="alert">la tâche a été supprimé avec succès</div>')
                                                        }
                                                    },
                                                    error: function (error) {
                                                        console.log(error)
                                                    }

                                                });
                                                $('.loading').hide();}
                                        });
                                        //$('#my-event').modal('hide');
                                        $('.save-event').attr('disabled',false);
                                    },
                                    error: function (e) {
                                        $('.save-event').attr('disabled',false);
                                        $('.errorsmsg').html('<span class=" alert alert-danger col-sm-12">' + e.responseJSON.message + '</span>')
                                    }
                                });
                                $('#loading').hide();
                            }
                            else {
                                if (!client_id || client_id == '0') {
                                    form.find("select[name=client_id]").parent('.form-group').addClass('has-error');
                                }
                                if (!mission_id || mission_id == '0') {
                                    form.find("select[name=mission_id]").parent('.form-group').addClass('has-error');
                                }
                                if (!budget_temps_estimer || budget_temps_estimer == '') {
                                    form.find("input[name=budget_temps_estimer]").parent('.form-group').addClass('has-error');
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

                    }
                    else{
                        $('#calendar').fullCalendar('unselect');
                        alert("Vous ne pouvez pas sélectionner une date inférieur à le mois en cours")
                    }
                },
                eventClick:function(calEvent) {
                    if(calEvent.is_planing == 1){
                        $('.title-modal-event').html('Planning Détaillé');
                        var budget_temps_estimer_ = calEvent.budget_temps_estimer === null ? '' : calEvent.budget_temps_estimer;
                        var commentaire_admin_ = calEvent.commentaire_admin === null ? '' : calEvent.commentaire_admin;
                    }
                    else{
                        $('.title-modal-event').html('Timesheet détaillé');
                        var budget_temps_estimer_ = "";
                        var commentaire_admin_ = "";
                    }
                    var budget_temps_ = calEvent.budget_temps === 'undefined' || calEvent.budget_temps === null || typeof(calEvent.budget_temps) === 'undefined' ?  '' : calEvent.budget_temps;
                    var frais_dep_ = calEvent.frais_dep === 'undefined' ||  calEvent.frais_dep === null || typeof(calEvent.frais_dep) === 'undefined' ? '' : calEvent.frais_dep;
                    var frais_resto_ = calEvent.frais_resto === 'undefined' || calEvent.frais_resto === null || typeof(calEvent.frais_resto) === 'undefined' ? '' : calEvent.frais_resto;
                    var frais_heber_ = calEvent.frais_heber === 'undefined' || calEvent.frais_heber  === null || typeof(calEvent.frais_heber) === 'undefined' ? '' : calEvent.frais_heber;
                    var frais_autre_ = calEvent.frais_autre === 'undefined' || calEvent.frais_autre  === null || typeof(calEvent.frais_autre) === 'undefined' ? '' : calEvent.frais_autre;
                    var desc_frais_autre_ = calEvent.desc_frais_autre === 'undefined' || calEvent.desc_frais_autre === null || typeof(calEvent.desc_frais_autre) === 'undefined'  ? '' : calEvent.desc_frais_autre;
                    var commentaire_ = calEvent.commentaire === 'undefined' || calEvent.commentaire === null || typeof(calEvent.commentaire) === 'undefined' ? '' : calEvent.commentaire;

                    var form = $("<form></form>");
                    form.append("<div class='row'></div>");
                    form.append("<div class='errorsmsg'></div>");
                    form.find(".row")
                        .append("" +
                            "<div class='col-md-6'>" +
                            "<div class='form-group'><label class='control-label'>Clients/Projets</label>" +
                            "<select name='client_id' id='client_id' class='form-control'>" +
                            "<option value='0'>Choisir un Client</option>" +
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
                            "<div class='col-md-6 planings-inputs'>" +
                            "<div class='form-group'><label class='control-label'>Budget temps estimé</label>" +
                            "<input type='text' class='form-control' placeholder='Nombre d&#039;heurs' value='"+budget_temps_estimer_+"' name='budget_temps_estimer'  />" +
                            "</div>" +
                            "</div>"
                        )
                        .append("" +
                            "<div class='col-md-6 planings-inputs'>" +
                            "<div class='form-group'>" +
                            "<div class='checkbox checkbox-success '>" +
                            "<input type='checkbox' name='urgence' id='checkbox_urgance' value='1'/>" +
                            "<label for='checkbox_urgance'>Urgent</label>" +
                            "</div>" +
                            "</div>" +
                            "</div>"
                        )
                        .append("" +
                            "<div class='col-md-12 planings-inputs'>" +
                            "<div class='form-group'><label class='control-label'>Commentaire administrateur</label>" +
                            "<textarea type='text' class='form-control' placeholder='Commentaire administrateur' name='commentaire_admin'>" + commentaire_admin_ + "</textarea>" +
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
                        "<div class='form-group'><label class='control-label'>Frais d'hébergement</label>" +
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
                    ).append("" +
                        "<div class='col-md-12'>" +
                        "<div class='form-group'><label class='control-label'>Commentaire</label>" +
                        "<textarea type='text' class='form-control' placeholder='Commentaire' name='commentaire'>" + commentaire_ + "</textarea>" +
                        "</div>" +
                        "</div>"
                    ).append("" +
                        "<div class='col-md-12 msg'>" +
                        "</div>"
                    );
                    $('#my-event').modal({
                        backdrop: 'static'
                    });

                    if (calEvent.is_planing == 1) {
                        $('#my-event').find('.notify-event').show().end().find('.modal-body').empty().prepend(form).end().find('.notify-event').unbind('click').click(function () {
                            if (confirm("Voulez-vous vraiment notifier cet utilisateuriii ? ")) {
                                $.ajax({
                                    method: 'POST',
                                    url: '/users/timesheet/notify',
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    data: {
                                        id: calEvent.id,

                                    },
                                    beforeSend: function () {
                                        $('.loading').show();
                                    },
                                    success: function (data) {
                                        if (data == 'success') {
                                            $('#my-event').modal('hide');
                                            $('.alerts-timesheet').html('<div class="alert alert-success" role="alert">Cet utilisateur a été notifié</div>')
                                         }else{
                                            $('#my-event').modal('hide');
                                            $('.alerts-timesheet').html('<div class="alert alert-danger" role="alert">Requête non traitée</div>')
                                        }
                                    },
                                    error: function (error) {
                                        $('.alerts-timesheet').html('<div class="alert alert-danger" role="alert">Il y a un bug dans le serveur</div>')
                                    }

                                });
                                $('.loading').hide();}
                        });
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
                                    console.log(error)
                                }

                            });
                            $('.loading').hide();}
                        });
                        $('#my-event').find('.save-event').show().end().find('.modal-body').empty().prepend(form).end().find('.save-event').unbind('click').click(function () {
                            form.submit();
                        });
                        $('#my-event').find('form').on('submit', function () {
                            var client_id = form.find("select[name='client_id'] option:checked").val();
                            var mission_id = form.find("select[name='mission_id'] option:checked").val();
                            var budget_temps_estimer = form.find("input[name='budget_temps_estimer']").val();
                            var urgence = form.find("input[name='urgence']:checked").val();
                            var commentaire_admin = form.find("textarea[name='commentaire_admin']").val();
                            var updateData;
                            updateData = {
                                id:calEvent.id,
                                client_id: client_id,
                                mission_id: mission_id,
                                budget_temps_estimer: budget_temps_estimer,
                                urgence: urgence ? urgence : null,
                                commentaire_admin: commentaire_admin,
                                "_method": 'PUT',
                                "_token": $('meta[name="csrf-token"]').attr('content')
                            };
                            if (client_id !== '0' && mission_id !== '0' && budget_temps_estimer !== '') {
                                $.ajax({
                                    method: 'PUT',
                                    url: '/admin/timesheet/update',
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    data: updateData,

                                    beforeSend: function () {
                                        $('#loading').show();
                                    },
                                    success: function (data) {

                                        calEvent.id = data.id;
                                        calEvent.title = form.find("select[name='client_id'] option:checked").text();
                                        calEvent.color = data.color;
                                        calEvent.is_planing =1;
                                        calEvent.budget_temps_estimer = data.budget_temps_estimer;
                                        calEvent.commentaire_admin = data.commentaire_admin;
                                        calEvent.urgence = data.urgence;
                                        calEvent.client_id = data.client_id;
                                        calEvent.mission_id = data.mission_id;

                                        $('#calendar').fullCalendar('renderEvent', calEvent, true);
                                        // $('#my-event').modal('hide');
                                        $('.msg').html('<div class="alert alert-success p-5" role="alert">Votre modification a bien été sauvegardé</div>')

                                    }, error: function (e) {
                                        $('.errorsmsg').html('<span class=" alert alert-danger col-sm-12">' + e.responseJSON.message + '</span>')
                                    }
                                });
                                $('#loading').hide();
                            }
                            else {

                                if (!client_id || client_id == '0') {
                                    form.find("select[name=client_id]").parent('.form-group').addClass('has-error');
                                }
                                if (!mission_id || mission_id == '0') {
                                    form.find("select[name=mission_id]").parent('.form-group').addClass('has-error');
                                }
                                if (!budget_temps_estimer || budget_temps_estimer == '') {
                                    form.find("input[name=budget_temps_estimer]").parent('.form-group').addClass('has-error');
                                }
                                $('.errorsmsg').html('<span class=" alert alert-danger col-sm-12">Veuillez renseigner les champs obligatoires</span>')
                            }
                            return false;

                        });
                        calEvent.urgence == 1 ? $("#checkbox_urgance").attr('checked',true) : '';
                    }
                    else {
                        $('#my-event').find('.delete-event').hide().end().find('.notify-event').hide().end().find('.save-event').hide().end()
                            .find('.modal-body').empty().prepend(form).end();
                        $(".planings-inputs").hide();

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
                    }
                    else if (calEvent.realisee == 0 || typeof(calEvent.budget_temps) === 'undefined') {
                        $('#radio0').attr('checked', true);
                        $("input[name='budget_temps'],input[name='realisee'],input[name='frais_dep'],input[name='frais_resto']" +
                            ",input[name='frais_heber'],input[name='frais_autre']" +
                            ",textarea[name='desc_frais_autre'],textarea[name='commentaire']").attr("disabled", true);
                    }
                    if(calEvent.is_planing !== 1){
                        $("input[name='budget_temps'],input[name='realisee'],input[name='frais_dep'],input[name='frais_resto']" +
                            ",input[name='frais_heber'],input[name='frais_autre']" +
                            ",textarea[name='desc_frais_autre'],textarea[name='commentaire']").attr("disabled", true);
                    }
                    calEvent.realisee == 1 ? $('#radio1').attr('checked', true) : $('#radio0').attr('checked', true);
                },
                events: data.timesheets
            });
        },
    })


});