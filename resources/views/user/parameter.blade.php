@extends('layouts.app')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="section-content">
                    <div class="row">
                        <form action="{{ route('parameter.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label for="face">face :</label>
                                        <input type="file" name="face" class="form-control">
                                        @if($errors->has('face'))
                                            <span class="text-danger">{{ $errors->first('face') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="last_name">last_name :</label>
                                        <input type="text" name="last_name" id="last_name"
                                               value="{{ (old('last_name')) ? old('last_name') : $user->last_name }}"
                                               class="form-control" required>
                                        @if($errors->has('last_name'))
                                            <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="first_name">first_name :</label>
                                        <input type="text" name="first_name" id="first_name"
                                               value="{{ (old('first_name')) ? old('first_name') : $user->first_name }}"
                                               class="form-control" required>
                                        @if($errors->has('first_name'))
                                            <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="birth">birth :</label>
                                        <input type="date" name="birth" id="birth"
                                               value="{{ (old('birth')) ? old('birth') : $user->birth }}"
                                               class="form-control">
                                        @if($errors->has('birth'))
                                            <span class="text-danger">{{ $errors->first('birth') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="description">description :</label>
                                        <input type="text" name="description" id="description"
                                               value="{{ (old('description')) ? old('description') : $user->description }}"
                                               class="form-control">
                                        @if($errors->has('description'))
                                            <span class="text-danger">{{ $errors->first('description') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="email">email :</label>
                                        <input type="email" name="email" id="email"
                                               value="{{ (old('email')) ? old('email') : $user->email }}"
                                               class="form-control" required>
                                        @if($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>
                                @can('doctor',$user)
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="specialty">specialty :</label>
                                        <select name="specialty" id="specialty" class="form-control" required>
                                            <option value disabled selected>Specialty</option>
                                            @foreach(\App\Specialty::all() as $specialty)
                                                <option value="{{ $specialty->id }}"
                                                        @if(old('specialty') && old('specialty') === $specialty->id)
                                                        selected
                                                        @elseif($user->specialty_id === $specialty->id)
                                                        selected
                                                        @endif
                                                >{{ $specialty->specialty }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('specialty'))
                                            <span class="text-danger">{{ $errors->first('specialty') }}</span>
                                        @endif
                                    </div>
                                </div>
                                @endcan
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="sexe">sexe :</label>
                                        <select name="sexe" id="sexe" class="form-control" required>
                                            <option value disabled selected>sexe</option>
                                            @foreach(\App\Sexe::all() as $sexe)
                                                <option value="{{ $sexe->id }}"
                                                        @if(old('sexe') && old('sexe') === $sexe->id)
                                                        selected
                                                        @elseif($user->sexe_id === $sexe->id)
                                                        selected
                                                        @endif
                                                >{{ $sexe->sexe }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('sexe'))
                                            <span class="text-danger">{{ $errors->first('sexe') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="city">city :</label>
                                        <select name="city" id="city" class="form-control" required>
                                            <option value disabled selected>city</option>
                                            @foreach(\App\City::all() as $city)
                                                <option value="{{ $city->id }}"
                                                        @if(old('city') && old('city') === $city->id)
                                                        selected
                                                        @elseif($user->city_id === $city->id)
                                                        selected
                                                        @endif
                                                >{{ $city->city }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('city'))
                                            <span class="text-danger">{{ $errors->first('city') }}</span>
                                        @endif
                                    </div>
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