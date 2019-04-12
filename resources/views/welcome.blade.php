@extends('layouts.app')
 
@section('content')
    <!-- Section: inner-header -->
    <section class="inner-header divider parallax layer-overlay overlay-dark-8" data-bg-img="images/bg/bg1.jpg"
             style="background-image: url('images/bg/bg1.jpg'); background-position: 50% 42px;">
        <div class="container pt-60 pb-60">
            <!-- Section Content -->
            <div class="section-content">
                <div class="row">
                    <div class="col-md-12 xs-text-center">
                        <div class="text-white font-22 font-weight-600">Prenez rendez-vous en ligne chez un
                            professionnel de santé
                        </div>
                        <div class="text-white font-13 mt-11 mb-10">C'est immédiat, simple et gratuit.</div>
                        <div class="row">
                            <div class="searching_bar col-sm-6 col-md-3">
                                <div class="form-group ">
                                    <select name="form_sex" class="font-17 form-control required valid"
                                            aria-required="true"
                                            aria-invalid="false">
                                        <option value="" selected="" disabled="">Specialité</option>
                                        <option value="Male">Medcin general</option>
                                        <option value="Male">Medcin general 2</option>
                                        <option value="Male">Dentiste</option>
                                    </select>
                                </div>
                            </div>
                            <div class="searching_bar col-sm-6 col-md-3">
                                <div class="form-group">
                                    <select name="form_sex" class="font-17 form-control required valid"
                                            aria-required="true"
                                            aria-invalid="false">
                                        <option value="" selected="" disabled="">Ville</option>
                                        <option value="">casablanca</option>
                                        <option value="">rabat</option>
                                    </select>
                                </div>
                            </div>
                            <div class="searching_bar col-sm-6 col-md-3">
                                <div class="form-group">
                                    <select name="form_sex" class="font-17 form-control required valid"
                                            aria-required="true"
                                            aria-invalid="false">
                                        <option value="" selected="" disabled="">Etablisement</option>
                                        <option value="">Cabinet</option>
                                        <option value="">Clinic</option>
                                    </select>
                                </div>
                            </div>
                            <div class="searching_bar col-sm-6 col-md-3">
                                <div class="form-group">
                                    <a href="doctor_list.html"
                                       class="sbmt btn color-init-3 text-white font-weight-600 font-18 btn-block">RECHERCHE</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row symptome_icons">
                <div class="col-md-2 symptome_icons_div ">
                    <a href="doctor_list.html">
                        <img src="images/symptome_icons/cardio.svg" class="" alt="" width="50%">
                    </a>
                    <h5 class="text-muted lead">Cardiologist</h5>
                </div>

                <div class="col-md-2 symptome_icons_div ">
                    <a href="doctor_list.html">
                        <img src="images/symptome_icons/brain.svg" class="" alt="" width="50%">
                    </a>
                    <h5 class="text-muted lead">Neurologist</h5>
                </div>

                <div class="col-md-2 symptome_icons_div ">
                    <a href="doctor_list.html">
                        <img src="icons/tooth.png" class="" alt="" width="50%">
                    </a>
                    <h5 class="text-muted lead">Dentist</h5>
                </div>

                <div class="col-md-2 symptome_icons_div ">
                    <a href="doctor_list.html">
                        <img src="images/symptome_icons/eye.svg" class="" alt="" width="50%">
                    </a>
                    <h5 class="text-muted lead">Ophtalmologist</h5>
                </div>

                <div class="col-md-2 symptome_icons_div ">
                    <a href="doctor_list.html">
                        <img src="images/symptome_icons/stomach.svg" class="" alt="" width="50%">
                    </a>
                    <h5 class="text-muted lead">Gastro-entérologie</h5>
                </div>

                <div class="col-md-2 symptome_icons_div ">
                    <a href="doctor_list.html">
                        <img src="images/symptome_icons/kidney.svg" class="" alt="" width="50%">
                    </a>
                    <h5 class="text-muted lead">Dialysis</h5>
                </div>

                <div class="col-md-2 symptome_icons_div ">
                    <a href="doctor_list.html">
                        <img src="images/symptome_icons/lung.svg" class="" alt="" width="50%">
                    </a>
                    <h5 class="text-muted lead">Internist</h5>
                </div>

                <div class="col-md-2 symptome_icons_div ">
                    <a href="doctor_list.html">
                        <img src="images/symptome_icons/ear.svg" class="" alt="" width="50%">
                    </a>
                    <h5 class="text-muted lead">O-r-laryngologist</h5>
                </div>

                <div class="col-md-2 symptome_icons_div ">
                    <a href="doctor_list.html">
                        <img src="images/symptome_icons/dna.svg" class="" alt="" width="50%">
                    </a>
                    <h5 class="text-muted lead">Lab</h5>
                </div>

                <div class="col-md-2 symptome_icons_div ">
                    <a href="doctor_list.html">
                        <img src="images/symptome_icons/cardio.svg" class="" alt="" width="50%">
                    </a>
                    <h5 class="text-muted lead">Cardiologist</h5>
                </div>

                <div class="col-md-2 symptome_icons_div ">
                    <a href="doctor_list.html">
                        <img src="images/symptome_icons/brain.svg" class="" alt="" width="50%">
                    </a>
                    <h5 class="text-muted lead">Neurologist</h5>
                </div>

                <div class="col-md-2 symptome_icons_div ">
                    <a href="doctor_list.html">
                        <img src="images/symptome_icons/stomach.svg" class="" alt="" width="50%">
                    </a>
                    <h5 class="text-muted lead">Gastro-entérologie</h5>
                </div>

            </div>
        </div>
    </section>

    <section class="bg-light">
        <div class="container pt-60 pb-60">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
                    <div class="funfact text-center">
                        <img src="images/main/192870.png" width="80px">
                        <h5 class="color-init-dark-light text-uppercase font-weight-600">Gagnez 30% de temps de
                            secrétariat</h5>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
                    <div class="funfact text-center">
                        <img src="images/main/192868.png" alt="" width="80px">
                        <h5 class="color-init-dark-light text-uppercase font-weight-600">Réduisez de 75% vos
                            rendez‑vous non honorés</h5>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
                    <div class="funfact text-center">
                        <img src="images/main/place.svg" alt="" width="80px">
                        <h5 class="color-init-dark-light text-white text-uppercase font-weight-600">Renouvelez votre
                            patientèle selon vos besoins</h5>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
                    <div class="funfact text-center">
                        <img src="images/main/254068.svg" alt="" width="80px">
                        <h5 class="color-init-dark-light text-uppercase font-weight-600">Apportez un service nouveau
                            pour vos patients</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Divider: Funfact -->
    <section class="divider parallax layer-overlay overlay-theme-colored-9" data-bg-img="images/bg/bg2.jpg"
             data-parallax-ratio="0.7">
        <div class="container pt-60 pb-60">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
                    <div class="funfact text-center">
                        <i class="pe-7s-smile mt-5 text-white"></i>
                        <h2 data-animation-duration="2000" data-value="1754"
                            class="animate-number text-white font-42 font-weight-500">0</h2>
                        <h5 class="text-white text-uppercase font-weight-600">Happy Patients</h5>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
                    <div class="funfact text-center">
                        <i class="pe-7s-rocket mt-5 text-white"></i>
                        <h2 data-animation-duration="2000" data-value="675"
                            class="animate-number text-white font-42 font-weight-500">0</h2>
                        <h5 class="text-white text-uppercase font-weight-600">Our Services</h5>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
                    <div class="funfact text-center">
                        <i class="pe-7s-add-user mt-5 text-white"></i>
                        <h2 data-animation-duration="2000" data-value="248"
                            class="animate-number text-white font-42 font-weight-500">0</h2>
                        <h5 class="text-white text-uppercase font-weight-600">Our Doctors</h5>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
                    <div class="funfact text-center">
                        <i class="pe-7s-global mt-5 text-white"></i>
                        <h2 data-animation-duration="2000" data-value="24"
                            class="animate-number text-white font-42 font-weight-500">0</h2>
                        <h5 class="text-white text-uppercase font-weight-600">Service Points</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section: Doctors -->
    <section id="doctors">
        <div class="container">
            <div class="section-title text-center">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h2 class="text-uppercase mt-0 line-height-1">Our Doctors</h2>
                        <div class="title-icon">
                            <img class="mb-10" src="images/title-icon.png" alt="">
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem autem<br> voluptatem
                            obcaecati!</p>
                    </div>
                </div>
            </div>
            <div class="row mtli-row-clearfix">
                <div class="col-md-12">
                    <div class="owl-carousel-4col">
                        <div class="item">
                            <div class="team-members border-bottom-theme-color-2px text-center maxwidth400">
                                <div class="team-thumb">
                                    <img class="img-fullwidth" alt="" src="images/team/lg6.jpg">
                                    <div class="team-overlay"></div>
                                </div>
                                <div class="team-details bg-silver-light pt-10 pb-10">
                                    <h4 class="text-uppercase font-weight-600 m-5">Dr. Sakib jhon</h4>
                                    <h6 class="text-theme-colored font-15 font-weight-400 mt-0">Mbbs Doctor</h6>
                                    <ul class="styled-icons icon-theme-colored icon-dark icon-circled icon-sm">
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                        <li><a href="#"><i class="fa fa-skype"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="team-members border-bottom-theme-color-2px text-center maxwidth400">
                                <div class="team-thumb">
                                    <img class="img-fullwidth" alt="" src="images/team/lg5.jpg">
                                    <div class="team-overlay"></div>
                                </div>
                                <div class="team-details bg-silver-light pt-10 pb-10">
                                    <h4 class="text-uppercase font-weight-600 m-5">Dr. Smail jhon</h4>
                                    <h6 class="text-theme-colored font-15 font-weight-400 mt-0">Mbbs Doctor</h6>
                                    <ul class="styled-icons icon-theme-colored icon-dark icon-circled icon-sm">
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                        <li><a href="#"><i class="fa fa-skype"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="team-members border-bottom-theme-color-2px text-center maxwidth400">
                                <div class="team-thumb">
                                    <img class="img-fullwidth" alt="" src="images/team/lg9.jpg">
                                    <div class="team-overlay"></div>
                                </div>
                                <div class="team-details bg-silver-light pt-10 pb-10">
                                    <h4 class="text-uppercase font-weight-600 m-5">Dr. Sakib jhon</h4>
                                    <h6 class="text-theme-colored font-15 font-weight-400 mt-0">Mbbs Doctor</h6>
                                    <ul class="styled-icons icon-theme-colored icon-dark icon-circled icon-sm">
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                        <li><a href="#"><i class="fa fa-skype"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="team-members border-bottom-theme-color-2px text-center maxwidth400">
                                <div class="team-thumb">
                                    <img class="img-fullwidth" alt="" src="images/team/lg8.jpg">
                                    <div class="team-overlay"></div>
                                </div>
                                <div class="team-details bg-silver-light pt-10 pb-10">
                                    <h4 class="text-uppercase font-weight-600 m-5">Dr. Smail jhon</h4>
                                    <h6 class="text-theme-colored font-15 font-weight-400 mt-0">Mbbs Doctor</h6>
                                    <ul class="styled-icons icon-theme-colored icon-dark icon-circled icon-sm">
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                        <li><a href="#"><i class="fa fa-skype"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop