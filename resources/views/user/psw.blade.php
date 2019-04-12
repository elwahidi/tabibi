@extends('layouts.app')

@section('content')

    <section>
        <div class="container">
            <div class="row">
                <div class="section-content">
                    <div class="row">
                        <form action="{{ route('psw.update') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label for="oldPassword">old Password :</label>
                                        <input type="password" class="form-control" id="oldPassword" name="oldPassword" required>
                                    </div>
                                    @if($errors->has('oldPassword'))
                                        <span class="text-danger">{{ $errors->first('oldPassword') }}</span>
                                    @endif
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="password">new Password :</label>
                                        <input type="password" id="password" name="password" class="form-control" required>
                                    </div>
                                    @if($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="password_confirmation">new password confirmation :</label>
                                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                                    </div>
                                    @if($errors->has('password_confirmation'))
                                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                    @endif
                                </div>
                                <div class="col-xs-12 text-right">
                                    <button class="btn btn-primary">Mettre à jour</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop