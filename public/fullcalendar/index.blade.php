@extends('layouts.app')
@section('content')



    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Timesheet</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <button class="pull-right right-side-toggle waves-effect waves-light btn-info btn-circle pull-right m-l-20"><i class="ti-settings text-white"></i></button>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-md-12 alerts-timesheet">

            </div>
            <div class="col-md-12">
                <div class="white-box">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <!-- BEGIN MODAL -->
        <div class="modal fade none-border" id="my-event">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"><strong class="title-modal-event">Add Event</strong></h4>
                    </div>
                    <div class="modal-body"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white waves-effect pull-left" data-dismiss="modal">Fermer</button>
                        <button type="button" class="btn btn-success save-event waves-effect waves-light">Sauvgarder</button>
                        <button type="button" class="btn btn-danger delete-event waves-effect waves-light pull-left" data-dismiss="modal">Supprimer</button>
                    </div>
                </div>
            </div>
        </div>

    </div>



    <script src="{{asset('template/plugins/calendar/jquery-ui.min.js')}}"></script>
    <script src="{{asset('template/plugins/moment/moment.js')}}"></script>
    <script src="{{asset('template/plugins/calendar/dist/fullcalendar.min.js')}}"></script>
    <script src="{{asset('template/plugins/calendar/dist/fr.js')}}"></script>

    <script src="{{asset('template/plugins/calendar/dist/cal-timesheet-init.js')}}"></script>


@endsection