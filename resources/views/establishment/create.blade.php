@extends('layouts.app')

@section('content')


    <section>
        <div class="container">
            <div class="row">

                <div class="section-content">
                    <div class="row">
                        <style>

                            #employer-post-new-job .res-steps-container .res-steps {
                                width: 25%;
                                text-align: center;
                                float: left;
                                cursor: pointer
                            }

                            #employer-post-new-job .res-steps-container .res-steps .res-step-bar {
                                -webkit-border-radius: 50% !important;
                                -moz-border-radius: 50% !important;
                                -ms-border-radius: 50% !important;
                                border-radius: 50% !important;
                                background: #0aa7e1;
                                display: inline-block;
                                height: 40px;
                                width: 40px;
                                margin-top: 10px;
                                text-align: center;
                                color: #fff;
                                padding-top: 7px;
                                font-size: 20px
                            }

                            #employer-post-new-job .res-steps-container .res-steps .res-progress-title {
                                text-align: center;
                                font-size: 15px;
                                padding-top: 10px;
                                display: block
                            }

                            #employer-post-new-job .res-steps-container .res-steps .res-progress-bar {
                                height: 5px;
                                background: #0aa7e1;
                                width: 50%;
                                margin: -22px 0 0 50%;
                                float: left
                            }

                            #employer-post-new-job .res-steps-container .res-step-two .res-progress-bar, #employer-post-new-job .res-steps-container .res-step-three .res-progress-bar, #employer-post-new-job .res-steps-container .res-step-four .res-progress-bar {
                                width: 100%;
                                margin-left: 0%
                            }

                            #employer-post-new-job .res-steps-container .res-step-four .res-progress-bar {
                                width: 50%;
                                margin-right: 50%
                            }

                            #employer-post-new-job .res-step-form {
                                border: 1px solid #d2d2d2;
                                box-shadow: 0px 6px 4px -2px silver;
                                position: absolute;
                            }

                            #employer-post-new-job .res-form-two, #employer-post-new-job .res-form-three, #employer-post-new-job .res-form-four {
                                left: 150%
                            }

                            #employer-post-new-job .active .res-step-bar {
                                background: #f19b20 !important
                            }

                            #employer-post-new-job .active .res-progress-title {
                                color: #0aa7e1
                            }
                        </style>

                        <div id="employer-post-new-job">
                            <div class="row">
                                <div class="col-xs-10 col-xs-offset-1 ">
                                    <div class="res-steps-container">
                                        <div class="res-steps res-step-one active" data-class=".res-form-one">
                                            <div class="res-step-bar">1</div>
                                            <div class="res-progress-bar"></div>
                                            <div class="res-progress-title">Établissement</div>
                                        </div>
                                        <div class="res-steps res-step-two" data-class=".res-form-two">
                                            <div class="res-step-bar">2</div>
                                            <div class="res-progress-bar"></div>
                                            <div class="res-progress-title">Add Title & Description 2</div>
                                        </div>
                                        <div class="res-steps res-step-three" data-class=".res-form-three">
                                            <div class="res-step-bar">3</div>
                                            <div class="res-progress-bar"></div>
                                            <div class="res-progress-title">Add Title & Description 3</div>
                                        </div>
                                        <div class="res-steps res-step-four" data-class=".res-form-four">
                                            <div class="res-step-bar">4</div>
                                            <div class="res-progress-bar"></div>
                                            <div class="res-progress-title">Add Title & Description 4</div>
                                        </div>
                                    </div>
                                    <div class="clearfix">&nbsp;</div>
                                    <div class="clearfix">&nbsp;</div>
                                    <form method="post" action="{{ route('establishment.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="res-step-form col-md-10 col-md-offset-1 res-form-one">
                                            <h3 class="text-center text-theme-colored">Formulaire Établissement</h3>
                                            <hr>
                                            <div class="form-group col-md-12 has-error">
                                                <label for="city" class="control-label">Ville</label>
                                                <select name="city" id="city" class="form-control">
                                                    <option value selected disabled>Ville</option>
                                                    @foreach(\App\City::all() as $city)
                                                        <option value="{{ $city->id }}">{{ $city->city }}</option>
                                                    @endforeach
                                                </select>
                                                <small>on has error</small>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <button type="button"
                                                            class="btn btn-block btn-dark btn-theme-colored btn-sm mt-20 pt-10 pb-10 res-btn-orange"
                                                            data-class=".res-form-one">Suivant
                                                    </button>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="res-step-form col-md-8 col-md-offset-2 res-form-two">
                                            <h3 class="text-center">Step 2</h3>

                                            <div class="row">
                                                <div class="form-group col-md-6 has-error">
                                                    <label for="name" class="control-label">Nom établissement</label>
                                                    <input name="name" type="text" class="form-control" id="name">
                                                    <small>on has error</small>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="address_establishment" class="control-label">Adresse de
                                                        l'établissement</label>
                                                    <input name="address_establishment" type="text"
                                                           class="form-control" id="address_establishment">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <label for="build" class="control-label">Bâtiment</label>
                                                    <input name="build" type="text" class="form-control" id="build">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="floor" class="control-label">Étage</label>
                                                    <input name="floor" type="text" class="form-control" id="floor">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="apt_nbr" class="control-label">N° d'appartement</label>
                                                    <input name="apt_nbr" type="text" class="form-control" id="apt_nbr">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="zip" class="control-label">zip</label>
                                                    <input name="zip" type="text" class="form-control" id="zip">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="phones_establishment" class="control-label">Phones
                                                        establishment</label>
                                                    <input name="phones_establishment[]" type="tel" class="form-control"
                                                           id="phones_establishment">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label for="description_establishment" class="control-label">Description
                                                        de l'établissement</label>
                                                    <textarea name="description_establishment" class="form-control"
                                                              id="description_establishment"></textarea>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <button type="button"
                                                            class="btn btn-block btn-gray btn-sm mt-20 pt-10 pb-10 res-btn-gray"
                                                            data-class=".res-form-two">Retour
                                                    </button>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <button type="button"
                                                            class="btn btn-block btn-dark btn-theme-colored btn-sm mt-20 pt-10 pb-10 res-btn-orange"
                                                            data-class=".res-form-two">Suivant
                                                    </button>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="res-step-form col-md-8 col-md-offset-2 res-form-three">
                                            <h3 class="text-center">Step 3</h3>

                                            <div class="row">
                                                <div class="form-group col-md-6 has-error">
                                                    <label for="first_name" class="control-label">Prénom</label>
                                                    <input name="first_name" type="text" class="form-control"
                                                           id="first_name">
                                                    <small>on has error</small>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="last_name" class="control-label">Nom</label>
                                                    <input name="last_name" type="text" class="form-control"
                                                           id="last_name">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="birth" class="control-label">Date naissance</label>
                                                    <input name="birth" class="form-control date-picker" id="birth"
                                                           type="date">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="sexe" class="control-label">Nom</label>
                                                    <select name="sexe" class="form-control" id="sexe">
                                                        <option value selected disabled>Sexe</option>
                                                        @foreach(\App\Sexe::all() as $sexe)
                                                        <option value="{{ $sexe->id }}">{{ $sexe->sexe }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-8">
                                                    <label for="email" class="control-label">E-mail</label>
                                                    <input name="email" type="email" class="form-control" id="email">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="password" class="control-label">Mot de passe</label>
                                                    <input name="password" type="password" class="form-control"
                                                           id="password">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="password_conf" class="control-label">Mot de
                                                        passe</label>
                                                    <input name="password_confirmation" type="password" class="form-control"
                                                           id="password_conf">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="category" class="control-label">choisir la
                                                        Catégorie</label>
                                                    <select name="category" class="form-control" id="category">
                                                        <option value selected disabled>Catégorie</option>
                                                        @foreach($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->category }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="specialty" class="control-label">Spécialité</label>
                                                    <select name="specialty" class="form-control" id="specialty">
                                                        <option value selected disabled>choisir la spécialité</option>
                                                        @foreach(\App\Specialty::all() as $specialty)
                                                        <option value="{{ $specialty->id }}">{{ $specialty->specialty }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="phones" class="control-label">Téléphone </label>
                                                    <input name="phones[]" type="password" class="form-control"
                                                           id="phones">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label class="control-label" for="face">Facial</label>
                                                    <input name="face" class="file" type="file" multiple=""
                                                           data-show-upload="false" data-show-caption="true" id="face">
                                                    <small>Maximum upload file size: 12 MB</small>
                                                    <div id="preview"></div>
                                                    <script>
                                                        function previewImages() {
                                                            var $preview = $('#preview').empty();
                                                            if (this.files) $.each(this.files, readAndPreview);

                                                            function readAndPreview(i, file) {
                                                                if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
                                                                    return alert(file.name + " n'est pas une image");
                                                                }
                                                                var reader = new FileReader();

                                                                $(reader).on("load", function () {
                                                                    $preview.append($("<img/>", {
                                                                        src: this.result,
                                                                        height: 100
                                                                    }));
                                                                });
                                                                reader.readAsDataURL(file);
                                                            }
                                                        }

                                                        $('#face').on("change", previewImages);
                                                    </script>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label for="seance" class="control-label">Seance</label>
                                                    <input name="seance" class="form-control" id="seance" type="time">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label for="description" class="control-label">Description</label>
                                                    <textarea name="description" class="form-control"
                                                              id="description"></textarea>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <button type="button"
                                                            class="btn btn-block btn-gray btn-sm mt-20 pt-10 pb-10 res-btn-gray"
                                                            data-class=".res-form-three">Retour
                                                    </button>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <button type="button"
                                                            class="btn btn-block btn-dark btn-theme-colored btn-sm mt-20 pt-10 pb-10 res-btn-orange"
                                                            data-class=".res-form-three">Suivant
                                                    </button>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="res-step-form col-md-8 col-md-offset-2 res-form-four">
                                            <h3 class="text-center">Photos</h3>

                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label class="control-label" for="imgs">Image 1</label>
                                                    <input name="imgs[]" class="file" type="file" multiple=""
                                                           data-show-upload="false" data-show-caption="true" id="imgs">
                                                    <small>Maximum upload file size: 12 MB</small>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <div class="row">
                                                    <label class="control-label" for="imgs_2">Image 2</label>
                                                    <input name="imgs[]" class="file" type="file" multiple=""
                                                           data-show-upload="false" data-show-caption="true"
                                                           id="imgs_2">
                                                    <small>Maximum upload file size: 12 MB</small>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <div class="row">
                                                    <label class="control-label" for="imgs_3">Image 3</label>
                                                    <input name="imgs[]" class="file" type="file" multiple=""
                                                           data-show-upload="false" data-show-caption="true"
                                                           id="imgs_3">
                                                    <small>Maximum upload file size: 12 MB</small>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <div class="row">
                                                    <label class="control-label" for="imgs_4">Image 4</label>
                                                    <input name="imgs[]" class="file" type="file" multiple=""
                                                           data-show-upload="false" data-show-caption="true"
                                                           id="imgs_4">
                                                    <small>Maximum upload file size: 12 MB</small>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <button type="button"
                                                            class="btn btn-block btn-gray btn-sm mt-20 pt-10 pb-10 res-btn-gray"
                                                            data-class=".res-form-four">Retour
                                                    </button>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <button type="submit"
                                                            class="btn btn-block btn-dark btn-theme-colored btn-sm mt-20 pt-10 pb-10 res-btn-orange"
                                                            data-class=".res-form-four">Submit
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <script>
                            $(document).ready(function () {
                                var steps = ['.res-step-one', '.res-step-two', '.res-step-three', '.res-step-four'];
                                var i = 1;
                                $(".res-form-one").css('position', 'relative');
                                $(".res-step-form .res-btn-orange").click(function () {
                                    var getClass = $(this).attr('data-class');
                                    $(".res-steps").removeClass('active');

                                    $(steps[i]).addClass('active');
                                    i++;
                                    if (getClass != ".res-form-four") {
                                        $(getClass).animate({
                                            left: '-150%'
                                        }, 500, function () {
                                            $(getClass).css('left', '150%');
                                            $(getClass).css('position', 'absolute');

                                        });
                                        $(getClass).next().animate({
                                            left: '0%'
                                        }, 500, function () {
                                            $(this).css('display', 'block');
                                            $(this).css('position', 'relative');
                                        });
                                    }
                                });

                                /* step back */
                                $(".res-step-form .res-btn-gray").click(function () {
                                    var getClass = $(this).attr('data-class');
                                    $(".res-steps").removeClass('active');

                                    i--;
                                    $(steps[i - 1]).addClass('active');
                                    $(getClass).css('position', 'absolute');
                                    $(getClass).prev().css('position', 'relative');
                                    $(getClass).prev().css('left', '-150%')
                                    $(getClass).animate({
                                        left: '150%'
                                    }, 500);
                                    $(getClass).prev().animate({
                                        left: '0%'
                                    }, 500)
                                });

                                /* click from top bar steps */
                                $('.res-step-one').click(function () {
                                    if (!$(this).hasClass('active')) {

                                        $(".res-steps").removeClass('active');
                                        i = 0;
                                        $(steps[i]).addClass('active');
                                        i++;
                                        $('.res-form-one').css('left', '-150%');
                                        $('.res-form-two, .res-form-three, .res-form-four').animate({
                                            left: '150%'
                                        }, 500);
                                        $('.res-form-one').animate({
                                            left: '0%'
                                        }, 500);
                                    }
                                });

                                $('.res-step-two').click(function () {
                                    if (!$(this).hasClass('active')) {
                                        $(".res-steps").removeClass('active');
                                        i = 1;
                                        $(steps[i]).addClass('active');
                                        i++;
                                        $('.res-form-two').css('left', '-150%');
                                        $('.res-form-one, .res-form-three, .res-form-four').animate({
                                            left: '150%'
                                        }, 500);
                                        $('.res-form-two').animate({
                                            left: '0%'
                                        }, 500);
                                    }
                                });

                                $('.res-step-three').click(function () {
                                    if (!$(this).hasClass('active')) {
                                        $(".res-steps").removeClass('active');
                                        i = 2;
                                        $(steps[i]).addClass('active');
                                        i++;
                                        $('.res-form-three').css('left', '-150%');
                                        $('.res-form-one, .res-form-two, .res-form-four').animate({
                                            left: '150%'
                                        }, 500);
                                        $('.res-form-three').animate({
                                            left: '0%'
                                        }, 500);
                                    }
                                });

                                $('.res-step-four').click(function () {
                                    if (!$(this).hasClass('active')) {
                                        $(".res-steps").removeClass('active');
                                        i = 3;
                                        $(steps[i]).addClass('active');
                                        i++;
                                        $('.res-form-four').css('left', '-150%');
                                        $('.res-form-one, .res-form-two, .res-form-three').animate({
                                            left: '150%'
                                        }, 500);
                                        $('.res-form-four').animate({
                                            left: '0%'
                                        }, 500);
                                    }
                                });
                            });
                        </script>
                    </div>
                </div>

            </div>
        </div>
    </section>


@stop