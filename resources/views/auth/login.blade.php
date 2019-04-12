@extends('layouts.app')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-40 mt-40">
                    <h4 class="text-gray mt-0 pt-5">Bienvenue à nouveau sur Tabibi.</h4>
                    <hr>
                    <p>Merci de vous identifier.</p>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="email">Nom d'utilisateur/Email</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}"
                                       class="form-control"
                                       {!! ($errors->has('email')) ? 'style="border-color: #bb0087;"' : '' !!} required>
                                @if($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="password">Mot de passe</label>
                                <input id="password" name="password" class="form-control" type="password"
                                       {!! ($errors->has('email') || $errors->has('password')) ? 'style="border-color: #bb0087;"' : '' !!} required>
                                @if($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="checkbox pull-left mt-15">
                            <label for="form_checkbox">
                                <input id="form_checkbox" name="remember" type="checkbox">
                                Reste connecté </label>
                        </div>
                        <div class="form-group pull-right mt-10 pb-40">
                            <a class="text-theme-colored font-weight-600 font-12"
                               href="{{ route('password.request') }}">Mot de passe oublié?</a>
                        </div>

                        <div class="clear text-center pt-40">
                            <button type="submit" class="btn btn-dark btn-lg btn-block no-border mt-15 mb-15"
                                    href="home.html">Connexion
                            </button>
                            <a class="btn btn-dark btn-lg btn-block no-border" href="#" data-bg-color="#00acee"
                               style="background: rgb(0, 172, 238) !important;"><i class="fa fa-user-md"></i> Je suis
                                professionnel de santé </a>
                        </div>
                    </form>
                </div>
                <div class="col-md-7 col-md-offset-1">
                    <form name="reg-form" action="{{ route('register') }}" class="register-form" method="post">
                        @csrf
                        <div class="icon-box mb-0 p-0">
                            <a href="#" class="icon icon-bordered icon-rounded icon-sm pull-left mb-0 mr-10">
                                <i class="pe-7s-users"></i>
                            </a>
                            <h4 class="text-gray pt-10 mt-0 mb-30">Vous n'avez pas de compte? Inscrire maintenant.</h4>
                        </div>
                        <hr>
                        <p class="text-gray">Inscrire maintenant et prendre rendez-vous en ligne.</p>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Nom</label>
                                <input name="last_name" class="form-control" type="text">
                                @if ($errors->has('last_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label>Prénom</label>
                                <input name="first_name" class="form-control" type="text">
                                @if ($errors->has('first_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>birth</label>
                                <input name="birth" class="form-control" type="date">
                                @if ($errors->has('birth'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('birth') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label>Genre</label>
                                <select name="sexe" id="sexe" class="form-control" required>
                                    <option value selected disabled>Genre</option>
                                    @foreach(\App\Sexe::all() as $sexe)
                                    <option value="{{ $sexe->id }}">{{ ucfirst($sexe->sexe) }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('sexe'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('sexe') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>address</label>
                                <input name="address" class="form-control" type="text" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>ville</label>
                                <select name="city" id="city" class="form-control">
                                    @foreach(\App\City::all() as $city)
                                        <option value="{{ $city->id }}">{{ ucfirst($city->city) }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('city'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Adresse Email</label>
                                <input name="email" class="form-control" type="email" required>
                            </div>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="form_choose_password">Choisissez un mot de passe</label>
                                <input id="form_choose_password" name="password" class="form-control"
                                       type="password" required>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label>Retaper le mot de passe</label>
                                <input id="form_re_enter_password" name="password_confirmation" class="form-control"
                                       type="password" required>
                                @if($errors->has('password_confirmation'))
                                    <div class="text-danger">{{ $errors->first('password_confirmation') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-dark btn-lg btn-block mt-15" type="submit">Inscrire maintenant
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
